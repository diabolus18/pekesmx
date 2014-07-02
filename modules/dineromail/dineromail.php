<?php
/**
 * Dineromail IPN Payment Gateway Module for Prestashop
 * Tested in Prestashop v1.4.1.0, 1.4.11.0, 1.5.0.17, 1.5.1.0, 1.5.6.2, 1.6.0.5, 1.6.0.6
 * 
 *  @author Rinku Kazeno <development@kazeno.co>
 *  @version 1.52
 *  
 */

if (!defined('_PS_VERSION_'))
    exit;

class Dineromail extends PaymentModule
{
    const MODULE_NAME = 'dineromail';              //DON'T CHANGE!!
    const DM_TABLE = 'dineromail_orders';           //name of the Database Table for storing Order data
    const CONFIG_PREFIX = 'DINEROMAIL';             //prefix for all internal config constants
    const LOCK_FILE = 'lock/validator.lock';
    const SERVER_IP = '54.232.223';
    protected $PSVER = array();
    protected $countryPayments = array(1=>'ar_payment', 2=>'br_payment', 3=>'cl_payment', 4=>'mx_payment');
    protected $countryCurrency = array(1=>'ars', 2=>'brl', 3=>'clp', 4=>'mxn');
    protected $paymentsArray = array(
        1 => array(         //Argentina payment methods
            'ar_amex',
            'ar_argencard',
            'ar_banktransfer',
            'ar_bapropago',
            'ar_cabal',
            'ar_cobroexpress',
            'ar_dm',
            'ar_italcred',
            'ar_master',
            'ar_pagofacil',
            'ar_rapipago',
            'ar_tnaranja',
            'ar_tshopping',
            'ar_visa',
            'ar_ripsa', 
        ),
        2 => array(         //Brazil payment methods
            'br_amex',
            'br_aura',
            'br_visa',
            'br_oipaggo',
            'br_master',
            'br_hipercard',
            'br_dm',
            'br_diners',
            'br_bbancario',
            'br_bco_brasil_dd',
            'br_bco_bradesco_dd',
        ),
        3 => array(         //Chile payment methods
            'cl_visa',
            'cl_servipag',
            'cl_ripley',
            'cl_presto',
            'cl_master',
            'cl_magna',
            'cl_dm',
            'cl_diners',
            'cl_amex',
        ),
        4 => array(         //Mexico payment methods
            'mx_scotiabank_tc',
            'mx_scotiabank_tb',
            'mx_scotiabank_dr',
            'mx_santander_td',
            'mx_santander_tc',
            'mx_santander_tb',
            'mx_santander_dr',
            'mx_oxxo',
            'mx_otherbank_tc',
            'mx_ixe_tc',
            'mx_ixe_tb',
            'mx_ixe_dr',
            'mx_hsbc_td',
            'mx_hsbc_tb',
            'mx_dm',
            'mx_banorte_td',
            'mx_bancomer_tc',
            'mx_bancomer_tb',
            'mx_bancomer_dr',
            'mx_banamex_td',
            'mx_amex',
            'mx_7eleven',
        )
    );
    protected $paymentsWithoutInstallments = array(         //Payment methods that don't support installments
        'ar_banktransfer','ar_bapropago','ar_dm','ar_pagofacil','ar_rapipago','ar_tnaranja','ar_ripsa',
        'br_aura','br_oipaggo','br_hipercard','br_dm','br_bbancario','br_bco_brasil_dd','br_bco_bradesco_dd',   ##Check them
        'cl_servipag','cl_presto','cl_ripley','cl_magna','cl_dm','cl_visa','cl_master','cl_diners','cl_amex',
        'mx_oxxo','mx_7eleven','mx_dm','mx_scotiabank_tb','mx_scotiabank_dr','mx_santander_tb','mx_santander_dr','mx_ixe_tb','mx_ixe_dr','mx_hsbc_tb','mx_bancomer_tb','mx_bancomer_dr',
    );
    protected $installmentsArray = array('1', '3', '6', '9', '12', '18');
    public $transactionId = '';
    public $delta = 1;                  //Maximum amount of permissible discrepancy between Order amount and amount payed by Customer, in Currency Units
    public $warnings = array();
    public $fatalWarnings = array();
    public $wait_status = '';
    
    public function __construct()
	{
        $this->PSVER = explode('.', _PS_VERSION_);      //Prestashop version checks depend on this
        $this->name = 'dineromail';     //DON'T CHANGE!!
		$this->tab = 'payments_gateways';
		$this->version = '1.52';
		$this->author = 'R. Kazeno';
        $this->need_instance = 1;
        $this->ps_versions_compliancy = array('min' => '1.4', 'max' => '1.6');
        $this->module_key = '33075720e655c395d3d3809e8cdcbc6d';
        $this->currencies = TRUE;
        $this->currencies_mode = 'radio';
        
        parent::__construct();
        $this->displayName = $this->l('Dineromail');
		$this->description = $this->l('Accept Dineromail payments through the IPN 2 interface');
        $this->confirmUninstall = $this->l('This will delete any configured settings for this module. Continue?');
        $shopCurrency = $this->getCurrency(Configuration::get('PS_CURRENCY_DEFAULT'));
        if (!is_object($shopCurrency)) {            //Assume default currency if none registered
            $shopCurrency = NEW Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
        }
        if (!function_exists('fsockopen')) {        //Check on initialization if fsockopen connections are not blocked by host
            $this->fatalWarnings[] = $this->l('Your host has disabled fsockopen. Contact their technical support to have them enable outbound connections for your account.');
        }
        if (!in_array(Tools::strtolower($shopCurrency->iso_code), $this->countryCurrency))
            $this->fatalWarnings[] = $this->l('Selected currency not supported by Dineromail. Please change it in your Currency Restrictions configuration.');
        if (Configuration::get(self::CONFIG_PREFIX.'_MERCHANT_ID')=='0')
            $this->fatalWarnings[] = $this->l('You need to configure your account settings.');
        if (!extension_loaded('simplexml'))
            $this->fatalWarnings[] = $this->l('SimpleXML extension not installed. This module requires it for handling XML requests and responses.');
        if (!extension_loaded('json'))
            $this->fatalWarnings[] = $this->l('JSON extension not installed. This module requires it for serializing configurations.');
        if (!Configuration::get('PS_SHOP_ENABLE'))
            $this->warnings[] = $this->l('Your shop is currently in maintenance mode. Dineromail automatic payment notifications will not work until it is disabled.');
        $this->warning = implode(' | ', ($this->warnings+$this->fatalWarnings));
        if ((float)($this->PSVER[0].'.'.$this->PSVER[1]) < 1.5 AND !Tools::strlen(Configuration::get(self::CONFIG_PREFIX.'_FEE'))) {       //Force upgrade to version 1.50 on older PS versions
            require_once _PS_ROOT_DIR_."/modules/{$this->name}/upgrade/Upgrade-1.49.php";
            upgrade_module_1_49($this);
        }
        if (_PS_VERSION_ < '1.5') {         //Backwards compatibility for Prestashop versions < 1.5
            require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');
            if (!in_array('HelperForm', get_declared_classes()))
                require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/HelperForm.php');
        }
    }
    
    public function install()
    {
        $mails = array(
            'en/waiting_for_payment.txt',
            'en/waiting_for_payment.html',
            'es/waiting_for_payment.txt',
            'es/waiting_for_payment.html'
        );
        foreach ($mails as $file) {             //install pending status mail templates
            if (!file_exists(_PS_MAIL_DIR_.$file) && is_dir(_PS_MAIL_DIR_.Tools::substr($file, 0, 2))) {
                copy(_PS_MODULE_DIR_."{$this->name}/mails/{$file}", _PS_MAIL_DIR_.$file);
            }
        }
        //Bypass georestrictions for Dineromail notification server block
        if (!in_array(self::SERVER_IP, explode(';', Configuration::get('PS_GEOLOCATION_WHITELIST'))))
            Configuration::updateValue('PS_GEOLOCATION_WHITELIST', Configuration::get('PS_GEOLOCATION_WHITELIST').';'.self::SERVER_IP);

        $db = Db::getInstance();
        return (parent::install() AND
            $db->Execute('
                CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . self::DM_TABLE . '` (
                `transaction_id` varchar(20) NOT NULL,
                `order_id` int(10) NULL,
                `cart_id` int(14) NOT NULL UNIQUE,
                `fee` varchar(10) NULL,
                PRIMARY KEY (`transaction_id`)
                )'
            ) AND
            $this->registerHook('payment') AND
            $this->registerHook('paymentReturn') AND
            $this->registerHook('invoice') AND
            Configuration::updateValue(self::CONFIG_PREFIX.'_MERCHANT_ID', '0') AND
            Configuration::updateValue(self::CONFIG_PREFIX.'_IPN_KEY', 'XXXX') AND
            Configuration::updateValue(self::CONFIG_PREFIX.'_WAIT_STATUS', '0') AND
            Configuration::updateValue(self::CONFIG_PREFIX.'_COUNTRY_ID', '1') AND
            Configuration::updateValue(self::CONFIG_PREFIX.'_FEE', '0.00%') AND
            Configuration::updateValue(self::CONFIG_PREFIX.'_PAYMENT_METHODS', '["ar_amex","ar_argencard","ar_banktransfer","ar_bapropago","ar_cabal","ar_cobroexpress","ar_dm","ar_italcred","ar_master","ar_pagofacil","ar_rapipago","ar_tnaranja","ar_tshopping","ar_visa","ar_ripsa"]') AND
            Configuration::updateValue(self::CONFIG_PREFIX.'_INSTALLMENTS', '[1, 3, 6, 9, 12, 18]') AND
            chmod(_PS_MODULE_DIR_."{$this->name}/".self::LOCK_FILE, 0777)
        );
	}
    
    public function uninstall()
    {
        return (parent::uninstall() AND 
          Configuration::deleteByName(self::CONFIG_PREFIX.'_MERCHANT_ID') AND
          Configuration::deleteByName(self::CONFIG_PREFIX.'_IPN_KEY') AND
          Configuration::deleteByName(self::CONFIG_PREFIX.'_WAIT_STATUS') AND
          Configuration::deleteByName(self::CONFIG_PREFIX.'_COUNTRY_ID') AND
          Configuration::deleteByName(self::CONFIG_PREFIX.'_FEE') AND
          Configuration::deleteByName(self::CONFIG_PREFIX.'_PAYMENT_METHODS') AND
          Configuration::deleteByName(self::CONFIG_PREFIX.'_INSTALLMENTS')
          );
    }
    
    public function getContent()
    {
        require_once 'API/dineromailAPI.php';
        ob_start();
        echo "<h2>{$this->displayName}</h2>\n";
        if (Tools::isSubmit('submitDineromail'))
            echo $this->_getErrors() ? $this->_getErrors() : $this->_saveConfig();
        if (Configuration::get(self::CONFIG_PREFIX.'_MERCHANT_ID') != '0') {        //Check IPN Access is working correctly
            $accountData = array('country_id'=>Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID'),
                'merchant'=>Configuration::get(self::CONFIG_PREFIX.'_MERCHANT_ID'),
                'password'=>Configuration::get(self::CONFIG_PREFIX.'_IPN_KEY')
            );
            $check = queryTransaction($accountData,  'qazxswedcvfrtgbnhy');
            $accountError = TRUE;
            switch($check->ESTADOREPORTE) {
                case '1':
                case '8':
                $accountError = FALSE;      //No problemo!
                    break;
                case '2':
                    echo $this->displayError($this->l('XML error when checking IPN connection'));
                    break;
                case '3':
                case '4':
                case '5':
                case '6':
                case '7':
                    echo $this->displayError($this->l('There seems to be an error in your account number or IPN password, or you haven\'t yet configured your IPN password in your Dineromail account settings.'));
                    break;
                default :
                    echo $this->displayError($this->l('Unknown response when checking IPN connection'));
                    break;
            }
            if (class_exists('DOMDocument') && !$accountError && ($cp = getTestCheckoutGui(       //Test DM checkout
                array( 'merchant' => Configuration::get(self::CONFIG_PREFIX.'_MERCHANT_ID'),
                    'country_id' => Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID'),
                    'seller_name' => htmlspecialchars(Configuration::get('PS_SHOP_NAME')),
                    'transaction_id' => $this->transactionId,
                    'language' => 'en',
                    'currency'=> $this->countryCurrency[(int)Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID')],
                    'payment_method_available' => 'all',
                    'buyer_name' => 'firstname',
                    'buyer_lastname' => 'lastname',
                    'buyer_email' => 'email@example.com',
                    'buyer_phone' => 55443322,
                    "item_name_1" => 'Test product',
                    "item_quantity_1" => 1,
                    "item_ammount_1" => 10000,
                    "item_currency_1" => $this->countryCurrency[(int)Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID')],
                    'ok_url' => 'http://www.prestashop.com',
                    'error_url' => 'http://www.prestashop.com',
                    'pending_url' => 'http://www.prestashop.com',
                )
            ))) {
                if (!count($cp->xpath("//div[@class='pmsection']")))
                    echo $this->displayError($this->l('Error testing Dineromail checkout. Please make sure your Dineromail account has been verified as a seller before using this module.'));
            }
        }
        $currentCountry = Tools::getValue('country_id', Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID'));
        $countrySelect = array($currentCountry => ' selected="selected"') + array_fill(1, 4, '');     //Adds "selected" attribute to current country
        $payments_ar = $currentCountry==='1' ? Tools::getValue('ar_payment', $this->_getPaymentConfig()) : $this->paymentsArray[1];
        $payments_br = $currentCountry==='2' ? Tools::getValue('br_payment', $this->_getPaymentConfig()) : $this->paymentsArray[2];
        $payments_cl = $currentCountry==='3' ? Tools::getValue('cl_payment', $this->_getPaymentConfig()) : $this->paymentsArray[3];
        $payments_mx = $currentCountry==='4' ? Tools::getValue('mx_payment', $this->_getPaymentConfig()) : $this->paymentsArray[4];
        $installments = Tools::getValue('installment', $this->_getInstallmentConfig());
        $currentCurrency = $this->getCurrency();
        $statuses = OrderState::getOrderStates($this->context->language->id);
        $waitStatus = $this->wait_status ? $this->wait_status : Tools::getValue('wait_status', Configuration::get(self::CONFIG_PREFIX.'_WAIT_STATUS'));
        $orderState = new OrderState($waitStatus);
        ?>
            <form id="dm_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                <fieldset>
                    <legend>1. <?php echo $this->l('Account'); ?></legend>
                    <label for="dm_merchant_id"><?php echo $this->l('Merchant ID')?></label>
                    <div class="margin-form">
                        <input type="text" name="merchant_id" id="dm_merchant_id" value="<?php echo Tools::getValue('merchant_id', Configuration::get(self::CONFIG_PREFIX.'_MERCHANT_ID')); ?>" style="width: 220px;" />
                    </div>
                    <p><?php echo $this->l('Your Dineromail account number (without the bar or the last digit)'); ?></p><br />
                    <label for="dm_country_id"><?php echo $this->l('Country'); ?></label>
                    <div class="margin-form">
                        <select name="country_id" id="dm_country_id">
                            <option value="1"<?php echo $countrySelect[1]; ?>>Argentina</option>
                            <option value="2"<?php echo $countrySelect[2]; ?>>Brazil</option>
                            <option value="3"<?php echo $countrySelect[3]; ?>>Chile</option>
                            <option value="4"<?php echo $countrySelect[4]; ?>>México</option>
                        </select>
                    </div>
                    <p><?php echo $this->l('Remember you must select your merchant currency in the "Currencies Restrictions" section of the "Payment" tab.'); ?></p>
                    <p><?php echo $this->l('Currently selected currency for this module: '); ?><b><?php echo $currentCurrency->name . " ({$currentCurrency->iso_code})"; ?></b></p>
                </fieldset><br />
                <fieldset id="dm_payment1">
                    <legend>2. <?php echo $this->l('Payment Methods for Argentina'); ?></legend>
                    <label><?php echo $this->l('American Express'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_amex"<?php echo (in_array('ar_amex',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Argencard'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_argencard"<?php echo (in_array('ar_argencard',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Bank Transfer'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_banktransfer"<?php echo (in_array('ar_banktransfer',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Bapropago'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_bapropago"<?php echo (in_array('ar_bapropago',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Cabal'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_cabal"<?php echo (in_array('ar_cabal',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('CobroExpress'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_cobroexpress"<?php echo (in_array('ar_cobroexpress',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('DineroMail Funds'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_dm"<?php echo (in_array('ar_dm',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Italcred'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_italcred"<?php echo (in_array('ar_italcred',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('MasterCard'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_master"<?php echo (in_array('ar_master',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Pago Fácil'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_pagofacil"<?php echo (in_array('ar_pagofacil',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Rapipago'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_rapipago"<?php echo (in_array('ar_rapipago',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Ripsa'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_ripsa"<?php echo (in_array('ar_ripsa',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Tarjeta Naranja'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_tnaranja"<?php echo (in_array('ar_tnaranja',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Tarjeta Shopping'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_tshopping"<?php echo (in_array('ar_tshopping',$payments_ar)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Visa'); ?> <input type="checkbox" name="ar_payment[ ]" value="ar_visa"<?php echo (in_array('ar_visa',$payments_ar)?' checked="checked"':''); ?> /></label>
                  </fieldset>
                  <fieldset id="dm_payment2">
                    <legend>2. <?php echo $this->l('Payment Methods for Brazil'); ?></legend>
                    <label><?php echo $this->l('American Express'); ?> <input type="checkbox" name="br_payment[ ]" value="br_amex"<?php echo (in_array('br_amex',$payments_br)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Aura'); ?> <input type="checkbox" name="br_payment[ ]" value="br_aura"<?php echo (in_array('br_aura',$payments_br)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Banco do Brasil Transfer'); ?> <input type="checkbox" name="br_payment[ ]" value="br_bco_brasil_dd"<?php echo (in_array('br_bco_brasil_dd',$payments_br)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Boleto Bancario'); ?> <input type="checkbox" name="br_payment[ ]" value="br_bbancario"<?php echo (in_array('br_bbancario',$payments_br)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Bradesco Transfer'); ?> <input type="checkbox" name="br_payment[ ]" value="br_bco_bradesco_dd"<?php echo (in_array('br_bco_bradesco_dd',$payments_br)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('DineroMail Funds'); ?> <input type="checkbox" name="br_payment[ ]" value="br_dm"<?php echo (in_array('br_dm',$payments_br)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Diners'); ?> <input type="checkbox" name="br_payment[ ]" value="br_diners"<?php echo (in_array('br_diners',$payments_br)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('HiperCard'); ?> <input type="checkbox" name="br_payment[ ]" value="br_hipercard"<?php echo (in_array('br_hipercard',$payments_br)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('MasterCard'); ?> <input type="checkbox" name="br_payment[ ]" value="br_master"<?php echo (in_array('br_master',$payments_br)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Oipaggo'); ?> <input type="checkbox" name="br_payment[ ]" value="br_oipaggo"<?php echo (in_array('br_oipaggo',$payments_br)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Visa'); ?> <input type="checkbox" name="br_payment[ ]" value="br_visa"<?php echo (in_array('br_visa',$payments_br)?' checked="checked"':''); ?> /></label>
                  </fieldset>
                  <fieldset id="dm_payment3">
                    <legend>2. <?php echo $this->l('Payment Methods for Chile'); ?></legend>
                    <label><?php echo $this->l('American Express'); ?> <input type="checkbox" name="cl_payment[ ]" value="cl_amex"<?php echo (in_array('cl_amex',$payments_cl)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Diners'); ?> <input type="checkbox" name="cl_payment[ ]" value="cl_diners"<?php echo (in_array('cl_diners',$payments_cl)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('DineroMail Funds'); ?> <input type="checkbox" name="cl_payment[ ]" value="cl_dm"<?php echo (in_array('cl_dm',$payments_cl)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Magna'); ?> <input type="checkbox" name="cl_payment[ ]" value="cl_magna"<?php echo (in_array('cl_magna',$payments_cl)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('MasterCard'); ?> <input type="checkbox" name="cl_payment[ ]" value="cl_master"<?php echo (in_array('cl_master',$payments_cl)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Presto'); ?> <input type="checkbox" name="cl_payment[ ]" value="cl_presto"<?php echo (in_array('cl_presto',$payments_cl)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Ripley'); ?> <input type="checkbox" name="cl_payment[ ]" value="cl_ripley"<?php echo (in_array('cl_ripley',$payments_cl)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Servipag'); ?> <input type="checkbox" name="cl_payment[ ]" value="cl_servipag"<?php echo (in_array('cl_servipag',$payments_cl)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Visa'); ?> <input type="checkbox" name="cl_payment[ ]" value="cl_visa"<?php echo (in_array('cl_visa',$payments_cl)?' checked="checked"':''); ?> /></label>
                  </fieldset>
                  <fieldset id="dm_payment4">
                    <legend>2. <?php echo $this->l('Payment Methods for Mexico'); ?></legend>
                    <label><?php echo $this->l('7 Eleven'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_7eleven"<?php echo (in_array('mx_7eleven',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('American Express'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_amex"<?php echo (in_array('mx_amex',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Banamex Debit Card'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_banamex_td"<?php echo (in_array('mx_banamex_td',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Bancomer Credit Card'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_bancomer_tc"<?php echo (in_array('mx_bancomer_tc',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Bancomer Deposit'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_bancomer_dr"<?php echo (in_array('mx_bancomer_dr',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Bancomer Transfer'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_bancomer_tb"<?php echo (in_array('mx_bancomer_tb',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Banorte Debit Card'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_banorte_td"<?php echo (in_array('mx_banorte_td',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('DineroMail Funds'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_dm"<?php echo (in_array('mx_dm',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('HSBC Credit Card'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_hsbc_td"<?php echo (in_array('mx_hsbc_td',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('HSBC Transfer'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_hsbc_tb"<?php echo (in_array('mx_hsbc_tb',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('IXE Credit Card'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_ixe_tc"<?php echo (in_array('mx_ixe_tc',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('IXE Deposit'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_ixe_dr"<?php echo (in_array('mx_ixe_dr',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('IXE Transfer'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_ixe_tb"<?php echo (in_array('mx_ixe_tb',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Mastercard / Visa'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_otherbank_tc"<?php echo (in_array('mx_otherbank_tc',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('OXXO'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_oxxo"<?php echo (in_array('mx_oxxo',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Santander Deposit'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_santander_dr"<?php echo (in_array('mx_santander_dr',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Santander Transfer'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_santander_tb"<?php echo (in_array('mx_santander_tb',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Santander Credit Card'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_santander_tc"<?php echo (in_array('mx_santander_tc',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Santander Debit Card'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_santander_td"<?php echo (in_array('mx_santander_td',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Scotiabank Credit Card'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_scotiabank_tc"<?php echo (in_array('mx_scotiabank_tc',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Scotiabank Deposit'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_scotiabank_dr"<?php echo (in_array('mx_scotiabank_dr',$payments_mx)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('Scotiabank Transfer'); ?> <input type="checkbox" name="mx_payment[ ]" value="mx_scotiabank_tb"<?php echo (in_array('mx_scotiabank_tb',$payments_mx)?' checked="checked"':''); ?> /></label>
                </fieldset><br />
                <fieldset>
                    <legend>3. <?php echo $this->l('Accepted Installments'); ?></legend>
                    <label><?php echo $this->l('1'); ?> <input type="checkbox" name="installment[ ]" value="1"<?php echo (in_array('1',$installments)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('3'); ?> <input type="checkbox" name="installment[ ]" value="3"<?php echo (in_array('3',$installments)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('6'); ?> <input type="checkbox" name="installment[ ]" value="6"<?php echo (in_array('6',$installments)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('9'); ?> <input type="checkbox" name="installment[ ]" value="9"<?php echo (in_array('9',$installments)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('12'); ?> <input type="checkbox" name="installment[ ]" value="12"<?php echo (in_array('12',$installments)?' checked="checked"':''); ?> /></label>
                    <label><?php echo $this->l('18'); ?> <input type="checkbox" name="installment[ ]" value="18"<?php echo (in_array('18',$installments)?' checked="checked"':''); ?> /></label>
                </fieldset><br />
                <fieldset>
                    <legend>4. <?php echo $this->l('Integration'); ?></legend>
                    <label for="mp_fee"><?php echo $this->l('Additional fee'); ?></label>
                    <div class="margin-form"><input type="text" name="fee" id="mp_fee" maxlength="10" value="<?php echo Tools::getValue('fee', Configuration::get(self::CONFIG_PREFIX.'_FEE')); ?>" /><br/><?php echo $this->l('Additional fee you want to charge customers who choose this payment option. Can be either a fixed amount (without the percent sign) or a percentage (ending with the percent sign). Set to either 0.00 or 0.00% to disable.'); ?></div><br />
                    <label for="dm_ipn_key"><?php echo $this->l('IPN Password'); ?></label>
                    <div class="margin-form">
                        <input type="text" name="ipn_key" id="dm_ipn_key" value="<?php echo Tools::getValue('ipn_key', Configuration::get(self::CONFIG_PREFIX.'_IPN_KEY')); ?>" />
                    </div>
                    <p class="clear warn"><?php echo $this->l('Reminder: This is NOT your account password.'); ?></p>
                    <p><?php echo $this->l('You need to configure your IPN settings in the "Profile" section inside your Dineromail account. In there you\'ll be asked to create a new password for the IPN connections, once you do it and enable IPN, insert above the IPN password you just created. For the callback URL you\'re asked for use the following:'); ?>
                    <br /><b><?php echo (method_exists('Tools','getShopDomainSsl') ? Tools::getShopDomainSsl(true, true) : Tools::getHttpHost(true, true)) .      //1.3.x Hack
                        __PS_BASE_URI__ . (((int)$this->PSVER[0] < 2 && (int)$this->PSVER[1] < 5) ? 'modules/dineromail/validation.php' : 'index.php?fc=module&module=dineromail&controller=validation'); ?></b></p><br />
                    <label for="dm_wait_status"><?php echo $this->l('Pending Order Status'); ?></label>
                    <div class="margin-form">
                        <select name="wait_status" id="dm_wait_status">
                            <option value="0"><?php echo $this->l('Select a status for pending orders'); ?>...</option>
                            <option value="new">==<?php  echo $this->l('Create a new status');  ?>==</option>
                    <?php foreach ($statuses as $stat) : 
                        if ($stat['id_order_state'] < 10)
                            continue;
                        $selectedStat = $stat['id_order_state']==$orderState->id ? 'selected="selected"' : '';
                        ?>
                            <option value="<?php  echo $stat['id_order_state'];  ?>" <?php  echo $selectedStat;  ?> ><?php  echo $stat['name'];  ?></option>
                    <?php endforeach; ?>
                        </select>
                    </div>
                    <p style="clear:both;"><?php  echo $this->l('This is the status that will be assigned to incoming orders marked as "pending". You can create a new status by selecting "Create a new status" and naming it something like "Awaiting Dineromail Payment"');  ?></p>
                </fieldset><br />
                <div class="clear center"><input type="submit" name="submitDineromail" class="button" value="<?php echo $this->l('   Save   '); ?>" /></div><br />
            </form>
            <script>
                (function() {
                    var form = $("#dm_form");
                    var sel = $("#dm_country_id");
                    var sel2 = $("#dm_wait_status");
                    var newStatCode = '<div id="new-status">'+
                        '<label style="width:400px; position: relative; left: -100px;"><?php  echo $this->l('Status Name');  ?> <input type="text" name="wait_status_name" id="mp_new_status_name" style="width:260px;" /></label>'+
                        '<label style="width:260px; position: relative; left: -100px;"><?php  echo $this->l('Status Color');  ?> <input type="color" data-hex="true" class="color mColorPickerInput" name="color" id="mp_color" value="'+
                        '<?php echo htmlentities($orderState->color, ENT_COMPAT, 'UTF-8'); ?>" /></label>'+
                        '<script src="../js/jquery/jquery-colorpicker.js"></scr'+'ipt>'+
                        '</div>';
                    function changePay() { 
                        form.find("fieldset[id*=dm_payment]").hide();
                        form.find("#dm_payment"+sel.val()).show();
                    };
                    function toggleNewStat() { 
                        if (sel2.val()=='new') {
                            sel2.after(newStatCode);
                        } else {
                            $('#new-status').remove();;
                        }
                    }
                    changePay();
                    sel.bind("change", function(){ changePay(); });
                    sel2.bind("change", toggleNewStat);
                })();
            </script>
        <?php
        return ob_get_clean();
    }
    
    protected function _getErrors()
    {
        $error = '';
        if (!is_numeric(Tools::getValue('merchant_id')) || Tools::getValue('merchant_id')==0)
            $error .= $this->displayError($this->l('Invalid Merchant ID'));
        if (!Tools::getValue($this->countryPayments[Tools::getValue('country_id')]))
            $error .= $this->displayError($this->l('You must select at least one payment method'));
        if (!Tools::getValue('installment'))
            $error .= $this->displayError($this->l('You must select at least one installment'));
        if ((!is_numeric(Tools::getValue('wait_status')) && !Tools::getValue('wait_status_name')) || (is_numeric(Tools::getValue('wait_status')) && Tools::getValue('wait_status')<1))
            $error .= $this->displayError($this->l('Invalid Pending Order Status ID'));
        if (!preg_match('/^[\d]*[\.]?[\d]*%?$/', Tools::getValue('fee')) OR Tools::getValue('fee') == '%')
            $error .= $this->displayError($this->l('Additional fee format is incorrect. Should be either an amount, such as 7.50, or a percentage, such as 6.99%'));
        return $error;
    }
    
    protected function _saveConfig()
    {
        $extraMessage = '';
        $countryCurrencyId = Currency::getIdByIsoCode($this->countryCurrency[(int)Tools::getValue('country_id')]);
        if (!empty($countryCurrencyId) && $this->getCurrency()->id != $countryCurrencyId) {           //If currency differs from module's country setting, attempt to adjust it automatically
            $countryCurrency = New Currency($countryCurrencyId);
            Db::getInstance()->Execute('
                DELETE FROM '._DB_PREFIX_.'module_currency
                WHERE `id_module` = ' . $this->id
            );
            $extraMessage = Db::getInstance()->Execute('
                INSERT INTO '._DB_PREFIX_."module_currency
                (`id_currency`, `id_module`)
                VALUES ({$countryCurrencyId}, {$this->id})"
            )  ?  '<br />'.$this->l('This module\'s currency has been changed automatically to ').$countryCurrency->name  :  '';
        }
        $waitStatus = Tools::getValue('wait_status');
        if ($name = Tools::getValue('wait_status_name')) {          //Create a new Order State for pending orders
            $orderState = new OrderState();
            $orderState->name = array($this->context->language->id => $name);
            $orderState->template = array(1 => 'waiting_for_payment');
            $orderState->send_email = FALSE;
            $orderState->invoice = FALSE;
            $orderState->color = Tools::getValue('color');
            $orderState->unremovable = FALSE;
            $orderState->logable = FALSE;
            $orderState->delivery = FALSE;
            $orderState->hidden = FALSE;
            if ($orderState->add()) {
                $waitStatus = $orderState->id;
                $extraMessage .= '<br />'.$this->l('New pending order status created')." ID: $waitStatus";
                $this->wait_status = $waitStatus;
            }
        }
        Configuration::updateValue(self::CONFIG_PREFIX.'_COUNTRY_ID', Tools::getValue('country_id'));
        Configuration::updateValue(self::CONFIG_PREFIX.'_PAYMENT_METHODS', Tools::jsonEncode(Tools::getValue($this->countryPayments[Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID')])));
        Configuration::updateValue(self::CONFIG_PREFIX.'_INSTALLMENTS', Tools::jsonEncode(Tools::getValue('installment')));
        Configuration::updateValue(self::CONFIG_PREFIX.'_MERCHANT_ID', trim(Tools::getValue('merchant_id')));
        Configuration::updateValue(self::CONFIG_PREFIX.'_WAIT_STATUS', $waitStatus);
        Configuration::updateValue(self::CONFIG_PREFIX.'_IPN_KEY', trim(Tools::getValue('ipn_key')));
        Configuration::updateValue(self::CONFIG_PREFIX.'_FEE', Tools::getValue('fee'));
        $this->createPaymentImage();
        return $this->displayConfirmation($this->l('Configuration saved') . $extraMessage);
    }
    
    
    public function hookPayment($params)
    {
        //Return False unless there are no warnings
        if (!$this->active OR Tools::strlen($this->warning))
            return FALSE;
        $countries = array(1=>'Argentina', 2=>'Brasil', 3=>'Chile', 4=>'México');
        $requireFee = (bool)($this->getTotalWithFee(1, Configuration::get(self::CONFIG_PREFIX.'_FEE'))>1);
        $feeamount = strpos(Configuration::get(self::CONFIG_PREFIX.'_FEE'), '%') ? Configuration::get(self::CONFIG_PREFIX.'_FEE') : $this->context->currency->sign . Configuration::get(self::CONFIG_PREFIX.'_FEE');
        $feetext = $this->l('An extra fee of') . " $feeamount " . $this->l('will apply to payments using this method');
        $this->context->smarty->assign( array(
            'buttonText' => ($this->l('Pay with Dineromail ') . $countries[Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID')]),
            'imagePath' => (method_exists('Tools','getShopDomainSsl') ? Tools::getShopDomainSsl(true, true) : Tools::getHttpHost(true, true)).__PS_BASE_URI__."modules/{$this->name}/img/",
            'paymentPath' => (method_exists('Tools','getShopDomainSsl') ? Tools::getShopDomainSsl(true, true) : Tools::getHttpHost(true, true))
                .(((int)$this->PSVER[0] < 2 && (int)$this->PSVER[1] < 5) ? $this->_path.'payment.php' : __PS_BASE_URI__."index.php?fc=module&module={$this->name}&controller=payment"),
            'dmFee' => $requireFee ? $feetext : '',
        ) );
        return $this->display(__FILE__, 'views/templates/hooks/payment.tpl');
    }
    
    public function hookPaymentReturn($params)
    {
        if (!$this->active)
			return FALSE;
		return $this->display(__FILE__, 'views/templates/hooks/payment_return.tpl');
    }
    
    public function hookInvoice($params)
    {
        $order = New Order($params['id_order']);
        if ($order->module!=$this->name)
            return FALSE;
        
        require_once 'API/dineromailAPI.php';
        $transactionId = Db::getInstance()->getValue('SELECT `transaction_id` FROM `' . _DB_PREFIX_ . Dineromail::DM_TABLE . '` WHERE `order_id` = ' . $order->id);
        $accountData = array('country_id'=>Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID'),
            'merchant'=>Configuration::get(self::CONFIG_PREFIX.'_MERCHANT_ID'),
            'password'=>Configuration::get(self::CONFIG_PREFIX.'_IPN_KEY')
            );
        $Reporte = queryTransaction($accountData,  $transactionId);
        switch ($Reporte->DETALLE->OPERACIONES->OPERACION->ESTADO) {
            case 1:
                $status = $this->l('Pending');
                break;
            case 2:
                $status = $this->l('Accepted');
                break;
            case 3:
                $status = $this->l('Denied');
                break;
            default:
                $status = $this->l('Error querying Dineromail server');
                break;
        }
        //$warning = '';
        $currency = new Currency($order->id_currency);
        $fee = $this->getFieldFromTransactionId($transactionId, 'fee');
        $totalToPay = Tools::ps_round($this->getTotalWithFee($order->total_paid, $fee), 2);
        $paidFee = $totalToPay - $order->total_paid;
        $dmId = $Reporte->DETALLE->OPERACIONES->OPERACION->NUMTRANSACCION;
        ob_start();
        ?>
            <fieldset style="width: 400px; position: relative; left: 10px; margin-top: 26px;">
                <legend><img src="../modules/dineromail/logo.gif" alt="logo" /><?php echo $this->l('Dineromail Transaction Information'); ?></legend>
                <?php echo $this->l('Dineromail ID') . ": $dmId"; ?><br />
                <?php echo $this->l('Transaction ID') . ": $transactionId"; ?><br />
                <?php echo $this->l('Status') . ": $status"; ?><br />
              <?php if ($paidFee != 0):
                echo $this->l('Additional fee') . ": {$currency->sign}{$paidFee}";
              endif; ?><br />
                <?php if ($Reporte->DETALLE->OPERACIONES->OPERACION->MONTO  &&  abs($Reporte->DETALLE->OPERACIONES->OPERACION->MONTO - $totalToPay) > $this->delta) : ?>
                    <div class="warn">
                        <?php  echo $this->l('Warning: Order amount discrepancy, please check your Dineromail account for order ') .' '. $dmId;  ?><br />
                        <?php  echo $this->l('Total amount payed by customer:') .' '.$Reporte->DETALLE->OPERACIONES->OPERACION->MONTO;  ?>
                    </div>
                <?php endif; ?>
            </fieldset>
        <?php
        return ob_get_clean();
    }
    
    public function process()
    {
        $currency = $this->getCurrency();
        if ((int)$this->context->currency->id != (int)$currency->id) {
            $this->context->cookie->id_currency = $this->context->cart->id_currency = $this->context->currency->id = $currency->id;
            $this->context->cart->update();
        Tools::redirect(((int)$this->PSVER[0] < 2 && (int)$this->PSVER[1] < 5) ? "modules/{$this->name}/payment.php" : "index.php?fc=module&module={$this->name}&controller=payment");
        }
        $this->transactionId = Tools::substr( abs(ip2long($_SERVER['REMOTE_ADDR'])), 0, 10 ) . time();    //create a unique ID based on the current time and customer's IP address
        $this->storeTransaction($this->transactionId);
    }
    
    public function displayConfirm()
    {
        require_once 'API/dineromailAPI.php';
        if (!$this->context->cart->id)
            Tools::redirect(((int)$this->PSVER[0] < 2 && (int)$this->PSVER[1] < 5) ? 'order.php' : 'index.php?controller=order');
        $currentLang = $this->context->language->iso_code;
        $currentCustomer = New Customer((int)$this->context->cart->id_customer);
        $currentAddress = New Address((int)$this->context->cart->id_address_invoice);
        $shopCurrency = $this->getCurrency($this->context->cart->id_currency);
        $products = $this->context->cart->getProducts();
        $productsNum = count($products);
        $items = array();
        $productsCost = 0;
        for ($i=1; $i<=$productsNum; $i++) {    //Add all items to dineromail cart
            array_push($items, 
                array( "item_name_{$i}" => htmlspecialchars( !empty($products[$i-1]['legend']) ? $products[$i-1]['legend'] : $products[$i-1]['name']  .  (!empty($products[$i-1]['attributes_small']) ? (' ' . $products[$i-1]['attributes_small']) : '') ),
                    "item_quantity_{$i}" => $products[$i-1]['cart_quantity'],
                    "item_ammount_{$i}" => $products[$i-1]['price_wt']*100 ,
                    "item_currency_{$i}" => (in_array(Tools::strtolower($this->context->currency->iso_code), array('ars', 'mxn', 'clp', 'usd', 'brl')) ? Tools::strtolower($this->context->currency->iso_code) : '')
                    )
            );
            $productsCost += $products[$i-1]['price_wt']*$products[$i-1]['cart_quantity'];
        }
        $total = $this->context->cart->getOrderTotal(TRUE,  defined('Cart::BOTH_WITHOUT_SHIPPING') ? Cart::BOTH_WITHOUT_SHIPPING : 4);
        if ($total < $productsCost) {      //Voucher in effect
        	$i = 1;
            $itemName = $this->l('Order from').' '.Configuration::get('PS_SHOP_NAME');
            if (Tools::strlen($itemName)>100)
                $itemName = Tools::substr($itemName, 0, 100);
            $items = array( array( "item_name_{$i}" => $itemName,
                "item_quantity_{$i}" => 1,
                "item_ammount_{$i}" => $total*100,
                "item_currency_{$i}" => (in_array(Tools::strtolower($this->context->currency->iso_code), array('ars', 'mxn', 'clp', 'usd', 'brl')) ? Tools::strtolower($this->context->currency->iso_code) : '')
            ) );
            $i++;
        }
        $shippingCost = method_exists('Cart','getPackageShippingCost') ? $this->context->cart->getPackageShippingCost($this->context->cart->id_carrier) : $this->context->cart->getOrderShippingCost();
        if ($shippingCost > 0) {  //Add shipping cost as extra item on cart
            array_push($items, 
                array( "item_name_{$i}" => $this->l('Shipping cost'),
                    "item_quantity_{$i}" => 1,
                    "item_ammount_{$i}" => $shippingCost*100,
                    "item_currency_{$i}" => (in_array(Tools::strtolower($this->context->currency->iso_code), array('ars', 'mxn', 'clp', 'usd', 'brl')) ? Tools::strtolower($this->context->currency->iso_code) : '')
                    ) 
            );
            $i++;
        }
        $wrapping = $this->context->cart->getOrderTotal(TRUE, (defined('Cart::ONLY_WRAPPING') ? Cart::ONLY_WRAPPING : 6));
        if ($wrapping > 0) {
        	array_push($items, 
                array( "item_name_{$i}" => $this->l('Wrapping cost'),
                    "item_quantity_{$i}" => 1,
                    "item_ammount_{$i}" => Tools::ps_round((float)$wrapping, 2)*100,
                    "item_currency_{$i}" => (in_array(Tools::strtolower($this->context->currency->iso_code), array('ars', 'mxn', 'clp', 'usd', 'brl')) ? Tools::strtolower($this->context->currency->iso_code) : '')
                    ) 
            );
            $i++;
        }
        if ($this->getTotalWithFee(1, Configuration::get(self::CONFIG_PREFIX.'_FEE')) > 1) {      //Add optional merchant fee as extra item on cart
            $price = Tools::ps_round($this->getTotalWithFee($total+$shippingCost+$wrapping, Configuration::get(self::CONFIG_PREFIX.'_FEE')), 2);
            array_push($items,
                array( "item_name_{$i}" => $this->l('Payment method fee'),
                    "item_quantity_{$i}" => 1,
                    "item_ammount_{$i}" => Tools::ps_round((float)($price-($total+$shippingCost+$wrapping)), 2)*100,
                    "item_currency_{$i}" => (in_array(Tools::strtolower($this->context->currency->iso_code), array('ars', 'mxn', 'clp', 'usd', 'brl')) ? Tools::strtolower($this->context->currency->iso_code) : '')
                )
            );
            $i++;
        }
        $form = createForm(
            array( 'merchant' => Configuration::get(self::CONFIG_PREFIX.'_MERCHANT_ID'),
                'country_id' => Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID'),
                'seller_name' => htmlspecialchars(Configuration::get('PS_SHOP_NAME'))
                ),
            array( 'transaction_id' => $this->transactionId,
                'language' => (in_array(Tools::strtolower($currentLang), array('es', 'en', 'pt')) ? Tools::strtolower($currentLang) : 'en'),   //assign the cart language if permitted, else defaults to English
                'currency'=> (in_array(Tools::strtolower($this->context->currency->iso_code), array('ars', 'mxn', 'clp', 'usd', 'brl')) ? Tools::strtolower($this->context->currency->iso_code) : ''),    //assign the cart currency if permitted
                'payment_method_available' => $this->_encodePayments(),
                'buyer_name' => $currentCustomer->firstname,
                'buyer_lastname' => $currentCustomer->lastname,
                'buyer_email' => $currentCustomer->email,
                'buyer_phone' => $currentAddress->phone ? $currentAddress->phone : $currentAddress->phone_mobile,
                ),
            $items,
            array( 'ok_url' => (method_exists('Tools','getShopDomainSsl') ? Tools::getShopDomainSsl(true, true) : Tools::getHttpHost(true, true)) . __PS_BASE_URI__ . (((int)$this->PSVER[0] < 2 && (int)$this->PSVER[1] < 5) ? "modules/{$this->name}/validation.php?stat=ok&amp;cid={$this->context->cart->id}&amp;tid={$this->transactionId}" : "index.php?fc=module&amp;module={$this->name}&amp;controller=validation&amp;cid={$this->context->cart->id}&amp;tid={$this->transactionId}"),
                'error_url' => (method_exists('Tools','getShopDomainSsl') ? Tools::getShopDomainSsl(true, true) : Tools::getHttpHost(true, true)) . __PS_BASE_URI__ . "order.php",
                'pending_url' => (method_exists('Tools','getShopDomainSsl') ? Tools::getShopDomainSsl(true, true) : Tools::getHttpHost(true, true)) . __PS_BASE_URI__ . (((int)$this->PSVER[0] < 2 && (int)$this->PSVER[1] < 5) ? "modules/{$this->name}/validation.php?stat=pending&amp;cid={$this->context->cart->id}&amp;tid={$this->transactionId}" : "index.php?fc=module&amp;module={$this->name}&amp;controller=validation&amp;cid={$this->context->cart->id}&amp;tid={$this->transactionId}") )       //1.3.x Hacks
        );
        $smartyData = array('cartText' => $this->l('Cart'),
            'titleText' => $this->l('Your current order'),
            'loadingText' => $this->l('Please wait, you are now being redirected to Dineromail\'s payment system').'...',
            'loaderText' => $this->l('Loading').'...',
            'currencyText' => $this->l('Payments through this payment method must be made in ') . $shopCurrency->name,
            //'loader' => (method_exists('Tools','getShopDomainSsl') ? Tools::getShopDomainSsl(true, true) : Tools::getHttpHost(true, true)) . __PS_BASE_URI__ . "modules/{$this->name}/loader.gif",
            'dineromailForm' => $form,
        );
        if (((int)$this->PSVER[0] < 2 && (int)$this->PSVER[1] < 5)) {
            $this->context->smarty->assign($smartyData);
            return $this->display(__FILE__, 'views/templates/front/confirmation.tpl');
        }
        return $smartyData;
    }
    
    
    protected function createPaymentImage()     //Adds the logos of the enabled payment options to the "pay with Dineromail" button
    {
        if (!extension_loaded('gd'))        //bypass if GD Image Library is not installed
            return FALSE;
        $coords_array = array(      //horizontal coordinates for each logo in their respective image
            1 => array(
                'visa' => array(
                    'left' => 0,'right' => 41,'row' => 1,'payments' => array('ar_visa')
                ),
                'mastercard' => array(
                    'left' => 46,'right' => 82,'row' => 1,'payments' => array('ar_master')
                ),
                'argen' => array(
                    'left' => 88,'right' => 111,'row' => 1,'payments' => array('ar_argencard')
                ),
                'amex' => array(
                    'left' => 121,'right' => 142,'row' => 1,'payments' => array('ar_amex')
                ),
                'naranja' => array(
                    'left' => 150,'right' => 173,'row' => 1,'payments' => array('ar_tnaranja')
                ),
                'cabal' => array(
                    'left' => 181,'right' => 204,'row' => 1,'payments' => array('ar_cabal')
                ),
                'shopping' => array(
                    'left' => 211,'right' => 241,'row' => 1,'payments' => array('ar_tshopping')
                ),
                'italcred' => array(
                    'left' => 0,'right' => 28,'row' => 2,'payments' => array('ar_italcred')
                ),
                'pagofacil' => array(
                    'left' => 31,'right' => 58,'row' => 2,'payments' => array('ar_pagofacil')
                ),
                'rapipago' => array(
                    'left' => 61,'right' => 104,'row' => 2,'payments' => array('ar_rapipago')
                ),
                'cobroexpress' => array(
                    'left' => 105,'right' => 144,'row' => 2,'payments' => array('ar_cobroexpress')
                ),
                'bapropago' => array(
                    'left' => 145,'right' => 196,'row' => 2,'payments' => array('ar_bapropago')
                ),
                'ripsa' => array(
                    'left' => 199,'right' => 241,'row' => 2,'payments' => array('ar_ripsa')
                )
            ),
            2 => array(
                'visa' => array(
                    'left' => 10,'right' => 44,'row' => 1,'payments' => array('br_visa')
                ),
                'master' => array(
                    'left' => 51,'right' => 87,'row' => 1,'payments' => array('br_master')
                ),
                'diners' => array(
                    'left' => 92,'right' => 115,'row' => 1,'payments' => array('br_diners')
                ),
                'hipercard' => array(
                    'left' => 122,'right' => 155,'row' => 1,'payments' => array('br_hipercard')
                ),
                'amex' => array(
                    'left' => 163,'right' => 185,'row' => 1,'payments' => array('br_amex')
                ),
                'aura' => array(
                    'left' => 193,'right' => 227,'row' => 1,'payments' => array('br_aura')
                ),
                'oipaggo' => array(
                    'left' => 20,'right' => 49,'row' => 2,'payments' => array('br_oipaggo')
                ),
                'elo' => array(
                    'left' => 52,'right' => 74,'row' => 2,'payments' => array('br_bbancario',)
                ),
                'banco_brasil' => array(
                    'left' => 78,'right' => 99,'row' => 2,'payments' => array('br_bco_brasil_dd', 'br_bbancario')
                ),
                'bradesco' => array(
                    'left' => 103,'right' => 124,'row' => 2,'payments' => array('br_bco_bradesco_dd', 'br_bbancario')),
                'hsbc' => array(
                    'left' => 127,'right' => 153,'row' => 2,'payments' => array('br_bbancario')
                ),
                'banrisul' => array(
                    'left' => 159,'right' => 192,'row' => 2,'payments' => array('br_bbancario')
                ),
                'bancario' => array(
                    'left' => 197,'right' => 222,'row' => 2,'payments' => array('br_bbancario')
                )
            ),
            3 => array(
                'visa' => array(
                    'left' => 4,'right' => 43,'row' => 1,'payments' => array('cl_visa')
                ),
                'master' => array(
                    'left' => 48,'right' => 87,'row' => 1,'payments' => array('cl_master')
                ),
                'amex' => array(
                    'left' => 91,'right' => 115,'row' => 1,'payments' => array('cl_amex')
                ),
                'diners' => array(
                    'left' => 123,'right' => 149,'row' => 1,'payments' => array('cl_diners')
                ),
                'magna' => array(
                    'left' => 156,'right' => 195,'row' => 1,'payments' => array('cl_magna')
                ),
                'presto' => array(
                    'left' => 203,'right' => 233,'row' => 1,'payments' => array('cl_presto')
                ),
                'ripley' => array(
                    'left' => 1,'right' => 29,'row' => 2,'payments' => array('cl_ripley')
                ),
                'sencillito' => array(
                    'left' => 34,'right' => 81,'row' => 2,'payments' => array()
                ),
                'scotia' => array(
                    'left' => 84,'right' => 150,'row' => 2,'payments' => array('cl_servipag')
                ),
                'servipag' => array(
                    'left' => 156,'right' => 203,'row' => 2,'payments' => array('cl_servipag')
                ),
                'bci' => array(
                    'left' => 208,'right' => 240,'row' => 2,'payments' => array('cl_servipag')
                ),
            ),
            4 => array(
                'visa' => array(
                    'left' => 1,'right' => 32,'row' => 1,'payments' => array('mx_otherbank_tc')
                ),
                'mastercard' => array(
                    'left' => 33,'right' => 60,'row' => 1,'payments' => array('mx_otherbank_tc')
                ),
                'amex' => array(
                    'left' => 62,'right' => 80,'row' => 1,'payments' => array('mx_amex')
                ),
                'oxxo' => array(
                    'left' => 84,'right' => 109,'row' => 1,'payments' => array('mx_oxxo')
                ),
                'seven' => array(
                    'left' => 114,'right' => 131,'row' => 1,'payments' => array('mx_7eleven')
                ),
                'bbva' => array(
                    'left' => 138,'right' => 197,'row' => 1,'payments' => array('mx_bancomer_tc','mx_bancomer_tb','mx_bancomer_dr')
                ),
                'hsbc' => array(
                    'left' => 199,'right' => 240,'row' => 1,'payments' => array('mx_hsbc_td','mx_hsbc_tb')
                ),
                'banamex' => array(
                    'left' => 1,'right' => 49,'row' => 2,'payments' => array('mx_banamex_td')
                ),
                'bajio' => array(
                    'left' => 51,'right' => 83,'row' => 2,'payments' => array()
                ),
                'santander' => array(
                    'left' => 85,'right' => 141,'row' => 2,'payments' => array('mx_santander_td','mx_santander_tc','mx_santander_tb','mx_santander_dr')
                ),
                'ixe' => array(
                    'left' => 145,'right' => 177,'row' => 2,'payments' => array('mx_ixe_tc','mx_ixe_tb','mx_ixe_dr')
                ),
                'scotia' => array(
                    'left' => 181,'right' => 241,'row' => 2,'payments' => array('mx_scotiabank_tc','mx_scotiabank_tb','mx_scotiabank_dr')
                )
                /*
                'mx_banorte_td',
                */
            )
        );
        
        $payments = $this->_getPaymentConfig();
        $logoRows = array(1=>array(), 2=>array());
        $logoWidths = array(1=>0, 2=>0);
        foreach ($coords_array[Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID')] as $key => $logo) {
            if (count(array_intersect($logo['payments'], $payments)))  {
                if ($logoWidths[1]+$logo['right']-$logo['left'] > 230  OR  count($logoRows[2])) {
                    $logoRows[2] += array($key=>$logo);
                    $logoWidths[2] += $logo['right']-$logo['left'];
                } else {
                    $logoRows[1] += array($key=>$logo);
                    $logoWidths[1] += $logo['right']-$logo['left'];
                }
            }
        }
        if (!count($logoRows[2]))
            array_pop($logoRows);
        $rowHeight = 26;
        $width = 244;
        $height = 38+$rowHeight*count($logoRows);
        $rectTop = 17;
        $rectBottom = $height-2;
        $rectLeft = 1;
        $rectRight = $width - $rectLeft;
        $radius = 10;
        $rectBrace = 48;
        $img = imagecreatetruecolor($width, $height);
        $bgcolor = imagecolorallocate($img, 255, 255, 255);
        $rectcolor = imagecolorallocate($img, 50, 50, 255);
        $dmlogo = imagecreatefromjpeg(_PS_MODULE_DIR_."{$this->name}/img/dineromail-or.jpg");
        imagefill($img, 0, 0, $bgcolor);
        imagecopy($img, $dmlogo, 1+($width-imagesx($dmlogo))/2, 0, 0, 8, imagesx($dmlogo), imagesy($dmlogo)-8);
        $logoBox = imagecreatetruecolor(240, $rowHeight*count($logoRows));
        imagefill($logoBox, 0, 0, $bgcolor);
        $logoMap = imagecreatefromgif(_PS_MODULE_DIR_."{$this->name}/img/medios".Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID').'.gif');
        foreach ($logoRows as $num => $row) {
            $logoSpacing = (int)((240-$logoWidths[$num])/count($row));
            $position = (int)($logoSpacing/2);
            foreach ($row as $logo) {
                imagecopy($logoBox, $logoMap, $position, ($num-1)*$rowHeight, $logo['left'], ($logo['row']-1)*$rowHeight, $logo['right']-$logo['left'], $rowHeight);
                $position += $logo['right']-$logo['left']+$logoSpacing;
            }
        }
        imagecopy($img, $logoBox, 2, $rectTop+16, 0, 0, imagesx($logoBox), imagesy($logoBox));
        imagesetthickness($img, 2);
        imageline($img, $rectLeft+$radius, $rectTop, $rectLeft+$rectBrace, $rectTop, $rectcolor);
        imageline($img, $rectRight-$rectBrace, $rectTop, $rectRight-$radius, $rectTop, $rectcolor);
        imageline($img, $rectLeft+$radius, $rectBottom, $rectRight-$radius, $rectBottom, $rectcolor);
        imageline($img, $rectLeft, $rectTop+$radius, $rectLeft, $rectBottom-$radius, $rectcolor);
        imageline($img, $rectRight, $rectTop+$radius, $rectRight, $rectBottom-$radius, $rectcolor);
        imagearc($img, $rectLeft+$radius, $rectTop+$radius, $radius*2, $radius*2, 180, 270, $rectcolor);
        imagearc($img, $rectRight-$radius, $rectTop+$radius, $radius*2, $radius*2, 270, 360, $rectcolor);
        imagearc($img, $rectLeft+$radius, $rectBottom-$radius, $radius*2, $radius*2, 90, 180, $rectcolor);
        imagearc($img, $rectRight-$radius, $rectBottom-$radius, $radius*2, $radius*2, 360, 90, $rectcolor);
        imagejpeg($img, _PS_MODULE_DIR_."{$this->name}/img/dineromail.jpg", 85);
    }

    /**
     * @param $transactionId
     * @return bool
     */
    public function storeTransaction($transactionId)    //store transaction details in DB
    {
        return Db::getInstance()->Execute('
			REPLACE INTO `' . _DB_PREFIX_ . self::DM_TABLE . '` (`transaction_id`, `cart_id`)
			VALUES (' . pSQL($transactionId) . ', ' . $this->context->cart->id . ')'
        );
    }

    /**
     * @param $cart
     * @return bool
     */
    public function assignOrderToTransaction($cart)          //store new order id in DB
    {
        if ($orderId = Order::getOrderByCartId((int)$cart->id)) {
            return Db::getInstance()->Execute('
                UPDATE `' . _DB_PREFIX_ . self::DM_TABLE . '`
                SET `order_id` = ' . $orderId . ',
                `fee` = "' . Configuration::get(self::CONFIG_PREFIX.'_FEE') . '"
                WHERE `cart_id` = ' . (int)$cart->id
            );
        }
        return FALSE;
    }

    /**
     * @param string $transactionId
     * @param string $field     Options: order_id, cart_id
     * @return string
     */
    public function getFieldFromTransactionId($transactionId, $field)
    {
        return Db::getInstance()->getValue('SELECT `'.pSQL($field).'` FROM `' . _DB_PREFIX_ . self::DM_TABLE . '` WHERE `transaction_id` = "' . pSQL($transactionId) . '"');
    }


    /**
     * @param $orderId
     * @return array
     */
    public function queryTransactionData($transId) {
        require_once 'API/dineromailAPI.php';
        $accountData = array(
            'country_id'=>Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID'),
            'merchant'=>Configuration::get(self::CONFIG_PREFIX.'_MERCHANT_ID'),
            'password'=>Configuration::get(self::CONFIG_PREFIX.'_IPN_KEY')
        );
        $xml = queryTransaction($accountData, $transId);
        return $xml;
    }

    /**
     * Apply a fee to a payment amount
     * @param float $netAmount
     * @param string $fee (float with optional percent sign at the end)
     */
    public function getTotalWithFee($netAmount, $fee)
    {
        $fee = Tools::strlen($fee) ? $fee : '0';
        return strpos($fee, '%') ? $netAmount*(1+(float)Tools::substr($fee, 0, -1)/100) : $netAmount+(float)$fee;
    }


    /*
     *  $config ='["ar_amex","ar_argencard","ar_banktransfer","ar_bapropago","ar_cabal","ar_cobroexpress","ar_rapipago","ar_tnaranja","ar_tshopping","ar_visa","ar_ripsa"]';
     */
    protected function _getPaymentConfig()
    {
        $config = Configuration::get(self::CONFIG_PREFIX.'_PAYMENT_METHODS');
        return Tools::jsonDecode($config);
    }
    
    /*
     * $config ='[1,3,6,9,12,18]';
     */
    protected function _getInstallmentConfig()
    {
        $config = Configuration::get(self::CONFIG_PREFIX.'_INSTALLMENTS');
        return Tools::jsonDecode($config);
    }
    
    protected function _encodePayments()
    {
        $countryId = Configuration::get(self::CONFIG_PREFIX.'_COUNTRY_ID');
        $payments = $this->_getPaymentConfig();
        $installments = $this->_getInstallmentConfig();
        if (count($installments)<count($this->installmentsArray)) {
            foreach ($payments as $k=>$v) {
                $payments[$k] = in_array($v, $this->paymentsWithoutInstallments) ? $v : "$v,".implode(',', $installments);
            }
        }
        return implode(';', $payments);
    }
    
    
}
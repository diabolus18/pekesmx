<?php
/**
 * Dineromail IPN Payment Gateway Module for Prestashop
 * 
 *  @author Rinku Kazeno <development@kazeno.co>
 *  @file-version 1.3
 */


class DineromailValidationModuleFrontController extends ModuleFrontController
{
    public $display_header = false;
    public $display_footer = false;
    public $display_column_left = false;
    public $display_column_right = FALSE;
    public $ssl = true;

    protected $lock_handler;
    protected $lockActive = FALSE;
    
    public function initContent()
	{
        self::$initialized = true;
        $this->process();
        
        $dineromail = new Dineromail();
        if (Tools::getValue('cid') && Tools::getValue('tid')) {       //Customer came back from Dineromail's page after paying
            $cart = New Cart((int)Tools::getValue('cid'));
            $transactionId = pSQL(Tools::getValue('tid'));
            if (!$dineromail->getFieldFromTransactionId($transactionId,'order_id') && $this->lock() && !$cart->OrderExists() && !Order::getOrderByCartId($cart->id)) {
                Shop::setContext(Shop::getContext(), $cart->id_shop);
                ob_start();         //Catch 'Cart cannot be loaded or an order has already been placed using this cart' error
                $dineromail->validateOrder($cart->id, Configuration::get(Dineromail::CONFIG_PREFIX.'_WAIT_STATUS'), $cart->getOrderTotal(TRUE, Cart::BOTH, NULL, $cart->id_carrier), 'Dineromail', $cart->gift_message, array(), NULL, false, $cart->secure_key);
                ob_end_clean();
                $dineromail->assignOrderToTransaction($cart);
                $this->unlock();
            }
            Tools::redirect('index.php?controller=order-confirmation');
        } elseif (Tools::getValue('Notificacion')) {
            require_once(_PS_ROOT_DIR_.'/modules/dineromail/API/dineromailAPI.php');
            $xml = Tools::getValue('Notificacion');
            if (get_magic_quotes_gpc())
                $xml = Tools::stripslashes($xml);
            $operations = parseNotification($xml);
            foreach ($operations as $transactionId) {
                $transactionId = pSQL($transactionId);      //Just in case
                $orderId = $dineromail->getFieldFromTransactionId($transactionId,'order_id');
                if (!$orderId) {    //Dineromail's order notification came before customer returned to page
                    $cartId = $dineromail->getFieldFromTransactionId($transactionId, 'cart_id') OR die('Cart not registered');
                    $cart = New Cart((int)$cartId);
                    Shop::setContext(Shop::getContext(), $cart->id_shop);
                    if (!$dineromail->getFieldFromTransactionId($transactionId,'order_id') && $this->lock() && !$cart->OrderExists() && !Order::getOrderByCartId($cart->id)) {
                        $dineromail->validateOrder($cart->id, Configuration::get(Dineromail::CONFIG_PREFIX.'_WAIT_STATUS'), $cart->getOrderTotal(TRUE, Cart::BOTH, NULL, $cart->id_carrier), 'Dineromail', $cart->gift_message, array(), NULL, false, $cart->secure_key);
                        $dineromail->assignOrderToTransaction($cart);
                        $this->unlock();
                    }
                    $orderId = $dineromail->getFieldFromTransactionId($transactionId,'order_id');
                }
                $order = new Order($orderId);
                $fee = $dineromail->getFieldFromTransactionId($transactionId, 'fee');
                $totalToPay = $dineromail->getTotalWithFee($order->total_paid, $fee);
                $Reporte = $dineromail->queryTransactionData($transactionId);
                switch ($Reporte->DETALLE->OPERACIONES->OPERACION->ESTADO) {
                    case 1:
                        $status = 'Pending';
                        break;
                    case 2:
                        $status = 'Accepted';
                        if ($order->getCurrentState() == Configuration::get(Dineromail::CONFIG_PREFIX.'_WAIT_STATUS')) {        //Don't change status if it was changed manually before
                            if (abs($Reporte->DETALLE->OPERACIONES->OPERACION->MONTO - $totalToPay) > $dineromail->delta)
                                $order->setCurrentState(Configuration::get('PS_OS_ERROR'));                     //The payed amount doesn't match
                            else
                                $order->setCurrentState(Configuration::get('PS_OS_PAYMENT'));                   //All is well
                        }
                        break;
                    case 3:
                        $status = 'Denied';
                        $order->setCurrentState(Configuration::get('PS_OS_CANCELED'));
                        break;
                    default:
                        $status = 'Error querying Dineromail server';
                        break;
                }
            }
        }
    }

    /**
     *  Lock validator.lock file while we validate the order
     */
    protected function lock()
    {
        $this->lock_handler = fopen(_PS_MODULE_DIR_.Dineromail::MODULE_NAME.'/'.Dineromail::LOCK_FILE, 'w+');
        if(!flock($this->lock_handler, LOCK_EX)) {
            return FALSE;
        }
        $this->lockActive = TRUE;
        ftruncate($this->lock_handler, 0);
        fwrite($this->lock_handler, 'Locked at '.date(DATE_RFC2822)." \n");
        fflush($this->lock_handler);
        return TRUE;
    }

    /**
     *  Unlock validator.lock file after validating the order
     */
    protected function unlock()
    {
        if(!flock($this->lock_handler, LOCK_UN)) {
            return FALSE;
        }
        ftruncate($this->lock_handler, 0);
        $this->lockActive = FALSE;
        return TRUE;
    }

    /**
     *  redirect to store on 'Cart cannot be loaded or an order has already been placed using this cart' error
     */
    public function __destruct()
    {
        if ($this->lockActive) {
            $this->unlock();
        }
        $message = ob_get_clean();
        if (strpos($message, 'rder has already been placed') > 0) {
            Tools::redirect('index.php?controller=order-confirmation');
        }
    }
}

?>
<?php
/**
 * Dineromail IPN Payment Gateway Module for Prestashop
 * 
 *  @author Rinku Kazeno <development@kazeno.co>
 *  @file-version 1.8
 */

/**
 * This file is only for Prestashop versions 1.3.x and 1.4.x
 */

require_once(dirname(__FILE__) . '/../../config/config.inc.php');
require_once(dirname(__FILE__) . '/dineromail.php');

$dineromail = new Dineromail();

if (Tools::getValue('cid') && Tools::getValue('tid')) {       //Customer came back from Dineromail's page after paying
    $cart = New Cart((int)Tools::getValue('cid'));
    $secure_key = property_exists('Cart', 'secure_key') ? $cart->secure_key : 0;    //Hack for early Prestashop 1.3 versions
    if (!property_exists('Cart', 'secure_key') && !isset($cookie)) {                //Hack for early Prestashop 1.3 versions
        $cookie = new stdclass();
        $cookie->id_lang = (int)Configuration::get('PS_LANG_DEFAULT');
    }
    $dineromail->id_country = isset($dineromail->id_country) ? $dineromail->id_country : (method_exists('Country','getDefaultCountryId') ? (int)Country::getDefaultCountryId() : 0);      //Hack for Prestashop 1.4.1.0 and similar
    $transactionId = mysql_real_escape_string(Tools::getValue('tid'));    //SQL injections? not on MY watch
    if (!$dineromail->getFieldFromTransactionId($transactionId,'order_id')) {
        $dineromail->validateOrder($cart->id, Configuration::get(Dineromail::CONFIG_PREFIX.'_WAIT_STATUS'), $cart->getOrderTotal(), 'Dineromail', $cart->gift_message, array(), NULL, false, $secure_key);
        $dineromail->assignOrderToTransaction($cart);
    }
    $orderConfUri = (method_exists('Tools','getShopDomainSsl') ? Tools::getShopDomainSsl(true, true) : Tools::getHttpHost(true, true)) . __PS_BASE_URI__ . "order-confirmation.php?id_cart={$cart->id}&id_module={$dineromail->id}&id_order={$dineromail->currentOrder}&key={$secure_key}";
    header('Location: '.$orderConfUri);
exit;
}

if (Tools::getValue('Notificacion')) {        //Automatic Notification handler
    require_once 'API/dineromailAPI.php';
    $xml = Tools::getValue('Notificacion');
    if (get_magic_quotes_gpc())
        $xml = Tools::stripslashes($xml);
    $operations = parseNotification($xml);
    foreach ($operations as $transactionId) {
        $transactionId = mysql_real_escape_string($transactionId);      //Just in case
        $dineromail->id_country = isset($dineromail->id_country) ? $dineromail->id_country : (method_exists('Country','getDefaultCountryId') ? (int)Country::getDefaultCountryId() : 0);      //Hack for Prestashop 1.4.1.0 and similar
        $orderId = $dineromail->getFieldFromTransactionId($transactionId,'order_id');
        if (!$orderId) {    //Dineromail's order notification came before customer returned to page
			$cartId = $dineromail->getFieldFromTransactionId($transactionId, 'cart_id') OR die('Cart not registered');
            $cart = New Cart((int)$cartId);
            $secure_key = property_exists('Cart', 'secure_key') ? $cart->secure_key : 0;    //Hack for early Prestashop 1.3 versions
            if (!property_exists('Cart', 'secure_key') && !isset($cookie)) {                //Hack for early Prestashop 1.3 versions
                $cookie = new stdclass();
                $cookie->id_lang = (int)Configuration::get('PS_LANG_DEFAULT');
            }
            $dineromail->validateOrder($cart->id, Configuration::get(Dineromail::CONFIG_PREFIX.'_WAIT_STATUS'), $cart->getOrderTotal(), 'Dineromail', $cart->gift_message, array(), NULL, false, $secure_key);
            $dineromail->assignOrderToTransaction($cart);
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
                        setOrderState($order, 'PS_OS_ERROR');                     //The payed amount doesn't match
                    else
                        setOrderState($order, 'PS_OS_PAYMENT');                   //All is well
                }
                break;
            case 3:
                $status = 'Denied';
                setOrderState($order, 'PS_OS_CANCELED');
                break;
            default:
                $status = 'Error querying Dineromail server';
                break;
        }
    }
}


function setOrderState($order, $state)      //Add support for Prestashop version  < 1.3.7
{
    if (!method_exists('Order','setCurrentState')) {
        $history = new OrderHistory();
        $history->id_order = (int)$order->id;
        $history->changeIdOrderState(constant('_'.$state.'_'), (int)$order->id);
        if (!$history->addWithemail())
            return false;
    } else {
        if (!Configuration::get($state))
            Configuration::set($state, constant('_'.$state.'_'));
        $order->setCurrentState(Configuration::get($state));
    }
}

?>
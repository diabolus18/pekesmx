<?php
/**
 * Dineromail API interconnection and processing library for the IPN v2 interface
 * Written by Rinku Kazeno <development@kazeno.co>
 * Version 0.6
 * 
 * 
 * Sample format of XML notification:
 *  $_POST['Notificacion'] = 
        <?xml version='1.0' encoding='iso-8859-1'?>
        <notificacion>
            <tiponotificacion>1</tiponotificacion>
            <operaciones>
                <operacion>
                    <tipo>1</tipo>
                    <id>TRANSACTION_ID_1</id>
                </operacion>
                <operacion>
                    <tipo>1</tipo>
                    <id>TRANSACTION_ID_2</id>
                </operacion>
            </operaciones>
        </notificacion>
 *  
 *  
 * Sample format of XML response when requesting transaction data:
    <REPORTE>
        <ESTADOREPORTE>1</ESTADOREPORTE>
        <DETALLE>
            <OPERACIONES>
                <OPERACION>
                    <ID>TRANSACTION_ID</ID>
                    <FECHA>9/23/2011 12:45:03 PM</FECHA>
                    <ESTADO>2</ESTADO>
                    <NUMTRANSACCION>DINEROMAIL_TRANSACTION_NUMBER</NUMTRANSACCION>
                    <COMPRADOR>
                        <EMAIL>BUYER_EMAIL</EMAIL>
                        <DIRECCION />
                        <COMENTARIO />
                    </COMPRADOR>
                    <MONTO>TOTAL_PAYED</MONTO>
                    <MONTONETO>TOTAL_PAYED_WITH_FEES_DEDUCTED</MONTONETO>
                    <METODOPAGO>PAYMENT_METHOD_ID</METODOPAGO>
                    <ITEMS>
                        <ITEM>
                            <DESCRIPCION>ITEM_DESCRIPTION</DESCRIPCION>
                            <MONEDA>CURRENCY_ID</MONEDA>
                            <PRECIOUNITARIO>INIVIDUAL_PRICE</PRECIOUNITARIO>
                            <CANTIDAD>QUANTITY</CANTIDAD>
                        </ITEM>
                    </ITEMS>
                </OPERACION>
            </OPERACIONES>
        </DETALLE>
    </REPORTE>
 * 
 */

 
/**
 * @param $merchantData array( 'merchant', 'country_id', 'seller_name' ) [ASSOCIATIVE]
 * @param $transactionData array( 'transaction_id', 'language', 'currency', 'payment_method_available' ) [ASSOCIATIVE]
 * @param $productArray array(  ASSOCIATIVE array( 'item_name', 'item_quantity', 'item_ammount' ), ...  ) [NUMERIC]
 * @param $callbacks array( 'ok_url', 'error_url', 'pending_url' ) [ASSOCIATIVE]
 * @return STRING (html <form>)
 */
 
function createForm($merchantData, $transactionData, $productArray, $callbacks)
{
    $attributes = array_merge($merchantData, $transactionData, $callbacks, array('tool'=>'button', 'url_redirect_enabled'=>'1', 'change_quantity'=>'0'));
    ob_start();
    ?>
        <form id="dineromail_form" action="https://checkout.dineromail.com/CheckOut" method="post">
    <?php
    foreach($attributes as $name => $value) {
        ?>
            <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
        <?php
    }
    foreach($productArray as $item) {
        foreach($item as $name => $value) {
             ?>
                <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
            <?php
        }
    }
    ?>
        </form>
    <?php
    return ob_get_clean();
}


/**
 * Requests data about a particular transaction
 * 
 * @param $accountData array( 'country_id', 'merchant', 'password' ) [ASSOCIATIVE]
 * @return SimpleXMLElement object
 */
 
function queryTransaction($accountData, $transactionId)
{
    $subdomain = array(1 => 'argentina', 2 => 'brasil', 3 => 'chile', 4 => 'mexico');
    $url = "http://{$subdomain[$accountData['country_id']]}.dineromail.com/Vender/Consulta_IPN.asp";
    $data = "DATA=<REPORTE><NROCTA>{$accountData['merchant']}</NROCTA><DETALLE><CONSULTA><CLAVE>{$accountData['password']}</CLAVE><TIPO>1</TIPO><OPERACIONES><ID>{$transactionId}</ID></OPERACIONES></CONSULTA></DETALLE></REPORTE>";
    $url = parse_url($url);
    if ($fp = fsockopen($url['host'], 80)) {
        fwrite($fp, "POST {$url['path']} HTTP/1.1\r\n");
        fwrite($fp, "Host: {$url['host']}\r\n");
        fwrite($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fwrite($fp, "Content-length: " . Tools::strlen($data) . "\r\n");
        fwrite($fp, "Connection: close\r\n\r\n");
        fwrite($fp, $data);
        $result = '';
        while(!feof($fp)) {
            $result .= fgets($fp);
        }
        fclose($fp);
        $result = explode("\r\n\r\n", $result, 2);
        $header = isset($result[0]) ? $result[0] : '';
        $content = isset($result[1]) ? $result[1] : '';
        $xmlStart = strpos($content, '<?');
    return new SimpleXMLElement(Tools::substr($content, $xmlStart, strrpos($content, '>')-$xmlStart+1));
    } else
        return FALSE;
}


/**
 * Extracts the transaction ids from an IPN notification
 * 
 * @param $data: XML string (raw xml notification)
 * @return array( operation_ids )
 */
function parseNotification($data)
{
    $xmlStart = strpos($data, '<?');
    $notificacion = new SimpleXMLElement(Tools::substr($data, $xmlStart, strrpos($data, '>')-$xmlStart+1));
    $operations = array();
    foreach ($notificacion->operaciones->operacion as $operacion) {
        array_push($operations, $operacion->id);
    }
    return $operations;
}

/**
 * Get the Dineromail checkout output
 *
 * @param $postVars
 * @return SimpleXMLElement object
 */
function getTestCheckoutGui($postVars)
{
    $url = parse_url('https://checkout.dineromail.com/CheckOut');
    $data = http_build_query($postVars+array('tool'=>'button'));

    if ($fp = fsockopen('ssl://'.$url['host'], 443)) {
        fwrite($fp, "POST {$url['path']} HTTP/1.1\r\n");
        fwrite($fp, "Host: {$url['host']}\r\n");
        fwrite($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fwrite($fp, "Content-length: " . Tools::strlen($data) . "\r\n");
        fwrite($fp, "Connection: close\r\n\r\n");
        fwrite($fp, $data);
        $result = '';
        while(!feof($fp)) {
            $result .= fgets($fp);
        }
        fclose($fp);
        $result = explode("\r\n\r\n", $result, 2);
        $header = isset($result[0]) ? $result[0] : '';
        $content = isset($result[1]) ? $result[1] : '';
        $xmlStart = strpos($content, '<!');
        $doc = new DOMDocument();
        $doc->strictErrorChecking = FALSE;
        @$doc->loadHTML(Tools::substr($content, $xmlStart, strrpos($content, '>')-$xmlStart+1));
        return simplexml_import_dom($doc->getElementById('contenido-persiana'));
    } else
        return FALSE;
}
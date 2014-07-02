<?php
/*
 * Dineromail IPN Payment Gateway Module for Prestashop
 * 
 *  @author Rinku Kazeno <development@kazeno.co>
 *  @file-version 1.1
 */

/**
 * This file is only for Prestashop versions 1.3.x and 1.4.x
 */

require(dirname(__FILE__) . '/../../config/config.inc.php');
require(dirname(__FILE__) . '/../../init.php');
require(dirname(__FILE__) . '/dineromail.php');

if (!$cookie->isLogged(true))
    Tools::redirect('authentication.php?back=order.php');

$dineromail = new Dineromail();
$dineromail->process();

include(dirname(__FILE__) . '/../../header.php');
echo $dineromail->displayConfirm();
include_once(dirname(__FILE__) . '/../../footer.php');
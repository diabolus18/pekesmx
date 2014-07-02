<?php
/*
 * Dineromail IPN Payment Gateway Module for Prestashop
 * 
 *  @author Rinku Kazeno <development@kazeno.co>
 *  @file-version 1.0
 */

class DineromailPaymentModuleFrontController extends ModuleFrontController
{
	public $display_column_left = FALSE;
	public $ssl = TRUE;
    
    public function initContent()
	{
		parent::initContent();
    
        $dineromail = new Dineromail();
        $dineromail->process();
        $smartyData = $dineromail->displayConfirm();
        $this->context->smarty->assign($smartyData);
        $this->setTemplate('confirmation.tpl');
    }
}
 
?>
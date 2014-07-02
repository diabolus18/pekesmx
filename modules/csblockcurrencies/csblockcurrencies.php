<?php
/*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class CsBlockCurrencies extends Module
{
	public function __construct()
	{
		$this->name = 'csblockcurrencies';
		$this->tab = 'Other Modules';
		$this->version = 0.1;
		$this->author = 'codespot';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('CS Currency block');
		$this->description = $this->l('Adds a block allowing customers to choose their preferred shopping currency.');
	}

	public function install()
	{
		return parent::install() && $this->registerHook('displaytoptop') && $this->registerHook('header');
	}

	private function _prepareHook($params)
	{
		if (Configuration::get('PS_CATALOG_MODE'))
			return false;

		if (!count(Currency::getCurrencies()))
			return false;

		$this->smarty->assign('blockcurrencies_sign', $this->context->currency->sign);
	
		return true;
	}
	public function hookHeader($params)
	{
		if (Configuration::get('PS_CATALOG_MODE'))
			return;
		global $smarty;
		$smarty->assign(array(
			'HOOK_HEADER_TOP' => Hook::Exec('top')
		));
		$this->context->controller->addCSS(($this->_path).'blockcurrencies.css', 'all');
	}

	/**
	* Returns module content for header
	*
	* @param array $params Parameters
	* @return string Content
	*/
	public function hookDisplayToptop($params)
	{
		if ($this->_prepareHook($params))
			return $this->display(__FILE__, 'blockcurrencies.tpl');
	}
	
}



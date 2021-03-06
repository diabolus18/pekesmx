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

class csbannerClass extends ObjectModel
{
	/** @var integer reinsurance id*/
	public $id;
	
	/** @var integer reinsurance id shop*/
	public $id_shop;
	
	/** @var string reinsurance file name icon*/
	public $file_name;

	/** @var string reinsurance text*/
	public $text;
	/** @var string reinsurance link*/
	public $link;
	/** @var string reinsurance title*/
	public $title;


	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'csbanner',
		'primary' => 'id_banner',
		'multilang' => true,
		'fields' => array(
			'id_shop' =>				array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt', 'required' => true),
			'file_name' =>				array('type' => self::TYPE_STRING, 'validate' => 'isFileName'),
			'title' =>				array('type' => self::TYPE_STRING, 'validate' => 'isString'),
			// Lang fields
			'link'=>array('type' => self::TYPE_STRING, 'validate' => 'isUrl'),
			'text' =>					array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString', 'required' => false),
		)
	);

	public function copyFromPost()
	{
		/* Classical fields */
		foreach ($_POST AS $key => $value)
			if (key_exists($key, $this) AND $key != 'id_'.$this->table)
				$this->{$key} = $value;

		/* Multilingual fields */
		if (sizeof($this->fieldsValidateLang))
		{
			$languages = Language::getLanguages(false);
			foreach ($languages AS $language)
				foreach ($this->fieldsValidateLang AS $field => $validation)
					if (isset($_POST[$field.'_'.(int)($language['id_lang'])]))
						$this->{$field}[(int)($language['id_lang'])] = $_POST[$field.'_'.(int)($language['id_lang'])];
		}
	}
}

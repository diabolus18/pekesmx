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

if (!defined('_CAN_LOAD_FILES_'))
	exit;

include_once _PS_MODULE_DIR_.'csblockbanner/csbannerClass.php';

class CsBlockbanner extends Module
{
	public function __construct()
	{
		$this->name = 'csblockbanner';
		$this->tab = 'Other Modules';
		$this->version = '1.0';
		$this->author = 'codespot';
		$this->bootstrap = true;
		parent::__construct();

		$this->displayName = $this->l('CS Banners block');
		$this->description = $this->l('Adds an information block aimed at offering helpful information to reassure customers that your store is trustworthy.');
	}

	public function install()
	{
		return parent::install() &&
			$this->installDB() &&
			Configuration::updateValue('blockbanner_nbblocks', 5) &&
			$this->registerHook('homeleft') && $this->installFixtures();
	}
	
	public function installDB()
	{
		$return = true;
		$return &= Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'csbanner` (
				`id_banner` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`id_shop` int(10) unsigned NOT NULL ,
				`title` VARCHAR(100) NOT NULL,
				`file_name` VARCHAR(100) NOT NULL,
				`link` VARCHAR(100) NULL,
				PRIMARY KEY (`id_banner`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8 ;');
		
		$return &= Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'csbanner_lang` (
				`id_banner` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`id_lang` int(10) unsigned NOT NULL ,
				`text` VARCHAR(300) NOT NULL,
				PRIMARY KEY (`id_banner`, `id_lang`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8 ;');
		
		return $return;
	}

	public function uninstall()
	{
		// Delete configuration
		return Configuration::deleteByName('blockbanner_nbblocks') &&
			$this->uninstallDB() &&
			parent::uninstall();
	}

	public function uninstallDB()
	{
		return Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'csbanner`') && Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'csbanner_lang`');
	}
	
	
	
	public function addToDB()
	{
		if (isset($_POST['nbblocks']))
		{
			for ($i = 1; $i <= (int)$_POST['nbblocks']; $i++)
			{
				$filename = explode('.', $_FILES['info'.$i.'_file']['name']);
				if (isset($_FILES['info'.$i.'_file']) && isset($_FILES['info'.$i.'_file']['tmp_name']) && !empty($_FILES['info'.$i.'_file']['tmp_name']))
				{
					if ($error = ImageManager::validateUpload($_FILES['info'.$i.'_file']))
						return false;
					elseif (!($tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS')) || !move_uploaded_file($_FILES['info'.$i.'_file']['tmp_name'], $tmpName))
						return false;
					elseif (!ImageManager::resize($tmpName, dirname(__FILE__).'/img/'.$filename[0].'.jpg'))
						return false;
					unlink($tmpName);
				}
				Db::getInstance()->execute('INSERT INTO `'._DB_PREFIX_.'csbanner` (`filename`,`text`)
											VALUES ("'.((isset($filename[0]) && $filename[0] != '') ? pSQL($filename[0]) : '').
					'", "'.((isset($_POST['info'.$i.'_text']) && $_POST['info'.$i.'_text'] != '') ? pSQL($_POST['info'.$i.'_text']) : '').'")');
			}
			return true;
		} else
			return false;
	}

	public function removeFromDB()
	{
		$dir = opendir(dirname(__FILE__).'/img');
		while (false !== ($file = readdir($dir)))
		{
			$path = dirname(__FILE__).'/img/'.$file;
			if ($file != '..' && $file != '.' && !is_dir($file))
				unlink($path);
		}
		closedir($dir);

		return Db::getInstance()->execute('DELETE FROM `'._DB_PREFIX_.'csbanner`');
	}

	public function getContent()
	{
		$html = '';
		$id_banner = (int)Tools::getValue('id_banner');

		if (Tools::isSubmit('savecsblockbanner'))
		{
			if ($id_banner = Tools::getValue('id_banner'))
				$banner = new csbannerClass((int)$id_banner);
			else
				$banner = new csbannerClass();
			$banner->copyFromPost();
			$banner->id_shop = $this->context->shop->id;
			
			if ($banner->validateFields(false) && $banner->validateFieldsLang(false))
			{
				$banner->save();
				if (isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name']))
				{
					if ($error = ImageManager::validateUpload($_FILES['image']))
						return false;
					elseif (!($tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS')) || !move_uploaded_file($_FILES['image']['tmp_name'], $tmpName))
						return false;
					elseif (!ImageManager::resize($tmpName, dirname(__FILE__).'/img/banner-'.(int)$banner->id.'-'.(int)$banner->id_shop.'.jpg'))
						return false;
					unlink($tmpName);
					$banner->file_name = 'banner-'.(int)$banner->id.'-'.(int)$banner->id_shop.'.jpg';
					$banner->save();
				}
				$this->_clearCache('csblockbanner.tpl');
			}
			else
				$html .= '<div class="conf error">'.$this->l('An error occurred while attempting to save.').'</div>';
		}
		
		if (Tools::isSubmit('addcsblockbanner'))
		{
			$helper = $this->initForm();
			foreach (Language::getLanguages(false) as $lang)
				if ($id_banner)
				{
					$banner = new csbannerClass((int)$id_banner);
					$helper->fields_value['text'][(int)$lang['id_lang']] = $banner->text[(int)$lang['id_lang']];
					$helper->fields_value['link'] = $banner->link;
					$helper->fields_value['title']=$banner->title;
					
				}	
				else
				{
					$helper->fields_value['link'] = '';
					$helper->fields_value['title'] = '';
					$helper->fields_value['text'][(int)$lang['id_lang']] = Tools::getValue('text_'.(int)$lang['id_lang'], '');
				}
			if ($id_banner = Tools::getValue('id_banner'))
			{
				$this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_banner');
				$helper->fields_value['id_banner'] = (int)$id_banner;
 			}
				
			return $html.$helper->generateForm($this->fields_form);
		}
		
		if (Tools::isSubmit('updatecsblockbanner'))
		{
			$helper = $this->initFormUpdate();
			foreach (Language::getLanguages(false) as $lang)
				if ($id_banner)
				{
					
					/*show image*/
				
					$banner = new csbannerClass((int)$id_banner);
					
					$img_url=Tools::getMediaServer($this->name)._MODULE_DIR_.$this->name.'/img/'.$banner->file_name;
					$divImg='<div class="img_preview"><img src="'.$this->context->link->protocol_content.$img_url.'" width="100" alt=""/></div>';
					
					$helper->fields_value['text'][(int)$lang['id_lang']] = $banner->text[(int)$lang['id_lang']];
					$helper->fields_value['link'] = $banner->link;
					$helper->fields_value['title'] = $banner->title;
					
				}	
				else
					$helper->fields_value['text'][(int)$lang['id_lang']] = Tools::getValue('text_'.(int)$lang['id_lang'], '');
			if ($id_banner = Tools::getValue('id_banner'))
			{
				$this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_banner');
				$helper->fields_value['id_banner'] = (int)$id_banner;
 			}
				$js='<script type="text/javascript">
					$(\''.$divImg.'\').insertAfter(".dummyfile");
					$(".img_preview").css("float","left");
					$(".img_preview").css("margin-top","15px");
					$(".margin-form input:file").css("float","left");
			</script>';
			return $html.$helper->generateForm($this->fields_form).$js;
		}
		
		else if (Tools::isSubmit('deletecsblockbanner'))
		{
			$banner = new csbannerClass((int)$id_banner);
			if (file_exists(dirname(__FILE__).'/img/'.$banner->file_name))
				unlink(dirname(__FILE__).'/img/'.$banner->file_name);
			$banner->delete();
			$this->_clearCache('csblockbanner.tpl');
			Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}
		else
		{
			$helper = $this->initList();
			return $html.$helper->generateList($this->getListContent((int)Configuration::get('PS_LANG_DEFAULT')), $this->fields_list);
		}

		if (isset($_POST['submitModule']))
		{
			Configuration::updateValue('blockbanner_nbblocks', ((isset($_POST['nbblocks']) && $_POST['nbblocks'] != '') ? (int)$_POST['nbblocks'] : ''));
			if ($this->removeFromDB() && $this->addToDB())
			{
				$this->_clearCache('csblockbanner.tpl');
				$output = '<div class="conf confirm">'.$this->l('The block configuration has been updated.').'</div>';
			}
			else
				$output = '<div class="conf error"><img src="../img/admin/disabled.gif"/>'.$this->l('An error occurred while attempting to save.').'</div>';
		}
	}

	protected function getListContent($id_lang)
	{
		return  Db::getInstance()->executeS('
			SELECT r.*, rl.`text`
			FROM `'._DB_PREFIX_.'csbanner` r
			LEFT JOIN `'._DB_PREFIX_.'csbanner_lang` rl ON (r.`id_banner` = rl.`id_banner`)
			WHERE `id_lang` = '.(int)$id_lang.' '.Shop::addSqlRestrictionOnLang());
	}

	protected function initForm()
	{
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

		$this->fields_form[0]['form'] = array(
			'legend' => array(
				'title' => $this->l('New banner block.'),
			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Title:'),
					'name' => 'title'
				),
				array(
					'type' => 'file',
					'label' => $this->l('Image:'),
					'name' => 'image',
					'value' => true
				),
				array(
					'type' => 'text',
					'label' => $this->l('Link:'),
					'name' => 'link'
				),
				array(
					'type' => 'textarea',
					'label' => $this->l('Text:'),
					'lang' => true,
					'name' => 'text',
					'cols' => 40,
					'rows' => 10
				)
			),
			'submit' => array(
				'title' => $this->l('Save'),
			),
			'back'=> array(
				'title' => $this->l('Back to list'),
			),
		);

		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'csblockbanner';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		//$helper->show_cancel_button = true;
		foreach (Language::getLanguages(false) as $lang)
			$helper->languages[] = array(
				'id_lang' => $lang['id_lang'],
				'iso_code' => $lang['iso_code'],
				'name' => $lang['name'],
				'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
			);

		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->toolbar_scroll = true;
		$helper->title = $this->displayName;
		$helper->submit_action = 'savecsblockbanner';
		$helper->toolbar_btn =  array(
			'save' =>
			array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'back' =>
			array(
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
				'desc' => $this->l('Back to list')
			)
		);
		return $helper;
	}
	
	protected function initFormUpdate()
	{
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

		$this->fields_form[0]['form'] = array(
			'legend' => array(
				'title' => $this->l('Edit banner block.'),
			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Title:'),
					'name' => 'title'
				),
				array(
					'type' => 'file',
					'label' => $this->l('Image:'),
					'name' => 'image',
					'value' => true,					
				),
				array(
					'type' => 'text',
					'label' => $this->l('Link:'),
					'name' => 'link'
				),
				array(
					'type' => 'textarea',
					'label' => $this->l('Text:'),
					'lang' => true,
					'name' => 'text',
					'cols' => 40,
					'rows' => 10
				)
			),
			'submit' => array(
				'title' => $this->l('Save'),
			),
			'back'=> array(
				'title' => $this->l('Back to list'),
			),
		);

		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'csblockbanner';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		//$helper->show_cancel_button = true;
		foreach (Language::getLanguages(false) as $lang)
			$helper->languages[] = array(
				'id_lang' => $lang['id_lang'],
				'iso_code' => $lang['iso_code'],
				'name' => $lang['name'],
				'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
			);

		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->toolbar_scroll = true;
		$helper->title = $this->displayName;
		$helper->submit_action = 'savecsblockbanner';
		$helper->toolbar_btn =  array(
			'save' =>
			array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'back' =>
			array(
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
				'desc' => $this->l('Back to list')
			)
		);
		
		return $helper;
	}

	protected function initList()
	{
		$this->fields_list = array(
			'id_banner' => array(
				'title' => $this->l('Id'),
				'width' => 120,
				'type' => 'text',
			),
			'link' => array(
				'title' => $this->l('Link'),
				'width' => 140,
				'type' => 'text'
			),
			'title' => array(
				'title' => $this->l('Title'),
				'width' => 140,
				'type' => 'text'
			),
		);

		if (Shop::isFeatureActive())
			$this->fields_list['id_shop'] = array('title' => $this->l('ID Shop'), 'align' => 'center', 'width' => 25, 'type' => 'int');

		$helper = new HelperList();
		$helper->shopLinkType = '';
		$helper->simple_header = true;
		$helper->identifier = 'id_banner';
		$helper->actions = array('edit', 'delete');
		$helper->show_toolbar = true;
		$helper->imageType = 'jpg';		

		$helper->title = '<div class="panel-heading">
			Cs banners block
			<span class="panel-heading-action">
					<a class="list-toolbar-btn" href="index.php?controller=AdminModules&configure=csblockbanner&addcsblockbanner&token=5401b5e958d15a22eb1a8ec6d368cdc3"><span data-toggle="tooltip" class="label-tooltip" data-original-title="Add new tab" data-html="true"><i class="process-icon-new "></i></span></a>
					
			</span>
			</div>';
		$helper->toolbar_btn['new'] =  array(
			'href' => AdminController::$currentIndex.'&configure='.$this->name.'&add'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
			'desc' => $this->l('Add new')
		);
		$helper->table = $this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		return $helper;
	}

	public function hookHomeLeft($params)
	{
		// Check if not a mobile theme
		if ($this->context->getMobileDevice() != false)
			return false;

		$this->context->controller->addCSS($this->_path.'csblockbanner.css', 'all');
		
		if (version_compare(_PS_VERSION_,'1.5.4','<'))
		{
			$smarty_cache_id = $this->name.'|'.(int)Tools::usingSecureMode().'|'.(int)$this->context->shop->id.'|'.(int)Group::getCurrent()->id.'|'.(int)$this->context->language->id;
			$this->context->smarty->cache_lifetime = 31536000;
			Tools::enableCache();
		}
		else 
		{
			$smarty_cache_id = $this->getCacheId();
		}
		
		
		if (!$this->isCached('csblockbanner.tpl',$smarty_cache_id))
		{
			$infos = $this->getListContent($this->context->language->id);
			$this->context->smarty->assign(array('infos' => $infos, 'nbblocks' => count($infos)));
		}
		if (version_compare(_PS_VERSION_,'1.5.4','<'))
			Tools::restoreCacheSettings();
		return $this->display(__FILE__, 'csblockbanner.tpl', $smarty_cache_id);
	}

	public function installFixtures()
	{
		$return = true;
		$tab_texts = array(
			array('text' =>'', 'file_name' => 'banner-1-1.jpg','link'=>'#','title'=>'title1'),
			array('text' =>'', 'file_name' => 'banner-2-1.jpg','link'=>'#','title'=>'title2'),
			array('text' =>'', 'file_name' => 'banner-3-1.jpg','link'=>'#','title'=>'title3')
			
		);
		
		foreach($tab_texts as $tab)
		{
			$banner = new csbannerClass();
			foreach (Language::getLanguages(false) as $lang)
				$banner->text[$lang['id_lang']] = $tab['text'];
			$banner->file_name = $tab['file_name'];
			$banner->link = $tab['link'];
			$banner->title = $tab['title'];
			$banner->id_shop = $this->context->shop->id;
			$return &= $banner->save();
		}
		return $return;
	}
}

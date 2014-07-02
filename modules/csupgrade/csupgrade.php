<?php
/*
* 2007-2014 PrestaShop
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
*  @author Codespot SA <contact@prestashop.com>
*  @copyright  2007-2014 Codespot

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class csupgrade extends Module
{
	public function __construct()
	{
		$this->name = 'csupgrade';
		$this->tab = 'Other_modules';
		$this->version = '1.0';
		$this->author = 'codespot';
		$this->bootstrap = true;
		$this->need_instance = 0;
		parent::__construct();
		$this->displayName = $this->l('CS Upgrade');
		$this->description = $this->l('Upgrade database for modules of Codespot author.');
	}

	public function install()
	{
			return (parent::install());
	}

	public function uninstall()
	{
			return  parent::uninstall();
	}

	public function getContent()
	{
		$html = '';

		if (Tools::isSubmit('submitRunUpgrade'))
		{
			if (version_compare(_PS_VERSION_,'1.5','>'))
			{				
				if($this->upgradeCsModule())
					return $this->displayConfirmation($this->l('The database upgraded.'));
				else
					return $this->displayConfirmation($this->l('The database upgraded!'));
			}
			else
			{
				return $this->displayError($this->l('This module only use for prestashop 1.6.'));
			}
		}
		
		else
		{
			return $html.$this->renderForm();
		}

	}
	
	public function renderForm()
	{
	$output = '
		<form id="configuration_form" class="defaultForm  form-horizontal" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post" enctype="multipart/form-data" novalidate="">
				<input type="hidden" name="submitRunUpgrade" value="1">	
				<div class="panel" id="fieldset_0">		                    
					<div class="panel-heading">
						<i class="icon-cogs"></i> Cs Upgrade
					</div>
					<div class="panel-footer">
					<span>Please click <strong>Run Upgrade</strong> to upgrade database for modules of presthemes</span>
					<button type="submit" value="1" id="configuration_form_submit_btn" name="submitRunUpgrade" class="btn btn-default pull-right">
					<i class="process-icon-save"></i>'.$this->l('Run Upgrade').'
					</button>
					</div>			
				</div>
		</form>';	
		return $output;
	}
	
	public function upgradeCsModule()
	{	
		$check_runed=0;
		$return = true;
		$id_lang = $this->context->language->id;
		$languages = Language::getLanguages(false);
		$id_shop = Configuration::get('PS_SHOP_DEFAULT');
		if($check_runed==0)
		{
			/*upgrade csslider*/
			if(Module::isInstalled('csslider'))
			{
				if($this->checkColumnExists('csslider','id_slider'))
				{
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csslider`  CHANGE  COLUMN `id_slider` `id_csslider` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csslider_shop`  CHANGE  COLUMN `id_slider` `id_csslider` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csslider_caption`  CHANGE  COLUMN `id_slider` `id_csslider` INT( 10 ) UNSIGNED NOT NULL');
				}
				$return &=Db::getInstance()->Execute('CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'csslider_lang (`id_csslider` int(10) unsigned NOT NULL,`id_lang` int(10) unsigned NOT NULL, `id_shop` int(10) unsigned NOT NULL, `url` varchar(255), PRIMARY KEY (`id_csslider`, `id_lang`, `id_shop`)) ENGINE='._MYSQL_ENGINE_.' default CHARSET=utf8');
			
				$return &=Db::getInstance()->Execute('INSERT IGNORE INTO '._DB_PREFIX_.'csslider_lang (id_csslider, id_shop,url)
				SELECT id_csslider,id_shop,url FROM '._DB_PREFIX_.'csslider_shop');
		
				$return &=Db::getInstance()->Execute('UPDATE IGNORE '._DB_PREFIX_.'csslider_lang SET `id_lang`='.$id_lang.'');
				
				if(count($languages)>1)
				{
					foreach ($languages as $language)
					{
						if ($language['id_lang'] !=$id_lang)
						{
							$return &=Db::getInstance()->execute('
							INSERT IGNORE INTO '._DB_PREFIX_.'csslider_lang (id_csslider,id_lang,id_shop,url)
							SELECT id_csslider, '.(int)$language['id_lang'].',id_shop,url
							FROM '._DB_PREFIX_.'csslider_lang
							WHERE id_lang = '.(int)$id_lang);
							$return &=Db::getInstance()->Execute('UPDATE IGNORE '._DB_PREFIX_.'csslider_lang SET `url`="#" WHERE `id_lang` ='.$language['id_lang'].'');
						}
					}	
				}
				
			}
			/*upgrade csstaticblocks*/
			if(Module::isInstalled('csstaticblocks'))
			{
				if($this->checkColumnExists('staticblock','id_block'))
				{
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'staticblock`  CHANGE  COLUMN `id_block` `id_staticblock` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');
					
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'staticblock_lang`  CHANGE  COLUMN `id_block` `id_staticblock` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'staticblock_shop`  CHANGE  COLUMN `id_block` `id_staticblock` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');
				}
			}
			/*upgrade csmegamenu*/
			if(Module::isInstalled('csmegamenu'))
			{
				if($this->checkColumnExists('csmegamenu','id_menu'))
				{
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csmegamenu`  CHANGE  COLUMN `id_menu` `id_csmegamenu` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csmegamenu_shop`  CHANGE  COLUMN `id_menu` `id_csmegamenu` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csmegamenu_option`  CHANGE  COLUMN `id_menu` `id_csmegamenu` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');
					
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csmegamenu_option_shop`  CHANGE  COLUMN `id_menu` `id_csmegamenu` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');
					
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csmegamenu_lang`  CHANGE  COLUMN `id_menu` `id_csmegamenu` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');					
				}
				if($this->checkColumnExists('csmegamenu','link_of_title'))
				{
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csmegamenu_lang` ADD link_of_title varchar(1000)');
					
					$return &=Db::getInstance()->Execute('UPDATE IGNORE '._DB_PREFIX_.'csmegamenu_lang
						SET '._DB_PREFIX_.'csmegamenu_lang.link_of_title=(SELECT '._DB_PREFIX_.'csmegamenu_shop.link_of_title
						FROM '._DB_PREFIX_.'csmegamenu_shop
						WHERE '._DB_PREFIX_.'csmegamenu_shop.id_csmegamenu='._DB_PREFIX_.'csmegamenu_lang.id_csmegamenu AND '._DB_PREFIX_.'csmegamenu_shop.id_shop='._DB_PREFIX_.'csmegamenu_lang.id_shop)');
  
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csmegamenu` DROP COLUMN link_of_title');
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'csmegamenu_shop` DROP COLUMN link_of_title');
					
				}
				
			}
			/*upgrade csblog*/
			if(Module::isInstalled('csblog'))
			{
				if(!$this->checkColumnExists('cs_blog_category','level_depth'))
				{
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'cs_blog_category` ADD level_depth int(11) NOT NULL
					');
				}
				if(!$this->checkColumnExists('cs_blog_post_lang','description_short'))
				{
					$return &= Db::getInstance()->execute('
					ALTER TABLE `'._DB_PREFIX_.'cs_blog_post_lang` ADD description_short text NULL
					');
				}
				$return &= Db::getInstance()->execute('
				ALTER TABLE `'._DB_PREFIX_.'cs_blog_comment_lang` MODIFY content text NOT NULL
				');
				
				/*create table cs_blog_category_post*/
				$return &= Db::getInstance()->Execute('CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_category_post(
				id_cs_blog_category int(11) unsigned NOT NULL,
				id_cs_blog_post int(11) unsigned NOT NULL,
				PRIMARY KEY (`id_cs_blog_category`,`id_cs_blog_post`)
				) ENGINE='._MYSQL_ENGINE_.' default CHARSET=utf8');
				/*insert db for cs_blog_category_post*/
				$return &= Db::getInstance()->Execute('INSERT IGNORE INTO '._DB_PREFIX_.'cs_blog_category_post (id_cs_blog_post, id_cs_blog_category)
				SELECT cp.id_cs_blog_post,cc.id_cs_blog_category FROM '._DB_PREFIX_.'cs_blog_post cp, '._DB_PREFIX_.'cs_blog_category cc');
				/*registry hook for csblog module*/
				
				if(Module::isEnabled('csblog'))
				{
					$object = new CsBlog();
					$return &= $object->registerHook('footer');
					$return &= $object->registerHook('displayLeftColumn');
					$return &= $object->registerHook('displayRightColumn');
				}
				/**/
				$return &= Configuration::updateValue('CATEGORY_RSS_NUMBER', 10,false,null,$id_shop);
				$return &= Configuration::updateValue('CS_LASTEST_POST', 'displayLeftColumn',false,null,$id_shop);
				$return &= Configuration::updateValue('CS_DISPLAY_TAG', 'displayLeftColumn',false,null,$id_shop);
				$return &= Configuration::updateValue('CS_DISPLAY_CATEGORY', 'displayLeftColumn',false,null,$id_shop);
				$return &= Configuration::updateValue('CS_POSITION_CURRENT_COMMENT', 'displayLeftColumn',false,null,$id_shop);
				
				$this->moduleExceptionsBlogPage();
				$this->changeLinkBlog();
				
			}
			/*Set default Left Column*/
			$return &=Db::getInstance()->Execute('UPDATE IGNORE '._DB_PREFIX_.'theme SET `responsive`=1,`default_left_column`=1,`default_right_column`=0 WHERE `directory`="electronues"');
			$return &=Db::getInstance()->Execute('UPDATE IGNORE `'._DB_PREFIX_.'theme_meta` SET `right_column`=0');
			$return &=Db::getInstance()->Execute('UPDATE IGNORE `'._DB_PREFIX_.'theme_meta` SET `left_column`=0 WHERE `id_meta`=4');
			
			  
			if($return==true)
				$check_runed=1;		
		}
		return $return;
	}
	public function checkColumnExists($table_name, $column_name)
	{
		$sql = 'SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
				WHERE TABLE_SCHEMA = \''._DB_NAME_.'\'
				AND TABLE_NAME = \''._DB_PREFIX_.$table_name.'\'
				AND COLUMN_NAME = \''.$column_name.'\'';
		$column = Db::getInstance()->getValue($sql);
		$exists = ($column > 0)? true: false;
		return $exists;
	}
		
	public function moduleExceptionsBlogPage()
		{
			$id_shop = Configuration::get('PS_SHOP_DEFAULT');
			$listModule=array('blockcategories','blocklayered','blockviewed','blockmanufacturer','blocktags','blocksupplier','blocknewsletter','blockspecials','blockwishlist','blockadvertising');
			$return = '';
			foreach($listModule as $moduleName)
			{
				
				$moduleArr=Db::getInstance()->ExecuteS('
				  SELECT `id_module`
				  FROM `'._DB_PREFIX_.'module` WHERE `name`="'.$moduleName.'"');	 
				  $id_module=$moduleArr[0]['id_module']; 
				 $return &= Db::getInstance()->Execute('INSERT IGNORE INTO '._DB_PREFIX_.'hook_module_exceptions (id_hook_module_exceptions,id_shop,id_module,id_hook,file_name) VALUES
				  ("","'.$id_shop.'","'.$id_module.'",7,"module-csblog-categoryPost"),
				  ("","'.$id_shop.'","'.$id_module.'",7,"module-csblog-post"),
				  ("","'.$id_shop.'","'.$id_module.'",7,"module-csblog-rss"),
				  ("","'.$id_shop.'","'.$id_module.'",7,"module-csblog-tag");');
			}
		}
		
		public function changeLinkBlog()
		{
			$blog_link=$url = $this->context->link->getModuleLink("csblog","categoryPost");
			$menuArr=Db::getInstance()->ExecuteS('
					SELECT `id_csmegamenu`
					FROM `'._DB_PREFIX_.'csmegamenu_lang` WHERE `link_of_title` LIKE "%listpost%"');
			if(!empty($menuArr))
			{
				$return = '';
				foreach($menuArr as $menu)
				{
					$return &=Db::getInstance()->Execute('UPDATE IGNORE '._DB_PREFIX_.'csmegamenu_lang SET `link_of_title`="'.$blog_link.'" WHERE id_csmegamenu="'.$menu['id_csmegamenu'].'"');	
				}

			}  
		}
	

}

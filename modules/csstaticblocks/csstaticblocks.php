<?php
include_once(dirname(__FILE__).'/StaticBlockClass.php');
class csstaticblocks extends Module
{
	protected $error = false;
	private $_html;
	private $myHook = array('displayTop','displayLeftColumn','displayRightColumn','displayFooter','displayHome', 'csslideshow', 'displayfooterright','displayfooterbottom', 'csmegamenu','displaytoptop');
	
	public function __construct()
	{
	 	$this->name = 'csstaticblocks';
	 	$this->tab = 'MyBlocks';
	 	$this->version = '1.0';
		$this->author = 'Codespot';
		$this->bootstrap = true;
	 	parent::__construct();

		$this->displayName = $this->l('Cs Static block');
		$this->description = $this->l('Adds static blocks with free content');
		$this->confirmUninstall = $this->l('Are you sure that you want to delete your static blocks?');
	
	}
	public function init_data()
	{
		$content_block1 = '<div class="text_top"><span class="icon">tel</span>Support 24/7 1800 - 123xxxx <a href="#">My Company</a></div>';
		$content_block1_fr='<div class="text_top"><span class="icon">tel</span>Support 24/7 1800 - 123xxxx <a href="#">My Company</a></div>';
		
		$content_block2 = '<div class="logo_payment"><a class="brand-logo paypal" title="paypal" href="#"><span>paypal</span></a><a class="brand-logo visa" title="visa" href="#"><span>visa</span></a> <a class="brand-logo american" title="american express" href="#"><span>american</span></a> <a class="brand-logo master" title="master card" href="#"><span>master</span></a><a class="brand-logo skrill" title="skrill" href="#"><span>skrill</span></a></div>\r\n<p class="copy-right">© 2013 Electronues Market Demo Store . All Rights Reserved. PrestaShop design by <a href="#">Presthemes</a></p>';
		$content_block2_fr='<div class="logo_payment"><a class="brand-logo paypal" title="paypal" href="#"><span>paypal</span></a><a class="brand-logo visa" title="visa" href="#"><span>visa</span></a> <a class="brand-logo american" title="american express" href="#"><span>american</span></a> <a class="brand-logo master" title="master card" href="#"><span>master</span></a><a class="brand-logo skrill" title="skrill" href="#"><span>skrill</span></a></div>\r\n<p class="copy-right">© 2013 Electronues Market Demo Store . All Rights Reserved. PrestaShop design by <a href="#">Presthemes</a></p>';
		
		$content_block3 = '<p><a href="#"><img src="{static_block_url}themes/electronues/img/cms/217.jpg" alt="" /></a></p>\r\n<div>\r\n<h3 class="title1">Let&rsquo;s be friends</h3>\r\n<ul>\r\n<li><a href="http://www.facebook.com/"><span class="icon facebook">Find us on Facebook</span>Find us on Facebook</a></li>\r\n<li><a href="http://google.com"><span class="icon googleplus">Google</span>Google</a></li>\r\n<li><a href="#"><span class="icon rss">RSS Feed</span>RSS Feed</a></li>\r\n</ul>\r\n<ul>\r\n<li><a href="http://twitter.com/home"><span class="icon twitter">Fllow us on Twitter</span>Fllow us on Twitter</a></li>\r\n<li><a href="http://www.flickr.com/"><span class="icon flickr">Flick</span>Flick</a></li>\r\n<li><a href="http://vimeo.com/"><span class="icon vimeo">Vimeo</span>Vimeo</a></li>\r\n</ul>\r\n</div>';
		$content_block3_fr='<p><a href="#"><img src="{static_block_url}themes/electronues/img/cms/217.jpg" alt="" /></a></p>\r\n<div>\r\n<h3 class="title1">Let&rsquo;s be friends</h3>\r\n<ul>\r\n<li><a href="http://www.facebook.com/"><span class="icon facebook">Find us on Facebook</span>Find us on Facebook</a></li>\r\n<li><a href="http://google.com"><span class="icon googleplus">Google</span>Google</a></li>\r\n<li><a href="#"><span class="icon rss">RSS Feed</span>RSS Feed</a></li>\r\n</ul>\r\n<ul>\r\n<li><a href="http://twitter.com/home"><span class="icon twitter">Fllow us on Twitter</span>Fllow us on Twitter</a></li>\r\n<li><a href="http://www.flickr.com/"><span class="icon flickr">Flick</span>Flick</a></li>\r\n<li><a href="http://vimeo.com/"><span class="icon vimeo">Vimeo</span>Vimeo</a></li>\r\n</ul>\r\n</div>';
		$content_block4 ='<div class="grid_6 alpha"><a href="#"><img src="{static_block_url}themes/electronues/img/cms/banner1_1.jpg" alt="" width="280" height="210" /></a>\r\n<div class="banner_text">volup aculis</div>\r\n</div>\r\n<div class="grid_6"><a href="#"><img src="{static_block_url}themes/electronues/img/cms/banner2_1.jpg" alt="" width="280" height="210" /></a>\r\n<div class="banner_text">Pellent hend</div>\r\n</div>\r\n<div class="grid_6 omega"><a href="#"><img src="{static_block_url}themes/electronues/img/cms/banner3_1.jpg" alt="" width="280" height="210" /></a>\r\n<div class="banner_text">Aenea ligula</div>\r\n</div>';
		$content_block4_fr='<div class=\"grid_6 alpha\"><a href=\"#\"><img src=\"{static_block_url}themes/electronues/img/cms/banner1_1.jpg\" alt=\"\" width=\"280\" height=\"210\" /></a>\r\n<div class=\"banner_text\">volup aculis</div>\r\n</div>\r\n<div class=\"grid_6\"><a href=\"#\"><img src=\"{static_block_url}themes/electronues/img/cms/banner2_1.jpg\" alt=\"\" width=\"280\" height=\"210\" /></a>\r\n<div class=\"banner_text\">Pellent hend</div>\r\n</div>\r\n<div class=\"grid_6 omega\"><a href=\"#\"><img src=\"{static_block_url}themes/electronues/img/cms/banner3_1.jpg\" alt=\"\" width=\"280\" height=\"210\" /></a>\r\n<div class=\"banner_text\">Aenea ligula</div>\r\n</div>';
		$content_block5 ='<div class="link_home"><a href="?controler=index"><span class="icon home">home</span>Home electronues</a></div>';
		$content_block5_fr ='<div class="link_home"><a href="?controler=index"><span class="icon home">home</span>Home electronues</a></div>';
		
		$hook_toptop = Hook::getIdByName('displaytoptop');
		$hook_footerbottom = Hook::getIdByName('displayfooterbottom');
		$hook_footerright = Hook::getIdByName('displayfooterright');
		$hook_slideshow = Hook::getIdByName('csslideshow');
		$hook_top = Hook::getIdByName('displayTop');
		
		$id_en = Language::getIdByIso('en');
		$id_fr = Language::getIdByIso('fr');		
		
		$id_shop = Configuration::get('PS_SHOP_DEFAULT');
		if(!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'staticblock` (`id_staticblock`, `identifier_block`, `hook`, `is_active`)
		VALUES (1, "support","'.$hook_toptop.'", 1),
				(2, "allright_payment","'.$hook_footerbottom.'", 1),
				(3, "be_friend","'.$hook_footerright.'", 1),
				(4, "banner-home","'.$hook_slideshow.'", 1),
				(5, "link_home","'.$hook_top.'", 1);') OR
		/* Install Static Block _shop*/
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'staticblock_shop` (`id_staticblock`, `id_shop`, `is_active`)
			VALUES 	(1,'.$id_shop.', 1),
					(2,'.$id_shop.', 1),
					(3,'.$id_shop.', 1),
					(4,'.$id_shop.', 1),
					(5,'.$id_shop.', 1);') OR
		/*static block lang*/
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'staticblock_lang` (`id_staticblock`, `id_lang`, `id_shop`, `title`, `content`)
		VALUES 
			( "1", "'.$id_en.'","'.$id_shop.'","support", \''.$content_block1.'\'),
			( "1", "'.$id_fr.'","'.$id_shop.'","support", \''.$content_block1_fr.'\'),
			( "2", "'.$id_en.'","'.$id_shop.'","All Right + Payment", \''.$content_block2.'\'),
			( "2", "'.$id_fr.'","'.$id_shop.'","All Right + Payment", \''.$content_block2_fr.'\'),
			( "3", "'.$id_en.'","'.$id_shop.'","Let\' be friend", \''.$content_block3.'\'),
			( "3","'.$id_fr.'","'.$id_shop.'","Let\'s be friend", \''.$content_block3_fr.'\'),
			( "4", "'.$id_en.'","'.$id_shop.'","Banner Home", \''.$content_block4.'\'),
			( "4", "'.$id_fr.'","'.$id_shop.'","Banner Home", \''.$content_block4_fr.'\'),
			( "5", "'.$id_en.'","'.$id_shop.'","Link Home", \''.$content_block5.'\'),
			( "5", "'.$id_fr.'","'.$id_shop.'","Link Home", \''.$content_block5_fr.'\');')
		)
		
			return false;
		return true;
		
	}
	
	
	
	public function install()
	{		
	 	if (parent::install() == false OR !$this->registerHook('header') OR !$this->registerHook('actionShopDataDuplication'))
	 		return false;
		foreach ($this->myHook AS $hook){
			if ( !$this->registerHook($hook))
				return false;
		}
	 	if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'staticblock (`id_staticblock` int(10) unsigned NOT NULL AUTO_INCREMENT, `identifier_block` varchar(255) NOT NULL DEFAULT \'\', `hook` int(10) unsigned, `is_active` tinyint(1) NOT NULL DEFAULT \'1\', PRIMARY KEY (`id_staticblock`),UNIQUE KEY `identifier_block` (`identifier_block`)) ENGINE=InnoDB default CHARSET=utf8'))
	 		return false;
		if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'staticblock_shop (`id_staticblock` int(10) unsigned NOT NULL,`id_shop` int(10) unsigned NOT NULL,`is_active` tinyint(1) NOT NULL DEFAULT \'1\',PRIMARY KEY (`id_staticblock`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8'))
	 		return false;
		if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'staticblock_lang (`id_staticblock` int(10) unsigned NOT NULL, `id_lang` int(10) unsigned NOT NULL,`id_shop` int(10) unsigned NOT NULL, `title` varchar(255) NOT NULL DEFAULT \'\', `content` mediumtext, PRIMARY KEY (`id_staticblock`,`id_lang`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8'))
	 		return false;
		$this->init_data();
	 	return true;
	}
	
	public function uninstall()
	{
		
	 	if (parent::uninstall() == false)
	 		return false;
	 	if (!Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'staticblock') OR !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'staticblock_shop') OR !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'staticblock_lang'))
	 		return false; 
		foreach($this->myHook as $hook)
		{
			$this->clearCacheBlockForHook($hook);
		}
	 	return true;
	}
	
	private function _displayHelp()
	{
		$this->_html .= '
		<br/>
	 	<fieldset>
			<legend><img src="'.$this->_path.'logo.gif" alt="" title="" /> '.$this->l('Static block Helper').'</legend>
			<div>'.$this->l('This module customize static contents on the site. Static contents are displayed at the position of the hook : top, left, home,right, footer.').'</div>
		</fieldset>';
	}
	
	public function getContent()
   	{
		global $currentIndex;
		$this->_postProcess();
		if (Tools::isSubmit('addBlock') || Tools::isSubmit('editBlock') || Tools::isSubmit('saveBlock'))
			$this->initForm();
		else
			$this->_displayForm();
		$this->_displayHelp();
		return $this->_html;
	}
	
	private function _postProcess()
	{
		global $currentIndex;
		$errors = array();
		if (Tools::isSubmit('saveBlock'))
		{
			$block = new StaticBlockClass(Tools::getValue('id_staticblock'));
			$block->copyFromPost();
			$errors = $block->validateController();		
			if (sizeof($errors))
			{
				$this->_html .= $this->displayError(implode('<br />', $errors));
			}
			else
			{
				Tools::getValue('id_staticblock') ? $block->update() : $block->add();
				$this->clearCacheBlockForHook(Tools::getValue('hook'));
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&saveBlockConfirmation');
			}
		}
		elseif (Tools::isSubmit('changeStatusStaticblock') AND Tools::getValue('id_staticblock'))
		{
			$stblock = new StaticBlockClass(Tools::getValue('id_staticblock'));
			$stblock->updateStatus(Tools::getValue('status'));
			$this->clearCacheBlockForHook(Tools::getValue('hook'));
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}
		elseif (Tools::isSubmit('deleteBlock') AND Tools::getValue('id_staticblock'))
		{
			$block = new StaticBlockClass(Tools::getValue('id_staticblock'));
			$block->delete();
			$this->clearCacheBlockForHook(Tools::getValue('hook'));
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteBlockConfirmation');
		}
		elseif (Tools::isSubmit('saveBlockConfirmation'))
			$this->_html = $this->displayConfirmation($this->l('Static block has been saved successfully'));
		elseif (Tools::isSubmit('deleteBlockConfirmation'))
			$this->_html = $this->displayConfirmation($this->l('Static block deleted successfully'));
		
	}
	
	private  function clearCacheBlockForHook($hook)
	{
		
		$this->_clearCache('csstaticblocks_'.strtolower($this->getHookName($hook)).'.tpl');
	}
	 private function getHookName($id_hook,$name=false)
	{
		if (!$result = Db::getInstance()->getRow('
		SELECT `name`,`title`
		FROM `'._DB_PREFIX_.'hook` 
		WHERE `id_hook` = '.(int)($id_hook)))
			return false;
		return $result['name'];
	}
	private function getBlocks()
	{
		$this->context = Context::getContext();
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
	 	if (!$result = Db::getInstance()->ExecuteS(
			'SELECT b.id_staticblock, b.identifier_block, b.hook, bs.is_active, bl.`title`, bl.`content` 
			FROM `'._DB_PREFIX_.'staticblock` b 
			LEFT JOIN `'._DB_PREFIX_.'staticblock_shop` bs ON (b.`id_staticblock` = bs.`id_staticblock` )
			LEFT JOIN `'._DB_PREFIX_.'staticblock_lang` bl ON (b.`id_staticblock` = bl.`id_staticblock`'.( $id_shop ? 'AND bl.`id_shop` = '.$id_shop : ' ' ).') 
			WHERE bl.id_lang = '.(int)$id_lang.
			( $id_shop ? ' AND bs.`id_shop` = '.$id_shop : ' ' )))
	 		return false;
	 	return $result;
	}
	
	private function getHookTitle($id_hook,$name=false)
	{
		if (!$result = Db::getInstance()->getRow('
			SELECT `name`,`title`
			FROM `'._DB_PREFIX_.'hook` 
			WHERE `id_hook` = '.(int)($id_hook)))
			return false;
		return (($result['title'] != "" && $name) ? $result['title'] : $result['name']);
	}
	
	
	
	
	private function _displayForm()
	{
		global $currentIndex, $cookie;
	 	$this->_html .= '
	 	<div class="panel">
			<div class="panel-heading">
			'.$this->l('Static blocks').'
			<span class="panel-heading-action">
					<a class="list-toolbar-btn" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&addBlock"><span data-toggle="tooltip" class="label-tooltip" data-original-title="'.$this->l('Add new block').'" data-html="true"><i class="process-icon-new "></i></span></a>
					
			</span>
			</div>
			<table width="100%" class="table" cellspacing="0" cellpadding="0">
			<thead>
			<tr class="nodrag nodrop">
				<th>'.$this->l('ID').'</th>
				<th class="center">'.$this->l('Title').'</th>
				<th class="center">'.$this->l('Identifier').'</th>
				<th class="center">'.$this->l('Hook into').'</th>
				<th class="right">'.$this->l('Active').'</th>
			</tr>
			</thead>
			<tbody>';
		$s_blocks = $this->getBlocks();
		if (is_array($s_blocks))
		{
			static $irow;
			foreach ($s_blocks as $block)
			{
				$this->_html .= '
				<tr class="'.($irow++ % 2 ? 'alt_row' : '').'">
					<td class="pointer" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editBlock&id_staticblock='.$block['id_staticblock'].'\'">'.$block['id_staticblock'].'</td>
					<td class="pointer center" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editBlock&id_staticblock='.$block['id_staticblock'].'\'">'.$block['title'].'</td>
					<td class="pointer center" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editBlock&id_staticblock='.$block['id_staticblock'].'\'">'.$block['identifier_block'].'</td>
					<td class="pointer center" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editBlock&id_staticblock='.$block['id_staticblock'].'\'">'.(Validate::isInt($block['hook']) ? $this->getHookTitle($block['hook']) : '').'</td>
					<td class="pointer center"> <a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&changeStatusStaticblock&id_staticblock='.$block['id_staticblock'].'&status='.$block['is_active'].'&hook='.$block['hook'].'">'.($block['is_active'] ? '<i class="icon-check"></i>' : '<i class="icon-remove"></i>').'</a> </td>
				</tr>';
			}
		}
		$this->_html .= '
			</tbody>
			</table>
		</div>';
			
		
	}
	public function getHookList()
	{
		$hooks = array();
		
		foreach($this->myHook as $key=>$hook)
		{
			$id_hook = Hook::getIdByName($hook);
			$name_hook = $this->getHookTitle($id_hook);
			$hooks[$key]['key']= $id_hook;
			$hooks[$key]['name']= $name_hook;
		}
		return $hooks;
	}
	
	
	public function initForm()
	{
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$hooks = $this->getHookList();
		$this->fields_form[0]['form'] = array(
					'tinymce' => true,
					'legend' => array(
					'title' => $this->l('Block item'),
			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Title'),
					'lang' => true,
					'name' => 'title',
					'cols' => 40,
					'rows' => 10
					
				),
				array(
					'type' => 'text',
					'label' => $this->l('Identifier'),
					'name' => 'identifier_block',
					'cols' => 40,
					'rows' => 10,
					'hint' => $this->l('Identifier must be unique').'. '.$this->l('Match a-zA-Z-_0-9')
					
				),
				array(
					'type' => 'select',
					'label' => $this->l('Hook into'),
					'name' => 'hook',
					'options' => array(
						'query' => $hooks, 
						'id' => 'key',
						'name' => 'name'
					)
					
				),
				array(
						'type' => 'switch',
						'label' => $this->l('Displayed'),
						'name' => 'is_active',
						'values' => array(
									array(
										'id' => 'is_active_on',
										'value' => 1,
										'label' => $this->l('Enabled')
									),
									array(
										'id' => 'is_active_off',
										'value' => 0,
										'label' => $this->l('Disabled')
									)
						),
			  ),
			  array(
					'type' => 'textarea',
					'label' => $this->l('Content'),
					'name' => 'content',
					'lang' => true,
					'autoload_rte' => true,
					'cols' => 40,
					'rows' => 10
				),
			),
			'submit' => array(
				'title' => $this->l('Save'),
			)
		);
		
		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'csstaticblocks';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->show_cancel_button = true;
		$helper->back_url = AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules');
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
		$helper->submit_action = 'saveBlock';
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
		
		$id_staticblock = Tools::getValue('id_staticblock');
		if (Tools::isSubmit('id_staticblock') && $id_staticblock)
		{
			$block = new StaticBlockClass((int)$id_staticblock);
			$this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_staticblock');
			$helper->fields_value['id_staticblock'] = (int)Tools::getValue('id_staticblock', $block->id_staticblock);	
		}
		else
			$block = new StaticBlockClass();
		foreach (Language::getLanguages(false) as $lang)
		{
			$helper->fields_value['title'][(int)$lang['id_lang']] = Tools::getValue('title_'.(int)$lang['id_lang'],$block->title[(int)$lang['id_lang']]);
			$helper->fields_value['content'][(int)$lang['id_lang']] =  Tools::getValue('content_'.(int)$lang['id_lang'],$block->content[(int)$lang['id_lang']]);
		}
		$helper->fields_value['identifier_block'] = Tools::getValue('identifier_block',$block->identifier_block);
			
		$helper->fields_value['hook'] = Tools::getValue('hook',$block->hook);
		$helper->fields_value['is_active'] = Tools::getValue('is_active',$block->is_active);
		$this->_html .= $helper->generateForm($this->fields_form);
	}
	
	
	public function contentById($id_staticblock)
	{
		global $cookie;

		$staticblock = new StaticBlockClass($id_staticblock);
		return ($staticblock->is_active ? $staticblock->content[(int)$cookie->id_lang] : '');
	}
	
	public function contentByIdentifier($identifier)
	{
		global $cookie;

		if (!$result = Db::getInstance()->getRow('
			SELECT `id_staticblock`,`identifier_block`
			FROM `'._DB_PREFIX_.'staticblock` 
			WHERE `identifier_block` = \''.$identifier.'\''))
			return false;
		$staticblock = new StaticBlockClass($result['id_staticblock']);
		return ($staticblock->is_active ? $staticblock->content[(int)$cookie->id_lang] : '');
	}
	
	private function getBlockInHook($hook_name)
	{
		$block_list = array();
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_hook = Hook::getIdByName($hook_name);
		if ($id_hook)
		{
			$results = Db::getInstance()->ExecuteS('SELECT b.`id_staticblock` FROM `'._DB_PREFIX_.'staticblock` b
			LEFT JOIN `'._DB_PREFIX_.'staticblock_shop` bs ON (b.id_staticblock = bs.id_staticblock)
			WHERE bs.is_active = 1 AND (bs.id_shop = '.(int)$id_shop.') AND b.`hook` = '.(int)($id_hook));
			foreach ($results as $row)
			{
				$temp = new StaticBlockClass($row['id_staticblock']);
				$block_list[] = $temp;
			}
		}	
		
		return $block_list;
	}
	
	function hookHeader($params)
	{
		global $smarty;
		$smarty->assign(array(
			'HOOK_CS_FOOTER_RIGHT' => Hook::Exec('displayfooterright'),
			'HOOK_CS_FOOTER_BOTTOM' => Hook::Exec('displayfooterbottom'),
			'HOOK_CS_TOP_TOP' => Hook::Exec('displaytoptop')
		));
	}
	
	
	public function hookDisplayTopTop()
	{
		global $smarty, $cookie;
		
		$smarty_cache_id = $this->getCacheId('csstaticblocks');
		
		if (!$this->isCached('csstaticblocks_displaytoptop.tpl', $smarty_cache_id))
		{
		$block_list = $this->getBlockInHook('displaytoptop');
		
		$smarty->assign(array(
			'block_list' => $block_list
		));
		}
		
		return $this->display(__FILE__, 'csstaticblocks_displaytoptop.tpl',$smarty_cache_id);
	}
	
	public function hookDisplayTop()
	{
		global $smarty, $cookie;
		
		$smarty_cache_id = $this->getCacheId('csstaticblocks');
		
		if (!$this->isCached('csstaticblocks_displaytop.tpl', $smarty_cache_id))
		{
		$block_list = $this->getBlockInHook('displayTop');
		
		$smarty->assign(array(
			'block_list' => $block_list
		));
		}
		
		return $this->display(__FILE__, 'csstaticblocks_displaytop.tpl',$smarty_cache_id);
	}
	
	public function hookDisplayLeftColumn()
	{
		global $smarty, $cookie;
		
		$smarty_cache_id = $this->getCacheId('csstaticblocks');
		
		if (!$this->isCached('csstaticblocks_displayleftcolumn.tpl',$smarty_cache_id))
		{
		$block_list = $this->getBlockInHook('displayleftColumn');
		
		$smarty->assign(array(
			'block_list' => $block_list
		));
		}
		
		return $this->display(__FILE__, 'csstaticblocks_displayleftcolumn.tpl', $smarty_cache_id);
	}
	
	public function hookDisplayRightColumn()
	{
		global $smarty, $cookie;
		
		$smarty_cache_id = $this->getCacheId('csstaticblocks');
		
		if (!$this->isCached('csstaticblocks_displayrightcolumn.tpl',$smarty_cache_id))
		{
		$block_list = $this->getBlockInHook('displayrightColumn');
		
		$smarty->assign(array(
			'block_list' => $block_list
		));
		}
		
		return $this->display(__FILE__, 'csstaticblocks_displayrightcolumn.tpl',$smarty_cache_id);
	}
	
	public function hookDisplayFooter()
	{
		global $smarty, $cookie;
		
		$smarty_cache_id = $this->getCacheId('csstaticblocks');
		
		if (!$this->isCached('csstaticblocks_displayfooter.tpl',$smarty_cache_id))
		{
			$block_list = $this->getBlockInHook('displayfooter');
			$smarty->assign(array(
				'block_list' => $block_list
			));
		}
		
		return $this->display(__FILE__, 'csstaticblocks_displayfooter.tpl',$smarty_cache_id);
	}
	
	public function hookDisplayHome()
	{
		global $smarty, $cookie;
		
		$smarty_cache_id = $this->getCacheId('csstaticblocks');
		
		if (!$this->isCached('csstaticblocks_displayhome.tpl',$smarty_cache_id))
		{
			$block_list = $this->getBlockInHook('displayhome');
			$smarty->assign(array(
				'block_list' => $block_list
			));
		}
		return $this->display(__FILE__, 'csstaticblocks_displayhome.tpl', $smarty_cache_id);
	}
	public function hookCsSlideshow()
	{
		global $smarty, $cookie;
		
		$smarty_cache_id = $this->getCacheId('csstaticblocks');
		
		if (!$this->isCached('csstaticblocks_csslideshow.tpl',$smarty_cache_id))
		{
			$block_list = $this->getBlockInHook('csslideshow');
			
			$smarty->assign(array(
				'block_list' => $block_list
			));
		}
		return $this->display(__FILE__, 'csstaticblocks_csslideshow.tpl',$smarty_cache_id);
	}
	public function hookDisplayFooterRight()
	{
		global $smarty, $cookie;
		
		$smarty_cache_id = $this->getCacheId('csstaticblocks');
		
		if (!$this->isCached('csstaticblocks_displayfooterright.tpl',$smarty_cache_id))
		{
			$block_list = $this->getBlockInHook('displayfooterright');
			
			$smarty->assign(array(
				'block_list' => $block_list
			));
		}
		return $this->display(__FILE__, 'csstaticblocks_displayfooterright.tpl',$smarty_cache_id);
	}
	
	public function hookDisplayFooterBottom()
	{
		global $smarty, $cookie;
		
		$smarty_cache_id = $this->getCacheId('csstaticblocks');
		
		if (!$this->isCached('csstaticblocks_displayfooterbottom.tpl',$smarty_cache_id))
		{
			$block_list = $this->getBlockInHook('displayfooterbottom');
			
			$smarty->assign(array(
				'block_list' => $block_list
			));
		}
		return $this->display(__FILE__, 'csstaticblocks_displayfooterbottom.tpl',$smarty_cache_id);
	}
	public function hookCsMegaMenu()
	{
		global $smarty, $cookie;
		
		$smarty_cache_id = $this->getCacheId('csstaticblock');
		
		if (!$this->isCached('csstaticblock_megamenu.tpl',$smarty_cache_id))
		{
			$block_list = $this->getBlockInHook('csmegamenu');
			
			$smarty->assign(array(
				'block_list' => $block_list
			));
		}
		return $this->display(__FILE__, 'csstaticblock_megamenu.tpl',$smarty_cache_id);
	}
	
	protected function getCacheId($name = null)
	{
		global $cookie;
		
		if (version_compare(_PS_VERSION_,'1.5.4','<'))
		{
				
			$smarty_cache_id = $name.'|'.(int)Tools::usingSecureMode().'|'.(int)$this->context->shop->id.'|'.(int)Group::getCurrent()->id.'|'.(int)$this->context->language->id;
			$this->context->smarty->cache_lifetime = 31536000;
			Tools::enableCache();
			return $smarty_cache_id;
		}
		else 
		{
			parent::getCacheId($name);

			$groups = implode(', ', Customer::getGroupsStatic((int)$this->context->customer->id));
			$id_lang = (int)$this->context->language->id;
			
			return $name.'|'.(int)Tools::usingSecureMode().'|'.$this->context->shop->id.'|'.$groups.'|'.$id_lang;
			
		}	
	}
	
	public function hookActionShopDataDuplication($params)
	{
		//duplicate static block for shop
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'staticblock_shop (id_staticblock, id_shop, is_active)
		SELECT id_staticblock, '.(int)$params['new_id_shop'].', is_active
		FROM '._DB_PREFIX_.'staticblock_shop
		WHERE id_shop = '.(int)$params['old_id_shop']);
		
		//duplicate hometab language for shop
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'staticblock_lang (id_staticblock, id_lang, id_shop, title, content)
		SELECT id_staticblock, id_lang, '.(int)$params['new_id_shop'].', title, content
		FROM '._DB_PREFIX_.'staticblock_lang
		WHERE id_shop = '.(int)$params['old_id_shop']);
	}
}
?>

<?php
include_once(dirname(__FILE__).'/TabClass.php');

class CsHomeTab extends Module
{
	private $_html;
	private $product_types = array("featured_products" => "Featured Products","special_products" => "Special Products","topseller_products" => "Top Seller Products","new_products" => "New Products","choose_the_category" => "Choose the Category...");
	
	public function __construct()
	{
	 	$this->name = 'cshometab';
	 	$this->tab = 'MyBlocks';
	 	$this->version = '1.0';
		$this->author = 'CodeSpot';
		$this->bootstrap = true;
	 	parent::__construct();

		$this->displayName = $this->l('CS Products Filter');
		$this->description = $this->l('Add Filter Products on the homepage');
		$this->confirmUninstall = $this->l('Are you sure that you want to delete your CS Product Fillter?');

	}
	
	public function init_data()
	{
		$id_en = Language::getIdByIso('en');
		$id_fr = Language::getIdByIso('fr');
		$id_shop = Configuration::get('PS_SHOP_DEFAULT');
		
		if(!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cshometab` (`id_tab`, `product_type`, `position`, `display`) VALUES 
				(1, "new_products", 0, 1),
				(2, "choose_the_category_2", 0, 1)
		') OR
		
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cshometab_shop` (`id_tab`, `id_shop`, `product_type`, `position`, `display`) VALUES 
		(1, 1, "new_products", 0, 1),
		(2, 1, "choose_the_category_2", 1, 1)
		') OR
		
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cshometab_lang` (`id_tab`, `id_lang`, `id_shop`, `title`) VALUES 
		(1, "'.$id_en.'", 1, "New Arrivals"),
		(1, "'.$id_fr.'", 1, "Nouveautés"),
		(2, "'.$id_en.'", 1, "Computers"),
		(2, "'.$id_fr.'", 1, "Computers")
		;
		')
		)
			return false;
		return true;
	}
	
	public function install()
	{
	 	if (parent::install() == false OR
		!$this->registerHook('displayHeader') OR
		!$this->registerHook('displayHome') OR
		!$this->registerHook('actionObjectProductUpdateAfter') OR
		!$this->registerHook('actionObjectProductDeleteAfter') OR
		!$this->registerHook('actionObjectProductAddAfter') OR
		!$this->registerHook('actionUpdateQuantity') OR
		!$this->registerHook('actionProductAdd') OR
		!$this->registerHook('actionProductDelete') OR
		!$this->registerHook('actionProductUpdate') 
		)
	 	return false;
		if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'cshometab (`id_tab` int(10) unsigned NOT NULL AUTO_INCREMENT, `product_type` varchar(255), `position` int(10) unsigned DEFAULT \'0\', `display` tinyint(1) NOT NULL DEFAULT \'1\', PRIMARY KEY (`id_tab`)) ENGINE=InnoDB default CHARSET=utf8'))
	 		return false;
		if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'cshometab_shop (`id_tab` int(10) unsigned NOT NULL ,`id_shop` int(10) unsigned NOT NULL,`product_type` varchar(255), `position` int(10) unsigned DEFAULT \'0\', `display` tinyint(1) NOT NULL DEFAULT \'1\', PRIMARY KEY (`id_tab`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8'))
	 		return false;
		if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'cshometab_lang (`id_tab` int(10) unsigned NOT NULL, `id_lang` int(10) unsigned NOT NULL,`id_shop` int(10) unsigned NOT NULL, `title` varchar(255) NOT NULL DEFAULT \'\', PRIMARY KEY (`id_tab`,`id_lang`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8'))
	 		return false;
		$this->init_data();
	 	return true;
	}
	
	public function uninstall()
	{
	 	if (parent::uninstall() == false)
	 		return false;
		if (!Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'cshometab') OR !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'cshometab_shop') OR  !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'cshometab_lang'))
	 		return false;
	 	return true;
	}
	
	private function _displayHelp()
	{
		$this->_html .= '
	 	<div class="panel">
			<h3>'.$this->l('CS Home Products Helper').'</h3>
			<div>
			<p>'.$this->l('You can add a new Block which get product from : Featured Products, Special products, Top Seller Products, New Products or choose the Category.').'</p>
			</div>
		</div>';
	}
	
	private function _displayOptions()
	{
		$id = (int)Context::getContext()->shop->id;
		$id_shop = $id ? $id: Configuration::get('PS_SHOP_DEFAULT');
		if (file_exists(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml'))
			$option = simplexml_load_file(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml');
		else	
			$option = simplexml_load_file(dirname(__FILE__).'/'.'option_'.Configuration::get('PS_SHOP_DEFAULT').'.xml');
		$effects = explode(",", $option->effect);
		$this->_html .= '
	 	<div class="panel">
			<h3>'.$this->l('Config Options').'</h3>
			<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" enctype="multipart/form-data">
			<div class="form-group">
			<label class="control-label col-lg-3 ">'.$this->l('Products Displayed:').'</label>
			<div class="col-lg-9">
				<input type="text" name="numProduct" value="'.($option->numProduct ? $option->numProduct : 10).'" />
				<p class="help-block">'.$this->l('Number of products to be displayed').'</p>
			</div>
			</div>
			
			<div style="display:none">
			<label>'.$this->l('Use Tab:').'</label>
			<div class="margin-form">
				<input type="radio" name="js_tab" value="true" '.($option->js_tab != "false" ? 'checked="checked"' : '').' />
				<label class="t"><i class="icon-check"></i></label>
				<input type="radio" name="js_tab" value="false" '.($option->js_tab == "false" ? 'checked="checked"' : '').' />
				<label class="t"><i class="icon-remove"></i></label>
				<p class="clear">'.$this->l('Enable jquery tabs').'</p>
				<div class="clear"></div>
			</div>
			
			
			<label>'.$this->l('Use Scrolling Panel:').'</label>
			<div class="margin-form">
				<input type="radio" name="scrollPanel" value="true" '.($option->scrollPanel != "false" ? 'checked="checked"' : '').' />
				<label class="t"><i class="icon-check"></i></label>
				<input type="radio" name="scrollPanel" value="false" '.($option->scrollPanel == "false" ? 'checked="checked"' : '').' />
				<label class="t"><i class="icon-remove"></i></label>
				<p class="clear">'.$this->l('Enable jquery carouFredSel').'</p>
				<div class="clear"></div>
			</div>
			<label>'.$this->l('Show:').'</label>
			<div class="margin-form">
				<input type="text" name="show" value="'.($option->show ? $option->show : 3).'" />
				<p class="clear">'.$this->l('Number of items to show from the list/ Number of items <strong>max</strong> on a line').'</p>
				<div class="clear"></div>
			</div>
			</div>
			<div style="text-align:center">';
				$this->_html .= '
				<input type="submit" class="btn btn-default" name="applyOptions" value="'.$this->l('Apply').'" id="applyOptions" />';
				$this->_html .= '					
			</div>';
		$this->_html .= '
			</form>
		</div>
		';
	}

	public function getContent()
   	{
		$this->_postProcess();
		if (Tools::isSubmit('addTab') || Tools::isSubmit('editTab') || Tools::isSubmit('saveTab'))
			$this->initForm();
		else
		{
			$this->_displayForm();
			$this->_displayOptions();
		}
		
		$this->_displayHelp();
		
		return $this->_html;
	}
	
	private function saveXmlOption($reset = false)
	{
		$error = false;
		
		$newXml = '<?xml version=\'1.0\' encoding=\'utf-8\' ?>'."\n".'<options>'."\n";
		
		$newXml .= '<js_tab>';
		$newXml .= Tools::getValue('js_tab');
		$newXml .= '</js_tab>'."\n";
		
		$newXml .= '<numProduct>';
		$newXml .= Tools::getValue('numProduct');
		$newXml .= '</numProduct>'."\n";
		
		$newXml .= '<scrollPanel>';
		$newXml .= Tools::getValue('scrollPanel');
		$newXml .= '</scrollPanel>'."\n";
		
		$newXml .= '<show>';
		$newXml .= Tools::getValue('show');
		$newXml .= '</show>'."\n";
		
		$newXml .= '</options>'."\n";
		if (Shop::getContext() != Shop::CONTEXT_SHOP)
		{
			foreach (Shop::getContextListShopID() as $id_shop)
			{
				if ($fd = @fopen(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml', 'w'))
				{
					if (!@fwrite($fd, $newXml))
						$error = $this->displayError($this->l('Unable to write to the editor file.'));
					if (!@fclose($fd))
						$error = $this->displayError($this->l('Can\'t close the editor file.'));
				}
				else
					$error = $this->displayError($this->l('Unable to update the editor file. Please check the editor file\'s writing permissions.'));
			}
		}
		else
		{
			$this->context = Context::getContext();
			$id_shop = $this->context->shop->id;
			if ($fd = @fopen(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml', 'w'))
				{
					if (!@fwrite($fd, $newXml))
						$error = $this->displayError($this->l('Unable to write to the editor file.'));
					if (!@fclose($fd))
						$error = $this->displayError($this->l('Can\'t close the editor file.'));
				}
				else
					$error = $this->displayError($this->l('Unable to update the editor file. Please check the editor file\'s writing permissions.'));
		}
		
		return $error;
	}
	
	private function _postProcess()
	{
		global $currentIndex;
		$errors = array();
		if (Tools::isSubmit('saveTab'))
		{
			$this->_clearCache('cshometab.tpl');
			$tab = new TabClass(Tools::getValue('id_tab'));
			
			$tab->copyFromPost();
			
			$errors = $tab->validateController();
						
			if (sizeof($errors))
			{
				$this->_html .= $this->displayError(implode('<br />', $errors));
			}
			else
			{
				Tools::isSubmit('id_tab') ? $tab->update() : $tab->add();
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&saveTabConfirmation');
			}
		}
		elseif (Tools::isSubmit('deleteTab') AND Tools::getValue('id_tab'))
		{
			$this->_clearCache('cshometab.tpl');
			$tab = new TabClass(Tools::getValue('id_tab'));
			$tab->delete();
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteTabConfirmation');
		}
		elseif (Tools::isSubmit('orderTab') AND Validate::isInt(Tools::getValue('id_tab')) AND Validate::isInt(Tools::getValue('myposition')))
		{			
			$this->_clearCache('cshometab.tpl');
			$tab = new TabClass(Tools::getValue('id_tab'));
			$tab->updatePosition(Tools::getValue('way'),Tools::getValue('myposition'));
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}
		elseif (Tools::isSubmit('applyOptions'))
		{
			$this->_clearCache('cshometab.tpl');
			if ($error = $this->saveXmlOption())
				$this->_html .= $error;
			else
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&statusConfirmation');
		}
		elseif (Tools::isSubmit('changeStatusTab') AND Tools::getValue('id_tab'))
		{
			$this->_clearCache('cshometab.tpl');
			$tab = new TabClass(Tools::getValue('id_tab'));
			$tab->updateStatus(Tools::getValue('status'));
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}
		elseif (Tools::isSubmit('saveTabConfirmation'))
			$this->_html = $this->displayConfirmation($this->l('Tab has been saved successfully'));
		elseif (Tools::isSubmit('deleteTabConfirmation'))
			$this->_html = $this->displayConfirmation($this->l('Tab deleted successfully'));
		elseif (Tools::isSubmit('statusConfirmation'))
			$this->_html = $this->displayConfirmation($this->l('Options updated successfully'));
	}
	
	private function getTabs($active = null) //case in : allshop show shop default
	{
		$this->context = Context::getContext();
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
	 	if (!$result = Db::getInstance()->ExecuteS(
			'SELECT ts.*, tl.`title`
			FROM `'._DB_PREFIX_.'cshometab` t
			LEFT JOIN `'._DB_PREFIX_.'cshometab_shop` ts ON (ts.`id_tab` = t.`id_tab` )
			LEFT JOIN `'._DB_PREFIX_.'cshometab_lang` tl ON (t.`id_tab` = tl.`id_tab` '.( $id_shop ? 'AND tl.`id_shop` = '.$id_shop : ' ' ).') 
			WHERE tl.id_lang = '.(int)$id_lang.
			($active ? ' AND ts.`display` = 1' : ' ').
			( $id_shop ? 'AND ts.`id_shop` = '.$id_shop : ' ' ).'
			ORDER BY ts.`position` ASC'))
	 		return false;
	 	return $result;
	}
	
	private function _displayForm()
	{
		global $currentIndex, $cookie;
		
	 	$this->_html .= '
	 	<div class="panel">
			<div class="panel-heading">
			'.$this->l('Cs Home tab').'
			<span class="panel-heading-action">
					<a class="list-toolbar-btn" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&addTab"><span data-toggle="tooltip" class="label-tooltip" data-original-title="'.$this->l('Add new tab').'" data-html="true"><i class="process-icon-new "></i></span></a>
					
			</span>
			</div>
			<table width="100%" class="table" cellspacing="0" cellpadding="0">
			<thead>
			<tr class="nodrag nodrop">
				<th>'.$this->l('Id').'</th>
				<th class="center">'.$this->l('Title').'</th>
				<th class="center">'.$this->l('Get Product from').'</th>
				<th class="center">'.$this->l('Displayed').'</th>
				<th class="center">'.$this->l('Position').'</th>
				<th class="center">'.$this->l('Delete').'</th>
			</tr>
			</thead>
			<tbody>';
		$tabs = $this->getTabs(false);
		if (is_array($tabs))
		{
			static $irow;
			$number = 1;
			
			foreach ($tabs as $tab)
			{
				$stringConfirm='onclick="if (!confirm(\'Are you sure that you want to delete item tab id = '.$tab['id_tab'].' ?\')) return false "';
				$this->_html .= '
				<tr class="'.($irow++ % 2 ? 'alt_row' : '').'">
					<td class="pointer" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editTab&id_tab='.$tab['id_tab'].'\'">'.$tab['id_tab'].'</td>
					<td class="pointer center" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editTab&id_tab='.$tab['id_tab'].'\'">'.$tab['title'].'</td>
					<td class="pointer center" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editTab&id_tab='.$tab['id_tab'].'\'">'.$tab['product_type'].'</td>
					<td class="pointer center"> <a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&changeStatusTab&id_tab='.$tab['id_tab'].'&status='.$tab['display'].'">'.($tab['display'] ? '<i class="icon-check"></i>' : '<i class="icon-remove"></i>').'</a> </td><td class="pointer center">'.($tab !== end($tabs) ? '<a class="btn btn-default btn-xs" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&orderTab&id_tab='.$tab['id_tab'].'&way=1&myposition='.($tab['position']+1).'"><i class="icon-chevron-down"></i></a>' : '').($tab !== reset($tabs) ? '<a class="btn btn-default btn-xs" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&orderTab&id_tab='.$tab['id_tab'].'&way=0&myposition='.($tab['position']-1).'"><i class="icon-chevron-up"></i></a>' : '').'</td><td class="pointer center">
					<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteTab&id_tab='.$tab['id_tab'].'" '.$stringConfirm.'><i class="icon-trash"></i></a>
					</td>
				</tr>';
				$number++;
			}
		}
		$this->_html .= '
			</tbody>
			</table>
		</div>';
			
		
	}
	
	public function getProductType()
	{
		$productType = array();
		$i=0;
		foreach($this->product_types as $key=>$name)
		{
			$productType[$i]['key'] = $key;
			$productType[$i]['name'] = $name;
			$i++;
		}
		return $productType;
	}
	private function initForm()
	{
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$ProductTypes = $this->getProductType();
		$id_tab = Tools::getValue('id_tab');
		$product_type = array("featured_products","special_products","topseller_products","new_products");
		if($id_tab)
			$tab = new TabClass((int)$id_tab);
		else
			$tab = new TabClass();
		if(!in_array($tab->product_type, $product_type))
		{
			$tab->product_type = "choose_the_category";
			$selected_categories = array($tab->product_type_menu);
		}
		else
			$selected_categories = array();	
		$this->fields_form[0]['form'] = array(
					'tinymce' => true,
					'legend' => array(
					'title' => $this->l('Tab item'),
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
					'type' => 'select',
					'label' => $this->l('Get product form'),
					'name' => 'product_type',
					'options' => array(
						'query' => $ProductTypes,
						'id' => 'key',
						'name' => 'name'
					)
					
				),
				array(
					'type'  => 'categories',
					'label' => $this->l(' '),
					'name'  => 'categories-tree',
					'show' => $tab->product_type,
					'tree'  => array(
						'id'      => 'categories-tree-id',
						'selected_categories' => $selected_categories,
						'disabled_categories' => null
					)
				),
				array(
						'type' => 'switch',
						'label' => $this->l('Displayed'),
						'name' => 'display',
						'values' => array(
									array(
										'id' => 'display_on',
										'value' => 1,
										'label' => $this->l('Enabled')
									),
									array(
										'id' => 'display_off',
										'value' => 0,
										'label' => $this->l('Disabled')
									)
						),
			  ),
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
		$helper->name_controller = 'cshometab';
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
		$helper->submit_action = 'saveTab';
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
		
		foreach (Language::getLanguages(false) as $lang)
		{
			$helper->fields_value['title'][(int)$lang['id_lang']] = Tools::getValue('title_'.(int)$lang['id_lang'],$tab->title[(int)$lang['id_lang']]);
		}
		$helper->fields_value['product_type'] = Tools::getValue('product_type',$tab->product_type);

		$helper->fields_value['display'] = Tools::getValue('display',$tab->display);
		
		if($id_tab)
		{
			$this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_tab');
			$helper->fields_value['id_tab'] = (int)Tools::getValue('id_tab', $tab->id_tab);	
		}
		$this->_html .= $helper->generateForm($this->fields_form);
	}
	
	
	
	private function getTabsDisplay($nb = 10,$id_shop)
	{
		$tabs = array();
	 	$results = Db::getInstance()->ExecuteS(
					'SELECT ts.`id_tab` FROM `'._DB_PREFIX_.'cshometab_shop` ts
					LEFT JOIN `'._DB_PREFIX_.'cshometab` t ON (ts.id_tab = t.id_tab)
					WHERE (ts.id_shop = '.(int)$id_shop.')
					AND ts.`display` = 1 ORDER BY ts.`position` ASC
				');
		foreach ($results as $row)
		{
			$temp = new TabClass($row['id_tab']);
			$temp->getProductList($nb);
			if($temp->product_list == true)
				$tabs[] = $temp;
		}
		return $tabs;
	}
	
	public function hookDisplayHeader($params)
	{	
		global $smarty;
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		if (file_exists(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml'))
			$option = simplexml_load_file(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml');
		else	
			$option = simplexml_load_file(dirname(__FILE__).'/'.'option_'.Configuration::get('PS_SHOP_DEFAULT').'.xml');
		
		if ($smarty->tpl_vars['page_name']->value == 'index')
		{
			$this->context->controller->addCss($this->_path.'css/cshometab.css');
			$this->context->controller->addJs($this->_path.'getwidthbrowser.js');
			if($option->js_tab == "true")
			{
				$this->context->controller->addJs($this->_path.'jquery-ui-tabs.min.js');
			}
		}
	}
	
	public function hookDisplayHome()
	{
		global $smarty, $cookie;
		$this->context = Context::getContext();
		
		$id_shop = $this->context->shop->id;
		
		if (!$this->isCached('cshometab.tpl',$this->getCacheId('cshometab')))
		{
			if (file_exists(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml'))
				$option = simplexml_load_file(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml');
			else	
				$option = simplexml_load_file(dirname(__FILE__).'/'.'option_'.Configuration::get('PS_SHOP_DEFAULT').'.xml');
			$tabs = $this->getTabsDisplay($option->numProduct,$id_shop);
			$smarty->assign(array(
				'tabs' => $tabs,
				'option' => $option
			));
		}
		return $this->display(__FILE__, 'cshometab.tpl',$this->getCacheId('cshometab'));
	}
	
	protected function getCacheId($name = null)
	{
		global $cookie;
		
		if (version_compare(_PS_VERSION_,'1.5.4','<'))
		{
			if(isset($cookie->id_currency))
				{ $id_currency=$cookie->id_currency;}
			else
				{ $id_currency=Configuration::get('PS_CURRENCY_DEFAULT');}
				
			$smarty_cache_id = $name.'|'.(int)Tools::usingSecureMode().'|'.(int)$this->context->shop->id.'|'.(int)Group::getCurrent()->id.'|'.(int)$this->context->language->id.'|'.$id_currency;
			$this->context->smarty->cache_lifetime = 31536000;
			Tools::enableCache();
			return $smarty_cache_id;
		}
		else 
		{
			parent::getCacheId($name);

			if(isset($cookie->id_currency))
				{ $id_currency=$cookie->id_currency;}
			else
				{ $id_currency=Configuration::get('PS_CURRENCY_DEFAULT');}
			
			$groups = implode(', ', Customer::getGroupsStatic((int)$this->context->customer->id));
			$id_lang = (int)$this->context->language->id;
			
			return $name.'|'.(int)Tools::usingSecureMode().'|'.$this->context->shop->id.'|'.$groups.'|'.$id_lang.'|'.$id_currency;
			
		}	
	}
	
	public function hookActionObjectProductUpdateAfter($params)
	{
		$this->_clearCache('cshometab.tpl');
	}
	
	public function hookActionObjectProductDeleteAfter($params)
	{
		$this->_clearCache('cshometab.tpl');
	}
	public function hookActionUpdateQuantity($params)
	{
		$this->_clearCache('cshometab.tpl');
	}
	public function hookactionProductAdd($params)
	{
		$this->_clearCache('cshometab.tpl');
	}
	public function hookactionProductDelete($params)
	{
		$this->_clearCache('cshometab.tpl');
	}
	public function hookactionProductUpdate($params)
	{
		$this->_clearCache('cshometab.tpl');
	}
	
}
?>

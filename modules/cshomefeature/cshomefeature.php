<?php
if (!defined('_CAN_LOAD_FILES_'))
	exit;
include_once(dirname(__FILE__).'/ratting.php');
include_once(dirname(__FILE__).'/mobileDetect.php');
class CsHomeFeature extends Module
{
	public function __construct()
	{
		$this->name = 'cshomefeature';
		$this->tab = 'MyBlock';
		$this->version = '1.0';
		$this->author = 'CodeSpot';
		$this->bootstrap = true;

		parent::__construct();

		$this->displayName = $this->l('CS Featured Products by Category');
		$this->description = $this->l('Displays Featured Products by category in your homepage.');
	}

	public function install()
	{
		
		if (!Configuration::updateValue('HOME_FEATURED_ID_CAT', '3,4',false,null,Configuration::get('PS_SHOP_DEFAULT')) OR
			!parent::install() OR
			!$this->registerHook('homeleft') OR
			!$this->registerHook('displayHeader') OR
			!$this->registerHook('actionObjectProductUpdateAfter') OR
			!$this->registerHook('actionObjectProductDeleteAfter') OR
			!$this->registerHook('actionObjectProductAddAfter') OR
			!$this->registerHook('actionUpdateQuantity') OR
			!$this->registerHook('actionProductAdd') OR
			!$this->registerHook('actionProductDelete') OR
			!$this->registerHook('actionProductUpdate') 
			)
			return false;
		return true;
	}

	public function uninstall()
	{
		Configuration::deleteByName('HOME_FEATURED_ID_CAT');
		if (!parent::uninstall())
			return false;
		return true;
	}

	public function getContent()
	{
		$output = '';
		if (Tools::isSubmit('submitMyHomeFeatured'))
		{
			$this->_clearCache('cshomefeature.tpl');
			if(Tools::getValue('categoryBox')!='')
			{

				$cat = implode(",", Tools::getValue('categoryBox'));
				if (Shop::getContext() != Shop::CONTEXT_SHOP)
					foreach (Shop::getContextListShopID() as $id_shop)
					{
						Configuration::updateValue('HOME_FEATURED_ID_CAT', $cat,false,null,$id_shop);
							
					}
				else
					Configuration::updateValue('HOME_FEATURED_ID_CAT',$cat);
				
			}
			else
				Configuration::updateValue('HOME_FEATURED_ID_CAT', '');
				
			if (isset($errors) AND sizeof($errors))
				$output .= $this->displayError(implode('<br />', $errors));
			else
				$output .= $this->displayConfirmation($this->l('Settings updated'));
		}
		return $output.$this->displayForm();
	}
	
	public static function getCheckboxCatalog($arrCheck,$categories, $current, $id_category = 1, $has_suite = array())
	{
		global $done;
		static $irow;

		if (!isset($done[$current['infos']['id_parent']]))
			$done[$current['infos']['id_parent']] = 0;
		$done[$current['infos']['id_parent']] += 1;
		if(isset($categories[$current['infos']['id_parent']]))
			$todo = sizeof($categories[$current['infos']['id_parent']]);
		$doneC = $done[$current['infos']['id_parent']];

		$level = $current['infos']['level_depth'] + 1;
		
		if($id_category != 1)
		{
			$result = '
			<tr class="'.($irow++ % 2 ? 'alt_row' : '').'">
				<td>
					<input type="checkbox" name="categoryBox[]" class="categoryBox" id="categoryBox_'.$id_category.'" value="'.$id_category.'"'.(in_array($id_category, $arrCheck) ? ' checked="checked"' : '').'/>
				</td>
				<td>
					'.$id_category.'
				</td>
				<td>';
				for ($i = 2; $i < $level; $i++)
					$result .= '<img src="../img/admin/lvl_'.$has_suite[$i - 2].'.gif" alt="" />';
				$result .= '<img style="vertical-align:middle" src="../img/admin/'.($level == 1 ? 'lv1.gif' : 'lv2_'.($todo == $doneC ? 'f' : 'b').'.gif').'" alt="" /> &nbsp;
				<label for="categoryBox_'.$id_category.'" class="t">'.stripslashes($current['infos']['name']).'</label></td>
			</tr>';
		}
		else
			$result = '';
		
		if ($level > 1)
			$has_suite[] = ($todo == $doneC ? 0 : 1);

		if (isset($categories[$id_category]))
			foreach ($categories[$id_category] AS $key => $row)
				if ($key != 'infos')
					$result.= self::getCheckboxCatalog($arrCheck,$categories, $categories[$id_category][$key], $key, $has_suite);
		
		return $result;
	}
	
	public function displayForm()
	{
		global $cookie;
		$categories = Category::getCategories((int)($cookie->id_lang));
		$id = (int)Context::getContext()->shop->id;
		$id_shop = $id ? $id: Configuration::get('PS_SHOP_DEFAULT');
		$arrCheck = explode(",",Configuration::get('HOME_FEATURED_ID_CAT'));
		
		$id_root = Configuration::get('PS_ROOT_CATEGORY',null,null,$id_shop);
		$id_home =$this->getRootCategoryForAShop();
							
		$output = '
		<div class="panel"><form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<div class="margin-form">
					<p class="clear">Mark all checkbox(es) of categories which have products appear in your homepage<sup> *</sup></p>
				</div>
				<div style="overflow: auto; min-height: 300px;" id="categoryList">
					<table cellspacing="0" cellpadding="0" class="table">
						<tr>
							<th>c</th>
							<th>ID</th>
							<th style="width: 600px">Category</th>
						</tr>'
							
						.$this->getCheckboxCatalog($arrCheck,$categories,$categories[$id_root][$id_home],1).
					'</table>
				</div>
				<br/>
				<div class="panel-footer">
				<button type="submit" name="submitMyHomeFeatured" value="'.$this->l('Save').'" class="btn btn-default pull-right"/><i class="process-icon-save"></i>'.$this->l('Save').'</button></div>
			</fieldset>
		</form></div>';
		
		return $output;
	}
	
	function getRootCategoryForAShop()
	{
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('
		SELECT `id_category`
		FROM `'._DB_PREFIX_.'shop`
		WHERE `id_shop` = '.(int)$this->context->shop->id);
	}
	
	function hookDisplayHeader($params)
	{
		global $smarty;
		$detect = new mobileDetect;
		if($detect->isMobile())
			$isMobileIp=1;
		else
			$isMobileIp=0;
			
		$smarty->assign(array(
			'isMobileIp' =>$isMobileIp
		));
			
		$this->context->controller->addCSS($this->_path.'css/cshomefeature.css', 'screen');
		
	}
	
	function hookHomeLeft($params)
	{
		global $smarty;
		//$categories = array();
		$category_list = array();
		$result = array();
		$link=new Link();
		if (!$this->isCached('cshomefeature.tpl',$this->getCacheId('cshomefeature')))
		{
		
			if(Configuration::get('HOME_FEATURED_ID_CAT') != '')
			{
				$id_cat = explode(",",Configuration::get('HOME_FEATURED_ID_CAT'));
				foreach ($id_cat as $id)
				{	
					$categories = new Category($id,(int)(Context::getcontext()->language->id));
					$category_list[$id]['name_category'] = $categories->name;
					$category_list[$id]['id_category'] = $categories->id;
					$category_list[$id]['link_category']=$link->getCategoryLink($id);
					
					$cat_child=Category::getChildren($id,(int)(Context::getcontext()->language->id));
					
					$categories->product_list = $categories->getProducts((int)(Context::getcontext()->language->id),1,2);
					
					
					$category_list[$id]['product_list'] = $categories->product_list;
					
					$prod_list=$category_list[$id]['product_list'];
						/*add ratting*/
						for($i=0;$i<count($prod_list); $i++)
						{
							$averageTotal = 0;
							$averages=rattingProduct::getAveragesByProduct($prod_list[$i]["id_product"],(int)(Context::getcontext()->language->id));
							if(count($averages)>0)
							{
								foreach ($averages as $average)
									$averageTotal += (float)($average);
								$averageTotal = count($averages) ? ($averageTotal / count($averages)) : 0;
							}
							$category_list[$id]['product_list'][$i]["ratting"]=$averageTotal;
						}
								
				}
				
			}
			$smarty->assign(array(
			'category_list' => $category_list
			));
		}
		return $this->display(__FILE__, 'cshomefeature.tpl',$this->getCacheId('cshomefeature'));
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
		$this->_clearCache('cshomefeature.tpl');
	}
	
	public function hookActionObjectProductDeleteAfter($params)
	{
		$this->_clearCache('cshomefeature.tpl');
	}
	public function hookActionUpdateQuantity($params)
	{
		$this->_clearCache('cshomefeature.tpl');
	}
	public function hookactionProductAdd($params)
	{
		$this->_clearCache('cshomefeature.tpl');
	}
	public function hookactionProductDelete($params)
	{
		$this->_clearCache('cshomefeature.tpl');
	}
	public function hookactionProductUpdate($params)
	{
		$this->_clearCache('cshomefeature.tpl');
	}
	
	
}
<?php
define('_PS_ADMIN_DIR_', getcwd());
include(_PS_ADMIN_DIR_.'/../../config/config.inc.php');
require_once (dirname(__FILE__).'/class/CSPLCategory.php');

if (Tools::isSubmit('getChildrenCategories') && Tools::isSubmit('id_category_parent'))
{
	
	$children_categories = CSPLCategory::getChildrenWithNbSelectedSubCat(Tools::getValue('id_category_parent'), Tools::getValue('selectedCat'), Context::getContext()->language->id, null, Tools::getValue('use_shop_context'));

	die(Tools::jsonEncode($children_categories));
}
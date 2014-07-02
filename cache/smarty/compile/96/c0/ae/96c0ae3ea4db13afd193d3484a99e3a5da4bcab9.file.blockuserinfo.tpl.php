<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:03
         compiled from "/home/pekesmx/www/prestashop/themes/electronues/modules/blockuserinfo/blockuserinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157548070053a1da33ecc3a5-95211058%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96c0ae3ea4db13afd193d3484a99e3a5da4bcab9' => 
    array (
      0 => '/home/pekesmx/www/prestashop/themes/electronues/modules/blockuserinfo/blockuserinfo.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157548070053a1da33ecc3a5-95211058',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PS_CATALOG_MODE' => 0,
    'order_process' => 0,
    'link' => 0,
    'cart_qties' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da33f06424_98745888',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da33f06424_98745888')) {function content_53a1da33f06424_98745888($_smarty_tpl) {?>

<!-- Block user information cart module HEADER -->
<div id="shopping_cart" class="csbutton csdefault">
		<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>			
			<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink($_smarty_tpl->tpl_vars['order_process']->value,true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my shopping cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" rel="nofollow"><span class="icon cart">icon</span><?php echo smartyTranslate(array('s'=>'My Cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>

			<span class="ajax_cart_quantity<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value==0){?> hidden<?php }?>">(<?php echo $_smarty_tpl->tpl_vars['cart_qties']->value;?>
)</span>
			<span class="ajax_cart_no_product<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value>0){?> hidden<?php }?>"><?php echo smartyTranslate(array('s'=>'(0)'),$_smarty_tpl);?>
</span>
			</a>

		<?php }?>
</div>
<!-- /Block user information module HEADER -->
<?php }} ?>
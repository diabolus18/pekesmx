<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:27:46
         compiled from "/home/pekesmx/www/prestashop/themes/electronues/category-count.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18362573253a1da22596e76-61147596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bdd37618c7250c9d839463b760f211def3e8e166' => 
    array (
      0 => '/home/pekesmx/www/prestashop/themes/electronues/category-count.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18362573253a1da22596e76-61147596',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'nb_products' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da22639d59_34180070',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da22639d59_34180070')) {function content_53a1da22639d59_34180070($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['category']->value->id==1||$_smarty_tpl->tpl_vars['nb_products']->value==0){?>
	<?php echo smartyTranslate(array('s'=>'There are no products in  this category'),$_smarty_tpl);?>

<?php }else{ ?>
	<?php if ($_smarty_tpl->tpl_vars['nb_products']->value==1){?>
		<?php echo smartyTranslate(array('s'=>'%d product','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>

	<?php }else{ ?>
		<?php echo smartyTranslate(array('s'=>'%d products','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>

	<?php }?>
<?php }?><?php }} ?>
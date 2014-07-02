<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:25:54
         compiled from "/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/controllers/products/helpers/tree/tree_toolbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124478444853a1d9b246f645-24325627%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b389c6848a2ae8aa1b0c2b68ae515941b1abb763' => 
    array (
      0 => '/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/controllers/products/helpers/tree/tree_toolbar.tpl',
      1 => 1399439116,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124478444853a1d9b246f645-24325627',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'actions' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1d9b24fd498_74865753',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1d9b24fd498_74865753')) {function content_53a1d9b24fd498_74865753($_smarty_tpl) {?>
<div class="tree-actions pull-right">
	<?php if (isset($_smarty_tpl->tpl_vars['actions']->value)){?>
	<?php  $_smarty_tpl->tpl_vars['action'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['action']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['actions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['action']->key => $_smarty_tpl->tpl_vars['action']->value){
$_smarty_tpl->tpl_vars['action']->_loop = true;
?>
		<?php echo $_smarty_tpl->tpl_vars['action']->value->render();?>

	<?php } ?>
	<?php }?>
</div><?php }} ?>
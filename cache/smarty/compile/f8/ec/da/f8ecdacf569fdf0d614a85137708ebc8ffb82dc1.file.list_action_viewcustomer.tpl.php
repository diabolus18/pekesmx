<?php /* Smarty version Smarty-3.1.14, created on 2014-07-15 21:37:47
         compiled from "/home/pekesmx/www/prestashop/modules/blocknewsletter/views/templates/admin/list_action_viewcustomer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152297830453c5e57b5b6f20-02861117%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8ecdacf569fdf0d614a85137708ebc8ffb82dc1' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/blocknewsletter/views/templates/admin/list_action_viewcustomer.tpl',
      1 => 1401153259,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152297830453c5e57b5b6f20-02861117',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'disable' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53c5e57b61f272_58902081',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c5e57b61f272_58902081')) {function content_53c5e57b61f272_58902081($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="edit btn btn-default <?php if ($_smarty_tpl->tpl_vars['disable']->value){?>disabled<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" >
	<i class="icon-search-plus"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>
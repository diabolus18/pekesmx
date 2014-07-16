<?php /* Smarty version Smarty-3.1.14, created on 2014-07-15 21:37:47
         compiled from "/home/pekesmx/www/prestashop/modules/blocknewsletter/views/templates/admin/list_action_unsubscribe.tpl" */ ?>
<?php /*%%SmartyHeaderCode:143595361553c5e57b65ab41-22618459%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '551c57d6e430837179441b4e6d93102c7f6564c9' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/blocknewsletter/views/templates/admin/list_action_unsubscribe.tpl',
      1 => 1401153259,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143595361553c5e57b65ab41-22618459',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53c5e57b66b742_17702030',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c5e57b66b742_17702030')) {function content_53c5e57b66b742_17702030($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" >
	<i class="icon-check"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a>
<?php }} ?>
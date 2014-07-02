<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:25:55
         compiled from "/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/helpers/list/list_action_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145665613453a1d9b31e1360-08772856%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b541ffc8b252449d75a58fbdef3f2804402d094b' => 
    array (
      0 => '/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/helpers/list/list_action_delete.tpl',
      1 => 1399439116,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145665613453a1d9b31e1360-08772856',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'confirm' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1d9b3205035_80350396',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1d9b3205035_80350396')) {function content_53a1d9b3205035_80350396($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)){?>onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="delete">
	<i class="icon-trash"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>
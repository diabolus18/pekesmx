<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:25:48
         compiled from "/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:113841901953a1d9acae5ff6-33893354%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd85ec48e5bc1933c6e85692e54adaba8a936bf79' => 
    array (
      0 => '/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/content.tpl',
      1 => 1399439115,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113841901953a1d9acae5ff6-33893354',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1d9acafac28_60895663',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1d9acafac28_60895663')) {function content_53a1d9acafac28_60895663($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>

<?php if (isset($_smarty_tpl->tpl_vars['content']->value)){?>
	<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }?>
<?php }} ?>
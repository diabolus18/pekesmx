<?php /* Smarty version Smarty-3.1.14, created on 2014-06-24 03:36:53
         compiled from "/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/controllers/cms_content/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28723456253a938a5ac0995-59288872%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8427aa9fc1c4c5e6c5f25857830b7f351e0301b8' => 
    array (
      0 => '/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/controllers/cms_content/content.tpl',
      1 => 1399439115,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28723456253a938a5ac0995-59288872',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cms_breadcrumb' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a938a5b09088_38268357',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a938a5b09088_38268357')) {function content_53a938a5b09088_38268357($_smarty_tpl) {?>

<?php if (isset($_smarty_tpl->tpl_vars['cms_breadcrumb']->value)){?>
	<ul class="breadcrumb cat_bar">
		<?php echo $_smarty_tpl->tpl_vars['cms_breadcrumb']->value;?>

	</ul>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }} ?>
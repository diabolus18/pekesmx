<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:25:54
         compiled from "/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/helpers/kpi/row.tpl" */ ?>
<?php /*%%SmartyHeaderCode:184021938153a1d9b28a3d71-35444414%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c1e1f46e79c02c48fd687234a7fe38c937d5e83' => 
    array (
      0 => '/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/helpers/kpi/row.tpl',
      1 => 1399439116,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '184021938153a1d9b28a3d71-35444414',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'kpis' => 0,
    'kpi' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1d9b28b5aa0_07761001',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1d9b28b5aa0_07761001')) {function content_53a1d9b28b5aa0_07761001($_smarty_tpl) {?>
<div class="panel kpi-container">
	<div class="row">
		<?php  $_smarty_tpl->tpl_vars['kpi'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['kpi']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['kpis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['kpi']->key => $_smarty_tpl->tpl_vars['kpi']->value){
$_smarty_tpl->tpl_vars['kpi']->_loop = true;
?>
		<div class="col-sm-6 col-lg-3">
			<?php echo $_smarty_tpl->tpl_vars['kpi']->value;?>

		</div>			
		<?php } ?>
	</div>
</div><?php }} ?>
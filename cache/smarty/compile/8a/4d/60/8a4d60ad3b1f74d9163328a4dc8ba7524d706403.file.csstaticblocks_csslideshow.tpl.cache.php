<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:05
         compiled from "/home/pekesmx/www/prestashop/modules/csstaticblocks/views/templates/hook/csstaticblocks_csslideshow.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210817341653a1da3576f402-12013040%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a4d60ad3b1f74d9163328a4dc8ba7524d706403' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csstaticblocks/views/templates/hook/csstaticblocks_csslideshow.tpl',
      1 => 1401262787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210817341653a1da3576f402-12013040',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'block_list' => 0,
    'cookie' => 0,
    'block' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da357a03a0_56417622',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da357a03a0_56417622')) {function content_53a1da357a03a0_56417622($_smarty_tpl) {?><!-- Static Block module -->
<div class="static_block_home_banner clearfix">
<?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['block_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
$_smarty_tpl->tpl_vars['block']->_loop = true;
?>
	<?php if (isset($_smarty_tpl->tpl_vars['block']->value->content[(int)$_smarty_tpl->tpl_vars['cookie']->value->id_lang])){?>
		<?php echo $_smarty_tpl->tpl_vars['block']->value->content[(int)$_smarty_tpl->tpl_vars['cookie']->value->id_lang];?>

	<?php }?>
<?php } ?>
</div>
<!-- /Static block module --><?php }} ?>
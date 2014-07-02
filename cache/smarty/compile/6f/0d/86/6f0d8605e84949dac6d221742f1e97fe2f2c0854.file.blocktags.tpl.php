<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:48:39
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/contents/blocktags.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127577762253a295d77fb853-52598735%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f0d8605e84949dac6d221742f1e97fe2f2c0854' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/contents/blocktags.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127577762253a295d77fb853-52598735',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tags' => 0,
    'tag' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a295d7834296_97131120',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a295d7834296_97131120')) {function content_53a295d7834296_97131120($_smarty_tpl) {?><div class="title"><h3><?php echo smartyTranslate(array('s'=>'Blog tags','mod'=>'csblog'),$_smarty_tpl);?>
</h3></div><div class="box-content center ">	<?php if (count($_smarty_tpl->tpl_vars['tags']->value)>0){?>	<p class="block_content">		<?php  $_smarty_tpl->tpl_vars['tag'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tag']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tags']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tag']->key => $_smarty_tpl->tpl_vars['tag']->value){
$_smarty_tpl->tpl_vars['tag']->_loop = true;
?>				<a href="<?php echo $_smarty_tpl->tpl_vars['tag']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['tag']->value['name'];?>
</a>		<?php } ?>	</p>				<?php }else{ ?>		<?php echo smartyTranslate(array('s'=>'There is no tag','mod'=>'csblog'),$_smarty_tpl);?>
	<?php }?></div><?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2014-07-08 20:06:35
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/rss.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35472527353bc959b062ca6-38432866%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abd8e761058dda0c5675d19b0ecae0737d65f888' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/rss.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35472527353bc959b062ca6-38432866',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rsss' => 0,
    'rss' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53bc959b1d3e85_42033285',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bc959b1d3e85_42033285')) {function content_53bc959b1d3e85_42033285($_smarty_tpl) {?>
<h1 class="h_blog"><?php echo smartyTranslate(array('s'=>'Blog','mod'=>'csblog'),$_smarty_tpl);?>
</h1>
<div class="rss">
<h1><?php echo smartyTranslate(array('s'=>'RSS of blog','mod'=>'csblog'),$_smarty_tpl);?>
</h1>
<?php if (isset($_smarty_tpl->tpl_vars['rsss']->value)&&count($_smarty_tpl->tpl_vars['rsss']->value)>0){?>
	<ul>
	<?php  $_smarty_tpl->tpl_vars['rss'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rss']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rsss']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rss']->key => $_smarty_tpl->tpl_vars['rss']->value){
$_smarty_tpl->tpl_vars['rss']->_loop = true;
?>
	<li><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['rss']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['rss']->value['name'];?>
</a> (<span><a href="<?php echo $_smarty_tpl->tpl_vars['rss']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['rss']->value['link'];?>
</a></span>) </li> <br/>
	<?php } ?>
	</ul>
<?php }?>
</div><?php }} ?>
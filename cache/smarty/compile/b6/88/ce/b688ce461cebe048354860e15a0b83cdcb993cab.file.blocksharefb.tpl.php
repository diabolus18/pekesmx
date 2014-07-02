<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:15
         compiled from "/home/pekesmx/www/prestashop/modules/blocksharefb/blocksharefb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:79878416953a1da3f2eeea0-76965873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b688ce461cebe048354860e15a0b83cdcb993cab' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/blocksharefb/blocksharefb.tpl',
      1 => 1399439124,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79878416953a1da3f2eeea0-76965873',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product_link' => 0,
    'product_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da3f304010_29092011',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da3f304010_29092011')) {function content_53a1da3f304010_29092011($_smarty_tpl) {?>

<li id="left_share_fb">
	<a href="http://www.facebook.com/sharer.php?u=<?php echo $_smarty_tpl->tpl_vars['product_link']->value;?>
&amp;t=<?php echo $_smarty_tpl->tpl_vars['product_title']->value;?>
" class="_blank"><?php echo smartyTranslate(array('s'=>'Share on Facebook!','mod'=>'blocksharefb'),$_smarty_tpl);?>
</a>
</li><?php }} ?>
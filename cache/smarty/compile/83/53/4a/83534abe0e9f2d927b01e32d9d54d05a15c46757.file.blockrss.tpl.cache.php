<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:05
         compiled from "/home/pekesmx/www/prestashop/modules/blockrss/blockrss.tpl" */ ?>
<?php /*%%SmartyHeaderCode:120900478153a1da35e93609-59790652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83534abe0e9f2d927b01e32d9d54d05a15c46757' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/blockrss/blockrss.tpl',
      1 => 1399439124,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120900478153a1da35e93609-59790652',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'rss_links' => 0,
    'rss_link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da35ed5a84_52689656',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da35ed5a84_52689656')) {function content_53a1da35ed5a84_52689656($_smarty_tpl) {?>

<!-- Block RSS module-->
<div id="rss_block_left" class="block">
	<h4 class="title_block"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h4>
	<div class="block_content list-block">
		<?php if ($_smarty_tpl->tpl_vars['rss_links']->value){?>
			<ul>
				<?php  $_smarty_tpl->tpl_vars['rss_link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rss_link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rss_links']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rss_link']->key => $_smarty_tpl->tpl_vars['rss_link']->value){
$_smarty_tpl->tpl_vars['rss_link']->_loop = true;
?>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['rss_link']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['rss_link']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['rss_link']->value['title'];?>
</a></li>
				<?php } ?>
			</ul>
		<?php }else{ ?>
			<p><?php echo smartyTranslate(array('s'=>'No RSS feed added','mod'=>'blockrss'),$_smarty_tpl);?>
</p>
		<?php }?>
	</div>
</div>
<!-- /Block RSS module-->
<?php }} ?>
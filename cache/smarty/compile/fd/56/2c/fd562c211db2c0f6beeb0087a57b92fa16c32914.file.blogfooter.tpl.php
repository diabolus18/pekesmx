<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:06
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/blogfooter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10533956253a1da369ee8a8-58351526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd562c211db2c0f6beeb0087a57b92fa16c32914' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/blogfooter.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10533956253a1da369ee8a8-58351526',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CS_SHOW_BLOCK_CATEGORY' => 0,
    'CS_DISPLAY_CATEGORY' => 0,
    'CS_SHOW_BLOCK_LASTEST' => 0,
    'DISPLAY_LASTEST_POST' => 0,
    'blockcomments' => 0,
    'position' => 0,
    'CS_SHOW_BLOCK_TAG' => 0,
    'CS_DISPLAY_TAG' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da36a3ef10_78677031',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da36a3ef10_78677031')) {function content_53a1da36a3ef10_78677031($_smarty_tpl) {?><!-- Blog categories --><?php if ($_smarty_tpl->tpl_vars['CS_SHOW_BLOCK_CATEGORY']->value==1&&$_smarty_tpl->tpl_vars['CS_DISPLAY_CATEGORY']->value=='footer'){?>	<div class="block blog_categories_footer" id="blog_categories_footer">		<?php echo $_smarty_tpl->getSubTemplate ("./contents/blockcategories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
	</div><?php }?><!-- /Blog categories --><!-- Lastest post --><?php if ($_smarty_tpl->tpl_vars['CS_SHOW_BLOCK_LASTEST']->value==1&&$_smarty_tpl->tpl_vars['DISPLAY_LASTEST_POST']->value=='footer'){?>	<div class="block blog_lastest_posts_footer" id="blog_lastest_posts_footer">		<?php echo $_smarty_tpl->getSubTemplate ("./contents/blocklastestposts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
	</div><?php }?><!-- /Lastest post --><!-- /Blog current comment --><?php if (isset($_smarty_tpl->tpl_vars['blockcomments']->value)&&$_smarty_tpl->tpl_vars['position']->value=='footer'){?>	<div class="block blog_comments_footer" id="blog_comments_footer">		<?php echo $_smarty_tpl->getSubTemplate ("./contents/blockcomments.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
	</div><?php }?><!-- /Blog current comment --><!-- Blog tags --><?php if ($_smarty_tpl->tpl_vars['CS_SHOW_BLOCK_TAG']->value==1&&$_smarty_tpl->tpl_vars['CS_DISPLAY_TAG']->value=='footer'){?>	<div class="block blog_tags_footer" id="blog_tags_footer">		<?php echo $_smarty_tpl->getSubTemplate ("./contents/blocktags.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
	</div><?php }?><!-- /Blog tags --><?php }} ?>
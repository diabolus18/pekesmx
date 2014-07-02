<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:05
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/columnleft.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13166897353a1da359b56c0-60330847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a66ac63981b4130674588f1d9ecfb1ffb184d97' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/columnleft.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13166897353a1da359b56c0-60330847',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CS_SHOW_BLOCK_CATEGORY' => 0,
    'CS_DISPLAY_CATEGORY' => 0,
    'BLOCK_CATEG_DISPLAY_PAGE' => 0,
    'page_name' => 0,
    'CS_SHOW_BLOCK_LASTEST' => 0,
    'DISPLAY_LASTEST_POST' => 0,
    'LASTEST_POST_DISPLAY_PAGE' => 0,
    'blockcomments' => 0,
    'position' => 0,
    'CURRENT_COMMENT_DISPLAY_PAGE' => 0,
    'CS_SHOW_BLOCK_TAG' => 0,
    'CS_DISPLAY_TAG' => 0,
    'CS_TAG_DISPLAY_PAGE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da35ad3040_14747098',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da35ad3040_14747098')) {function content_53a1da35ad3040_14747098($_smarty_tpl) {?><!-- Blog categories --><?php if ($_smarty_tpl->tpl_vars['CS_SHOW_BLOCK_CATEGORY']->value==1&&($_smarty_tpl->tpl_vars['CS_DISPLAY_CATEGORY']->value=='displayLeftColumn'||$_smarty_tpl->tpl_vars['CS_DISPLAY_CATEGORY']->value=='displayLeftRightColumn')){?>	<?php if ($_smarty_tpl->tpl_vars['BLOCK_CATEG_DISPLAY_PAGE']->value==1){?>		<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-categoryPost'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-post'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-tag'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-rss'){?>			<div class="box1 blockblogcategory" id="blog_categories_displayLeftColumn">			<?php echo $_smarty_tpl->getSubTemplate ("./contents/blockcategories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
			</div>		<?php }?>	<?php }else{ ?>		<div class="box1 blockblogcategory" id="blog_categories_displayLeftColumn">		<?php echo $_smarty_tpl->getSubTemplate ("./contents/blockcategories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
		</div>	<?php }?><?php }?><!-- /Blog categories --><!-- Lastest post --><?php if ($_smarty_tpl->tpl_vars['CS_SHOW_BLOCK_LASTEST']->value==1&&($_smarty_tpl->tpl_vars['DISPLAY_LASTEST_POST']->value=='displayLeftColumn'||$_smarty_tpl->tpl_vars['DISPLAY_LASTEST_POST']->value=='displayLeftRightColumn')){?>	<?php if ($_smarty_tpl->tpl_vars['LASTEST_POST_DISPLAY_PAGE']->value==1){?>		<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-categoryPost'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-post'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-tag'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-rss'){?>			<div class="box1 blog_lastest_posts" id="blog_lastest_posts_displayLeftColumn">			<?php echo $_smarty_tpl->getSubTemplate ("./contents/blocklastestposts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
			</div>		<?php }?>	<?php }else{ ?>		<div class="box1 blog_lastest_posts" id="blog_lastest_posts_displayLeftColumn">		<?php echo $_smarty_tpl->getSubTemplate ("./contents/blocklastestposts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
		</div>	<?php }?><?php }?><!-- /Lastest post --><!-- /Blog current comment --><?php if (isset($_smarty_tpl->tpl_vars['blockcomments']->value)&&($_smarty_tpl->tpl_vars['position']->value=='displayLeftColumn'||$_smarty_tpl->tpl_vars['position']->value=='displayLeftRightColumn')){?>	<?php if ($_smarty_tpl->tpl_vars['CURRENT_COMMENT_DISPLAY_PAGE']->value==1){?>		<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-categoryPost'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-post'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-tag'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-rss'){?>			<div class="box1 blog_comments" id="blog_comments_displayLeftColumn">			<?php echo $_smarty_tpl->getSubTemplate ("./contents/blockcomments.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
			</div>		<?php }?>	<?php }else{ ?>		<div class="box1 blog_comments" id="blog_comments_displayLeftColumn">		<?php echo $_smarty_tpl->getSubTemplate ("./contents/blockcomments.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
		</div>	<?php }?><?php }?><!-- /Blog current comment --><!-- Blog tags --><?php if ($_smarty_tpl->tpl_vars['CS_SHOW_BLOCK_TAG']->value==1&&($_smarty_tpl->tpl_vars['CS_DISPLAY_TAG']->value=='displayLeftColumn'||$_smarty_tpl->tpl_vars['CS_DISPLAY_TAG']->value=='displayLeftRightColumn')){?>	<?php if ($_smarty_tpl->tpl_vars['CS_TAG_DISPLAY_PAGE']->value==1){?>		<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-categoryPost'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-post'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-tag'||$_smarty_tpl->tpl_vars['page_name']->value=='module-csblog-rss'){?>			<div class="box1 blog_tags" id="blog_tags_displayLeftColumn">			<?php echo $_smarty_tpl->getSubTemplate ("./contents/blocktags.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
			</div>		<?php }?>	<?php }else{ ?>		<div class="box1 blog_tags" id="blog_tags_displayLeftColumn">		<?php echo $_smarty_tpl->getSubTemplate ("./contents/blocktags.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
		</div>	<?php }?><?php }?><!-- /Blog tags --><?php }} ?>
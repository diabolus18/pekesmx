<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:48:39
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/categoryPost.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16711054653a295d7a7d676-70299411%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b809d47886fd0c64256d148e2e7e0e4d1127e95' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/categoryPost.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16711054653a295d7a7d676-70299411',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cs_blog_category' => 0,
    'cs_allow_category_image' => 0,
    'cs_allow_category_description' => 0,
    'cs_postes_empty' => 0,
    'cs_post_list' => 0,
    'count_blog' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a295d7bc1791_95693928',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a295d7bc1791_95693928')) {function content_53a295d7bc1791_95693928($_smarty_tpl) {?>

<!--category detail-->
<?php if (isset($_smarty_tpl->tpl_vars['cs_blog_category']->value)){?>
	<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['cs_blog_category']->value['image'];?>
<?php $_tmp1=ob_get_clean();?><?php if (isset($_smarty_tpl->tpl_vars['cs_blog_category']->value['image'])&&$_smarty_tpl->tpl_vars['cs_allow_category_image']->value==1&&$_tmp1!=''){?>
		<div class="blog_category_image">
			<img src="<?php echo $_smarty_tpl->tpl_vars['cs_blog_category']->value['image'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['cs_blog_category']->value['name'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['cs_blog_category']->value['name'];?>
" />
		</div>
	<?php }?>
	<h3 class="title_blog"><?php echo $_smarty_tpl->tpl_vars['cs_blog_category']->value['name'];?>
</h3>
	<?php if ($_smarty_tpl->tpl_vars['cs_allow_category_description']->value==1){?>
		<div class="blog_category_description">
			<?php if (strlen($_smarty_tpl->tpl_vars['cs_blog_category']->value['description'])>1500){?>
			<p id="category_description_short"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['cs_blog_category']->value['description'],120);?>
</p>
			<?php }else{ ?>
				<?php echo $_smarty_tpl->tpl_vars['cs_blog_category']->value['description'];?>

			<?php }?>
		</div>
	<?php }?>
<?php }else{ ?>
	<h1><?php echo smartyTranslate(array('s'=>'Welcome to our blog','mod'=>'csblog'),$_smarty_tpl);?>
</h1>
<?php }?>

<!--list post-->
<?php if ($_smarty_tpl->tpl_vars['cs_postes_empty']->value==0){?>
	<div class="post_control clearfix">
		<?php echo $_smarty_tpl->getSubTemplate ("./post_sort.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php echo $_smarty_tpl->getSubTemplate ("./number_item.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>
	<?php echo $_smarty_tpl->getSubTemplate ("./post_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['cs_postes_empty']->value==1){?>
	<div class="empty"><?php echo smartyTranslate(array('s'=>'There are no posts in this category','mod'=>'csblog'),$_smarty_tpl);?>
</div>
<?php }?>


<!--pagination-->
<?php if ($_smarty_tpl->tpl_vars['cs_postes_empty']->value!=1){?>
<div class="post_pagination clearfix">
<?php if (isset($_smarty_tpl->tpl_vars['cs_post_list']->value)){?><div class="count_post"><?php echo smartyTranslate(array('s'=>'display ','mod'=>'csblog'),$_smarty_tpl);?>
<?php echo count($_smarty_tpl->tpl_vars['cs_post_list']->value);?>
 of <?php echo $_smarty_tpl->tpl_vars['count_blog']->value;?>
<?php echo smartyTranslate(array('s'=>' posts','mod'=>'csblog'),$_smarty_tpl);?>
</div><?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("./pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<?php }?>
<?php }} ?>
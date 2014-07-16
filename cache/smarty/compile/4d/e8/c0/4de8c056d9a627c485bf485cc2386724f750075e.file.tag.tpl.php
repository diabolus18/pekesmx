<?php /* Smarty version Smarty-3.1.14, created on 2014-07-10 19:29:32
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/tag.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139646546953bf2fec51ec74-68365381%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4de8c056d9a627c485bf485cc2386724f750075e' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/tag.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139646546953bf2fec51ec74-68365381',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cs_blog_tag' => 0,
    'count' => 0,
    'cs_postes_empty' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53bf2fec5ec2f8_78471981',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bf2fec5ec2f8_78471981')) {function content_53bf2fec5ec2f8_78471981($_smarty_tpl) {?><!--breadcrumb-->

<!--tag name-->
<h1><?php echo $_smarty_tpl->tpl_vars['cs_blog_tag']->value->name;?>
</h1>
<h3 class="nbresult"><span class="big"><?php echo $_smarty_tpl->tpl_vars['count']->value;?>
<?php echo smartyTranslate(array('s'=>' results have been found.','mod'=>'csblog'),$_smarty_tpl);?>
</span></h3>

<!--list post-->
<?php if ($_smarty_tpl->tpl_vars['cs_postes_empty']->value==0){?>
	<?php echo $_smarty_tpl->getSubTemplate ("./post_sort.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ("./number_item.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ("./post_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['cs_postes_empty']->value==1){?>
	<div class="empty"><?php echo smartyTranslate(array('s'=>'There are no posts in this tag','mod'=>'csblog'),$_smarty_tpl);?>
</div>
<?php }?>
<!--pagination-->
<?php if ($_smarty_tpl->tpl_vars['cs_postes_empty']->value!=1){?>
	<?php echo $_smarty_tpl->getSubTemplate ("./pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>

<?php }} ?>
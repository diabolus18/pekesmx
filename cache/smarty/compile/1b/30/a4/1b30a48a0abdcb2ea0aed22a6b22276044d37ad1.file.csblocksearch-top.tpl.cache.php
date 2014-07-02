<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:04
         compiled from "/home/pekesmx/www/prestashop/modules/csblocksearch/csblocksearch-top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154129695653a1da34552385-21703275%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b30a48a0abdcb2ea0aed22a6b22276044d37ad1' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblocksearch/csblocksearch-top.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154129695653a1da34552385-21703275',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hook_mobile' => 0,
    'link' => 0,
    'ENT_QUOTES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da345d43f7_27306012',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da345d43f7_27306012')) {function content_53a1da345d43f7_27306012($_smarty_tpl) {?>
<!-- block seach mobile -->
<?php if (isset($_smarty_tpl->tpl_vars['hook_mobile']->value)){?>
<div class="input_search" data-role="fieldcontain">
	<form method="get" action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('search');?>
" id="searchbox">
		<input type="hidden" name="controller" value="search" />
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input class="search_query" type="search" id="search_query_top" name="search_query" placeholder="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'csblocksearch'),$_smarty_tpl);?>
" value="<?php if (isset($_GET['search_query'])){?><?php echo stripslashes(htmlentities($_GET['search_query'],$_smarty_tpl->tpl_vars['ENT_QUOTES']->value,'utf-8'));?>
<?php }?>" />
	</form>
</div>
<?php }else{ ?>
<!-- Block search module TOP -->
<div id="search_block_top">
	<!-- <label for="search_query_top"><?php echo smartyTranslate(array('s'=>'Search','mod'=>'csblocksearch'),$_smarty_tpl);?>
</label> -->
	<form method="get" action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('search');?>
" id="searchbox">
			<input type="hidden" name="controller" value="search" />
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="orderway" value="desc" />
			<input class="search_query" type="text" id="search_query_top" name="search_query" value="<?php if (isset($_GET['search_query'])){?><?php echo stripslashes(htmlentities($_GET['search_query'],$_smarty_tpl->tpl_vars['ENT_QUOTES']->value,'utf-8'));?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Search entire store here...','mod'=>'cscsblocksearch'),$_smarty_tpl);?>
<?php }?>" onfocus="this.value=''" onblur="if (this.value =='') this.value='<?php echo smartyTranslate(array('s'=>'Search entire store here...','mod'=>'csblocksearch'),$_smarty_tpl);?>
'" />
			<input type="submit" name="submit_search" value="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'csblocksearch'),$_smarty_tpl);?>
" class="button" title="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'csblocksearch'),$_smarty_tpl);?>
"/>
	</form>
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['self']->value)."/blocksearch-instantsearch.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

</div>

<?php }?>
<!-- /Block search module TOP -->
<?php }} ?>
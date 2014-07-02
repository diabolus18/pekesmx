<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:48:39
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/post_sort.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15096419553a295d7bcb742-51015857%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e2bd507a159f9fd14f8b5fa0b083ac723a5dc9b' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/post_sort.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15096419553a295d7bcb742-51015857',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'csrequest' => 0,
    'category' => 0,
    'link' => 0,
    'manufacturer' => 0,
    'supplier' => 0,
    'cs_blog_category' => 0,
    'csLink' => 0,
    'url' => 0,
    'PS_CATALOG_MODE' => 0,
    'pl_orderby' => 0,
    'pl_orderway' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a295d7d13c42_58403008',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a295d7d13c42_58403008')) {function content_53a295d7d13c42_58403008($_smarty_tpl) {?>


<?php if (!isset($_smarty_tpl->tpl_vars['csrequest']->value)){?>
	<!-- Sort products -->
	<?php if (isset($_GET['id_category'])&&$_GET['id_category']){?>
		<?php $_smarty_tpl->tpl_vars['csrequest'] = new Smarty_variable($_smarty_tpl->tpl_vars['link']->value->getPaginationLink('categoryPost',$_smarty_tpl->tpl_vars['category']->value,false,true), null, 0);?>
	<?php }elseif(isset($_GET['id_manufacturer'])&&$_GET['id_manufacturer']){?>
		<?php $_smarty_tpl->tpl_vars['csrequest'] = new Smarty_variable($_smarty_tpl->tpl_vars['link']->value->getPaginationLink('manufacturer',$_smarty_tpl->tpl_vars['manufacturer']->value,false,true), null, 0);?>
	<?php }elseif(isset($_GET['id_supplier'])&&$_GET['id_supplier']){?>
		<?php $_smarty_tpl->tpl_vars['csrequest'] = new Smarty_variable($_smarty_tpl->tpl_vars['link']->value->getPaginationLink('supplier',$_smarty_tpl->tpl_vars['supplier']->value,false,true), null, 0);?>
	<?php }else{ ?>
		<?php $_smarty_tpl->tpl_vars['csrequest'] = new Smarty_variable($_smarty_tpl->tpl_vars['link']->value->getModuleLink('csblog','categoryPost'), null, 0);?>
		
	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['cs_blog_category']->value['id_cs_blog_category'])&&$_smarty_tpl->tpl_vars['cs_blog_category']->value['id_cs_blog_category']){?>
	<?php $_smarty_tpl->tpl_vars['url'] = new Smarty_variable($_smarty_tpl->tpl_vars['csLink']->value->getCategoryPostLink($_smarty_tpl->tpl_vars['cs_blog_category']->value['id_cs_blog_category'],$_smarty_tpl->tpl_vars['cs_blog_category']->value['link_rewrite']), null, 0);?>
	<?php $_smarty_tpl->tpl_vars['csrequest'] = new Smarty_variable($_smarty_tpl->tpl_vars['csLink']->value->getPaginationLinkBlog($_smarty_tpl->tpl_vars['url']->value), null, 0);?>
	<?php }else{ ?>
	<?php $_smarty_tpl->tpl_vars['csrequest'] = new Smarty_variable($_smarty_tpl->tpl_vars['link']->value->getModuleLink('csblog','categoryPost'), null, 0);?>
	<?php }?>
<?php }?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function()
{
	$('.selectPostSort').change(function()
	{
		var csrequestSortProducts = '<?php echo $_smarty_tpl->tpl_vars['csrequest']->value;?>
';
		var splitData = $(this).val().split(':');
		document.location.href = csrequestSortProducts + ((csrequestSortProducts.indexOf('?') < 0) ? '?' : '&') + 'orderby=' + splitData[0] + '&orderway=' + splitData[1];
	});
});
//]]>
</script>

<form id="productsSortForm" action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['csrequest']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
	<p class="select">
		<label for="selectPrductSort"><?php echo smartyTranslate(array('s'=>'Sort by'),$_smarty_tpl);?>
</label>
		<select id="selectPrductSort" class="selectPostSort">
			<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>
				<option value="date_add:asc" <?php if ($_smarty_tpl->tpl_vars['pl_orderby']->value=='date_add'&&$_smarty_tpl->tpl_vars['pl_orderway']->value=='asc'){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Date created: Oldest first'),$_smarty_tpl);?>
</option>
				<option value="date_add:desc" <?php if ($_smarty_tpl->tpl_vars['pl_orderby']->value=='date_add'&&$_smarty_tpl->tpl_vars['pl_orderway']->value=='desc'){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Date created: Most recent first'),$_smarty_tpl);?>
</option>
			<?php }?>
			<option value="name:asc" <?php if ($_smarty_tpl->tpl_vars['pl_orderby']->value=='name'&&$_smarty_tpl->tpl_vars['pl_orderway']->value=='asc'){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Post title: A to Z'),$_smarty_tpl);?>
</option>
			<option value="name:desc" <?php if ($_smarty_tpl->tpl_vars['pl_orderby']->value=='name'&&$_smarty_tpl->tpl_vars['pl_orderway']->value=='desc'){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Post title: Z to A'),$_smarty_tpl);?>
</option>
		</select>
	</p>
</form>
<!-- /Sort products -->
<?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:48:39
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/number_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160566341353a295d7d21783-99432164%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e31c89b9882233687dfc61a395836d7852bec17c' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/number_item.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160566341353a295d7d21783-99432164',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'p' => 0,
    'cs_blog_category' => 0,
    'csLink' => 0,
    'cs_blog_tag' => 0,
    'nb_products' => 0,
    'cs_posts_per_page' => 0,
    'requestPage' => 0,
    'search_query' => 0,
    'tag' => 0,
    'nArray' => 0,
    'lastnValue' => 0,
    'nValue' => 0,
    'n' => 0,
    'url_rewrite' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a295d7e60e74_73384098',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a295d7e60e74_73384098')) {function content_53a295d7e60e74_73384098($_smarty_tpl) {?><!--<div class="list_grid">
<ul id="layouts" class="option-set clearfix" data-option-key="layoutMode">
<li><a title="<?php echo smartyTranslate(array('s'=>'grid'),$_smarty_tpl);?>
" id="fitRows" href="#fitRows" data-option-value="fitRows"><?php echo smartyTranslate(array('s'=>'grid'),$_smarty_tpl);?>
</a></li>
<li><a title="<?php echo smartyTranslate(array('s'=>'list'),$_smarty_tpl);?>
" id="straightDown" href="#straightDown" data-option-value="straightDown"><?php echo smartyTranslate(array('s'=>'list'),$_smarty_tpl);?>
</a></li></ul>
</div>-->
<span class="rss"><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('csblog','rss');?>
" title="<?php echo smartyTranslate(array('s'=>'rss','mod'=>'csblog'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'rss'),$_smarty_tpl);?>
</a></span>
<?php if (isset($_smarty_tpl->tpl_vars['p']->value)&&$_smarty_tpl->tpl_vars['p']->value){?>
	<?php if (isset($_smarty_tpl->tpl_vars['cs_blog_category']->value['id_cs_blog_category'])&&$_smarty_tpl->tpl_vars['cs_blog_category']->value['id_cs_blog_category']){?>
		<?php $_smarty_tpl->tpl_vars['requestPage'] = new Smarty_variable($_smarty_tpl->tpl_vars['csLink']->value->getCategoryPostLink($_smarty_tpl->tpl_vars['cs_blog_category']->value['id_cs_blog_category'],$_smarty_tpl->tpl_vars['cs_blog_category']->value['link_rewrite']), null, 0);?>
	<?php }elseif(isset($_smarty_tpl->tpl_vars['cs_blog_tag']->value)){?>
		<?php $_smarty_tpl->tpl_vars['requestPage'] = new Smarty_variable($_smarty_tpl->tpl_vars['csLink']->value->getTagLink($_smarty_tpl->tpl_vars['cs_blog_tag']->value->id,$_smarty_tpl->tpl_vars['cs_blog_tag']->value->name), null, 0);?>
	<?php }else{ ?>
		<?php $_smarty_tpl->tpl_vars['requestPage'] = new Smarty_variable($_smarty_tpl->tpl_vars['link']->value->getModuleLink('csblog','categoryPost'), null, 0);?>
	
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['nb_products']->value>$_smarty_tpl->tpl_vars['cs_posts_per_page']->value){?>
		<form id="plpagination" action="<?php echo $_smarty_tpl->tpl_vars['requestPage']->value;?>
" method="get" class="pagination">
			<p>
				<?php if (isset($_smarty_tpl->tpl_vars['search_query']->value)&&$_smarty_tpl->tpl_vars['search_query']->value){?><input type="hidden" name="search_query" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['search_query']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" /><?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['tag']->value)&&$_smarty_tpl->tpl_vars['tag']->value&&!is_array($_smarty_tpl->tpl_vars['tag']->value)){?><input type="hidden" name="tag" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['tag']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" /><?php }?>
				<label for="nb_item"><?php echo smartyTranslate(array('s'=>'items:'),$_smarty_tpl);?>
</label>
				<select name="n" id="nb_item">
				<?php $_smarty_tpl->tpl_vars["lastnValue"] = new Smarty_variable("0", null, 0);?>
				<?php  $_smarty_tpl->tpl_vars['nValue'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nValue']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['nArray']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nValue']->key => $_smarty_tpl->tpl_vars['nValue']->value){
$_smarty_tpl->tpl_vars['nValue']->_loop = true;
?>
					<?php if ($_smarty_tpl->tpl_vars['lastnValue']->value<=$_smarty_tpl->tpl_vars['nb_products']->value){?>
						<option value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['nValue']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['n']->value==$_smarty_tpl->tpl_vars['nValue']->value){?>selected="selected"<?php }?>><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['nValue']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</option>
					<?php }?>
					<?php $_smarty_tpl->tpl_vars["lastnValue"] = new Smarty_variable($_smarty_tpl->tpl_vars['nValue']->value, null, 0);?>
				<?php } ?>
				</select>
				<input onclick="javascript:plFilter()" type="button" class="csbutton cssecond" value="<?php echo smartyTranslate(array('s'=>'OK','mod'=>'plblog'),$_smarty_tpl);?>
" />
				<script type="text/javascript">
					function plFilter() {
						var action = jQuery('#plpagination').attr('action');
						var nb_item = jQuery('#nb_item').val();
						action = action + '<?php if ($_smarty_tpl->tpl_vars['url_rewrite']->value==1){?>?<?php }else{ ?>&<?php }?>n=' + nb_item;
						window.location = action;
					}
				</script>
			</p>
		</form>
	<?php }?>
	
<?php }?>
<?php }} ?>
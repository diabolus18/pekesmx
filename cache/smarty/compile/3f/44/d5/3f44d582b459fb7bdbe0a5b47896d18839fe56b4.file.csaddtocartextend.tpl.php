<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:03
         compiled from "/home/pekesmx/www/prestashop/modules/csaddtocartextend/csaddtocartextend.tpl" */ ?>
<?php /*%%SmartyHeaderCode:176943457253a1da33da73b3-35547127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f44d582b459fb7bdbe0a5b47896d18839fe56b4' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csaddtocartextend/csaddtocartextend.tpl',
      1 => 1401262787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '176943457253a1da33da73b3-35547127',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_name' => 0,
    '__PS_BASE_URI__' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da33e79a93_06457055',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da33e79a93_06457055')) {function content_53a1da33e79a93_06457055($_smarty_tpl) {?><!-- CS add to cart extend module -->
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'title_add_to_cart')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'title_add_to_cart'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Product added to cart','mod'=>'csaddtocartextend','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'title_add_to_cart'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<script type="text/javascript">
//<![CDATA[
	$(window).ready(function(){
		$('#add_to_cart input').attr('onclick', 'return OnAddclickDetail();');
		$('a.ajax_add_to_cart_button').attr('onclick', 'return OnAddclickCategory($(this));');
		$('#product_comparison a.ajax_add_to_cart_button').attr('onclick', 'return OnAddclickCompare($(this));');
	});
	
	<?php if ($_smarty_tpl->tpl_vars['page_name']->value=="category"){?>
		$(document).ajaxComplete(function( event,request, settings ) {
			$('#add_to_cart input').attr('onclick', 'return OnAddclickDetail();');
			$('a.ajax_add_to_cart_button').attr('onclick', 'return OnAddclickCategory($(this));');
		});
	<?php }?>
	
	function OnAddclickDetail() {
		var image_detail = $('#view_full_size img').attr('src');
		image_detail = image_detail.replace("large_default", "medium_default");
		var name_detail = $('div#pb-left-column h3').html();
		var id_detailt = $("input[name=id_product]").val();
		var link_detail = "<?php echo $_smarty_tpl->tpl_vars['__PS_BASE_URI__']->value;?>
index.php?id_product=" + id_detailt + "&controller=product";
		var string_info = "<a href=" + link_detail + " class=\"product_img_link\"><img src='" +  image_detail + "'/></a>" + "<div class='name_product'><h3><a href=" + link_detail + ">" + name_detail + "</a></h3></div> <?php echo smartyTranslate(array('s'=>'added to ','mod'=>'csaddtocartextend'),$_smarty_tpl);?>
<a href='<?php echo $_smarty_tpl->tpl_vars['__PS_BASE_URI__']->value;?>
index.php?controller=order' class='your_cart'><?php echo smartyTranslate(array('s'=>'Your Cart','mod'=>'csaddtocartextend'),$_smarty_tpl);?>
</a>" ;
		$.ambiance({
			message: string_info, 
			type: "success",
			title: title_add_to_cart,
			timeout:7
		});
	}
	
	function OnAddclickCategory(element) {
		var id_product = element.attr('rel').substring(16);
		var html_product = element.parent().html();
		
		$("body").append("<div id=\"add_to_card_extend_"+ id_product + "\" style=\"display:none\">" + html_product + "</div>")
		var image_p = $("#add_to_card_extend_" + id_product + " div.image").html();
		image_p = image_p.replace("home_default", "medium_default"); 
		image_p = image_p.replace("category_product", "medium_default"); 
		image_p = image_p.replace("prod_slider_home", "medium_default"); 
		var full_name=$("#add_to_card_extend_" + id_product + " div.name_product h3 a").attr("title");
			$("#add_to_card_extend_" + id_product + " div.name_product h3 a").html(full_name);
		var name_p = $("#add_to_card_extend_" + id_product + " div.name_product").html();
		$('div').remove("#add_to_card_extend_" + id_product + "");
		$.ambiance({
			message: image_p + "<div class='name_product'>" + name_p + "</div>" + "<?php echo smartyTranslate(array('s'=>'added to ','mod'=>'csaddtocartextend'),$_smarty_tpl);?>
<a href='<?php echo $_smarty_tpl->tpl_vars['__PS_BASE_URI__']->value;?>
index.php?controller=order' class='your_cart'><?php echo smartyTranslate(array('s'=>'Your Cart','mod'=>'csaddtocartextend'),$_smarty_tpl);?>
</a>", 
			type: "success",
			title: title_add_to_cart,
			timeout:7
		});
		
	}
	function OnAddclickCompare(element) {
		var id_product = element.attr('rel').substring(16);
		var html_product = document.getElementById("product_comparison").innerHTML;
		$("body").append("<div id=\"add_to_card_extend_"+ id_product + "\" style=\"display:none\">" + html_product + "</div>")
		var image_p = $("#add_to_card_extend_" + id_product + " div.image").html();
		image_p = image_p.replace("home_default", "medium_default"); 
		
		var full_name=$("#add_to_card_extend_" + id_product + " div.name_product h3 a").attr("title");
			$("#add_to_card_extend_" + id_product + " div.name_product h3 a").html(full_name);
		var name_p = $("#add_to_card_extend_" + id_product + " div.name_product").html();
		$('div').remove("#add_to_card_extend_" + id_product + "");
		$.ambiance({
			message: image_p + "<div class='name_product'>" + name_p + "</div>" + "<?php echo smartyTranslate(array('s'=>'added to ','mod'=>'csaddtocartextend'),$_smarty_tpl);?>
<a href='<?php echo $_smarty_tpl->tpl_vars['__PS_BASE_URI__']->value;?>
index.php?controller=order' class='your_cart'><?php echo smartyTranslate(array('s'=>'Your Cart','mod'=>'csaddtocartextend'),$_smarty_tpl);?>
</a>", 
			type: "success",
			title: title_add_to_cart,
			timeout:7
		});		
		
	}
	
	
	
//]]
</script>
<!-- /CS add to cart extend module -->

<?php }} ?>
<!-- CS add to cart extend module -->
{strip}
{addJsDefL name=title_add_to_cart}{l s='Product added to cart' mod='csaddtocartextend' js=1}{/addJsDefL}
{/strip}
<script type="text/javascript">
//<![CDATA[
	$(window).ready(function(){
		$('#add_to_cart input').attr('onclick', 'return OnAddclickDetail();');
		$('a.ajax_add_to_cart_button').attr('onclick', 'return OnAddclickCategory($(this));');
		$('#product_comparison a.ajax_add_to_cart_button').attr('onclick', 'return OnAddclickCompare($(this));');
	});
	
	{if $page_name=="category"}
		$(document).ajaxComplete(function( event,request, settings ) {
			$('#add_to_cart input').attr('onclick', 'return OnAddclickDetail();');
			$('a.ajax_add_to_cart_button').attr('onclick', 'return OnAddclickCategory($(this));');
		});
	{/if}
	
	function OnAddclickDetail() {
		var image_detail = $('#view_full_size img').attr('src');
		image_detail = image_detail.replace("large_default", "medium_default");
		var name_detail = $('div#pb-left-column h3').html();
		var id_detailt = $("input[name=id_product]").val();
		var link_detail = "{$__PS_BASE_URI__}index.php?id_product=" + id_detailt + "&controller=product";
		var string_info = "<a href=" + link_detail + " class=\"product_img_link\"><img src='" +  image_detail + "'/></a>" + "<div class='name_product'><h3><a href=" + link_detail + ">" + name_detail + "</a></h3></div> {l s='added to ' mod='csaddtocartextend'}<a href='{$__PS_BASE_URI__}index.php?controller=order' class='your_cart'>{l s='Your Cart' mod='csaddtocartextend'}</a>" ;
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
			message: image_p + "<div class='name_product'>" + name_p + "</div>" + "{l s='added to ' mod='csaddtocartextend'}<a href='{$__PS_BASE_URI__}index.php?controller=order' class='your_cart'>{l s='Your Cart' mod='csaddtocartextend'}</a>", 
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
			message: image_p + "<div class='name_product'>" + name_p + "</div>" + "{l s='added to ' mod='csaddtocartextend'}<a href='{$__PS_BASE_URI__}index.php?controller=order' class='your_cart'>{l s='Your Cart' mod='csaddtocartextend'}</a>", 
			type: "success",
			title: title_add_to_cart,
			timeout:7
		});		
		
	}
	
	
	
//]]
</script>
<!-- /CS add to cart extend module -->


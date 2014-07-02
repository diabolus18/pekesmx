function displayMode(view) {
	if ( $(".display").length == 0 ) {
	var html_static = '<div class="display"><div class="view_list_gird" id="view_list_gird"><span>'+text_list_grid+'</span><a onclick="displayMode(\'list\')" title="Grid"><b class="passive">grid</b></a><b class="active">List</b> </div></div> ';
	  $(html_static).insertAfter('#productsSortForm');
	}
	
			var text1 = "List";
			var text2 = "grid";
			if (view == 'grid') {				
			var arrayAtt = ['compare','image', 'name', 'product_desc', 'on_sale', 'discount' , 'content_price', 'online_only', 'btn_add_to_cart', 'view'];
				$('#product_list').addClass('product_grid');
				$('#product_list').removeClass('product_list');
				$('#post_list').addClass('pgrid');
				$('#post_list').removeClass('plist');
				$('.display').remove();
				$('<div class="display"><div class="view_list_gird"><span>'+text_list_grid+'</span><b class="active grid">' + text2 + '</b><a onclick="displayMode(\'list\')" title="List"><b class="passive list">' + text1 + '</b></a></div></div>').insertAfter('#productsSortForm');
				$.cookie('display', 'grid');
				$.cookie('display_class', 'product_grid'); 
			}
			else
			{
				$("#product_list").addClass("product_list");
				$("#product_list").removeClass("product_grid");
				$("#post_list").addClass("plist");
				$("#post_list").removeClass("pgrid");
				$('.display').remove();
				$('<div class="display"><div class="view_list_gird"><span>'+text_list_grid+'</span><a onclick="displayMode(\'grid\')" title="Grid"><b class="passive grid">' + text2 + '</b></a><b class="active list">' + text1 + '</b> </div></div>').insertAfter('#productsSortForm');
				$.cookie('display', 'list'); 
				$.cookie('display_class', 'product_list');
			}
}

view_list_gird = $.cookie('display');
$(window).ready(function(){
if (view_list_gird) {
	displayMode(view_list_gird);
	
} else {
	$(".sort_desc_product").css("display","none");
	displayMode('grid');
}
});
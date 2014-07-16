<?php /*%%SmartyHeaderCode:138665067553a1da3ecba0a9-71641901%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e77ee55d64e99b96122a528ebd7f22a7d86bd5d' => 
    array (
      0 => '/home/pekesmx/www/prestashop/themes/electronues/modules/productscategory/productscategory.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138665067553a1da3ecba0a9-71641901',
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53c5ee0366c147_72312752',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c5ee0366c147_72312752')) {function content_53c5ee0366c147_72312752($_smarty_tpl) {?>
<div class="clearfix box0 blockproductscategory">
	<div class="title"><h3 class="productscategory_h2">1 otros productos de la misma categoría:</h3></div>
	<div id="productscategory_noscroll">
		<div id="productscategory_list" class="list_carousel responsive">
			<ul id="carousel-productscategory" >
								<li style="width:60px" data-animate="bounceIn" data-delay="0">
				<div class="center_block">
				<div class="image">
					<a href="http://pekes.mx/andaderas/176-andadera-infanti-con-charola-elec-bubbles-cyan-and-green-7501118137709.html" class="product_img_link" title=""><img src="http://pekes.mx/444-home_default/andadera-infanti-con-charola-elec-bubbles-cyan-and-green.jpg" alt="Andadera infanti con charola Elec Bubbles Cyan and green" /></a>
				</div>
					<div class="name_product">
						<h3>
							<a href="http://pekes.mx/andaderas/176-andadera-infanti-con-charola-elec-bubbles-cyan-and-green-7501118137709.html" title="Andadera infanti con charola Elec Bubbles Cyan and green">Andadera infanti con charola Elec Bubbles Cyan and green</a>
						</h3>
					</div>
										<span class="availability">Available</span>										
					<p class="product_desc"></p>
																												<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_176" href="http://pekes.mx/carro-de-la-compra?add=&id_product=176&token=3c5da22d25d0ae51a103c8d668c01beb" title="Add to cart">Add to cart</a>
												
													</div>
				</li>
							</ul>
			<div class="cclearfix"></div>
			<a id="prev-productscategory" class="btn prev" href="#">&lt;</a>
			<a id="next-productscategory" class="btn next" href="#">&gt;</a>
		</div>
	</div>
	<script type="text/javascript">
		$(window).load(function(){
			//	Responsive layout, resizing the items
			$('#carousel-productscategory').carouFredSel({
				responsive: true,
				auto: false,
				width:'100%',
				height : 'variable',
				prev: '#prev-productscategory',
				next: '#next-productscategory',
				swipe: {
					onTouch : true
				},
				scroll:{
					items:2
				},
				items: {
					height : 'auto',
					width: 255,
					visible: {
						min: 1,
						max: 3
					}
				}
			});
			 $('#prev-productscategory, #next-productscategory').bind('click', function() {
			  if(touch == false){
				var that = $("#productscategory_list");
				var items = that.find('.not-animated');
				items.removeClass('not-animated').unbind('appear');
				
				items = that.find('.animated');
				items.removeClass('animated').unbind('appear');
			  }
			});
		});
	</script>
</div>
<?php }} ?>
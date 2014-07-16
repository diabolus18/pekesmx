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
  'unifunc' => 'content_53c5ed5d2e5913_10519617',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c5ed5d2e5913_10519617')) {function content_53c5ed5d2e5913_10519617($_smarty_tpl) {?>
<div class="clearfix box0 blockproductscategory">
	<div class="title"><h3 class="productscategory_h2">3 otros productos de la misma categoría:</h3></div>
	<div id="productscategory_noscroll">
		<div id="productscategory_list" class="list_carousel responsive">
			<ul id="carousel-productscategory" >
								<li style="width:60px" data-animate="bounceIn" data-delay="0">
				<div class="center_block">
				<div class="image">
					<a href="http://pekes.mx/baberos/207-babero-sublimado-set-de-3-piezas-nino-dli-7503000382327.html" class="product_img_link" title=""><img src="http://pekes.mx/img/p/mx-default-home_default.jpg" alt="Babero sublimado set de 3 piezas Niño DLI" /></a>
				</div>
					<div class="name_product">
						<h3>
							<a href="http://pekes.mx/baberos/207-babero-sublimado-set-de-3-piezas-nino-dli-7503000382327.html" title="Babero sublimado set de 3 piezas Niño DLI">Babero sublimado set de 3 piezas Ni&ntilde;o DLI</a>
						</h3>
					</div>
										<span class="availability">Available</span>										
					<p class="product_desc">Set de tres Baberos de toalla ahulada con hermoso dise&ntilde;o de Le&oacute;n impreso,...</p>
																												<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_207" href="http://pekes.mx/carro-de-la-compra?add=&id_product=207&token=3c5da22d25d0ae51a103c8d668c01beb" title="Add to cart">Add to cart</a>
												
													</div>
				</li>
								<li style="width:60px" data-animate="bounceIn" data-delay="0">
				<div class="center_block">
				<div class="image">
					<a href="http://pekes.mx/fulares-y-rebozos/237-rebozo-osita.html" class="product_img_link" title=""><img src="http://pekes.mx/540-home_default/rebozo-osita.jpg" alt="Rebozo Osita" /></a>
				</div>
					<div class="name_product">
						<h3>
							<a href="http://pekes.mx/fulares-y-rebozos/237-rebozo-osita.html" title="Rebozo Osita">Rebozo Osita</a>
						</h3>
					</div>
										<span class="availability">Available</span>										
					<p class="product_desc">Rebozo c&oacute;modo y seguro ya que cuenta con sujetador interior.
Soporta hasta 9...</p>
																												<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_237" href="http://pekes.mx/carro-de-la-compra?add=&id_product=237&token=3c5da22d25d0ae51a103c8d668c01beb" title="Add to cart">Add to cart</a>
												
													</div>
				</li>
								<li style="width:60px" data-animate="bounceIn" data-delay="0">
				<div class="center_block">
				<div class="image">
					<a href="http://pekes.mx/panaleras/231-panalera-jirafita.html" class="product_img_link" title=""><img src="http://pekes.mx/534-home_default/panalera-jirafita.jpg" alt="Pañalera Jirafita" /></a>
				</div>
					<div class="name_product">
						<h3>
							<a href="http://pekes.mx/panaleras/231-panalera-jirafita.html" title="Pañalera Jirafita">Pa&ntilde;alera Jirafita</a>
						</h3>
					</div>
										<span class="availability">Available</span>										
					<p class="product_desc">Pr&aacute;ctica y ligera pa&ntilde;alera. Cuenta con dos compartimentos exteriores para...</p>
																												<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_231" href="http://pekes.mx/carro-de-la-compra?add=&id_product=231&token=3c5da22d25d0ae51a103c8d668c01beb" title="Add to cart">Add to cart</a>
												
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
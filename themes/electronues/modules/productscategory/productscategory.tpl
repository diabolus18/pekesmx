{*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if count($categoryProducts) > 0 && $categoryProducts !== false}
<div class="clearfix box0 blockproductscategory">
	<div class="title"><h3 class="productscategory_h2">{$categoryProducts|@count} {l s='other products in the same category:' mod='productscategory'}</h3></div>
	<div id="{if count($categoryProducts) > 5}productscategory{else}productscategory_noscroll{/if}">
		<div id="productscategory_list" class="list_carousel responsive">
			<ul id="carousel-productscategory" {if count($categoryProducts) > 5}style="width: {math equation="width * nbImages" width=107 nbImages=$categoryProducts|@count}px"{/if}>
				{foreach from=$categoryProducts item='categoryProduct' name=categoryProduct}
				<li {if count($categoryProducts) < 6}style="width:60px"{/if} data-animate="bounceIn" data-delay="0">
				<div class="center_block">
				<div class="image">
					<a href="{$link->getProductLink($categoryProduct.id_product, $categoryProduct.link_rewrite, $categoryProduct.category, $categoryProduct.ean13)}" class="product_img_link" title=""><img src="{$link->getImageLink($categoryProduct.link_rewrite, $categoryProduct.id_image, 'home_default')}" alt="{$categoryProduct.name|htmlspecialchars}" /></a>
				</div>
					<div class="name_product">
						<h3>
							<a href="{$link->getProductLink($categoryProduct.id_product, $categoryProduct.link_rewrite, $categoryProduct.category, $categoryProduct.ean13)}" title="{$categoryProduct.name|htmlspecialchars}">{$categoryProduct.name|truncate:60:'...'|escape:'htmlall':'UTF-8'}</a>
						</h3>
					</div>
					{if isset($categoryProduct.available_for_order) && $categoryProduct.available_for_order && !isset($restricted_country_mode)}{if ($categoryProduct.allow_oosp || $categoryProduct.quantity > 0)}
					<span class="availability">{l s='Available'}</span>{elseif (isset($categoryProduct.quantity_all_versions) && $categoryProduct.quantity_all_versions > 0)}<span class="availability">{l s='Product available with different options'}</span>{else}
					<span class="cs_out_of_stock">{l s='Out of stock'}</span>{/if}
					{/if}					
					<p class="product_desc">{$categoryProduct.description_short|strip_tags:'UTF-8'|truncate:90:'...'}</p>
					{if $ProdDisplayPrice AND $categoryProduct.show_price == 1 AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
					<p class="price_display">
						<span class="price">{convertPrice price=$categoryProduct.displayed_price}</span>
					</p>
					{/if}
					{if ($categoryProduct.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $categoryProduct.available_for_order && !isset($restricted_country_mode) && $categoryProduct.minimal_quantity <= 1 && $categoryProduct.customizable != 2 && !$PS_CATALOG_MODE}
					{if ($categoryProduct.allow_oosp || $categoryProduct.quantity > 0)}
						{if isset($static_token)}
							<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_{$categoryProduct.id_product|intval}" href="{$link->getPageLink('cart',false, NULL, "add&amp;id_product={$categoryProduct.id_product|intval}&amp;token={$static_token}", false)}" title="{l s='Add to cart'}">{l s='Add to cart' mod='productscategory'}</a>
						{else}
							<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_{$categoryProduct.id_product|intval}" href="{$link->getPageLink('cart',false, NULL, "add&amp;id_product={$categoryProduct.id_product|intval}", false)}" title="{l s='Add to cart'}">{l s='Add to cart' mod='productscategory'}</a>
						{/if}						
					{else}
						<span class="csbutton cssecond">{l s='Out of stock' mod='productscategory'}</span>
					{/if}
				{/if}
				</div>
				</li>
				{/foreach}
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
{/if}

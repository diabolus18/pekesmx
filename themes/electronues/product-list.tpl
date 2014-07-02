{*
* 2007-2014 PrestaShop
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
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if isset($products)}
	{if isset($number_p)}
		{assign var=numberperpage value=$number_p}
	{else}
		{assign var=numberperpage value=3}
	{/if}
	<ul id="product_list" class="clear {if isset($smarty.cookies.display_class)}{$smarty.cookies.display_class}{/if}">
	{foreach from=$products item=product name=products}
		
		
		<li class="grid_6 alpha omega ajax_block_product {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{/if} {if $smarty.foreach.products.index % $numberperpage == 0}alpha clear{elseif ($smarty.foreach.products.index+1) % $numberperpage == 0}omega{/if} clearfix" data-animate="bounceIn" data-delay="0">
			<div class="center_block" itemscope itemtype="http://schema.org/Product">				
				<div class="image"><a href="{$product.link|escape:'htmlall':'UTF-8'}" class="product_img_link" title="">
					<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'category_product')}" alt=""  itemprop="image" />
					{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="on_sale"><span>{l s='sale off'}</span></span>{/if}
				</a>
				{if $product.specific_prices}
					{if $product.specific_prices.reduction>0}
						{if $product.specific_prices.reduction_type == 'percentage'}
							<span class="on_sale">
								<span class="percen">
									-{$product.specific_prices.reduction*100}%
								</span>
							</span>
						{else}
							<span class="on_sale">
								<span class="amount">
									{$price_drop=$product.price_without_reduction-$product.price}
									-{convertPrice price=$price_drop}
								</span>
							</span>
						{/if}
					{/if}
				{/if}
				</div>
				<div class="name_product"><h3><a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|escape:'htmlall':'UTF-8'|truncate:45:'...'}</a></h3></div>
				{if isset($product.available_for_order) && $product.available_for_order && !isset($restricted_country_mode)}{if ($product.allow_oosp || $product.quantity > 0)}
					<span class="availability">{l s='Available'}</span>{elseif (isset($product.quantity_all_versions) && $product.quantity_all_versions > 0)}<span class="availability">{l s='Product available with different options'}</span>{else}
					<span class="cs_out_of_stock">{l s='Out of stock'}</span>{/if}
				{/if}
				{if isset($product.online_only) && $product.online_only}
					<span class="online_only">{l s='Online only!'}</span>
				{/if}
				
				<p class="product_desc">{$product.description_short|strip_tags:'UTF-8'|truncate:90:'...'}</p>
				{if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
				<div class="content_price">
					{if $product.reduction}<span class="price old">{convertPrice price=$product.price_without_reduction}</span>{/if}	
					{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}<span class="price{if $product.reduction}{/if}">{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}</span>{/if}
				</div>
				
				{/if}
				
			{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
					{if ($product.allow_oosp || $product.quantity > 0)}
						{if isset($static_token)}
							<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_{$product.id_product|intval}" href="{$link->getPageLink('cart',false, NULL, "add&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)}" title="">{l s='Add to cart'}</a>
						{else}
							<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_{$product.id_product|intval}" href="{$link->getPageLink('cart',false, NULL, "add&amp;id_product={$product.id_product|intval}", false)}" title="">{l s='Add to cart'}</a>
						{/if}						
					{else}
						<span class="csbutton cssecond">{l s='Out of stock'}</span>
					{/if}
				{/if}
				{hook h='displayProductListFunctionalButtons' product=$product}
				{if isset($comparator_max_item) && $comparator_max_item}
					<p class="compare">
						<input type="checkbox" class="comparator" id="comparator_item_{$product.id_product}" value="comparator_item_{$product.id_product}" {if isset($compareProducts) && in_array($product.id_product, $compareProducts)}checked="checked"{/if} /> 
						<label for="comparator_item_{$product.id_product}">{l s='Select to compare'}</label>
					</p>
				{/if}
			</div>
		</li>
	{/foreach}
	</ul>
	<!-- /Products list -->
	
{/if}

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

<!-- MODULE Block new products -->
<div id="new-products_block_right" class="box1 products_block">
	<div class="title"><h3><a href="{$link->getPageLink('new-products')}" title="{l s='New products' mod='blocknewproducts'}">{l s='New products' mod='blocknewproducts'}</a></h3></div>
	<div class="box-content">
	{if $new_products !== false}
		<ul class="product_grid clearfix">
		{foreach from=$new_products item='newproduct' name='newProducts'}
			{if $smarty.foreach.newProducts.index < 2}
				<li{if $smarty.foreach.newProducts.last} class="last_item"{elseif $smarty.foreach.newProducts.first} class="first_item"{/if}>
					<div class="image">
						<a href="{$newproduct.link}" title="" class="content_img"><img src="{$link->getImageLink($newproduct.link_rewrite, $newproduct.id_image, 'home_default')}" alt="" /></a>
					</div>
					<div class="name_product">
						<h3><a href="{$newproduct.link}" title="{$newproduct.name|escape:html:'UTF-8'}">{$newproduct.name|strip_tags|escape:html:'UTF-8'}</a></h3>
					</div>
					{if $newproduct.description_short}<p class="product_desc">{$newproduct.description_short|strip_tags:'UTF-8'|truncate:75:'...'}</p>
					<p><a class="csreadmore" href="{$newproduct.link}" class="lnk_more">{l s='Read more +' mod='blocknewproducts'}</a></p>{/if}
				</li>
			{/if}
		{/foreach}
		</ul>
		
		<p><a href="{$link->getPageLink('new-products')}" title="{l s='All new products' mod='blocknewproducts'}" class="csbutton cssecond">&raquo; {l s='All new products' mod='blocknewproducts'}</a></p>
	{else}
		<p>&raquo; {l s='No new products at this time' mod='blocknewproducts'}</p>
	{/if}
	</div>
</div>
<!-- /MODULE Block new products -->
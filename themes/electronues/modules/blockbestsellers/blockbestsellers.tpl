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

<!-- MODULE Block best sellers -->
<div id="best-sellers_block_right" class="box1 products_block" data-animate="fadeInDown" data-delay="0">
	<h3 class="title"><a href="{$link->getPageLink('best-sales')}">{l s='Top sellers' mod='blockbestsellers'}</a></h3>
	<div class="box-content">
	{if $best_sellers|@count > 0}
		<ul class="product_grid">
			{foreach from=$best_sellers item=product name=myLoop}
			{if $smarty.foreach.myLoop.index < 2}
			<li class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if} clearfix">
				<div class="image">
					<a href="{$product.link}" class="content_img clearfix">
						<!-- <span class="number">{$smarty.foreach.myLoop.iteration}</span> -->
						<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')}" alt="" />
					
					</a>
				</div>
				<div class="name_product"><h3><a href="{$product.link}" title="{$product.legend|escape:'htmlall':'UTF-8'}">
					{$product.name|strip_tags:'UTF-8'|escape:'htmlall':'UTF-8'}				</a></h3></div>
				<p class="product_desc">{$product.description_short|strip_tags:'UTF-8'|truncate:75:'...'}</p>
				<span class="price">{$product.price}</span>
			</li>
			{/if}
		{/foreach}
		</ul>
		<p class="lnk"><a href="{$link->getPageLink('best-sales')}" title="{l s='All best sellers' mod='blockbestsellers'}" class="csbutton cssecond">&raquo; {l s='All best sellers' mod='blockbestsellers'}</a></p>
	{else}
		<p>{l s='No best sellers at this time' mod='blockbestsellers'}</p>
	{/if}
	</div>
</div>
<!-- /MODULE Block best sellers -->

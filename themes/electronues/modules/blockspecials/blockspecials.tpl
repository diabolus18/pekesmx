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

<!-- MODULE Block specials -->
<div id="special_block_right" class="box1 products_block exclusive blockspecials" data-animate="fadeInDown" data-delay="0">
	<div class="title"><h3><a href="{$link->getPageLink('prices-drop')}" title="{l s='Specials' mod='blockspecials'}">{l s='Specials' mod='blockspecials'}</a></h3></div>
	<div class="box-content">
	{if $special}
		<ul class="product_grid clearfix">	
			<li class="first_item">
			<div class="image">
				<a href="{$special.link}" class="content_img"><img src="{$link->getImageLink($special.link_rewrite, $special.id_image, 'home_default')}" alt="" title="" /></a>
				{if !$PS_CATALOG_MODE}
				{if $special.specific_prices}
					{assign var='specific_prices' value=$special.specific_prices}
					{if $specific_prices.reduction_type == 'percentage' && ($specific_prices.from == $specific_prices.to OR ($smarty.now|date_format:'%Y-%m-%d %H:%M:%S' <= $specific_prices.to && $smarty.now|date_format:'%Y-%m-%d %H:%M:%S' >= $specific_prices.from))}
						<span class="on_sale"><span>-{$specific_prices.reduction*100|floatval}%</span></span>
					{/if}
				{/if}
				{/if}
			</div>			
			
			<div class="name_product">
				<h3><a href="{$special.link}" title="{$special.name|escape:html:'UTF-8'}">{$special.name|escape:html:'UTF-8'}</a></h3>
			</div>
			<p class="product_desc">{$special.description_short|strip_tags:'UTF-8'|truncate:75:'...'}</p>
			{if !$PS_CATALOG_MODE}
				<span class="price old">{if !$priceDisplay}{displayWtPrice p=$special.price_without_reduction}{else}{displayWtPrice p=$priceWithoutReduction_tax_excl}{/if}</span>
				<span class="price">{if !$priceDisplay}{displayWtPrice p=$special.price}{else}{displayWtPrice p=$special.price_tax_exc}{/if}</span>
			{/if}
			</li>
		</ul>
		<br/>
		<p style="text-align:right; clear:both">
			<a href="{$link->getPageLink('prices-drop')}" title="{l s='All specials' mod='blockspecials'}" class="csbutton cssecond">&raquo; {l s='All specials' mod='blockspecials'}</a>
		</p>
{else}
		<p>{l s='No specials at this time' mod='blockspecials'}</p>
{/if}
	</div>
</div>
<!-- /MODULE Block specials -->
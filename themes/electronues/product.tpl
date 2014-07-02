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

{include file="$tpl_dir./errors.tpl"}
{if $errors|@count == 0}
{if !isset($priceDisplayPrecision)}
		{assign var='priceDisplayPrecision' value=2}
	{/if}
	{if !$priceDisplay || $priceDisplay == 2}
		{assign var='productPrice' value=$product->getPrice(true, $smarty.const.NULL, $priceDisplayPrecision)}
		{assign var='productPriceWithoutReduction' value=$product->getPriceWithoutReduct(false, $smarty.const.NULL)}
	{elseif $priceDisplay == 1}
		{assign var='productPrice' value=$product->getPrice(false, $smarty.const.NULL, $priceDisplayPrecision)}
		{assign var='productPriceWithoutReduction' value=$product->getPriceWithoutReduct(true, $smarty.const.NULL)}
	{/if}
<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {
		cs_resize_tab();
		$('div.title_hide_show').first().addClass('selected');
	$('#more_info_sheets').on('click', '.title_hide_show', function() {
		$(this).next().toggle();
		if($(this).next().css('display') == 'block'){
			$(this).addClass('selected');
		}else{
			$(this).removeClass('selected');
		}
		return false;
	}).next().hide();
	
});
$(window).resize(function() {
	cs_resize_tab();
});

function cs_resize_tab()	{
		if(!isMobile())
		{
			$('.content_hide_show').removeAttr( 'style' );
		}
		if(getWidthBrowser() < 767){
			$('#more_info_tabs').hide();
			$('div.title_hide_show').show();
		} else {
			$('div.title_hide_show').hide();
			$('#more_info_tabs').show();
		}
	}
$(window).load(function(){
	//	Responsive layout, resizing the items
	$('#thumbs_list_frame').carouFredSel({
		responsive: true,
		width: '100%',
		height : 'variable',
		prev: '#prev-thumnail',
		next: '#next-thumnail',
		auto: false,
		swipe: {
			onTouch : true
		},
		scroll:{
			items:2
		},
		items: {
			width: 90,
			height : 'variable',
			visible: {
				min: 2,
				max: 3
			}
		}
	});
});


$('.cart_quantity_up').unbind('click').live('click', function(){
	var qty_now=$("#quantity_wanted").val();	
		if(parseInt(qty_now))
			{
			var qty_new=parseInt(qty_now)+1;
			$("#quantity_wanted").val(qty_new);
			}
		else
			$("#quantity_wanted").val(1);
});
$('.cart_quantity_down').unbind('click').live('click', function(){
	var qty_now=$("#quantity_wanted").val();
	if(parseInt(qty_now) && parseInt(qty_now)>1)
	{
		var qty_new=parseInt(qty_now)-1;
		$("#quantity_wanted").val(qty_new);
	}
	else
	{
		$("#quantity_wanted").val(1);
	}
});
//]]>
</script>
{if $content_only}<div id="module-csquickview-csproduct">{/if}
<div id="primary_block" class="{if $content_only}cs_quickshop {/if}clearfix" itemscope itemtype="http://schema.org/Product">

	{if isset($adminActionDisplay) && $adminActionDisplay}
	<div id="admin-action">
		<p>{l s='This product is not visible to your customers.'}
		<input type="hidden" id="admin-action-product-id" value="{$product->id}" />
		<input type="submit" value="{l s='Publish'}" class="csbutton csdefault" onclick="submitPublishProduct('{$base_dir}{$smarty.get.ad|escape:'htmlall':'UTF-8'}', 0, '{$smarty.get.adtoken|escape:'htmlall':'UTF-8'}')"/>
		<input type="submit" value="{l s='Back'}" class="csbutton cssecond" onclick="submitPublishProduct('{$base_dir}{$smarty.get.ad|escape:'htmlall':'UTF-8'}', 1, '{$smarty.get.adtoken|escape:'htmlall':'UTF-8'}')"/>
		</p>
		<p id="admin-action-result"></p>
	</div>
	{/if}

	{if isset($confirmation) && $confirmation}
	<p class="confirmation">
		{$confirmation}
	</p>
	{/if}
<div class="clearfix">
	<!-- right infos-->
	<div id="pb-right-column">
		<!-- product img-->
		<div id="image-block" class="clearfix">
		{if $have_image}
			{if $jqZoomEnabled && $have_image && !$content_only}
				<div id="view_full_size">
				<a class="jqzoom" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" rel="gal1" href="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'thickbox_default')|escape:'html':'UTF-8'}" itemprop="url">
					<img itemprop="image" id="bigpic1" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large_default')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}"/>
				</a>
				</div>
			{else}				
				<span id="view_full_size">
				<img itemprop="image" id="bigpic1" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large_default')}" />
					{if !$content_only}<span class="span_link">{l s='View full size'}</span>{/if}
				</span>
			{/if}
		{else}
		<span id="view_full_size">
				<img itemprop="image" src="{$img_prod_dir}{$lang_iso}-default-large_default.jpg" id="bigpic" alt="" title="{$product->name|escape:'html':'UTF-8'}" width="{$largeSize.width}" height="{$largeSize.height}"/>
				{if !$content_only}
					<span class="span_link">
						{l s='View larger'}
					</span>
				{/if}
			</span>
		{/if}
		</div>
		{if isset($images) && count($images) > 0}
		<!-- thumbnails -->
		<div id="views_block" class="clearfix {if isset($images) && count($images) < 2}hidden{/if}">
		
			<div id="thumbs_list">
				<ul id="thumbs_list_frame">
					{if isset($images)}
						{foreach from=$images item=image name=thumbnails}
						{assign var=imageIds value="`$product->id`-`$image.id_image`"}
						<li id="thumbnail_{$image.id_image}">						
							<a {if $jqZoomEnabled && $have_image && !$content_only} href="javascript:void(0);"  rel="{literal}{{/literal}gallery: 'gal1', smallimage: '{$link->getImageLink($product->link_rewrite, $imageIds, 'large_default')|escape:'html':'UTF-8'}',largeimage: '{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox_default')|escape:'html':'UTF-8'}'{literal}}{/literal}" {else}
								href="{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox_default')|escape:'html':'UTF-8'}"
								data-fancybox-group="other-views"
								class="fancybox{if $image.id_image == $cover.id_image} shown{/if}"
							{/if}>
								<img id="thumb_{$image.id_image}" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'medium_default')}" alt="{$image.legend|htmlspecialchars}"/>
							</a>
					
					</li>
					{/foreach}
				{/if}
			</ul>
			<a id="prev-thumnail" class="btn prev" href="#">&lt;</a>
			<a id="next-thumnail" class="btn next" href="#">&gt;</a>
		</div>
		
		</div>
		{/if}
		{if isset($images) && count($images) > 1}<p class="resetimg clear"><span id="wrapResetImages" style="display: none;"><img src="{$img_dir}icon/display_all.png" alt="{l s='Cancel'}"/> <a id="resetImages" href="{$link->getProductLink($product)}" onclick="$('span#wrapResetImages').hide('slow');return (false);">{l s='Display all pictures'}</a></span></p>{/if}
		<!-- usefull links-->
		{if !$content_only}
		<ul id="usefull_link_block">
			{if $HOOK_EXTRA_LEFT}{$HOOK_EXTRA_LEFT}{/if}
			<li class="print"><a href="javascript:print();">{l s='Print'}</a></li>
			{if $have_image && !$jqZoomEnabled}
			{/if}
		</ul>
		{/if}			
	</div>
	<!-- end right info -->

	<!-- left infos-->
	<div id="pb-left-column">
		<h3 itemprop="name">{$product->name|escape:'htmlall':'UTF-8'}</h3>
		<p id="product_reference" {if isset($groups) OR !$product->reference}style="display: none;"{/if}>
			<label for="product_reference">{l s='Reference:'} </label>
			<span class="editable">{$product->reference|escape:'htmlall':'UTF-8'}</span>
		</p>
		{if $product->description_short OR $packItems|@count > 0}
		<div id="short_description_block">
			{if $product->description_short}
				<div id="short_description_content" class="rte align_justify" itemprop="description">{$product->description_short}</div>
			{/if}
			{if $product->description}
			<p class="buttons_bottom_block"><a href="javascript:{ldelim}{rdelim}" class="button">{l s='More details'}</a></p>
			{/if}
			{if $packItems|@count > 0}
			<div class="short_description_pack">
				<h3>{l s='Pack content'}</h3>
				{foreach from=$packItems item=packItem}
				<div class="pack_content">
					{$packItem.pack_quantity} x <a href="{$link->getProductLink($packItem.id_product, $packItem.link_rewrite, $packItem.category)|escape:'html'}">{$packItem.name|escape:'htmlall':'UTF-8'}</a>
					<p>{$packItem.description_short}</p>
				</div>
				{/foreach}
			</div>
			{/if}
		</div>
		{/if}

		{*{if isset($colors) && $colors}
		<!-- colors -->
		<div id="color_picker">
			<p>{l s='Pick a color:' js=1}</p>
			<div class="clear"></div>
			<ul id="color_to_pick_list" class="clearfix">
			{foreach from=$colors key='id_attribute' item='color'}
				<li><a id="color_{$id_attribute|intval}" class="color_pick" style="background: {$color.value};" onclick="updateColorSelect({$id_attribute|intval});$('#wrapResetImages').show('slow');" title="{$color.name}">{if file_exists($col_img_dir|cat:$id_attribute|cat:'.jpg')}<img src="{$img_col_dir}{$id_attribute}.jpg" alt="{$color.name}" width="20" height="20" />{/if}</a></li>
			{/foreach}
			</ul>
			<div class="clear"></div>
		</div>
		{/if}*}

		{if ($product->show_price AND !isset($restricted_country_mode)) OR isset($groups) OR $product->reference OR (isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS)}
		<!-- add to cart form-->
		<form id="buy_block" {if $PS_CATALOG_MODE AND !isset($groups) AND $product->quantity > 0}class="hidden"{/if} action="{$link->getPageLink('cart')|escape:'html'}" method="post">

			<!-- hidden datas -->
			<p class="hidden">
				<input type="hidden" name="token" value="{$static_token}" />
				<input type="hidden" name="id_product" value="{$product->id|intval}" id="product_page_product_id" />
				<input type="hidden" name="add" value="1" />
				<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
			</p>

			<div class="product_attributes">
			<div id="attributes">
				{if isset($groups)}
				<!-- attributes -->
				{foreach from=$groups key=id_attribute_group item=group}
					{if $group.attributes|@count}
						<div class="attribute_fieldset">
							<label class="attribute_label" for="group_{$id_attribute_group|intval}">{$group.name|escape:'htmlall':'UTF-8'} :&nbsp;</label>
							{assign var="groupName" value="group_$id_attribute_group"}
							<div class="attribute_list">
							{if ($group.group_type == 'select')}
								<select name="{$groupName}" id="group_{$id_attribute_group|intval}" class="attribute_select" onchange="findCombination();getProductAttribute();">
									{foreach from=$group.attributes key=id_attribute item=group_attribute}
										<option value="{$id_attribute|intval}"{if (isset($smarty.get.$groupName) && $smarty.get.$groupName|intval == $id_attribute) || $group.default == $id_attribute} selected="selected"{/if} title="{$group_attribute|escape:'htmlall':'UTF-8'}">{$group_attribute|escape:'htmlall':'UTF-8'}</option>
									{/foreach}
								</select>
							{elseif ($group.group_type == 'color')}
								<ul id="color_to_pick_list" class="clearfix">
									{assign var="default_colorpicker" value=""}
									{foreach from=$group.attributes key=id_attribute item=group_attribute}
									<li{if $group.default == $id_attribute} class="selected"{/if}>
										<a id="color_{$id_attribute|intval}" class="color_pick{if ($group.default == $id_attribute)} selected{/if}" style="background: {$colors.$id_attribute.value};" title="{$colors.$id_attribute.name}" onclick="colorPickerClick(this);getProductAttribute();">
											{if file_exists($col_img_dir|cat:$id_attribute|cat:'.jpg')}
												<img src="{$img_col_dir}{$id_attribute}.jpg" alt="{$colors.$id_attribute.name}" width="20" height="20" /><br />
											{/if}
										</a>
									</li>
									{if ($group.default == $id_attribute)}
										{$default_colorpicker = $id_attribute}
									{/if}
									{/foreach}
								</ul>
								<input type="hidden" class="color_pick_hidden" name="{$groupName}" value="{$default_colorpicker}" />
							{elseif ($group.group_type == 'radio')}
								<ul>
									{foreach from=$group.attributes key=id_attribute item=group_attribute}
										<li>
											<input type="radio" class="attribute_radio" name="{$groupName}" value="{$id_attribute}" {if ($group.default == $id_attribute)} checked="checked"{/if} onclick="findCombination();getProductAttribute();" />
											<span>{$group_attribute|escape:'htmlall':'UTF-8'}</span>
										</li>
									{/foreach}
								</ul>
							{/if}
							</div>
						</div>
					{/if}
				{/foreach}
				{/if}
				
			</div>
			
			
		</div>
		<!-- availability -->
		<p id="availability_statut"{if ($product->quantity <= 0 && !$product->available_later && $allow_oosp) OR ($product->quantity > 0 && !$product->available_now) OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if}>
			<span id="availability_label">{l s='Availability:'}</span>
			<span id="availability_value"{if $product->quantity <= 0} class="warning_inline"{/if}>{if $product->quantity <= 0}{if $allow_oosp}{$product->available_later}{else}{l s='This product is no longer in stock'}{/if}{else}{$product->available_now}{/if}</span>				
		</p>
		<p id="availability_date"{if ($product->quantity > 0) OR !$product->available_for_order OR $PS_CATALOG_MODE OR !isset($product->available_date) OR $product->available_date < $smarty.now|date_format:'%Y-%m-%d'} style="display: none;"{/if}>
			<span id="availability_date_label">{l s='Availability date:'}</span>
			<span id="availability_date_value">{dateFormat date=$product->available_date full=false}</span>
		</p>
		<!-- number of item in stock -->
		{if ($display_qties == 1 && !$PS_CATALOG_MODE && $product->available_for_order)}
		<p id="pQuantityAvailable"{if $product->quantity <= 0} style="display: none;"{/if}>
			<span id="quantityAvailable">{$product->quantity|intval}</span>
			<span {if $product->quantity > 1} style="display: none;"{/if} id="quantityAvailableTxt">{l s='Item in stock'}</span>
			<span {if $product->quantity == 1} style="display: none;"{/if} id="quantityAvailableTxtMultiple">{l s='Items in stock'}</span>
		</p>
		{/if}

		<!-- Out of stock hook -->
		<div id="oosHook"{if $product->quantity > 0} style="display: none;"{/if}>	
		</div>
		{$HOOK_PRODUCT_OOS}

		<p class="warning_inline" id="last_quantities"{if ($product->quantity > $last_qties OR $product->quantity <= 0) OR $allow_oosp OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none"{/if} >{l s='Warning: Last items in stock!'}</p>
			
			
		<div class="content_prices clearfix" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<link itemprop="availability" {if $product->quantity <= 0}href="http://schema.org/OutOfStock"{else}href="http://schema.org/InStock"{/if}>
			{if $product->show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}

			{if $product->online_only}
			<p class="online_only">{l s='Online only'}</p>
			{/if}
			
			{if $product->on_sale}
				<div class="sale">
						<img src="{$img_dir}onsale_{$lang_iso}.gif" alt="{l s='On sale'}" class="on_sale_img"/>
						<span class="on_sale">{l s='On sale!'}</span>
				</div>
			{elseif $product->specificPrice AND $product->specificPrice.reduction AND $productPriceWithoutReduction > $productPrice}
				<span class="discount">{l s='Reduced price!'}</span>
			
			<div id="reduction_percent" {if !$product->specificPrice OR $product->specificPrice.reduction_type != 'percentage'} style="display:none;"{/if}><span id="reduction_percent_display">{if $product->specificPrice AND $product->specificPrice.reduction_type == 'percentage'}-{$product->specificPrice.reduction*100}%{/if}</span>
				<p id="reduction_amount" {if !$product->specificPrice OR $product->specificPrice.reduction_type != 'amount' || $product->specificPrice.reduction|intval ==0} style="display:none"{/if}>
					<span id="reduction_amount_display">
						{if $product->specificPrice AND $product->specificPrice.reduction_type == 'amount' AND $product->specificPrice.reduction|intval !=0}
							-{convertPrice price=$productPriceWithoutReduction-$productPrice|floatval}
						{/if}
					</span>
				</p>
			</div>
			{/if}
			<div class="price">
				{if $product->specificPrice AND $product->specificPrice.reduction && $product->specificPrice.reduction > 0}
				<p id="old_price" itemprop="price">
				<span class="bold">
					{if $priceDisplay >= 0 && $priceDisplay <= 2}
						{if $productPriceWithoutReduction > $productPrice}
							<span id="old_price_display">{convertPrice price=$productPriceWithoutReduction}</span>
							<!-- {if $tax_enabled && $display_tax_label == 1}
								{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}
							{/if} -->
						{/if}
					{/if}
					</span>
					<meta itemprop="priceCurrency" content="{$currency->iso_code}" />
				</p>
				{/if}
				{if $priceDisplay >= 0 && $priceDisplay <= 2}
					<span itemprop="price" id="our_price_display"  style="font-size:1.2em">{convertPrice price=$productPrice}</span>
					<meta itemprop="priceCurrency" content="{$currency->iso_code}" />
					
				{/if}

				{if $priceDisplay == 2}
					<br />
					<span id="pretaxe_price"><span id="pretaxe_price_display">{convertPrice price=$product->getPrice(false, $smarty.const.NULL)}</span>&nbsp;{l s='tax excl.'}</span>
				{/if}
			</div>
				
				{if $packItems|@count && $productPrice < $product->getNoPackPrice()}
					<p class="pack_price">{l s='Instead of'} <span style="text-decoration: line-through;">{convertPrice price=$product->getNoPackPrice()}</span></p>
					<br class="clear" />
				{/if}
				{if $product->ecotax != 0}
					<p class="price-ecotax">{l s='Include'} <span id="ecotax_price_display">{if $priceDisplay == 2}{$ecotax_tax_exc|convertAndFormatPrice}{else}{$ecotax_tax_inc|convertAndFormatPrice}{/if}</span> {l s='For green tax'}
						{if $product->specificPrice AND $product->specificPrice.reduction}
						<br />{l s='(not impacted by the discount)'}
						{/if}
					</p>
				{/if}
			{if !empty($product->unity) && $product->unit_price_ratio > 0.000000}
				 {math equation="pprice / punit_price"  pprice=$productPrice  punit_price=$product->unit_price_ratio assign=unit_price}
				<p class="unit-price"><span id="unit_price_display">{convertPrice price=$unit_price}</span> {l s='per'} {$product->unity|escape:'htmlall':'UTF-8'}</p>
			{/if}
			{*close if for show price*}
			{/if}
			<!-- minimal quantity wanted -->
				<div id="minimal_quantity_wanted_p"{if $product->minimal_quantity <= 1 OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if}>
					{l s='This product is not sold individually. You must select at least'} <b id="minimal_quantity_label">{$product->minimal_quantity}</b> {l s='quantity for this product.'}
				</div>
				{if $product->minimal_quantity > 1}
				<script type="text/javascript">
					checkMinimalQuantity();
				</script>
				{/if}
			<!-- quantity wanted -->
				<div id="quantity_wanted_p" class="attribute_fieldset clearfix"{if (!$allow_oosp && $product->quantity <= 0) OR $virtual OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if}>
					<label>{l s='Quantity:'}</label>
					<div class="quantity_wanted_input">
					<input type="text" name="qty" id="quantity_wanted" class="text" value="{if isset($quantityBackup)}{$quantityBackup|intval}{else}{if $product->minimal_quantity > 1}{$product->minimal_quantity}{else}1{/if}{/if}" size="2" maxlength="3" {if $product->minimal_quantity > 1}onkeyup="checkMinimalQuantity({$product->minimal_quantity});"{/if} />
					
					<span class="cs_cart_quantity">
					<a rel="nofollow" class="cart_quantity_up" id="" href="javascript:void(0)" title="{l s='Add'}">
					<img src="{$img_dir}icon/quantity_up.gif" alt="{l s='Add'}" width="10" height="10" /></a>
					<a rel="nofollow" class="cart_quantity_down" id="" href="javascript:void(0)" title="{l s='Subtract'}">
						<img src="{$img_dir}icon/quantity_down.gif" alt="{l s='Subtract'}" width="10" height="10" />
					</a>
					</span>
					{if (!$allow_oosp && $product->quantity <= 0) OR !$product->available_for_order OR (isset($restricted_country_mode) AND $restricted_country_mode) OR $PS_CATALOG_MODE}
						<span class="csbutton csdefault">					
							{l s='Add to cart'}
						</span>
					{else}
						<p {if !$content_only}id="add_to_cart"{/if} class="add_to_cart">					
							<input type="submit" name="Submit" value="{l s='Add to cart'}" class="csbutton csdefault" {if $content_only}onclick="return closeFancy()"{/if}/>
						</p>
					{/if}
					{if isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS}{$HOOK_PRODUCT_ACTIONS}{/if}
			</div>
				</div>
		{if !$content_only}
		<div class="cs_social_button">
			<div class="itemFacebookButton">
				<div id="fb-root"></div>
				<script type="text/javascript">
					(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
				<div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true"></div>
			</div>
			
			<div class="itemTwitterButton">
				<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Twitter
				</a>
				<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
			</div>
			
			<div class="itemGooglePlusOneButton">
				<!-- Place this tag where you want the +1 button to render. -->
				<div class="g-plusone" data-size="medium"></div>

				<!-- Place this tag after the last +1 button tag. -->
				<script type="text/javascript">
				  (function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
			</div>
			
			<div class="itemPinterestButton">
			<a href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" >
			<img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
			<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
			</div>
		</div>
		{/if}
		</div>
		</form>
		<!-- end form-->
		{/if}
		{if !$content_only}{if isset($HOOK_EXTRA_RIGHT) && $HOOK_EXTRA_RIGHT}{$HOOK_EXTRA_RIGHT}{/if}{/if}
		
	</div>
	</div>
	</div>
	<!-- end left info -->

{if $content_only}</div>{/if}
{if !$content_only}
{if (isset($quantity_discounts) && count($quantity_discounts) > 0)}
<!-- quantity discount -->
<ul class="idTabs clearfix">
	<li><a href="#discount" style="cursor: pointer" class="selected">{l s='Sliding scale pricing'}</a></li>
</ul>
<div id="quantityDiscount">
	<table class="std">
        <thead>
            <tr>
                <th>{l s='Product'}</th>
                <th>{l s='From (qty)'}</th>
                <th>{l s='Discount'}</th>
            </tr>
        </thead>
		<tbody>
            {foreach from=$quantity_discounts item='quantity_discount' name='quantity_discounts'}
            <tr id="quantityDiscount_{$quantity_discount.id_product_attribute}" class="quantityDiscount_{$quantity_discount.id_product_attribute}">
                <td>
                    {if (isset($quantity_discount.attributes) && ($quantity_discount.attributes))}
                        {$product->getProductName($quantity_discount.id_product, $quantity_discount.id_product_attribute)}
                    {else}
                        {$product->getProductName($quantity_discount.id_product)}
                    {/if}
                </td>
                <td>{$quantity_discount.quantity|intval}</td>
                <td>
                    {if $quantity_discount.price >= 0 OR $quantity_discount.reduction_type == 'amount'}
                       -{convertPrice price=$quantity_discount.real_value|floatval}
                   {else}
                       -{$quantity_discount.real_value|floatval}%
                   {/if}
                </td>
            </tr>
            {/foreach}
        </tbody>
	</table>
</div>
{/if}

{if isset($HOOK_PRODUCT_FOOTER) && $HOOK_PRODUCT_FOOTER}{$HOOK_PRODUCT_FOOTER}{/if}

<!-- description and features -->
{if (isset($product) && $product->description) || (isset($features) && $features) || (isset($accessories) && $accessories) || (isset($HOOK_PRODUCT_TAB) && $HOOK_PRODUCT_TAB) || (isset($attachments) && $attachments) || isset($product) && $product->customizable}
<div id="more_info_block" class="clear box0" data-animate="fadeInDown" data-delay="0">
	<div id="more_info_tabs" class="title">
		<ul class="idTabs idTabsShort clearfix">
			{if $product->description}<li><a id="more_info_tab_more_info" href="#idTab1">{l s='More info'}</a></li>{/if}
			{if $features}<li><a id="more_info_tab_data_sheet" href="#idTab2">{l s='Data sheet'}</a></li>{/if}
			{if $attachments}<li><a id="more_info_tab_attachments" href="#idTab9">{l s='Download'}</a></li>{/if}
			{if isset($accessories) AND $accessories}<li><a href="#idTab4">{l s='Accessories'}</a></li>{/if}
			{if isset($product) && $product->customizable}<li><a href="#idTab10">{l s='Product customization'}</a></li>{/if}
			{$HOOK_PRODUCT_TAB}
		</ul>
	</div>
	<div id="more_info_sheets" class="sheets align_justify">
	{if $product->description}<div class="title_hide_show title" style="display:none">{l s='More info'}</div>{/if}
	{if isset($product) && $product->description}
		<!-- full description -->
		<div id="idTab1" class="rte content_hide_show" data-animate="fadeInDown" data-delay="0"><p>{$product->description}</p></div>
	{/if}
	{if $features}<div class="title_hide_show title" style="display:none">{l s='Data sheet'}</div>{/if}
	{if isset($features) && $features}
		<!-- product's features -->
		<ul id="idTab2" class="bullet content_hide_show">
		<p></p>
		<p></p>
		{foreach from=$features item=feature}
            {if isset($feature.value)}
			    <li><span>{$feature.name|escape:'htmlall':'UTF-8'}</span> {$feature.value|escape:'htmlall':'UTF-8'}</li>
            {/if}
		{/foreach}
		</ul>
	{/if}
	{if $attachments}<div class="title_hide_show title" style="display:none">{l s='Download'}</div>{/if}
	{if isset($attachments) && $attachments}
		<ul id="idTab9" class="bullet content_hide_show" data-animate="fadeInDown" data-delay="0">
		{foreach from=$attachments item=attachment}
			<li><a href="{$link->getPageLink('attachment', true, NULL, "id_attachment={$attachment.id_attachment}")}">{$attachment.name|escape:'htmlall':'UTF-8'}</a><br />{$attachment.description|escape:'htmlall':'UTF-8'}</li>
		{/foreach}
		</ul>
	{/if}
	{if isset($accessories) AND $accessories}<div class="title_hide_show title" style="display:none">{l s='Accessories'}</div>{/if}
	{if isset($accessories) AND $accessories}
	{if isset($number_p)}
		{assign var=numberperpage value=$number_p}
	{else}
		{assign var=numberperpage value=3}
	{/if}
		<!-- accessories -->
		<div id="idTab4" class="bullet content_hide_show" data-animate="fadeInDown" data-delay="0">
			<div class="accessories_block clearfix">
				<div class="block_content">
					<ul id="product_list">
					{foreach from=$accessories item=accessory name=accessories_list}
						{if ($accessory.allow_oosp || $accessory.quantity > 0) AND $accessory.available_for_order AND !isset($restricted_country_mode)}
							{assign var='accessoryLink' value=$link->getProductLink($accessory.id_product, $accessory.link_rewrite, $accessory.category)}
							<li class="{if isset($grid_product)}{$grid_product}{else}grid_6{/if} ajax_block_product {if $smarty.foreach.accessories_list.first}first_item{elseif $smarty.foreach.accessories_list.last}last_item{else}item{/if}{if $smarty.foreach.accessories_list.index % $numberperpage == 0} alpha{elseif ($smarty.foreach.accessories_list.index+1) % $numberperpage == 0} omega{/if}  product_accessories_description clearfix">
							<div class="center_block">
							<div class="image"><a href="{$accessoryLink|escape:'htmlall':'UTF-8'}" title="{$accessory.lagend|escape:'htmlall':'UTF-8'}" class="product_img_link"><img src="{$link->getImageLink($accessory.link_rewrite, $accessory.id_image, 'home_default')}" alt="{$accessory.legend|escape:'htmlall':'UTF-8'}"/></a></div>
							<div class="name_product"><h3><a href="{$accessoryLink|escape:'htmlall':'UTF-8'}">{$accessory.name|escape:'htmlall':'UTF-8'}</a></h3></div>
							
							<div class="product_desc">
									{$accessory.description_short|strip_tags|truncate:90:'...'}
							</div>
							<div class="content_price">
							{if $accessory.show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE} <span class="price">{if $priceDisplay != 1}{displayWtPrice p=$accessory.price}{else}{displayWtPrice p=$accessory.price_tax_exc}{/if}</span>{/if}
							</div>
								{if !$PS_CATALOG_MODE}
								<a rel="ajax_id_product_{$accessory.id_product|intval}" class="csbutton csdefault ajax_add_to_cart_button" href="{$link->getPageLink('cart', true, NULL, "qty=1&amp;id_product={$accessory.id_product|intval}&amp;token={$static_token}&amp;add")}" rel="ajax_id_product_{$accessory.id_product|intval}" title="{l s='Add to cart'}"><span></span>{l s='Add to cart'}</a>
								{/if}
							</div>
							</li>
						{/if}
					{/foreach}
					</ul>
				</div>
			</div>
		</div>
	{/if}

	<!-- Customizable products -->
	{if isset($product) && $product->customizable}
		<div id="idTab10" class="bullet customization_block" data-animate="fadeInDown" data-delay="0">
			<form method="post" action="{$customizationFormTarget}" enctype="multipart/form-data" id="customizationForm" class="clearfix">
				<p class="infoCustomizable">
					{l s='After saving your customized product, remember to add it to your cart.'}
					{if $product->uploadable_files}<br />{l s='Allowed file formats are: GIF, JPG, PNG'}{/if}
				</p>
				{if $product->uploadable_files|intval}
				<div class="customizableProductsFile">
					<h3>{l s='Pictures'}</h3>
					<ul id="uploadable_files" class="clearfix">
						{counter start=0 assign='customizationField'}
						{foreach from=$customizationFields item='field' name='customizationFields'}
							{if $field.type == 0}
								<li class="customizationUploadLine{if $field.required} required{/if}">{assign var='key' value='pictures_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
									{if isset($pictures.$key)}
									<div class="customizationUploadBrowse">
										<img src="{$pic_dir}{$pictures.$key}_small" alt="" />
										<a href="{$link->getProductDeletePictureLink($product, $field.id_customization_field)|escape:'html'}" title="{l s='Delete'}" >
											<img src="{$img_dir}icon/delete.gif" alt="{l s='Delete'}" class="customization_delete_icon" width="11" height="13" />
										</a>
									</div>
									{/if}
									<div class="customizationUploadBrowse">
										<label class="customizationUploadBrowseDescription">{if !empty($field.name)}{$field.name}{else}{l s='Please select an image file from your computer'}{/if}{if $field.required}<sup>*</sup>{/if}</label>
										<input type="file" name="file{$field.id_customization_field}" id="img{$customizationField}" class="customization_block_input {if isset($pictures.$key)}filled{/if}" />
									</div>
								</li>
								{counter}
							{/if}
						{/foreach}
					</ul>
				</div>
				{/if}
				{if $product->text_fields|intval}
				<div class="customizableProductsText">
					<h3>{l s='Text'}</h3>
					<ul id="text_fields">
					{counter start=0 assign='customizationField'}
					{foreach from=$customizationFields item='field' name='customizationFields'}
						{if $field.type == 1}
						<li class="customizationUploadLine{if $field.required} required{/if}">
							<label for ="textField{$customizationField}">{assign var='key' value='textFields_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field} {if !empty($field.name)}{$field.name}{/if}{if $field.required}<sup>*</sup>{/if}</label>
							<textarea name="textField{$field.id_customization_field}" id="textField{$customizationField}" rows="1" cols="40" class="customization_block_input">{if isset($textFields.$key)}{$textFields.$key|stripslashes}{/if}</textarea>
						</li>
						{counter}
						{/if}
					{/foreach}
					</ul>
				</div>
				{/if}
				<p id="customizedDatas">
					<input type="hidden" name="quantityBackup" id="quantityBackup" value="" />
					<input type="hidden" name="submitCustomizedDatas" value="1" />
					<input type="button" class="button" value="{l s='Save'}" onclick="javascript:saveCustomization()" />
					<span id="ajax-loader" style="display:none"><img src="{$img_ps_dir}loader.gif" alt="loader" /></span>
				</p>
			</form>
			<p class="clear required"><sup>*</sup> {l s='required fields'}</p>
		</div>
	{/if}

	{if isset($HOOK_PRODUCT_TAB_CONTENT) && $HOOK_PRODUCT_TAB_CONTENT}{$HOOK_PRODUCT_TAB_CONTENT}{/if}
	</div>
</div>
{/if}
{/if}
{if isset($packItems) && $packItems|@count > 0}
	<div id="blockpack">
		<h2>{l s='Pack content'}</h2>
		{include file="$tpl_dir./product-list.tpl" products=$packItems}
	</div>
{/if}

{strip}
{if isset($smarty.get.ad) && $smarty.get.ad}
{addJsDefL name=ad}{$base_dir|cat:$smarty.get.ad|escape:'html':'UTF-8'}{/addJsDefL}
{/if}
{if isset($smarty.get.adtoken) && $smarty.get.adtoken}
{addJsDefL name=adtoken}{$smarty.get.adtoken|escape:'html':'UTF-8'}{/addJsDefL}
{/if}
{addJsDef allowBuyWhenOutOfStock=$allow_oosp|boolval}
{addJsDef availableNowValue=$product->available_now|escape:'quotes':'UTF-8'}
{addJsDef availableLaterValue=$product->available_later|escape:'quotes':'UTF-8'}
{addJsDef attribute_anchor_separator=$attribute_anchor_separator|addslashes}
{addJsDef attributesCombinations=$attributesCombinations}
{addJsDef currencySign=$currencySign|html_entity_decode:2:"UTF-8"}
{addJsDef currencyRate=$currencyRate|floatval}
{addJsDef currencyFormat=$currencyFormat|intval}
{addJsDef currencyBlank=$currencyBlank|intval}
{addJsDef currentDate=$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}
{if isset($combinations) && $combinations}
	{addJsDef combinations=$combinations}
	{addJsDef combinationsFromController=$combinations}
	{addJsDef displayDiscountPrice=$display_discount_price}
	{addJsDefL name='upToTxt'}{l s='Up to' js=1}{/addJsDefL}
{/if}
{if isset($combinationImages) && $combinationImages}
	{addJsDef combinationImages=$combinationImages}
{/if}
{addJsDef customizationFields=$customizationFields}
{addJsDef default_eco_tax=$product->ecotax|floatval}
{addJsDef displayPrice=$priceDisplay|intval}
{addJsDef ecotaxTax_rate=$ecotaxTax_rate|floatval}
{addJsDef group_reduction=$group_reduction}
{if isset($cover.id_image_only)}
	{addJsDef idDefaultImage=$cover.id_image_only|intval}
{else}
	{addJsDef idDefaultImage=0}
{/if}
{addJsDef img_ps_dir=$img_ps_dir}
{addJsDef img_prod_dir=$img_prod_dir}
{addJsDef id_product=$product->id|intval}
{addJsDef jqZoomEnabled=$jqZoomEnabled|boolval}
{addJsDef maxQuantityToAllowDisplayOfLastQuantityMessage=$last_qties|intval}
{addJsDef minimalQuantity=$product->minimal_quantity|intval}
{addJsDef noTaxForThisProduct=$no_tax|boolval}
{addJsDef oosHookJsCodeFunctions=Array()}
{addJsDef productHasAttributes=isset($groups)|boolval}
{addJsDef productPriceTaxExcluded=($product->getPriceWithoutReduct(true)|default:'null' - $product->ecotax)|floatval}
{addJsDef productBasePriceTaxExcluded=($product->base_price - $product->ecotax)|floatval}
{addJsDef productReference=$product->reference|escape:'html':'UTF-8'}
{addJsDef productAvailableForOrder=$product->available_for_order|boolval}
{addJsDef productPriceWithoutReduction=$productPriceWithoutReduction|floatval}
{addJsDef productPrice=$productPrice|floatval}
{addJsDef productUnitPriceRatio=$product->unit_price_ratio|floatval}
{addJsDef productShowPrice=(!$PS_CATALOG_MODE && $product->show_price)|boolval}
{addJsDef PS_CATALOG_MODE=$PS_CATALOG_MODE}
{if $product->specificPrice && $product->specificPrice|@count}
	{addJsDef product_specific_price=$product->specificPrice}
{else}
	{addJsDef product_specific_price=array()}
{/if}
{if $display_qties == 1 && $product->quantity}
	{addJsDef quantityAvailable=$product->quantity}
{else}
	{addJsDef quantityAvailable=0}
{/if}
{addJsDef quantitiesDisplayAllowed=$display_qties|boolval}
{if $product->specificPrice && $product->specificPrice.reduction && $product->specificPrice.reduction_type == 'percentage'}
	{addJsDef reduction_percent=$product->specificPrice.reduction*100|floatval}
{else}
	{addJsDef reduction_percent=0}
{/if}
{if $product->specificPrice && $product->specificPrice.reduction && $product->specificPrice.reduction_type == 'amount'}
	{addJsDef reduction_price=$product->specificPrice.reduction|floatval}
{else}
	{addJsDef reduction_price=0}
{/if}
{if $product->specificPrice && $product->specificPrice.price}
	{addJsDef specific_price=$product->specificPrice.price|floatval}
{else}
	{addJsDef specific_price=0}
{/if}
{addJsDef specific_currency=($product->specificPrice && $product->specificPrice.id_currency)|boolval} {* TODO: remove if always false *}
{addJsDef stock_management=$stock_management|intval}
{addJsDef taxRate=$tax_rate|floatval}
{addJsDefL name=doesntExist}{l s='This combination does not exist for this product. Please select another combination.' js=1}{/addJsDefL}
{addJsDefL name=doesntExistNoMore}{l s='This product is no longer in stock' js=1}{/addJsDefL}
{addJsDefL name=doesntExistNoMoreBut}{l s='with those attributes but is available with others.' js=1}{/addJsDefL}
{addJsDefL name=fieldRequired}{l s='Please fill in all the required fields before saving your customization.' js=1}{/addJsDefL}
{addJsDefL name=uploading_in_progress}{l s='Uploading in progress, please be patient.' js=1}{/addJsDefL}
{/strip}
{/if}

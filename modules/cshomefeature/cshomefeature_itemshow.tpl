<div class="item_show">
	<div class="image">
		<a href="{$product.link|escape:'htmlall':'UTF-8'}" class="product_img_block_home" title="">
				<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')}" alt=""/>
				
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
									
									-{convertPrice price=$product.reduction}
								</span>
							</span>
						{/if}
					{/if}
				{/if}
		</a>
	</div>
	<div class="name_product">
		<h3><a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|escape:'htmlall':'UTF-8'|truncate:45:'...'}</a></h3>
	</div>
	<p class="product_desc">{$product.description_short|strip_tags:'UTF-8'|truncate:45:'...'}</p>
	{if $product.ratting >0}
	<div class="star_content clearfix">
		{section name="i" start=0 loop=5 step=1}
			{if $product.ratting le $smarty.section.i.index}
				<div class="star"></div>
			{else}
				<div class="star star_on"></div>
			{/if}
		{/section}
	</div>
	{/if}
	<div class="content_price">
		{if $product.reduction}<span class="price old">{convertPrice price=$product.price_without_reduction}</span>{/if}	
		{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}<span class="price{if $product.reduction}{/if}">{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}</span>{/if}	
	</div>
	
</div>
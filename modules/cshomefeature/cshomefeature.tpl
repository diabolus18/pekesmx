<div class="homecategoryfeature">
	{if count($category_list) > 0}
		{$i=0}
		{foreach from=$category_list item=category name=categories}
			{$i=$i+1}
			<div class="content_homecategoryfeature box2{if $i==count($category_list)} last{/if} clearfix">
				<div class="title">
				<h3>
					<a href="{$category.link_category}">
						{$category.name_category|escape:'htmlall':'UTF-8'}
					</a>
				</h3>
				</div>
				<div class="product_list_slider box-content">
					<ul class="product_grid" id="cat_feature_{$category.id_category}">
					{foreach from=$category.product_list item=product name=homeFeaturedProducts}
						<li class="ajax_block_product {if $smarty.foreach.homeFeaturedProducts.first}first_item{elseif $smarty.foreach.homeFeaturedProducts.last}last_item{else}item{/if}" >
							{include file='./cshomefeature_itemshow.tpl'}
						</li>
					{/foreach}				
					</ul>	
					<p><a href="{$category.link_category}" style="font-weight:bold" class="view_more">{l s='View more category' mod='csblockhomefeature'}<span class="icon arrow">></span></a>	</p>				
				</div>		
			</div>
		{/foreach}
	{else}
		<p>{l s='No category choosed' mod='cshomefeature'}</p>
	{/if}	
</div>
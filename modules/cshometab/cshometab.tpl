<!-- CS Home Tab module -->
<div class="home_top_tab">
{if count($tabs) > 0}
<div id="tabs">
	{foreach from=$tabs item=tab name=tabs}
	{if count($tab->product_list)>0}
	<div class="box1">
	<div class="title"><h3>{$tab->title[(int)$cookie->id_lang]}</h3></div>	
	<div class="tabs-carousel" id="tabs-{$smarty.foreach.tabs.iteration}">
		<div class="cycleElementsContainer" id="cycle-{$smarty.foreach.tabs.iteration}">
			
			<div id="elements-{$smarty.foreach.tabs.iteration}">
				
				<div class="list_carousel responsive">
					<ul id="carousel{$smarty.foreach.tabs.iteration}" class="product-grid">
					{foreach from=$tab->product_list item=product name=product_list key=delay}
					
						<li class="ajax_block_product not-animated" data-animate="bounceIn" data-delay="{$delay*200}">
							<div class="p_content">
								<div class="image">
									<a href="{$product.link}" title="" class="product_image">
										<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'prod_slider_home')}" alt="" />
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
														<span class="amount">															-{convertPrice price=$product.reduction}
														</span>
													</span>
												{/if}
											
										{/if}
									{else}
										{if $product.new==1}
											<span class="new"><span>{l s='new'}</span></span>
										{/if}
									{/if}
								</div>
								<div class="name_product">
									<h3>
									<a href="{$product.link}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|truncate:30:'...'|escape:'htmlall':'UTF-8'}</a>
									</h3>
								</div>
								
								<p class="product_desc">{$product.description_short|strip_tags:'UTF-8'|truncate:60:'...'}</p>
								
								
								{hook h='displayProductListReviews' product=$product}
								
								<div class="content_price">
									{if $product.reduction}
									<span class="price old">
									{convertPrice price=$product.price_without_reduction}</span>{/if}	
									{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}
									<span class="price {if $product.reduction}{/if}">{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}</span>	
									{/if}
								</div>
								{if ($product.id_product_attribute == 0 OR (isset($add_prod_display) AND ($add_prod_display == 1))) AND $product.available_for_order AND !isset($restricted_country_mode) AND $product.minimal_quantity == 1 AND $product.customizable != 2 AND !$PS_CATALOG_MODE}
									{if ($product.quantity > 0 OR $product.allow_oosp)}
									<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_{$product.id_product}" href="{$link->getPageLink('cart.php')}?qty=1&amp;id_product={$product.id_product}&amp;token={$static_token}&amp;add" title=""><span class="in_button">{l s='Add to cart' mod='cshometab'}</span></a>
									{else}
									<span class="csbutton cssecond">{l s='Out of stock' mod='cshometab'}</span>
									{/if}
								{else}
									<div style="height:23px;"></div>
								{/if}
							
							</div>
					</li>
					{/foreach}
					</ul>
					<div class="cclearfix"></div>
					{if count($tab->product_list)>4}
						<div class="control">
							<a id="prev{$smarty.foreach.tabs.iteration}" class="prev" href="#">&lt;</a>
							<a id="next{$smarty.foreach.tabs.iteration}" class="next" href="#">&gt;</a>
						</div>
					{/if}
				</div>
				
					{if isset($tab->sub_category)}
					<div class="sub_category">
					<h6 data-animate="fadeInUp" data-delay="100">{l s='Sub category' mod='cshometab'}</h6>
					{foreach from=$tab->sub_category item=sub_cat name=sub_cat key=delay}
						<a href="{$sub_cat.link_sub_cat}" data-animate="fadeInUp" data-delay="{$delay*150}">{$sub_cat.name}</a>
						{if !$smarty.foreach.sub_cat.last}<span class="opa" data-animate="fadeInUp" data-delay="{$delay*160}">&nbsp;|&nbsp;</span>{/if}
					{/foreach}
					</div>
					{/if}
				
				
			</div>
		</div>
	</div>
	</div>
	{/if}
	{/foreach}
</div>
<script type="text/javascript">
	$(window).load(function() {
		if(!isMobile())
		{
			initCarousel();
		}
		else
		{
			initCarouselMobile()
		}
		$('.home_top_tab .prev, .home_top_tab .next').click(function(){
			return removeApear($(this));});

	});
	
	function initCarousel() {
		{foreach from=$tabs item=tab name=tabs}		
		//	Responsive layout, resizing the items
		$('#carousel{$smarty.foreach.tabs.iteration}').carouFredSel({
			responsive: true,
			onWindowResize: 'debounce',
			width: '100%',
			height:'variable',
			prev: '#prev{$smarty.foreach.tabs.iteration}',
			next: '#next{$smarty.foreach.tabs.iteration}',
			auto: false,
			swipe: {
				onTouch : true
			},
			items: {
				width: 220,
				height: 'auto',	//	optionally resize item-height
				visible: {
					min: 1,
					max: 3
				}
			},
			scroll: {
				items:3,
				duration  : 1000   //  The duration of the transition.
			}
		});			
		{/foreach}
	}
	function removeApear(element){
		var id_tab = element.attr('id').substring(4);
		var tab = '#tabs-'+id_tab;
		if(touch == false){
            var that = $(tab);
            var items = that.find('.not-animated');
            items.removeClass('not-animated').unbind('appear');
            
            items = that.find('.animated');
            items.removeClass('animated').unbind('appear');
          }
	}
	
	function initCarouselMobile() {
	{foreach from=$tabs item=tab name=tabs}
	//	Responsive layout, resizing the items
	$('#carousel{$smarty.foreach.tabs.iteration}').carouFredSel({
		responsive: true,
		onWindowResize: 'debounce',
		width: '100%',
		height:'variable',
		prev: '#prev{$smarty.foreach.tabs.iteration}',
		next: '#next{$smarty.foreach.tabs.iteration}',
		auto: false,
		swipe: {
			onTouch : true
		},
		items: {
			width: 320,
			height: 'auto',	//	optionally resize item-height
			visible: {
				min: 1,
				max: 2
			}
		},
		scroll: {
			items:1,
			direction : 'left',    //  The direction of the transition.
			duration  : 300   //  The duration of the transition.
		}
	});
	{/foreach}
	}
	
	function isMobile() 
	{
		if(navigator.userAgent.match(/(iPhone)|(iPod)/i)){
				return true;
		}
		else
		{
			return false;
		}
		
	}
</script>
{/if}
</div>
<!-- /CS Home Tab module -->

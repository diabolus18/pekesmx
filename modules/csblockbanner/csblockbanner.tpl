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
{if $infos|@count > 0}
<!-- MODULE Block reinsurance -->
<div id="banner_block" class="clearfix">
	<ul class="unstyled banner_block">	
		{foreach from=$infos item=info}
			<li data-animate="bounceIn" data-delay="0">
				<a href="{$info.link}" title="{$info.title|escape:'htmlall':'UTF-8'}">
					<img src="{$module_dir}img/{$info.file_name}" alt="" />
				</a>
				{$info.text}
			</li>
		{/foreach}
	</ul>
	<a id="prev_block_banner" class="prev btn" href="#">&lt;</a>
	<a id="next_block_banner" class="next btn" href="#">&gt;</a>
</div>

<script type="text/javascript">
$(window).load(function(){


	if($(window).width()<=767)
	{
		runSliderBanner();
	}
});

$(window).resize(function(){
	if($(window).width()<=767)
	{
		if(!isMobile())
		{
			runSliderBanner();
		}
	}
	else if($(window).width()>767)
	{
		if($("#banner_block .caroufredsel_wrapper").length>0)
		{
			$("#banner_block .banner_block").trigger("destroy");
			$("#banner_block li").css("width","229px");
			$("#banner_block li").css("margin-left","18px");
			$("#banner_block ul li:first-child").css("margin-left","0px");
		}
		
	}
});
	
	
	function runSliderBanner()
	{
		$("#banner_block .banner_block").carouFredSel({
			auto: false,
			responsive: true,
			width: '100%',
			height: 'variable',
			prev: '#prev_block_banner',
			next: '#next_block_banner',
			swipe: {
				onTouch : true
			},
			items: {
				width: 230,
				height: 'auto',
				visible: {
					min: 1,
					max: 2
				}
			},
			scroll: {
				items : 1,       //  The number of items scrolled.
				direction : 'left',
				duration :300
			}

		});
	}
</script>
<!-- /MODULE Block reinsurance -->
{/if}
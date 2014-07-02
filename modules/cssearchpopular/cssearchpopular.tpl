<!-- MODULE search popular -->
{if $searchList}
<div class="block_popular_word_search clearfix" >
	<div class="block_content">
	<h6 data-animate="fadeInLeft" data-delay="0">{l s='Popular search' mod='cspopularsearch'}</h6>
	{foreach from=$searchList item=search name=searchList key=delay}
	<a data-animate="fadeInLeft" data-delay="{$delay*50}" href="{$link->getPageLink('search', true, NULL, "search_query={$search.word|urlencode}")}">{$search.word|truncate:12:''}</a>
	{if !$smarty.foreach.searchList.last}<span data-animate="fadeInLeft" data-delay="{$delay*160}">&nbsp;|&nbsp;</span>{/if}
	{/foreach}
	</div>
</div>
{/if}
<!-- MODULE search popular -->
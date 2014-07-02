
<h1 class="h_blog">{l s='Blog' mod='csblog'}</h1>
<div class="rss">
<h1>{l s='RSS of blog' mod='csblog'}</h1>
{if isset($rsss) && $rsss|@count > 0}
	<ul>
	{foreach from=$rsss item=rss}
	<li><a target="_blank" href="{$rss['link']}">{$rss['name']}</a> (<i><a href="{$rss['link']}">{$rss['link']}</a></i>) </li> <br/>
	{/foreach}
	</ul>
{/if}
</div>
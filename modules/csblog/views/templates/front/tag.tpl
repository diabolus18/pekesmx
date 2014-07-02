<!--breadcrumb-->

<!--tag name-->
<h1>{$cs_blog_tag->name}</h1>
<h3 class="nbresult"><span class="big">{$count}{l s=' results have been found.' mod='csblog'}</span></h3>

<!--list post-->
{if $cs_postes_empty == 0}
	{include file="./post_sort.tpl"}
	{include file="./number_item.tpl"}
	{include file="./post_list.tpl"}
{/if}
{if $cs_postes_empty == 1}
	<div class="empty">{l s='There are no posts in this tag' mod='csblog'}</div>
{/if}
<!--pagination-->
{if $cs_postes_empty != 1}
	{include file="./pagination.tpl"}
{/if}


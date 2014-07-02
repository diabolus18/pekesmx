

<!--category detail-->
{if isset($cs_blog_category)}
	{if isset($cs_blog_category['image']) && $cs_allow_category_image == 1 && {$cs_blog_category['image']}!=''}
		<div class="blog_category_image">
			<img src="{$cs_blog_category['image']}" title="{$cs_blog_category['name']}" alt="{$cs_blog_category['name']}" />
		</div>
	{/if}
	<h3 class="title_blog">{$cs_blog_category['name']}</h3>
	{if $cs_allow_category_description == 1}
		<div class="blog_category_description">
			{if strlen($cs_blog_category['description']) > 1500}
			<p id="category_description_short">{$cs_blog_category['description']|truncate:120}</p>
			{else}
				{$cs_blog_category['description']}
			{/if}
		</div>
	{/if}
{else}
	<h1>{l s='Welcome to our blog' mod='csblog'}</h1>
{/if}

<!--list post-->
{if $cs_postes_empty == 0}
	<div class="post_control clearfix">
		{include file="./post_sort.tpl"}
		{include file="./number_item.tpl"}
	</div>
	{include file="./post_list.tpl"}
{/if}
{if $cs_postes_empty == 1}
	<div class="empty">{l s='There are no posts in this category' mod='csblog'}</div>
{/if}


<!--pagination-->
{if $cs_postes_empty != 1}
<div class="post_pagination clearfix">
{if isset($cs_post_list)}<div class="count_post">{l s='display ' mod='csblog'}{$cs_post_list|@count} of {$count_blog}{l s=' posts' mod='csblog'}</div>{/if}
{include file="./pagination.tpl"}
</div>
{/if}

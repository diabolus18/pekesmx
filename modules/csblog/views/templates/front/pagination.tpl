{if isset($p) AND $p}
	<!-- Pagination -->
	{if isset($cs_blog_category['id_cs_blog_category']) && $cs_blog_category['id_cs_blog_category']}
		{assign var='requestPage' value=$csLink->getCategoryPostLink($cs_blog_category['id_cs_blog_category'],$cs_blog_category['link_rewrite'])}
	{elseif isset($cs_blog_tag)}

		{assign var='requestPage' value=$csLink->getTagLink($cs_blog_tag->id,$cs_blog_tag->name)}
	{else}

		{assign var='requestPage' value=$link->getModuleLink('csblog','categoryPost')}
	{/if}
	<div id="pagination" class="pagination">
	{if $start!=$stop}
		<ul class="pagination">
		{if $p != 1}
			{assign var='p_previous' value=$p-1}
			<li id="pagination_previous"><a href="{$link->goPage($requestPage, $p_previous)}">&laquo;&nbsp;{l s='Previous' mod='plblog'}</a></li>
		{else}
			<li id="pagination_previous" class="disabled pagination_previous"><span>&laquo;&nbsp;{l s='Previous' mod='csblog'}</span></li>
		{/if}
		{if $start>3}
			<li><a href="{$link->goPage($requestPage, 1)}">1</a></li>
			<li class="truncate">...</li>
		{/if}
		{section name=pagination start=$start loop=$stop+1 step=1}
			{if $p == $smarty.section.pagination.index}
				<li class="current"><span>{$p|escape:'htmlall':'UTF-8'}</span></li>
			{else}
				<li><a href="{$link->goPage($requestPage, $smarty.section.pagination.index)}">{$smarty.section.pagination.index|escape:'htmlall':'UTF-8'}</a></li>
			{/if}
		{/section}
		{if $pages_nb>$stop+2}
			<li class="truncate">...</li>
			<li><a href="{$link->goPage($requestPage, $pages_nb)}">{$pages_nb|intval}</a></li>
		{/if}
		{if $pages_nb > 1 AND $p != $pages_nb}
			{assign var='p_next' value=$p+1}
			<li id="pagination_next" class="pagination_next"><a href="{$link->goPage($requestPage, $p_next)}">{l s='Next' mod='csblog'}&nbsp;&raquo;</a></li>
		{else}
			<li id="pagination_next" class="disabled"><span>{l s='Next' mod='csblog'}&nbsp;&raquo;</span></li>
		{/if}
		</ul>
	{/if}
	</div>
	<!-- /Pagination -->

{/if}

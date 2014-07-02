<!--<div class="list_grid">
<ul id="layouts" class="option-set clearfix" data-option-key="layoutMode">
<li><a title="{l s='grid'}" id="fitRows" href="#fitRows" data-option-value="fitRows">{l s='grid'}</a></li>
<li><a title="{l s='list'}" id="straightDown" href="#straightDown" data-option-value="straightDown">{l s='list'}</a></li></ul>
</div>-->
<span class="rss"><a href="{$link->getModuleLink('csblog','rss')}" title="{l s='rss' mod='csblog'}">{l s='rss'}</a></span>
{if isset($p) AND $p}
	{if isset($cs_blog_category['id_cs_blog_category']) && $cs_blog_category['id_cs_blog_category']}
		{assign var='requestPage' value=$csLink->getCategoryPostLink($cs_blog_category['id_cs_blog_category'],$cs_blog_category['link_rewrite'])}
	{elseif isset($cs_blog_tag)}
		{assign var='requestPage' value=$csLink->getTagLink($cs_blog_tag->id,$cs_blog_tag->name)}
	{else}
		{assign var='requestPage' value=$link->getModuleLink('csblog','categoryPost')}
	
	{/if}
	{if $nb_products > $cs_posts_per_page}
		<form id="plpagination" action="{$requestPage}" method="get" class="pagination">
			<p>
				{if isset($search_query) AND $search_query}<input type="hidden" name="search_query" value="{$search_query|escape:'htmlall':'UTF-8'}" />{/if}
				{if isset($tag) AND $tag AND !is_array($tag)}<input type="hidden" name="tag" value="{$tag|escape:'htmlall':'UTF-8'}" />{/if}
				<label for="nb_item">{l s='items:'}</label>
				<select name="n" id="nb_item">
				{assign var="lastnValue" value="0"}
				{foreach from=$nArray item=nValue}
					{if $lastnValue <= $nb_products}
						<option value="{$nValue|escape:'htmlall':'UTF-8'}" {if $n == $nValue}selected="selected"{/if}>{$nValue|escape:'htmlall':'UTF-8'}</option>
					{/if}
					{assign var="lastnValue" value=$nValue}
				{/foreach}
				</select>
				<input onclick="javascript:plFilter()" type="button" class="csbutton cssecond" value="{l s='OK' mod='plblog'}" />
				<script type="text/javascript">
					function plFilter() {
						var action = jQuery('#plpagination').attr('action');
						var nb_item = jQuery('#nb_item').val();
						action = action + '{if $url_rewrite == 1}?{else}&{/if}n=' + nb_item;
						window.location = action;
					}
				</script>
			</p>
		</form>
	{/if}
	
{/if}

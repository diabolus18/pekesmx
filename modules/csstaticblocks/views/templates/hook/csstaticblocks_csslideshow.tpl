<!-- Static Block module -->
<div class="static_block_home_banner clearfix">
{foreach from=$block_list item=block}
	{if isset($block->content[(int)$cookie->id_lang])}
		{$block->content[(int)$cookie->id_lang]}
	{/if}
{/foreach}
</div>
<!-- /Static block module -->
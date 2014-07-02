
{extends file="helpers/form/form.tpl"}
fasfds
{block name="input"}
	{if $input.name == "link_rewrite"}
		<script type="text/javascript">
		{if isset($PS_ALLOW_ACCENTED_CHARS_URL) && $PS_ALLOW_ACCENTED_CHARS_URL}
			var PS_ALLOW_ACCENTED_CHARS_URL = 1;
		{else}
			var PS_ALLOW_ACCENTED_CHARS_URL = 0;
		{/if}
		var ps_force_friendly_product = false;
		</script>
		{$smarty.block.parent}
	{else}
		{$smarty.block.parent}
	{/if}
{/block}


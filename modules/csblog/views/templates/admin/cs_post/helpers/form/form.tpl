{extends file="helpers/form/form.tpl"}
{block name="input"}
	{if $input.name == "link_rewrite"}
		<script type="text/javascript">
		{if isset($PS_ALLOW_ACCENTED_CHARS_URL) && $PS_ALLOW_ACCENTED_CHARS_URL}
			var PS_ALLOW_ACCENTED_CHARS_URL = 1;
		{else}
			var PS_ALLOW_ACCENTED_CHARS_URL = 0;
		{/if}
		</script>
		{$smarty.block.parent}
	{else if $input.name == "related_posts"}
			<input type="text" size="48" value="" id="opt_post_autocomplete_input" />
			<input type="hidden" id="id_related_posts" name="id_related_posts" value="{$input.id_related_posts}"/>
			<input type="hidden" id="name_related_posts" name="name_related_posts" value="{$input.name_related_posts}"/>
			<div id="opt_result_post_autocomplete">
			{$input.string_name_post}
			</div>
	{else if $input.name == "related_products"}
			<input type="text" size="48" value="" id="opt_product_autocomplete_input" />
			<input type="hidden" id="id_related_products" name="id_related_products" value="{$input.id_related_products}"/>
			<input type="hidden" id="name_related_products" name="name_related_products" value="{$input.name_related_products}"/>
			<div id="opt_result_product_autocomplete">
			{$input.string_name}
			</div>
	{else if $input.name == "id_cs_blog_tags"}
		<div class="form-group">
			{foreach from=$languages item=language}
			<div class="translatable-field lang-{$language.id_lang}" {if $language.id_lang != $defaultFormLanguage}style="display:none"{/if}>
			<div class="col-lg-9">
					<input type="text" size="48" id="{if isset($input.id)}{$input.id}_{$language.id_lang}{else}{$input.name}_{$language.id_lang}{/if}"
													name="{$input.name}_{$language.id_lang}"
							value="{$input.post->getTags($language.id_lang, true)|htmlentitiesUTF8}" />
			</div>
			{if $languages|count > 1}
											
											<div class="col-lg-2">
												<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
													{$language.iso_code}
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													{foreach from=$languages item=language}
													<li><a href="javascript:hideOtherLanguage({$language.id_lang});" tabindex="-1">{$language.name}</a></li>
													{/foreach}
												</ul>
											</div>
										
										{/if}
				</div>
			{/foreach}
			<div class="col-lg-9">
			<p class="help-block">{l s='Tags separated by commas (e.g. dvd, dvd player, hifi)'}</p>
			</div>
		</div>
	{else}
		{$smarty.block.parent}
	{/if}
{/block}


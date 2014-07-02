{extends file="helpers/form/form.tpl"}
{block name="other_input"}
	{if $key eq 'selects'}
	<div class="form-group">
	<label for="select_right" class="control-label col-lg-3 required">{l s='Post:' mod='csblog'}</label>
	<div class="col-lg-9">
	<table class="double_select">
		<tr>
			<td>
				<select multiple id="select_left">
					{foreach from=$field.products_unselected item='product'}
					<option value="{$product.id_cs_blog_post}">{$product.name}</option>
					{/foreach}
				</select>
				<span class="hint" name="help_box">{l s='Double click to move the item to another column'}<span class="hint-pointer">&nbsp;</span></span>
				<br /><br />
				<a href="#" id="move_to_right" class="multiple_select_add btn btn-default">
					{l s='Add'} &gt;&gt;
				</a>
			</div>
			</td>
			<td>
				<select multiple id="select_right" name="posts[]">
					{foreach from=$field.products item='product'}
					<option selected="selected" value="{$product.id_cs_blog_post}">{$product.name}</option>
					{/foreach}
				</select>
				<span class="hint" name="help_box">{l s='Double click to move the item to another column'}<span class="hint-pointer">&nbsp;</span></span>
				<br /><br />
				<a href="#" id="move_to_left" class="multiple_select_remove btn btn-default">
					&lt;&lt; {l s='Remove'}
				</a>
			</td>
		</tr>
	</table>
	</div>
	</div>
	<div class="clear">&nbsp;</div>

	<script type="text/javascript">
	$(document).ready(function(){
		$('#move_to_right').click(function(){
			return !$('#select_left option:selected').remove().appendTo('#select_right');
		})
		$('#move_to_left').click(function(){
			return !$('#select_right option:selected').remove().appendTo('#select_left');
		});
		$('#select_left option').live('dblclick', function(){
			$(this).remove().appendTo('#select_right');
		});
		$('#select_right option').live('dblclick', function(){
			$(this).remove().appendTo('#select_left');
		});
	});
	$('#cs_blog_tag_form').submit(function()
	{
		$('#select_right option').each(function(i){
			$(this).attr("selected", "selected");
		});
	});
	</script>
	{/if}
{/block}

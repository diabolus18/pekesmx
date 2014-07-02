{if isset($cs_post_list)}
<ul id="post_list" class="post_grid clearfix">
	{foreach from=$cs_post_list item=post}
		<li class="pitem element ajax_block_post {if $smarty.foreach.posts.index % 2 == 0}alpha {/if}{if ($smarty.foreach.posts.index+1) % 2 == 0}omega{/if} clearfix " data-alpha="{$post['name']|escape:'htmlall':'UTF-8'} " data-date-add="{$post['date_add_no_format']}">
		<div class="post_name">
		<h3><a href="{$post['link']}" title="{$post['name']}">{$post['name']}</a></h3></div>	
			{if $cs_imep_list_show != 'none'}
				{if isset($post['image']) && $post['image'] != ''}
				<div class="post_image">
					<a href="{$post['link']}" title="{$post['name']}"><img src="{$post['image']}" alt="{$post['name']}" /></a>
					<div class="post_date_add md">
						<div class="mdd" style="display: table; overflow: hidden;"> 
							<div style=" #position: absolute; #top: 50%;#left:0; display: table-cell; vertical-align: middle;"> 
								<div style="#position: relative; #top: -50%;"> <span>{date('d', strtotime($post['date_add']))}</span><span>{date('M', strtotime($post['date_add']))}</span></div>
							</div>
						</div>	
					</div>	
				</div>
				{/if}
			{/if}
			<div class="date_add">{$post['date_add']}</div>
		<div class="post_description"><p>{$post['description']|strip_tags|truncate:{$cs_b_summary_character_count}}</p></div>
			
		<div class="post_more_info">
				{if $post['author'] != ''}
						{assign var=author value="¤"|explode:$post['author']}
						{l s='Post by '}
						<span class="pluser_name">
						{$post['author']}
						</span><span class="opa">&nbsp;|&nbsp;</span>
				{/if}
					<span class="pl_requie">{$post['count_comment']}</span>
					{if $post['count_comment'] > 1}{l s='Comments' mod='csblog'}{/if}
					{if $post['count_comment'] <= 1} {l s='Comment' mod='csblog'}{/if}
					<span class="opa">&nbsp;|&nbsp;</span>
					<a class="post_read_more" href="{$post['link']}" title="{l s='Read more' mod='csblog'}">
						{l s='Read more' mod='csblog'}</a>
			</div>
			
		</li>
	{/foreach}
</ul>
{/if}
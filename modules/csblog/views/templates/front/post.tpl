<!--post content-->
{if isset($errorposts) && $errorposts}
	<div class="error">{l s='There is no post' mod='csblog.'}</div>
{else}
<script type="text/javascript" src="{$cs_js_blog}"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple",
		width:"340"
	});
</script>
<script type="text/javascript">
	function submitform()
	{
	  document.csaddcomment.submit();
	}
</script>
{if isset($post)}
	<div id="plpost">
		<h2>{$post['name']}</h2>
		{if $cs_imipd_show != 'none'}
			{if isset($post['image']) && $post['image'] != ''}
			<div class="post_image">
				<img src="{$post['image']}" title="{$post['name']}" alt="{$post['name']}" />
				<div class="post_date_add md">
				<div class="mdd" style="display: table; overflow: hidden;"> 
					<div style=" #position: absolute; #top: 50%; #left:0;display: table-cell; vertical-align: middle;"> 
						<div style="#position: relative; #top: -50%;"> <span>{date('d', strtotime($post['date_add']))}</span><span>{date('M', strtotime($post['date_add']))}</span></div>
					</div>
				</div>	
				</div>	
			</div>	
			{/if}
		{/if}
		<div class="plpost_content"><p>{$post['description']}</p></div>

		<div class="pl_info_post clearfix">		
			{if isset($cstags) && $cstags}
			<div class="tag_list" style="float:left">
			<span>{l s='Tags:' mod='csblog'}&nbsp;&nbsp;</span>			
				{foreach from=$cstags item=tag name=cstags}
					<span><a href="{$tag.link}">{$tag.name}</a>{if !$smarty.foreach.cstags.last},&nbsp;{/if}</span>
				{/foreach}
			</div>
			{/if}
			<div class="cs_social_button" style="float:right">
			<div class="itemFacebookButton">
				<div id="fb-root"></div>
				<script type="text/javascript">
					(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
				<div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true"></div>
			</div>
			
			<div class="itemTwitterButton">
				<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Twitter
				</a>
				<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
			</div>
			
			<div class="itemGooglePlusOneButton">
				<!-- Place this tag where you want the +1 button to render. -->
				<div class="g-plusone" data-size="medium"></div>

				<!-- Place this tag after the last +1 button tag. -->
				<script type="text/javascript">
				  (function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
			</div>
			
			<div class="itemPinterestButton">
				<a href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" >
				<img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
				<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
			</div>
		</div>
		</div>
		<div class="post_more_info">
			{if $post['author'] != ''}
				{assign var=author value="¤"|explode:$post['author']}{l s='Post by '}<span class="pluser_name">
				{$post['author']}</span><span class="opa">&nbsp;|&nbsp;</span>
			{/if}
			<span class="pl_requie">{$count_comment_total}</span>{if $count_comment_total <= 1} {l s='Comment' mod='csblog'}{/if}{if $count_comment_total > 1} {l s='Comments' mod='csblog'}{/if}
		</div>		
	</div>
	<div class="plclear">&nbsp;</div>
	<div class="plclear">&nbsp;</div>
	<div class="plclear">&nbsp;</div>
		<!--related posts-->
	{if isset($allow_related_post)}
		<div class="related_posts box0">
			<div class="title"><h3>{l s='Related posts' mod='csblog'}</h3></div>
			<div class="box0-content">
			{if isset($related_posts) && $related_posts }
				<ul class="unstyled">
				{foreach from=$related_posts item=related_post name=related_posts}
					<li class="li_related_post">											
						<a href="{$csLink->getLinkPostDetail($related_post['id_cs_blog_post'],$related_post['link_rewrite'],$related_post['id_cs_blog_category'])}" title="{$related_post['name']}">{$related_post['name']}</a>						
						{if isset($related_post['image']) && $related_post['image'] != ''}
							<div class="post_image"><a href="{$csLink->getLinkPostDetail($related_post['id_cs_blog_post'],$related_post['link_rewrite'],$related_post['id_cs_blog_category'])}" title="{$related_post['name']}"><img src="{$related_post['image']}" alt="{$related_post['name']}" /></a></div>
						{/if}
						<div class="post_description"><p>{$related_post['description']|strip_tags|truncate:{$cs_b_summary_character_count}}</p></div>
					</li>
				{/foreach}
				</ul>
			{else}
				<p>{l s='There is no related post' mod='csblog'}</p>
			{/if}
		</div>
		</div>
	{/if}
	<!--related products-->
	{if isset($allow_related_product)}
		<div class="related_products box0 clearfix">
			<div class="title"><h3>{l s='Related products' mod='csblog'}</h3></div>
			<div class="box0-content">
			{if isset($related_products_result) && $related_products_result}
				<ul class="unstyled">
				{foreach from=$related_products_result item=related_product name=related_products}
					<li class="{if isset($grid_product)}{$grid_product}{else}grid_6{/if} ajax_block_product {if $smarty.foreach.accessories_list.first}first_item{elseif $smarty.foreach.accessories_list.last}last_item{else}item{/if}{if $smarty.foreach.accessories_list.index % $numberperpage == 0} alpha{elseif ($smarty.foreach.accessories_list.index+1) % $numberperpage == 0} omega{/if}  product_accessories_description clearfix">
						<div class="center_block">														
							<a href="{$related_product.link|escape:'htmlall':'UTF-8'}" class="product_img_link" title="">
								<img src="{$link->getImageLink($related_product.link_rewrite, $related_product.id_image, {$image_size_related_product})}" alt="{$related_product.legend|escape:'htmlall':'UTF-8'}" />
							</a>
							<div class="name_product"><h3><a href="{$related_product.link|escape:'htmlall':'UTF-8'}" title="">{$related_product.name|escape:'htmlall':'UTF-8'|truncate:60:'...'}</a></h3></div>
							<p class="product_desc">{$related_product.description_short|strip_tags:'UTF-8'|truncate:360:'...'}</p>
							
							{if (!$PS_CATALOG_MODE AND ((isset($related_product.show_price) && $related_product.show_price) || (isset($related_product.available_for_order) && $related_product.available_for_order)))}
								<div class="content_price">
									{if isset($related_product.show_price) && $related_product.show_price && !isset($restricted_country_mode)}<span class="price" style="display: inline;">{if !$priceDisplay}{convertPrice price=$related_product.price}{else}{convertPrice price=$related_product.price_tax_exc}{/if}</span><br />{/if}
									
								</div>
							{/if}
							
						</div>
						
					</li>
				{/foreach}
				</ul>
			{else}
				<p>{l s='There is no related product' mod='csblog'}</p>
			{/if}
			</div>
		</div>
	{/if} <!--end related product-->
		<!-- display comment list -->
		<div class="pl_list_comment box0">
			<div class="title"><h3>{l s='Comments ' mod='csblog'}({$count_comment_total})</h3></div>
			<div class="box0-content">
			{if isset($comments) && $comments}
				{foreach from=$comments item=comment name="comments"}
					<div class="plcomment {if $smarty.foreach.comments.last} last{/if}">
						<div class="info_comment">
							<span class="comment_author">{l s='Post By '}<span class="pluser_name">
							{if isset($comment['author_name']) && $comment['author_name']!="" }{$comment['author_name']}{/if}</span></span>
							<span class="opa">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
							<span class="pldate_add">{$comment['date_add']}</span>	
						</div>									
						<div class="plcomment_content">*{$comment['content']}*</div>
					</div>
				{/foreach}
			{else}
				<p>{l s='There is no comment' mod='csblog'}</p>
			{/if}
			{if $count_comment_total > $count_comment_show && !isset($viewall)}
			<div class="plclear">&nbsp;</div>
			<a class="csbutton cssecond" href="{$csLink->getLinkPostDetail($post['id_cs_blog_post'],$post['link_rewrite'],$post['id_cs_blog_category'])}{if $url_rewrite == 1}?{else}&{/if}viewall">{l s='view all' mod='csblog'}</a>
			{elseif isset($viewall)}
			<div class="plclear">&nbsp;</div>
				<a class="csbutton cssecond" href="{$csLink->getLinkPostDetail($post['id_cs_blog_post'],$post['link_rewrite'],$post['id_cs_blog_category'])}">{l s='Collapse' mod='csblog'}</a>
			{/if}
			</div>
		</div>
		<div class="plclear">&nbsp;</div>
		<!-- /display comment list -->
	<!-- display form comment-->
	{if $display_form_comment == 1}
		<div class="pl_comment_form box0">
			<form action="{$csLink->getLinkPostDetail($post['id_cs_blog_post'],$post['link_rewrite'],$post['id_cs_blog_category'])}" name="csaddcomment" method="post" class="std">				
				<div class="title"><h3>{l s='Send a comment' mod='csblog'}</h3></div>
				<div class="fieldset box0-content">
					{if isset($error)}
						<div class="error">
							{l s='There ' mod='csblog'}{if $error|@count <= 1} {l s='is ' mod='csblog'} {else} {l s='are ' mod='csblog'}{/if}{$error|@count} {if $error|@count <= 1} {l s='error ' mod='csblog'} {else} {l s='errors ' mod='csblog'}{/if}
							<ol>
								{if isset($error['author_name'])}<li>{$error['author_name']}</li>{/if}
								{if isset($error['author_email'])}<li>{$error['author_email']}</li>{/if}
								{if isset($error['title'])}<li>{$error['title']}</li>{/if}
								{if isset($error['captcha'])}<li>{$error['captcha']}</li>{/if}
								{if isset($error['content'])}<li>{$error['content']}</li>{/if}
							</ol>
						</div>
					{elseif isset($success)}
						<div class="success">
							{l s='Comment is success!' mod='csblog'}
						</div>
					{/if}
					
					{if $logged}
							<p class="text">
								<label for="name">{l s='Full Name' mod='csblog'} <em class="pl_requie">*</em></label>
								<input class="plinput" type="text" name="author_name" value="{$cookie->customer_firstname} {$cookie->customer_lastname}"/>
							</p>
							<p class="text">
								<label for="email">{l s='Email' mod='csblog'} <em class="pl_requie">*</em></label>
								<input class="plinput" type="text" name="author_email" value="{$cookie->email}"/> 
							</p>
					{else}
						<p class="text">
							<label for="name">{l s='Full Name' mod='csblog'} <em class="pl_requie">*</em></label>
							<input class="plinput" type="text" name="author_name" value=""/>
						</p>
						<p class="text">
							<label for="email">{l s='Email' mod='csblog'} <em class="pl_requie">*</em></label>
							<input class="plinput" type="text" name="author_email" value=""/> 
						</p>
					{/if}
					<input type="hidden" name="id_cs_blog_post" value="{$post['id_cs_blog_post']}"/>
					<input type="hidden" name="id_shop" value="{$id_shop}"/>
					<p class="text">
							<label for="email">{l s='Title' mod='csblog'} <em class="pl_requie">*</em></label>
							<input class="plinput" type="text" name="title" value=""/> 
					</p>
					{if $using_captcha == 1}
					<p class="text">
							<label for="email">{l s='Captcha' mod='csblog'} <em class="pl_requie">*</em></label>
							<input class="plinput" type="text" name="captcha"  value=""/>
							<img id="captcha" border="0px" src="{$capchatpath}captcha.php" />
							<img src="{$capchatpath}images/reload-16.png" id="reloadbtn_cid_483" alt="Reload" title="Reload image" onclick="document.getElementById('captcha').src='{$capchatpath}captcha.php?'+Math.random();">
					</p>
					{/if}
					<input type="hidden" name="active" value="{if $validate_comment ==1}0{else}1{/if}"/>
					<p class="textarea">
						<label for="comment">{l s='Comment' mod='csblog'} <em class="pl_requie">*</em></label>
						<textarea id="elm1" name="content" cols="25" rows="16"></textarea>
					</p>
					<p></p>
					<p></p>
					<p class="submit">
						<a href="javascript:submitform()" class="csbutton csdefault">
							{l s='Send' mod='csblog'}
						</a>
					</p>
					
					<div class="plclear">&nbsp;</div>	
					<input type="hidden" name="cssubmitcomment" value="true" />
				</div>
			</form>
		</div>
	{/if}<!-- end display form comment-->
{/if}<!--end isset post-->
{/if}
<!--end content-->

<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:57:22
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32844788453a297e2032519-04111764%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e646cf01e03cb2ed831fe46baf80f885857cc93' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/post.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32844788453a297e2032519-04111764',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errorposts' => 0,
    'cs_js_blog' => 0,
    'post' => 0,
    'cs_imipd_show' => 0,
    'cstags' => 0,
    'tag' => 0,
    'count_comment_total' => 0,
    'allow_related_post' => 0,
    'related_posts' => 0,
    'related_post' => 0,
    'csLink' => 0,
    'cs_b_summary_character_count' => 0,
    'allow_related_product' => 0,
    'related_products_result' => 0,
    'grid_product' => 0,
    'numberperpage' => 0,
    'related_product' => 0,
    'image_size_related_product' => 0,
    'link' => 0,
    'PS_CATALOG_MODE' => 0,
    'restricted_country_mode' => 0,
    'priceDisplay' => 0,
    'comments' => 0,
    'comment' => 0,
    'count_comment_show' => 0,
    'viewall' => 0,
    'url_rewrite' => 0,
    'display_form_comment' => 0,
    'error' => 0,
    'success' => 0,
    'logged' => 0,
    'cookie' => 0,
    'id_shop' => 0,
    'using_captcha' => 0,
    'capchatpath' => 0,
    'validate_comment' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a297e2551c77_29277732',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a297e2551c77_29277732')) {function content_53a297e2551c77_29277732($_smarty_tpl) {?><!--post content-->
<?php if (isset($_smarty_tpl->tpl_vars['errorposts']->value)&&$_smarty_tpl->tpl_vars['errorposts']->value){?>
	<div class="error"><?php echo smartyTranslate(array('s'=>'There is no post','mod'=>'csblog.'),$_smarty_tpl);?>
</div>
<?php }else{ ?>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cs_js_blog']->value;?>
"></script>
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
<?php if (isset($_smarty_tpl->tpl_vars['post']->value)){?>
	<div id="plpost">
		<h2><?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
</h2>
		<?php if ($_smarty_tpl->tpl_vars['cs_imipd_show']->value!='none'){?>
			<?php if (isset($_smarty_tpl->tpl_vars['post']->value['image'])&&$_smarty_tpl->tpl_vars['post']->value['image']!=''){?>
			<div class="post_image">
				<img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['image'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
" />
				<div class="post_date_add md">
				<div class="mdd" style="display: table; overflow: hidden;"> 
					<div style=" #position: absolute; #top: 50%; #left:0;display: table-cell; vertical-align: middle;"> 
						<div style="#position: relative; #top: -50%;"> <span><?php echo date('d',strtotime($_smarty_tpl->tpl_vars['post']->value['date_add']));?>
</span><span><?php echo date('M',strtotime($_smarty_tpl->tpl_vars['post']->value['date_add']));?>
</span></div>
					</div>
				</div>	
				</div>	
			</div>	
			<?php }?>
		<?php }?>
		<div class="plpost_content"><p><?php echo $_smarty_tpl->tpl_vars['post']->value['description'];?>
</p></div>

		<div class="pl_info_post clearfix">		
			<?php if (isset($_smarty_tpl->tpl_vars['cstags']->value)&&$_smarty_tpl->tpl_vars['cstags']->value){?>
			<div class="tag_list" style="float:left">
			<span><?php echo smartyTranslate(array('s'=>'Tags:','mod'=>'csblog'),$_smarty_tpl);?>
&nbsp;&nbsp;</span>			
				<?php  $_smarty_tpl->tpl_vars['tag'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tag']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cstags']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['tag']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['tag']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['tag']->key => $_smarty_tpl->tpl_vars['tag']->value){
$_smarty_tpl->tpl_vars['tag']->_loop = true;
 $_smarty_tpl->tpl_vars['tag']->iteration++;
 $_smarty_tpl->tpl_vars['tag']->last = $_smarty_tpl->tpl_vars['tag']->iteration === $_smarty_tpl->tpl_vars['tag']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['cstags']['last'] = $_smarty_tpl->tpl_vars['tag']->last;
?>
					<span><a href="<?php echo $_smarty_tpl->tpl_vars['tag']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['tag']->value['name'];?>
</a><?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['cstags']['last']){?>,&nbsp;<?php }?></span>
				<?php } ?>
			</div>
			<?php }?>
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
			<?php if ($_smarty_tpl->tpl_vars['post']->value['author']!=''){?>
				<?php $_smarty_tpl->tpl_vars['author'] = new Smarty_variable(explode("¤",$_smarty_tpl->tpl_vars['post']->value['author']), null, 0);?><?php echo smartyTranslate(array('s'=>'Post by '),$_smarty_tpl);?>
<span class="pluser_name">
				<?php echo $_smarty_tpl->tpl_vars['post']->value['author'];?>
</span><span class="opa">&nbsp;|&nbsp;</span>
			<?php }?>
			<span class="pl_requie"><?php echo $_smarty_tpl->tpl_vars['count_comment_total']->value;?>
</span><?php if ($_smarty_tpl->tpl_vars['count_comment_total']->value<=1){?> <?php echo smartyTranslate(array('s'=>'Comment','mod'=>'csblog'),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['count_comment_total']->value>1){?> <?php echo smartyTranslate(array('s'=>'Comments','mod'=>'csblog'),$_smarty_tpl);?>
<?php }?>
		</div>		
	</div>
	<div class="plclear">&nbsp;</div>
	<div class="plclear">&nbsp;</div>
	<div class="plclear">&nbsp;</div>
		<!--related posts-->
	<?php if (isset($_smarty_tpl->tpl_vars['allow_related_post']->value)){?>
		<div class="related_posts box0">
			<div class="title"><h3><?php echo smartyTranslate(array('s'=>'Related posts','mod'=>'csblog'),$_smarty_tpl);?>
</h3></div>
			<div class="box0-content">
			<?php if (isset($_smarty_tpl->tpl_vars['related_posts']->value)&&$_smarty_tpl->tpl_vars['related_posts']->value){?>
				<ul class="unstyled">
				<?php  $_smarty_tpl->tpl_vars['related_post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['related_post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['related_post']->key => $_smarty_tpl->tpl_vars['related_post']->value){
$_smarty_tpl->tpl_vars['related_post']->_loop = true;
?>
					<li class="li_related_post">											
						<a href="<?php echo $_smarty_tpl->tpl_vars['csLink']->value->getLinkPostDetail($_smarty_tpl->tpl_vars['related_post']->value['id_cs_blog_post'],$_smarty_tpl->tpl_vars['related_post']->value['link_rewrite'],$_smarty_tpl->tpl_vars['related_post']->value['id_cs_blog_category']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['related_post']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['related_post']->value['name'];?>
</a>						
						<?php if (isset($_smarty_tpl->tpl_vars['related_post']->value['image'])&&$_smarty_tpl->tpl_vars['related_post']->value['image']!=''){?>
							<div class="post_image"><a href="<?php echo $_smarty_tpl->tpl_vars['csLink']->value->getLinkPostDetail($_smarty_tpl->tpl_vars['related_post']->value['id_cs_blog_post'],$_smarty_tpl->tpl_vars['related_post']->value['link_rewrite'],$_smarty_tpl->tpl_vars['related_post']->value['id_cs_blog_category']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['related_post']->value['name'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['related_post']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['related_post']->value['name'];?>
" /></a></div>
						<?php }?>
						<div class="post_description"><p><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['cs_b_summary_character_count']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['related_post']->value['description']),$_tmp1);?>
</p></div>
					</li>
				<?php } ?>
				</ul>
			<?php }else{ ?>
				<p><?php echo smartyTranslate(array('s'=>'There is no related post','mod'=>'csblog'),$_smarty_tpl);?>
</p>
			<?php }?>
		</div>
		</div>
	<?php }?>
	<!--related products-->
	<?php if (isset($_smarty_tpl->tpl_vars['allow_related_product']->value)){?>
		<div class="related_products box0 clearfix">
			<div class="title"><h3><?php echo smartyTranslate(array('s'=>'Related products','mod'=>'csblog'),$_smarty_tpl);?>
</h3></div>
			<div class="box0-content">
			<?php if (isset($_smarty_tpl->tpl_vars['related_products_result']->value)&&$_smarty_tpl->tpl_vars['related_products_result']->value){?>
				<ul class="unstyled">
				<?php  $_smarty_tpl->tpl_vars['related_product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['related_product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_products_result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['related_product']->key => $_smarty_tpl->tpl_vars['related_product']->value){
$_smarty_tpl->tpl_vars['related_product']->_loop = true;
?>
					<li class="<?php if (isset($_smarty_tpl->tpl_vars['grid_product']->value)){?><?php echo $_smarty_tpl->tpl_vars['grid_product']->value;?>
<?php }else{ ?>grid_6<?php }?> ajax_block_product <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['accessories_list']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['accessories_list']['last']){?>last_item<?php }else{ ?>item<?php }?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['accessories_list']['index']%$_smarty_tpl->tpl_vars['numberperpage']->value==0){?> alpha<?php }elseif(($_smarty_tpl->getVariable('smarty')->value['foreach']['accessories_list']['index']+1)%$_smarty_tpl->tpl_vars['numberperpage']->value==0){?> omega<?php }?>  product_accessories_description clearfix">
						<div class="center_block">														
							<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['related_product']->value['link'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="product_img_link" title="">
								<img src="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['image_size_related_product']->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['related_product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['related_product']->value['id_image'],$_tmp2);?>
" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['related_product']->value['legend'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
							</a>
							<div class="name_product"><h3><a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['related_product']->value['link'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title=""><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['related_product']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'),60,'...');?>
</a></h3></div>
							<p class="product_desc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['related_product']->value['description_short']),360,'...');?>
</p>
							
							<?php if ((!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value&&((isset($_smarty_tpl->tpl_vars['related_product']->value['show_price'])&&$_smarty_tpl->tpl_vars['related_product']->value['show_price'])||(isset($_smarty_tpl->tpl_vars['related_product']->value['available_for_order'])&&$_smarty_tpl->tpl_vars['related_product']->value['available_for_order'])))){?>
								<div class="content_price">
									<?php if (isset($_smarty_tpl->tpl_vars['related_product']->value['show_price'])&&$_smarty_tpl->tpl_vars['related_product']->value['show_price']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)){?><span class="price" style="display: inline;"><?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value){?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['related_product']->value['price']),$_smarty_tpl);?>
<?php }else{ ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['related_product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?></span><br /><?php }?>
									
								</div>
							<?php }?>
							
						</div>
						
					</li>
				<?php } ?>
				</ul>
			<?php }else{ ?>
				<p><?php echo smartyTranslate(array('s'=>'There is no related product','mod'=>'csblog'),$_smarty_tpl);?>
</p>
			<?php }?>
			</div>
		</div>
	<?php }?> <!--end related product-->
		<!-- display comment list -->
		<div class="pl_list_comment box0">
			<div class="title"><h3><?php echo smartyTranslate(array('s'=>'Comments ','mod'=>'csblog'),$_smarty_tpl);?>
(<?php echo $_smarty_tpl->tpl_vars['count_comment_total']->value;?>
)</h3></div>
			<div class="box0-content">
			<?php if (isset($_smarty_tpl->tpl_vars['comments']->value)&&$_smarty_tpl->tpl_vars['comments']->value){?>
				<?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['comment']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['comment']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
$_smarty_tpl->tpl_vars['comment']->_loop = true;
 $_smarty_tpl->tpl_vars['comment']->iteration++;
 $_smarty_tpl->tpl_vars['comment']->last = $_smarty_tpl->tpl_vars['comment']->iteration === $_smarty_tpl->tpl_vars['comment']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["comments"]['last'] = $_smarty_tpl->tpl_vars['comment']->last;
?>
					<div class="plcomment <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['comments']['last']){?> last<?php }?>">
						<div class="info_comment">
							<span class="comment_author"><?php echo smartyTranslate(array('s'=>'Post By '),$_smarty_tpl);?>
<span class="pluser_name">
							<?php if (isset($_smarty_tpl->tpl_vars['comment']->value['author_name'])&&$_smarty_tpl->tpl_vars['comment']->value['author_name']!=''){?><?php echo $_smarty_tpl->tpl_vars['comment']->value['author_name'];?>
<?php }?></span></span>
							<span class="opa">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
							<span class="pldate_add"><?php echo $_smarty_tpl->tpl_vars['comment']->value['date_add'];?>
</span>	
						</div>									
						<div class="plcomment_content">*<?php echo $_smarty_tpl->tpl_vars['comment']->value['content'];?>
*</div>
					</div>
				<?php } ?>
			<?php }else{ ?>
				<p><?php echo smartyTranslate(array('s'=>'There is no comment','mod'=>'csblog'),$_smarty_tpl);?>
</p>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['count_comment_total']->value>$_smarty_tpl->tpl_vars['count_comment_show']->value&&!isset($_smarty_tpl->tpl_vars['viewall']->value)){?>
			<div class="plclear">&nbsp;</div>
			<a class="csbutton cssecond" href="<?php echo $_smarty_tpl->tpl_vars['csLink']->value->getLinkPostDetail($_smarty_tpl->tpl_vars['post']->value['id_cs_blog_post'],$_smarty_tpl->tpl_vars['post']->value['link_rewrite'],$_smarty_tpl->tpl_vars['post']->value['id_cs_blog_category']);?>
<?php if ($_smarty_tpl->tpl_vars['url_rewrite']->value==1){?>?<?php }else{ ?>&<?php }?>viewall"><?php echo smartyTranslate(array('s'=>'view all','mod'=>'csblog'),$_smarty_tpl);?>
</a>
			<?php }elseif(isset($_smarty_tpl->tpl_vars['viewall']->value)){?>
			<div class="plclear">&nbsp;</div>
				<a class="csbutton cssecond" href="<?php echo $_smarty_tpl->tpl_vars['csLink']->value->getLinkPostDetail($_smarty_tpl->tpl_vars['post']->value['id_cs_blog_post'],$_smarty_tpl->tpl_vars['post']->value['link_rewrite'],$_smarty_tpl->tpl_vars['post']->value['id_cs_blog_category']);?>
"><?php echo smartyTranslate(array('s'=>'Collapse','mod'=>'csblog'),$_smarty_tpl);?>
</a>
			<?php }?>
			</div>
		</div>
		<div class="plclear">&nbsp;</div>
		<!-- /display comment list -->
	<!-- display form comment-->
	<?php if ($_smarty_tpl->tpl_vars['display_form_comment']->value==1){?>
		<div class="pl_comment_form box0">
			<form action="<?php echo $_smarty_tpl->tpl_vars['csLink']->value->getLinkPostDetail($_smarty_tpl->tpl_vars['post']->value['id_cs_blog_post'],$_smarty_tpl->tpl_vars['post']->value['link_rewrite'],$_smarty_tpl->tpl_vars['post']->value['id_cs_blog_category']);?>
" name="csaddcomment" method="post" class="std">				
				<div class="title"><h3><?php echo smartyTranslate(array('s'=>'Send a comment','mod'=>'csblog'),$_smarty_tpl);?>
</h3></div>
				<div class="fieldset box0-content">
					<?php if (isset($_smarty_tpl->tpl_vars['error']->value)){?>
						<div class="error">
							<?php echo smartyTranslate(array('s'=>'There ','mod'=>'csblog'),$_smarty_tpl);?>
<?php if (count($_smarty_tpl->tpl_vars['error']->value)<=1){?> <?php echo smartyTranslate(array('s'=>'is ','mod'=>'csblog'),$_smarty_tpl);?>
 <?php }else{ ?> <?php echo smartyTranslate(array('s'=>'are ','mod'=>'csblog'),$_smarty_tpl);?>
<?php }?><?php echo count($_smarty_tpl->tpl_vars['error']->value);?>
 <?php if (count($_smarty_tpl->tpl_vars['error']->value)<=1){?> <?php echo smartyTranslate(array('s'=>'error ','mod'=>'csblog'),$_smarty_tpl);?>
 <?php }else{ ?> <?php echo smartyTranslate(array('s'=>'errors ','mod'=>'csblog'),$_smarty_tpl);?>
<?php }?>
							<ol>
								<?php if (isset($_smarty_tpl->tpl_vars['error']->value['author_name'])){?><li><?php echo $_smarty_tpl->tpl_vars['error']->value['author_name'];?>
</li><?php }?>
								<?php if (isset($_smarty_tpl->tpl_vars['error']->value['author_email'])){?><li><?php echo $_smarty_tpl->tpl_vars['error']->value['author_email'];?>
</li><?php }?>
								<?php if (isset($_smarty_tpl->tpl_vars['error']->value['title'])){?><li><?php echo $_smarty_tpl->tpl_vars['error']->value['title'];?>
</li><?php }?>
								<?php if (isset($_smarty_tpl->tpl_vars['error']->value['captcha'])){?><li><?php echo $_smarty_tpl->tpl_vars['error']->value['captcha'];?>
</li><?php }?>
								<?php if (isset($_smarty_tpl->tpl_vars['error']->value['content'])){?><li><?php echo $_smarty_tpl->tpl_vars['error']->value['content'];?>
</li><?php }?>
							</ol>
						</div>
					<?php }elseif(isset($_smarty_tpl->tpl_vars['success']->value)){?>
						<div class="success">
							<?php echo smartyTranslate(array('s'=>'Comment is success!','mod'=>'csblog'),$_smarty_tpl);?>

						</div>
					<?php }?>
					
					<?php if ($_smarty_tpl->tpl_vars['logged']->value){?>
							<p class="text">
								<label for="name"><?php echo smartyTranslate(array('s'=>'Full Name','mod'=>'csblog'),$_smarty_tpl);?>
 <em class="pl_requie">*</em></label>
								<input class="plinput" type="text" name="author_name" value="<?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_lastname;?>
"/>
							</p>
							<p class="text">
								<label for="email"><?php echo smartyTranslate(array('s'=>'Email','mod'=>'csblog'),$_smarty_tpl);?>
 <em class="pl_requie">*</em></label>
								<input class="plinput" type="text" name="author_email" value="<?php echo $_smarty_tpl->tpl_vars['cookie']->value->email;?>
"/> 
							</p>
					<?php }else{ ?>
						<p class="text">
							<label for="name"><?php echo smartyTranslate(array('s'=>'Full Name','mod'=>'csblog'),$_smarty_tpl);?>
 <em class="pl_requie">*</em></label>
							<input class="plinput" type="text" name="author_name" value=""/>
						</p>
						<p class="text">
							<label for="email"><?php echo smartyTranslate(array('s'=>'Email','mod'=>'csblog'),$_smarty_tpl);?>
 <em class="pl_requie">*</em></label>
							<input class="plinput" type="text" name="author_email" value=""/> 
						</p>
					<?php }?>
					<input type="hidden" name="id_cs_blog_post" value="<?php echo $_smarty_tpl->tpl_vars['post']->value['id_cs_blog_post'];?>
"/>
					<input type="hidden" name="id_shop" value="<?php echo $_smarty_tpl->tpl_vars['id_shop']->value;?>
"/>
					<p class="text">
							<label for="email"><?php echo smartyTranslate(array('s'=>'Title','mod'=>'csblog'),$_smarty_tpl);?>
 <em class="pl_requie">*</em></label>
							<input class="plinput" type="text" name="title" value=""/> 
					</p>
					<?php if ($_smarty_tpl->tpl_vars['using_captcha']->value==1){?>
					<p class="text">
							<label for="email"><?php echo smartyTranslate(array('s'=>'Captcha','mod'=>'csblog'),$_smarty_tpl);?>
 <em class="pl_requie">*</em></label>
							<input class="plinput" type="text" name="captcha"  value=""/>
							<img id="captcha" border="0px" src="<?php echo $_smarty_tpl->tpl_vars['capchatpath']->value;?>
captcha.php" />
							<img src="<?php echo $_smarty_tpl->tpl_vars['capchatpath']->value;?>
images/reload-16.png" id="reloadbtn_cid_483" alt="Reload" title="Reload image" onclick="document.getElementById('captcha').src='<?php echo $_smarty_tpl->tpl_vars['capchatpath']->value;?>
captcha.php?'+Math.random();">
					</p>
					<?php }?>
					<input type="hidden" name="active" value="<?php if ($_smarty_tpl->tpl_vars['validate_comment']->value==1){?>0<?php }else{ ?>1<?php }?>"/>
					<p class="textarea">
						<label for="comment"><?php echo smartyTranslate(array('s'=>'Comment','mod'=>'csblog'),$_smarty_tpl);?>
 <em class="pl_requie">*</em></label>
						<textarea id="elm1" name="content" cols="25" rows="16"></textarea>
					</p>
					<p></p>
					<p></p>
					<p class="submit">
						<a href="javascript:submitform()" class="csbutton csdefault">
							<?php echo smartyTranslate(array('s'=>'Send','mod'=>'csblog'),$_smarty_tpl);?>

						</a>
					</p>
					
					<div class="plclear">&nbsp;</div>	
					<input type="hidden" name="cssubmitcomment" value="true" />
				</div>
			</form>
		</div>
	<?php }?><!-- end display form comment-->
<?php }?><!--end isset post-->
<?php }?>
<!--end content-->
<?php }} ?>
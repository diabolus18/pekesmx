<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:06
         compiled from "/home/pekesmx/www/prestashop/modules/cshometab/cshometab.tpl" */ ?>
<?php /*%%SmartyHeaderCode:201470201953a1da36218c08-09810579%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56566e109f09b26198d8f1bf5d48535c5c6763e0' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/cshometab/cshometab.tpl',
      1 => 1401262787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201470201953a1da36218c08-09810579',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tabs' => 0,
    'tab' => 0,
    'cookie' => 0,
    'delay' => 0,
    'product' => 0,
    'link' => 0,
    'restricted_country_mode' => 0,
    'priceDisplay' => 0,
    'add_prod_display' => 0,
    'PS_CATALOG_MODE' => 0,
    'static_token' => 0,
    'sub_cat' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da364ede27_82759215',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da364ede27_82759215')) {function content_53a1da364ede27_82759215($_smarty_tpl) {?><!-- CS Home Tab module -->
<div class="home_top_tab">
<?php if (count($_smarty_tpl->tpl_vars['tabs']->value)>0){?>
<div id="tabs">
	<?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tabs']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value){
$_smarty_tpl->tpl_vars['tab']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tabs']['iteration']++;
?>
	<?php if (count($_smarty_tpl->tpl_vars['tab']->value->product_list)>0){?>
	<div class="box1">
	<div class="title"><h3><?php echo $_smarty_tpl->tpl_vars['tab']->value->title[(int)$_smarty_tpl->tpl_vars['cookie']->value->id_lang];?>
</h3></div>	
	<div class="tabs-carousel" id="tabs-<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
">
		<div class="cycleElementsContainer" id="cycle-<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
">
			
			<div id="elements-<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
">
				
				<div class="list_carousel responsive">
					<ul id="carousel<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
" class="product-grid">
					<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_smarty_tpl->tpl_vars['delay'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['tab']->value->product_list; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['delay']->value = $_smarty_tpl->tpl_vars['product']->key;
?>
					
						<li class="ajax_block_product not-animated" data-animate="bounceIn" data-delay="<?php echo $_smarty_tpl->tpl_vars['delay']->value*200;?>
">
							<div class="p_content">
								<div class="image">
									<a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="" class="product_image">
										<img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'prod_slider_home');?>
" alt="" />
									</a>
									
									<?php if ($_smarty_tpl->tpl_vars['product']->value['specific_prices']){?>
										
											<?php if ($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']>0){?>
												<?php if ($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction_type']=='percentage'){?>
													<span class="on_sale">
														<span class="percen">
															-<?php echo $_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']*100;?>
%
														</span>
													</span>
												<?php }else{ ?>
													<span class="on_sale">
														<span class="amount">															-<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['reduction']),$_smarty_tpl);?>

														</span>
													</span>
												<?php }?>
											
										<?php }?>
									<?php }else{ ?>
										<?php if ($_smarty_tpl->tpl_vars['product']->value['new']==1){?>
											<span class="new"><span><?php echo smartyTranslate(array('s'=>'new'),$_smarty_tpl);?>
</span></span>
										<?php }?>
									<?php }?>
								</div>
								<div class="name_product">
									<h3>
									<a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],30,'...'), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a>
									</h3>
								</div>
								
								<p class="product_desc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['product']->value['description_short']),60,'...');?>
</p>
								
								
								<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayProductListReviews','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);?>

								
								<div class="content_price">
									<?php if ($_smarty_tpl->tpl_vars['product']->value['reduction']){?>
									<span class="price old">
									<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>
</span><?php }?>	
									<?php if (isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)){?>
									<span class="price <?php if ($_smarty_tpl->tpl_vars['product']->value['reduction']){?><?php }?>"><?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value){?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);?>
<?php }else{ ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?></span>	
									<?php }?>
								</div>
								<?php if (($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']==0||(isset($_smarty_tpl->tpl_vars['add_prod_display']->value)&&($_smarty_tpl->tpl_vars['add_prod_display']->value==1)))&&$_smarty_tpl->tpl_vars['product']->value['available_for_order']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&$_smarty_tpl->tpl_vars['product']->value['minimal_quantity']==1&&$_smarty_tpl->tpl_vars['product']->value['customizable']!=2&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>
									<?php if (($_smarty_tpl->tpl_vars['product']->value['quantity']>0||$_smarty_tpl->tpl_vars['product']->value['allow_oosp'])){?>
									<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('cart.php');?>
?qty=1&amp;id_product=<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
&amp;token=<?php echo $_smarty_tpl->tpl_vars['static_token']->value;?>
&amp;add" title=""><span class="in_button"><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'cshometab'),$_smarty_tpl);?>
</span></a>
									<?php }else{ ?>
									<span class="csbutton cssecond"><?php echo smartyTranslate(array('s'=>'Out of stock','mod'=>'cshometab'),$_smarty_tpl);?>
</span>
									<?php }?>
								<?php }else{ ?>
									<div style="height:23px;"></div>
								<?php }?>
							
							</div>
					</li>
					<?php } ?>
					</ul>
					<div class="cclearfix"></div>
					<?php if (count($_smarty_tpl->tpl_vars['tab']->value->product_list)>4){?>
						<div class="control">
							<a id="prev<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
" class="prev" href="#">&lt;</a>
							<a id="next<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
" class="next" href="#">&gt;</a>
						</div>
					<?php }?>
				</div>
				
					<?php if (isset($_smarty_tpl->tpl_vars['tab']->value->sub_category)){?>
					<div class="sub_category">
					<h6 data-animate="fadeInUp" data-delay="100"><?php echo smartyTranslate(array('s'=>'Sub category','mod'=>'cshometab'),$_smarty_tpl);?>
</h6>
					<?php  $_smarty_tpl->tpl_vars['sub_cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sub_cat']->_loop = false;
 $_smarty_tpl->tpl_vars['delay'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['tab']->value->sub_category; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['sub_cat']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['sub_cat']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['sub_cat']->key => $_smarty_tpl->tpl_vars['sub_cat']->value){
$_smarty_tpl->tpl_vars['sub_cat']->_loop = true;
 $_smarty_tpl->tpl_vars['delay']->value = $_smarty_tpl->tpl_vars['sub_cat']->key;
 $_smarty_tpl->tpl_vars['sub_cat']->iteration++;
 $_smarty_tpl->tpl_vars['sub_cat']->last = $_smarty_tpl->tpl_vars['sub_cat']->iteration === $_smarty_tpl->tpl_vars['sub_cat']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['sub_cat']['last'] = $_smarty_tpl->tpl_vars['sub_cat']->last;
?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['sub_cat']->value['link_sub_cat'];?>
" data-animate="fadeInUp" data-delay="<?php echo $_smarty_tpl->tpl_vars['delay']->value*150;?>
"><?php echo $_smarty_tpl->tpl_vars['sub_cat']->value['name'];?>
</a>
						<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['sub_cat']['last']){?><span class="opa" data-animate="fadeInUp" data-delay="<?php echo $_smarty_tpl->tpl_vars['delay']->value*160;?>
">&nbsp;|&nbsp;</span><?php }?>
					<?php } ?>
					</div>
					<?php }?>
				
				
			</div>
		</div>
	</div>
	</div>
	<?php }?>
	<?php } ?>
</div>
<script type="text/javascript">
	$(window).load(function() {
		if(!isMobile())
		{
			initCarousel();
		}
		else
		{
			initCarouselMobile()
		}
		$('.home_top_tab .prev, .home_top_tab .next').click(function(){
			return removeApear($(this));});

	});
	
	function initCarousel() {
		<?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tabs']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value){
$_smarty_tpl->tpl_vars['tab']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tabs']['iteration']++;
?>		
		//	Responsive layout, resizing the items
		$('#carousel<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
').carouFredSel({
			responsive: true,
			onWindowResize: 'debounce',
			width: '100%',
			height:'variable',
			prev: '#prev<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
',
			next: '#next<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
',
			auto: false,
			swipe: {
				onTouch : true
			},
			items: {
				width: 220,
				height: 'auto',	//	optionally resize item-height
				visible: {
					min: 1,
					max: 3
				}
			},
			scroll: {
				items:3,
				duration  : 1000   //  The duration of the transition.
			}
		});			
		<?php } ?>
	}
	function removeApear(element){
		var id_tab = element.attr('id').substring(4);
		var tab = '#tabs-'+id_tab;
		if(touch == false){
            var that = $(tab);
            var items = that.find('.not-animated');
            items.removeClass('not-animated').unbind('appear');
            
            items = that.find('.animated');
            items.removeClass('animated').unbind('appear');
          }
	}
	
	function initCarouselMobile() {
	<?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tabs']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value){
$_smarty_tpl->tpl_vars['tab']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tabs']['iteration']++;
?>
	//	Responsive layout, resizing the items
	$('#carousel<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
').carouFredSel({
		responsive: true,
		onWindowResize: 'debounce',
		width: '100%',
		height:'variable',
		prev: '#prev<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
',
		next: '#next<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['tabs']['iteration'];?>
',
		auto: false,
		swipe: {
			onTouch : true
		},
		items: {
			width: 320,
			height: 'auto',	//	optionally resize item-height
			visible: {
				min: 1,
				max: 2
			}
		},
		scroll: {
			items:1,
			direction : 'left',    //  The direction of the transition.
			duration  : 300   //  The duration of the transition.
		}
	});
	<?php } ?>
	}
	
	function isMobile() 
	{
		if(navigator.userAgent.match(/(iPhone)|(iPod)/i)){
				return true;
		}
		else
		{
			return false;
		}
		
	}
</script>
<?php }?>
</div>
<!-- /CS Home Tab module -->
<?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:27:46
         compiled from "/home/pekesmx/www/prestashop/themes/electronues/product-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:97120134953a1da22646dd3-26833294%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '035a87849354f514c65bf5a00146238f60411a05' => 
    array (
      0 => '/home/pekesmx/www/prestashop/themes/electronues/product-list.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97120134953a1da22646dd3-26833294',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'products' => 0,
    'number_p' => 0,
    'numberperpage' => 0,
    'product' => 0,
    'link' => 0,
    'PS_CATALOG_MODE' => 0,
    'price_drop' => 0,
    'restricted_country_mode' => 0,
    'priceDisplay' => 0,
    'add_prod_display' => 0,
    'static_token' => 0,
    'comparator_max_item' => 0,
    'compareProducts' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da229132b7_59599408',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da229132b7_59599408')) {function content_53a1da229132b7_59599408($_smarty_tpl) {?>

<?php if (isset($_smarty_tpl->tpl_vars['products']->value)){?>
	<?php if (isset($_smarty_tpl->tpl_vars['number_p']->value)){?>
		<?php $_smarty_tpl->tpl_vars['numberperpage'] = new Smarty_variable($_smarty_tpl->tpl_vars['number_p']->value, null, 0);?>
	<?php }else{ ?>
		<?php $_smarty_tpl->tpl_vars['numberperpage'] = new Smarty_variable(3, null, 0);?>
	<?php }?>
	<ul id="product_list" class="clear <?php if (isset($_COOKIE['display_class'])){?><?php echo $_COOKIE['display_class'];?>
<?php }?>">
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
		
		
		<li class="grid_6 alpha omega ajax_block_product <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['last']){?>last_item<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['index']%$_smarty_tpl->tpl_vars['numberperpage']->value==0){?>alpha clear<?php }elseif(($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['index']+1)%$_smarty_tpl->tpl_vars['numberperpage']->value==0){?>omega<?php }?> clearfix" data-animate="bounceIn" data-delay="0">
			<div class="center_block" itemscope itemtype="http://schema.org/Product">				
				<div class="image"><a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="product_img_link" title="">
					<img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'category_product');?>
" alt=""  itemprop="image" />
					<?php if (isset($_smarty_tpl->tpl_vars['product']->value['on_sale'])&&$_smarty_tpl->tpl_vars['product']->value['on_sale']&&isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?><span class="on_sale"><span><?php echo smartyTranslate(array('s'=>'sale off'),$_smarty_tpl);?>
</span></span><?php }?>
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
								<span class="amount">
									<?php $_smarty_tpl->tpl_vars['price_drop'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['price_without_reduction']-$_smarty_tpl->tpl_vars['product']->value['price'], null, 0);?>
									-<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['price_drop']->value),$_smarty_tpl);?>

								</span>
							</span>
						<?php }?>
					<?php }?>
				<?php }?>
				</div>
				<div class="name_product"><h3><a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'),45,'...');?>
</a></h3></div>
				<?php if (isset($_smarty_tpl->tpl_vars['product']->value['available_for_order'])&&$_smarty_tpl->tpl_vars['product']->value['available_for_order']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)){?><?php if (($_smarty_tpl->tpl_vars['product']->value['allow_oosp']||$_smarty_tpl->tpl_vars['product']->value['quantity']>0)){?>
					<span class="availability"><?php echo smartyTranslate(array('s'=>'Available'),$_smarty_tpl);?>
</span><?php }elseif((isset($_smarty_tpl->tpl_vars['product']->value['quantity_all_versions'])&&$_smarty_tpl->tpl_vars['product']->value['quantity_all_versions']>0)){?><span class="availability"><?php echo smartyTranslate(array('s'=>'Product available with different options'),$_smarty_tpl);?>
</span><?php }else{ ?>
					<span class="cs_out_of_stock"><?php echo smartyTranslate(array('s'=>'Out of stock'),$_smarty_tpl);?>
</span><?php }?>
				<?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['product']->value['online_only'])&&$_smarty_tpl->tpl_vars['product']->value['online_only']){?>
					<span class="online_only"><?php echo smartyTranslate(array('s'=>'Online only!'),$_smarty_tpl);?>
</span>
				<?php }?>
				
				<p class="product_desc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['product']->value['description_short']),90,'...');?>
</p>
				<?php if ((!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value&&((isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price'])||(isset($_smarty_tpl->tpl_vars['product']->value['available_for_order'])&&$_smarty_tpl->tpl_vars['product']->value['available_for_order'])))){?>
				<div class="content_price">
					<?php if ($_smarty_tpl->tpl_vars['product']->value['reduction']){?><span class="price old"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>
</span><?php }?>	
					<?php if (isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)){?><span class="price<?php if ($_smarty_tpl->tpl_vars['product']->value['reduction']){?><?php }?>"><?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value){?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);?>
<?php }else{ ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?></span><?php }?>
				</div>
				
				<?php }?>
				
			<?php if (($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']==0||(isset($_smarty_tpl->tpl_vars['add_prod_display']->value)&&($_smarty_tpl->tpl_vars['add_prod_display']->value==1)))&&$_smarty_tpl->tpl_vars['product']->value['available_for_order']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&$_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<=1&&$_smarty_tpl->tpl_vars['product']->value['customizable']!=2&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>
					<?php if (($_smarty_tpl->tpl_vars['product']->value['allow_oosp']||$_smarty_tpl->tpl_vars['product']->value['quantity']>0)){?>
						<?php if (isset($_smarty_tpl->tpl_vars['static_token']->value)){?>
							<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,"add&amp;id_product=".$_tmp1."&amp;token=".((string)$_smarty_tpl->tpl_vars['static_token']->value),false);?>
" title=""><?php echo smartyTranslate(array('s'=>'Add to cart'),$_smarty_tpl);?>
</a>
						<?php }else{ ?>
							<a class="csbutton ajax_add_to_cart_button csdefault" rel="ajax_id_product_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,"add&amp;id_product=".$_tmp2,false);?>
" title=""><?php echo smartyTranslate(array('s'=>'Add to cart'),$_smarty_tpl);?>
</a>
						<?php }?>						
					<?php }else{ ?>
						<span class="csbutton cssecond"><?php echo smartyTranslate(array('s'=>'Out of stock'),$_smarty_tpl);?>
</span>
					<?php }?>
				<?php }?>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayProductListFunctionalButtons','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);?>

				<?php if (isset($_smarty_tpl->tpl_vars['comparator_max_item']->value)&&$_smarty_tpl->tpl_vars['comparator_max_item']->value){?>
					<p class="compare">
						<input type="checkbox" class="comparator" id="comparator_item_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" value="comparator_item_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['compareProducts']->value)&&in_array($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['compareProducts']->value)){?>checked="checked"<?php }?> /> 
						<label for="comparator_item_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
"><?php echo smartyTranslate(array('s'=>'Select to compare'),$_smarty_tpl);?>
</label>
					</p>
				<?php }?>
			</div>
		</li>
	<?php } ?>
	</ul>
	<!-- /Products list -->
	
<?php }?>
<?php }} ?>
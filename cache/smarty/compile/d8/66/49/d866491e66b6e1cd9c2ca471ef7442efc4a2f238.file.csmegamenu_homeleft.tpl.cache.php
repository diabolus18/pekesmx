<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:04
         compiled from "/home/pekesmx/www/prestashop/modules/csmegamenu/csmegamenu_homeleft.tpl" */ ?>
<?php /*%%SmartyHeaderCode:62518239353a1da3495aa98-47726486%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd866491e66b6e1cd9c2ca471ef7442efc4a2f238' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csmegamenu/csmegamenu_homeleft.tpl',
      1 => 1401262787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62518239353a1da3495aa98-47726486',
  'function' => 
  array (
    'menu' => 
    array (
      'parameter' => 
      array (
        'level' => 1,
      ),
      'compiled' => '
 <?php if (is_array($_smarty_tpl->tpl_vars[\'data\']->value)&&count($_smarty_tpl->tpl_vars[\'data\']->value)>0){?>
  <div class="sub_menu" style="width : <?php echo $_smarty_tpl->tpl_vars[\'width\']->value;?>
px;">
  <ul class="level_<?php echo $_smarty_tpl->tpl_vars[\'level\']->value;?>
">
  <?php  $_smarty_tpl->tpl_vars[\'menu\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'menu\']->_loop = false;
 $_smarty_tpl->tpl_vars[\'k\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars[\'data\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'menu\']->key => $_smarty_tpl->tpl_vars[\'menu\']->value){
$_smarty_tpl->tpl_vars[\'menu\']->_loop = true;
 $_smarty_tpl->tpl_vars[\'k\']->value = $_smarty_tpl->tpl_vars[\'menu\']->key;
?>
	<?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable((((($_smarty_tpl->tpl_vars[\'ps_cat_img_dir\']->value).($_smarty_tpl->tpl_vars[\'menu\']->value[\'id\'])).(\'-\')).($_smarty_tpl->tpl_vars[\'image_size\']->value)).(\'.jpg\'), null, 0);?>
    <?php if (is_array($_smarty_tpl->tpl_vars[\'menu\']->value[\'children\'])&&count($_smarty_tpl->tpl_vars[\'menu\']->value[\'children\'])>0){?>
      <li <?php if (count($_smarty_tpl->tpl_vars[\'menu\']->value[\'children\'])>0){?> class="parent"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars[\'menu\']->value[\'link\'];?>
">
		  <?php echo $_smarty_tpl->tpl_vars[\'menu\']->value[\'name\'];?>
 </a>
		<?php Smarty_Internal_Function_Call_Handler::call (\'menu\',$_smarty_tpl,array(\'data\'=>$_smarty_tpl->tpl_vars[\'menu\']->value[\'children\'],\'level\'=>$_smarty_tpl->tpl_vars[\'level\']->value+1),\'62518239353a1da3495aa98_47726486\',false);?>

	  </li>
    <?php }else{ ?>
      <li><a href="<?php echo $_smarty_tpl->tpl_vars[\'menu\']->value[\'link\'];?>
">
	  <?php echo $_smarty_tpl->tpl_vars[\'menu\']->value[\'name\'];?>
</a></li>
    <?php }?>
  <?php } ?>
  </ul></div>
  <?php }?>
',
      'nocache_hash' => '62518239353a1da3495aa98-47726486',
      'has_nocache_code' => false,
      'called_functions' => 
      array (
        0 => 'menu',
      ),
    ),
  ),
  'variables' => 
  array (
    'data' => 0,
    'width' => 0,
    'level' => 0,
    'ps_cat_img_dir' => 0,
    'menu' => 0,
    'image_size' => 0,
    'menus' => 0,
    'cookie' => 0,
    'path_icon' => 0,
    'option' => 0,
    'image' => 0,
    'link' => 0,
    'ul' => 0,
    'sub_categories' => 0,
    'temp' => 0,
    'li' => 0,
    'category' => 0,
    'product' => 0,
    'restricted_country_mode' => 0,
    'PS_CATALOG_MODE' => 0,
    'priceDisplay' => 0,
    'lang' => 0,
    'ps_manu_img_dir' => 0,
    'manufac' => 0,
    'img_manu_dir' => 0,
    'cms' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da35177b72_41970634',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da35177b72_41970634')) {function content_53a1da35177b72_41970634($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include '/home/pekesmx/www/prestashop/tools/smarty/plugins/function.math.php';
?>

<?php if (isset($_smarty_tpl->tpl_vars['menus']->value)&&count($_smarty_tpl->tpl_vars['menus']->value)>0){?>
<!-- Block mega menu module -->
<div class="cs_mega_menu" id="menu">
<div class="cs_mega_menu_cat">
	<div class="cs_ul_mega_menu">
	<ul class="ul_mega_menu">
	<?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['menu']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['menu']->iteration=0;
 $_smarty_tpl->tpl_vars['menu']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
 $_smarty_tpl->tpl_vars['menu']->iteration++;
 $_smarty_tpl->tpl_vars['menu']->index++;
 $_smarty_tpl->tpl_vars['menu']->first = $_smarty_tpl->tpl_vars['menu']->index === 0;
 $_smarty_tpl->tpl_vars['menu']->last = $_smarty_tpl->tpl_vars['menu']->iteration === $_smarty_tpl->tpl_vars['menu']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['menus']['first'] = $_smarty_tpl->tpl_vars['menu']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['menus']['last'] = $_smarty_tpl->tpl_vars['menu']->last;
?>
		<li class="<?php echo $_smarty_tpl->tpl_vars['menu']->value->classes;?>
 menu_item<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['menus']['first']){?> menu_first<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['menus']['last']){?>menu_last <?php }?>level-1<?php if ($_smarty_tpl->tpl_vars['menu']->value->options&&count($_smarty_tpl->tpl_vars['menu']->value->options)>0){?> parent<?php }?>">
			<?php if (isset($_smarty_tpl->tpl_vars['menu']->value->description[(int)$_smarty_tpl->tpl_vars['cookie']->value->id_lang])&&$_smarty_tpl->tpl_vars['menu']->value->description[(int)$_smarty_tpl->tpl_vars['cookie']->value->id_lang]!=''){?>
			<div class="des_menu"><?php echo $_smarty_tpl->tpl_vars['menu']->value->description[(int)$_smarty_tpl->tpl_vars['cookie']->value->id_lang];?>
</div>
			<?php }?>
			<a class="title_menu_parent" href="<?php echo $_smarty_tpl->tpl_vars['menu']->value->link_of_title[(int)$_smarty_tpl->tpl_vars['cookie']->value->id_lang];?>
" title="">
			<?php if (isset($_smarty_tpl->tpl_vars['menu']->value->icon)&&$_smarty_tpl->tpl_vars['menu']->value->display_icon==1&&$_smarty_tpl->tpl_vars['menu']->value->icon!=''){?> <span class="icon_menu" >
			<img  src="<?php echo $_smarty_tpl->tpl_vars['path_icon']->value;?>
<?php echo $_smarty_tpl->tpl_vars['menu']->value->icon;?>
" alt="" /></span><?php }?>
			<?php echo $_smarty_tpl->tpl_vars['menu']->value->title[(int)$_smarty_tpl->tpl_vars['cookie']->value->id_lang];?>
</a>
			<?php if ($_smarty_tpl->tpl_vars['menu']->value->options&&count($_smarty_tpl->tpl_vars['menu']->value->options)>0){?>
			<div class="options_list" style="width : <?php echo $_smarty_tpl->tpl_vars['menu']->value->width;?>
px;">
				<?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value->options; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['options']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['options']['index']++;
?>
				<div class="option<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['options']['index']%$_smarty_tpl->tpl_vars['menu']->value->number_column==0){?> clear<?php }?>" style="width : <?php echo $_smarty_tpl->tpl_vars['option']->value['width'];?>
px; float:left">
				 <?php if ($_smarty_tpl->tpl_vars['option']->value['type_option']==0){?> <!--case category-->
				 <?php if (isset($_smarty_tpl->tpl_vars['option']->value['category_parent'])){?>
						<?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable((((($_smarty_tpl->tpl_vars['ps_cat_img_dir']->value).($_smarty_tpl->tpl_vars['option']->value['category_parent']->id_category)).('-')).($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_image_size_cate)).('.jpg'), null, 0);?>
						<?php if ($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_image_cat==1&&file_exists($_smarty_tpl->tpl_vars['image']->value)){?>
						<div class="image_cat_parent">
							<a class="cat_parent" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_smarty_tpl->tpl_vars['option']->value['category_parent']->id_category,$_smarty_tpl->tpl_vars['option']->value['category_parent']->link_rewrite), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
								<img class="img_parent" src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getCatImageLink($_smarty_tpl->tpl_vars['option']->value['category_parent']->link_rewrite,$_smarty_tpl->tpl_vars['option']->value['category_parent']->id_image,$_smarty_tpl->tpl_vars['option']->value['content_option']->opt_image_size_cate);?>
" alt=""/>
							</a>
						</div>
						<?php }?>
						
						<?php if ($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_parent_cat==1){?>
							<div class="out_cat_parent">
							<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_smarty_tpl->tpl_vars['option']->value['category_parent']->id_category,$_smarty_tpl->tpl_vars['option']->value['category_parent']->link_rewrite), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
							<?php echo $_smarty_tpl->tpl_vars['option']->value['category_parent']->name;?>
</a>
							</div>
						<?php }?>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['option']->value['sub_category'])&&$_smarty_tpl->tpl_vars['option']->value['sub_category']){?>
						<?php $_smarty_tpl->tpl_vars["sub_categories"] = new Smarty_variable($_smarty_tpl->tpl_vars['option']->value['sub_category']['children'], null, 0);?>
							<?php $_smarty_tpl->tpl_vars["ul"] = new Smarty_variable(0, null, 0);?>
							<?php while ($_smarty_tpl->tpl_vars['ul']->value<count($_smarty_tpl->tpl_vars['sub_categories']->value)){?>
							<ul class="level_0" style="width : <?php echo $_smarty_tpl->tpl_vars['menu']->value->width_item;?>
px;">
							<?php $_smarty_tpl->tpl_vars["temp"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['sub_categories']->value)/ceil($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_fill_column), null, 0);?>
							<?php $_smarty_tpl->tpl_vars["li"] = new Smarty_variable($_smarty_tpl->tpl_vars['ul']->value+$_smarty_tpl->tpl_vars['temp']->value, null, 0);?>
							<?php while ($_smarty_tpl->tpl_vars['ul']->value<$_smarty_tpl->tpl_vars['li']->value){?>
								<?php if (isset($_smarty_tpl->tpl_vars['sub_categories']->value[$_smarty_tpl->tpl_vars['ul']->value])){?>
									<?php $_smarty_tpl->tpl_vars["category"] = new Smarty_variable($_smarty_tpl->tpl_vars['sub_categories']->value[$_smarty_tpl->tpl_vars['ul']->value], null, 0);?>
									<li class="category_item<?php if (isset($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_sub_cat)&&$_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_sub_cat==1&&$_smarty_tpl->tpl_vars['category']->value['children']){?> parent<?php }?>">
										<a class="cat_child" href="<?php echo $_smarty_tpl->tpl_vars['category']->value['link'];?>
">
										<?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable((((($_smarty_tpl->tpl_vars['ps_cat_img_dir']->value).($_smarty_tpl->tpl_vars['category']->value['id'])).('-')).($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_image_size_cate)).('.jpg'), null, 0);?>
										<?php if ($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_image_sub_cat==1&&file_exists($_smarty_tpl->tpl_vars['image']->value)){?>
										<img class="img_child" src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getCatImageLink($_smarty_tpl->tpl_vars['category']->value['name'],$_smarty_tpl->tpl_vars['category']->value['id'],$_smarty_tpl->tpl_vars['option']->value['content_option']->opt_image_size_cate);?>
" alt=""/>
										<?php }?>
										<?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</a>
										<?php if (isset($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_sub_cat)&&$_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_sub_cat==1){?>
											<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['menu']->value->width_item;?>
<?php $_tmp1=ob_get_clean();?><?php Smarty_Internal_Function_Call_Handler::call ('menu',$_smarty_tpl,array('data'=>$_smarty_tpl->tpl_vars['category']->value['children'],'show_image'=>$_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_image_sub_cat,'image_size'=>$_smarty_tpl->tpl_vars['option']->value['content_option']->opt_image_size_cate,'width'=>$_tmp1),'62518239353a1da3495aa98_47726486',false);?>

										<?php }?>
									</li>
								<?php }?>	
								<?php echo smarty_function_math(array('equation'=>"nbLi + nb",'nbLi'=>$_smarty_tpl->tpl_vars['ul']->value,'nb'=>1,'assign'=>'ul'),$_smarty_tpl);?>

							<?php }?>
							</ul>
							<?php }?>
					<?php }?>
				 <?php }?>
				 <?php if ($_smarty_tpl->tpl_vars['option']->value['type_option']==1){?> <!--case product-->
					<?php $_smarty_tpl->tpl_vars["ul"] = new Smarty_variable(0, null, 0);?>
					<?php if (isset($_smarty_tpl->tpl_vars['option']->value['product_list'])&&$_smarty_tpl->tpl_vars['option']->value['product_list']){?>
					<?php while ($_smarty_tpl->tpl_vars['ul']->value<count($_smarty_tpl->tpl_vars['option']->value['product_list'])){?>
						<ul class="column product " style="width : <?php echo $_smarty_tpl->tpl_vars['menu']->value->width_item;?>
px;">
						<?php $_smarty_tpl->tpl_vars["temp"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['option']->value['product_list'])/ceil($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_fill_column), null, 0);?>
						<?php $_smarty_tpl->tpl_vars["li"] = new Smarty_variable($_smarty_tpl->tpl_vars['ul']->value+$_smarty_tpl->tpl_vars['temp']->value, null, 0);?>
							<?php while ($_smarty_tpl->tpl_vars['ul']->value<$_smarty_tpl->tpl_vars['li']->value){?>
								<?php if (isset($_smarty_tpl->tpl_vars['option']->value['product_list'][$_smarty_tpl->tpl_vars['ul']->value])){?>
									<?php $_smarty_tpl->tpl_vars["product"] = new Smarty_variable($_smarty_tpl->tpl_vars['option']->value['product_list'][$_smarty_tpl->tpl_vars['ul']->value], null, 0);?>
									<li class="ajax_block_product">
									<div class="center_block">
										<?php if ($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_image_product==1){?> 											
											<div class="image"><a class="product_image_menu" title="" href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
">
											<img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],$_smarty_tpl->tpl_vars['option']->value['content_option']->opt_image_size_product);?>
" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
											</a></div>
										<?php }?>
										<div class="name_product">
										<h3><a alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="" href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a></h3></div>
										
										<?php if ($_smarty_tpl->tpl_vars['product']->value['show_price']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?><p class="price_container"><span class="price"><?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value){?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);?>
<?php }else{ ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?></span></p><?php }else{ ?><div style="height:21px;"></div><?php }?>

									</div>
									</li>
								<?php }?>	
								<?php echo smarty_function_math(array('equation'=>"nbLi + nb",'nbLi'=>$_smarty_tpl->tpl_vars['ul']->value,'nb'=>1,'assign'=>'ul'),$_smarty_tpl);?>

								
							<?php }?>
						</ul>
						<span class="spanColumn" style="width : <?php echo $_smarty_tpl->tpl_vars['menu']->value->width_item;?>
px;" ></span>
						<?php }?>
						<?php }?>
				 <?php }?>
					 <?php if ($_smarty_tpl->tpl_vars['option']->value['type_option']==2){?> <!--static block-->
					 <?php $_smarty_tpl->tpl_vars['lang'] = new Smarty_variable($_smarty_tpl->tpl_vars['cookie']->value->id_lang, null, 0);?>
					 <?php if (isset($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_content_static->{$_smarty_tpl->tpl_vars['lang']->value})&&$_smarty_tpl->tpl_vars['option']->value['content_option']->opt_content_static->{$_smarty_tpl->tpl_vars['lang']->value}){?>
					 <div class="div_static">
						<?php echo $_smarty_tpl->tpl_vars['option']->value['content_option']->opt_content_static->{$_smarty_tpl->tpl_vars['lang']->value};?>

					 </div>
					 <?php }?>
					 <?php }?>
				 <?php if ($_smarty_tpl->tpl_vars['option']->value['type_option']==3){?> <!--manufacture-->
				 <?php if (isset($_smarty_tpl->tpl_vars['option']->value['opt_list_manu_info'])){?>
					<?php $_smarty_tpl->tpl_vars["ul"] = new Smarty_variable(0, null, 0);?>
					<?php while ($_smarty_tpl->tpl_vars['ul']->value<count($_smarty_tpl->tpl_vars['option']->value['opt_list_manu_info'])){?>
						<ul class="column manufacture" style="width : <?php echo $_smarty_tpl->tpl_vars['menu']->value->width_item;?>
px;">
						<?php $_smarty_tpl->tpl_vars["temp"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['option']->value['opt_list_manu_info'])/ceil($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_fill_column), null, 0);?>
						<?php $_smarty_tpl->tpl_vars["li"] = new Smarty_variable($_smarty_tpl->tpl_vars['ul']->value+$_smarty_tpl->tpl_vars['temp']->value, null, 0);?>
							<?php while ($_smarty_tpl->tpl_vars['ul']->value<$_smarty_tpl->tpl_vars['li']->value){?>
								<?php if (isset($_smarty_tpl->tpl_vars['option']->value['opt_list_manu_info'][$_smarty_tpl->tpl_vars['ul']->value])){?>
									<?php $_smarty_tpl->tpl_vars["manufac"] = new Smarty_variable($_smarty_tpl->tpl_vars['option']->value['opt_list_manu_info'][$_smarty_tpl->tpl_vars['ul']->value], null, 0);?>
									<li class="product_item">
									<?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable((((($_smarty_tpl->tpl_vars['ps_manu_img_dir']->value).($_smarty_tpl->tpl_vars['manufac']->value->id_manufacturer)).('-')).($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_image_size_manu)).('.jpg'), null, 0);?>
									
										<?php if ($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_image_manu==1&&file_exists($_smarty_tpl->tpl_vars['image']->value)){?>
											<a class="img_manu" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufac']->value->id_manufacturer,$_smarty_tpl->tpl_vars['manufac']->value->link_rewrite);?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['manufac']->value->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
											<img src="<?php echo $_smarty_tpl->tpl_vars['img_manu_dir']->value;?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['manufac']->value->id_manufacturer, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
-<?php echo $_smarty_tpl->tpl_vars['option']->value['content_option']->opt_image_size_manu;?>
.jpg" alt=""/></a>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_show_name_manu==1){?>
										<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufac']->value->id_manufacturer,$_smarty_tpl->tpl_vars['manufac']->value->link_rewrite);?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['manufac']->value->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'),25,'...');?>
</a>
										<?php }?>
									</li>
								<?php }?>	
								<?php echo smarty_function_math(array('equation'=>"nbLi + nb",'nbLi'=>$_smarty_tpl->tpl_vars['ul']->value,'nb'=>1,'assign'=>'ul'),$_smarty_tpl);?>

							<?php }?>
						</ul>
						<span class="spanColumn" style="width : <?php echo $_smarty_tpl->tpl_vars['menu']->value->width_item;?>
px;" ></span>
						<?php }?>
					<?php }?>
				 <?php }?>
				 <?php if ($_smarty_tpl->tpl_vars['option']->value['type_option']==4){?> <!--cms-->
					<?php $_smarty_tpl->tpl_vars["ul"] = new Smarty_variable(0, null, 0);?>
					<?php if (isset($_smarty_tpl->tpl_vars['option']->value['cms'])&&$_smarty_tpl->tpl_vars['option']->value['cms']){?>
					<?php while ($_smarty_tpl->tpl_vars['ul']->value<count($_smarty_tpl->tpl_vars['option']->value['cms'])){?>
						<ul class="column cms" style="width : <?php echo $_smarty_tpl->tpl_vars['menu']->value->width_item;?>
px;">
						<?php $_smarty_tpl->tpl_vars["temp"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['option']->value['cms'])/ceil($_smarty_tpl->tpl_vars['option']->value['content_option']->opt_fill_column), null, 0);?>
						<?php $_smarty_tpl->tpl_vars["li"] = new Smarty_variable($_smarty_tpl->tpl_vars['ul']->value+$_smarty_tpl->tpl_vars['temp']->value, null, 0);?>
							<?php while ($_smarty_tpl->tpl_vars['ul']->value<$_smarty_tpl->tpl_vars['li']->value){?>
								<?php if (isset($_smarty_tpl->tpl_vars['option']->value['cms'][$_smarty_tpl->tpl_vars['ul']->value])){?>
									<?php $_smarty_tpl->tpl_vars["cms"] = new Smarty_variable($_smarty_tpl->tpl_vars['option']->value['cms'][$_smarty_tpl->tpl_vars['ul']->value], null, 0);?>
									<li class="cms_item">
										<a href="<?php echo addslashes($_smarty_tpl->tpl_vars['cms']->value['link']);?>
"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['cms']->value['meta_title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a>
									</li>
								<?php }?>	
								<?php echo smarty_function_math(array('equation'=>"nbLi + nb",'nbLi'=>$_smarty_tpl->tpl_vars['ul']->value,'nb'=>1,'assign'=>'ul'),$_smarty_tpl);?>

							<?php }?>
						</ul>
						<span class="spanColumn" style="width : <?php echo $_smarty_tpl->tpl_vars['menu']->value->width_item;?>
px;" ></span>
						<?php }?>
					<?php }?>
				 <?php }?>
				</div>
				<span class="spanOption" style="width : <?php echo $_smarty_tpl->tpl_vars['option']->value['width'];?>
px" ></span>
				<?php } ?>
			</div>
			<span class="spanOptionList" style="width : <?php echo $_smarty_tpl->tpl_vars['menu']->value->width;?>
px;" ></span>
			<?php }?>
		</li>
	<?php } ?>
	</ul>
	</div>
	</div>
	</div>

<!-- /Block mega menu module -->
<?php }?><?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2014-07-09 01:10:55
         compiled from "/home/pekesmx/www/prestashop/themes/electronues/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:43811777553a1da36b0a595-64162365%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a93696b516e13b0fde6dc02d489d6b5f0d3d613' => 
    array (
      0 => '/home/pekesmx/www/prestashop/themes/electronues/header.tpl',
      1 => 1404886249,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '43811777553a1da36b0a595-64162365',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da36d45823_31444981',
  'variables' => 
  array (
    'lang_iso' => 0,
    'meta_title' => 0,
    'meta_description' => 0,
    'meta_keywords' => 0,
    'meta_language' => 0,
    'nobots' => 0,
    'nofollow' => 0,
    'favicon_url' => 0,
    'img_update_time' => 0,
    'css_files' => 0,
    'css_uri' => 0,
    'media' => 0,
    'content_dir' => 0,
    'base_uri' => 0,
    'static_token' => 0,
    'token' => 0,
    'priceDisplayPrecision' => 0,
    'currency' => 0,
    'priceDisplay' => 0,
    'roundMode' => 0,
    'css_dir' => 0,
    'HOOK_HEADER' => 0,
    'page_name' => 0,
    'hide_left_column' => 0,
    'hide_right_column' => 0,
    'content_only' => 0,
    'restricted_country_mode' => 0,
    'geolocation_country' => 0,
    'base_dir' => 0,
    'shop_name' => 0,
    'logo_url' => 0,
    'HOOK_CS_TOP_TOP' => 0,
    'img_dir' => 0,
    'CS_MEGA_MENU' => 0,
    'HOOK_TOP' => 0,
    'grid_column' => 0,
    'left_column_size' => 0,
    'CS_BLOG_HOOK_LEFT_COLUMN' => 0,
    'HOOK_LEFT_COLUMN' => 0,
    'isMobile' => 0,
    'HOOK_CS_SLIDESHOW' => 0,
    'LEFT_HOME_COLUMN' => 0,
    'center_class' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da36d45823_31444981')) {function content_53a1da36d45823_31444981($_smarty_tpl) {?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 " lang="<?php echo $_smarty_tpl->tpl_vars['lang_iso']->value;?>
"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie7" lang="<?php echo $_smarty_tpl->tpl_vars['lang_iso']->value;?>
"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8" lang="<?php echo $_smarty_tpl->tpl_vars['lang_iso']->value;?>
"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js ie9" lang="<?php echo $_smarty_tpl->tpl_vars['lang_iso']->value;?>
"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->tpl_vars['lang_iso']->value;?>
">
	<head>
		<title><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</title>
<?php if (isset($_smarty_tpl->tpl_vars['meta_description']->value)&&$_smarty_tpl->tpl_vars['meta_description']->value){?>
		<meta name="description" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['meta_keywords']->value)&&$_smarty_tpl->tpl_vars['meta_keywords']->value){?>
		<meta name="keywords" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_keywords']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
<?php }?>
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta http-equiv="content-language" content="<?php echo $_smarty_tpl->tpl_vars['meta_language']->value;?>
" />
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="<?php if (isset($_smarty_tpl->tpl_vars['nobots']->value)){?>no<?php }?>index,<?php if (isset($_smarty_tpl->tpl_vars['nofollow']->value)&&$_smarty_tpl->tpl_vars['nofollow']->value){?>no<?php }?>follow" />
		<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>
				
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'/>
		
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $_smarty_tpl->tpl_vars['favicon_url']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['img_update_time']->value;?>
" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['favicon_url']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['img_update_time']->value;?>
" />
		
<?php if (isset($_smarty_tpl->tpl_vars['css_files']->value)){?>
	<?php  $_smarty_tpl->tpl_vars['media'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['media']->_loop = false;
 $_smarty_tpl->tpl_vars['css_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['css_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['media']->key => $_smarty_tpl->tpl_vars['media']->value){
$_smarty_tpl->tpl_vars['media']->_loop = true;
 $_smarty_tpl->tpl_vars['css_uri']->value = $_smarty_tpl->tpl_vars['media']->key;
?>
	<link href="<?php echo $_smarty_tpl->tpl_vars['css_uri']->value;?>
" rel="stylesheet" type="text/css" media="<?php echo $_smarty_tpl->tpl_vars['media']->value;?>
" />
	<?php } ?>	
<?php }?>
	
	<script type="text/javascript">
			var baseDir = '<?php echo addslashes($_smarty_tpl->tpl_vars['content_dir']->value);?>
';
			var baseUri = '<?php echo addslashes($_smarty_tpl->tpl_vars['base_uri']->value);?>
';
			var static_token = '<?php echo addslashes($_smarty_tpl->tpl_vars['static_token']->value);?>
';
			var token = '<?php echo addslashes($_smarty_tpl->tpl_vars['token']->value);?>
';
			var priceDisplayPrecision = <?php echo $_smarty_tpl->tpl_vars['priceDisplayPrecision']->value*$_smarty_tpl->tpl_vars['currency']->value->decimals;?>
;
			var priceDisplayMethod = <?php echo $_smarty_tpl->tpl_vars['priceDisplay']->value;?>
;
			var roundMode = <?php echo $_smarty_tpl->tpl_vars['roundMode']->value;?>
;
			var text_list_grid='<?php echo smartyTranslate(array('s'=>"view as"),$_smarty_tpl);?>
';
			var quickViewText = '<?php echo smartyTranslate(array('s'=>"Quick View"),$_smarty_tpl);?>
';
			//add class to fix ie10
			if (/*@cc_on!@*/false) {  
				document.documentElement.className+=' ie10';  
			}  
	</script>
<!--[if IE 7]><link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
global-ie.css" rel="stylesheet" type="text/css" media="<?php echo $_smarty_tpl->tpl_vars['media']->value;?>
" /><![endif]-->
<!--[if IE 8]><link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
cshometab1-ie8.css" rel="stylesheet" type="text/css" media="<?php echo $_smarty_tpl->tpl_vars['media']->value;?>
" /><![endif]-->

		<?php echo $_smarty_tpl->tpl_vars['HOOK_HEADER']->value;?>

	</head>
	
	<body <?php if (isset($_smarty_tpl->tpl_vars['page_name']->value)){?>id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['page_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"<?php }?> class="<?php if ($_smarty_tpl->tpl_vars['hide_left_column']->value){?>hide-left-column<?php }?> <?php if ($_smarty_tpl->tpl_vars['hide_right_column']->value){?>hide-right-column<?php }?> <?php if ($_smarty_tpl->tpl_vars['content_only']->value){?> content_only <?php }?>">
	<?php if (!$_smarty_tpl->tpl_vars['content_only']->value){?>
		<?php if (isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&$_smarty_tpl->tpl_vars['restricted_country_mode']->value){?>
		<div id="restricted-country">
			<p><?php echo smartyTranslate(array('s'=>'You cannot place a new order from your country.'),$_smarty_tpl);?>
 <span class="bold"><?php echo $_smarty_tpl->tpl_vars['geolocation_country']->value;?>
</span></p>
		</div>
		<?php }?>
		<div id="page" class="parallax">			
			<div class="mode_header clearfix">				
				<div class="container_24">
					<div id="header" class="grid_24 clearfix">
						<div class="header_logo">
							<a id="header_logo" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['shop_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
								<img class="logo" src="<?php echo $_smarty_tpl->tpl_vars['logo_url']->value;?>
" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['shop_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
							</a>
						</div>
						<div class="header_right">
							<?php if (isset($_smarty_tpl->tpl_vars['HOOK_CS_TOP_TOP']->value)&&$_smarty_tpl->tpl_vars['HOOK_CS_TOP_TOP']->value){?><?php echo $_smarty_tpl->tpl_vars['HOOK_CS_TOP_TOP']->value;?>
<?php }?>
							<div class='social-media-icons'>
								<ul class="solial-media-list">
									<li>
									
								<img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
img/sm/facebook.png" />		
									</li>
									<li>
											<a href="https://twitter.com/pekesmx"><img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
img/sm/twitter.png" /></a>
	
									</li>
									<li>
										<img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
img/sm/ytube.png" />
							
									</li>
								</ul>	
							</div>
						</div>

						<div class="envios-wrap hidden-xs">
							<div class="envios-centered">
							<ul class="envios-ul">

								<a href="http://pekes.mx/content/1-entrega">

								<li>
									<h4>
										Entrega	
									</h4>
									<h4>
										2 a 5 días
									</h4>
									


<img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
img/header-img/tiempo.png" /></a>
								</li>
		
								<a href="http://pekes.mx/content/5-pago-seguro">
								<li>
									<h4>
										Aceptamos	
									</h4>
									<h4>
										Tarjetas
									</h4>
									<img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
img/header-img/tarjetas.png" />
								</li>
								</a>
								<a href="http://pekes.mx/content/5-pago-seguro">
								<li>
									<h4>
										Compra
									</h4>
									<h4>
										Segura
									</h4>
									<img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
img/header-img/seguridad.png" />
								</li>
								</a>
								<a href="http://pekes.mx/content/1-entrega">
								<li>
									<h4>
										Envío
									</h4>
									<h4>
										Nacional
									</h4>
									<img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
img/header-img/envios.png" />
								</li>
								</a>
								<a href="http://pekes.mx/content/4-sobre">
								<li>
									<h4>
										Atención	
									</h4>
									<h4>
										a Clientes
									</h4>
									<img style="max-width: 18px;" src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
/serviciocliente3.png" />

								</li>
								</a>

							</ul>
							</div>
						</div>

					
					
						
					
					

					</div>
					<div class="grid_24 header_content_menu clearfix">
							<?php if (isset($_smarty_tpl->tpl_vars['CS_MEGA_MENU']->value)&&$_smarty_tpl->tpl_vars['CS_MEGA_MENU']->value){?>
								<?php echo $_smarty_tpl->tpl_vars['CS_MEGA_MENU']->value;?>

							<?php }?>
							<?php echo $_smarty_tpl->tpl_vars['HOOK_TOP']->value;?>
							
					</div>
				</div>				
			</div>
			
			<div class="mode_container clearfix" data-animate="fadeInDown" data-delay="0">
				<div class="container_24">
				<div class="grid_24">
				<?php if ($_smarty_tpl->tpl_vars['page_name']->value!='index'&&$_smarty_tpl->tpl_vars['page_name']->value!='pagenotfound'){?>
					<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				<?php }?>
				
				<div id="columns" class="<?php if (isset($_smarty_tpl->tpl_vars['grid_column']->value)){?><?php echo $_smarty_tpl->tpl_vars['grid_column']->value;?>
<?php }?>">				
				<?php if ($_smarty_tpl->tpl_vars['page_name']->value!='index'){?>
						<?php if (isset($_smarty_tpl->tpl_vars['left_column_size']->value)&&!empty($_smarty_tpl->tpl_vars['left_column_size']->value)){?>
							<!-- Left -->
							<div id="left_column" class="grid_<?php echo intval($_smarty_tpl->tpl_vars['left_column_size']->value);?>
 alpha">
								<div class="left_content">			
									<?php if ($_smarty_tpl->tpl_vars['page_name']->value=="module-csblog-listpost"||$_smarty_tpl->tpl_vars['page_name']->value=="module-csblog-detailpost"||$_smarty_tpl->tpl_vars['page_name']->value=="module-csblog-listposttag"){?>
										<?php if (isset($_smarty_tpl->tpl_vars['CS_BLOG_HOOK_LEFT_COLUMN']->value)){?><?php echo $_smarty_tpl->tpl_vars['CS_BLOG_HOOK_LEFT_COLUMN']->value;?>
<?php }?>
									<?php }else{ ?>
										<?php echo $_smarty_tpl->tpl_vars['HOOK_LEFT_COLUMN']->value;?>

									<?php }?>
								</div>
							</div>
						<?php }?>
				<?php }else{ ?><!-- Left homepage -->
					<?php if ($_smarty_tpl->tpl_vars['isMobile']->value==1){?>
						<?php if (isset($_smarty_tpl->tpl_vars['HOOK_CS_SLIDESHOW']->value)){?>
						<div class="mode_slideshow">
								<?php echo $_smarty_tpl->tpl_vars['HOOK_CS_SLIDESHOW']->value;?>

						</div>
						<?php }?>
					<?php }?>
					<div id="left_column_home" class="grid_6 alpha">
						<div class="left_content">
							<?php if (isset($_smarty_tpl->tpl_vars['LEFT_HOME_COLUMN']->value)&&$_smarty_tpl->tpl_vars['LEFT_HOME_COLUMN']->value){?>
								<?php echo $_smarty_tpl->tpl_vars['LEFT_HOME_COLUMN']->value;?>

							<?php }?>
						</div>
					</div>
				<?php }?>

					<!-- Center -->
				<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index'){?>
					<div id="center_column" class="grid_18 omega">
						<?php if ($_smarty_tpl->tpl_vars['isMobile']->value!=1){?>
							<?php if (isset($_smarty_tpl->tpl_vars['HOOK_CS_SLIDESHOW']->value)){?>
							<div class="mode_slideshow">
									<?php echo $_smarty_tpl->tpl_vars['HOOK_CS_SLIDESHOW']->value;?>

							</div>
							<?php }?>
						<?php }?>
				<?php }else{ ?>
					<div id="center_column" class="<?php echo $_smarty_tpl->tpl_vars['center_class']->value;?>
">
				<?php }?>					
		<?php }?>
<?php }} ?>
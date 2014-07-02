{*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 " lang="{$lang_iso}"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie7" lang="{$lang_iso}"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8" lang="{$lang_iso}"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js ie9" lang="{$lang_iso}"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang_iso}">
	<head>
		<title>{$meta_title|escape:'htmlall':'UTF-8'}</title>
{if isset($meta_description) AND $meta_description}
		<meta name="description" content="{$meta_description|escape:html:'UTF-8'}" />
{/if}
{if isset($meta_keywords) AND $meta_keywords}
		<meta name="keywords" content="{$meta_keywords|escape:html:'UTF-8'}" />
{/if}
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta http-equiv="content-language" content="{$meta_language}" />
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="{if isset($nobots)}no{/if}index,{if isset($nofollow) && $nofollow}no{/if}follow" />
		<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>
				
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'/>
		
		<link rel="icon" type="image/vnd.microsoft.icon" href="{$favicon_url}?{$img_update_time}" />
		<link rel="shortcut icon" type="image/x-icon" href="{$favicon_url}?{$img_update_time}" />
		
{if isset($css_files)}
	{foreach from=$css_files key=css_uri item=media}
	<link href="{$css_uri}" rel="stylesheet" type="text/css" media="{$media}" />
	{/foreach}	
{/if}
	
	<script type="text/javascript">
			var baseDir = '{$content_dir|addslashes}';
			var baseUri = '{$base_uri|addslashes}';
			var static_token = '{$static_token|addslashes}';
			var token = '{$token|addslashes}';
			var priceDisplayPrecision = {$priceDisplayPrecision*$currency->decimals};
			var priceDisplayMethod = {$priceDisplay};
			var roundMode = {$roundMode};
			var text_list_grid='{l s="view as"}';
			var quickViewText = '{l s="Quick View"}';
			//add class to fix ie10
			if (/*@cc_on!@*/false) {  
				document.documentElement.className+=' ie10';  
			}  
	</script>
<!--[if IE 7]><link href="{$css_dir}global-ie.css" rel="stylesheet" type="text/css" media="{$media}" /><![endif]-->
<!--[if IE 8]><link href="{$css_dir}cshometab1-ie8.css" rel="stylesheet" type="text/css" media="{$media}" /><![endif]-->

		{$HOOK_HEADER}
	</head>
	
	<body {if isset($page_name)}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if} class="{if $hide_left_column}hide-left-column{/if} {if $hide_right_column}hide-right-column{/if} {if $content_only} content_only {/if}">
	{if !$content_only}
		{if isset($restricted_country_mode) && $restricted_country_mode}
		<div id="restricted-country">
			<p>{l s='You cannot place a new order from your country.'} <span class="bold">{$geolocation_country}</span></p>
		</div>
		{/if}
		<div id="page" class="parallax">			
			<div class="mode_header clearfix">				
				<div class="container_24">
					<div id="header" class="grid_24 clearfix">
						<div class="header_logo">
							<a id="header_logo" href="{$base_dir}" title="{$shop_name|escape:'htmlall':'UTF-8'}">
								<img class="logo" src="{$logo_url}" alt="{$shop_name|escape:'htmlall':'UTF-8'}" />
							</a>
						</div>
						<div class="header_right">
							{if isset($HOOK_CS_TOP_TOP) && $HOOK_CS_TOP_TOP}{$HOOK_CS_TOP_TOP}{/if}
							<div class='social-media-icons'>
								<ul class="solial-media-list">
									<li>
								<img src="{$img_dir}img/sm/facebook.png" />		
									</li>
									<li>
											<img src="{$img_dir}img/sm/twitter.png" />
	
									</li>
									<li>
										<img src="{$img_dir}img/sm/ytube.png" />
							
									</li>
								</ul>	
							</div>
						</div>

					
					
						<div class="envios-wrap">
							<div class="envios-centered">
							<ul class="envios-ul">
								<li>
									<h4>
										Entrega	
									</h4>
									<h4>
										2 a 5 días
									</h4>
									


									<img src="{$img_dir}img/header-img/tiempo.png" />	
								</li>
								<li>
									<h4>
										Aceptamos	
									</h4>
									<h4>
										Tarjetas
									</h4>
									<img src="{$img_dir}img/header-img/tarjetas.png" />
								</li>
								<li>
									<h4>
										Compra
									</h4>
									<h4>
										Segura
									</h4>
									<img src="{$img_dir}img/header-img/seguridad.png" />
								</li>
								<li>
									<h4>
										Envío
									</h4>
									<h4>
										Nacional
									</h4>
									<img src="{$img_dir}img/header-img/envios.png" />
								</li>
								<li>
									<h4>
										Atención	
									</h4>
									<h4>
										a Clientes
									</h4>
									<img src="{$img_dir}img/header-img/servicioclientes.png" />
								</li>

							</ul>
							</div>
						</div>
					
					

					</div>
					<div class="grid_24 header_content_menu clearfix">
							{if isset($CS_MEGA_MENU) && $CS_MEGA_MENU}
								{$CS_MEGA_MENU}
							{/if}
							{$HOOK_TOP}							
					</div>
				</div>				
			</div>
			
			<div class="mode_container clearfix" data-animate="fadeInDown" data-delay="0">
				<div class="container_24">
				<div class="grid_24">
				{if $page_name !='index' && $page_name !='pagenotfound'}
					{include file="$tpl_dir./breadcrumb.tpl"}
				{/if}
				
				<div id="columns" class="{if isset($grid_column)}{$grid_column}{/if}">				
				{if $page_name != 'index'}
						{if isset($left_column_size) && !empty($left_column_size)}
							<!-- Left -->
							<div id="left_column" class="grid_{$left_column_size|intval} alpha">
								<div class="left_content">			
									{if $page_name == "module-csblog-listpost" || $page_name == "module-csblog-detailpost" || $page_name == "module-csblog-listposttag"}
										{if isset($CS_BLOG_HOOK_LEFT_COLUMN)}{$CS_BLOG_HOOK_LEFT_COLUMN}{/if}
									{else}
										{$HOOK_LEFT_COLUMN}
									{/if}
								</div>
							</div>
						{/if}
				{else}<!-- Left homepage -->
					{if $isMobile==1}
						{if isset($HOOK_CS_SLIDESHOW)}
						<div class="mode_slideshow">
								{$HOOK_CS_SLIDESHOW}
						</div>
						{/if}
					{/if}
					<div id="left_column_home" class="grid_6 alpha">
						<div class="left_content">
							{if isset($LEFT_HOME_COLUMN) && $LEFT_HOME_COLUMN}
								{$LEFT_HOME_COLUMN}
							{/if}
						</div>
					</div>
				{/if}

					<!-- Center -->
				{if $page_name == 'index'}
					<div id="center_column" class="grid_18 omega">
						{if $isMobile!=1}
							{if isset($HOOK_CS_SLIDESHOW)}
							<div class="mode_slideshow">
									{$HOOK_CS_SLIDESHOW}
							</div>
							{/if}
						{/if}
				{else}
					<div id="center_column" class="{$center_class}">
				{/if}					
		{/if}

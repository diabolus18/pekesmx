<?php /*%%SmartyHeaderCode:138521601353a1da35472d60-90014753%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5a89a5915bf1df9523bc7f81d34dc299295d6c4' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csslider/csslider.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138521601353a1da35472d60-90014753',
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53ad26fe3e4a45_56140482',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ad26fe3e4a45_56140482')) {function content_53ad26fe3e4a45_56140482($_smarty_tpl) {?><!-- CS Slider module -->
<script type="text/javascript">
				var api;
			jQuery(document).ready(function() {
			api =  jQuery(".banner").revolution(
				{
					delay:5000,
					startheight:386,
					startwidth:880,

					hideThumbs:10,

					thumbWidth:100,		// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
					thumbHeight:100,
					thumbAmount:2,

					navigationType:"none",		// bullet, thumb, none - trong
					navigationArrows:"solo",	// nexttobullets, solo (old name verticalcentered), none - mui ten

					navigationStyle:"round",				//round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom - hinh cua icon tron
					navigationHAlign:"left",				// Vertical Align top,center,bottom
					navigationVAlign:"bottom",					// Horizontal Align left,center,right
					navigationHOffset:0,
					navigationVOffset:0,

					soloArrowLeftHalign:"left",
					soloArrowLeftValign:"bottom",
					soloArrowLeftHOffset:5,
					soloArrowLeftVOffset:5,

					soloArrowRightHalign:"left",
					soloArrowRightValign:"bottom",
					soloArrowRightHOffset:27,
					soloArrowRightVOffset:5,

					touchenabled:"on",	// Enable Swipe Function : on/off
					onHoverStop:"on",	// Stop Banner Timet at Hover on Slide on/off

					stopAtSlide:-1,
					stopAfterLoops:-1,
					
					hideCaptionAtLimit:480,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
					hideAllCaptionAtLilmit:480,				// Hide all The Captions if Width of Browser is less then this value
					hideSliderAtLimit:0,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value

					
					shadow:0,								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
					fullWidth:"off"							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
						});
					});
			</script>
<div class="cs_revolution"> 
	<div class="bannercontainer responsive">
		<div class="banner">
		
			<ul>
																														<li data-transition="boxslide" data-masterspeed="300" data-slotamount="7" data-delay="9400"  data-thumb="/modules/csslider/images/thumbs/1_5.jpg" >
					 <a class="cs_slidelink" href="#" target="_self"></a> 
					<img src="/modules/csslider/images/1_5.jpg" />
										</li>
																														<li data-transition="boxslide" data-masterspeed="300" data-slotamount="7" data-delay="9400"  data-thumb="/modules/csslider/images/thumbs/1_6.jpg" >
					 <a class="cs_slidelink" href="#" target="_self"></a> 
					<img src="/modules/csslider/images/1_6.jpg" />
										</li>
																														<li data-transition="boxslide" data-masterspeed="300" data-slotamount="7" data-delay="9400"  data-thumb="/modules/csslider/images/thumbs/1_7.png" >
					 <a class="cs_slidelink" href="#" target="_self"></a> 
					<img src="/modules/csslider/images/1_7.png" />
										</li>
							</ul>
						<div class="tp-bannertimer"></div> 
					</div>
	</div>
</div>
<?php }} ?>
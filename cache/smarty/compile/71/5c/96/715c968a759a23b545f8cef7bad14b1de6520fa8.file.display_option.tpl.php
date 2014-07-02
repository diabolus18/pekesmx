<?php /* Smarty version Smarty-3.1.14, created on 2014-06-27 02:54:58
         compiled from "/home/pekesmx/www/prestashop/modules/csslider/views/templates/admin/display_option.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172336782853ad235211d162-83759986%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '715c968a759a23b545f8cef7bad14b1de6520fa8' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csslider/views/templates/admin/display_option.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172336782853ad235211d162-83759986',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'postAction' => 0,
    'option' => 0,
    'admin_img' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53ad23526abe38_99150806',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ad23526abe38_99150806')) {function content_53ad23526abe38_99150806($_smarty_tpl) {?>
<div class="panel clearfix">
<h3><i class="icon-cogs"></i> <?php echo smartyTranslate(array('s'=>'Setting Options','mod'=>'csslider'),$_smarty_tpl);?>
</h3>
<div class="productTabs col-lg-2">
	<div class="list-group">				
		<a class="list-group-item active" id="general-option" href="javascript:void(0);"><?php echo smartyTranslate(array('s'=>'General','mod'=>'csslider'),$_smarty_tpl);?>
</a>
		<a class="list-group-item" id="navigation-option" href="javascript:void(0);"><?php echo smartyTranslate(array('s'=>'Navigation','mod'=>'csslider'),$_smarty_tpl);?>
</a>
		<a class="list-group-item" id="thumbnail-option" href="javascript:void(0);"><?php echo smartyTranslate(array('s'=>'Thumbnail','mod'=>'csslider'),$_smarty_tpl);?>
</a>
		<a class="list-group-item" id="mobilevisibility-option" href="javascript:void(0);"><?php echo smartyTranslate(array('s'=>'Mobile visibility','mod'=>'csslider'),$_smarty_tpl);?>
</a>
	</div>
</div>
<form method="post" action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" enctype="multipart/form-data" class="form-horizontal col-lg-10 panel">
	<fieldset class="general-option tab-manager plblogtabs">
		<div class="form-group ">
			<label class="control-label col-lg-3 "><?php echo smartyTranslate(array('s'=>'Delay:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="delay" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->delay){?><?php echo $_smarty_tpl->tpl_vars['option']->value->delay;?>
<?php }else{ ?>9000<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'The time one slide stays on the screen in Milliseconds','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3 "><?php echo smartyTranslate(array('s'=>'Startheight:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="startheight" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->startheight){?><?php echo $_smarty_tpl->tpl_vars['option']->value->startheight;?>
<?php }else{ ?>500<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Basic Height of the Slider in the desktop resolution in pixel, other screen sizes will be calculated from this','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3 "><?php echo smartyTranslate(array('s'=>'Startwidth:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="startwidth" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->startwidth){?><?php echo $_smarty_tpl->tpl_vars['option']->value->startwidth;?>
<?php }else{ ?>1180<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Basic Width of the Slider in the desktop resolution in pixel, other screen sizes will be calculated from this','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3 "><?php echo smartyTranslate(array('s'=>'Touchenabled:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="touchenabled" value="on" <?php if ($_smarty_tpl->tpl_vars['option']->value->touchenabled=="on"){?>checked="checked"<?php }?> />
				<label class="t"><img src="<?php echo $_smarty_tpl->tpl_vars['admin_img']->value;?>
enabled.gif" alt="Enabled" title="Enabled" /></label>
				<input type="radio" name="touchenabled" value="off" <?php if ($_smarty_tpl->tpl_vars['option']->value->touchenabled=="off"){?>checked="checked"<?php }?> />
				<label class="t"><img src="<?php echo $_smarty_tpl->tpl_vars['admin_img']->value;?>
disabled.gif" alt="Disabled" title="Disabled" /></label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Enable Swipe Function on touch devices','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'OnHoverStop:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="onhoverstop" value="on" <?php if ($_smarty_tpl->tpl_vars['option']->value->onhoverstop=="on"){?>checked="checked"<?php }?> />
				<label class="t"><img src="<?php echo $_smarty_tpl->tpl_vars['admin_img']->value;?>
enabled.gif" alt="Enabled" title="Enabled" /></label>
				<input type="radio" name="onhoverstop" value="off" <?php if ($_smarty_tpl->tpl_vars['option']->value->onhoverstop=="off"){?>checked="checked"<?php }?> />
				<label class="t"><img src="<?php echo $_smarty_tpl->tpl_vars['admin_img']->value;?>
disabled.gif" alt="Disabled" title="Disabled" /></label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Stop the Timer when hovering the slider','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'FullWidth:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="fullwidth" value="on" <?php if ($_smarty_tpl->tpl_vars['option']->value->fullwidth=="on"){?>checked="checked"<?php }?> />
				<label class="t"><img src="<?php echo $_smarty_tpl->tpl_vars['admin_img']->value;?>
enabled.gif" alt="Enabled" title="Enabled" /></label>
				<input type="radio" name="fullwidth" value="off" <?php if ($_smarty_tpl->tpl_vars['option']->value->fullwidth=="off"){?>checked="checked"<?php }?> />
				<label class="t"><img src="<?php echo $_smarty_tpl->tpl_vars['admin_img']->value;?>
disabled.gif" alt="Disabled" title="Disabled" /></label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Stop the Timer when hovering the slider','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Show timer line:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="timerline" value="true" <?php if ($_smarty_tpl->tpl_vars['option']->value->timerline!="false"){?>checked="checked"<?php }?> />
				<label class="t"><img src="<?php echo $_smarty_tpl->tpl_vars['admin_img']->value;?>
enabled.gif" alt="Enabled" title="Enabled" /></label>
				<input type="radio" name="timerline" value="false" <?php if ($_smarty_tpl->tpl_vars['option']->value->timerline=="false"){?>checked="checked"<?php }?> />
				<label class="t"><img src="<?php echo $_smarty_tpl->tpl_vars['admin_img']->value;?>
disabled.gif" alt="Disabled" title="Disabled" /></label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Display or not dislay timer liner.','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Timer line position:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="timerlineposition" value="top" <?php if ($_smarty_tpl->tpl_vars['option']->value->timerlineposition=="top"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'Top','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="timerlineposition" value="bottom" <?php if ($_smarty_tpl->tpl_vars['option']->value->timerlineposition=="bottom"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'Bottom','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Position timer liner.','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Shadow:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<select name="shadow">';
					<option value="0" <?php if ($_smarty_tpl->tpl_vars['option']->value->shadow==0){?>selected=selected"<?php }?>>0</option>';
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['option']->value->shadow==1){?>selected=selected"<?php }?>>1</option>';
					<option value="2" <?php if ($_smarty_tpl->tpl_vars['option']->value->shadow==2){?>selected=selected"<?php }?>>2</option>';
					<option value="3" <?php if ($_smarty_tpl->tpl_vars['option']->value->shadow==3){?>selected=selected"<?php }?>>3</option>';
				</select>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Basic Width of the Slider in the desktop resolution in pixel, other screen sizes will be calculated from this','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Stop at slide :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="stopatslide" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->stopatslide){?><?php echo $_smarty_tpl->tpl_vars['option']->value->stopatslide;?>
<?php }else{ ?>-1<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'-1 or 1 to 999. Stop at selected Slide Number. If set to -1 it will loop without stopping. Only available if stopAfterLoops is not equal -1 !','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Stop after loops :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="stopafterloops" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->stopafterloops){?><?php echo $_smarty_tpl->tpl_vars['option']->value->stopafterloops;?>
<?php }else{ ?>-1<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'-1 or 0 to 999. Stop at selected Slide Number (stopAtSlide) after slide looped "x" time, where x this Number. If set to -1 it will loop without stopping. Only available if stopAtSlide not equal -1 !','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
	</fieldset>
	<fieldset class="navigation-option tab-manager plblogtabs">
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Navigation Type:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="navigationtype" value="bullet" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationtype=="bullet"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'Bullet','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationtype" value="thumb" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationtype=="thumb"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'Thumb','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationtype" value="none" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationtype=="none"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'None','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>' Display type of the navigation bar','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Navigation Arrows:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="navigationarrow" value="nexttobullets" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationarrow=="nexttobullets"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'Next to Bullets','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationarrow" value="solo" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationarrow=="solo"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'Solo','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationarrow" value="none" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationarrow=="none"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'None','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Display position of the Navigation Arrows','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Navigation style:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="navigationstyle" value="round" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationstyle=="round"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'round','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationstyle" value="navbar" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationstyle=="navbar"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'navbar','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationstyle" value="round-old" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationstyle=="round-old"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'round-old','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationstyle" value="square-old" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationstyle=="square-old"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'square-old','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationstyle" value="navbar-old" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationstyle=="navbar-old"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'navbar-old','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Look of the navigation bullets','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Navigation Horizontal Align :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="navigationhalign" value="left" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationhalign=="left"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'left','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationhalign" value="center" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationhalign=="center"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'center','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationhalign" value="right" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationhalign=="right"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'right','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Horizontal Align of Bullets / Thumbnails','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Navigation Vertical Align :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="navigationvalign" value="top" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationvalign=="top"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'top','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationvalign" value="center" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationvalign=="center"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'center','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="navigationvalign" value="bottom" <?php if ($_smarty_tpl->tpl_vars['option']->value->navigationvalign=="bottom"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'bottom','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Vertical Align of Bullets / Thumbnails','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Navigation Horizontal Offset :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="navigationhoffset" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->navigationhoffset){?><?php echo $_smarty_tpl->tpl_vars['option']->value->navigationhoffset;?>
<?php }else{ ?>0<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'A value between -600 to 600 - Offset from current Horizontal position of Bullets / Thumbnails negative and positive direction','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Navigation Vertical Offset :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="navigationvoffset" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->navigationvoffset){?><?php echo $_smarty_tpl->tpl_vars['option']->value->navigationvoffset;?>
<?php }else{ ?>0<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'A value between -600 to 600 - Offset from current Vertical position of Bullets / Thumbnails negative and positive direction','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Solo Arrow Left Horizontal Align:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="soloarrowlefthalign" value="left" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowlefthalign=="left"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'left','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="soloarrowlefthalign" value="center" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowlefthalign=="center"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'center','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="soloarrowlefthalign" value="right" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowlefthalign=="right"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'right','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Horizontal Align of left Arrow (only if arrow is not next to bullets)','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">				
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Solo Arrow Left Vertical Align :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="soloarrowleftvalign" value="top" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowleftvalign=="top"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'top','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="soloarrowleftvalign" value="center" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowleftvalign=="center"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'center','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="soloarrowleftvalign" value="bottom" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowleftvalign=="bottom"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'bottom','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Vertical Align of left Arrow (only if arrow is not next to bullets)','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Solo Arrow Left Horizontal Offset :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="soloarrowlefthoffset" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowlefthoffset){?><?php echo $_smarty_tpl->tpl_vars['option']->value->soloarrowlefthoffset;?>
<?php }else{ ?>20<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'a value between -600 to 600 -	Offset from current Horizontal position of of left Arrow negative and positive direction','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Solo Arrow Left Vertical Offset :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="soloarrowleftvoffset" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowleftvoffset){?><?php echo $_smarty_tpl->tpl_vars['option']->value->soloarrowleftvoffset;?>
<?php }else{ ?>0<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'a value between -600 to 600 -	Offset from current Vertical position of of left Arrow negative and positive direction','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Solo Arrow Right Horizontal Align:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="soloarrowrighthalign" value="left" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowrighthalign=="left"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'left','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="soloarrowrighthalign" value="center" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowrighthalign=="center"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'center','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="soloarrowrighthalign" value="right" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowrighthalign=="right"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'right','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Horizontal Align of right Arrow (only if arrow is not next to bullets)','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Solo Arrow Right Vertical Align :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="radio" name="soloarrowrightvalign" value="top" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowrightvalign=="top"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'top','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="soloarrowrightvalign" value="center" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowrightvalign=="center"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'center','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<input type="radio" name="soloarrowrightvalign" value="bottom" <?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowrightvalign=="bottom"){?>checked="checked"<?php }?> />
				<label class="t"><?php echo smartyTranslate(array('s'=>'bottom','mod'=>'csslider'),$_smarty_tpl);?>
</label>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'Vertical Align of left Arrow (only if arrow is not next to bullets)','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Solo Arrow Right Horizontal Offset :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="soloarrowrighthoffset" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowrighthoffset){?><?php echo $_smarty_tpl->tpl_vars['option']->value->soloarrowrighthoffset;?>
<?php }else{ ?>20<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'a value between -600 to 600 -	Offset from current Horizontal position of of right Arrow negative and positive direction','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Solo Arrow Right Vertical Offset :','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="soloarrowrightvoffset" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->soloarrowrightvoffset){?><?php echo $_smarty_tpl->tpl_vars['option']->value->soloarrowrightvoffset;?>
<?php }else{ ?>0<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'a value between -600 to 600 -	Offset from current Vertical position of of right Arrow negative and positive direction','mod'=>'csslider'),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
			</div>
		</div>
	</fieldset>
<fieldset class="thumbnail-option tab-manager plblogtabs">
	<div class="form-group">
	<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Time hide thumbnails:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
		<div class="col-lg-9">
			<input type="text" name="timehidethumbnail" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->timehidethumbnail){?><?php echo $_smarty_tpl->tpl_vars['option']->value->timehidethumbnail;?>
<?php }else{ ?>10<?php }?>"/>
			<p class="help-block"><?php echo smartyTranslate(array('s'=>'Time after that the Thumbs will be hidden','mod'=>'csslider'),$_smarty_tpl);?>
</p>
		<div class="clear"></div>
	</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Thumbnails width:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="thumbnailwidth" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->thumbnailwidth){?><?php echo $_smarty_tpl->tpl_vars['option']->value->thumbnailwidth;?>
<?php }else{ ?>100<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'The basic Width of one Thumbnail','mod'=>'csslider'),$_smarty_tpl);?>
</p>
			<div class="clear"></div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Thumbnails height:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
		<div class="col-lg-9">
			<input type="text" name="thumbnailheight" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->thumbnailheight){?><?php echo $_smarty_tpl->tpl_vars['option']->value->thumbnailheight;?>
<?php }else{ ?>100<?php }?>"/>
			<p class="help-block"><?php echo smartyTranslate(array('s'=>'The basic Height of one Thumbnail','mod'=>'csslider'),$_smarty_tpl);?>
</p>
			<div class="clear"></div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Thumbnails amount:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="thumbamount" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->thumbamount){?><?php echo $_smarty_tpl->tpl_vars['option']->value->thumbamount;?>
<?php }else{ ?>2<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'The amount of the Thumbs visible same time (only if thumb is selected)','mod'=>'csslider'),$_smarty_tpl);?>
</p>
			<div class="clear"></div>
		</div>
	</div>
</fieldset>
<fieldset class="mobilevisibility-option tab-manager plblogtabs">
	<div class="form-group">
		<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Hide Caption At Limit:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
			<div class="col-lg-9">
				<input type="text" name="hidecapptionatlimit" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->hidecapptionatlimit){?><?php echo $_smarty_tpl->tpl_vars['option']->value->hidecapptionatlimit;?>
<?php }else{ ?>0<?php }?>"/>
				<p class="help-block"><?php echo smartyTranslate(array('s'=>'It Defines if a caption should be shown under a Width Limit ( Basod on The Width of Banner ! )','mod'=>'csslider'),$_smarty_tpl);?>
</p>
			<div class="clear"></div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Hide All Caption At Limit:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
		<div class="col-lg-9">
			<input type="text" name="hideallcapptionatlimit" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->hideallcapptionatlimit){?><?php echo $_smarty_tpl->tpl_vars['option']->value->hideallcapptionatlimit;?>
<?php }else{ ?>0<?php }?>"/>
			<p class="help-block"><?php echo smartyTranslate(array('s'=>'Hide all The Captions if Width of Browser is less then this value','mod'=>'csslider'),$_smarty_tpl);?>
</p>
			<div class="clear"></div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3"><?php echo smartyTranslate(array('s'=>'Hide Slider At Limit:','mod'=>'csslider'),$_smarty_tpl);?>
</label>
		<div class="col-lg-9">
			<input type="text" name="hideslideratlimit" value="<?php if ($_smarty_tpl->tpl_vars['option']->value->hideslideratlimit){?><?php echo $_smarty_tpl->tpl_vars['option']->value->hideslideratlimit;?>
<?php }else{ ?>0<?php }?>"/>
			<p class="help-block"><?php echo smartyTranslate(array('s'=>'Under this Limit the Slider is hidden and the timer is stopped','mod'=>'csslider'),$_smarty_tpl);?>
</p>
			<div class="clear"></div>
		</div>
	</div>
	</fieldset> <br/>
	<div class="panel-footer">
		<button type="submit" class="btn btn-default" name="applyOptions" value="1" id="applyOptions"><i class="process-icon-save"></i><?php echo smartyTranslate(array('s'=>'Apply','mod'=>'csslider'),$_smarty_tpl);?>
</button>
		<button type="submit" class="btn btn-default" name="resetOptions" value="" id="applyOptions"><i class="process-icon-reset"></i> <?php echo smartyTranslate(array('s'=>'Reset','mod'=>'csslider'),$_smarty_tpl);?>
</button>				
	</div>
</form></div><?php }} ?>
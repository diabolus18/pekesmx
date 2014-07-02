
<div class="panel clearfix">
<h3><i class="icon-cogs"></i> {l s='Setting Options' mod='csslider'}</h3>
<div class="productTabs col-lg-2">
	<div class="list-group">				
		<a class="list-group-item active" id="general-option" href="javascript:void(0);">{l s='General' mod='csslider'}</a>
		<a class="list-group-item" id="navigation-option" href="javascript:void(0);">{l s='Navigation' mod='csslider'}</a>
		<a class="list-group-item" id="thumbnail-option" href="javascript:void(0);">{l s='Thumbnail' mod='csslider'}</a>
		<a class="list-group-item" id="mobilevisibility-option" href="javascript:void(0);">{l s='Mobile visibility' mod='csslider'}</a>
	</div>
</div>
<form method="post" action="{$postAction|escape:'htmlall':'UTF-8'}" enctype="multipart/form-data" class="form-horizontal col-lg-10 panel">
	<fieldset class="general-option tab-manager plblogtabs">
		<div class="form-group ">
			<label class="control-label col-lg-3 ">{l s='Delay:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="delay" value="{if $option->delay}{$option->delay}{else}9000{/if}"/>
				<p class="help-block">{l s='The time one slide stays on the screen in Milliseconds' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3 ">{l s='Startheight:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="startheight" value="{if $option->startheight}{$option->startheight}{else}500{/if}"/>
				<p class="help-block">{l s='Basic Height of the Slider in the desktop resolution in pixel, other screen sizes will be calculated from this' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3 ">{l s='Startwidth:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="startwidth" value="{if $option->startwidth}{$option->startwidth}{else}1180{/if}"/>
				<p class="help-block">{l s='Basic Width of the Slider in the desktop resolution in pixel, other screen sizes will be calculated from this' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3 ">{l s='Touchenabled:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="touchenabled" value="on" {if $option->touchenabled == "on"}checked="checked"{/if} />
				<label class="t"><img src="{$admin_img}enabled.gif" alt="Enabled" title="Enabled" /></label>
				<input type="radio" name="touchenabled" value="off" {if $option->touchenabled == "off"}checked="checked"{/if} />
				<label class="t"><img src="{$admin_img}disabled.gif" alt="Disabled" title="Disabled" /></label>
				<p class="help-block">{l s='Enable Swipe Function on touch devices' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='OnHoverStop:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="onhoverstop" value="on" {if $option->onhoverstop == "on"}checked="checked"{/if} />
				<label class="t"><img src="{$admin_img}enabled.gif" alt="Enabled" title="Enabled" /></label>
				<input type="radio" name="onhoverstop" value="off" {if $option->onhoverstop == "off"}checked="checked"{/if} />
				<label class="t"><img src="{$admin_img}disabled.gif" alt="Disabled" title="Disabled" /></label>
				<p class="help-block">{l s='Stop the Timer when hovering the slider' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='FullWidth:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="fullwidth" value="on" {if $option->fullwidth == "on"}checked="checked"{/if} />
				<label class="t"><img src="{$admin_img}enabled.gif" alt="Enabled" title="Enabled" /></label>
				<input type="radio" name="fullwidth" value="off" {if $option->fullwidth == "off"}checked="checked"{/if} />
				<label class="t"><img src="{$admin_img}disabled.gif" alt="Disabled" title="Disabled" /></label>
				<p class="help-block">{l s='Stop the Timer when hovering the slider' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Show timer line:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="timerline" value="true" {if $option->timerline != "false"}checked="checked"{/if} />
				<label class="t"><img src="{$admin_img}enabled.gif" alt="Enabled" title="Enabled" /></label>
				<input type="radio" name="timerline" value="false" {if $option->timerline == "false"}checked="checked"{/if} />
				<label class="t"><img src="{$admin_img}disabled.gif" alt="Disabled" title="Disabled" /></label>
				<p class="help-block">{l s='Display or not dislay timer liner.' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Timer line position:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="timerlineposition" value="top" {if $option->timerlineposition == "top"}checked="checked"{/if} />
				<label class="t">{l s='Top' mod='csslider'}</label>
				<input type="radio" name="timerlineposition" value="bottom" {if $option->timerlineposition == "bottom"}checked="checked"{/if} />
				<label class="t">{l s='Bottom' mod='csslider'}</label>
				<p class="help-block">{l s='Position timer liner.' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Shadow:' mod='csslider'}</label>
			<div class="col-lg-9">
				<select name="shadow">';
					<option value="0" {if $option->shadow == 0}selected=selected"{/if}>0</option>';
					<option value="1" {if $option->shadow == 1}selected=selected"{/if}>1</option>';
					<option value="2" {if $option->shadow == 2}selected=selected"{/if}>2</option>';
					<option value="3" {if $option->shadow == 3}selected=selected"{/if}>3</option>';
				</select>
				<p class="help-block">{l s='Basic Width of the Slider in the desktop resolution in pixel, other screen sizes will be calculated from this' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Stop at slide :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="stopatslide" value="{if $option->stopatslide}{$option->stopatslide}{else}-1{/if}"/>
				<p class="help-block">{l s='-1 or 1 to 999. Stop at selected Slide Number. If set to -1 it will loop without stopping. Only available if stopAfterLoops is not equal -1 !' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Stop after loops :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="stopafterloops" value="{if $option->stopafterloops}{$option->stopafterloops}{else}-1{/if}"/>
				<p class="help-block">{l s='-1 or 0 to 999. Stop at selected Slide Number (stopAtSlide) after slide looped "x" time, where x this Number. If set to -1 it will loop without stopping. Only available if stopAtSlide not equal -1 !' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
	</fieldset>
	<fieldset class="navigation-option tab-manager plblogtabs">
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Navigation Type:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="navigationtype" value="bullet" {if $option->navigationtype == "bullet"}checked="checked"{/if} />
				<label class="t">{l s='Bullet' mod='csslider'}</label>
				<input type="radio" name="navigationtype" value="thumb" {if $option->navigationtype == "thumb"}checked="checked"{/if} />
				<label class="t">{l s='Thumb' mod='csslider'}</label>
				<input type="radio" name="navigationtype" value="none" {if $option->navigationtype == "none"}checked="checked"{/if} />
				<label class="t">{l s='None' mod='csslider'}</label>
				<p class="help-block">{l s=' Display type of the navigation bar' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Navigation Arrows:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="navigationarrow" value="nexttobullets" {if $option->navigationarrow == "nexttobullets"}checked="checked"{/if} />
				<label class="t">{l s='Next to Bullets' mod='csslider'}</label>
				<input type="radio" name="navigationarrow" value="solo" {if $option->navigationarrow == "solo"}checked="checked"{/if} />
				<label class="t">{l s='Solo' mod='csslider'}</label>
				<input type="radio" name="navigationarrow" value="none" {if $option->navigationarrow == "none"}checked="checked"{/if} />
				<label class="t">{l s='None' mod='csslider'}</label>
				<p class="help-block">{l s='Display position of the Navigation Arrows' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Navigation style:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="navigationstyle" value="round" {if $option->navigationstyle == "round"}checked="checked"{/if} />
				<label class="t">{l s='round' mod='csslider'}</label>
				<input type="radio" name="navigationstyle" value="navbar" {if $option->navigationstyle == "navbar"}checked="checked"{/if} />
				<label class="t">{l s='navbar' mod='csslider'}</label>
				<input type="radio" name="navigationstyle" value="round-old" {if $option->navigationstyle == "round-old"}checked="checked"{/if} />
				<label class="t">{l s='round-old' mod='csslider'}</label>
				<input type="radio" name="navigationstyle" value="square-old" {if $option->navigationstyle == "square-old"}checked="checked"{/if} />
				<label class="t">{l s='square-old' mod='csslider'}</label>
				<input type="radio" name="navigationstyle" value="navbar-old" {if $option->navigationstyle == "navbar-old"}checked="checked"{/if} />
				<label class="t">{l s='navbar-old' mod='csslider'}</label>
				<p class="help-block">{l s='Look of the navigation bullets' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Navigation Horizontal Align :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="navigationhalign" value="left" {if $option->navigationhalign == "left"}checked="checked"{/if} />
				<label class="t">{l s='left' mod='csslider'}</label>
				<input type="radio" name="navigationhalign" value="center" {if $option->navigationhalign == "center"}checked="checked"{/if} />
				<label class="t">{l s='center' mod='csslider'}</label>
				<input type="radio" name="navigationhalign" value="right" {if $option->navigationhalign == "right"}checked="checked"{/if} />
				<label class="t">{l s='right' mod='csslider'}</label>
				<p class="help-block">{l s='Horizontal Align of Bullets / Thumbnails' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Navigation Vertical Align :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="navigationvalign" value="top" {if $option->navigationvalign == "top"}checked="checked"{/if} />
				<label class="t">{l s='top' mod='csslider'}</label>
				<input type="radio" name="navigationvalign" value="center" {if $option->navigationvalign == "center"}checked="checked"{/if} />
				<label class="t">{l s='center' mod='csslider'}</label>
				<input type="radio" name="navigationvalign" value="bottom" {if $option->navigationvalign == "bottom"}checked="checked"{/if} />
				<label class="t">{l s='bottom' mod='csslider'}</label>
				<p class="help-block">{l s='Vertical Align of Bullets / Thumbnails' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Navigation Horizontal Offset :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="navigationhoffset" value="{if $option->navigationhoffset}{$option->navigationhoffset}{else}0{/if}"/>
				<p class="help-block">{l s='A value between -600 to 600 - Offset from current Horizontal position of Bullets / Thumbnails negative and positive direction' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Navigation Vertical Offset :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="navigationvoffset" value="{if $option->navigationvoffset}{$option->navigationvoffset}{else}0{/if}"/>
				<p class="help-block">{l s='A value between -600 to 600 - Offset from current Vertical position of Bullets / Thumbnails negative and positive direction' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Solo Arrow Left Horizontal Align:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="soloarrowlefthalign" value="left" {if $option->soloarrowlefthalign == "left"}checked="checked"{/if} />
				<label class="t">{l s='left' mod='csslider'}</label>
				<input type="radio" name="soloarrowlefthalign" value="center" {if $option->soloarrowlefthalign == "center"}checked="checked"{/if} />
				<label class="t">{l s='center' mod='csslider'}</label>
				<input type="radio" name="soloarrowlefthalign" value="right" {if $option->soloarrowlefthalign == "right"}checked="checked"{/if} />
				<label class="t">{l s='right' mod='csslider'}</label>
				<p class="help-block">{l s='Horizontal Align of left Arrow (only if arrow is not next to bullets)' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">				
			<label class="control-label col-lg-3">{l s='Solo Arrow Left Vertical Align :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="soloarrowleftvalign" value="top" {if $option->soloarrowleftvalign == "top"}checked="checked"{/if} />
				<label class="t">{l s='top' mod='csslider'}</label>
				<input type="radio" name="soloarrowleftvalign" value="center" {if $option->soloarrowleftvalign == "center"}checked="checked"{/if} />
				<label class="t">{l s='center' mod='csslider'}</label>
				<input type="radio" name="soloarrowleftvalign" value="bottom" {if $option->soloarrowleftvalign == "bottom"}checked="checked"{/if} />
				<label class="t">{l s='bottom' mod='csslider'}</label>
				<p class="help-block">{l s='Vertical Align of left Arrow (only if arrow is not next to bullets)' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Solo Arrow Left Horizontal Offset :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="soloarrowlefthoffset" value="{if $option->soloarrowlefthoffset}{$option->soloarrowlefthoffset}{else}20{/if}"/>
				<p class="help-block">{l s='a value between -600 to 600 -	Offset from current Horizontal position of of left Arrow negative and positive direction' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Solo Arrow Left Vertical Offset :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="soloarrowleftvoffset" value="{if $option->soloarrowleftvoffset}{$option->soloarrowleftvoffset}{else}0{/if}"/>
				<p class="help-block">{l s='a value between -600 to 600 -	Offset from current Vertical position of of left Arrow negative and positive direction' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Solo Arrow Right Horizontal Align:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="soloarrowrighthalign" value="left" {if $option->soloarrowrighthalign == "left"}checked="checked"{/if} />
				<label class="t">{l s='left' mod='csslider'}</label>
				<input type="radio" name="soloarrowrighthalign" value="center" {if $option->soloarrowrighthalign == "center"}checked="checked"{/if} />
				<label class="t">{l s='center' mod='csslider'}</label>
				<input type="radio" name="soloarrowrighthalign" value="right" {if $option->soloarrowrighthalign == "right"}checked="checked"{/if} />
				<label class="t">{l s='right' mod='csslider'}</label>
				<p class="help-block">{l s='Horizontal Align of right Arrow (only if arrow is not next to bullets)' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Solo Arrow Right Vertical Align :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="radio" name="soloarrowrightvalign" value="top" {if $option->soloarrowrightvalign == "top"}checked="checked"{/if} />
				<label class="t">{l s='top' mod='csslider'}</label>
				<input type="radio" name="soloarrowrightvalign" value="center" {if $option->soloarrowrightvalign == "center"}checked="checked"{/if} />
				<label class="t">{l s='center' mod='csslider'}</label>
				<input type="radio" name="soloarrowrightvalign" value="bottom" {if $option->soloarrowrightvalign == "bottom"}checked="checked"{/if} />
				<label class="t">{l s='bottom' mod='csslider'}</label>
				<p class="help-block">{l s='Vertical Align of left Arrow (only if arrow is not next to bullets)' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Solo Arrow Right Horizontal Offset :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="soloarrowrighthoffset" value="{if $option->soloarrowrighthoffset}{$option->soloarrowrighthoffset}{else}20{/if}"/>
				<p class="help-block">{l s='a value between -600 to 600 -	Offset from current Horizontal position of of right Arrow negative and positive direction' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Solo Arrow Right Vertical Offset :' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="soloarrowrightvoffset" value="{if $option->soloarrowrightvoffset}{$option->soloarrowrightvoffset}{else}0{/if}"/>
				<p class="help-block">{l s='a value between -600 to 600 -	Offset from current Vertical position of of right Arrow negative and positive direction' mod='csslider'}</p>
				<div class="clear"></div>
			</div>
		</div>
	</fieldset>
<fieldset class="thumbnail-option tab-manager plblogtabs">
	<div class="form-group">
	<label class="control-label col-lg-3">{l s='Time hide thumbnails:' mod='csslider'}</label>
		<div class="col-lg-9">
			<input type="text" name="timehidethumbnail" value="{if $option->timehidethumbnail}{$option->timehidethumbnail}{else}10{/if}"/>
			<p class="help-block">{l s='Time after that the Thumbs will be hidden' mod='csslider'}</p>
		<div class="clear"></div>
	</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">{l s='Thumbnails width:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="thumbnailwidth" value="{if $option->thumbnailwidth}{$option->thumbnailwidth}{else}100{/if}"/>
				<p class="help-block">{l s='The basic Width of one Thumbnail' mod='csslider'}</p>
			<div class="clear"></div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">{l s='Thumbnails height:' mod='csslider'}</label>
		<div class="col-lg-9">
			<input type="text" name="thumbnailheight" value="{if $option->thumbnailheight}{$option->thumbnailheight}{else}100{/if}"/>
			<p class="help-block">{l s='The basic Height of one Thumbnail' mod='csslider'}</p>
			<div class="clear"></div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">{l s='Thumbnails amount:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="thumbamount" value="{if $option->thumbamount}{$option->thumbamount}{else}2{/if}"/>
				<p class="help-block">{l s='The amount of the Thumbs visible same time (only if thumb is selected)' mod='csslider'}</p>
			<div class="clear"></div>
		</div>
	</div>
</fieldset>
<fieldset class="mobilevisibility-option tab-manager plblogtabs">
	<div class="form-group">
		<label class="control-label col-lg-3">{l s='Hide Caption At Limit:' mod='csslider'}</label>
			<div class="col-lg-9">
				<input type="text" name="hidecapptionatlimit" value="{if $option->hidecapptionatlimit}{$option->hidecapptionatlimit}{else}0{/if}"/>
				<p class="help-block">{l s='It Defines if a caption should be shown under a Width Limit ( Basod on The Width of Banner ! )' mod='csslider'}</p>
			<div class="clear"></div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">{l s='Hide All Caption At Limit:' mod='csslider'}</label>
		<div class="col-lg-9">
			<input type="text" name="hideallcapptionatlimit" value="{if $option->hideallcapptionatlimit}{$option->hideallcapptionatlimit}{else}0{/if}"/>
			<p class="help-block">{l s='Hide all The Captions if Width of Browser is less then this value' mod='csslider'}</p>
			<div class="clear"></div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">{l s='Hide Slider At Limit:' mod='csslider'}</label>
		<div class="col-lg-9">
			<input type="text" name="hideslideratlimit" value="{if $option->hideslideratlimit}{$option->hideslideratlimit}{else}0{/if}"/>
			<p class="help-block">{l s='Under this Limit the Slider is hidden and the timer is stopped' mod='csslider'}</p>
			<div class="clear"></div>
		</div>
	</div>
	</fieldset> <br/>
	<div class="panel-footer">
		<button type="submit" class="btn btn-default" name="applyOptions" value="1" id="applyOptions"><i class="process-icon-save"></i>{l s='Apply' mod='csslider'}</button>
		<button type="submit" class="btn btn-default" name="resetOptions" value="" id="applyOptions"><i class="process-icon-reset"></i> {l s='Reset' mod='csslider'}</button>				
	</div>
</form></div>
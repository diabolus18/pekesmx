<?php
include_once(dirname(__FILE__).'/SliderClass.php');
include_once(dirname(__FILE__).'/Caption.php');

class CsSlider extends Module
{
	private $_html;
	private $transitions = array("boxslide","boxfade","slotzoom-horizontal","slotslide-horizontal","slotfade-horizontal","slotzoom-vertical","slotslide-vertical","slotfade-vertical","curtain-1","curtain-2","curtain-3","slideleft","slideright","slideup","slidedown","fade","random","slidehorizontal","slidevertical","papercut","flyin","turnoff","cube","3dcurtain-vertical","3dcurtain-horizontal");
	private $incomAnimation = array("sft"=>"Short from Top","sfb"=>"Short from Bottom","sfr"=>"Short from Right","sfl"=>"Short from Left","lft"=>"Long from Top","lfb"=>"Long from Bottom","lfr"=>"Long from Right","lfl"=>"Long from Left","fade"=>"fading","randomrotate"=>"randomrotate");
	private $outgoAnimation = array("stt"=>"Short to Top","stb"=>"Short to Bottom","str"=>"Short to Right","stl"=>"Short to Left","ltt"=>"Long to Top","ltb"=>"Long to Bottom","ltr"=>"Long to Right","ltl"=>"Long to Left","fadeout"=>"fading","randomrotateout"=>"Fade in");
	private $easing = array("easeOutBack","easeInQuad","easeOutQuad","easeInOutQuad","easeInCubic","easeOutCubic","easeInQuart","easeOutQuart","easeInOutQuart","easeInQuint","easeOutQuint","easeInOutQuint","easeInSine","easeOutSine","easeInOutSine","easeInExpo","easeOutExpo","easeInOutExpo","easeInCirc","easeOutCirc","easeInOutCirc","easeInElastic","easeOutElastic","easeInOutElastic","easeInBack","easeOutBack","easeInOutBack","easeInBounce","easeOutBounce","easeInOutBounce");
	private $optionList = array(
				"delay"=>"9000",
				"startheight"=>"500",
				"startwidth"=>"1180",
				"touchenabled"=>"on",
				"onhoverstop"=>"on",
				"fullwidth"=>"off",
				"timerline"=>"true",
				"timerlineposition"=>"top",
				"navigationtype"=>"bullet",
				"navigationarrow"=>"solo",
				"navigationstyle"=>"round",
				"navigationhalign"=>"center",
				"navigationvalign"=>"bottom",
				"navigationhoffset"=>"0",
				"navigationvoffset"=>"0",
				"soloarrowlefthalign"=>"left",
				"soloarrowleftvalign"=>"center",
				"soloarrowlefthoffset"=>"20",
				"soloarrowleftvoffset"=>"0",
				"soloarrowrighthalign"=>"right",
				"soloarrowrightvalign"=>"center",
				"soloarrowrighthoffset"=>"20",
				"soloarrowrightvoffset"=>"0",
				"timehidethumbnail"=>"10",
				"thumbnailwidth"=>"100",
				"thumbnailheight"=>"100",
				"thumbamount"=>"2",
				"hidecapptionatlimit"=>"0",
				"hideallcapptionatlimit"=>"0",
				"hideslideratlimit"=>"0",
				"shadow"=>"0",
				"stopatslide"=>"-1",
				"stopafterloops"=>"-1"
				);
	private $classList = array("big_white","big_orange","big_black","medium_grey","small_text","medium_text","large_text","large_black_text","very_large_text","very_large_black_text","bold_red_text","bold_brown_text","bold_green_text","very_big_white","very_big_black");
	public function __construct()
	{
	 	$this->name = 'csslider';
	 	$this->tab = 'MyBlocks';
	 	$this->version = '1.0';
		$this->author = 'CodeSpot';
		$this->bootstrap = true;

	 	parent::__construct();

		$this->displayName = $this->l('CS Slider');
		$this->description = $this->l('Add a JQuery Revolution Slider on the homepage');
		$this->confirmUninstall = $this->l('Are you sure that you want to delete your CSSlider?');
		$this->module_path = _PS_MODULE_DIR_.$this->name.'/';
		$this->uploads_path = _PS_MODULE_DIR_.$this->name.'/img/';
		$this->admin_tpl_path = _PS_MODULE_DIR_.$this->name.'/views/templates/admin/';
		$this->hooks_tpl_path = _PS_MODULE_DIR_.$this->name.'/views/templates/hooks/';

	}
	public function init_data()
	{
		$id_en = Language::getIdByIso('en');
		$id_fr = Language::getIdByIso('fr');
		$id_shop = Configuration::get('PS_SHOP_DEFAULT');
		if(!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'csslider` (`id_csslider`, `animation`, `image`, `position`, `display`) VALUES 
		(1, \'{"transitions":"boxslide","slotamount":"7","masterspeed":"300","target":"_self","delay":"9400","enablelink":"1","enablefullvideo":"1"}\',\'{"type":"image","value":"1.png"}\', 1, 1),
		(2, \'{"transitions":"boxslide","slotamount":"7","masterspeed":"300","target":"_self","delay":"9400","enablelink":"1","enablefullvideo":"1"}\', \'{"type":"color","value":"#ff5e00"}\', 2, 1),
		(3,  \'{"transitions":"boxslide","slotamount":"7","masterspeed":"300","target":"_self","delay":"9400","enablelink":"1","enablefullvideo":"0"}\', \'{"type":"image","value":"2.png"}\', 3, 1),
		(4, \'{"transitions":"boxslide","slotamount":"7","masterspeed":"300","target":"_self","delay":"9400","enablelink":"1","enablefullvideo":"1"}\', \'{"type":"image","value":"3.png"}\', 4, 1)') OR
		
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'csslider_shop` (`id_csslider`, `id_shop`, `animation`, `image`, `position`, `display`) VALUES 
		(1, "'.$id_shop.'",\'{"transitions":"boxslide","slotamount":"7","masterspeed":"300","target":"_self","delay":"9400","enablelink":"1","enablefullvideo":"1"}\',\'{"type":"image","value":"1.png"}\', 1, 1),
		(2,"'.$id_shop.'", \'{"transitions":"boxslide","slotamount":"7","masterspeed":"300","target":"_self","delay":"9400","enablelink":"1","enablefullvideo":"1"}\', \'{"type":"color","value":"#ff5e00"}\', 2, 1),
		(3,"'.$id_shop.'", \'{"transitions":"boxslide","slotamount":"7","masterspeed":"300","target":"_self","delay":"9400","enablelink":"1","enablefullvideo":"0"}\', \'{"type":"image","value":"2.png"}\', 3, 1),
		(4,"'.$id_shop.'", \'{"transitions":"boxslide","slotamount":"7","masterspeed":"300","target":"_self","delay":"9400","enablelink":"1","enablefullvideo":"1"}\', \'{"type":"image","value":"3.png"}\', 4, 1)') OR
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'csslider_lang` (`id_csslider`, `id_lang`, `id_shop`, `url`) VALUES
		(1, "'.$id_en.'", "'.$id_shop.'", "#"),
		(1, "'.$id_fr.'", "'.$id_shop.'", "#"),
		(2, "'.$id_en.'", "'.$id_shop.'", "#"),
		(2, "'.$id_fr.'", "'.$id_shop.'", "#"),
		(3, "'.$id_en.'", "'.$id_shop.'", "#"),
		(3, "'.$id_fr.'", "'.$id_shop.'", "#"),
		(4, "'.$id_en.'", "'.$id_shop.'", "#"),
		(4, "'.$id_fr.'", "'.$id_shop.'", "#")
		'))
			return false;
		return true;
	}
	
	
	public function install()
	{
	 	if (parent::install() == false OR !$this->registerHook('header') OR !$this->registerHook('csslideshow') OR !$this->registerHook('actionShopDataDuplication'))
	 		return false;
		if (!Db::getInstance()->Execute('CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'csslider (`id_csslider` int(10) unsigned NOT NULL AUTO_INCREMENT, `animation` text ,`image` varchar(255) NOT NULL DEFAULT \'\', `position` int(10) unsigned DEFAULT \'0\', `display` tinyint(1) NOT NULL DEFAULT \'1\', PRIMARY KEY (`id_csslider`)) ENGINE='._MYSQL_ENGINE_.' default CHARSET=utf8'))
	 		return false;
		if (!Db::getInstance()->Execute('CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'csslider_shop (`id_csslider` int(10) unsigned NOT NULL ,`id_shop` int(10) unsigned NOT NULL, `animation` text, `image` varchar(255) NOT NULL DEFAULT \'\', `position` int(10) unsigned DEFAULT \'0\', `display` tinyint(1) NOT NULL DEFAULT \'1\', PRIMARY KEY (`id_csslider`,`id_shop`)) ENGINE='._MYSQL_ENGINE_.' default CHARSET=utf8'))
	 		return false;
		if (!Db::getInstance()->Execute('CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'csslider_lang (`id_csslider` int(10) unsigned NOT NULL,`id_lang` int(10) unsigned NOT NULL, `id_shop` int(10) unsigned NOT NULL, `url` varchar(255), PRIMARY KEY (`id_csslider`, `id_lang`, `id_shop`)) ENGINE='._MYSQL_ENGINE_.' default CHARSET=utf8'))
			return false;
		if (!Db::getInstance()->Execute('CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'csslider_caption (`id_caption` int(10) unsigned NOT NULL AUTO_INCREMENT, `id_csslider` int(10) unsigned NOT NULL,`layer` int(10) unsigned NOT NULL, `content` text, PRIMARY KEY (`id_caption`)) ENGINE='._MYSQL_ENGINE_.' default CHARSET=utf8'))
			return false;		
		$this->init_data();
	 	return true;
	}
	
	public function uninstall()
	{
	 	if (parent::uninstall() == false OR !$this->unregisterHook('csslideshow'))
	 		return false;
		if (!Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'csslider') OR !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'csslider_shop') OR !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'csslider_caption') OR !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'csslider_lang'))
	 		return false;
	 	return true;
	}
	
	private function _displayHelp()
	{
		$this->_html .= '
		<br/>
	 	<div class="panel">
			<h3><img src="'.$this->_path.'logo.gif" alt="" title="" /> '.$this->l('Revolution Slider Helper').'</h3>
			<a href="http://www.themepunch.com/codecanyon/revolution_wp/index.html" alt="Revolution Slider" title="Revolution Slider">http://www.themepunch.com/codecanyon/revolution_wp/index.html</a>
		</div>';
	}
	
	private function _displayOptions()
	{
		$this->context->controller->addCss($this->_path.'css/admin/tab.css', 'all');
		$this->context->controller->addJS($this->_path.'js/admin/tab.js');
		$context = Context::getContext();
		$id_shop = $context->shop->id;
		if (!file_exists(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml'))
		{
			copy(dirname(__FILE__).'/'.'option_'.Configuration::get('PS_SHOP_DEFAULT').'.xml',dirname(__FILE__).'/'.'option_'.$id_shop.'.xml');
		}
		$option = simplexml_load_file(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml');
		$postAction = 'index.php?tab=AdminModules&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&tab_module=other&module_name='.$this->name.'';
		
		$this->context->smarty->assign('option', $option);
		$this->context->smarty->assign('postAction', $postAction);
		$this->context->smarty->assign('admin_img', _PS_ADMIN_IMG_);
		
		return $this->display(__FILE__, 'views/templates/admin/display_option.tpl');
	}
	
	public function getContent()
   	{
		global $currentIndex;
		
		$this->_postProcess();
		
		if (Tools::isSubmit('addSlider'))
			$this->_html .= $this->_displayAddForm();
		elseif (Tools::isSubmit('editSlider'))
			$this->_displayUpdateForm();
		else
		{
			$this->_displayForm();
			$this->_html .= $this->_displayOptions();
		}
		
		$this->_displayHelp();
		
		return $this->_html;
	}
	
	private function saveXmlOption($reset = false)
	{
		$error = false;
		$newXml = '<?xml version=\'1.0\' encoding=\'utf-8\' ?>'."\n".'<options>'."\n";
		foreach($this->optionList as $key=>$default)
		{
			$newXml .= '<'.$key.'>';
			$newXml .= ($reset ? ''.$default.'' : Tools::getValue(''.$key.''));
			$newXml .= '</'.$key.'>'."\n";
		}
		$newXml .= '</options>'."\n";
		$context = Context::getContext();
		$id_shop = $context->shop->id;
		if ($fd = @fopen(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml', 'w'))
		{
			if (!@fwrite($fd, $newXml))
				$error = $this->displayError($this->l('Unable to write to the editor file.'));
			if (!@fclose($fd))
				$error = $this->displayError($this->l('Can\'t close the editor file.'));
		}
		else
			$error = $this->displayError($this->l('Unable to update the editor file. Please check the editor file\'s writing permissions.'));
		return $error;
	}
	
	private function _postProcess()
	{
		global $currentIndex;
		$errors = array();
		if(Tools::isSubmit('submitAddCaption'))
		{
			$caption = new Caption(Tools::getValue('id_caption'));
			$caption->copyFromPost();
			$errors = $caption->validateController();
			if (sizeof($errors))
			{
				$this->_html .= $this->displayError(implode('<br />', $errors));
			}
			else
			{
				Tools::getValue('id_caption') ? $caption->update() : $caption->add();
				$this->_clearCache('csslider.tpl');
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editSlider&id_csslider='.$caption->id_csslider.'#tab=caption');
			}
		}
		if (Tools::isSubmit('submitAddSliderAndContinue') OR Tools::isSubmit('submitAddSliderAndBack') OR Tools::isSubmit('submitAddSlider'))
		{
			$slider = new SliderClass(Tools::getValue('id_csslider'));
			$slider->copyFromPost();
			
			$errors = $slider->validateController();	
			if (sizeof($errors))
			{
				$this->_html .= $this->displayError(implode('<br />', $errors));
			}
			else
			{
				Tools::getValue('id_csslider') ? $slider->update() : $slider->add();
				$this->_clearCache('csslider.tpl');
				if(Tools::getValue('id_csslider') OR Tools::isSubmit('submitAddSliderAndBack'))
					Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&saveSliderConfirmation');
				else
					Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editSlider&id_csslider='.$slider->id.'#tab=caption');
			}
		}
		elseif (Tools::isSubmit('deleteSlider') AND Tools::getValue('id_csslider'))
		{
			$slider = new SliderClass(Tools::getValue('id_csslider'));
			$captions = $slider->getCaption();
			foreach ($captions as $caption)
			{
				$c = new Caption($caption['id_caption']);
				$c->delete();
				$c->cleanLayers();
			}
			$slider->delete();
			$slider->cleanPositions();
			$this->_clearCache('csslider.tpl');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteSliderConfirmation');
		}
		elseif (Tools::isSubmit('orderSlider') AND Validate::isInt(Tools::getValue('id_csslider')) AND Validate::isInt(Tools::getValue('pos')))
		{
			$slider = new SliderClass(Tools::getValue('id_csslider'));
			$slider->updatePosition(Tools::getValue('way'),Tools::getValue('pos'));
			$this->_clearCache('csslider.tpl');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}
		elseif (Tools::isSubmit('deleteCaption') AND Tools::getValue('id_caption'))
		{
			$caption = new Caption(Tools::getValue('id_caption'));
			$caption->delete();
			$caption->cleanLayers();
			$this->_clearCache('csslider.tpl');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editSlider&id_csslider='.$caption->id_csslider.'#tab=caption');
		}
		elseif (Tools::isSubmit('orderLayerCaption') AND Validate::isInt(Tools::getValue('id_caption')) AND Validate::isInt(Tools::getValue('layer')))
		{
			$caption = new Caption(Tools::getValue('id_caption'));
			$caption->updateLayer(Tools::getValue('way'),Tools::getValue('layer'));
			$this->_clearCache('csslider.tpl');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editSlider&id_csslider='.$caption->id_csslider.'#tab=caption');
		}
		elseif (Tools::isSubmit('applyOptions'))
		{
			if ($error = $this->saveXmlOption())
				$this->_html .= $error;
			else
			{
				$this->_clearCache('csslider.tpl');
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&statusConfirmation');
			}
		}
		elseif (Tools::isSubmit('changeStatusSlider') AND Tools::getValue('id_csslider'))
		{
			$slidernew = new SliderClass(Tools::getValue('id_csslider'));
			$slidernew->updateStatus(Tools::getValue('status'));
			$this->_clearCache('csslider.tpl');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}
		elseif (Tools::isSubmit('resetOptions'))
		{
			if ($error = $this->saveXmlOption(true))
				$this->_html .= $error;
			else
			{
				$this->_clearCache('csslider.tpl');
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&statusConfirmation');
			}
		}
		elseif (Tools::isSubmit('saveSliderConfirmation'))
			$this->_html .= $this->displayConfirmation($this->l('Slider has been added successfully'));
		elseif (Tools::isSubmit('deleteSliderConfirmation'))
			$this->_html .= $this->displayConfirmation($this->l('Slider deleted successfully'));
		elseif (Tools::isSubmit('statusConfirmation'))
			$this->_html .= $this->displayConfirmation($this->l('Options updated successfully'));
		elseif (Tools::isSubmit('saveCaptionConfirmation'))
			$this->_html .= $this->displayConfirmation($this->l('Caption has been added successfully'));
		elseif (Tools::isSubmit('cancelAddSlider'))
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
	}
	
	
	private function getSliders($active = null)
	{
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;
	 	if (!$result = Db::getInstance()->ExecuteS(
			'SELECT ss.* FROM `'._DB_PREFIX_.'csslider_shop` ss
			LEFT JOIN `'._DB_PREFIX_.'csslider` s ON (ss.id_csslider = s.id_csslider)
			WHERE (ss.id_shop = '.(int)$id_shop.')'.
			($active ? ' AND ss.`display` = 1' : ' ').'
			ORDER BY ss.`position` ASC'))
	 		return false;
	 	return $result;
	}
	private function getUrl($id_csslider = null)
	{
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;
	 	if (!$result = Db::getInstance()->ExecuteS(
			'SELECT sl.url FROM `'._DB_PREFIX_.'csslider_lang` sl
			LEFT JOIN `'._DB_PREFIX_.'csslider` s ON (sl.id_csslider = s.id_csslider)
			WHERE (sl.id_shop = '.(int)$id_shop.') AND sl.id_csslider = '.(int)$id_csslider.''))
	 		return false;
		
	 	return $result;
	}
	
	
	private function _displayForm()
	{
		global $currentIndex, $cookie;
		$this->context->controller->addJQueryPlugin('fancybox');
		$languages = Language::getLanguages(false);
		$divLangName = 'captiondiv¤imagecaptiondiv¤video_typediv¤video_iddiv¤url';
		$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
	 	$this->_html .= '
		<script type="text/javascript">
		function appE(id,layer)
		{
			$("input[name=\'hiddenId\']").remove();
			$("body").append("<input type=\'hidden\' value=\"" + id + "\" name=\'hiddenId\' />");
			$("body").append("<input type=\'hidden\' value=\"" + layer + "\" name=\'hiddenLayer\' />");
		}
		$(document).ready(function() {
				$("a.addCaption").fancybox({
					\'onStart\': function() {
					$("input[name=\'id_csslider\']").remove();
					var idSlider = $("input[name=\'hiddenId\']").attr(\'value\');
					var hiddenLayer = $("input[name=\'hiddenLayer\']").attr(\'value\');
						$("form.formAddCaption").append("<input type=\'hidden\' name=\'id_csslider\' value=\"" + idSlider + "\" />");
						$("form.formAddCaption").append("<input type=\'hidden\' name=\'layer\' value=\"" + hiddenLayer + "\" />");
					}
				});
			});
		</script>
	 	<div class="panel">
			<h3>
				<i class="icon-list-ul"></i> '.$this->l('Sliders List').'
				<span class="panel-heading-action">
					<a id="btnAddMenu" class="list-toolbar-btn" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&addSlider">
					<i class="process-icon-new "></i>
					</a>
				</span>
			</h3>
			<table width="100%" id="csmegamenu" class="table tableDnD feature table_grid" cellspacing="0" cellpadding="0">
			<thead>
			<tr class="nodrag nodrop">
				<th>&nbsp;</th>
				<th class="center">'.$this->l('Image').'</th>
				<th class="center">'.$this->l('Displayed').'</th>
				<th class="center">'.$this->l('Position').'</th>
				<th class="center">'.$this->l('Add caption').'</th>
				<th class="center">'.$this->l('Delete').'</th>
			</tr>
			</thead>
			<tbody>';
		$sliders = $this->getSliders(false);
		$stringConfirm='onclick="if (!confirm(\' Are you sure that you want to delete item ?\')) return false "';
		if (is_array($sliders))
		{
			static $irow;
			$stt = 1;
			foreach ($sliders as $slider)
			{
				
				$bg_slider = json_decode($slider['image']);
				if ($dot_pos = strrpos($slider['image'],'.'))
					$thumb_url = _PS_BASE_URL_._MODULE_DIR_.$this->name.'/images/thumbs/'.substr($slider['image'], 0, $dot_pos).substr($slider['image'], $dot_pos);
				else
					$thumb_url =_PS_BASE_URL_._MODULE_DIR_.$this->name.'/image/default_thumb.jpg';
				$this->_html .= '
				<tr class="'.($irow++ % 2 ? 'alt_row' : '').'">
					<td class="pointer" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editSlider&id_csslider='.$slider['id_csslider'].'\'">'.$stt.'</td>
					<td class="pointer center" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editSlider&id_csslider='.$slider['id_csslider'].'\'">';
					if(isset($bg_slider->type) && $bg_slider->type == "color")
						$this->_html .= '<div style="display:inline-block;width:45px;height:45px;background-color:'.$bg_slider->value.'"></div>';
					if(isset($bg_slider->type) && $bg_slider->type == "image")
					{	
						$thumb_url = _PS_BASE_URL_._MODULE_DIR_.$this->name.'/images/thumbs/'.$bg_slider->value;
						$this->_html .= '<img src="'.$thumb_url.'" alt="" title="" style="height:45px;width:45px;margin: 3px 0px 3px 0px;"/>';
					}
					if(isset($bg_slider->type) && $bg_slider->type == "transparent")
					{
						$thumb_url = _PS_BASE_URL_._MODULE_DIR_.$this->name.'/images/thumbs/transparent.jpg';
						$this->_html .= '<img src="'.$thumb_url.'" alt="" title="" style="height:45px;width:45px;margin: 3px 0px 3px 0px;"/>';
					}
					$this->_html .= '</td>
					
					<td class="pointer center"> <a class="list-action-enable '.($slider['display'] ? 'action-enabled' : 'action-disabled').'" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&changeStatusSlider&id_csslider='.$slider['id_csslider'].'&status='.$slider['display'].'">'.($slider['display'] ? '<i class="icon-check"></i>' : '<i class="icon-remove"></i>').'</a> </td>
					
					<td class="pointer center">'.($slider !== end($sliders) ? '<div class="dragGroup"><a class="btn btn-default btn-xs" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&orderSlider&id_csslider='.$slider['id_csslider'].'&way=1&pos='.($slider['position']+1).'"><i class="icon-chevron-down"></i></a>' : '').($slider !== reset($sliders) ? '<a class="btn btn-default btn-xs" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&orderSlider&id_csslider='.$slider['id_csslider'].'&way=0&pos='.($slider['position']-1).'"><i class="icon-chevron-up"></i></a>' : '').'</div></td>
					<td class="pointer center"><a class="addCaption" id="'.$slider['id_csslider'].'" href="#contentAddCaption" onclick="return appE('.$slider['id_csslider'].','.Caption::getNextLayer().')" > <i class="icon-plus"></i></a></td>
					<td class="pointer center">
					<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteSlider&id_csslider='.$slider['id_csslider'].'\'" '.$stringConfirm.'><i class="icon-trash"></i></a>
					</td>
				</tr>';
				$stt++;
			}
		}
		$this->_html .= '
			</tbody>
			</table>
		</div>
		<div style="display:none"><div id="contentAddCaption"><form class="formAddCaption" method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'"  enctype="multipart/form-data">
		';
		$this->_html .= '<div style="margin-left:150px">
		<input type="radio" name="addCaption" onclick="$(\'.csCaption\').hide();$(\'.textcaption\').show();"  value="textcaption" checked="checked"/><label style="float:none">'.$this->l('Text Caption').'</label>
		<input type="radio" name="addCaption" onclick="$(\'.csCaption\').hide();$(\'.imagecaption\').show();" value="imagecaption"/><label style="float:none">'.$this->l('Image Caption').'</label>
		<input type="radio" name="addCaption" onclick="$(\'.csCaption\').hide();$(\'.videocaption\').show();" value="videocaption"/><label style="float:none">'.$this->l('Video Caption').'</label>
		</div><br/>
		<div class="textcaption csCaption">
		<label style="width:150px">'.$this->l('Text:').'</label>
		';
			foreach ($languages as $language)
			{
				$this->_html .= '
			<div id="captiondiv_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').'; float: left;">
				<textarea class="rte" name="textcaption['.$language['id_lang'].']" id="caption_'.$language['id_lang'].'" cols="50" rows="5">'.Tools::getValue('caption_'.$language['id_lang']).'</textarea>
			</div>';
			}
			$this->_html .= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'captiondiv', true);	
			$this->_html .= '</div>
		<div class="imagecaption csCaption" style="display:none">
		<label style="width:150px">'.$this->l('Image:').'</label>
		';
			foreach ($languages as $language)
			{
				$this->_html .= '
			<div id="imagecaptiondiv_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').'; float: left;">
				<input type="file" name="imagecaption_'.$language['id_lang'].'"/>
			</div>';
			}
			$this->_html .= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'imagecaptiondiv', true);
		$this->_html .= '</div>
		<div class="videocaption csCaption" style="display:none">
		<label style="width:150px">'.$this->l('Video Type:').'</label>';
		foreach ($languages as $language)
		{
			$this->_html .= '
		<div id="video_typediv_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').'; float: left;">
			<select name="videocaption_type['.$language['id_lang'].']">';
			$this->_html .= '<option value="1" selected="selected">Youtube</option>';
			$this->_html .= '<option value="2">Vimeo</option>';
		$this->_html .= '
			</select>
		</div>';
		}
		$this->_html .= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'video_typediv', true);	
		$this->_html .= '
		<div class="clear"></div>
	<label style="width:150px">'.$this->l('Video ID:').'</label>';
		foreach ($languages as $language)
		{
			$this->_html .= '
		<div id="video_iddiv_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').'; float: left;">';
		
			$this->_html .= '<input type="text" name="videocaption_text['.$language['id_lang'].']" value="'.Tools::getValue('video_id_'.$language['id_lang']).'" size="30" />';
			$this->_html .= '
		</div>';
		}
		$this->_html .= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'video_iddiv', true);	
		$this->_html .= '
		</div>
		<div class="clear"></div>'.$this->stringCaption().'
		</form></div></div>';
			
		
	}
	
	private function stringCaption($content=null)
	{
		$string_caption = '<div class="form-group "><label class="control-label col-lg-3 ">'.$this->l('Data x:').'</label>
				<div class="col-lg-9"><input type="text" name="content[datax]" value="'.($content ? $content->datax : "100").'"/></p>
				<p class="help-block">'.$this->l('The horizontal position in the standard (via startwidth option defined) screen size (other screen sizes will be calculated)').'</div></div>
				
				<div class="form-group "><label class="control-label col-lg-3 ">'.$this->l('Data y:').'</label>
				<div class="col-lg-9"><input type="text" name="content[datay]"  value="'.($content ? $content->datay : "100").'"/></p>
				<p class="help-block">'.$this->l('The vertical position in the standard (via startheight option defined) screen size (other screen sizes will be calculated)').'</div></div>
				
				<div class="form-group "><label class="control-label col-lg-3 ">'.$this->l('Class css:').'</label>
				<div class="col-lg-9"><select name="content[class]">
				<option value="">'.$this->l('No choose').'</option>
				';
				foreach($this->classList as $class)
				{
					$string_caption .= '<option value="'.$class.'" '.($content && $content->class == ''.$class.'' ? "selected=selected" : "").'>'.$class.'</option>';
				}
				$string_caption .= '</select>
				<p class="help-block">'.$this->l('Example big_white, big_orange, medium_grey').'</p></div></div>
				
				<div class="form-group "><label class="control-label col-lg-3 ">'.$this->l('Data speed:').'</label>
				<div class="col-lg-9"><input type="text" name="content[dataspeed]"  value="'.($content ? $content->dataspeed : "100").'"/></p>
				<p class="help-block" style="margin-left:150px;width:auto">'.$this->l('Duration of the animation in milliseconds').'</p></div></div>
				
				<div class="form-group "><label class="control-label col-lg-3 ">'.$this->l('Data start:').'</label>
				<div class="col-lg-9"><input type="text" name="content[datastart]"  value="'.($content ? $content->datastart : "100").'"/>
				<p class="help-block">'.$this->l('How many milliseconds should this caption start to show').'</p></div></div>
				
				<div class="form-group "><label class="control-label col-lg-3 ">'.$this->l('Incom animation:').'</label>
				<div class="col-lg-9"><select name="content[incomanimation]">';
				foreach($this->incomAnimation as $key=>$animation)
				{
					$string_caption .= '<option value="'.$key.'" '.($content && $content->incomanimation == ''.$key.'' ? "selected=selected" : "").'>'.$animation.'</option>';
				}
				$string_caption .= '</select>
				<p class="help-block">'.$this->l('Animation incoming caption').'</p></div></div>
				
				<div class="form-group "><label class="control-label col-lg-3 ">'.$this->l('Outgo animation:').'</label>
				<div class="col-lg-9"><select name="content[outgoanimation]">';
				foreach($this->outgoAnimation as $key=>$animation)
				{
					$string_caption .= '<option value="'.$key.'" '.($content && $content->outgoanimation == ''.$key.'' ? "selected=selected" : "").'>'.$animation.'</option>';
				}
				$string_caption .= '</select>
				<p class="help-block">'.$this->l('Animation outgoing caption').'</p></div></div>
				
				<div class="form-group "><label class="control-label col-lg-3 ">'.$this->l('Easing:').'</label>
				<div class="col-lg-9"><select name="content[easing]">';
				foreach($this->easing as $e)
				{
					$string_caption .= '<option value="'.$e.'" '.($content && $content->easing == ''.$e.'' ? "selected=selected" : "").'>'.$e.'</option>';
				}
				$string_caption .= '</select>
				<p class="help-block">'.$this->l('Special Easing effect of the animation').'</p></div></div>
				
				<div class="form-group "><label class="control-label col-lg-3 ">'.$this->l('Endeasing:').'</label>
				<div class="col-lg-9"><select name="content[endeasing]">';
				foreach($this->easing as $e)
				{
					$string_caption .= '<option value="'.$e.'" '.($content && $content->endeasing == ''.$e.'' ? "selected=selected" : "").'>'.$e.'</option>';
				}
				$string_caption .= '</select>
				<p class="help-block">'.$this->l('Special easing effect of the animation').'</p></div></div>
				
				<div class="form-group "><label class="control-label col-lg-3 ">'.$this->l('Hide under width:').'</label><div class="col-lg-9"><input type="checkbox" name="content[hideunderwidth]" '.($content && isset($content->hideunderwidth) ? "checked=checked" : "").'/>
				<p class="help-block">'.$this->l('Hide Caption at mobile size').'</p></div></div>
				<div style="margin-left:150px">
				<input class="btn btn-default" type="submit" '.($content ? '' : 'onclick="$.fancybox.close();"').' name="submitAddCaption" value="'.($content ? $this->l('Save Caption') : $this->l('Add Caption')).'"/>
				</div>';
		return $string_caption;		
	}
	private function _displayAddForm()
	{
		$this->context->controller->addCss($this->_path.'css/admin/tab.css', 'all');
		$this->context->controller->addCss($this->_path.'css/admin/colorpicker.css', 'all');
		$this->context->controller->addJS($this->_path.'js/admin/tab.js');
		$this->context->controller->addJs($this->_path.'js/admin/colorpicker.js');
		$this->context->controller->addJs($this->_path.'js/admin/eye.js');
		$this->context->controller->addJs($this->_path.'js/admin/utils.js');
		$this->context->controller->addJs($this->_path.'js/admin/custom.js');
		
		$this->context->controller->addJQueryPlugin('fancybox');
		global $currentIndex, $cookie;
	 	// Language 
		$languages = Language::getLanguages(false);
	 	$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
		$divLangName = 'captiondiv¤video_typediv¤video_iddiv¤imagecaptiondiv¤url';
		
		// TinyMCE
		$iso = Language::getIsoById((int)($cookie->id_lang));
		$isoTinyMCE = (file_exists(_PS_ROOT_DIR_.'/js/tiny_mce/langs/'.$iso.'.js') ? $iso : 'en');
		$ad = dirname($_SERVER["PHP_SELF"]);
		$this->_html .=  '
		<script type="text/javascript">	
		var iso = \''.$isoTinyMCE.'\' ;
		var pathCSS = \''._THEME_CSS_DIR_.'\' ;
		var ad = \''.$ad.'\' ;
		</script>
		<script type="text/javascript" src="'.__PS_BASE_URI__.'js/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript" src="'.__PS_BASE_URI__.'js/tinymce.inc.js"></script>
		<script type="text/javascript">id_language = Number('.$defaultLanguage.');</script>';
		// Form
		
		$this->_html .= '<div class="panel clearfix">
		<h3><i class="icon-cogs"></i> '.$this->l('Add New Slider').'</h3>
		<div class="productTabs col-lg-2">
		<ul class="list-group">
			<a class="list-group-item active" id="general" href="javascript:void(0);">'.$this->l('General').'</a>
			<a class="list-group-item" id="animations" href="javascript:void(0);">'.$this->l('Animation').'</a>
			<a class="list-group-item" id="caption" href="javascript:void(0);">'.$this->l('Caption').'</a>
		</ul>
		</div>
			<form id="csslider_add" method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" enctype="multipart/form-data"  class="form-horizontal col-lg-10 panel">
			<fieldset class="general tab-manager plblogtabs">
				<div class="form-group">
					<label class="control-label col-lg-3">'.$this->l('Background:').'</label>
					<div class="col-lg-9">
						<input type="radio" checked="checked" onclick="return showBackground(\'image\')" name="image[type]" value="image"/><label class="radioCheck">'.$this->l('Image').'</label>
						<input type="radio" onclick="return showBackground(\'color\')" name="image[type]" value="color"/><label class="radioCheck">'.$this->l('Color').'</label>
						<input type="radio" onclick="return showBackground(\'transparent\')" name="image[type]" value="transparent"/><label class="radioCheck">'.$this->l('Transparent').'</label>
					</div></div>
						<div class="animation form-group" id="animation_image">';
						$this->_html .= '<label class="control-label col-lg-3">'.$this->l('Select a filed:').'</label>
						<div class="col-lg-6">
							<input id="image" type="file" name="image[value]" class="hide" />
							<div class="dummyfile input-group">
								<span class="input-group-addon"><i class="icon-file"></i></span>
								<input id="image-name" type="text" class="disabled" name="image[value]" readonly />
								<span class="input-group-btn">
									<button id="image-selectbutton" type="button" name="submitAddAttachments" class="btn btn-default">
										<i class="icon-folder-open"></i> '.$this->l('Choose a file').'
									</button>
								</span>
							</div>
						</div>';
						$this->_html .= '<script>
							$(document).ready(function(){
								$("#image-selectbutton").click(function(e){
									$("#image").trigger("click");
								});
								$("#image").change(function(e){
									var val = $(this).val();
									var file = val.split(/[\\/]/);
									$("#image-name").val(file[file.length-1]);
								});
							});
						</script>
						';							
						$this->_html .= '						
							<div class="clear"></div>
						
						</div>
						<div class="animation form-group" id="animation_color" style="display:none">
							<label class="control-label col-lg-3"><sup> *</sup>'.$this->l('Select a color:').'</label>
							<div class="col-lg-9">
								<div class="col-lg-6"><input id="result_animation_colobg" name="image[value]" type="text"/></div>
								<div class="col-lg-2"><span id="animation_colobg" style="cursor:pointer">
								<img src="'._PS_ADMIN_IMG_.'color.png"/>
								</span></div>
							</div>
						</div>
									
				<div class="form-group">
					<label class="control-label col-lg-3">'.$this->l('URL:').'</label>';
					foreach ($languages as $language){
						if (count($languages)>1)
						{
							$this->_html .= '<div class="translatable-field lang-'.$language['id_lang'].'"'; if ($language['id_lang'] != $defaultLanguage){
							$this->_html .= 'style="display:none"';} $this->_html .= '>';
						}
						$url = 'url_'.$language['id_lang'];
						
						$this->_html .= '
							<div class="col-lg-7">
								<div id="urldiv">
									<input type="text" name="url_'.$language['id_lang'].'" value="'.(Tools::getValue($url) ? Tools::getValue($url) : '#').'" size="55" />
								</div>
								<div class="clear"></div>
							</div>
						';
						if (count($languages)>1)
						{
							$this->_html .= '<div class="col-lg-2">
							<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.
								$language['iso_code'].'
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">';
								foreach ($languages as $lang){
								$this->_html .= '<li><a href="javascript:hideOtherLanguage('.$lang['id_lang'].');" tabindex="-1">'.$lang['name'].'</a></li>';
								}
							$this->_html .= '</ul>
								</div>';
						}
						if (count($languages)>1)
						{
							$this->_html .= '</div>';
						}
					}
					
				$this->_html .= '</div><div class="form-group">
					<label class="control-label col-lg-3">'.$this->l('Displayed:').'</label>
					<div class="col-lg-9">
						<div id="activediv" style="float: left;">
							<input type="radio" name="display" value="1"'.(Tools::getValue('display',1) ? 'checked="checked"' : '').' />
							<label class="t"><img src="'._PS_ADMIN_IMG_.'enabled.gif" alt="Enabled" title="Enabled" /></label>
							<input type="radio" name="display" value="0"'.(Tools::getValue('display',1) ? '' : 'checked="checked"').' />
							<label class="t"><img src="'._PS_ADMIN_IMG_.'disabled.gif" alt="Disabled" title="Disabled" /></label>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</fieldset>
			<fieldset class="animations tab-manager plblogtabs"><div class="form-group"><label class="control-label col-lg-3">
				'.$this->l('Transition').'</label><div class="col-lg-9"><select name="animation[transitions]">';
				foreach ($this->transitions as $transition)
				{
					$this->_html .= '<option value='.$transition.'>'.$transition.'</option>';
				}
				$this->_html .= '</select><p class="help-block">'.$this->l('The appearance transition of this slide.').'</p></div></div>
				<div class="form-group">
				<label class="control-label col-lg-3">'.$this->l('Slot Amount').'</label><div class="col-lg-9"><input type="text" name="animation[slotamount]" value="7"/><p class="help-block">'.$this->l('The number of slots or boxes the slide is divided into. If you use boxfade, over 7 slots can be juggy.').'</p></div></div>
				
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Master Speed').'</label><div class="col-lg-9"><input type="text" name="animation[masterspeed]" value="300"/><p class="help-block">'.$this->l('Set the Speed of the Slide Transition. Default 300, min:100 max:2000.').'</p></div></div>
				
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Target').'</label><div class="col-lg-9">
				<select name="animation[target]">
					<option value="_self">'.$this->l('_self').'</option>
					<option value="_blank">'.$this->l('_blank').'</option>
				</select>
				<p class="help-block">'.$this->l('A link target (like _self or _blank)').'</p></div>
				
				<label class="control-label col-lg-3">'.$this->l('Delay').'</label><div class="col-lg-9"><input type="text" name="animation[delay]" value="9400"/><p class="help-block">'.$this->l('A new delay value for the Slide. If no delay defined per slide, the delay defined via Options ( 9000 ms) will be used.').'</p></div></div>
				
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Enable Link').'</label><div class="col-lg-9"><div>
						<input type="radio" name="animation[enablelink]" value="1" checked="checked"/>
						<label class="t"><img src="'._PS_ADMIN_IMG_.'enabled.gif" alt="Enabled" title="Enabled" /></label>
						<input type="radio" name="animation[enablelink]" value="0"/>
						<label class="t"><img src="'._PS_ADMIN_IMG_.'disabled.gif" alt="Disabled" title="Disabled" /></label>
				</div></div></div>
				
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Enable Full Width Video').'</label><div class="col-lg-9"><div>
						<input type="radio" name="animation[enablefullvideo]" value="1" checked="checked" />
						<label class="t"><img src="'._PS_ADMIN_IMG_.'enabled.gif" alt="Enabled" title="Enabled" /></label>
						<input type="radio" name="animation[enablefullvideo]" value="0"/>
						<label class="t"><img src="'._PS_ADMIN_IMG_.'disabled.gif" alt="Disabled" title="Disabled" /></label>
				</div></div></div>
			</fieldset>
			<fieldset class="caption tab-manager plblogtabs">
			<div>'.$this->l('You have to save slider to add caption.').'</div>
			</fieldset>
			<br/>
			<center><button class="btn btn-default" type="submit" name="submitAddSliderAndBack" value=""><i class="process-icon-save"></i>'.$this->l('Save and back list').'</button>
			<button class="btn btn-default" type="submit" name="submitAddSliderAndContinue" value="1"><i class="process-icon-save"></i>'.$this->l('Save and add caption').'</button>
			<button class="btn btn-default" type="submit" name="cancelAddSlider" value="1" ><i class="process-icon-cancel"></i>'.$this->l('Cancel').'</button></center>
			
			</form>
			<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'"><img src="'._PS_ADMIN_IMG_.'arrow2.gif" alt="" />'.$this->l('Back to list').'</a>
			</div>
			';
		$this->_html.='<script type="text/javascript">
			function showBackground(classActive)
			{
				$(".animation").hide();
				$("#animation_" + classActive + "").show("slow");
			}
			$(document).ready(function() {
				$("a.captionfancybox").fancybox({
				autoDimensions : false,
				width : 650,
				height : 600
				});
			});
			
			(function($){var initLayout = function() {
				colorEvent("animation_colobg");};
				EYE.register(initLayout, \'init\');
			})(jQuery)
		</script>';
	}
	
	public function ajaxCallLoadCaption($id_caption)
	{
		
		$caption = new Caption($id_caption);
		$slider = new SliderClass($caption->id_caption);
		$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
		$languages = Language::getLanguages(false);
		$content = json_decode($caption->content);
		$divLangName = 'captiondiv¤video_typediv¤video_iddiv¤imagecaptiondiv';
		$html = '<div class="form-group">
				<label class="control-label col-lg-3"></label>
				<div class="col-lg-9">
				<input type="hidden" name="id_caption" value="'.$caption->id_caption.'"/>
				<input type="radio" name="addCaption" '.($content->type_caption == "textcaption" ? "checked=checked" : "" ).' onclick="$(\'.csCaption\').hide();$(\'.textcaption\').show();"  value="textcaption" checked="checked"/><label style="float:none">'.$this->l('Text Caption').'</label>
				<input type="radio" name="addCaption" '.($content->type_caption == "imagecaption" ? "checked=checked" : "" ).' onclick="$(\'.csCaption\').hide();$(\'.imagecaption\').show();" value="imagecaption"/><label style="float:none">'.$this->l('Image Caption').'</label>
				<input type="radio" name="addCaption" '.($content->type_caption == "videocaption" ? "checked=checked" : "" ).' onclick="$(\'.csCaption\').hide();$(\'.videocaption\').show();" value="videocaption"/><label style="float:none">'.$this->l('Video Caption').'</label>
				</div></div>
				<div class="textcaption csCaption form-group" '.($content->type_caption == "textcaption" ? "" : "style='display:none'" ).'>
				<input type="hidden" name="layer" value="'.$caption->layer.'"/>
				<label class="control-label col-lg-3">'.$this->l('Text:').'</label>
				';
					foreach ($languages as $language)
					{
						if (count($languages)>1)
						{
							$html .= '<div class="translatable-field lang-'.$language['id_lang'].'"'; if ($language['id_lang'] != $defaultLanguage){
							$html .= 'style="display:none"';} $html .= '>';
						}
						$html .= '<div class="col-lg-6">
							<textarea class="rte" name="textcaption['.$language['id_lang'].']" id="caption_'.$language['id_lang'].'" cols="50" rows="5">'.(isset($content->text->$language['id_lang']) ? $content->text->$language['id_lang'] : '').'</textarea>
						</div>';
						if (count($languages)>1)
						{
							$html .= '<div class="col-lg-2">
							<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.
								$language['iso_code'].'
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">';
								foreach ($languages as $lang){
								$html .= '<li><a href="javascript:hideOtherLanguage('.$lang['id_lang'].');" tabindex="-1">'.$lang['name'].'</a></li>';
								}
							$html .= '</ul>
								</div>';
						}
						if (count($languages)>1)
						{
							$html .= '</div>';
						}
					}
					$html .= '</div>
				<div class="imagecaption csCaption form-group" '.($content->type_caption == "imagecaption" ? "" : "style='display:none'" ).'>
				<label class="control-label col-lg-3">'.$this->l('Image:').'</label>
				';
					foreach ($languages as $language)
					{
						if (count($languages)>1)
						{
							$html .= '<div class="translatable-field lang-'.$language['id_lang'].'"'; if ($language['id_lang'] != $defaultLanguage){
							$html .= 'style="display:none"';} $html .= '>';
						}
						$html .= '<div class="col-lg-6">
							<input id="imagecaption_'.$language['id_lang'].'" type="file" name="imagecaption_'.$language['id_lang'].'" class="hide" />
							<div class="dummyfile input-group">
								<span class="input-group-addon"><i class="icon-file"></i></span>
								<input id="imagecaption_'.$language['id_lang'].'-name" type="text" class="disabled" name="filename" readonly />
								<span class="input-group-btn">
									<button id="imagecaption_'.$language['id_lang'].'-selectbutton" type="button" name="submitAddAttachments" class="btn btn-default">
										<i class="icon-folder-open"></i> '.$this->l('Choose a file').'
									</button>
								</span>
							</div>
						</div>';
						if (count($languages)>1)
						{
							$html .= '<div class="col-lg-2">
							<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.
								$language['iso_code'].'
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">';
								foreach ($languages as $lang){
								$html .= '<li><a href="javascript:hideOtherLanguage('.$lang['id_lang'].');" tabindex="-1">'.$lang['name'].'</a></li>';
								}
							$html .= '</ul>
								</div>';
						}
						if (count($languages)>1)
						{
							$html .= '</div>';
						}
						$html .= '<script>
							$(document).ready(function(){
								$("#imagecaption_'.$language['id_lang'].'-selectbutton").click(function(e){
									$("#imagecaption_'.$language['id_lang'].'").trigger("click");
								});
								$("#imagecaption_'.$language['id_lang'].'").change(function(e){
									var val = $(this).val();
									var file = val.split(/[\\/]/);
									$("#imagecaption_'.$language['id_lang'].'-name").val(file[file.length-1]);
								});
							});
						</script>
						';
					}
				$html .= '</div>
				<div class="videocaption csCaption" '.($content->type_caption == "videocaption" ? "" : "style='display:none'" ).'>
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Video Type:').'</label>';
				foreach ($languages as $language)
				{
					if (count($languages)>1)
					{
						$html .= '<div class="translatable-field lang-'.$language['id_lang'].'"'; if ($language['id_lang'] != $defaultLanguage){
						$html .= 'style="display:none"';} $html .= '>';
					}
					$html .= '<div class="col-lg-6">
						<select name="videocaption_type['.$language['id_lang'].']">';
						if(isset($content->video_type->$language['id_lang']) && $slider->video_type->$language['id_lang']==1) $checkedy='selected="selected"';else $checkedy='';
						if(isset($slider->video_type->$language['id_lang']) && $slider->video_type->$language['id_lang']==2) $checkedv='selected="selected"';else $checkedv='';
					$html .= '<option value="1" '.$checkedy.'>Youtube</option>';
					$html .= '<option value="2" '.$checkedv.'>Vimeo</option>';
					$html .= '
						</select>
					</div>';
					if (count($languages)>1)
					{
						$html .= '<div class="col-lg-2">
						<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.
							$language['iso_code'].'
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">';
							foreach ($languages as $lang){
							$html .= '<li><a href="javascript:hideOtherLanguage('.$lang['id_lang'].');" tabindex="-1">'.$lang['name'].'</a></li>';
							}
						$html .= '</ul>
							</div>';
					}
					if (count($languages)>1)
					{
						$html .= '</div>';
					}
				}
				$html .= '
				<div class="clear"></div></div><div class="form-group">
				<label class="control-label col-lg-3">'.$this->l('Video ID:').'</label>';
				foreach ($languages as $language)
				{
					if (count($languages)>1)
					{
						$html .= '<div class="translatable-field lang-'.$language['id_lang'].'"'; if ($language['id_lang'] != $defaultLanguage){
						$html .= 'style="display:none"';} $html .= '>';
					}
					$html .= '<div class="col-lg-6">
						<input type="text" name="videocaption_text['.$language['id_lang'].']" value="'.(isset($content->type_id->$language['id_lang']) ? $content->type_id->$language['id_lang'] : '').'" size="30" />					
					</div>';
					if (count($languages)>1)
					{
						$html .= '<div class="col-lg-2">
						<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.
							$language['iso_code'].'
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">';
							foreach ($languages as $lang){
							$html .= '<li><a href="javascript:hideOtherLanguage('.$lang['id_lang'].');" tabindex="-1">'.$lang['name'].'</a></li>';
							}
						$html .= '</ul>
							</div>';
					}
					if (count($languages)>1)
					{
						$html .= '</div>';
					}
				}
				$captions = $slider->getCaption();
			
				$html .= '
				</div></div>
				<div class="clear"></div>'.$this->stringCaption($content).'';
		return $html;
	}
	
	private function _displayUpdateForm()
	{
		$this->context->controller->addCss($this->_path.'css/admin/tab.css', 'all');
		$this->context->controller->addCss($this->_path.'css/admin/colorpicker.css', 'all');
		$this->context->controller->addJS($this->_path.'js/admin/tab.js');
		$this->context->controller->addJs($this->_path.'js/admin/colorpicker.js');
		$this->context->controller->addJs($this->_path.'js/admin/eye.js');
		$this->context->controller->addJs($this->_path.'js/admin/utils.js');
		$this->context->controller->addJs($this->_path.'js/admin/custom.js');
		$this->context->controller->addJQueryPlugin('fancybox');
		global $currentIndex, $cookie;
		//get Slider
		if (!Tools::getValue('id_csslider'))
		{
			$this->_html .= '<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'"><img src="'._PS_ADMIN_IMG_.'arrow2.gif" alt="" />'.$this->l('Back to list').'</a>';
			return;
		}
		$this->context = Context::getContext();
		$id = (int)Context::getContext()->shop->id;
		$id_shop = $id ? $id: Configuration::get('PS_SHOP_DEFAULT');
		$id_lang = $this->context->language->id;
		$slider = new SliderClass((int)Tools::getValue('id_csslider'));
	 	// Language 
	 	$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
		$languages = Language::getLanguages(false);
		$divLangName = 'captiondiv¤video_typediv¤video_iddiv¤imagecaptiondiv';

		// TinyMCE
		$iso = Language::getIsoById((int)($cookie->id_lang));
		$isoTinyMCE = (file_exists(_PS_ROOT_DIR_.'/js/tiny_mce/langs/'.$iso.'.js') ? $iso : 'en');
		$ad = dirname($_SERVER["PHP_SELF"]);
		$this->_html .=  '
		<script type="text/javascript">	
		var iso = \''.$isoTinyMCE.'\' ;
		var pathCSS = \''._THEME_CSS_DIR_.'\' ;
		var ad = \''.$ad.'\' ;
		</script>
		<script type="text/javascript" src="'.__PS_BASE_URI__.'js/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript" src="'.__PS_BASE_URI__.'js/tinymce.inc.js"></script>
		<script type="text/javascript">id_language = Number('.$defaultLanguage.');</script>';
		// Form
		$this->_html .= '<div class="panel clearfix">
		<h3><i class="icon-cogs"></i> '.$this->l('Edit Slider').'</h3>
		<div class="productTabs col-lg-2">
		<ul class="list-group">
			<a class="list-group-item active" id="general" href="javascript:void(0);">'.$this->l('General').'</a>
			<a class="list-group-item" id="animations" href="javascript:void(0);">'.$this->l('Animation').'</a>
			<a class="list-group-item" id="caption" href="javascript:void(0);">'.$this->l('Caption').'</a>
		</ul>
		</div>
			<form id="csslider_add" method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" enctype="multipart/form-data" class="defaultForm form-horizontal col-lg-10 panel">
			<input type="hidden" name="id_csslider" value="'.$slider->id_csslider.'"/>
			
			<fieldset class="general tab-manager plblogtabs">
				<div class="form-group">
					<label class="control-label col-lg-3">'.$this->l('Background:').'</label>
					<div class="col-lg-9">
						<input type="radio" '.($slider->image->type == "image" ? "checked=checked" : '').'  onclick="return showBackground(\'image\')" name="image[type]" value="image"/><label class="radioCheck">'.$this->l('Image').'</label>
						<input type="radio" '.($slider->image->type == "color" ? "checked=checked" : '').'  onclick="return showBackground(\'color\')" name="image[type]" value="color"/><label class="radioCheck">'.$this->l('Color').'</label>
						<input type="radio" '.($slider->image->type == "transparent" ? "checked=checked" : '').'  onclick="return showBackground(\'transparent\')" name="image[type]" value="transparent"/><label class="radioCheck">'.$this->l('Transparent').'</label>
					</div>
				</div>
				<div class="animation form-group" id="animation_image" '.($slider->image->type == "image" ? '' : 'style="display:none"').'>';
					
					
					if($slider->image->type == "image")
					$this->_html .= '
					<input type="hidden" name="imagehidden" value="'.$slider->image->value.'"/>
					<label class="control-label col-lg-3">'.$this->l('Select a filed:').'</label><div class="col-lg-6">
						<input id="image" type="file" name="image[value]" class="hide" />
						<div class="dummyfile input-group">
							<span class="input-group-addon"><i class="icon-file"></i></span>
							<input id="image-name" type="text" class="disabled" name="image[value]" value="'.$slider->image->value.'" readonly />
							<span class="input-group-btn">
								<button id="image-selectbutton" type="button" name="submitAddAttachments" class="btn btn-default">
									<i class="icon-folder-open"></i> '.$this->l('Choose a file').'
								</button>
							</span>
						</div>
						</div>';					
					
					$thumb_url = _PS_BASE_URL_._MODULE_DIR_.$this->name.'/images/thumbs/'.$slider->image->value;
					$this->_html.= ($slider->image->type == "image" ? '<p><img src="'.$thumb_url.'" alt="" title="" style="height:45px;width:45px;"/></p>' : '') ;
						$this->_html.= '<div class="clear"></div>
					</div>';
					
					$this->_html .= '<script>
						$(document).ready(function(){
							$("#image-selectbutton").click(function(e){
								$("#image").trigger("click");
							});
							$("#image").change(function(e){
								var val = $(this).val();
								var file = val.split(/[\\/]/);
								$("#image-name").val(file[file.length-1]);
							});
						});
					</script>
					';	
				
				$this->_html .= '
				
				<div class="animation form-group" id="animation_color" '.($slider->image->type == "color" ? '' : 'style="display:none"').'>
					<label class="control-label col-lg-3"><sup> *</sup>'.$this->l('Select a color:').'</label>
					<div class="col-lg-9">
						<div class="col-lg-6"><input '.($slider->image->type == 'color' ? 'style="background-color:'.$slider->image->value.'"' : '').' value="'.($slider->image->type == 'color' ? $slider->image->value : '').'" id="result_animation_colobg" name="image[value]" type="text"/></div>
						<div class="col-lg-2"><span id="animation_colobg" style="cursor:pointer">
						<img src="'._PS_ADMIN_IMG_.'color.png"/>
						</span></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">'.$this->l('URL:').'</label>';					
					foreach ($languages as $language){
						if (count($languages)>1)
						{
							$this->_html .= '<div class="translatable-field lang-'.$language['id_lang'].'"'; if ($language['id_lang'] != $defaultLanguage){
							$this->_html .= 'style="display:none"';} $this->_html .= '>';
						}
						$this->_html .= '
							<div class="col-lg-7">
								<div id="urldiv">
									<input type="text" name="url_'.$language['id_lang'].'" value="'.($slider->url ? $slider->url[$language['id_lang']] : '#').'" size="55" />
								</div>
								<div class="clear"></div>
							</div>
						';
						if (count($languages)>1)
						{
							$this->_html .= '<div class="col-lg-2">
							<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.
								$language['iso_code'].'
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">';
								foreach ($languages as $lang){
								$this->_html .= '<li><a href="javascript:hideOtherLanguage('.$lang['id_lang'].');" tabindex="-1">'.$lang['name'].'</a></li>';
								}
							$this->_html .= '</ul>
								</div>';
						}
						if (count($languages)>1)
						{
							$this->_html .= '</div>';
						}
					}
				$this->_html .= '</div>
				<div class="form-group">
					<label class="control-label col-lg-3">'.$this->l('Displayed:').'</label>
					<div class="col-lg-9">
						<div id="activediv" style="float: left;">
							<input type="radio" name="display" value="1"'.($slider->display ? 'checked="checked"' : '').' />
							<label class="t"><img src="'._PS_ADMIN_IMG_.'enabled.gif" alt="Enabled" title="Enabled" /></label>
							<input type="radio" name="display" value="0"'.($slider->display ? '' : 'checked="checked"').' />
							<label class="t"><img src="'._PS_ADMIN_IMG_.'disabled.gif" alt="Disabled" title="Disabled" /></label>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</fieldset>
			<fieldset class="animations tab-manager plblogtabs"><div class="form-group"><label class="control-label col-lg-3">
				'.$this->l('Transition').'</label><div class="col-lg-9"><select name="animation[transitions]">';
				foreach ($this->transitions as $transition)
				{
					$this->_html .= '<option value='.$transition.' '.($slider->animation->transitions == ''.$transition.'' ? "selected=selected" : '').'>'.$transition.'</option>';
				}
				$this->_html .= '</select><p class="help-block">'.$this->l('The appearance transition of this slide.').'</p></div></div>
				
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Slot Amount').'</label><div class="col-lg-9"><input type="text" name="animation[slotamount]" value="'.($slider->animation->slotamount ? $slider->animation->slotamount : '').'"/><p class="help-block">'.$this->l('The number of slots or boxes the slide is divided into. If you use boxfade, over 7 slots can be juggy.').'</p></div></div>
			
				
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Master Speed').'</label><div class="col-lg-9"><input type="text" name="animation[masterspeed]" value="'.($slider->animation->masterspeed ? $slider->animation->masterspeed : '').'"/><p class="help-block">'.$this->l('Set the Speed of the Slide Transition. Default 300, min:100 max:2000.').'</p></div></div>
				
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Target').'</label><div class="col-lg-9">
				<select name="animation[target]">
					<option value="_self" '.($slider->animation->target == "_self" ? "selected=selected" : '').'>'.$this->l('_self').'</option>
					<option value="_blank" '.($slider->animation->target == "_blank" ? "selected=selected" : '').'>'.$this->l('_blank').'</option>
				</select>
				<p class="help-block">'.$this->l('A link target (like _self or _blank)').'</p></div></div>
				
				
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Delay').'</label><div class="col-lg-9"><input type="text" name="animation[delay]" value="'.($slider->animation->delay ? $slider->animation->delay : '').'"/><p class="help-block">'.$this->l('A new delay value for the Slide. If no delay defined per slide, the delay defined via Options ( 9000 ms) will be used.').'</p></div></div>
				
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Enable Link').'</label><div class="col-lg-9"><div>
						<input type="radio" name="animation[enablelink]" value="1"'.($slider->animation->enablelink ? 'checked="checked"' : '').' />
						<label class="t"><img src="'._PS_ADMIN_IMG_.'enabled.gif" alt="Enabled" title="Enabled" /></label>
						<input type="radio" name="animation[enablelink]" value="0"'.($slider->animation->enablelink ? '' : 'checked="checked"').'/>
						<label class="t"><img src="'._PS_ADMIN_IMG_.'disabled.gif" alt="Disabled" title="Disabled" /></label>
				</div></div></div>
				
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Enable Full Width Video').'</label><div class="col-lg-9"><div>
						<input type="radio" name="animation[enablefullvideo]" value="1" '.($slider->animation->enablefullvideo ? 'checked="checked"' : '').'/>
						<label class="t"><img src="'._PS_ADMIN_IMG_.'enabled.gif" alt="Enabled" title="Enabled" /></label>
						<input type="radio" name="animation[enablefullvideo]" value="0" '.($slider->animation->enablefullvideo ? '' : 'checked="checked"').'/>
						<label class="t"><img src="'._PS_ADMIN_IMG_.'disabled.gif" alt="Disabled" title="Disabled" /></label>
				</div></div></div>
			</fieldset>
		<fieldset class="caption tab-manager plblogtabs">
				<div class="resultcaption col-lg-8">
				<h3>'.$this->l('Add Caption').'</h3>
				<div class="form-group">
				<label class="control-label col-lg-3"></label>
				<div class="col-lg-9">
				<input type="radio" name="addCaption" onclick="$(\'.csCaption\').hide();$(\'.textcaption\').show();"  value="textcaption" checked="checked"/><label style="float:none">'.$this->l('Text Caption').'</label>
				<input type="radio" name="addCaption" onclick="$(\'.csCaption\').hide();$(\'.imagecaption\').show();" value="imagecaption"/><label style="float:none">'.$this->l('Image Caption').'</label>
				<input type="radio" name="addCaption" onclick="$(\'.csCaption\').hide();$(\'.videocaption\').show();" value="videocaption"/><label style="float:none">'.$this->l('Video Caption').'</label>
				</div></div>
				<div class="textcaption csCaption form-group">
				<input type="hidden" name="layer" value="'.Caption::getNextLayer().'"/>
				<label class="control-label col-lg-3">'.$this->l('Text:').'</label>
				';
					foreach ($languages as $language)
					{
						if (count($languages)>1)
						{
							$this->_html .= '<div class="translatable-field lang-'.$language['id_lang'].'"'; if ($language['id_lang'] != $defaultLanguage){
							$this->_html .= 'style="display:none"';} $this->_html .= '>';
						}
						$this->_html .= '<div class="col-lg-6">
							<textarea class="rte" name="textcaption['.$language['id_lang'].']" id="caption_'.$language['id_lang'].'" cols="50" rows="5">'.Tools::getValue('caption_'.$language['id_lang']).'</textarea>
						</div>';
						if (count($languages)>1)
						{
							$this->_html .= '<div class="col-lg-2">
							<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.
								$language['iso_code'].'
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">';
								foreach ($languages as $lang){
								$this->_html .= '<li><a href="javascript:hideOtherLanguage('.$lang['id_lang'].');" tabindex="-1">'.$lang['name'].'</a></li>';
								}
							$this->_html .= '</ul>
								</div>';
						}
						if (count($languages)>1)
						{
							$this->_html .= '</div>';
						}						
					}
						
					$this->_html .= '</div>
				<div class="imagecaption csCaption form-group" style="display:none">
				<label class="control-label col-lg-3">'.$this->l('Image:').'</label>
				';
					foreach ($languages as $language)
					{
						if (count($languages)>1)
						{
							$this->_html .= '<div class="translatable-field lang-'.$language['id_lang'].'"'; if ($language['id_lang'] != $defaultLanguage){
							$this->_html .= 'style="display:none"';} $this->_html .= '>';
						}
						$this->_html .= '<div class="col-lg-6">
							<input id="imagecaption_'.$language['id_lang'].'" type="file" name="imagecaption_'.$language['id_lang'].'" class="hide" />
							<div class="dummyfile input-group">
								<span class="input-group-addon"><i class="icon-file"></i></span>
								<input id="imagecaption_'.$language['id_lang'].'-name" type="text" class="disabled" name="filename" readonly />
								<span class="input-group-btn">
									<button id="imagecaption_'.$language['id_lang'].'-selectbutton" type="button" name="submitAddAttachments" class="btn btn-default">
										<i class="icon-folder-open"></i> '.$this->l('Choose a file').'
									</button>
								</span>
							</div>
						</div>';
						if (count($languages)>1)
						{
							$this->_html .= '<div class="col-lg-2">
							<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.
								$language['iso_code'].'
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">';
								foreach ($languages as $lang){
								$this->_html .= '<li><a href="javascript:hideOtherLanguage('.$lang['id_lang'].');" tabindex="-1">'.$lang['name'].'</a></li>';
								}
							$this->_html .= '</ul>
								</div>';
						}
						if (count($languages)>1)
						{
							$this->_html .= '</div>';
						}
						$this->_html .= '<script>
							$(document).ready(function(){
								$("#imagecaption_'.$language['id_lang'].'-selectbutton").click(function(e){
									$("#imagecaption_'.$language['id_lang'].'").trigger("click");
								});
								$("#imagecaption_'.$language['id_lang'].'").change(function(e){
									var val = $(this).val();
									var file = val.split(/[\\/]/);
									$("#imagecaption_'.$language['id_lang'].'-name").val(file[file.length-1]);
								});
							});
						</script>
						';
					}
				$this->_html .= '</div>
				<div class="videocaption csCaption" style="display:none;">
				<div class="form-group"><label class="control-label col-lg-3">'.$this->l('Video Type:').'</label>';
				foreach ($languages as $language)
				{
					if (count($languages)>1)
					{
						$this->_html .= '<div class="translatable-field lang-'.$language['id_lang'].'"'; if ($language['id_lang'] != $defaultLanguage){
						$this->_html .= 'style="display:none"';} $this->_html .= '>';
					}
					$this->_html .= '<div class="col-lg-6">
						<select name="videocaption_type['.$language['id_lang'].']">';
					$this->_html .= '<option value="1" selected="selected">Youtube</option>';
					$this->_html .= '<option value="2">Vimeo</option>';
					$this->_html .= '
						</select>
					</div>';
					if (count($languages)>1)
					{
						$this->_html .= '<div class="col-lg-2">
						<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.
							$language['iso_code'].'
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">';
							foreach ($languages as $lang){
							$this->_html .= '<li><a href="javascript:hideOtherLanguage('.$lang['id_lang'].');" tabindex="-1">'.$lang['name'].'</a></li>';
							}
						$this->_html .= '</ul>
							</div>';
					}
					if (count($languages)>1)
					{
						$this->_html .= '</div>';
					}	
				}
				$this->_html .= '
				</div><div class="form-group">
			<label class="control-label col-lg-3">'.$this->l('Video ID:').'</label>';
				foreach ($languages as $language)
				{
					if (count($languages)>1)
					{
						$this->_html .= '<div class="translatable-field lang-'.$language['id_lang'].'"'; if ($language['id_lang'] != $defaultLanguage){
						$this->_html .= 'style="display:none"';} $this->_html .= '>';
					}
					$this->_html .= '<div class="col-lg-6">
						<input type="text" name="videocaption_text['.$language['id_lang'].']" value="'.Tools::getValue('video_id_'.$language['id_lang']).'" size="30" />
					</div>';
					if (count($languages)>1)
					{
						$this->_html .= '<div class="col-lg-2">
						<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">'.
							$language['iso_code'].'
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">';
							foreach ($languages as $lang){
							$this->_html .= '<li><a href="javascript:hideOtherLanguage('.$lang['id_lang'].');" tabindex="-1">'.$lang['name'].'</a></li>';
							}
						$this->_html .= '</ul>
							</div>';
					}
					if (count($languages)>1)
					{
						$this->_html .= '</div>';
					}	
				}
				$captions = $slider->getCaption();
				$this->_html .= '
				</div></div>
				<div class="clear"></div>'.$this->stringCaption().'</div>
				<div class="col-lg-4"><h3>'.$this->l('List caption').'</h3>
				<script type="text/javascript">
					function ajaxloadCaption(idcaption)
					{
						$.ajax({
						type: \'post\',
						url: \''.__PS_BASE_URI__.'\' + \'modules/csslider/csslider-ajax.php\',
						data: \'&id_caption=\' + idcaption,
						success: function(result) {
							$(".resultcaption").html(result);
						}
						});
					return false;
					};
				</script>
				<table width="100%" class="table" cellspacing="0" cellpadding="0">
				<thead>
				<tr class="nodrag nodrop">
					<th>'.$this->l('Caption').'</th>
					<th class="center">'.$this->l('Content').'</th>
					<th class="center">'.$this->l('Layer').'</th>
					<th class="center">'.$this->l('Edit').'</th>
					<th class="center">'.$this->l('Delete').'</th>
				</tr>
				</thead>
				<tbody>';
				$stringConfirm='onclick="if (!confirm(\' Are you sure that you want to delete item ?\')) return false "';
				if(isset($captions) and !empty($captions))
				{
					static $irow;
					$irow = 0;
					foreach($captions as $caption)
					{
						$content = json_decode($caption['content']);
						$this->_html .= '<tr class="'.($irow++ % 2 ? 'alt_row' : '').'"> 
						<td class="pointer center">'.$irow.'</td>
						<td class="pointer center">';  
						if($content->type_caption == "textcaption")
							$this->_html .= $content->text->$defaultLanguage;
						if($content->type_caption == "imagecaption")
						{
							$image = 'image_'.$defaultLanguage;
							$thumb_url = _PS_BASE_URL_._MODULE_DIR_.$this->name.'/images/captions/'.$content->$image;
							$this->_html .= '<img src="'.$thumb_url.'" alt="" title="" style="height:35px;width:35px;"/>';
						}
						if($content->type_caption == "videocaption")
						{
							if($content->type_video->$defaultLanguage == 1)
								$this->_html .= '<iframe src="http://www.youtube.com/embed/'.$content->type_id->$defaultLanguage.'?hd=1&amp;wmode=opaque&amp;controls=1&amp;showinfo=0" style="height:40px;width:40px;"></iframe>';
							else
								$this->_html .= '<iframe src="http://player.vimeo.com/video/'.$content->type_id->$defaultLanguage.'?title=0&amp;byline=0&amp;portrait=0" style="height:40px;width:40px;"></iframe>';
						}
						
						$this->_html .= '
						</td>
						<td class="pointer center">'.($caption !== end($captions) ? '<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&orderLayerCaption&id_caption='.$caption['id_caption'].'&way=1&layer='.($caption['layer']+1).'"><img src="'._PS_ADMIN_IMG_.'down.gif" alt="'.$this->l('Down').'" /></a>' : '').($caption !== reset($captions) ? '<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&orderLayerCaption&id_caption='.$caption['id_caption'].'&way=0&layer='.($caption['layer']-1).'"><img src="'._PS_ADMIN_IMG_.'up.gif" alt="'.$this->l('Up').'" /></a>' : '').'</td>
						
						<td class="pointer center"><a class="editcaption" href="#" onclick="return ajaxloadCaption('.$caption['id_caption'].')"><i class="icon-edit"></i></a></td>
						
						<td class="pointer center"><a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteCaption&id_caption='.$caption['id_caption'].'\'" '.$stringConfirm.'><i class="icon-trash"></i></a></td>
						
						
						</tr>';
					}
					
					
				}
				$this->_html .= '</tbody>
				</table>
				</div>
			</fieldset>
			<br/>
			<center><button class="btn btn-default" type="submit" name="submitAddSlider" value=""><i class="process-icon-save"></i>'.$this->l('Save').'</button>
			<button class="btn btn-default" type="submit" name="cancelAddSlider" value=""><i class="process-icon-cancel"></i>'.$this->l('Cancel').'</button></center>
			
			</form>
			<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'"><img src="'._PS_ADMIN_IMG_.'arrow2.gif" alt="" />'.$this->l('Back to list').'</a>
			</div>
			';
		$this->_html.='<script type="text/javascript">
			function showBackground(classActive)
			{
				$(".animation").hide();
				$("#animation_" + classActive + "").show("slow");
			}
			$(document).ready(function() {
				$("a.captionfancybox").fancybox({
				autoDimensions : false,
				width : 650,
				height : 600
				});
			});
			
			(function($){var initLayout = function() {
				colorEvent("animation_colobg");};
				EYE.register(initLayout, \'init\');
			})(jQuery)
		</script>';
	}
	

	public function hookHeader($params)
	{
		global $smarty;
		$smarty->assign(array(
			
			'HOOK_CS_SLIDESHOW' => Hook::Exec('csslideshow')
		));
		if ($smarty->tpl_vars['page_name']->value == 'index')
		{
			/* $this->context->controller->addJS($this->_path.'revolution/js/jquery.themepunch.revolution.min.js');
			$this->context->controller->addJS($this->_path.'revolution/js/jquery.themepunch.plugins.min.js'); */
			$this->context->controller->addCSS($this->_path.'revolution/css/settings.css');
			
			$this->_html .= '<script type="text/javascript" src="'.$this->_path.'revolution/js/jquery.themepunch.revolution.min.js"></script>';
			$this->_html .= '<script type="text/javascript" src="'.$this->_path.'revolution/js/jquery.themepunch.plugins.min.js"></script>';
		}
		return $this->_html;
	}
	
	public function hookCsSlideshow()
	{
		global $smarty, $cookie;
		if (version_compare(_PS_VERSION_,'1.6','<'))
		{
			$smarty_cache_id = $this->name.'|'.(int)Tools::usingSecureMode().'|'.(int)$this->context->shop->id.'|'.(int)Group::getCurrent()->id.'|'.(int)$this->context->language->id;
			$this->context->smarty->cache_lifetime = 31536000;
			Tools::enableCache();
		}
		else 
		{
			$smarty_cache_id = $this->getCacheId();
		}
		
		if (!$this->isCached('csslider.tpl', $smarty_cache_id))
		{
			$sliders = $this->getSliders(true);
			
			$sliderList = array();
			$captionList = array();
			if(isset($sliders) && !empty($sliders))
			{
				foreach($sliders as $keySl=>$slider)
				{
					$sl = new SliderClass($slider['id_csslider']);
					$captions = $sl->getCaption();
					$slider['animation'] = json_decode($slider['animation']);
					$slider['image'] = json_decode($slider['image']);
					$arrUrl = $this->getUrl($slider['id_csslider']);
					$slider['url'] = array();
					foreach($arrUrl as $keyUrl => $valueUrl)
					{
						$slider['url'][] = $valueUrl['url'];
					}
					if(isset($captions) and !empty($captions))
					{
						foreach($captions as $key=>$caption)
						{
							$slider['caption'][$key] = json_decode($caption['content']);
						}
					}
					$sliderList[$keySl] = $slider;
					//var_dump($slider['id_csslider']);die;
				}
			}
			
			if($sliderList)
			{
				$context = Context::getContext();
				$id_shop = $context->shop->id;
				if (file_exists(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml'))
					$option = simplexml_load_file(dirname(__FILE__).'/'.'option_'.$id_shop.'.xml');
				else	
					$option = simplexml_load_file(dirname(__FILE__).'/'.'option_'.Configuration::get('PS_SHOP_DEFAULT').'.xml');
				$smarty->assign(array(
					'path' => $this->_path,
					'sliders' => $sliderList,
					'option' => $option
				));
			}
		}
		if (version_compare(_PS_VERSION_,'1.5.4','<'))
			Tools::restoreCacheSettings();
		return $this->display(__FILE__, 'csslider.tpl',$smarty_cache_id);
	}
	public function hookActionShopDataDuplication($params)
	{
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'csslider_shop (id_csslider, id_shop, url, animation, image, position, display)
		SELECT id_csslider, '.(int)$params['new_id_shop'].', url, animation, image, position, display
		FROM '._DB_PREFIX_.'csslider_shop
		WHERE id_shop = '.(int)$params['old_id_shop']);
		
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'csslider_lang (id_csslider,id_lang,id_shop, url)
		SELECT id_csslider,id_lang, '.(int)$params['new_id_shop'].', url
		FROM '._DB_PREFIX_.'csslider_lang
		WHERE id_shop = '.(int)$params['old_id_shop']);
		
	}
	
}
?>

<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:05
         compiled from "/home/pekesmx/www/prestashop/modules/csblockbanner/csblockbanner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:52759103353a1da351bd875-89568099%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17f592dae10ce29d90163e64fcadc191b4713663' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblockbanner/csblockbanner.tpl',
      1 => 1401262787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52759103353a1da351bd875-89568099',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'infos' => 0,
    'info' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da35206b32_27980013',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da35206b32_27980013')) {function content_53a1da35206b32_27980013($_smarty_tpl) {?>
<?php if (count($_smarty_tpl->tpl_vars['infos']->value)>0){?>
<!-- MODULE Block reinsurance -->
<div id="banner_block" class="clearfix">
	<ul class="unstyled banner_block">	
		<?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value){
$_smarty_tpl->tpl_vars['info']->_loop = true;
?>
			<li data-animate="bounceIn" data-delay="0">
				<a href="<?php echo $_smarty_tpl->tpl_vars['info']->value['link'];?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
					<img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
img/<?php echo $_smarty_tpl->tpl_vars['info']->value['file_name'];?>
" alt="" />
				</a>
				<?php echo $_smarty_tpl->tpl_vars['info']->value['text'];?>

			</li>
		<?php } ?>
	</ul>
	<a id="prev_block_banner" class="prev btn" href="#">&lt;</a>
	<a id="next_block_banner" class="next btn" href="#">&gt;</a>
</div>

<script type="text/javascript">
$(window).load(function(){


	if($(window).width()<=767)
	{
		runSliderBanner();
	}
});

$(window).resize(function(){
	if($(window).width()<=767)
	{
		if(!isMobile())
		{
			runSliderBanner();
		}
	}
	else if($(window).width()>767)
	{
		if($("#banner_block .caroufredsel_wrapper").length>0)
		{
			$("#banner_block .banner_block").trigger("destroy");
			$("#banner_block li").css("width","229px");
			$("#banner_block li").css("margin-left","18px");
			$("#banner_block ul li:first-child").css("margin-left","0px");
		}
		
	}
});
	
	
	function runSliderBanner()
	{
		$("#banner_block .banner_block").carouFredSel({
			auto: false,
			responsive: true,
			width: '100%',
			height: 'variable',
			prev: '#prev_block_banner',
			next: '#next_block_banner',
			swipe: {
				onTouch : true
			},
			items: {
				width: 230,
				height: 'auto',
				visible: {
					min: 1,
					max: 2
				}
			},
			scroll: {
				items : 1,       //  The number of items scrolled.
				direction : 'left',
				duration :300
			}

		});
	}
</script>
<!-- /MODULE Block reinsurance -->
<?php }?><?php }} ?>
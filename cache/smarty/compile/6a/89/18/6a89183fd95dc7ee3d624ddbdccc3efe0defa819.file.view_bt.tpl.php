<?php /* Smarty version Smarty-3.1.14, created on 2014-06-23 13:19:32
         compiled from "/home/pekesmx/www/prestashop/modules/gamification/views/templates/admin/gamification/helpers/view/view_bt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:212378143053a86fb40e8779-84408387%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a89183fd95dc7ee3d624ddbdccc3efe0defa819' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/gamification/views/templates/admin/gamification/helpers/view/view_bt.tpl',
      1 => 1402887903,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212378143053a86fb40e8779-84408387',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current_level_percent' => 0,
    'current_level' => 0,
    'badges_type' => 0,
    'type' => 0,
    'key' => 0,
    'badge' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a86fb42896f8_50805513',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a86fb42896f8_50805513')) {function content_53a86fb42896f8_50805513($_smarty_tpl) {?>
<script>
	var current_level_percent_tab = <?php echo intval($_smarty_tpl->tpl_vars['current_level_percent']->value);?>
;
	var current_level_tab = '<?php echo intval($_smarty_tpl->tpl_vars['current_level']->value);?>
';
	var gamification_level_tab = '<?php echo smartyTranslate(array('s'=>'Level','mod'=>'gamification','js'=>1),$_smarty_tpl);?>
';
	$(document).ready( function () {	
		$('.gamification_badges_img').tooltip();
		$('#gamification_progressbar_tab').progressbar({
			change: function() {
		        if (<?php echo $_smarty_tpl->tpl_vars['current_level_percent']->value;?>
)
		        	$( "#gamification_progress-label_tab" ).html( '<?php echo smartyTranslate(array('s'=>'Level','mod'=>'gamification','js'=>1),$_smarty_tpl);?>
'+' '+<?php echo intval($_smarty_tpl->tpl_vars['current_level']->value);?>
+' : '+$('#gamification_progressbar_tab').progressbar( "value" ) + "%" );
		        else
		        	$( "#gamification_progress-label_tab" ).html('');
		      },
	 	});
		$('#gamification_progressbar_tab').progressbar("value", <?php echo intval($_smarty_tpl->tpl_vars['current_level_percent']->value);?>
 );
	});
	var admintab_gamification = true;

</script>

<div class="panel">
	<div id="intro_gamification">
		<div id="left_intro">
			<h4><?php echo smartyTranslate(array('s'=>"Become an e-commerce expert in leaps and bounds!",'mod'=>'gamification'),$_smarty_tpl);?>
</h4><br/>
			<p>
				<?php echo smartyTranslate(array('s'=>"With all of the great features and benefits that PrestaShop offers, it's important to keep up!",'mod'=>'gamification'),$_smarty_tpl);?>
<br/><br/>
				<?php echo smartyTranslate(array('s'=>"The main goal of all of the features we offer is to make you succeed in the e-commerce world. In order to accomplish this, we have created a system of badges and points that make it easy to monitor your progress as a merchant. We have broken down the system into three levels, all of which are integral to success in the e-commerce world: (i) Your use of key e-commerce features on your store; (ii) Your sales performance; (iii) Your presence in international markets.",'mod'=>'gamification'),$_smarty_tpl);?>
<br/><br/>
				<?php echo smartyTranslate(array('s'=>"The more progress your store makes, the more badges and points you earn. No need to submit any information or fill out any forms; we know how busy you are, everything is automatic!",'mod'=>'gamification'),$_smarty_tpl);?>
<br/><br/>
				<?php echo smartyTranslate(array('s'=>"Now, with the click of a button, you will be able to see sales-enhancing features that you may be missing out on. Take advantage and check it out below!",'mod'=>'gamification'),$_smarty_tpl);?>

			</p>
		</div>
		<div id="right_intro">
			<h4><?php echo smartyTranslate(array('s'=>"Our Team is available to help you progress... Contact us now!",'mod'=>'gamification'),$_smarty_tpl);?>
</h4><br/>
			<ul>
				<li>
					<img src="../modules/gamification/views/img/phone_icon.png" alt="<?php echo smartyTranslate(array('s'=>"Phone",'mod'=>'gamification'),$_smarty_tpl);?>
" />
					<span><?php echo smartyTranslate(array('s'=>"By phone: +1 (888) 947.6543",'mod'=>'gamification'),$_smarty_tpl);?>
</span>
				</li>
				<li>
					<img src="../modules/gamification/views/img/mail_icon.png" alt="<?php echo smartyTranslate(array('s'=>"Email",'mod'=>'gamification'),$_smarty_tpl);?>
" />
					<a href="http://www.prestashop.com/en/contact-us"><?php echo smartyTranslate(array('s'=>"By e-mail",'mod'=>'gamification'),$_smarty_tpl);?>
</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="completion_gamification">
		<h4><?php echo smartyTranslate(array('s'=>'Completion level','mod'=>'gamification'),$_smarty_tpl);?>
</h4>
		<div id="gamification_progressbar_tab"></div>
		<span class="gamification_progress-label" id="gamification_progress-label_tab"><?php echo smartyTranslate(array('s'=>"Level",'mod'=>'gamification'),$_smarty_tpl);?>
 <?php echo intval($_smarty_tpl->tpl_vars['current_level']->value);?>
 : <?php echo intval($_smarty_tpl->tpl_vars['current_level_percent']->value);?>
 %</span>
	</div>
	&nbsp;
</div>
<div class="clear"></br></div>

<?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['badges_type']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value){
$_smarty_tpl->tpl_vars['type']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['type']->key;
?>
<div class="panel">
	<h3><i class="icon-bookmark"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</h3>
	<div class="row">
		<div class="col-lg-2">
			<?php echo $_smarty_tpl->getSubTemplate ('./filters_bt.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('type'=>$_smarty_tpl->tpl_vars['key']->value), 0);?>

		</div>
		<div class="col-lg-10">
			<ul class="badge_list" id="list_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" style="">
				<?php  $_smarty_tpl->tpl_vars['badge'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['badge']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['type']->value['badges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['badge']->key => $_smarty_tpl->tpl_vars['badge']->value){
$_smarty_tpl->tpl_vars['badge']->_loop = true;
?>
				<li class="badge_square badge_all <?php if ($_smarty_tpl->tpl_vars['badge']->value->validated){?>validated <?php }else{ ?> not_validated<?php }?> group_<?php echo $_smarty_tpl->tpl_vars['badge']->value->id_group;?>
 level_<?php echo $_smarty_tpl->tpl_vars['badge']->value->group_position;?>
 " id="<?php echo intval($_smarty_tpl->tpl_vars['badge']->value->id);?>
">
					<div class="gamification_badges_img" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['badge']->value->description, ENT_QUOTES, 'UTF-8', true);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['badge']->value->getBadgeImgUrl();?>
"></div>
					<div class="gamification_badges_name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['badge']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</div>
				</li>
				<?php }
if (!$_smarty_tpl->tpl_vars['badge']->_loop) {
?>
					<div class="gamification_badges_name"><?php echo smartyTranslate(array('s'=>"No badge in this section",'mod'=>'gamification'),$_smarty_tpl);?>
</div>
				<?php } ?>
			</ul>
		</div>
		<p id="no_badge_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" class="gamification_badges_name" style="display:none;text-align:center"><?php echo smartyTranslate(array('s'=>"No badge in this section",'mod'=>'gamification'),$_smarty_tpl);?>
</p>
	</div>
</div>
<div class="clear"></br></div>
<?php } ?>
<?php }} ?>
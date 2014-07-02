<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:15
         compiled from "/home/pekesmx/www/prestashop/themes/electronues/modules/productcomments/productcomments-extra.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121902818853a1da3f323265-48956386%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '478c3f0262f608b4c9c0b1e0cd52a46541839d30' => 
    array (
      0 => '/home/pekesmx/www/prestashop/themes/electronues/modules/productcomments/productcomments-extra.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121902818853a1da3f323265-48956386',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'logged' => 0,
    'nbComments' => 0,
    'averageTotal' => 0,
    'too_early' => 0,
    'allow_guests' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da3f39af75_61982994',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da3f39af75_61982994')) {function content_53a1da3f39af75_61982994($_smarty_tpl) {?> 
<script type="text/javascript">
$(function(){
	$('a[href=#idTab5]').click(function(){
		$('*[id^="idTab"]').addClass('block_hidden_only_for_screen');
		$('div#idTab5').removeClass('block_hidden_only_for_screen');

		$('ul#more_info_tabs a[href^="#idTab"]').removeClass('selected');
		$('a[href="#idTab5"]').addClass('selected');
	});
});
</script>

<?php if ($_smarty_tpl->tpl_vars['logged']->value==1||$_smarty_tpl->tpl_vars['nbComments']->value!=0){?>
<div id="product_comments_block_extra">
	<?php if ($_smarty_tpl->tpl_vars['nbComments']->value!=0){?>
	<div class="comments_note">		
		<div class="star_content clearfix">
		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["i"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['name'] = "i";
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] = is_array($_loop=5) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total']);
?>
			<?php if ($_smarty_tpl->tpl_vars['averageTotal']->value<=$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']){?>
				<div class="star"></div>
			<?php }else{ ?>
				<div class="star star_on"></div>
			<?php }?>
		<?php endfor; endif; ?>
		</div>
	</div>
	<?php }?>

	<div class="comments_advices">
		<?php if ($_smarty_tpl->tpl_vars['nbComments']->value!=0){?>
		<a href="#idTab5"><?php echo smartyTranslate(array('s'=>'Read user reviews','mod'=>'productcomments'),$_smarty_tpl);?>
 (<?php echo $_smarty_tpl->tpl_vars['nbComments']->value;?>
)</a>
		<?php }?>
		<?php if (($_smarty_tpl->tpl_vars['too_early']->value==false&&($_smarty_tpl->tpl_vars['logged']->value||$_smarty_tpl->tpl_vars['allow_guests']->value))){?>
		<a class="open-comment-form" href="#new_comment_form"><?php echo smartyTranslate(array('s'=>'Write your review','mod'=>'productcomments'),$_smarty_tpl);?>
</a>
		<?php }?>
	</div>
</div>
<?php }?>
<!--  /Module ProductComments -->
<?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:06
         compiled from "/home/pekesmx/www/prestashop/themes/electronues/modules/blocknewsletter/blocknewsletter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60068074553a1da3695fae6-09582380%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a09f2ab0ab7db8b4397ebc6cda44a451fc5c1a2' => 
    array (
      0 => '/home/pekesmx/www/prestashop/themes/electronues/modules/blocknewsletter/blocknewsletter.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60068074553a1da3695fae6-09582380',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
    'nw_error' => 0,
    'link' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da369bc462_49521185',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da369bc462_49521185')) {function content_53a1da369bc462_49521185($_smarty_tpl) {?>

<!-- Block Newsletter module-->
<div id="newsletter_block_left" class="block" data-animate="fadeInLeft" data-delay="0">
	<?php if (isset($_smarty_tpl->tpl_vars['msg']->value)&&$_smarty_tpl->tpl_vars['msg']->value){?>
		<p class="<?php if ($_smarty_tpl->tpl_vars['nw_error']->value){?>warning_inline<?php }else{ ?>success_inline<?php }?>"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</p>
	<?php }?>
	<h3 class="title1"><?php echo smartyTranslate(array('s'=>'Newsletter','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</h3>
	<div style="float:left">
		<form action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('index');?>
" method="post">
			<p>
				
				<input type="text" name="email" size="18" 
					value="<?php if (isset($_smarty_tpl->tpl_vars['value']->value)&&$_smarty_tpl->tpl_vars['value']->value){?><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'your e-mail','mod'=>'blocknewsletter'),$_smarty_tpl);?>
<?php }?>" 
					onfocus="javascript:if(this.value=='<?php echo smartyTranslate(array('s'=>'your e-mail','mod'=>'blocknewsletter','js'=>1),$_smarty_tpl);?>
')this.value='';" 
					onblur="javascript:if(this.value=='')this.value='<?php echo smartyTranslate(array('s'=>'your e-mail','mod'=>'blocknewsletter','js'=>1),$_smarty_tpl);?>
';" 
					class="inputNew" />
					<input type="submit" value="ok" class="button_mini" name="submitNewsletter" />
				<input type="hidden" name="action" value="0" />
			</p>
		</form>
	</div>
</div>
<!-- /Block Newsletter module-->
<?php }} ?>
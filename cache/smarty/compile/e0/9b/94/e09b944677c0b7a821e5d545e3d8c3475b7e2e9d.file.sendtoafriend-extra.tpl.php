<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:15
         compiled from "/home/pekesmx/www/prestashop/modules/sendtoafriend/sendtoafriend-extra.tpl" */ ?>
<?php /*%%SmartyHeaderCode:56530370353a1da3f221980-90955649%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e09b944677c0b7a821e5d545e3d8c3475b7e2e9d' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/sendtoafriend/sendtoafriend-extra.tpl',
      1 => 1402887909,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56530370353a1da3f221980-90955649',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_dir' => 0,
    'stf_secure_key' => 0,
    'stf_product' => 0,
    'stf_product_cover' => 0,
    'link' => 0,
    'homeSize' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da3f2c6f61_70578171',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da3f2c6f61_70578171')) {function content_53a1da3f2c6f61_70578171($_smarty_tpl) {?>
<script type="text/javascript">

$('document').ready(function(){
	$('#send_friend_button').fancybox({
		'hideOnContentClick': false
	});

	$('#sendEmail').click(function(){
        
        var name = $('#friend_name').val();
        var email = $('#friend_email').val();
        var id_product = $('#id_product_comment_send').val();
		if (name && email && !isNaN(id_product))
		{
			$.ajax({
				url: "<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
sendtoafriend_ajax.php",
				type: "POST",
				headers: {"cache-control": "no-cache"},
				data: {action: 'sendToMyFriend', secure_key: '<?php echo $_smarty_tpl->tpl_vars['stf_secure_key']->value;?>
', name: name, email: email, id_product: id_product},
				dataType: "json",
				success: function(result) {
					$.fancybox.close();
                    var msg = result ? "<?php echo smartyTranslate(array('s'=>'Your e-mail has been sent successfully','mod'=>'sendtoafriend'),$_smarty_tpl);?>
" : "<?php echo smartyTranslate(array('s'=>'Your e-mail could not be sent. Please check the e-mail address and try again.','mod'=>'sendtoafriend'),$_smarty_tpl);?>
";
                    var title = "<?php echo smartyTranslate(array('s'=>'Send to a friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
";
                    fancyMsgBox(msg, title);
				}
			});
		}
		else
			$('#send_friend_form_error').text("<?php echo smartyTranslate(array('s'=>'You did not fill required fields','mod'=>'sendtoafriend','js'=>1),$_smarty_tpl);?>
");
	});
});

</script>
<li class="sendtofriend">
	<a id="send_friend_button" href="#send_friend_form"><?php echo smartyTranslate(array('s'=>'Send to a friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</a>
</li>

<div style="display: none;">
	<div id="send_friend_form">
			<h2 class="title"><?php echo smartyTranslate(array('s'=>'Send to a friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</h2>
			<div class="product clearfix">
				<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['stf_product']->value->link_rewrite,$_smarty_tpl->tpl_vars['stf_product_cover']->value,'home_default'), ENT_QUOTES, 'UTF-8', true);?>
" height="<?php echo $_smarty_tpl->tpl_vars['homeSize']->value['height'];?>
" width="<?php echo $_smarty_tpl->tpl_vars['homeSize']->value['width'];?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['stf_product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" />
				<div class="product_desc">
					<p class="product_name"><strong><?php echo $_smarty_tpl->tpl_vars['stf_product']->value->name;?>
</strong></p>
					<?php echo $_smarty_tpl->tpl_vars['stf_product']->value->description_short;?>

				</div>
			</div>
			
			<div class="send_friend_form_content" id="send_friend_form_content">
				<div id="send_friend_form_error"></div>
				<div id="send_friend_form_success"></div>
				<div class="form_container">
					<p class="intro_form"><?php echo smartyTranslate(array('s'=>'Recipient','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 :</p>
					<p class="text">
						<label for="friend_name"><?php echo smartyTranslate(array('s'=>'Name of your friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 <sup class="required">*</sup> :</label>
						<input id="friend_name" name="friend_name" type="text" value=""/>
					</p>
					<p class="text">
						<label for="friend_email"><?php echo smartyTranslate(array('s'=>'E-mail address of your friend','mod'=>'sendtoafriend'),$_smarty_tpl);?>
 <sup class="required">*</sup> :</label>
						<input id="friend_email" name="friend_email" type="text" value=""/>
					</p>
					<p class="txt_required"><sup class="required">*</sup> <?php echo smartyTranslate(array('s'=>'Required fields','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</p>
				</div>
				<p class="submit">
					<input id="id_product_comment_send" name="id_product" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['stf_product']->value->id;?>
" />
					<a href="#" onclick="$.fancybox.close();"><?php echo smartyTranslate(array('s'=>'Cancel','mod'=>'sendtoafriend'),$_smarty_tpl);?>
</a>&nbsp;<?php echo smartyTranslate(array('s'=>'or','mod'=>'sendtoafriend'),$_smarty_tpl);?>
&nbsp;
					<input id="sendEmail" class="button" name="sendEmail" type="submit" value="<?php echo smartyTranslate(array('s'=>'Send','mod'=>'sendtoafriend'),$_smarty_tpl);?>
" />
				</p>
			</div>
	</div>
</div>
<?php }} ?>
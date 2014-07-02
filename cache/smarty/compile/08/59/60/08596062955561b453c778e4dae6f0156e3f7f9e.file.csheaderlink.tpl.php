<?php /* Smarty version Smarty-3.1.14, created on 2014-06-27 04:02:24
         compiled from "/home/pekesmx/www/prestashop/modules/csheaderlink/csheaderlink.tpl" */ ?>
<?php /*%%SmartyHeaderCode:182662767253a1da352c5851-72256678%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08596062955561b453c778e4dae6f0156e3f7f9e' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csheaderlink/csheaderlink.tpl',
      1 => 1403859740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182662767253a1da352c5851-72256678',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da353a3997_91885689',
  'variables' => 
  array (
    'logged' => 0,
    'link' => 0,
    'cookie' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da353a3997_91885689')) {function content_53a1da353a3997_91885689($_smarty_tpl) {?>

<!-- Block user information module HEADER -->
<div id="header_user">	
	<div id="header_user_info">
<!--		<?php echo smartyTranslate(array('s'=>'Welcome','mod'=>'csheaderlink'),$_smarty_tpl);?>
 -->
		<?php if ($_smarty_tpl->tpl_vars['logged']->value){?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my customer account','mod'=>'csheaderlink'),$_smarty_tpl);?>
" class="account" rel="nofollow"><span><?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_lastname;?>
</span></a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,'mylogout');?>
" title="<?php echo smartyTranslate(array('s'=>'Log me out','mod'=>'csheaderlink'),$_smarty_tpl);?>
" class="logout" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Log out','mod'=>'csheaderlink'),$_smarty_tpl);?>
</a>
		<?php }else{ ?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true);?>
" title="<?php echo smartyTranslate(array('s'=>'Login to your customer account','mod'=>'csheaderlink'),$_smarty_tpl);?>
" class="login" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Login','mod'=>'csheaderlink'),$_smarty_tpl);?>
</a>
			<span class="icon line">|</span>
			<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true);?>
" title="<?php echo smartyTranslate(array('s'=>'Login to your customer account','mod'=>'csheaderlink'),$_smarty_tpl);?>
" class="login" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Sign Up','mod'=>'csheaderlink'),$_smarty_tpl);?>
</a>
		<?php }?>
		<span class="icon line">|</span>
		<a id="your_account" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my customer account','mod'=>'csheaderlink'),$_smarty_tpl);?>
" rel="nofollow"><?php echo smartyTranslate(array('s'=>'My Account','mod'=>'csheaderlink'),$_smarty_tpl);?>
</a>
		<?php if (Module::isEnabled('blockwishlist')&&Module::isInstalled('blockwishlist')){?>
		<span class="icon line">|</span>
		<a id="your_account" href="<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('blockwishlist','mywishlist',array(),true));?>
" title="<?php echo smartyTranslate(array('s'=>'View my wishlist','mod'=>'csheaderlink'),$_smarty_tpl);?>
" rel="nofollow"><?php echo smartyTranslate(array('s'=>'My Wishlist','mod'=>'csheaderlink'),$_smarty_tpl);?>
</a><?php }?>
	</div>
</div>
<!-- /Block user information module HEADER -->
<?php }} ?>
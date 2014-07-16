<?php /* Smarty version Smarty-3.1.14, created on 2014-07-03 04:05:08
         compiled from "/home/pekesmx/www/prestashop/modules/csmegamenu/csmegamenu_home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181963338153b51cc43e80b6-42519159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0d577e18fccb2c6382ad71d69d9094fa43f0473' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csmegamenu/csmegamenu_home.tpl',
      1 => 1401262787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181963338153b51cc43e80b6-42519159',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'responsive_menu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53b51cc440bed1_56663287',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b51cc440bed1_56663287')) {function content_53b51cc440bed1_56663287($_smarty_tpl) {?><div class="cs_mega_menu" id="menu_home">
	<div class="cs_mega_menu_cat">
		<div class="shop_by"><span class="shop_by"><?php echo smartyTranslate(array('s'=>'All Categories','mod'=>'csmegamenu'),$_smarty_tpl);?>
</span></div>
	</div>
</div>
<?php if (isset($_smarty_tpl->tpl_vars['responsive_menu']->value)&&$_smarty_tpl->tpl_vars['responsive_menu']->value){?>
<div id="megamenu-responsive">
    <ul id="megamenu-responsive-root">
        <li class="menu-toggle"><p></p><?php echo smartyTranslate(array('s'=>'All Categories','mod'=>'csmegamenu'),$_smarty_tpl);?>
</li>
        <li class="root">
            <?php echo $_smarty_tpl->tpl_vars['responsive_menu']->value;?>

        </li>
    </ul>
</div>
<?php }?>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2014-07-07 03:20:32
         compiled from "/home/pekesmx/www/prestashop/modules/dineromail/views/templates/hooks/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1257276353ba5850d87ac1-50061734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5c192e96228b66a186a31ecd9e122af8b0fbdf7' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/dineromail/views/templates/hooks/payment.tpl',
      1 => 1401998412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1257276353ba5850d87ac1-50061734',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'paymentPath' => 0,
    'buttonText' => 0,
    'imagePath' => 0,
    'dmFee' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53ba5850df74c5_71469212',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ba5850df74c5_71469212')) {function content_53ba5850df74c5_71469212($_smarty_tpl) {?>

<p class="payment_module">
    <a href="<?php echo $_smarty_tpl->tpl_vars['paymentPath']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['buttonText']->value;?>
">
        <img src="<?php echo $_smarty_tpl->tpl_vars['imagePath']->value;?>
dineromail.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['buttonText']->value;?>
" /> <?php echo $_smarty_tpl->tpl_vars['buttonText']->value;?>

        <br/><br/> <strong><?php echo $_smarty_tpl->tpl_vars['dmFee']->value;?>
</strong><br/>
    </a>
    <script>//<!--      loader image preloading to cache
        $('<img src="<?php echo $_smarty_tpl->tpl_vars['imagePath']->value;?>
loader.gif" />');
    //--></script>
</p><?php }} ?>
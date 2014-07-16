<?php /* Smarty version Smarty-3.1.14, created on 2014-07-07 03:20:39
         compiled from "/home/pekesmx/www/prestashop/modules/dineromail/views/templates/front/confirmation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:76429127353ba5857cfb754-08600574%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef58ef59025ffbb834bbf4d7b9be720dbedf5ab8' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/dineromail/views/templates/front/confirmation.tpl',
      1 => 1401998412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '76429127353ba5857cfb754-08600574',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titleText' => 0,
    'currencyText' => 0,
    'dineromailForm' => 0,
    'loadingText' => 0,
    'loaderText' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53ba5857da1b56_96196949',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ba5857da1b56_96196949')) {function content_53ba5857da1b56_96196949($_smarty_tpl) {?>

<h2><?php echo $_smarty_tpl->tpl_vars['titleText']->value;?>
</h2>

<?php $_smarty_tpl->tpl_vars['current_step'] = new Smarty_variable('payment', null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<?php echo $_smarty_tpl->tpl_vars['currencyText']->value;?>

<?php echo $_smarty_tpl->tpl_vars['dineromailForm']->value;?>

<br /><br />
<div style="display: block; font-size: 18px; font-weight: 800; line-height: 24px; text-decoration: none; text-align: center;"><?php echo $_smarty_tpl->tpl_vars['loadingText']->value;?>

<br /><br /><br /><img src="modules/dineromail/img/loader.gif" alt="<?php echo $_smarty_tpl->tpl_vars['loaderText']->value;?>
" /></div>

 
<script>//<!--
    $(document).ajaxSend(function(e, xhr) {     //block all ajax requests on page
        xhr.abort();
    });
    $(document).ready(function() {
        $('#dineromail_form').submit();
    });
//--></script>
<?php }} ?>
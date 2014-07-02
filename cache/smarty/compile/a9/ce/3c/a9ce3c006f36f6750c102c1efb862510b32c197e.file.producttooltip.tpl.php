<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 14:36:40
         compiled from "/home/pekesmx/www/prestashop/modules/producttooltip/views/templates/hook/producttooltip.tpl" */ ?>
<?php /*%%SmartyHeaderCode:212573563253a1ea48734157-51061348%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9ce3c006f36f6750c102c1efb862510b32c197e' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/producttooltip/views/templates/hook/producttooltip.tpl',
      1 => 1403062407,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212573563253a1ea48734157-51061348',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nb_people' => 0,
    'date_last_order' => 0,
    'date_last_cart' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1ea4880cdf7_43380841',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1ea4880cdf7_43380841')) {function content_53a1ea4880cdf7_43380841($_smarty_tpl) {?>
<script type="text/javascript">
    $(document).ready(function () {
        <?php if (isset($_smarty_tpl->tpl_vars['nb_people']->value)){?>
        $.growl({title: '', message: '<?php if ($_smarty_tpl->tpl_vars['nb_people']->value==1){?><?php echo smartyTranslate(array('s'=>'%d person is currently watching this product','sprintf'=>$_smarty_tpl->tpl_vars['nb_people']->value,'mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'%d people are currently watching this product','sprintf'=>$_smarty_tpl->tpl_vars['nb_people']->value,'mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
<?php }?>'});
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['date_last_order']->value)){?>
        $.growl({title: '', message: '<?php echo smartyTranslate(array('s'=>'This product was bought last','mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['date_last_order']->value,'full'=>1),$_smarty_tpl);?>
'});
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['date_last_cart']->value)){?>
        $.growl({title: '', message: '<?php echo smartyTranslate(array('s'=>'This product was added to cart last','mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['date_last_cart']->value,'full'=>1),$_smarty_tpl);?>
'});
        <?php }?>

        });
</script><?php }} ?>
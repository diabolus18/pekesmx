<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:48:39
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/contents/blockcategories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:98700071453a295d7477575-72901298%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '076b2699e4f5f01eb31a7faca983cc385de51661' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/contents/blockcategories.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98700071453a295d7477575-72901298',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cs_blockCategTree' => 0,
    'cs_isDhtml' => 0,
    'child' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a295d7549fd1_45441104',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a295d7549fd1_45441104')) {function content_53a295d7549fd1_45441104($_smarty_tpl) {?><div class="title"><h3><?php echo smartyTranslate(array('s'=>'Categories','mod'=>'csblog'),$_smarty_tpl);?>
</h3></div>
 $_from = $_smarty_tpl->tpl_vars['cs_blockCategTree']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['child']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['child']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
$_smarty_tpl->tpl_vars['child']->_loop = true;
 $_smarty_tpl->tpl_vars['child']->iteration++;
 $_smarty_tpl->tpl_vars['child']->last = $_smarty_tpl->tpl_vars['child']->iteration === $_smarty_tpl->tpl_vars['child']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['cs_blockCategTree']['last'] = $_smarty_tpl->tpl_vars['child']->last;
?>


</div>
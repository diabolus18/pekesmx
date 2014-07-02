<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:48:39
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/category-tree-branch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:74745657753a295d7556c55-65219463%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bec84a8eda41db65aa4304c2b384e2b5f8272bc4' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/category-tree-branch.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74745657753a295d7556c55-65219463',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last' => 0,
    'node' => 0,
    'id_cs_blog_category_current' => 0,
    'child' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a295d75f3c22_88659836',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a295d75f3c22_88659836')) {function content_53a295d75f3c22_88659836($_smarty_tpl) {?>

<li <?php if (isset($_smarty_tpl->tpl_vars['last']->value)&&$_smarty_tpl->tpl_vars['last']->value=='true'){?>class="last"<?php }?>>
	<a href="<?php echo $_smarty_tpl->tpl_vars['node']->value['link'];?>
"  <?php if (isset($_smarty_tpl->tpl_vars['id_cs_blog_category_current']->value)&&($_smarty_tpl->tpl_vars['node']->value['id']==$_smarty_tpl->tpl_vars['id_cs_blog_category_current']->value)){?>class="selected"<?php }?> title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value['desc'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
	<?php if (count($_smarty_tpl->tpl_vars['node']->value['children'])>0){?>
		<ul>
		<?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['child']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['node']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['child']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['child']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
$_smarty_tpl->tpl_vars['child']->_loop = true;
 $_smarty_tpl->tpl_vars['child']->iteration++;
 $_smarty_tpl->tpl_vars['child']->last = $_smarty_tpl->tpl_vars['child']->iteration === $_smarty_tpl->tpl_vars['child']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['pl_categoryTreeBranch']['last'] = $_smarty_tpl->tpl_vars['child']->last;
?>
			<?php if (isset($_smarty_tpl->getVariable('smarty',null,true,false)->value['foreach']['pl_categoryTreeBranch'])&&$_smarty_tpl->getVariable('smarty')->value['foreach']['pl_categoryTreeBranch']['last']){?>
				<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['cs_branche_tpl_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('node'=>$_smarty_tpl->tpl_vars['child']->value,'last'=>'true'), 0);?>

			<?php }else{ ?>
				<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['cs_branche_tpl_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('node'=>$_smarty_tpl->tpl_vars['child']->value,'last'=>'false'), 0);?>

			<?php }?>
		<?php } ?>
		</ul>
	<?php }?>
</li>
<?php }} ?>
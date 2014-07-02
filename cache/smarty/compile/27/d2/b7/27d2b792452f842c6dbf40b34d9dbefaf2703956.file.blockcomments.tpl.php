<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:48:39
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/contents/blockcomments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:165721085553a295d773bed3-76135936%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27d2b792452f842c6dbf40b34d9dbefaf2703956' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/contents/blockcomments.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165721085553a295d773bed3-76135936',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'blockcomments' => 0,
    'comment' => 0,
    'cs_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a295d77ee3d4_04735605',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a295d77ee3d4_04735605')) {function content_53a295d77ee3d4_04735605($_smarty_tpl) {?><div class="title"><h3><?php echo smartyTranslate(array('s'=>'Current comments','mod'=>'csblog'),$_smarty_tpl);?>
</h3></div><?php if (count($_smarty_tpl->tpl_vars['blockcomments']->value)>0){?><div class="box-content">	<ul class="unstyled list_tree">	<?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blockcomments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['comment']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['comment']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
$_smarty_tpl->tpl_vars['comment']->_loop = true;
 $_smarty_tpl->tpl_vars['comment']->iteration++;
 $_smarty_tpl->tpl_vars['comment']->last = $_smarty_tpl->tpl_vars['comment']->iteration === $_smarty_tpl->tpl_vars['comment']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['comment']['last'] = $_smarty_tpl->tpl_vars['comment']->last;
?>		<li <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['comment']['last']){?> class="last"<?php }?>>			<div class="title_post">				<a href="<?php echo $_smarty_tpl->tpl_vars['comment']->value['link_post'];?>
"> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'),45,'...');?>
 </a>			</div>			<div class="comment_content">							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value['content'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'),100,'...');?>
			</div>			<?php if (isset($_smarty_tpl->tpl_vars['comment']->value['image_post'])){?>				<div class="comment_image_post"><a href="<?php echo $_smarty_tpl->tpl_vars['comment']->value['link_post'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cs_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['comment']->value['image_post'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['comment']->value['name_post'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['comment']->value['name_post'];?>
" /></a></div>			<?php }?>										<div class="comment_date"><span><?php echo $_smarty_tpl->tpl_vars['comment']->value['date_add'];?>
</span></div>			<div class="comment_author">				<?php echo smartyTranslate(array('s'=>'Write by','mod'=>'csblog'),$_smarty_tpl);?>
 				<span class="pluser_name">				<?php if (isset($_smarty_tpl->tpl_vars['comment']->value['author_name'])&&$_smarty_tpl->tpl_vars['comment']->value['author_name']!=''){?><?php echo $_smarty_tpl->tpl_vars['comment']->value['author_name'];?>
<?php }?></span>			</div>					</li>	<?php } ?>	</ul></div><?php }else{ ?>	<div class="no_item"><?php echo smartyTranslate(array('s'=>'There is no comment','mod'=>'csblog'),$_smarty_tpl);?>
</div><?php }?><?php }} ?>
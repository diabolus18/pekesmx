<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:48:39
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/contents/blocklastestposts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23998011453a295d7600023-18215813%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64fc13d6889ad246b36eca3f2236c4026ae1b46d' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/hook/contents/blocklastestposts.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23998011453a295d7600023-18215813',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lastest_posts' => 0,
    'post' => 0,
    'cs_imep_show' => 0,
    'cs_path' => 0,
    'pl_blog_post' => 0,
    'CS_COLP_MAXIMUM' => 0,
    'author' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a295d772bbd7_17112443',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a295d772bbd7_17112443')) {function content_53a295d772bbd7_17112443($_smarty_tpl) {?><div class="title"><h3><?php echo smartyTranslate(array('s'=>'Latest Posts','mod'=>'csblog'),$_smarty_tpl);?>
</h3></div><?php if (count($_smarty_tpl->tpl_vars['lastest_posts']->value)>0){?><div class="box-content">	<ul class="unstyled">	<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lastest_posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['post']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['post']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
 $_smarty_tpl->tpl_vars['post']->iteration++;
 $_smarty_tpl->tpl_vars['post']->last = $_smarty_tpl->tpl_vars['post']->iteration === $_smarty_tpl->tpl_vars['post']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['lastest_posts']['last'] = $_smarty_tpl->tpl_vars['post']->last;
?>		<li <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['lastest_posts']['last']){?> class="last"<?php }?>>			<div class="title_post"> <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
"><span><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'),55,'...');?>
</span></a></div>			<span class="post_date_add"><?php echo $_smarty_tpl->tpl_vars['post']->value['date_add'];?>
</span>			<?php if ($_smarty_tpl->tpl_vars['cs_imep_show']->value!='none'){?>				<?php if ($_smarty_tpl->tpl_vars['post']->value['image']!=''){?>					<a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
">						<img src="<?php echo $_smarty_tpl->tpl_vars['cs_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['post']->value['image'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
" />					</a>				<?php }?>			<?php }?>			<?php if (isset($_smarty_tpl->tpl_vars['post']->value['description'])&&$_smarty_tpl->tpl_vars['post']->value['description']!=''){?>			<div class="post_description">			<?php $_smarty_tpl->tpl_vars['pl_blog_post'] = new Smarty_variable(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['post']->value['description']), null, 0);?>			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['pl_blog_post']->value,$_smarty_tpl->tpl_vars['CS_COLP_MAXIMUM']->value);?>
			</div>			<?php }?>			<div class="block_post_more">				<?php if ($_smarty_tpl->tpl_vars['post']->value['author']!=''){?>					<?php $_smarty_tpl->tpl_vars['author'] = new Smarty_variable(explode("¤",$_smarty_tpl->tpl_vars['post']->value['author']), null, 0);?>					<?php echo smartyTranslate(array('s'=>'Posted by '),$_smarty_tpl);?>
<span class="pluser_name">										<?php if (isset($_smarty_tpl->tpl_vars['author']->value[1])&&$_smarty_tpl->tpl_vars['author']->value[1]!=''){?><?php echo $_smarty_tpl->tpl_vars['author']->value[1];?>
<?php }?></span>					<span class="opa">&nbsp;|&nbsp;</span>				<?php }?>					<span class="pl_requie"><?php echo $_smarty_tpl->tpl_vars['post']->value['count_comment'];?>
</span>					<?php if ($_smarty_tpl->tpl_vars['post']->value['count_comment']>1){?><?php echo smartyTranslate(array('s'=>'Comments','mod'=>'csblog'),$_smarty_tpl);?>
<?php }?>					<?php if ($_smarty_tpl->tpl_vars['post']->value['count_comment']<=1){?> <?php echo smartyTranslate(array('s'=>'Comment','mod'=>'csblog'),$_smarty_tpl);?>
<?php }?>			</div>				</li>	<?php } ?>	</ul></div><?php }else{ ?>	<div class="no_item"><?php echo smartyTranslate(array('s'=>'There is no lastest post','mod'=>'csblog'),$_smarty_tpl);?>
</div><?php }?><?php }} ?>
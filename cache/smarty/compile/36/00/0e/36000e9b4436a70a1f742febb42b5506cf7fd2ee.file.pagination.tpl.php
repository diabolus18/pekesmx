<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:48:40
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/pagination.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104742312853a295d806a757-07801503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36000e9b4436a70a1f742febb42b5506cf7fd2ee' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/pagination.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104742312853a295d806a757-07801503',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'p' => 0,
    'cs_blog_category' => 0,
    'csLink' => 0,
    'cs_blog_tag' => 0,
    'link' => 0,
    'start' => 0,
    'stop' => 0,
    'requestPage' => 0,
    'p_previous' => 0,
    'pages_nb' => 0,
    'p_next' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a295d81ddc51_96683696',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a295d81ddc51_96683696')) {function content_53a295d81ddc51_96683696($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['p']->value)&&$_smarty_tpl->tpl_vars['p']->value){?>
	<!-- Pagination -->
	<?php if (isset($_smarty_tpl->tpl_vars['cs_blog_category']->value['id_cs_blog_category'])&&$_smarty_tpl->tpl_vars['cs_blog_category']->value['id_cs_blog_category']){?>
		<?php $_smarty_tpl->tpl_vars['requestPage'] = new Smarty_variable($_smarty_tpl->tpl_vars['csLink']->value->getCategoryPostLink($_smarty_tpl->tpl_vars['cs_blog_category']->value['id_cs_blog_category'],$_smarty_tpl->tpl_vars['cs_blog_category']->value['link_rewrite']), null, 0);?>
	<?php }elseif(isset($_smarty_tpl->tpl_vars['cs_blog_tag']->value)){?>

		<?php $_smarty_tpl->tpl_vars['requestPage'] = new Smarty_variable($_smarty_tpl->tpl_vars['csLink']->value->getTagLink($_smarty_tpl->tpl_vars['cs_blog_tag']->value->id,$_smarty_tpl->tpl_vars['cs_blog_tag']->value->name), null, 0);?>
	<?php }else{ ?>

		<?php $_smarty_tpl->tpl_vars['requestPage'] = new Smarty_variable($_smarty_tpl->tpl_vars['link']->value->getModuleLink('csblog','categoryPost'), null, 0);?>
	<?php }?>
	<div id="pagination" class="pagination">
	<?php if ($_smarty_tpl->tpl_vars['start']->value!=$_smarty_tpl->tpl_vars['stop']->value){?>
		<ul class="pagination">
		<?php if ($_smarty_tpl->tpl_vars['p']->value!=1){?>
			<?php $_smarty_tpl->tpl_vars['p_previous'] = new Smarty_variable($_smarty_tpl->tpl_vars['p']->value-1, null, 0);?>
			<li id="pagination_previous"><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->goPage($_smarty_tpl->tpl_vars['requestPage']->value,$_smarty_tpl->tpl_vars['p_previous']->value);?>
">&laquo;&nbsp;<?php echo smartyTranslate(array('s'=>'Previous','mod'=>'plblog'),$_smarty_tpl);?>
</a></li>
		<?php }else{ ?>
			<li id="pagination_previous" class="disabled pagination_previous"><span>&laquo;&nbsp;<?php echo smartyTranslate(array('s'=>'Previous','mod'=>'csblog'),$_smarty_tpl);?>
</span></li>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['start']->value>3){?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->goPage($_smarty_tpl->tpl_vars['requestPage']->value,1);?>
">1</a></li>
			<li class="truncate">...</li>
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['name'] = 'pagination';
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['start'] = (int)$_smarty_tpl->tpl_vars['start']->value;
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['stop']->value+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['pagination']['total']);
?>
			<?php if ($_smarty_tpl->tpl_vars['p']->value==$_smarty_tpl->getVariable('smarty')->value['section']['pagination']['index']){?>
				<li class="current"><span><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['p']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span></li>
			<?php }else{ ?>
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->goPage($_smarty_tpl->tpl_vars['requestPage']->value,$_smarty_tpl->getVariable('smarty')->value['section']['pagination']['index']);?>
"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->getVariable('smarty')->value['section']['pagination']['index'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a></li>
			<?php }?>
		<?php endfor; endif; ?>
		<?php if ($_smarty_tpl->tpl_vars['pages_nb']->value>$_smarty_tpl->tpl_vars['stop']->value+2){?>
			<li class="truncate">...</li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->goPage($_smarty_tpl->tpl_vars['requestPage']->value,$_smarty_tpl->tpl_vars['pages_nb']->value);?>
"><?php echo intval($_smarty_tpl->tpl_vars['pages_nb']->value);?>
</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['pages_nb']->value>1&&$_smarty_tpl->tpl_vars['p']->value!=$_smarty_tpl->tpl_vars['pages_nb']->value){?>
			<?php $_smarty_tpl->tpl_vars['p_next'] = new Smarty_variable($_smarty_tpl->tpl_vars['p']->value+1, null, 0);?>
			<li id="pagination_next" class="pagination_next"><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->goPage($_smarty_tpl->tpl_vars['requestPage']->value,$_smarty_tpl->tpl_vars['p_next']->value);?>
"><?php echo smartyTranslate(array('s'=>'Next','mod'=>'csblog'),$_smarty_tpl);?>
&nbsp;&raquo;</a></li>
		<?php }else{ ?>
			<li id="pagination_next" class="disabled"><span><?php echo smartyTranslate(array('s'=>'Next','mod'=>'csblog'),$_smarty_tpl);?>
&nbsp;&raquo;</span></li>
		<?php }?>
		</ul>
	<?php }?>
	</div>
	<!-- /Pagination -->

<?php }?>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2014-06-19 02:48:39
         compiled from "/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/post_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110211343753a295d7e6fa28-23741860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0eb6962e0f5490ea9264120b4949637dbad06c9b' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblog/views/templates/front/post_list.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110211343753a295d7e6fa28-23741860',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cs_post_list' => 0,
    'post' => 0,
    'cs_imep_list_show' => 0,
    'cs_b_summary_character_count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a295d8059487_65810492',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a295d8059487_65810492')) {function content_53a295d8059487_65810492($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['cs_post_list']->value)){?>
<ul id="post_list" class="post_grid clearfix">
	<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cs_post_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
		<li class="pitem element ajax_block_post <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['posts']['index']%2==0){?>alpha <?php }?><?php if (($_smarty_tpl->getVariable('smarty')->value['foreach']['posts']['index']+1)%2==0){?>omega<?php }?> clearfix " data-alpha="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 " data-date-add="<?php echo $_smarty_tpl->tpl_vars['post']->value['date_add_no_format'];?>
">
		<div class="post_name">
		<h3><a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
</a></h3></div>	
			<?php if ($_smarty_tpl->tpl_vars['cs_imep_list_show']->value!='none'){?>
				<?php if (isset($_smarty_tpl->tpl_vars['post']->value['image'])&&$_smarty_tpl->tpl_vars['post']->value['image']!=''){?>
				<div class="post_image">
					<a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
" /></a>
					<div class="post_date_add md">
						<div class="mdd" style="display: table; overflow: hidden;"> 
							<div style=" #position: absolute; #top: 50%;#left:0; display: table-cell; vertical-align: middle;"> 
								<div style="#position: relative; #top: -50%;"> <span><?php echo date('d',strtotime($_smarty_tpl->tpl_vars['post']->value['date_add']));?>
</span><span><?php echo date('M',strtotime($_smarty_tpl->tpl_vars['post']->value['date_add']));?>
</span></div>
							</div>
						</div>	
					</div>	
				</div>
				<?php }?>
			<?php }?>
			<div class="date_add"><?php echo $_smarty_tpl->tpl_vars['post']->value['date_add'];?>
</div>
		<div class="post_description"><p><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['cs_b_summary_character_count']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['post']->value['description']),$_tmp1);?>
</p></div>
			
		<div class="post_more_info">
				<?php if ($_smarty_tpl->tpl_vars['post']->value['author']!=''){?>
						<?php $_smarty_tpl->tpl_vars['author'] = new Smarty_variable(explode("¤",$_smarty_tpl->tpl_vars['post']->value['author']), null, 0);?>
						<?php echo smartyTranslate(array('s'=>'Post by '),$_smarty_tpl);?>

						<span class="pluser_name">
						<?php echo $_smarty_tpl->tpl_vars['post']->value['author'];?>

						</span><span class="opa">&nbsp;|&nbsp;</span>
				<?php }?>
					<span class="pl_requie"><?php echo $_smarty_tpl->tpl_vars['post']->value['count_comment'];?>
</span>
					<?php if ($_smarty_tpl->tpl_vars['post']->value['count_comment']>1){?><?php echo smartyTranslate(array('s'=>'Comments','mod'=>'csblog'),$_smarty_tpl);?>
<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['post']->value['count_comment']<=1){?> <?php echo smartyTranslate(array('s'=>'Comment','mod'=>'csblog'),$_smarty_tpl);?>
<?php }?>
					<span class="opa">&nbsp;|&nbsp;</span>
					<a class="post_read_more" href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo smartyTranslate(array('s'=>'Read more','mod'=>'csblog'),$_smarty_tpl);?>
">
						<?php echo smartyTranslate(array('s'=>'Read more','mod'=>'csblog'),$_smarty_tpl);?>
</a>
			</div>
			
		</li>
	<?php } ?>
</ul>
<?php }?><?php }} ?>
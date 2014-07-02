<?php /* Smarty version Smarty-3.1.14, created on 2014-06-18 13:28:06
         compiled from "/home/pekesmx/www/prestashop/themes/electronues/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14472520553a1da36d50432-23266998%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4f2a2185340fb9b87dad30af3f6be2edde0b110' => 
    array (
      0 => '/home/pekesmx/www/prestashop/themes/electronues/footer.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14472520553a1da36d50432-23266998',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'page_name' => 0,
    'right_column_size' => 0,
    'settings' => 0,
    'CS_BLOG_HOOK_RIGHT_COLUMN' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'left_column_size' => 0,
    'HOOK_CS_FOOTER_TOP' => 0,
    'HOOK_FOOTER' => 0,
    'HOOK_CS_FOOTER_RIGHT' => 0,
    'HOOK_CS_FOOTER_BOTTOM' => 0,
    'js_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53a1da36e0ff78_37833282',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53a1da36e0ff78_37833282')) {function content_53a1da36e0ff78_37833282($_smarty_tpl) {?>

			<?php if (!$_smarty_tpl->tpl_vars['content_only']->value){?>
					</div><!-- /Center -->
			<?php if ($_smarty_tpl->tpl_vars['page_name']->value!='index'){?>
				<?php if (isset($_smarty_tpl->tpl_vars['right_column_size']->value)&&!empty($_smarty_tpl->tpl_vars['right_column_size']->value)){?>
					<!-- Right -->
							<div id="right_column" class="<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index'){?><?php echo $_smarty_tpl->tpl_vars['settings']->value->right_class_home;?>
<?php }?> grid_<?php echo intval($_smarty_tpl->tpl_vars['right_column_size']->value);?>
 omega">
								<div class="right_content">
									<?php if ($_smarty_tpl->tpl_vars['page_name']->value=="module-csblog-listpost"||$_smarty_tpl->tpl_vars['page_name']->value=="module-csblog-detailpost"||$_smarty_tpl->tpl_vars['page_name']->value=="module-csblog-listposttag"){?>
										<?php if (isset($_smarty_tpl->tpl_vars['CS_BLOG_HOOK_RIGHT_COLUMN']->value)){?><?php echo $_smarty_tpl->tpl_vars['CS_BLOG_HOOK_RIGHT_COLUMN']->value;?>
<?php }?>
									<?php }else{ ?>
										<?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>

									<?php }?>
								</div>
								<!--fix block layered for case 3 column-->
								<?php if ($_smarty_tpl->tpl_vars['right_column_size']->value&&$_smarty_tpl->tpl_vars['left_column_size']->value){?>
								<script type="text/javascript">
									if($(".right_content").children("#layered_block_left").length>0)
									{
										$(".right_content").children("#layered_block_left").css("display","none");
										$(".right_content").children("#layered_block_left").remove();
									}
								</script>
								<?php }?>
							</div>
					<?php }?>
				
			<?php }?>
				</div><!--/columns-->
				</div><!--/grid_24-->
			</div><!--/container_24-->
			</div>
<!-- Footer -->
			<div class="mode_footer clearfix">
				<div class="container_24">
					<div class="grid_24">
						<?php if ($_smarty_tpl->tpl_vars['page_name']->value!='pagenotfound'){?>
						<?php if (isset($_smarty_tpl->tpl_vars['HOOK_CS_FOOTER_TOP']->value)&&$_smarty_tpl->tpl_vars['HOOK_CS_FOOTER_TOP']->value){?>
							<div class="mode_footer_top clearfix">
								<?php echo $_smarty_tpl->tpl_vars['HOOK_CS_FOOTER_TOP']->value;?>
				
							</div>
						<?php }?>						
						<div class="mode_footer_main clearfix">
							<div id="footer" class="grid_16 alpha omega">
								<?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>

							</div>
							
							<div class="footer_right grid_8 omega alpha" data-animate="fadeInLeft" data-delay="0">
								<div class="footer_content">
									<?php if (isset($_smarty_tpl->tpl_vars['HOOK_CS_FOOTER_RIGHT']->value)&&$_smarty_tpl->tpl_vars['HOOK_CS_FOOTER_RIGHT']->value){?>
										<?php echo $_smarty_tpl->tpl_vars['HOOK_CS_FOOTER_RIGHT']->value;?>

									<?php }?>
								</div>
							</div>
							
						</div>
						<?php }?>
						<div class="footer_bottom clearfix">
							<?php if (isset($_smarty_tpl->tpl_vars['HOOK_CS_FOOTER_BOTTOM']->value)&&$_smarty_tpl->tpl_vars['HOOK_CS_FOOTER_BOTTOM']->value){?>
								<?php echo $_smarty_tpl->tpl_vars['HOOK_CS_FOOTER_BOTTOM']->value;?>

							<?php }?>					
						</div>
					</div>
				</div>
			</div>
			<div id="toTop">top</div>
		</div><!--/page-->
	<?php }?>
	<script src="<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
products-comparison _15.js" type="text/javascript"></script>
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</body>
</html>
<?php }} ?>
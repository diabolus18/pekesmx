<?php /* Smarty version Smarty-3.1.14, created on 2014-07-07 03:12:01
         compiled from "/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/controllers/modules/tab_module_line.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103933801853ba5651827d17-05222540%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e92fee4c8de826f02af82386e2d04e0a57812572' => 
    array (
      0 => '/home/pekesmx/www/prestashop/pekesadmin/themes/default/template/controllers/modules/tab_module_line.tpl',
      1 => 1399439115,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103933801853ba5651827d17-05222540',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'currentIndex' => 0,
    'token' => 0,
    'option' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53ba56519d8331_82304469',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ba56519d8331_82304469')) {function content_53ba56519d8331_82304469($_smarty_tpl) {?>


<tr>
	<td class="fixed-width-sm center">
		<img class="img-thumbnail" alt="<?php echo $_smarty_tpl->tpl_vars['module']->value->name;?>
" src="<?php if (isset($_smarty_tpl->tpl_vars['module']->value->image)){?><?php echo $_smarty_tpl->tpl_vars['module']->value->image;?>
<?php }else{ ?><?php echo @constant('_MODULE_DIR_');?>
<?php echo $_smarty_tpl->tpl_vars['module']->value->name;?>
/<?php echo $_smarty_tpl->tpl_vars['module']->value->logo;?>
<?php }?>">
	</td>
	<td>
		<div id="anchor<?php echo ucfirst($_smarty_tpl->tpl_vars['module']->value->name);?>
" title="<?php echo $_smarty_tpl->tpl_vars['module']->value->displayName;?>
">
			<div class="module_name">
				<span style="display:none"><?php echo $_smarty_tpl->tpl_vars['module']->value->name;?>
</span>
				<?php echo $_smarty_tpl->tpl_vars['module']->value->displayName;?>

				<small class="text-muted">v<?php echo $_smarty_tpl->tpl_vars['module']->value->version;?>
 - by <?php echo $_smarty_tpl->tpl_vars['module']->value->author;?>
</small>
				<?php if (isset($_smarty_tpl->tpl_vars['module']->value->type)&&$_smarty_tpl->tpl_vars['module']->value->type=='addonsMustHave'){?>
					- <span class="module-badge-popular help-tooltip text-primary" data-title="<?php echo smartyTranslate(array('s'=>"This module is available on PrestaShop Addons"),$_smarty_tpl);?>
"><i class="icon-group"></i> <small><?php echo smartyTranslate(array('s'=>"Popular"),$_smarty_tpl);?>
</small></span>
				<?php }elseif(isset($_smarty_tpl->tpl_vars['module']->value->type)&&$_smarty_tpl->tpl_vars['module']->value->type=='addonsPartner'){?>
					- <span class="module-badge-partner help-tooltip text-warning" data-title="<?php echo smartyTranslate(array('s'=>"This module is available for free thanks to our partner."),$_smarty_tpl);?>
"><i class="icon-pushpin"></i> <small><?php echo smartyTranslate(array('s'=>"Official"),$_smarty_tpl);?>
</small></span>
				<?php }elseif(isset($_smarty_tpl->tpl_vars['module']->value->id)&&$_smarty_tpl->tpl_vars['module']->value->id>0){?>
					<?php if (isset($_smarty_tpl->tpl_vars['module']->value->version_addons)&&$_smarty_tpl->tpl_vars['module']->value->version_addons){?>
						<span class="label label-warning"><?php echo smartyTranslate(array('s'=>'Need update'),$_smarty_tpl);?>
</span>
					<?php }?>
				<?php }?>
			</div>
			<p class="module_description">
				<?php if (isset($_smarty_tpl->tpl_vars['module']->value->description)&&$_smarty_tpl->tpl_vars['module']->value->description!=''){?>
					<?php echo $_smarty_tpl->tpl_vars['module']->value->description;?>

				<?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['module']->value->show_quick_view)&&$_smarty_tpl->tpl_vars['module']->value->show_quick_view){?>
					<br><a href="<?php echo $_smarty_tpl->tpl_vars['currentIndex']->value;?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
&ajax=1&action=GetModuleQuickView&module=<?php echo $_smarty_tpl->tpl_vars['module']->value->name;?>
" class="fancybox-quick-view"><i class="icon-search"></i> <?php echo smartyTranslate(array('s'=>'Read more'),$_smarty_tpl);?>
</a>
				<?php }?>
			</p>
			<?php if (isset($_smarty_tpl->tpl_vars['module']->value->message)&&(empty($_smarty_tpl->tpl_vars['module']->value->name)!==false)&&(!isset($_smarty_tpl->tpl_vars['module']->value->type)||($_smarty_tpl->tpl_vars['module']->value->type!='addonsMustHave'||$_smarty_tpl->tpl_vars['module']->value->type!=='addonsNative'))){?><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $_smarty_tpl->tpl_vars['module']->value->message;?>
</div><?php }?>
		</div>

	</td>
	<?php if (isset($_smarty_tpl->tpl_vars['module']->value->type)&&$_smarty_tpl->tpl_vars['module']->value->type=='addonsMustHave'){?>
		<td>&nbsp;</td>
		<td align="right">
			<p>
				<a href="<?php echo $_smarty_tpl->tpl_vars['module']->value->addons_buy_url;?>
" target="_blank" class="button updated">
					<span class="btn btn-default">
						<i class="icon-shopping-cart"></i> &nbsp;&nbsp;<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['module']->value->price,'currency'=>$_smarty_tpl->tpl_vars['module']->value->id_currency),$_smarty_tpl);?>

					</span>
				</a>
			</p>
		</td>
	<?php }elseif(!isset($_smarty_tpl->tpl_vars['module']->value->not_on_disk)){?>
		<td>&nbsp;</td>
		<td>
			<div class="btn-group-action">
				<?php if (count($_smarty_tpl->tpl_vars['module']->value->optionsHtml)>0){?>
				<div class="btn-group">
					<?php $_smarty_tpl->tpl_vars['option'] = new Smarty_variable($_smarty_tpl->tpl_vars['module']->value->optionsHtml[0], null, 0);?>
					<?php echo $_smarty_tpl->tpl_vars['option']->value;?>

					<?php if (count($_smarty_tpl->tpl_vars['module']->value->optionsHtml)>1){?>
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
						<span class="caret">&nbsp;</span>
					</button>
					<ul class="dropdown-menu">
					<?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['module']->value->optionsHtml; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['option']->key;
?>
						<?php if ($_smarty_tpl->tpl_vars['key']->value!=0){?>
							<li><?php echo $_smarty_tpl->tpl_vars['option']->value;?>
</li>
						<?php }?>
					<?php } ?>
					</ul>
					<?php }?>
				</div>
				<?php }?>
			</div>
		</td>
	<?php }else{ ?>
		<td>&nbsp;</td>
		<td align="right">
			<p>
				<a href="<?php echo $_smarty_tpl->tpl_vars['module']->value->options['install_url'];?>
" class="btn btn-success">
					<i class="icon-plus-sign-alt"></i>
					<?php echo smartyTranslate(array('s'=>'Install'),$_smarty_tpl);?>

				</a>
			</p>
		</td>
	<?php }?>
</tr><?php }} ?>
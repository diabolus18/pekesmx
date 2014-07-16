<?php /*%%SmartyHeaderCode:34090755753a1da367b30c5-56895536%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6435f831cf1c63705a36a43f800f934e3597aa23' => 
    array (
      0 => '/home/pekesmx/www/prestashop/themes/electronues/modules/blockmyaccountfooter/blockmyaccountfooter.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34090755753a1da367b30c5-56895536',
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53c5be4b33ac69_42696977',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c5be4b33ac69_42696977')) {function content_53c5be4b33ac69_42696977($_smarty_tpl) {?>
<!-- Block myaccount module -->
<div class="grid_4 myaccount" data-animate="fadeInLeft" data-delay="0">
	<h4 class="title_block"><a href="http://pekes.mx/mi-cuenta" title="Administrar mi cuenta de cliente" rel="nofollow">Mi cuenta</a></h4>
	<a href="javascript:void(0)" class="show_hide_footer">+</a>
	<div class="block_content">
		<ul class="bullet">
			<li><a href="http://pekes.mx/historial-de-pedidos" title="Ver los pedidos anteriores" rel="nofollow">Mis pedidos</a></li>
						<li><a href="http://pekes.mx/vales" title="Listado de mis créditos" rel="nofollow">Mis vales descuento</a></li>
			<li><a href="http://pekes.mx/direcciones" title="Lista de direcciónes" rel="nofollow">Mis direcciones</a></li>
			<li><a href="http://pekes.mx/identidad" title="Administrar mi información personal" rel="nofollow">Mis datos personales</a></li>
						<li class="logout"><a href="http://pekes.mx/?mylogout" title="Cerrar sesión" rel="nofollow">Sign out</a></li>			
		</ul>
		<!-- <p class="logout"><a href="http://pekes.mx/?mylogout" title="Cerrar sesión" rel="nofollow">Sign out</a></p> -->
	</div>
</div>
<!-- /Block myaccount module -->
<?php }} ?>
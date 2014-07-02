<?php /*%%SmartyHeaderCode:154129695653a1da34552385-21703275%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b30a48a0abdcb2ea0aed22a6b22276044d37ad1' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblocksearch/csblocksearch-top.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
    'b029799512e8af854d549edc6628315e4d8f62d5' => 
    array (
      0 => '/home/pekesmx/www/prestashop/modules/csblocksearch/blocksearch-instantsearch.tpl',
      1 => 1401262786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154129695653a1da34552385-21703275',
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53ad20177ac2e7_24049060',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ad20177ac2e7_24049060')) {function content_53ad20177ac2e7_24049060($_smarty_tpl) {?><!-- block seach mobile -->
<!-- Block search module TOP -->
<div id="search_block_top">
	<!-- <label for="search_query_top">Buscar</label> -->
	<form method="get" action="http://pekes.mx/buscar" id="searchbox">
			<input type="hidden" name="controller" value="search" />
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="orderway" value="desc" />
			<input class="search_query" type="text" id="search_query_top" name="search_query" value="Search entire store here..." onfocus="this.value=''" onblur="if (this.value =='') this.value='Buscar en toda la tienda'" />
			<input type="submit" name="submit_search" value="Buscar" class="button" title="Buscar"/>
	</form>
		<script type="text/javascript">
	// <![CDATA[
		$('document').ready( function() {
			$("#search_query_top")
				.autocomplete(
					'http://pekes.mx/buscar', {
						minChars: 3,
						max: 10,
						width: 500,
						selectFirst: false,
						scroll: false,
						dataType: "json",
						formatItem: function(data, i, max, value, term) {
							return value;
						},
						parse: function(data) {
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = { data: data[i], value: data[i].cname + ' > ' + data[i].pname };
							return mytab;
						},
						extraParams: {
							ajaxSearch: 1,
							id_lang: 2
						}
					}
				)
				.result(function(event, data, formatted) {
					$('#search_query_top').val(data.pname);
					document.location.href = data.product_link;
				})
		});
	// ]]>
	</script>

</div>

<!-- /Block search module TOP -->
<?php }} ?>
{*
* 2007-2012 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2012 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{* On 1.5 the var csrequest is setted on the front controller. The next lines assure the retrocompatibility with some modules *}
{if !isset($csrequest)}
	<!-- Sort products -->
	{if isset($smarty.get.id_category) && $smarty.get.id_category}
		{assign var='csrequest' value=$link->getPaginationLink('categoryPost', $category, false, true)}
	{elseif isset($smarty.get.id_manufacturer) && $smarty.get.id_manufacturer}
		{assign var='csrequest' value=$link->getPaginationLink('manufacturer', $manufacturer, false, true)}
	{elseif isset($smarty.get.id_supplier) && $smarty.get.id_supplier}
		{assign var='csrequest' value=$link->getPaginationLink('supplier', $supplier, false, true)}
	{else}
		{assign var='csrequest' value=$link->getModuleLink('csblog','categoryPost')}
		
	{/if}
	{if isset($cs_blog_category['id_cs_blog_category']) && $cs_blog_category['id_cs_blog_category']}
	{assign var='url' value=$csLink->getCategoryPostLink($cs_blog_category['id_cs_blog_category'],$cs_blog_category['link_rewrite'])}
	{assign var='csrequest' value=$csLink->getPaginationLinkBlog($url)}
	{else}
	{assign var='csrequest' value=$link->getModuleLink('csblog','categoryPost')}
	{/if}
{/if}
<script type="text/javascript">
//<![CDATA[
$(document).ready(function()
{
	$('.selectPostSort').change(function()
	{
		var csrequestSortProducts = '{$csrequest}';
		var splitData = $(this).val().split(':');
		document.location.href = csrequestSortProducts + ((csrequestSortProducts.indexOf('?') < 0) ? '?' : '&') + 'orderby=' + splitData[0] + '&orderway=' + splitData[1];
	});
});
//]]>
</script>

<form id="productsSortForm" action="{$csrequest|escape:'htmlall':'UTF-8'}">
	<p class="select">
		<label for="selectPrductSort">{l s='Sort by'}</label>
		<select id="selectPrductSort" class="selectPostSort">
			{if !$PS_CATALOG_MODE}
				<option value="date_add:asc" {if $pl_orderby eq 'date_add' AND $pl_orderway eq 'asc'}selected="selected"{/if}>{l s='Date created: Oldest first'}</option>
				<option value="date_add:desc" {if $pl_orderby eq 'date_add' AND $pl_orderway eq 'desc'}selected="selected"{/if}>{l s='Date created: Most recent first'}</option>
			{/if}
			<option value="name:asc" {if $pl_orderby eq 'name' AND $pl_orderway eq 'asc'}selected="selected"{/if}>{l s='Post title: A to Z'}</option>
			<option value="name:desc" {if $pl_orderby eq 'name' AND $pl_orderway eq 'desc'}selected="selected"{/if}>{l s='Post title: Z to A'}</option>
		</select>
	</p>
</form>
<!-- /Sort products -->

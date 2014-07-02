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

{* On 1.5 the var request is setted on the front controller. The next lines assure the retrocompatibility with some modules *}
{if !isset($request)}
	<!-- Sort products -->
	{if isset($smarty.get.id_category) && $smarty.get.id_category}
		{assign var='request' value=$link->getPaginationLink('category', $category, false, true)}
	{elseif isset($smarty.get.id_manufacturer) && $smarty.get.id_manufacturer}
		{assign var='request' value=$link->getPaginationLink('manufacturer', $manufacturer, false, true)}
	{elseif isset($smarty.get.id_supplier) && $smarty.get.id_supplier}
		{assign var='request' value=$link->getPaginationLink('supplier', $supplier, false, true)}
	{else}
		{assign var='request' value=$link->getPaginationLink(false, false, false, true)}
	{/if}
{/if}
{if isset($cs_blog_category['id_cs_blog_category']) && $cs_blog_category['id_cs_blog_category']}
	{assign var='url' value=$csLink->getCategoryLink($cs_blog_category['id_cs_blog_category'],$cs_blog_category['link_rewrite'])}
	{assign var='request' value=$csLink->getPaginationLinkBlog($url)}
{/if}
<script type="text/javascript">
//<![CDATA[
$(document).ready(function()
{
	$('.selectPostSort').change(function()
	{
		var requestSortProducts = '{$request}';
		var splitData = $(this).val().split(':');
		document.location.href = requestSortProducts + ((requestSortProducts.indexOf('?') < 0) ? '?' : '&') + 'orderby=' + splitData[0] + '&orderway=' + splitData[1];
	});
});
//]]>
</script>
<div class="sort_form">
<label for="selectPrductSort{if isset($paginationId)}_{$paginationId}{/if}">{l s='Sort by'}</label>
<span class="rss"><a href="{$link->getModuleLink('csblog','blogrss')}" title="{l s='rss' mod='csblog'}">rss</a></span>
<div id="sort" class="option-set clearfix" data-option-key="sortBy">
	<div class="option_selected"><span class="text_seleted">{l s='--'}</span><span class="icon_change">+</span></div>
	<ul class="option_change" style="display:none">
		<li><a href="#sortBy=original-order" data-option-value="name" data-order="asc" class="selected">{l s='--'}</a></li>
		<li><a href="#name:asc" data-option-value="name" data-order="asc">{l s='Product Name: A to Z' mod='csblog'}</a></li>
		<li><a href="#name:desc" data-option-value="name" data-order="desc">{l s='Product Name: Z to A' mod='csblog'}</a></li>
		<li><a href="#date_add:asc" data-option-value="date_add" data-order="asc">{l s='Date created: recent first' mod='csblog'}</a></li>
		<li><a href="#date_add:desc" data-option-value="date_add" data-order="desc">{l s='Date created: most oldest first' mod='csblog'}</a></li>
	</ul>
</div>

</div>
<!-- /Sort products -->

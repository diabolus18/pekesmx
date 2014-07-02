{*
* 2007-2013 PrestaShop
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
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}


{include file="$tpl_dir./errors.tpl"}

{if isset($category)}
	{if $category->id AND $category->active}
		<h1>
			{strip}
				{$category->name|escape:'htmlall':'UTF-8'}
				{if isset($categoryNameComplement)}
					{$categoryNameComplement|escape:'htmlall':'UTF-8'}
				{/if}
			{/strip}
		</h1>		
		{if $scenes || $category->description || $category->id_image}
		<div class="content_scene_cat">
			{if $scenes}
				<!-- Scenes -->
				{include file="$tpl_dir./scenes.tpl" scenes=$scenes}
			{else}
				<!-- Category image -->
				{if $category->id_image}
				<div class="align_center">
					<img src="{$link->getCatImageLink($category->link_rewrite, $category->id_image, 'category_default')|escape:'html'}" alt="{$category->name|escape:'htmlall':'UTF-8'}" title="{$category->name|escape:'htmlall':'UTF-8'}" id="categoryImage" data-animate="fadeInDown" data-delay="0"/>
				</div>
				{/if}
			{/if}

			{if $category->description}
				<div class="cat_desc">
				{if strlen($category->description) > 120}
					<p id="category_description_short">{$category->description|truncate:120}</p>
					<p id="category_description_full" style="display:none">{$category->description}</p>
					<a href="#" onclick="$('#category_description_short').hide(); $('#category_description_full').show(); $(this).hide(); return false;" class="lnk_more">{l s='More'}</a>
				{else}
					<p>{$category->description}</p>
				{/if}
				</div>
			{/if}
		</div>
		{/if}
		{if isset($subcategories)}
		<!-- Subcategories -->
		<div id="subcategories" data-animate="fadeInDown" data-delay="0">
			<h3>{l s='Subcategories'}</h3>
			<ul class="inline_list">
			{foreach from=$subcategories item=subcategory name=subcategories}
				<li class="clearfix">
					<a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'htmlall':'UTF-8'}" title="{$subcategory.name|escape:'htmlall':'UTF-8'}" class="img">
						{if $subcategory.id_image}
							<img src="{$link->getCatImageLink($subcategory.link_rewrite, $subcategory.id_image, 'medium_default')|escape:'html'}" alt="" width="{$mediumSize.width}" height="{$mediumSize.height}" />
						{else}
							<img src="{$img_cat_dir}default-medium_default.jpg" alt="" width="{$mediumSize.width}" height="{$mediumSize.height}" />
						{/if}
					</a>
					<a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'htmlall':'UTF-8'}" class="cat_name">{$subcategory.name|escape:'htmlall':'UTF-8'|truncate:16:'...'}</a>
					{if $subcategory.description}
						<p class="cat_desc">{$subcategory.description|truncate:60:'...'|strip_tags}</p>
					{/if}
				</li>
			{/foreach}
			</ul>
			<br class="clear"/>
		</div>
		{/if}
		{if $category->id == 1 OR $nb_products == 0}
		<div class="resumecat category-product-count" data-animate="fadeInDown" data-delay="0">
			{l s='There are no products in  this category'}	
		</div>
		{/if}
		{if $products}
			<div class="content_sortPagiBar top" data-animate="fadeInDown" data-delay="0">
				
				<div class="sortPagiBar clearfix">
					{include file="./product-compare.tpl"}
					{include file="./product-sort.tpl"}
					{include file="./nbr-product-page.tpl"}
				</div>
			</div>
			
			{include file="./product-list.tpl" products=$products}
			
			<div class="content_sortPagiBar bottom" data-animate="fadeInLeft" data-delay="0">
				<div class="resumecat category-product-count">
					{include file="$tpl_dir./category-count.tpl"}
				</div>
				{include file="./pagination.tpl" paginationId='bottom'}
			</div>
		{/if}
	{elseif $category->id}
		<p class="warning">{l s='This category is currently unavailable.'}</p>
	{/if}
{/if}

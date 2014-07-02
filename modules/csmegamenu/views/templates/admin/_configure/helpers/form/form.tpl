{*
* 2007-2014 PrestaShop
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
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{extends file="helpers/form/form.tpl"}
{block name="field"}
	{$smarty.block.parent}
	{if $input.type == 'file' && isset($picture_icon)}
		<label for="display" class="control-label col-lg-3 ">
		</label>
		<div class="col-lg-2" id="show_image_icon">
			<img  src="{$base_url}{$picture_icon}" style="width:50px;height:50px;"/>
			<img style="cursor:pointer;" id="img_delete_icon" src="{$_PS_ADMIN_IMG_}delete.gif" alt="{l s='Delete icon' mod='csmegamenu'}" title="{l s='Delete icon' mod='csmegamenu'}" />
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#img_delete_icon").click(function(){
					$("input[name=has_picture]").val("");
					$("#show_image_icon").hide();
				});
			})
		</script>
	{/if}
{/block}
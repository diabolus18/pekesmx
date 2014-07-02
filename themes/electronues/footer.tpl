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

			{if !$content_only}
					</div><!-- /Center -->
			{if $page_name != 'index'}
				{if isset($right_column_size) && !empty($right_column_size)}
					<!-- Right -->
							<div id="right_column" class="{if $page_name == 'index'}{$settings->right_class_home}{/if} grid_{$right_column_size|intval} omega">
								<div class="right_content">
									{if $page_name == "module-csblog-listpost" || $page_name == "module-csblog-detailpost" || $page_name == "module-csblog-listposttag"}
										{if isset($CS_BLOG_HOOK_RIGHT_COLUMN)}{$CS_BLOG_HOOK_RIGHT_COLUMN}{/if}
									{else}
										{$HOOK_RIGHT_COLUMN}
									{/if}
								</div>
								<!--fix block layered for case 3 column-->
								{if $right_column_size && $left_column_size}
								<script type="text/javascript">
									if($(".right_content").children("#layered_block_left").length>0)
									{
										$(".right_content").children("#layered_block_left").css("display","none");
										$(".right_content").children("#layered_block_left").remove();
									}
								</script>
								{/if}
							</div>
					{/if}
				
			{/if}
				</div><!--/columns-->
				</div><!--/grid_24-->
			</div><!--/container_24-->
			</div>
<!-- Footer -->
			<div class="mode_footer clearfix">
				<div class="container_24">
					<div class="grid_24">
						{if $page_name !='pagenotfound'}
						{if isset($HOOK_CS_FOOTER_TOP) && $HOOK_CS_FOOTER_TOP}
							<div class="mode_footer_top clearfix">
								{$HOOK_CS_FOOTER_TOP}				
							</div>
						{/if}						
						<div class="mode_footer_main clearfix">
							<div id="footer" class="grid_16 alpha omega">
								{$HOOK_FOOTER}
							</div>
							
							<div class="footer_right grid_8 omega alpha" data-animate="fadeInLeft" data-delay="0">
								<div class="footer_content">
									{if isset($HOOK_CS_FOOTER_RIGHT) && $HOOK_CS_FOOTER_RIGHT}
										{$HOOK_CS_FOOTER_RIGHT}
									{/if}
								</div>
							</div>
							
						</div>
						{/if}
						<div class="footer_bottom clearfix">
							{if isset($HOOK_CS_FOOTER_BOTTOM) && $HOOK_CS_FOOTER_BOTTOM}
								{$HOOK_CS_FOOTER_BOTTOM}
							{/if}					
						</div>
					</div>
				</div>
			</div>
			<div id="toTop">top</div>
		</div><!--/page-->
	{/if}
	<script src="{$js_dir}products-comparison _15.js" type="text/javascript"></script>
	{include file="$tpl_dir./global.tpl"}
	</body>
</html>

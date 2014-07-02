<div class="cs_mega_menu" id="menu_home">
	<div class="cs_mega_menu_cat">
		<div class="shop_by"><span class="shop_by">{l s='All Categories' mod='csmegamenu'}</span></div>
	</div>
</div>
{if isset($responsive_menu) && $responsive_menu}
<div id="megamenu-responsive">
    <ul id="megamenu-responsive-root">
        <li class="menu-toggle"><p></p>{l s='All Categories' mod='csmegamenu'}</li>
        <li class="root">
            {$responsive_menu}
        </li>
    </ul>
</div>
{/if}

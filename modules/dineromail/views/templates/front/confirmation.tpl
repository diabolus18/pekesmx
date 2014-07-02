{*
 * Dineromail IPN Payment Gateway Module for Prestashop
 *
 *  @author Rinku Kazeno <development@kazeno.co>
 *  @file-version 1.5
 *}

<h2>{$titleText}</h2>

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

{$currencyText}
{$dineromailForm}
<br /><br />
<div style="display: block; font-size: 18px; font-weight: 800; line-height: 24px; text-decoration: none; text-align: center;">{$loadingText}
<br /><br /><br /><img src="modules/dineromail/img/loader.gif" alt="{$loaderText}" /></div>

{literal} 
<script>//<!--
    $(document).ajaxSend(function(e, xhr) {     //block all ajax requests on page
        xhr.abort();
    });
    $(document).ready(function() {
        $('#dineromail_form').submit();
    });
//--></script>
{/literal}
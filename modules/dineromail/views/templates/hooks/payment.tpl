{*
 * Dineromail IPN Payment Gateway Module for Prestashop
 *
 *  @author Rinku Kazeno <development@kazeno.co>
 *  @file-version 1.4
 *}

<p class="payment_module">
    <a href="{$paymentPath}" title="{$buttonText}">
        <img src="{$imagePath}dineromail.jpg" alt="{$buttonText}" /> {$buttonText}
        <br/><br/> <strong>{$dmFee}</strong><br/>
    </a>
    <script>//<!--      loader image preloading to cache
        $('<img src="{$imagePath}loader.gif" />');
    //--></script>
</p>
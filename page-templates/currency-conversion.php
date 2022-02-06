<?php
/**
 * Template Name: Currency Conversion Page
 */
get_header();

// fetch the saved values as per the currency options page in the wp admin panel
$conversionPrice = get_option('conversionPrice', '');
$baseCurrency = get_option('from1', '');
$conversionCurrency = get_option('to1', '');
?>

<div class="container">
    <div class="row">
        <h4 class="my-4">Currency Conversion:</h4>
        <div class="col-8">
            <form action="post" id="currencyCalucator">
                <div class="row align-items-center">
                    <div class="col-2">
                        <input type="hidden" class="form-control" id="pricevalue" placeholder="Price" value="<?php echo esc_attr($conversionPrice); ?>" required>
                    </div>
                    <div class="col-3">
                        <input type="hidden" id="fromvalue" value="<?php echo esc_attr($baseCurrency); ?>" class="form-control" placeholder="From" required>
                    </div>
                    <div class="col-3">
                        <input type="hidden" id="tovalue" value="<?php echo esc_attr($conversionCurrency); ?>" class="form-control" placeholder="To" required>
                    </div>
                </div>
            </form>
            <div class="afterresult" style="display:none;">
                <div role="alert" id="currentrate"></div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
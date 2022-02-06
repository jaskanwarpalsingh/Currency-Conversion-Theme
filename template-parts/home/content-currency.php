<?php
/**
 * Template part for displaying posts
 *
 * @package Twenty Twenty-One child
 */
?>
<div class="container mt-4">
    <div class="col-lg-8">
        <form class="form mt-4 g-3 adminCurrencyConversion bg-light rounded" method="POST">
            <h4 class="page-header mb-3">Currency Conversion Options:</h4>

            <?php wp_nonce_field($args['fields']['currency_conversion'], $args['fields']['currency_conversion']);?>
            
            <div class="row">
                <div class="col">
                    <?php echo getinputFields(array('label' => true, 'labeltext' => 'API Key', 'required' => true), array('inputtype' => 'text', 'name' => 'apikey', 'required' => true, 'value' => $args['fields']['apikey'])); ?>
                </div>
                <div class="col">
                    <?php echo getinputFields(array('label' => true, 'labeltext' => 'API Base URL', 'required' => true), array('inputtype' => 'url', 'name' => 'apiurl', 'required' => true, 'value' => $args['fields']['apiurl'])); ?>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <?php echo getinputFields(array('label' => true, 'labeltext' => 'Country API Base URL', 'required' => true), array('inputtype' => 'url', 'name' => 'countryapiurl', 'required' => true, 'value' => $args['fields']['countryapiurl'])); ?>
                </div>
            </div>
            
            <div class="row mt-4">
                <h4>Currency Conversion Pairing:</h4>
                <div class="col-2">
                    <label for="">Amount</label>
                </div>
                <div class="col-4">
                    <label for="">From</label>
                </div>
                <div class="col-2 d-flex align-items-center"></div>
                <div class="col-4">
                    <label for="">To</label>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-2 d-flex align-items-center">
                    <?php echo getinputFields(array('label' => false, 'labeltext' => 'Amount', 'required' => true), array('inputtype' => 'number', 'name' => 'conversionPrice', 'required' => true, 'value' => $args['fields']['conversionPrice'])); ?>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <select name="from1" id="" required>
                        <option value="">Choose Currency</option>
                        <?php echo getoptionSelection($args['fields']['optionfield1'], $args['fields']['from1']); ?>
                    </select>
                </div>
                <div class="col-2 d-flex align-items-center">&oplus;</div>
                <div class="col-4 d-flex align-items-center">
                    <select name="to1" id="" required>
                        <option value="">Choose Currency</option>
                        <?php echo getoptionSelection($args['fields']['optionfield2'], $args['fields']['to1']); ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
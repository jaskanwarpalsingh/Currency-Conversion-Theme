jQuery(document).ready(function () {

    // fetch the values from the front end templates and declare the variables accordingly
    var priceValue = jQuery('#pricevalue').val();
    var fromValue = jQuery('#fromvalue').val();
    var toValue = jQuery('#tovalue').val();

    // declare the action name
    var conversionlogic = 'standartconversion';

    // ajax request to fetch the currency conversion values as per the passed parameters
    jQuery.ajax({
        url: currencycon_params.ajaxurl,
        type: 'POST',
        data: {
            action: 'currencyConversion',
            price: priceValue,
            from: fromValue,
            to: toValue,
            conversion: conversionlogic
        },
        success: function (data) {

            // pass the values in the html and display the sections
            jQuery('.afterresult').show();
            jQuery('#currentrate').html(data);
        }
    });

});
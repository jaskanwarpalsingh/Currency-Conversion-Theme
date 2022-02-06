<?php

/**
 * function responsible for the conversion of the selected currencies
 * 
 * currencyConversion
 *
 * @return void
 */
function currencyConversion() {
	
	/* Get API Related Fields */
	$apiKey = get_option('apikey', '');
	$apiURL = get_option('apiurl', '');
	$countryAapiBaseURL = get_option('countryapiurl', '');
	$trimSlashURL = preg_replace('{/$}', '', $apiURL);
	
	// validate the values before proceeding to actual logic
	if($_POST['price'] !== '' && $_POST['from'] !== '' && $_POST['to'] !== '') {
	
		// declare variables 
		$to = strtoupper($_POST['to']);
		$from = strtoupper($_POST['from']);
		$price = $_POST['price'];

		// call the conversion api function 
		$responseJson = conversion($trimSlashURL, $apiKey, $_POST['conversion'], $to, $from);
		
		// assign the ssl values for the country details api
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		
		// Grab Country Name
		$countryAPIURL = $countryAapiBaseURL.$to;
		$currencybyCountryJson = file_get_contents($countryAPIURL, false, stream_context_create($arrContextOptions));
		
		/* Continuing if we got a result */
		if(false !== $responseJson) {

			$response = json_decode($responseJson);
			$responseofCountry = json_decode($currencybyCountryJson);
			
			// Check for success
			if('success' === $response->result) {
			
				$calculatedFigure = ($price * $response->conversion_rates->$to);
				$Totalprice = round($calculatedFigure, 2);
				if($Totalprice == 0) {
					$Totalprice = $calculatedFigure;
				}

				echo $price.' '.$from.' = '.$Totalprice.' '.$to.'<br>';
				
				/* Print conversion */
				if(!empty($responseofCountry)) {
					array_map(function($data){
						$data->total_languages = count((array)$data->languages);
						return $data;
					},$responseofCountry);
					$responseofCountry = json_decode(json_encode($responseofCountry), true);
					$total_languages = array_column($responseofCountry, 'total_languages');
					$key = array_search( max($total_languages), $total_languages);
					$country_name = $responseofCountry[$key]['name']['common'];
					echo "The " .$to. " currency is used in ".$country_name.'<br><br>';
					echo "<strong>Languages spoken in ".$country_name.":</strong>"; ?>
					<ul class="mt-2"><li> <?php echo implode("</li><li>", $responseofCountry[$key]['languages']); ?> </li></ul>
					<?php
				}
			}
		}
	}
	wp_die();
}
add_action('wp_ajax_currencyConversion', 'currencyConversion');
add_action('wp_ajax_nopriv_currencyConversion', 'currencyConversion');

/**
 * function responsible to hit the conversoin api and fetch the converted currency values
 * 
 * conversion
 *
 * @param  url $trimSlashURL
 * @param  string $apiKey
 * @param  array $conversionParam
 * @param  string $to
 * @param  string $from
 * @return json
 */
function conversion($trimSlashURL, $apiKey, $conversionParam, $to, $from) {
	if($conversionParam == 'standartconversion') {
		$standardConversionURL = $trimSlashURL.'/'.$apiKey.'/latest/'.$from;
		$response_json = file_get_contents($standardConversionURL);
	}
	return $response_json;
}

/**
 * function used to the add the option page in the admin panel
 * 
 * currency_conversion_add_menu
 *
 * @return void
 */
function currency_conversion_add_menu() {
	$page_title = 'Currency';
	$menu_title = 'Currency';
	$capability = 'edit_posts';
	$menu_slug = 'currency_conversion';
	$function = 'currency_conversion_options_display';
	$icon_url = 'dashicons-admin-site-alt2';
	$position = 24;
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}
add_action('admin_menu', 'currency_conversion_add_menu');


/**
 * function used to display the currency output
 * 
 * currency_conversion_options_display
 *
 * @return void
 */
function currency_conversion_options_display() {
	//Add CSS file for form formatting
	$handle = 'bootstrap.min.css';
	$list = 'enqueued';
	$ccd_string = 'currency_conversion_display';
	if (wp_style_is( $handle, $list )) {
		return;
	} else {
		wp_register_style( 'bootstrap.min.css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' );
		wp_enqueue_style( 'bootstrap.min.css' );
	}

	if (!empty($_POST)) {
		if (isset( $_POST[$ccd_string] ) && $_POST[$ccd_string] != "" || wp_verify_nonce( $_POST[$ccd_string], $ccd_string )) {
			$post_keys = array('apikey','apiurl','countryapiurl','conversionPrice','from1','to1');
			foreach($post_keys as $key) {
				if (isset($_POST[$key]) && !empty($_POST[$key])) {
					update_option($key, $_POST[$key]); 
				}
			}

		}
	}

	$postedFields = array(
		'currency_conversion' => 'currency_conversion_display',
		'apikey' => get_option('apikey',''),
		'apiurl' => get_option('apiurl',''),
		'countryapiurl' => get_option('countryapiurl',''),
		'conversionPrice' => get_option('conversionPrice',''),
		'from1' => get_option('from1',''),
		'to1' => get_option('to1',''),
		'optionfield1' => array("USD","CAD","INR","AUD","EUR"),
		'optionfield2' => array("USD","CAD","INR","AUD","EUR"), 
	);

	/* Admin Form */
	get_template_part( 'template-parts/home/content', 'currency', array('fields'=>$postedFields) );
}

/**
 * function used to generate the html fields for the options page
 * 
 * getinputFields
 *
 * @param  array $label
 * @param  array $input
 * @return string
 */
function getinputFields(array $label,array $input) {
	if($label['label']) {
		$inputvalue .= '<label for="'.strtolower(str_replace(' ','',$label['labeltext'])).'" class="form-label">'.$label['labeltext'];
		if($label['required']) {
			$inputvalue .= '<span class="currency_required">*</span>';
		}
		$inputvalue .= '</label>';
	}
	if ($input['required']) {
		$required = 'required';
	}
	$inputvalue .= '<input type="'.$input['inputtype'].'" class="form-control" name="'.$input['name'].'" value="'.$input['value'].'" '.$required.'>';
	return $inputvalue;
}

/**
 * function used to create the dropdown with currency codes
 * 
 * getoptionSelection
 *
 * @param  array $optionfields
 * @param  string $postedvalue
 * @return string
 */
function getoptionSelection($optionfields, $postedvalue) {
	foreach($optionfields as $value) {
		if ($postedvalue == $value) {
			$selection = 'selected="selected"';
		} else {
			$selection = '';
		}
		$valueretn .= "<option value='".$value."' ".$selection.">".$value."</option>";
	}
	return $valueretn;
}
?>
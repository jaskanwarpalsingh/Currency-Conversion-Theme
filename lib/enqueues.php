<?php

/**!
 * Enqueues
 */

 //enqueues style and scripts
if (!function_exists('currencycon_enqueues')) {

	add_action('wp_enqueue_scripts', 'currencycon_enqueues', 1000);

	function currencycon_enqueues()
    {
        global $wp_query;

		wp_register_style('rgs-font-awesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0', null);
        wp_enqueue_style('rgs-font-awesome-css');
		
		// Gogole fonts and bootstrap styles
        wp_register_style('currencycon-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css', false, null);
        wp_enqueue_style('currencycon-bootstrap');
		
		//Main Css
        $currencyconStyleTime = filemtime(get_stylesheet_directory() . '/assets/css/currencycon.css');
        wp_register_style('currencycon-style', get_stylesheet_directory_uri() . '/assets/css/currencycon.css', false, $currencyconStyleTime, null);
        wp_enqueue_style('currencycon-style');
		
		// register our main script but do not enqueue it yet
        wp_register_script('currencycon_js', get_stylesheet_directory_uri() . '/assets/js/currencycon.js', array('jquery'));
        wp_enqueue_script('currencycon_js');
        wp_localize_script('currencycon_js', 'currencycon_params', array(
            'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        ));
    }
}


/**
 * function used to append the js/css script files in the wp admin panel
 * 
 * admin_js_add
 *
 * @return void
 */
function admin_js_add()
{
    wp_enqueue_media();

	// css related to 'currency' options page in the admin panel
    wp_register_style('admin.css', get_stylesheet_directory_uri() . '/assets/css/admin.css');
    wp_enqueue_style('admin.css');
    
	// js related to 'currency' options page in the admin panel
	wp_enqueue_script('admin_js_add_develop', get_stylesheet_directory_uri() . '/assets/js/admin.js');
}
add_action('admin_enqueue_scripts', 'admin_js_add');

<?php

ob_start();

//Basic settings for the parent theme starts
define('MAIN_DIR', get_template_directory_uri());
define('SITEURL', site_url());
add_filter('show_admin_bar', '__return_false');

//clean up WP header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Implement the enqueuing file
 */
require get_stylesheet_directory() . '/lib/enqueues.php';

/**
 * Implement the custom-functions file
 */
require get_stylesheet_directory() . '/lib/custom-functions.php';

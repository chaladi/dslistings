<?php
/*
Plugin Name: DS Listing
Plugin URI: http://dimensionit.com/projects/wordpress/DS Listing-plugin/
Description: A plugin for WordPress.
Version: 0.7.20
Author: Venu Gopal Chaladi, Harika
Author URI: http://dimensionit.com/
Text Domain: LIsting
*/

include( plugin_dir_path( __FILE__ ) . 'includes/dslisting_init.php');
include( plugin_dir_path( __FILE__ ) . 'includes/dslisting_admin.php');
include( plugin_dir_path( __FILE__ ) . 'includes/dslisting_fe.php');
include( plugin_dir_path( __FILE__ ) . 'includes/dslisting_freelisting.php');


include( plugin_dir_path( __FILE__ ) . 'dslistingsearch.php');

function dslisting_admin_scripts() {
	wp_enqueue_style( 'uikitcss', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.15.0/css/uikit.min.css');
	wp_enqueue_style( 'dslistingadmincss', WP_PLUGIN_URL.'/dslisting/css/dslistingadmin.css');
	wp_register_script('uikitjs', "https://cdnjs.cloudflare.com/ajax/libs/uikit/2.15.0/js/uikit.min.js", array('jquery','media-upload','thickbox'));
	wp_enqueue_script('uikitjs');
	wp_register_script('dslistingadmin', WP_PLUGIN_URL.'/dslisting/js/dslisting_admin.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('dslistingadmin');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-tabs');
	//wp_register_script('ds-google-maps', 'http://maps.googleapis.com/maps/api/js?sensor=false');

	//wp_enqueue_script('ds-google-maps');

	if(function_exists( 'wp_enqueue_media' )){
		wp_enqueue_media();

	}else{
		wp_enqueue_style('thickbox');	
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');	

	}

}

add_action('admin_enqueue_scripts', 'dslisting_admin_scripts');




function dscoupons_front_scripts() {
	//global $pagenow, $typenow;
	wp_enqueue_style( 'uikitcss', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.15.0/css/uikit.min.css');
	wp_enqueue_style( 'dslistingfecss', WP_PLUGIN_URL.'/dslisting/css/dslisting.css');
	wp_register_script('uikitjs', "https://cdnjs.cloudflare.com/ajax/libs/uikit/2.15.0/js/uikit.min.js", array('jquery','media-upload','thickbox'));
	wp_enqueue_script('uikitjs');
	wp_register_script('dslistingfe', WP_PLUGIN_URL.'/dslisting/js/dslisting_front.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('dslistingfe');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-tabs');
	//wp_register_script('ds-google-maps', 'http://maps.googleapis.com/maps/api/js?sensor=false');
	//wp_enqueue_script('ds-google-maps');
	if(function_exists( 'wp_enqueue_media' )){

		wp_enqueue_media();

	}else{
		wp_enqueue_style('thickbox');	
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');	
	}
}

add_action('wp_enqueue_scripts', 'dscoupons_front_scripts');




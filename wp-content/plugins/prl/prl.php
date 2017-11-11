<?php
/*
	Plugin Name: PRL
	Plugin URL: http://aleximbir.me
	Description: Romanian auction platform.
	Version: 1.0.0
	Author: Alex Imbir
	Author URI: http://aleximbir.me
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

DEFINE( "prl_VERSION", "1.0.0" );
DEFINE( "prl_RELEASE", "1 Ian 2018" );

function prl_dir_url() {
	return plugin_dir_path( __FILE__ );
}

add_action('wp_enqueue_scripts', 'prl_load_scripts');
function prl_load_scripts() {
	wp_enqueue_style( 'semantic-style', plugins_url( '/assets/css/semantic.min.css', __FILE__ ), prl_VERSION );
	wp_enqueue_script( 'semantic-js', plugins_url( '/assets/js/semantic.min.js', __FILE__ ), array( 'jquery' ), prl_VERSION );
}

include prl_dir_url() . 'includes/functions/prl-general-functions.php';
include prl_dir_url() . 'controllers/shortcodes/prl-user-shortcodes.php';
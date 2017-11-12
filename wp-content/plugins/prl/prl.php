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
	// Plugin
	wp_enqueue_style( 'main-style', plugins_url( '/assets/css/style.css', __FILE__ ), prl_VERSION );
	wp_enqueue_script( 'main-js', plugins_url( '/assets/js/script.js', __FILE__ ), array( 'jquery' ), prl_VERSION );

	// Semantic UI
	wp_enqueue_style( 'semantic-style', plugins_url( '/assets/css/semantic.min.css', __FILE__ ), prl_VERSION );
	wp_enqueue_script( 'semantic-js', plugins_url( '/assets/js/semantic.min.js', __FILE__ ), array( 'jquery' ), prl_VERSION );
}



add_action( 'init', 'prl_include_shortcodes' );
function prl_include_shortcodes(){
	include_once prl_dir_url() . 'includes/functions/prl-general-functions.php';

	$shortcodes = prl_scan_folders( prl_dir_url() . 'controllers' );
	foreach ( $shortcodes as $key => $var ) {
		include_once $var;
	}
}

function prl_scan_folders( $dir, &$ret = [] ) {
	$files = scandir( $dir );

	foreach ( $files as $key => $filename ) {
		$path = realpath( $dir . DIRECTORY_SEPARATOR . $filename );
		if ( ! is_dir( $path ) ) {
			$ret[] = $path;
		} else if ( $filename != "." && $filename != ".." ) {
			prl_scan_folders( $path, $ret );
		}
	}

	return $ret;
}


<?php
/*
	Plugin Name: PRL
	Plugin URL: http://aleximbir.me
	Description: Romanian auction platform.
	Version: 1.0.0
	Author: Alex Imbir
	Author URI: http://aleximbir.me
	Text Domain: prl
*/

// Define plugin version
DEFINE( "PRL_VERSION", "1.0.0" );

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define PRL_PLUGIN_FILE.
if ( ! defined( 'PRL_PLUGIN_FILE' ) ) {
	define( 'PRL_PLUGIN_FILE', __FILE__ );
}

// Include the main PRL file.
include_once plugin_dir_path( PRL_PLUGIN_FILE ) . 'includes/functions/setup.php';

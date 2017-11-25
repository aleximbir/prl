<?php
// Plugin URL
function prl_plugin_url() {
	return untrailingslashit( plugins_url( '/', PRL_PLUGIN_FILE ) ) . '/';
}

// Plugin Path
function prl_plugin_path() {
	return untrailingslashit( plugin_dir_path( PRL_PLUGIN_FILE ) ) . '/';
}

// Plugin Enqueues
add_action('wp_enqueue_scripts', 'prl_load_scripts');
function prl_load_scripts() {
	// Plugin
	wp_enqueue_style( 'main-style', plugins_url( '/assets/css/style.css', PRL_PLUGIN_FILE ), prl_VERSION );
	wp_enqueue_script( 'main-js', plugins_url( '/assets/js/script.js', PRL_PLUGIN_FILE ), array( 'jquery' ), prl_VERSION );

	// Semantic UI
	wp_enqueue_style( 'semantic-style', plugins_url( '/assets/css/semantic.min.css', PRL_PLUGIN_FILE ), prl_VERSION );
	wp_enqueue_script( 'semantic-js', plugins_url( '/assets/js/semantic.min.js', PRL_PLUGIN_FILE ), array( 'jquery' ), prl_VERSION );
}

// Plugin Includes
add_action( 'init', 'prl_includes' );
function prl_includes(){

	// Classes
	$classes = prl_scan_folders( prl_plugin_path() . 'includes/classes' );
	foreach ( $classes as $ckey => $cvar ) {
		include_once $cvar;
	}

	// Functions
	$functions = prl_scan_folders( prl_plugin_path() . 'includes/functions' );
	foreach ( $functions as $fkey => $fvar ) {
		include_once $fvar;
	}

	// Shortcodes
	$shortcodes = prl_scan_folders( prl_plugin_path() . 'controllers' );
	foreach ( $shortcodes as $skey => $svar ) {
		include_once $svar;
	}
}

// Plugin Activation
register_activation_hook( __FILE__, 'prl_activation' );
function prl_activation(){

	// Activation
	$classes = prl_scan_folders( prl_plugin_path() . 'includes/first-run' );
	foreach ( $classes as $ckey => $cvar ) {
		include_once $cvar;
	}

}
// Get files path from folders
function prl_scan_folders( $dir = '', &$ret = [] ) {
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
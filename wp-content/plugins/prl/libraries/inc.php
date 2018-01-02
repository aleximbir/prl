<?php
// Dropzone
function prl_enq_dropzone_script() {
	wp_enqueue_script( 'dropzone-js', plugins_url('/libraries/dropzone/dropzone.min.js', PRL_PLUGIN_FILE ), array( 'jquery' ),PRL_VERSION );
	wp_enqueue_style( 'dropzone-css', plugins_url( '/libraries/dropzone/dropzone.min.css', PRL_PLUGIN_FILE ), PRL_VERSION );
}

// TinyMCE
function prl_enq_tinymce_script() {
	wp_enqueue_script( 'tinymce-js', plugins_url('/libraries/tinymce/tinymce.min.js', PRL_PLUGIN_FILE ), array( 'jquery' ),PRL_VERSION );
}

add_action('wp_enqueue_scripts', 'prl_enq_default_scripts_and_styles');
function prl_enq_default_scripts_and_styles() {
	// Semantic UI
	wp_enqueue_style( 'semantic-style', plugins_url( '/libraries/semantic/semantic.min.css', PRL_PLUGIN_FILE ), PRL_VERSION );
	wp_enqueue_script( 'semantic-js', plugins_url( '/libraries/semantic/semantic.min.js', PRL_PLUGIN_FILE ), array( 'jquery' ), PRL_VERSION );

	// Font Awesome
	wp_enqueue_style( 'font-awesome-style', plugins_url( '/libraries/fontawesome/font-awesome.min.css', PRL_PLUGIN_FILE ), PRL_VERSION );

	// Initializations
	wp_enqueue_script( 'init-js', plugins_url( '/libraries/init.js', PRL_PLUGIN_FILE ), array( 'jquery' ), PRL_VERSION );
	wp_enqueue_style( 'init-css', plugins_url( '/libraries/init.css', PRL_PLUGIN_FILE ), PRL_VERSION );
}
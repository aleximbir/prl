<?php
add_shortcode( 'prl_user_registration', 'prl_user_registration_shortcode' );
function prl_user_registration_shortcode(){
	$ret = prl_form( array( 'label' => __( "Username", "prl" ), 'name' => 'username' ) );

	ob_start();
	include prl_dir_url() . 'views/shortcodes/prl-user-shortcodes.php';
	$ret = ob_get_contents();
	ob_clean();

	return $ret;
}
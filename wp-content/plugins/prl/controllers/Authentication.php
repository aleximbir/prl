<?php
add_shortcode( 'prl_user_registration', 'prl_user_registration_shortcode' );
function prl_user_registration_shortcode(){
	$data['nickname']  = prl_form( array( 'type' => 'text', 'name' => 'nickname', 'placeholder' => __( 'Nick Name', 'prl' ) ) );
	$data['firstname'] = prl_form( array( 'type' => 'text', 'name' => 'firstname', 'placeholder' => __( 'First Name', 'prl' ) ) );
	$data['lastname']  = prl_form( array( 'type' => 'text', 'name' => 'lastname', 'placeholder' => __( 'Last Name', 'prl' ) ) );
	$data['email']     = prl_form( array( 'type' => 'email', 'name' => 'email', 'placeholder' => __( 'E-mail', 'prl' ) ) );
	$data['password']  = prl_form( array( 'type' => 'password', 'name' => 'password', 'placeholder' => __( 'Password', 'prl' ) ) );

	$ret = prl_view( 'authentication/register', $data );

	return $ret;
}
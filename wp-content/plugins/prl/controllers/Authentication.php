<?php
add_shortcode( 'prl_user_registration', 'prl_user_registration_shortcode' );
function prl_user_registration_shortcode(){
	$data['nickname']  = prl_form( array( 'type' => 'text', 'name' => 'nickname', 'placeholder' => __( 'Nick Name', 'prl' ) ) );
	$data['firstname'] = prl_form( array( 'type' => 'text', 'name' => 'firstname', 'placeholder' => __( 'First Name', 'prl' ) ) );
	$data['lastname']  = prl_form( array( 'type' => 'text', 'name' => 'lastname', 'placeholder' => __( 'Last Name', 'prl' ) ) );
	$data['email']     = prl_form( array( 'type' => 'email', 'name' => 'email', 'placeholder' => __( 'E-mail', 'prl' ) ) );
	$data['password']  = prl_form( array( 'type' => 'password', 'name' => 'password', 'placeholder' => __( 'Password', 'prl' ) ) );

	$data['register_page'] = get_permalink( get_option( 'user_register_page_id' ) );
	$data['btn_register']  = prl_form( array( 'type' => 'submit', 'name' => 'register_user', 'class' => 'ui button', 'value' => __( 'Register', 'prl' ) ) );

	$ret = prl_view( 'authentication/register', $data );

	if ( prl_isset_post( 'register_user' ) ) {
		$post_data['nickname']  = prl_isset_post( 'nickname' );
		$post_data['firstname'] = prl_isset_post( 'firstname' );
		$post_data['lastname']  = prl_isset_post( 'lastname' );
		$post_data['email']     = prl_isset_post( 'email' );
		$post_data['password']  = prl_isset_post( 'password' );
		
		$ret = prl_model( 'authentication/register', $post_data );
	}

	return $ret;
}
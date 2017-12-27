<?php
add_shortcode( 'prl_user_registration', 'prl_user_registration_shortcode' );
function prl_user_registration_shortcode(){
	$data['lbl_name'] = prl_lbl( 'Name' );
	$data['lbl_authentication'] = prl_lbl( 'Authentication' );

	$data['nickname']  = prl_form( array( 'type' => 'text', 'name' => 'nickname', 'placeholder' => prl_lbl( 'Nick Name' ) ) );
	$data['firstname'] = prl_form( array( 'type' => 'text', 'name' => 'firstname', 'placeholder' => prl_lbl( 'First Name' ) ) );
	$data['lastname']  = prl_form( array( 'type' => 'text', 'name' => 'lastname', 'placeholder' => prl_lbl( 'Last Name' ) ) );
	$data['email']     = prl_form( array( 'type' => 'email', 'name' => 'email', 'placeholder' => prl_lbl( 'E-mail' ) ) );
	$data['password']  = prl_form( array( 'type' => 'password', 'name' => 'password', 'placeholder' => prl_lbl( 'Password' ) ) );

	$data['register_page'] = get_permalink( get_option( 'user_register_page_id' ) );
	$data['btn_register']  = prl_form( array( 'type' => 'submit', 'name' => 'register_user', 'class' => 'ui button', 'value' => prl_lbl( 'Register' ) ) );

	$ret = prl_view( 'authentication/register', $data );

	if ( prl_isset_post( 'register_user' ) ) {
		$post_arr = array( 'nickname', 'firstname', 'lastname', 'email', 'password' );
		foreach ( $post_arr as $key => $var ) {
			$post_data[$var] = prl_isset_post( $var );
		}
		
		$ret = prl_model( 'authentication/register', $post_data );
	}

	return $ret;
}

add_shortcode( 'prl_user_authentication', 'prl_user_authentication_shortcode' );
function prl_user_authentication_shortcode(){
	$data['lbl_authentication'] = prl_lbl( 'Insert authentication data' );

	$data['nickname'] = prl_form( array( 'type' => 'text', 'name' => 'nickname', 'placeholder' => prl_lbl( 'Nick Name' ) . ' or ' . prl_lbl( 'E-mail' ) ) );
	$data['password'] = prl_form( array( 'type' => 'password', 'name' => 'password', 'placeholder' => prl_lbl( 'Password' ) ) );

	$data['login_page'] = get_permalink( get_option( 'user_login_page_id' ) );
	$data['btn_login']  = prl_form( array( 'type' => 'submit', 'name' => 'login_user', 'class' => 'ui button', 'value' => prl_lbl( 'Login' ) ) );

	$ret = prl_view( 'authentication/login', $data );

	if ( prl_isset_post( 'login_user' ) ) {
		$post_data['nickname']  = prl_isset_post( 'nickname' );
		$post_data['password']  = prl_isset_post( 'password' );
		
		$ret = prl_model( 'authentication/login', $post_data );
	}

	return $ret;
}
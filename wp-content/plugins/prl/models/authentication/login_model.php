<?php
function prl_user_authentication( $nickname, $password ){

	if ( $nickname && $password ) {

		$creds = array();
		$creds['user_login'] = $nickname;
		$creds['user_password'] = md5( $password );
		$creds['remember'] = true;

		$user = wp_signon( $creds, false );

		if ( ! is_wp_error( $user ) ) {
			$userID = $user->ID;

			wp_set_current_user( $userID, $nickname );
			wp_set_auth_cookie( $userID, true, false );
		}
		
		do_action( 'wp_login', $nickname );

		if ( is_wp_error( $user ) ){
			echo $user->get_error_message();
		} else {
			echo prl_lbl( 'Login Successfully' );
		}

	}

}
add_action( 'after_setup_theme', 'prl_user_authentication' );
//prl_user_authentication( $nickname, $password );
<?php
if ( $nickname ){
	$user_id = username_exists( $nickname );
	if ( ! $user_id && email_exists( $email ) == false ) {
		$password = md5( $password );
		$user_id = wp_create_user( $nickname, $password, $email );

		$user_id = wp_update_user(
			array(
				'ID' => $user_id,
				'first_name' => $firstname,
				'last_name' => $lastname
			)
		);

		if ( is_wp_error( $user_id ) ) {
			$status = __( 'There was an error, probably that user doesn\'t exist.', 'prl' );
		}		

		$status = __('User registered successfully.', 'prl');
	} else {
		$status = __('User already exists. Password inherited.', 'prl');
	}
} else {
	$status = __('Insert a nickname', 'prl');
}

echo $status;
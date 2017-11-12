<?php
add_action( 'init', 'prl_post_type_arr', 11 );
function prl_post_type_arr( ){
	$args = array( prl_lbl( 'product' ) );

	prl_post_types( $args );
}
<?php
add_action( 'init', 'prl_post_type_arr', 11 );
function prl_post_type_arr( ){
	$args = array(
		'products' => array(
			'singular_name' => prl_lbl( 'product' ),
			'plural_name'   => prl_lbl( 'products' ),
			'description'   => prl_lbl( 'Product Description' ),
		),
	);

	prl_post_types( $args );
}
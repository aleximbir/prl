<?php
add_action( 'init', 'prl_taxonomy_arr', 11 );
function prl_taxonomy_arr() {
	$args = array(
		'product_type' => array(
			'singular_name' => prl_lbl( 'Product Type' ),
			'plural_name'   => prl_lbl( 'Product Types' ),
			'post_type' => 'prl_products',
		),
		'product_category' => array(
			'singular_name' => prl_lbl( 'Product Category' ),
			'plural_name'   => prl_lbl( 'Product Categories' ),
			'post_type' => 'prl_products',
		),
	);

	prl_taxonomies( $args );
}




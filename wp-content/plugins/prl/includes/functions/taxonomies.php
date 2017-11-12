<?php
add_action( 'init', 'prl_taxonomy_arr', 11 );
function prl_taxonomy_arr() {
	$args = array(
		array(
			'name'      => 'product_type',
			'post_type' => 'prl_product',
			'label'     => prl_lbl( 'Product Type' ),
		),
		array(
			'name'      => 'product_category',
			'post_type' => 'prl_product',
			'label'     =>  prl_lbl( 'Product Category' ),
		),
	);

	prl_taxonomies( $args );
}




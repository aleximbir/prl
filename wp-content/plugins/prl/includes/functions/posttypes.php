<?php
// Product
add_action( 'init', 'prl_product_post_type', 11 );
function prl_product_post_type() {
	register_post_type( 'prl_product',
		array(
			'labels' => array(
				'name' => __( 'Products' ),
				'singular_name' => __( 'Product' ),
				'add_new'       => __( 'Add New Product', 'wpjobster' ),
				'new_item'      => __( 'New Product', 'wpjobster' ),
				'edit_item'     => __( 'Edit Product', 'wpjobster' ),
				'add_new_item'  => __( 'Add New Product', 'wpjobster' ),
				'search_items'  => __( 'Search Product', 'wpjobster' )
			),
			'public' => true,
			'has_archive' => true,
		)
	);
}
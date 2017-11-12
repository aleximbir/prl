<?php
// Product
add_action( 'init', 'prl_product_taxonomy', 11 );
function prl_product_taxonomy() {
	register_taxonomy( 'prl_product_type', 'prl_product', array( 'hierarchical' => true, 'label' => __('Product Type', 'wpjobster') ) );
	register_taxonomy( 'prl_product_category', 'prl_product', array( 'hierarchical' => true, 'label' => __('Product Category', 'wpjobster') ) );
}
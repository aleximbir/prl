<?php
add_shortcode( 'prl_add_and_edit_product', 'prl_add_and_edit_product_shortcode' );
function prl_add_and_edit_product_shortcode(){
	$data['lbl_product_details'] = prl_lbl( 'Product details' );
	$data['rows'] = get_post_meta( get_option( 'new_product_page_id' ), 'add_new_product_page', true );
	$data['add_and_edit_product_page'] = get_permalink( get_option( 'new_product_page_id' ) );

	$ret = prl_view( 'products/add_and_edit', $data );

	return $ret;
}
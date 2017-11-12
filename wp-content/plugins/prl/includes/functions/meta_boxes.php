<?php
// Product
add_action( 'add_meta_boxes', 'prl_meta_boxes' );
function prl_meta_boxes() {
	add_meta_box( 'prl_product_price', prl_lbl( 'Price' ), 'prl_display_callback', 'prl_product' );
}

function prl_display_callback( $post ) {
	global $post;
	wp_nonce_field( basename( __FILE__ ), 'prl_product_price_field' );
	$prl_product_price = get_post_meta( $post->ID, 'prl_product_price', true );
	echo prl_form(
		array(
			'type'        => 'text',
			'name'        => 'prl_product_price',
			'placeholder' => prl_lbl( 'Price' ),
			'value'       => $prl_product_price,
			'class'       => 'widefat'
		)
	);
}

add_action( 'save_post', 'prl_save_meta_box', 10, 2 );
function prl_save_meta_box( $post_id, $post ) {

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	if ( ! isset( $_POST['prl_product_price'] ) || ! wp_verify_nonce( $_POST['prl_product_price_field'], basename(__FILE__) ) ) {
		return $post_id;
	}

	$product_meta['prl_product_price'] = esc_textarea( $_POST['prl_product_price'] );

	foreach ( $product_meta as $key => $value ) {

		if ( get_post_meta( $post_id, $key, false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, $key, $value );
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, $key, $value);
		}
		if ( ! $value ) {
			// Delete the meta key if there's no value
			delete_post_meta( $post_id, $key );
		}
		
	}
}


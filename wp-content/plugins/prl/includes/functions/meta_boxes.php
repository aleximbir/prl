<?php
add_action( 'init', 'prl_product_meta_boxes', 11 );
function prl_product_meta_boxes( ){
	$args = array(
		'meta_box_id'   =>  'product_meta_id',
		'label'     =>  'Extra Fields',
		'post_type' =>  array( 'prl_product' ),
		'context'   =>  'normal',
		'priority'  =>  'high',
		'hook_priority' => 11,
		'fields'    =>  array(
			array(
				'name'      =>  'product_price',
				'label'     =>  prl_lbl( 'Price' ),
				'type'      =>  'text',
				'class'     =>  'prl-meta-field',
			),
			array(
				'name'      =>  'product_location',
				'label'     =>  prl_lbl( 'Location' ),
				'type'      =>  'text',
				'class'     =>  'prl-meta-field',
			),
		)
	);

	prl_meta_boxes( $args );
}
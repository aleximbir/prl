<?php
add_action( 'init', 'prl_product_meta_boxes', 11 );
function prl_product_meta_boxes( ){
	$args_side = array(
		'meta_box_id'   => 'product_meta_side',
		'label'         => prl_lbl( 'Extra Fields' ),
		'post_type'     => array( 'prl_products' ),
		'context'       => 'side',
		'fields'        => array(
			array(
				'name'  => 'product_price',
				'label' => prl_lbl( 'Price' ),
				'type'  => 'text',
			),
		)
	);
	prl_meta_boxes( $args_side );

	$args_normal = array(
		'meta_box_id'   => 'product_meta_normal',
		'label'         => prl_lbl( 'Extra Fields' ),
		'post_type'     => array( 'prl_products' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'fields'        => array(
			array(
				'name'    => 'product_condition',
				'label'   => prl_lbl( 'Condition' ),
				'type'    => 'select',
				'options' => array(
					prl_lbl( 'New' ),
					prl_lbl( 'Manufacturer refurbished' ),
					prl_lbl( 'Seller refurbished' ),
					prl_lbl( 'Used' ),
					prl_lbl( 'For parts or not working' ),
				),
			),
			array(
				'name'    => 'product_condition_description',
				'label'   => prl_lbl( 'Condition description' ),
				'default' => '',
				'type'    => 'textarea',
			),
		)
	);
	prl_meta_boxes( $args_normal );

	$args_after_title = array(
		'meta_box_id'   => 'product_meta_after_title',
		'label'         => prl_lbl( 'Subtitle' ),
		'post_type'     => array( 'prl_products' ),
		'context'       => 'after_title',
		'fields'        => array(
			array(
				'name'  => 'product_subtitle',
				'type'  => 'text',
			),
		)
	);
	prl_meta_boxes( $args_after_title );
}
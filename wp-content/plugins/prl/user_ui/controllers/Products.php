<?php
add_shortcode( 'prl_add_and_edit_product', 'prl_add_and_edit_product_shortcode' );

//*** CONTROLLER ***//
function prl_add_and_edit_product_shortcode(){
	$data['lbl_product_details'] = prl_lbl( 'Product details' );
	$data['rows'] = get_post_meta( get_option( 'new_product_page_id' ), 'add_new_product_page', true );
	$data['add_and_edit_product_page'] = get_permalink( get_option( 'new_product_page_id' ) );

	$ret = prl_view( 'products/add_and_edit', $data );

	return $ret;
}

//*** FUNCTIONS ***//

// Content for text input and textarea input
function prl_show_text_textarea_inp( $r = array() ) {
	echo prl_lbl( ucfirst( $r['name'] ), 'yes' );

	echo prl_form(
		array(
			'type' => $r['type'],
			'name' => $r['type'] . '_' . prl_replace( strtolower( $r['name'] ), ' ', '_' ),
			'class' => $r['class'],
			'id' => $r['id'],
			'placeholder' => $r['placeHolder'],
			'value' => $r['defaultValue'],
			'disabled' => $r['disabled'],
			'readonly' => $r['readOnly']
		)
	);

}

// Content for radio input and checkbox input
function prl_show_radio_checkbox_inp( $r = array() ) {
	if ( isset( $r['values'] ) && !empty( $r['values'][0] ) ) {
		if ( is_array( $r['values'] ) ) {
			
			echo prl_lbl( ucfirst( $r['name'] ), 'yes' );
			
			foreach ( $r['values'] as $key => $value ) {
				$radio = $r['type'] == "radio" ? ' radio ' : ' ';
				echo '<div class="ui'.$radio.'checkbox">';
					echo prl_form(
						array(
							'type' => $r['type'],
							'name' => $r['type'] . '_' . prl_replace( strtolower( $r['name'] ), ' ', '_' ),
							'class' => $r['class'],
							'id' => $r['id'],
							'value' => $value,
							'disabled' => $r['disabled'],
							'readonly' => $r['readOnly']
						)
					);
					echo prl_lbl( $value, 'yes' );
				echo '</div>';
			}
		}
	}
}

// Content for select input
function prl_show_select_inp( $r = array() ) {
	echo prl_lbl( ucfirst( $r['name'] ), 'yes' );

	echo prl_form(
		array(
			'type' => $r['type'],
			'name' => $r['type'] . '_' . prl_replace( strtolower( $r['name'] ), ' ', '_' ),
			'class' => $r['class'],
			'id' => $r['id'],
			'value' => $r['values'],
			'disabled' => $r['disabled'],
			'readonly' => $r['readOnly']
		)
	);
}

// Content for toggle input
function prl_show_toggle_inp( $r = array() ) {
	if ( $r['description'] ) {
		echo prl_lbl( ucfirst( $r['name'] ), 'yes' );

		echo '<div class="ui toggle checkbox">';
			echo prl_form(
				array(
					'type' => 'checkbox',
					'name' => $r['type'] . '_' . prl_replace( strtolower( $r['name'] ), ' ', '_' ),
					'class' => 'hidden'
				)
			);
			echo prl_lbl( $r['description'], 'yes' );
		echo '</div>';
	}
}

// Content for file input
function prl_show_file_inp( $r = array() ) {
	prl_enq_dropzone_script();

	echo prl_lbl( ucfirst( $r['name'] ), 'yes' );

	echo '
		<div class="dropzone dropzone-class">
			<div class="dz-message needsclick">
				Drop files here or click to upload.<br />
				<span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
			</div>
		</div>
	';

	/*echo prl_form(
		array(
			'type' => $r['type'],
			'name' => $r['type'] . '_' . prl_replace( strtolower( $r['name'] ), ' ', '_' ),
			'class' => $r['class'] . ' dropzone-class',
			'id' => $r['id'],
			'disabled' => $r['disabled'],
			'readonly' => $r['readOnly']
		)
	);*/
}

// Content for wysiwyg input
function prl_show_wysiwyg_inp( $r = array() ) {
	prl_enq_tinymce_script();

	echo prl_lbl( ucfirst( $r['name'] ), 'yes' );

	echo prl_form(
		array(
			'type' => 'textarea',
			'name' => $r['type'] . '_' . prl_replace( strtolower( $r['name'] ), ' ', '_' ),
			'class' => $r['class'] . ' wysiwyg-class',
			'id' => $r['id'],
			'placeholder' => $r['placeHolder'],
			'value' => $r['defaultValue'],
			'disabled' => $r['disabled'],
			'readonly' => $r['readOnly']
		)
	);
}

// Get content by input type
function prl_show_content_by_inp_type( $r = array() ) {
	$inp_type = $r['type'];

	if ( $inp_type == 'text' || $inp_type == 'textarea' ) {
		prl_show_text_textarea_inp( $r );
	} else if ( $inp_type == 'radio' || $inp_type == 'checkbox' ) {
		prl_show_radio_checkbox_inp( $r );
	} else if ( $inp_type == 'select' ) {
		prl_show_select_inp( $r );
	} else if ( $inp_type == 'toggle' ) {
		prl_show_toggle_inp( $r );
	} else if ( $inp_type == 'file' ) {
		prl_show_file_inp( $r );
	} else if ( $inp_type == 'wysiwyg' ) {
		prl_show_wysiwyg_inp( $r );
	}
}

// Add toggle for extra price
function prl_show_extra_price_content( $r = array() ) {
	if ( $r['extra_price'] == 'yes' ) {
		echo '<div class="ui toggle checkbox">';
			echo prl_form( array( 'type' => 'checkbox', 'name' => 'chk_bold_title', 'class' => 'hidden' ) );
			echo prl_lbl( $r['ep_description'] . '(' . $r['ep_price'] . ')', 'yes' );
		echo '</div>';
	}
}
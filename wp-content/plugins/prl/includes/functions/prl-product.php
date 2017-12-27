<?php
function get_repeater_content( $id = '', $html = '' ) {

	$rows = get_post_meta( $id, 'add_new_product_page', true );

	// New row
	if ( !$rows ) {
		$rows = array( '' => array() );
	}

	// Current rows
	foreach ( $rows as $key => $row ) {
		$fieldscount = count( $row );

		$html .= '<div class="repeater-row postbox" id="repeater-row">';
			$html .= '<button type="button" class="handlediv" id="handlediv-prl-row" aria-expanded="true">';
				$html .= '<span class="screen-reader-text">' . prl_lbl( 'Toggle panel: Repeater Fields' ) . '</span>';
				$html .= '<span class="toggle-indicator" aria-hidden="true"></span>';
			$html .= '</button>';

			$html .= '<div id="fields-count">';

				$html .= '<label>' . prl_lbl( 'Fields per row' ) . ':</label>';
				
				$html .= '<select name="repeater-rows-count[]" id="repeater-rows-count">';
					for ( $i=1; $i<=16; $i++ ) {
						$selcted = ( $fieldscount == $i ) ? 'selected' : '';
						$html .= '<option ' . $selcted . ' value="' . $i . '">' . $i . '</option>';
					}
				$html .= '</select>';

				$html .= '<div class="row-name-list"><span></span></div>';

				$html .= '<div class="remove-row">' . prl_lbl( 'Delete' ) . '</div>';

			$html .= '</div>'; // END fields-count
			
			$html .= '<div id="fields-to-repeat">';
				
				ob_start();
				echo get_repeater_fields_content( $id, $row );
				$html .= ob_get_contents();
				ob_clean();
				
			$html .= '</div>'; //END fields-to-repeat
		$html .= '</div>'; // END repeater-row
	}

	return $html;
}

function get_repeater_fields_content( $id = '', $row = array(), $html = '' ) {

	// New row
	if ( !$row ) {
		$row = array( '' => array( 'name' => '', 'type' => '' ) );
	}

	// Current rows
	foreach ( $row as $k => $r ) {

		$html .= '<div id="field">';
			$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-inp-name[]', 'id' => 'repeater-inp-name', 'placeholder' => prl_lbl( 'Name' ), 'value' => $r['name'], 'required' => 'yes' ) );

			$types = array(
				'' => prl_lbl( 'Type' ),
				'text' => prl_lbl( 'Text' ),
				'radio' => prl_lbl( 'Radio' ),
				'checkbox' => prl_lbl( 'Checkbox' ),
				'textarea' => prl_lbl( 'Textarea' ),
				'toggle' => prl_lbl( 'Toggle' ),
				'select' => prl_lbl( 'Select' ),
				'file' => prl_lbl( 'File' ),
				'wysiwyg' => prl_lbl( 'WYSIWYG' ),
			);

			$html .= '<select name="repeater-inp-type[]" id="repeater-inp-type" required>';
				foreach ( $types as $key => $type ) {
					$selected = ( $key == $r['type'] ) ? 'selected' : '';
					$html .= '<option ' . $selected . ' value="' . $key . '">' . $type . '</option>';
				}
			$html .= '</select>';

			$html .= '<div class="popup-wrapper">';
				$html .= '<span id="prl-settings-modal" class="dashicons dashicons-admin-tools"></span>';
				$html .= '<div class="prl-popup">';
					ob_start();
					echo get_input_type_content( $r );
					$html .= ob_get_contents();
					ob_clean();
				$html .= '</div>';
			$html .= '</div>';

			$html .= '<span id="prl-move" class="dashicons dashicons-move"></span>';
		$html .= '</div>';

	}

	return $html;
}

function complete_with_hidden_inputs( $inp_type = '', $html = '' ) {
	if ( $inp_type == 'text' || $inp_type == 'textarea' || $inp_type == 'wysiwyg' ) {
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-values[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-description[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-file-size[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-file-type[]' ) );
	} else if ( $inp_type == 'radio' || $inp_type == 'checkbox' || $inp_type == 'select' ) {
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-placeholder[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-description[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-file-size[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-file-type[]' ) );
	} else if ( $inp_type == 'toggle' ) {
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-placeholder[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-values[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-default-value[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-file-size[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-file-type[]' ) );
	} else if ( $inp_type == 'file' ) {
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-placeholder[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-values[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-default-value[]' ) );
		$html .= prl_form( array( 'type' => 'hidden', 'name' => 'repeater-type-description[]' ) );
	}

	return $html;
}

add_action( 'wp_ajax_nopriv_get_input_type_content', 'get_input_type_content' );
add_action( 'wp_ajax_get_input_type_content', 'get_input_type_content' );
function get_input_type_content( $r = '', $html = '' ) {

	$html .= '<span id="prl-close-modal" class="dashicons dashicons-no-alt"></span>';

	$inp_type = isset( $r['type'] ) ? $r['type'] : '';
	if( !$inp_type ) { $inp_type = isset( $_POST['inp_type'] ) ? $_POST['inp_type'] : ''; }
	
	if ( $inp_type == 'text' || $inp_type == 'textarea' || $inp_type == 'wysiwyg' ) {
		
		$html .= prl_lbl( 'PlaceHolder', true );
		$phValue = isset( $r['placeHolder'] ) ? $r['placeHolder'] : '';
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-placeholder[]', 'value' => $phValue ) );

		$html .= prl_lbl( 'Default Value', true );
		$dValue = isset( $r['defaultValue'] ) ? $r['defaultValue'] : '';
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-default-value[]', 'value' => $dValue ) );

		// Hidden Values //
		ob_start();
		echo complete_with_hidden_inputs( $inp_type );
		$html .= ob_get_contents();
		ob_clean();
		// END Hidden Values //

	} else if ( $inp_type == 'radio' || $inp_type == 'checkbox' || $inp_type == 'select' ) {

		$html .= prl_lbl( 'Values', true );
		$vValue = isset( $r['values'] ) ? $r['values'] : '';
		$html .= prl_form( array( 'type' => 'textarea', 'name' => 'repeater-type-values[]', 'id' => 'repeater-type-values', 'placeholder' => prl_lbl( 'One value per line' ), 'value' => implode( PHP_EOL, $vValue ) ) );

		$html .= prl_lbl( 'Default Value', true );
		$dValue = isset( $r['defaultValue'] ) ? $r['defaultValue'] : '';
		$html .= prl_form( array( 'type' => 'select', 'name' => 'repeater-type-default-value[]', 'id' => 'repeater-type-default-value', 'value' => $dValue ) );

		// Hidden Values //
		ob_start();
		echo complete_with_hidden_inputs( $inp_type );
		$html .= ob_get_contents();
		ob_clean();
		// END Hidden Values //

	} else if ( $inp_type == 'toggle' ) {

		$html .= prl_lbl( 'Description', true );
		$dValue = isset( $r['description'] ) ? $r['description'] : '';
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-description[]', 'value' => $dValue ) );

		// Hidden Values //
		ob_start();
		echo complete_with_hidden_inputs( $inp_type );
		$html .= ob_get_contents();
		ob_clean();
		// END Hidden Values //

	} else if ( $inp_type == 'file' ) {

		$html .= prl_lbl( 'Max file size', true );
		$fsValue = isset( $r['fileSize'] ) ? $r['fileSize'] : '';
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-file-size[]', 'value' => $fsValue ) );

		$html .= prl_lbl( 'Allow certain file formats', true );
		$ftValue = isset( $r['fileType'] ) ? $r['fileType'] : '';
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-file-type[]', 'value' => $ftValue ) );

		// Hidden Values //
		ob_start();
		echo complete_with_hidden_inputs( $inp_type );
		$html .= ob_get_contents();
		ob_clean();
		// END Hidden Values //

	} else {
		$html .= '<span>' . prl_lbl( 'Please choose the type of the field!' ) . '</span>';
	}

	if ( $inp_type ) {
		$html .= prl_lbl( 'Class', true );
		$cValue = isset( $r['class'] ) ? $r['class'] : '';
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-class[]', 'value' => $cValue ) );
		
		$html .= prl_lbl( 'ID', true );
		$idValue = isset( $r['id'] ) ? $r['id'] : '';
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-id[]', 'value' => $idValue ) );
		
		$html .= '<div class="prl-read-only">';
			$html .= prl_lbl( 'Read Only', true );

			$dValue = isset( $r['readOnly'] ) ? $r['readOnly'] : '';

			$readYes = $dValue == 'yes' ? 'checked' : '';
			$html .= prl_form( array( 'type' => 'checkbox', 'name' => 'repeater-type-read-only[]', 'value' => 'yes', 'checked' => $readYes ) );
			$html .= prl_lbl( 'Yes', true, 'yes' );

			$readNo = $dValue == 'no' ? 'checked' : '';
			$html .= prl_form( array( 'type' => 'checkbox', 'name' => 'repeater-type-read-only[]', 'value' => 'no', 'checked' => $readNo ) );
			$html .= prl_lbl( 'No', true, 'no' );
		$html .= '</div>';

		$html .= '<div class="prl-disabled">';
			$html .= prl_lbl( 'Disabled', true );

			$rValue = isset( $r['disabled'] ) ? $r['disabled'] : '';

			$disabledYes = $rValue == 'yes' ? 'checked' : '';
			$html .= prl_form( array( 'type' => 'checkbox', 'name' => 'repeater-type-disabled[]', 'value' => 'yes', 'checked' => $disabledYes ) );
			$html .= prl_lbl( 'Yes', true, 'yes' );

			$disabledNo = $rValue == 'no' ? 'checked' : '';
			$html .= prl_form( array( 'type' => 'checkbox', 'name' => 'repeater-type-disabled[]', 'value' => 'no', 'checked' => $disabledNo ) );
			$html .= prl_lbl( 'No', true, 'no' );
		$html .= '</div>';

		$html .= '<div class="prl-extra-price">';
			$html .= prl_lbl( 'Field with extra price', true );

			$epValue = isset( $r['extra_price'] ) ? $r['extra_price'] : '';

			$extraPriceYes = $epValue == 'yes' ? 'checked' : '';
			$html .= prl_form( array( 'type' => 'checkbox', 'name' => 'repeater-extra-price[]', 'class' => 'extra-price-chk', 'value' => 'yes', 'checked' => $extraPriceYes ) );
			$html .= prl_lbl( 'Yes', true, 'yes' );

			$extraPriceNo = $epValue == 'no' ? 'checked' : '';
			$html .= prl_form( array( 'type' => 'checkbox', 'name' => 'repeater-extra-price[]', 'class' => 'extra-price-chk', 'value' => 'no', 'checked' => $extraPriceNo ) );
			$html .= prl_lbl( 'No', true, 'no' );

			$display_extra_price = $epValue == 'yes' ? 'block' : 'none';

			$html .= '<div class="prl-extra-price-wrapper" style="display: ' . $display_extra_price . ';">';
				$html .= prl_lbl( 'Description', true );
				$epdValue = isset( $r['ep_description'] ) ? $r['ep_description'] : '';
				$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-ep-description[]', 'value' => $epdValue ) );

				$html .= prl_lbl( 'Price', true );
				$eppValue = isset( $r['ep_price'] ) ? $r['ep_price'] : '';
				$html .= prl_form( array( 'type' => 'number', 'name' => 'repeater-type-ep-price[]', 'value' => $eppValue ) );
			$html .= '</div>';
		$html .= '</div>';
		
		$html .= '<button id="repeater-type-save" class="button button-primary button-large">' .prl_lbl( 'Save' ) . '</button>';
	}

	if ( isset( $_POST['inp_type'] ) ) {
		echo $html;
		wp_die();
	} else {
		return $html;
	}
}
<?php
function get_repeater_content( $id = '', $html = '' ) {

	$rows = get_post_meta( $id, 'add_new_product_page', true );

	if ( $rows ) {
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
	}

	return $html;
}

function get_repeater_fields_content( $id = '', $row = array(), $html = '' ) {

	foreach ( $row as $k => $r ) {

		$html .= '<div id="field">';
			$html .= '<input type="text" placeHolder="' . prl_lbl( 'Name' ) . '" name="repeater-inp-name[]" value="' . $r['name'] . '" />';

			$html .= '&nbsp';

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

			$html .= '<select name="repeater-inp-type[]" id="repeater-inp-type">';
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
		$html .= '</div>';

	}

	return $html;
}

function get_input_type_content( $r = '', $html = '' ) {
	$html .= '<span id="prl-close-modal" class="dashicons dashicons-no-alt"></span>';

	$inp_type = isset( $r['type'] ) ? $r['type'] : '';
	
	if ( $inp_type == 'text' || $inp_type == 'textarea' || $inp_type == 'wysiwyg' ) {
		
		$html .= prl_lbl( 'PlaceHolder', true );
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-placeholder[]', 'value' => $r['placeHolder'] ) );

		$html .= prl_lbl( 'Default Value', true );
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-default-value[]', 'value' => $r['defaultValue'] ) );

	} else if ( $inp_type == 'radio' || $inp_type == 'checkbox' || $inp_type == 'select' ) {

		$html .= prl_lbl( 'Values', true );
		$html .= prl_form( array( 'type' => 'textarea', 'name' => 'repeater-type-values[]', 'id' => 'repeater-type-values', 'placeholder' => prl_lbl( 'One value per line' ) ) );

		$html .= prl_lbl( 'Default Value', true );
		$html .= prl_form( array( 'type' => 'select', 'name' => 'repeater-type-default-value[]', 'id' => 'repeater-type-default-value', 'value' => $r['defaultValue'] ) );

	} else if ( $inp_type == 'toggle' ) {

		$html .= prl_lbl( 'Description', true );
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-description[]', 'value' => $r['description'] ) );

	} else if ( $inp_type == 'file' ) {

		$html .= prl_lbl( 'Max file size', true );
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-file-size[]', 'value' => $r['fileSize'] ) );

		$html .= prl_lbl( 'Allow certain file formats', true );
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-file-type[]', 'value' => $r['fileType'] ) );

	} else {

		$html .= '<span id="prl-close-modal" class="dashicons dashicons-no-alt"></span>';
		$html .= '<span>' . prl_lbl( 'Please choose the type of the field!' ) . '</span>';

	}

	if ( $inp_type ) {
		$html .= prl_lbl( 'Class', true );
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-class[]', 'value' => $r['class'] ) );
		
		$html .= prl_lbl( 'ID', true );
		$html .= prl_form( array( 'type' => 'text', 'name' => 'repeater-type-id[]', 'value' => $r['id'] ) );
		
		$html .= '<div class="prl-read-only">';
			$html .= prl_lbl( 'Read Only', true );
			$html .= prl_form( array( 'type' => 'checkbox', 'name' => 'repeater-type-read-only[]', 'value' => 'yes' ) );
			$html .= prl_lbl( 'Yes', true, 'yes' );
			$html .= prl_form( array( 'type' => 'checkbox', 'name' => 'repeater-type-read-only[]', 'value' => 'no' ) );
			$html .= prl_lbl( 'No', true, 'no' );
		$html .= '</div>';

		$html .= '<div class="prl-disabled">';
			$html .= prl_lbl( 'Disabled', true );
			$html .= prl_form( array( 'type' => 'checkbox', 'name' => 'repeater-type-disabled[]', 'value' => 'yes' ) );
			$html .= prl_lbl( 'Yes', true, 'yes' );
			$html .= prl_form( array( 'type' => 'checkbox', 'name' => 'repeater-type-disabled[]', 'value' => 'no' ) );
			$html .= prl_lbl( 'No', true, 'no' );
		$html .= '</div>';
		
		$html .= '<button id="repeater-type-save" class="button button-primary button-large">' .prl_lbl( 'Save' ) . '</button>';
	}

	return $html;
}
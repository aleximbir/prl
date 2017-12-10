<?php
function get_repeater_content( $html = '' ) {
	$html .= '<div class="repeater-row postbox" id="repeater-row">';
		$html .= '<button type="button" class="handlediv" id="handlediv-prl-row" aria-expanded="true">';
			$html .= '<span class="screen-reader-text">Toggle panel: Repeater Fields</span>';
			$html .= '<span class="toggle-indicator" aria-hidden="true"></span>';
		$html .= '</button>';

		$html .= '<div id="fields-count">';

			$html .= '<label>' . prl_lbl( 'Fields per row' ) . ':</label>';
			
			$html .= '<select name="repeater-rows-count" id="repeater-rows-count">';
				for ( $i=1; $i<=16; $i++ ) {
					$html .= '<option value="' . $i . '">' . $i . '</option>';
				}
			$html .= '</select>';

			$html .= '<div class="row-name-list"><span></span></div>';

			$html .= '<div class="remove-row">Delete</div>';

		$html .= '</div>'; // END fields-count
		
		$html .= '<div id="fields-to-repeat">';
			
			ob_start();
			echo get_repeater_fields_content();
			$html .= ob_get_contents();
			ob_clean();
			
		$html .= '</div>'; //END fields-to-repeat
	$html .= '</div>'; // END repeater-row

	return $html;
}

function get_repeater_fields_content( $html = '' ) {
	$html .= '<div id="field">';
		$html .= '<input type="text" placeHolder="' . prl_lbl( 'Name' ) . '" name="repeater-inp-name" />';

		$html .= '&nbsp';

		$html .= '<select name="repeater-inp-type" id="repeater-inp-type">';
			$html .= '<option value="">' . prl_lbl( 'Type' ) . '</option>';
			$html .= '<option value="text">Text</option>';
			$html .= '<option value="radio">Radio</option>';
			$html .= '<option value="checkbox">Checkbox</option>';
			$html .= '<option value="textarea">Textarea</option>';
			$html .= '<option value="slide">Slide</option>';
			$html .= '<option value="select">Select</option>';
			$html .= '<option value="file">File</option>';
			$html .= '<option value="color">Color</option>';
			$html .= '<option value="wysiwyg">WYSIWYG</option>';
		$html .= '</select>';
	$html .= '</div>';

	return $html;
}
<?php
function prl_model( $model_name = '', $vars = '' ) {
	ob_start();

	foreach ( $vars as $key => $var ) {
		$$key = $var;
	}

	include prl_plugin_path() . 'models/' . $model_name . '_model.php';
	$ret = ob_get_contents();
	ob_clean();

	return $ret;
}

function prl_view( $view_name = '', $vars = '' ) {
	ob_start();

	foreach ( $vars as $key => $var ) {
		$$key = $var;
	}

	include prl_plugin_path() . 'views/' . $view_name . '_view.php';
	$ret = ob_get_contents();
	ob_clean();

	return $ret;
}

function prl_form( $arr = '' ) {
	$ret = '';

	if ( $arr ) {
		foreach ( $arr as $key => $var ) {
			$$key = $var;
		}

		$type = ! isset( $type ) ? 'input' : $type;

		if ( $type == 'textarea' ) {
			$ret .= '<textarea';
		} elseif( $type == 'select' ) {
			$ret .= '<select';
		} else {
			$ret .= '<input type="' . $type . '"';
		}

		if ( isset( $name ) ) {
			$ret .= ' name="' . $name . '"';
		}

		if ( isset( $id ) ) {
			$ret .= ' id="' . $id . '"';
		}

		if ( isset( $class ) ) {
			$ret .= ' class="' . $class . '"';
		}

		$value = isset( $value ) ? $value : '';

		if ( $type != 'textarea' && $type != 'select' ) {
			$ret .= ' value="' . $value . '"';
		}

		if ( $type == 'radio' || $type == 'checkbox' ) {
			$checked = isset( $checked ) ? $checked : '';
			$ret .= ' ' . $checked;
		}

		if ( $type != 'select' && isset( $placeholder ) ) {
			$ret .= ' placeholder="' . $placeholder . '"';
		}

		if ( $type == 'textarea' ) {
			$ret .= '>' . $value . '</textarea>';
		} elseif( $type == 'select' ) {
			$ret .= '>';
			if ( $value ){
				$ret .= '<option>' . $value . '</option>';
			}
			$ret .= '</select>';
		} else {
			$ret .= ' />';
		}
	}

	return $ret;
}

function prl_lbl( $label, $tag = false, $class = '' ) {
	if ( $tag && !$class ) {
		return '<label>' . __( $label, 'prl' ) . '</label>';
	} elseif ( $tag && $class ) {
		return '<label class="' . $class . '">' . __( $label, 'prl' ) . '</label>';
	} else {
		return __( $label, 'prl' );
	}
}
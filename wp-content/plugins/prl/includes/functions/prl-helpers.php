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

		if ( $type != 'textarea' ) {
			$ret .= '<input type="' . $type . '"';
		} else {
			$ret .= '<textarea';
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
		$ret .= ' value="' . $value . '"';

		if ( $type != 'textarea' && isset( $placeholder ) ) {
			$ret .= ' placeholder="' . $placeholder . '"';
		}

		if ( $type != 'textarea' ) {
			$ret .= ' />';
		} else {
			$placeholder = isset( $placeholder ) ? $placeholder : '';
			$ret = '>' . $placeholder . '</textarea>';
		}
	}

	return $ret;
}
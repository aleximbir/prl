<?php

function prl_print_r( $var = '' ) {
	$ret = '<pre>';
	$ret .= print_r( $var );
	$ret .= '</pre>';

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

function prl_view( $view_name = '', $vars = '' ) {
	ob_start();

	foreach ( $vars as $key => $var ) {
		$$key = $var;
	}

	include prl_dir_url() . 'views/' . $view_name . '_view.php';
	$ret = ob_get_contents();
	ob_clean();

	return $ret;
}

function prl_model( $model_name = '', $vars = '' ) {
	ob_start();

	foreach ( $vars as $key => $var ) {
		$$key = $var;
	}

	include prl_dir_url() . 'models/' . $model_name . '_model.php';
	$ret = ob_get_contents();
	ob_clean();

	return $ret;
}

function prl_scan_folders( $dir = '', &$ret = [] ) {
	$files = scandir( $dir );

	foreach ( $files as $key => $filename ) {
		$path = realpath( $dir . DIRECTORY_SEPARATOR . $filename );
		if ( ! is_dir( $path ) ) {
			$ret[] = $path;
		} else if ( $filename != "." && $filename != ".." ) {
			prl_scan_folders( $path, $ret );
		}
	}

	return $ret;
}

function prl_isset_post( $var = '' ) {
	if ( isset( $_POST[$var] ) ) {
		$ret = $_POST[$var];
	} else {
		$ret = '';
	}

	return $ret;
}
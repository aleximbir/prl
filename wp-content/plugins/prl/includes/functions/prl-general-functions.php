<?php

function prl_print_r( $var='' ){
	$ret = '<pre>';
	$ret .= print_r( $var );
	$ret .= '</pre>';

	return $ret;
}

function prl_form( $arr='' ){
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

		if ( $type != 'textarea' && isset( $placeHolder ) ) {
			$ret .= ' placeHolder="' . $placeHolder . '"';
		}

		if ( $type != 'textarea' ) {
			$ret .= ' />';
		} else {
			$placeHolder = isset( $placeHolder ) ? $placeHolder : '';
			$ret = '>' . $placeHolder . '</textarea>';
		}
	}

	return $ret;
}


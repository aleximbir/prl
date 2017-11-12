<?php
function prl_print_r( $var = '' ) {
	$ret = '<pre>';
	$ret .= print_r( $var );
	$ret .= '</pre>';

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
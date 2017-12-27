<?php
function prl_print_r( $var = '' ) {
	echo '<pre style="text-align: left;">';
		print_r( $var );
	echo '</pre>';
}

function prl_isset_post( $var = '' ) {
	if ( isset( $_POST[$var] ) ) {
		$ret = $_POST[$var];
	} else {
		$ret = '';
	}

	return $ret;
}

function prl_replace( $string, $old, $new ) {
	$ret = str_replace( $old, $new, $string );
	return $ret;
}
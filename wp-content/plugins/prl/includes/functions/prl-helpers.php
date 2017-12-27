<?php
function prl_model( $model_name = '', $vars = '' ) {
	ob_start();

	foreach ( $vars as $key => $var ) {
		$$key = $var;
	}

	include prl_plugin_path() . 'user_ui/models/' . $model_name . '_model.php';
	$ret = ob_get_contents();
	ob_clean();

	return $ret;
}

function prl_view( $view_name = '', $vars = '' ) {
	ob_start();

	foreach ( $vars as $key => $var ) {
		$$key = $var;
	}

	include prl_plugin_path() . 'user_ui/views/' . $view_name . '_view.php';
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

		if ( isset( $disabled ) && $disabled == 'yes' ) {
			$ret .= ' disabled';
		}

		if ( isset( $readonly ) && $readonly == 'yes' ) {
			$ret .= ' readonly';
		}

		if ( isset( $required ) && $required == 'yes' ) {
			$ret .= ' required';
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

function prl_get_cardinal_number( $nr = 1 ) {
	if ( $nr == 1 ) {
		return 'one';
	} elseif ( $nr == 2 ) {
		return 'two';
	} elseif ( $nr == 3 ) {
		return 'three';
	} elseif ( $nr == 4 ) {
		return 'four';
	} elseif ( $nr == 5 ) {
		return 'five';
	} elseif ( $nr == 6 ) {
		return 'six';
	} elseif ( $nr == 7 ) {
		return 'seven';
	} elseif ( $nr == 8 ) {
		return 'eight';
	} elseif ( $nr == 9 ) {
		return 'nine';
	} elseif ( $nr == 10 ) {
		return 'ten';
	} elseif ( $nr == 11 ) {
		return 'eleven';
	} elseif ( $nr == 12 ) {
		return 'twelve';
	} elseif ( $nr == 13 ) {
		return 'thirteen';
	} elseif ( $nr == 14 ) {
		return 'fourteen';
	} elseif ( $nr == 15 ) {
		return 'fifteen';
	} elseif ( $nr == 16 ) {
		return 'sixteen';
	}
}
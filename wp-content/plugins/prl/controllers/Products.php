<?php
add_shortcode( 'prl_add_and_edit_product', 'prl_add_and_edit_product_shortcode' );
function prl_add_and_edit_product_shortcode(){
	$data['lbl_product_details'] = prl_lbl( 'Product details' );
	
	// TITLE
	$data['lbl_title'] = prl_lbl( 'Title' );
	$data['inp_title'] = prl_form( array( 'type' => 'text', 'name' => 'title', 'placeholder' => prl_lbl( 'Title' ) ) );
	$data['bold_title'] = prl_lbl( 'Stand out with a bold title in search results($2.38)' );
	$data['chk_bold_title'] = prl_form( array( 'type' => 'checkbox', 'name' => 'chk_bold_title', 'class' => 'hidden' ) );
	
	// SUBTITLE
	$data['lbl_subtitle'] = prl_lbl( 'Subtitle' );
	$data['inp_subtitle'] = prl_form( array( 'type' => 'text', 'name' => 'subtitle', 'placeholder' => prl_lbl( 'Subtitle' ) ) );
	$data['active_subtitle'] = prl_lbl( 'Subtitles appear in search results and can increase buyer interest by providing more descriptive info($0.60)' );
	$data['chk_active_subtitle'] = prl_form( array( 'type' => 'checkbox', 'name' => 'chk_active_subtitle', 'class' => 'hidden' ) );

	$ret = prl_view( 'products/add_and_edit', $data );

	return $ret;
}
<?php
/**
 * Filter functions for hooks
 *
 * @package printing-express
 * @since 0.0.4
 */

 namespace printing\filters;

use printing\assets as assets;


function custom_logo() {
	$html = sprintf(
		'<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
		esc_url( home_url( '/' ) ),
		'<img src="' . assets\get_asset_path( 'logo.svg' ) . '" class="custom-logo"width="400" height="110">'
	);
	return $html;
}


add_filter( 'get_custom_logo', __NAMESPACE__ . '\\custom_logo' );



function custom_form_submit( $html ) {
	// return '123';
	$btn     = '<button class="forminator-button forminator-button-submit">Send</button>';
	$new_btn = '<button class="forminator-button forminator-button-submit more-link"><span class="left"></span><span class="inner">Send</span></button>';
	return str_replace( $btn, $new_btn, $html );
}

add_filter( 'forminator_render_button_markup', __NAMESPACE__ . '\\custom_form_submit', 1000000 );
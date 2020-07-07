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
		'<img src="' . assets\get_asset_path( 'logo.svg' ) . '" class="custom-logo"width="133" height="75">'
	);
	return $html;
}


add_filter( 'get_custom_logo', __NAMESPACE__ . '\\custom_logo' );



function body( $classes ) {
	return array_merge( $classes, array( 'line-numbers' ) );
};


add_filter( 'body_class', __NAMESPACE__ . '\\body' );

function custom_form_submit( $html ) {
	// return '123';
	$btn     = '<button class="forminator-button forminator-button-submit">Send</button>';
	$new_btn = '<button class="forminator-button forminator-button-submit more-link"><span class="left"></span><span class="inner">Send</span></button>';
	return str_replace( $btn, $new_btn, $html );
}

add_filter( 'forminator_render_button_markup', __NAMESPACE__ . '\\custom_form_submit', 1000000 );


add_filter('wp_nav_menu_items', __NAMESPACE__.'\filter_footer', 10, 2);
function filter_footer($items, $args){
    if( $args->theme_location == 'footer' ){
        $items = '<li><a href="https://github.com/Sephsekla" target="_blank"><img src="' . assets\get_asset_path( 'github.svg' ) . '" alt=GitHub" width="30"/></a></li>'.$items;
    }
    return $items;
}
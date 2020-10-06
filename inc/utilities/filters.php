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
		'<img src="' . assets\get_asset_path( 'logo.svg' ) . '" class="custom-logo"width="267" height="78">'
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

/**
 * Set Onedrive upload folder
 *
 * @param  string $value
 * @return string
 */
function set_upload_folder( $value )
{

    $user = wp_get_current_user();

    $teams = wc_memberships_for_teams_get_teams($user->ID);
    

    if($teams) {

        $team = $teams[0];

        return $team->get_name();


    }
    else{

        


        return $user->user_nicename.' (Unregistered)';
    }


    
}

add_filter('gform_field_value_upload_folder', __NAMESPACE__.'\\set_upload_folder');
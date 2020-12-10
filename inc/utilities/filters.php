<?php
/**
 * Filter functions for hooks
 *
 * @package printing-express
 * @since   0.0.4
 */

 namespace printing\filters;

use printing\assets as assets;


function custom_logo()
{
    $html = sprintf(
        '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
        esc_url(home_url('/')),
        '<img src="' . assets\get_asset_path('logo.svg') . '" class="custom-logo"width="267" height="78">'
    );
    return $html;
}


add_filter('get_custom_logo', __NAMESPACE__ . '\\custom_logo');



function custom_form_submit( $html )
{
    // return '123';
    $btn     = '<button class="forminator-button forminator-button-submit">Send</button>';
    $new_btn = '<button class="forminator-button forminator-button-submit more-link"><span class="left"></span><span class="inner">Send</span></button>';
    return str_replace($btn, $new_btn, $html);
}

add_filter('forminator_render_button_markup', __NAMESPACE__ . '\\custom_form_submit', 1000000);

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

    $date = date('/Y/m/d');
    

    if($teams) {

        $team = $teams[0];

        return '/'.$team->get_name().$date;


    }
    else{

        


        return '/'.$user->user_nicename.' (Unregistered)'.$date;
    }


    
}

add_filter('gform_field_value_upload_folder', __NAMESPACE__.'\\set_upload_folder');

add_shortcode('custom_form_upload',function(){
    //[shareonedrive class="gf_upload_box" dir="3D07FF6BA4270E23!209" account="3d07ff6ba4270e23" mode="files" viewrole="administrator|author|contributor|editor|subscriber|guest" userfolders="auto" downloadrole="all" upload="1" uploadrole="all" delete="1" deletefilesrole="administrator|editor|customer|subscriber|shop_manager"]

    $folder = set_upload_folder(null);
    $folder = 'Lorem Ipsum';

    return do_shortcode('[shareonedrive class="gf_upload_box" dir="'.$folder.'" account="3d07ff6ba4270e23" mode="files" viewrole="administrator|author|contributor|editor|subscriber|guest" userfolders="auto" downloadrole="all" upload="1" uploadrole="all" delete="1" deletefilesrole="administrator|editor|customer|subscriber|shop_manager" addfolder="1" addfolderrole="administrator|editor|customer|subscriber|shop_manager"]' );
});

/**
 * Set Onedrive upload folder
 *
 * @param  string $value
 * @return string
 */
function set_upload_folder_2( $private_folder_name, $processor )
{

    return set_upload_folder(null);

   
    
}

/**
 * We only filter if not a woocommerce upload
 *
add_action(
    'wp_head', function () {
    
        if(is_woocommerce() || is_cart() || is_checkout() || is_account_page()
        ) {
        
        }
        else{
            add_filter('shareonedrive_private_folder_name', __NAMESPACE__.'\\set_upload_folder_2', 9, 2);
        }

    
    }
);*/
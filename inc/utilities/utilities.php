<?php
/**
 * Utilty functions
 *
 * @package printing-express
 * @since   0.0.3
 */

 namespace printing\utilities;

function picture( $id, $size = 'thumbnail' )
{
    $url = wp_get_attachment_image_url($id, $size);
    ?>
<picture>
    <source srcset="<?php echo $url; ?>.webp" type="image/webp">
    <source srcset="<?php echo $url; ?>" type="<?php echo get_post_mime_type($id); ?>">
    <?php echo wp_get_attachment_image($id, $size); ?>
</picture>
    <?php
}

 require_once 'filters.php';

 require_once 'assets.php';

function get_years()
{
    return date('Y') - 2015;
}

 add_shortcode('get_years', __NAMESPACE__ . '\\get_years');


 function is_woo_related(){

    if(!function_exists('is_woocommerce')){
        return false;
    }


     return is_cart() || is_checkout() || is_account_page() || is_woocommerce();
 }


function get_banner_id(){

    
    if(is_singular() && has_post_thumbnail( 0 )){
        $id = get_post_thumbnail_id( 0 );
    }
    elseif(is_singular() && has_post_thumbnail( wp_get_post_parent_id(0) )){
        $id = get_post_thumbnail_id( wp_get_post_parent_id(0) );

    }
    elseif (is_woo_related() && has_post_thumbnail( wc_get_page_id( 'shop') )) {
        # code...
        $id = get_post_thumbnail_id( wc_get_page_id( 'shop') );
    }
    else{
        $id = 123;
    }

    return $id;

}
<?php
/**
 * Get assets
 *
 * @package printing-express
 * @since   0.0.4
 */

 namespace printing\assets;

function get_asset_path( $asset )
{
    return trailingslashit(get_stylesheet_directory_uri()) . 'dist/assets/' . $asset;
}



function images()
{
    add_image_size('slider', 1200, 700, true); // Cropped slider image
    add_image_size('linkbox', 800, 800, true); // Cropped linkbox
    add_image_size('banner', 1800, 0, false); // Uncropped banner

}

add_action('after_setup_theme', __NAMESPACE__.'\images');

function get_social($color=false)
{

if($color){
    $folder = '/'.$color;
}
else{
    $folder='';
}

    ?>

<ul class="social">
    <li>
        <a href="https://www.facebook.com/Printing-Express-106452437808448/" target="_blank"><img src="<?php echo get_asset_path('icons'.$folder.'/facebook.svg') ?>" width="28" height="28"></a>
    </li>
    <li>
        <a href="https://linkedin.com" target="_blank"><img src="<?php echo get_asset_path('icons'.$folder.'/linkedin.svg') ?>" width="28" height="28"></a>
    </li>
    <li>
        <a href="https://www.instagram.com/the_printing_express/" target="_blank"><img src="<?php echo get_asset_path('icons'.$folder.'/instagram.svg') ?>" width="28" height="28"></a>
    </li>
    <li>
        <a href="https://twitter.com" target="_blank"><img src="<?php echo get_asset_path('icons'.$folder.'/twitter.svg') ?>" width="28" height="28"></a>
    </li>
</ul>

    <?php
}
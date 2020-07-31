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

function get_social()
{
    ?>

<ul class="social">
    <li>
        <a href="https://facebook.com" target="_blank"><img src="<?php echo get_asset_path('icons/facebook.svg') ?>" width="28" height="28"></a>
    </li>
    <li>
        <a href="https://facebook.com" target="_blank"><img src="<?php echo get_asset_path('icons/linkedin.svg') ?>" width="28" height="28"></a>
    </li>
    <li>
        <a href="https://facebook.com" target="_blank"><img src="<?php echo get_asset_path('icons/instagram.svg') ?>" width="28" height="28"></a>
    </li>
    <li>
        <a href="https://facebook.com" target="_blank"><img src="<?php echo get_asset_path('icons/twitter.svg') ?>" width="28" height="28"></a>
    </li>
</ul>

    <?php
}
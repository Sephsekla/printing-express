<?php
/*
 * Block functions
 *
 * @package printing-express
 * @since 0.0.2
 */

namespace printing\blocks;

use printing\assets as assets;


function register_social()
{



        // Only load if Gutenberg is available.
    if (! function_exists('register_block_type') ) {
        return;
    }
    
        // Hook server side rendering into render callback
        register_block_type(
            'printing/social', [
            'render_callback' => __NAMESPACE__ . '\render_social',
             ] 
        );



}

function render_social($block_attributes,$content)
{

    ob_start();


    $block_attributes['background'] = $block_attributes['background'] ?: 'blue';



    ?>

<section class="wp-block-printing-grid pe-grid_wrapper bg-<?php echo $block_attributes['background'] ?>">
    <div class="row no-gutters <?php echo $block_attributes['reverseOrder'] ? 'flex-row-reverse' : '' ?>">
        <div class="col-12 col-lg-6 bg-white color-dark">
            <div class="container split-lg-container grid-content <?php echo !$block_attributes['reverseOrder'] ? 'left' : 'right' ?>">
            <p><?php assets\get_social() ?></p>
            </div>
        </div>
        <div class="col-12 col-lg-6 grid-content-wrapper">
            <div
                class="container split-lg-container grid-content <?php echo $block_attributes['reverseOrder'] ? 'left' : 'right' ?>">
                <?php 
                
                echo do_shortcode( '[instagram-feed]' )
                
                ?>
            </div>
        </div>
    </div>
                </section>


    <?php

    return ob_get_clean();
}


add_action('after_setup_theme', __NAMESPACE__ . '\\register_social');
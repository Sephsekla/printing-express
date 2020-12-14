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

<section class="wp-block-printing-social pe-grid_wrapper bg-<?php echo $block_attributes['background'] ?>">
    <div class="row no-gutters <?php echo $block_attributes['reverseOrder'] ? 'flex-row-reverse' : '' ?>">
        <div class="col-12 col-lg-6 bg-white color-dark">
            <div class="container split-lg-container grid-content <?php echo !$block_attributes['reverseOrder'] ? 'left' : 'right' ?>">
            <h2>Follow Us</h2>
            <p><?php assets\get_social('blue') ?></p>
            </div>
        </div>
        <div class="col-12 col-lg-6 grid-content-wrapper">
            <div
                class="container split-lg-container grid-content <?php echo $block_attributes['reverseOrder'] ? 'left' : 'right' ?>">
                <h2>Latest News</h2>
                <?php 
                
                echo do_shortcode( '[instagram-feed]' )
                
                ?>
            </div>
        </div>
    </div>
                </section>
    <section class="pe-grid_wrapper">
    <?php echo do_shortcode('[efb_feed fanpage_id="106452437808448" words_limit="50" post_limit="1" skin_id="6098" cache_unit="1" cache_duration="days" links_new_tab="0" show_like_box="0"]') ?>
</section>

    <?php

    return ob_get_clean();
}


add_action('after_setup_theme', __NAMESPACE__ . '\\register_social');
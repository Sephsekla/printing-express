<?php
/*
 * Block functions
 *
 * @package printing-express
 * @since 0.0.2
 */

namespace printing\blocks;

function register_charity()
{



        // Only load if Gutenberg is available.
    if (! function_exists('register_block_type') ) {
        return;
    }
    
        // Hook server side rendering into render callback
        register_block_type(
            'printing/charity', [
            'render_callback' => __NAMESPACE__ . '\render_charity',
             ] 
        );



}

function render_charity($block_attributes,$content){

    ob_start();

    echo $content;

    echo '<pre>';

    print_r($block_attributes);

    echo '</pre>';

    $block_attributes['background'] = $block_attributes['background'] ?: 'blue';

    ?>

<div class="wp-block-printing-grid pe-grid_wrapper bg-<?php echo $block_attributes['background'] ?>">
    <div class="row no-gutters <?php echo $block_attributes['reverse'] ? 'flex-row-reverse' : '' ?>">
        <div class="col-12 col-lg-6 bg-white color-dark">
            <div class="container split-lg-container grid-content <?php echo !$block_attributes['reverse'] ? 'left' : 'right' ?>">
                <p><?php echo $content ?></p>
            </div>
        </div>
        <div class="col-12 col-lg-6 grid-content-wrapper">
            <div
                class="container split-lg-container grid-content <?php echo $block_attributes['reverse'] ? 'left' : 'right' ?>">
                <p><?php echo $content ?></p>
            </div>
        </div>
    </div>
</div>


<?php

    return ob_get_clean();
}


add_action('after_setup_theme', __NAMESPACE__ . '\\register_charity');
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

function render_charity($block_attributes,$content)
{

    ob_start();


    $block_attributes['background'] = $block_attributes['background'] ?: 'blue';



    ?>

<section class="wp-block-printing-grid pe-grid_wrapper bg-<?php echo $block_attributes['background'] ?>">
    <div class="row no-gutters <?php echo $block_attributes['background'] ? 'flex-row-reverse' : '' ?>">
        <div class="col-12 col-lg-6 bg-white color-dark">
            <div class="container split-lg-container grid-content charity <?php echo !$block_attributes['reverseOrder'] ? 'left' : 'right' ?>">
                <?php 
                
                $charity_query = new \WP_Query(
                    [
                    'post_type' => 'charity-partners',
                    'posts_per_page' => 20,
                    ]
                    );

                    if($charity_query->have_posts()){
                        echo '<div class="row">';
                        while($charity_query->have_posts()){
                                $charity_query->the_post();
                            echo '<div class="col-6 col-lg-4 charity-item">';
                            the_post_thumbnail( 'medium');
                            echo '</div>';
                        }
                        echo '</div>';
                    }
                
                ?>
            </div>
        </div>
        <div class="col-12 col-lg-6 grid-content-wrapper">
            <div
                class="container split-lg-container grid-content <?php echo $block_attributes['reverseOrder'] ? 'left' : 'right' ?>">
                <p><?php echo $content ?></p>
            </div>
        </div>
    </div>
                </section>


    <?php

    return ob_get_clean();
}


add_action('after_setup_theme', __NAMESPACE__ . '\\register_charity');

function block_category( $categories, $post ) {
    $category_slugs = wp_list_pluck( $categories, 'slug' );
    return in_array( 'printing-express', $category_slugs, true ) ? $categories : array_merge(
        
        array(
            array(
                'slug'  => 'printing-express',
                'title' => 'Printing Express',
                'icon'  => null,
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories', __NAMESPACE__.'\\block_category', 10, 2);
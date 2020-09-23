<?php

/**
 * Woocommerce filters and custom functionality
 *
 * @package printing-express
 *
 * @since 2.0.0
 */

 namespace printing\woocommerce;

 /**
  * Exclude products from a particular category on the shop page
  */
function exclude_large_format( $q )
{

    $tax_query = (array) $q->get('tax_query');

    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'large-format' ), // Don't display products in the large format category on the shop page.
           'operator' => 'NOT IN'
    );


    $q->set('tax_query', $tax_query);

}
add_action('woocommerce_product_query', __NAMESPACE__.'\\exclude_large_format');  



function related_products_args( $args )
{
    $args['posts_per_page'] = 6; // 4 related products
    $args['columns'] = 6; // arranged in 2 columns
    return $args;
}

  add_filter('woocommerce_output_related_products_args',  __NAMESPACE__.'\\related_products_args', 20);



/**
 * Separate large format from personal in related
 *
 * @param  [type] $related_posts
 * @param  [type] $product_id
 * @param  [type] $args
 * @return void
 */
function exclude_product_category_from_related_products( $related_posts, $product_id, $args  )
{
    // HERE define your product category slug
    $term_slug = 'large-format';

    // Get the product Ids in the defined product category
    $exclude_ids = wc_get_products(
        array(
        'status'    => 'publish',
        'limit'     => -1,
        'category'  => array($term_slug),
        'return'    => 'ids',
        ) 
    );

    if(has_term($term_slug, 'product_cat', null)) {
        return array_intersect($related_posts, $exclude_ids);

    }
    else{
        return array_diff($related_posts, $exclude_ids);
    }


    return array_diff($related_posts, $exclude_ids);
}

add_filter('woocommerce_related_products', __NAMESPACE__.'\\exclude_product_category_from_related_products', 10, 3);


function get_featured()
{
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 6,
        'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                ),
            ),
        );
    $loop = new \WP_Query($args);
    if ($loop->have_posts() ) {
        while ( $loop->have_posts() ) : $loop->the_post();
            wc_get_template_part('content', 'product');
        endwhile;
    } else {
        echo __('No products found');
    }
    wp_reset_postdata();
}

add_filter( 'gform_field_value_upload_folder', __NAMESPACE__.'\\set_upload_folder' );
function set_upload_folder( $value ) {

    $user = wp_get_current_user();

    $teams = wc_memberships_for_teams_get_teams($user->ID);
    

    if($teams){

        $team = $teams[0];

        return $team->get_name();


    }
    else{

        


        return $user->user_nicename.' (Unregistered)';
    }


    
}
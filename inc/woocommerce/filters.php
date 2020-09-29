<?php

/**
 * Woocommerce filters
 *
 * @package printing-express
 *
 * @since 2.0.0
 */

 namespace printing\woocommerce;


/**
 * Change posts per page on related
 *
 * @param  array $args
 * @return array
 */
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


add_filter( 'woocommerce_product_related_products_heading',
function(){
    return 'You may also like';
},
100);
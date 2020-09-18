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
function exclude_large_format( $q ) {

    $tax_query = (array) $q->get( 'tax_query' );

    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'large-format' ), // Don't display products in the large format category on the shop page.
           'operator' => 'NOT IN'
    );


    $q->set( 'tax_query', $tax_query );

}
add_action( 'woocommerce_product_query', __NAMESPACE__.'\\exclude_large_format' );  


/**
 * Separate large format from personal in related
 *
 * @param [type] $related_posts
 * @param [type] $product_id
 * @param [type] $args
 * @return void
 */
function exclude_product_category_from_related_products( $related_posts, $product_id, $args  ){
    // HERE define your product category slug
    $term_slug = 'large-format';

    // Get the product Ids in the defined product category
    $exclude_ids = wc_get_products( array(
        'status'    => 'publish',
        'limit'     => -1,
        'category'  => array($term_slug),
        'return'    => 'ids',
    ) );

        if(has_term($term_slug,'product_cat',null)){
            return array_intersect( $related_posts, $exclude_ids );

        }
        else{
            return array_diff( $related_posts, $exclude_ids );
        }


    return array_diff( $related_posts, $exclude_ids );
}

add_filter( 'woocommerce_related_products', __NAMESPACE__.'\\exclude_product_category_from_related_products', 10, 3 );
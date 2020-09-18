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


// define the woocommerce_output_related_products_args callback 
function filter_woocommerce_output_related_products_args( $args ) { 
    
    // make filter magic happen here... 

    if(has_term('large-format','product_cat',null)){

        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => array( 'large-format' ), // Don't display products in the large format category on the shop page.
            'operator' => 'IN'
     );

    }
    else{

        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => array( 'large-format' ), // Don't display products in the large format category on the shop page.
            'operator' => 'NOT IN'
     );

    }


    return $args; 
}; 
         
// add the filter 
add_filter( 'woocommerce_output_related_products_args',  __NAMESPACE__.'\\filter_woocommerce_output_related_products_args', 10, 1);
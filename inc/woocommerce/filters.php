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
    $args['posts_per_page'] = 18; // 4 related products
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



add_filter(
    'woocommerce_product_related_products_heading',
    function () {
        return 'You may also like';
    },
    100
);


/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', __NAMESPACE__.'\\change_breadcrumb_delimiter' );
function change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' &gt; ';
	return $defaults;
}


add_filter('woocommerce_product_subcategories_args', __NAMESPACE__.'\\exclude_large_format_subcat',10,1);

// define the woocommerce_product_subcategories_args callback 
function exclude_large_format_subcat( $array ) { 
    // make filter magic happen here... 

    $term_slugs = [22, 15];

    $array['exclude'] = $term_slugs;

   // print_r($array);


    return $array; 
}; 




  
function disable_invoice_personal( $available_gateways ) {
     
   if ( ! is_admin() ) {

        
     
      if ( ! WC()->cart->is_empty() ) {
        // Loop though cart items
        foreach(WC()->cart->get_cart() as $cart_item ) {
   

            $product = get_product($cart_item['product_id']);

            if($product && ! $product->is_type('subscription') && !$product->is_type('variable-subscription')){

                // echo $product->get_type();

            unset($available_gateways['bacs']);
            unset($available_gateways['cheque']);

            }
          
    }
        
   }

   remove_filter( 'woocommerce_available_payment_gateways', __NAMESPACE__.'\\disable_invoice_personal',10 );
     
   return $available_gateways;
   
}

}

add_filter( 'woocommerce_available_payment_gateways', __NAMESPACE__.'\\disable_invoice_personal',10 );
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


function filter_wc_upload_shortcode($metadata, $object_id, $meta_key, $single){

    if(!in_array($meta_key, ['shareonedrive_upload_box_shortcode','shareonedrive_upload_box_folder_template','shareonedrive_upload_box', '_uploadable','shareonedrive_upload_box_active_on_status', 'shareonedrive_upload_box_title'])){
        return $metadata;
    }
	elseif(get_post_meta( $object_id, 'pf_customizable', true ) || has_term('large-format', 'product_cat', $object_id)){
		if(in_array($meta_key, ['shareonedrive_upload_box', '_uploadable'])){
			$metadata = 'no';
		}
		return $metadata;
    }
    elseif( class_exists( 'WC_Subscriptions_Product' ) && \WC_Subscriptions_Product::is_subscription( wc_get_product($object_id) ) ) {
        if(in_array($meta_key, ['shareonedrive_upload_box', '_uploadable'])){
			$metadata = 'no';
		}
		return $metadata;
    }

    else{
        


        switch($meta_key){
            case 'shareonedrive_upload_box_shortcode':
                $metadata = '[shareonedrive dir="3D07FF6BA4270E23!232" account="3d07ff6ba4270e23" mode="files" viewrole="all" userfolders="auto" viewuserfoldersrole="none" downloadrole="all" search="0" showbreadcrumb="0" upload="1" upload_auto_start="1" uploadrole="all" uploadext="jpg|png|gif|svg" notificationupload="1" rename="1" renamefilesrole="all" renamefoldersrole="all" editdescription="1" editdescriptionrole="all" delete="1" deletefilesrole="all" deletefoldersrole="all" ]';
            break;
            case 'shareonedrive_upload_box_title':
                $metadata = 'Artwork for %wc_product_name%';
            break;

            case 'shareonedrive_upload_box_folder_template':
                $metadata = '%wc_order_id% - %wc_product_name% - %user_email%';
            break;
            case 'shareonedrive_upload_box_active_on_status':
                $metadata = ['wc-pending', 'wc-processing', 'wc-completed'];
            break;

            case '_uploadable':
            case 'shareonedrive_upload_box':
                $metadata = 'yes';
            break;
        }

        return $metadata;

    }
   

    

   


}
//Specify 4 arguments for this filter in the last parameter.
add_filter('get_post_metadata', __NAMESPACE__.'\\filter_wc_upload_shortcode', 10, 4);



function add_account_link( $menu_links ){
 
	// we will hook "portal" later
	$new = array( 'portal' => 'Large Format upload' );
 

	// array_slice() is good when you want to add an element between the other ones
	$menu_links = array_slice( $menu_links, 0, 1, true ) 
	+ $new 
	+ array_slice( $menu_links, 1, NULL, true );
 
 
	return $menu_links;
 
 
}

add_filter ( 'woocommerce_account_menu_items', __NAMESPACE__.'\\add_account_link' );
 

function account_link_endpoint( $url, $endpoint, $value, $permalink ){
 
	if( $endpoint === 'portal' ) {
 
		// ok, here is the place for your custom URL, it could be external
		$url = get_permalink(191);
 
	}
	return $url;
 
}

add_filter( 'woocommerce_get_endpoint_url', __NAMESPACE__.'\\account_link_endpoint', 10, 4 );


/* add_action('woocommerce_before_checkout_form',function(){
    if($_GET['total']){
        WC()->cart->add_to_cart( 9351 );
        
    }
});
*/



function ipe_apply_custom_price_to_cart_item( $cart ) {

           // This is necessary for WC 3.0+
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ){
    return;
    }

// Avoiding hook repetition (when using price calculations for example)
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ){
        return;
    }

    // Loop through cart items
    foreach ( $cart->get_cart() as $item ) {
       // $item['data']->set_price( 40 );

     //  echo '<pre>';
      // print_r($item);
      // echo '</pre>';
    

    
       
            if(9351===$item['product_id']){
                $item['data']->set_price($item['lf_print_job']);
                //$item['data']->set_price('10');
            }

    }

}

add_action( 'woocommerce_before_calculate_totals', __NAMESPACE__.'\\ipe_apply_custom_price_to_cart_item', 99 );  


add_action('gform_after_submission_1', __NAMESPACE__.'\\after_submission', 10, 2 );

function after_submission( $entry, $form ) {


   // print_r($entry);
    
    if(true || $entry[16]){

        WC()->cart->empty_cart();
        WC()->cart->add_to_cart( 9351 );
       // WC()->cart->set_total('10');


        foreach ( WC()->cart->get_cart() as $item ) {
            //$item['data']->set_price( 40 );

            if(9351===$item['product_id']){
               // $item['data']->set_price( \GFCommon::to_number( rgar( $entry, '16' ) ) );

               $item['lf_print_job'] = \GFCommon::to_number( rgar( $entry, '16' ) );

            }
        } 
        
    }
  
}
<?php

/**
 * Woocommerce filters and custom functionality
 *
 * @package printing-express
 *
 * @since 2.0.0
 */

 namespace printing\woocommerce;

require_once 'woocommerce/filters.php';

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




function get_featured()
{

    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 18,
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

    add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
}


@ini_set( 'max_execution_time', '3000' );


add_action('woocommerce_before_shop_loop_item',function(){
    echo '<div class="product-loop-inner">';
},0);

add_action('woocommerce_before_subcategory',function(){
    echo '<div class="product-loop-inner">';
},0);

add_action('woocommerce_after_shop_loop_item',function(){
    echo '</div>';
},100);

add_action('woocommerce_after_subcategory',function(){
    echo '</div>';
},100);


function disable_woo_commerce_sidebar() {
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); 
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10); 
}
add_action('init', __NAMESPACE__.'\\disable_woo_commerce_sidebar');


add_action('woocommerce_before_main_content',function(){
    get_template_part( 'template-parts/banner' );


    echo '<section class="woocommerce-wrap">';
    echo '<div class="container">';
},0);

add_action('woocommerce_after_main_content',function(){

    echo '</div>';
    echo '</section>';
},100);



add_action('woocommerce_after_single_product_summary',function(){


    echo '<section class="related-wrap">';
    echo '<div class="container">';
},19);

add_action('woocommerce_after_single_product_summary',function(){
    echo '</div>';
    echo '</section>';
},21);

function do_search(){
    get_product_search_form();
}

add_action('woocommerce_before_shop_loop', __NAMESPACE__.'\\do_search', 15);
add_action('woocommerce_no_products_found', __NAMESPACE__.'\\do_search', 0);




add_action('woocommerce_after_single_product_summary',function(){
    if(!get_post_meta( get_the_id(), 'pf_customizable', true ) && !has_term('large-format', 'product_cat', null)){

        $message = "Please supply your customisation artwork after the order is complete. You can do this after the checkout, or from your Account.";

        
        echo '<p class="woocommerce-info bg-yellow" style="width: 100%">'.$message.'</p>';
    }
},1);

add_filter( 'woocommerce_product_subcategories_hide_empty', '__return_false', 10, 1 );

function hide_subcategory_count() {
  /* empty - no count */
}

add_filter( 'woocommerce_subcategory_count_html', __NAMESPACE__.'\\hide_subcategory_count' );

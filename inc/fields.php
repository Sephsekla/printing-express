<?php
/**
* Custom Fields
*
* @package printing-express
* @since 2.0.0
*/

namespace printing\fields;

use Carbon_Fields\Container;
use Carbon_Fields\Field;


	

add_action( 'carbon_fields_register_fields', __NAMESPACE__.'\\register_fields' );
function register_fields() {
	Container::make( 'term_meta', __( 'Category Properties' ) )
    ->where( 'term_taxonomy', '=', 'product_cat' )
    ->add_fields( array(
        Field::make( 'image', 'crb_thumb', __( 'Thumbnail' ) ),
	) );
}

add_action( 'after_setup_theme', __NAMESPACE__.'\\init' );

function init() {
    \Carbon_Fields\Carbon_Fields::boot();
}
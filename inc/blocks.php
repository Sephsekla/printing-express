<?php
/*
 * Block functions
 *
 * @package printing-express
 * @since 0.0.2
 */

namespace printing\blocks;

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

require_once 'blocks/charity.php';
require_once 'blocks/social.php';
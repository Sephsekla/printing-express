<?php

/**
 * Custom nav menu
 *
 * @package printing-express
 *
 * @since 0.0.4
 *
 * Many thanks to I Benic https://www.ibenic.com/how-to-create-wordpress-custom-menu-walker-nav-menu-class/
 */

 namespace printing\nav;

class jbr_Nav_Menu extends \Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		ob_start();

		echo '<li class="col-12 col-md-4 col-lg">';

		echo '<a href="' . $item->url . '" style="background-image: url(' . get_the_post_thumbnail_url( $item->object_id, 'medium' ) . ')">';

		\printing\utilities\picture( get_post_thumbnail_id( $item->object_id ), 'medium' );

		echo '<span>' . $item->title . '</span>';

		echo '</a>';

		echo '</li>';

		$output .= ob_get_clean();

	}
}

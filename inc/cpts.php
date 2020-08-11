<?php
/**
 * Custom Posts
 *
 * @package printing-express
 * @since 0.0.5
 */

 namespace printing\cpts;

function register() {

	$labels = array(
		'name' => _x( 'Charity Partners', 'Post Type General Name', 'textdomain' ),
		'singular_name' => _x( 'Charity Partner', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => _x( 'Charity Partners', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar' => _x( 'Charity Partner', 'Add New on Toolbar', 'textdomain' ),
		'archives' => __( 'Charity Partner Archives', 'textdomain' ),
		'attributes' => __( 'Charity Partner Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Charity Partner:', 'textdomain' ),
		'all_items' => __( 'All Charity Partners', 'textdomain' ),
		'add_new_item' => __( 'Add New Charity Partner', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Charity Partner', 'textdomain' ),
		'edit_item' => __( 'Edit Charity Partner', 'textdomain' ),
		'update_item' => __( 'Update Charity Partner', 'textdomain' ),
		'view_item' => __( 'View Charity Partner', 'textdomain' ),
		'view_items' => __( 'View Charity Partners', 'textdomain' ),
		'search_items' => __( 'Search Charity Partner', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Charity Partner', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Charity Partner', 'textdomain' ),
		'items_list' => __( 'Charity Partners list', 'textdomain' ),
		'items_list_navigation' => __( 'Charity Partners list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Charity Partners list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Charity Partner', 'textdomain' ),
		'description' => __( '', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-star-empty',
		'supports' => array('title', 'thumbnail'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => false,
		'capability_type' => 'post',
	);
	register_post_type( 'charity-partners', $args );
}

 add_action( 'after_setup_theme', __NAMESPACE__ . '\\register' );

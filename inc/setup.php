<?php
/*
 * Setup functions
 *
 * @package printing-express
 * @since 0.0.2
 */

namespace printing\setup;

function init() {

	load_theme_textdomain( 'printing-express', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'printing-express' ),
			'footer' => esc_html__( 'Footer', 'printing-express' ),
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	add_theme_support('align-wide');

	// Adds support for editor color palette.
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => 'Blue',
		'slug'  => 'blue',
		'color'	=> '#219FDA',
	),
	array(
		'name'  => 'Pink',
		'slug'  => 'pink',
		'color'	=> '#EC008C',
	),
	array(
		'name'  => 'Yellow',
		'slug'  => 'yellow',
		'color'	=> '#FFF200',
	),
	array(
		'name'  => 'Green',
		'slug'  => 'green',
		'color'	=> '#90C96D',
	),
	array(
		'name'  => 'Purple',
		'slug'  => 'purple',
		'color'	=> '#8750B3',
	),
	array(
		'name'  => 'White',
		'slug'  => 'white',
		'color'	=> '#FFFFFF',
	),
	array(
		'name'  => 'Dark',
		'slug'  => 'dark',
		'color'	=> '#231F20',
	),
) );

// Disables custom colors in block color palette.
add_theme_support( 'disable-custom-colors' );

add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	add_theme_support( 'widgets' );


	add_image_size( 'grid', 1100, 1000, false ); // (not cropped)


}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\init' );

add_action( 'init', function(){
 
	register_meta( 'post', 'printing_banner', array(
 		'type'		=> 'string',
 		'single'	=> true,
 		'show_in_rest'	=> true,
	 ) );
	 register_meta( 'post', 'printing_banner_class', array(
		'type'		=> 'string',
		'single'	=> true,
		'show_in_rest'	=> true,
	) );
	 
	 
 
});
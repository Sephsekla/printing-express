<?php

/**
 * Enqueue scripts and styles
 *
 * @package printing-express
 *
 * @since 0.0.3
 */

 namespace printing\scripts;

function init() {

	wp_register_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap', array(), date( 'M' ), 'all' );

	wp_register_style( 'printing-styles', get_template_directory_uri() . '/dist/main.min.css', array( 'google-fonts' ), filemtime( get_template_directory() . '/dist/main.min.css' ), 'all' );

	wp_enqueue_style( 'printing-styles' );

	wp_register_script( 'printing-scripts', get_template_directory_uri() . '/dist/main.js', array( 'jquery' ), filemtime( get_template_directory() . '/dist/main.js' ), true );

	wp_enqueue_script( 'printing-scripts' );

}

 add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\init' );


 /**
  * Add block editor scripts and styles
  *
  * @return void
  */
 function blocks(){

	wp_enqueue_script(
		'printing-blocks-js',
		get_template_directory_uri() . '/dist/blocks/blocks.js',
		[ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor' ],
		filemtime( get_template_directory() . '/dist/blocks/blocks.js' )
	);

	// Enqueue optional editor only styles
	wp_enqueue_style(
		'printing-blocks-editor-css',
		get_template_directory_uri() . '/dist/blocks/editor-blocks.css',
		[ ],
		filemtime( get_template_directory() . '/dist/blocks/editor-blocks.css' )
	);

 }

 add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\blocks' );

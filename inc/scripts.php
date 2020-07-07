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

	wp_register_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700|Roboto:400,700&display=swap', array(), date( 'M' ), 'all' );

	wp_register_style( 'jbr-styles', get_template_directory_uri() . '/dist/main.min.css', array( 'google-fonts' ), filemtime( get_template_directory() . '/dist/main.min.css' ), 'all' );

	wp_enqueue_style( 'jbr-styles' );

	wp_register_script( 'jbr-scripts', get_template_directory_uri() . '/dist/main.js', array( 'jquery' ), filemtime( get_template_directory() . '/dist/main.js' ), true );

	wp_enqueue_script( 'jbr-scripts' );

	wp_register_script( 'jbr-post', get_template_directory_uri() . '/dist/post.js', array(), filemtime( get_template_directory() . '/dist/post.js' ), true );

	if ( is_single() && get_post_type() === 'post' ) {
		wp_enqueue_script( 'jbr-post' );
	}

	wp_register_script( 'jbr-home', get_template_directory_uri() . '/dist/home.js', array(), filemtime( get_template_directory() . '/dist/home.js' ), true );
	

	if ( is_page_template('page-templates/template-home.php') ) {
		wp_enqueue_script( 'jbr-home' );
	}

	wp_register_script( 'jbr-wid', get_template_directory_uri() . '/dist/wid.js', array(), filemtime( get_template_directory() . '/dist/wid.js' ), true );
	

	if ( is_page_template('page-templates/template-wid.php') ) {
		wp_enqueue_script( 'jbr-wid' );
	}

	wp_register_script( 'jbr-about', get_template_directory_uri() . '/dist/about.js', array(), filemtime( get_template_directory() . '/dist/about.js' ), true );
	

	if ( is_page_template('page-templates/template-about.php') ) {
		wp_enqueue_script( 'jbr-about' );
	}

	wp_register_script( 'jbr-404', get_template_directory_uri() . '/dist/404.js', array(), filemtime( get_template_directory() . '/dist/404.js' ), true );

	if ( is_404() ) {
		wp_enqueue_script( 'jbr-404' );
	}

}

 add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\init' );


add_action('wp_head',function(){
	?>
	<noscript>
		<style>
			.loader, .loader-2{
				display: none !important;
			}
		</style>
	</noscript>
	<?php
});
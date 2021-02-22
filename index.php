<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package printing-express
 */

get_header();

global $wp_query;
$found_posts = $wp_query->found_posts;
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">



		<?php

		get_template_part( 'template-parts/banner' );



		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			}


			the_posts_navigation();

		} else {
			get_template_part( 'template-parts/404' );
		}

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

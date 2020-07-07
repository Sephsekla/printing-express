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

		get_template_part( 'template-parts/shared/banner' );

		if(is_archive()){
			get_template_part('template-parts/shared/archive','intro');
		}
		if(is_singular()){
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			}
		}
		else{

			/* Start the Loop */
		$i = 0;
		while ( have_posts() ) {
			the_post();

			/*
			 * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			 */
			if(0===$i++) {
				get_template_part( 'template-parts/content', 'latest' );
			break;

			} else {
				get_template_part( 'template-parts/content', 'archive' );

			}
		}


		

		if(have_posts() && $found_posts > 1){
			

		?><section><div class="container"><div class="row"> <?php

		while ( have_posts() ) {
			the_post();

			/*
			 * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			 */
			
				get_template_part( 'template-parts/content', 'archive' );

			
		}

		?></div></div></section> <?php

	}

}



			the_posts_navigation();

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

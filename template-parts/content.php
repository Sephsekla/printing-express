<article <?php post_class(); ?>">
	<div class="container">
	
			  <h1><?php the_title(); ?></h1>
			  <p class="date"><?php echo get_the_date( 'jS F Y' ); ?></p>
				<?php
				the_content();
				?>
	   
	  

		<footer class="article-footer">
			<?php echo get_the_category_list( ' | ' ); ?>
			<?php echo get_the_tag_list( '<p>Tagged in ', ' | ', '</p>' ); ?>
		</footer>
	</div>
</article>

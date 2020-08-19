<article <?php post_class(); ?>">
	<div class="container">
	
			  <h1><?php the_title(); ?></h1>
			  <!-- <p class="date"><?php echo get_the_date( 'jS F Y' ); ?></p> -->
			 
				<?php
				the_content();
				?>
	   
	  

		
	</div>
</article>

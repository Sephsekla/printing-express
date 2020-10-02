<article <?php post_class(); ?>">
    <div class="container">
    <?php
    if (function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
    }
    ?>
    
              <h1><?php the_title(); ?></h1>
              <!-- <p class="date"><?php echo get_the_date('jS F Y'); ?></p> -->
             
                <?php
                the_content();
                ?>
       
      

        
    </div>
</article>

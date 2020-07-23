
</div> <!-- /content -->

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6"><p>&copy; Joe Bailey-Roberts <?php echo date('Y') ?></p></div>
            <div class="col-12 col-sm-6"> <?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_id'        => 'footer-menu',
						)
					);
					?></div>
        </div>
        

       
    </div>
</footer>


</div> <!-- /page -->
<?php do_action('wp_footer') ?>
</body>
</html>
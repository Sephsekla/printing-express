<?php use function printing\assets\get_social as get_social; ?>

</div> <!-- /content -->

<footer class="site-footer">
    <div class="container">
        <div class="row align-items-end">

            <div class="col-12 col-sm-6 col-lg-3"> <?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_id'        => 'footer-menu',
						)
					);
					?>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <p><strong>Printing Express</strong><br />
                    399 London Rd, <br />
                    Camberley, <br />
                    Surrey, <br />
                    GU15 3HL</p>
                <p>01234 567890</p>
            </div>

            <div class="col-12 col-lg-6 right">
				<?php get_social() ?>
                <p>&copy; Printing Express <?php echo date('Y') ?> | Website by JBR Digital</p>
            </div>

        </div>



    </div>
</footer>


</div> <!-- /page -->
<?php do_action('wp_footer') ?>
</body>

</html>
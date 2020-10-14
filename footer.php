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
                <?php echo WC_Countries::get_base_address() ?> <br />
                <?php echo WC_Countries::get_base_address_2() ?> <br />
                <?php echo WC_Countries::get_base_city() ?> <br/>
                <?php echo WC_Countries::get_base_postcode() ?></p>
                <p>01276 415709</p>
            </div>

            <div class="col-12 col-lg-6 align-right">
				<?php get_social() ?>
                <p>&copy; Printing Express <?php echo date('Y') ?> | Website by <a href="https://jbr.digital" target="_blank">JBR Digital</p>
            </div>

        </div>



    </div>
</footer>


</div> <!-- /page -->
<?php do_action('wp_footer') ?>
</body>

</html>
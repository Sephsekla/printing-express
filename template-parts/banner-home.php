

<?php

use printing\utilities as utilities;
use printing\woocommerce;

$banner_id = utilities\get_banner_id();

$color = utilities\get_banner_color();

?>

<section class="banner border-<?php echo $color?> products" style="background-image: url('<?php echo wp_get_attachment_image_url( $banner_id, 'banner')?>')">

<?php utilities\picture($banner_id,'banner') ?>

    <div class="container-wrapper">
        <div class="container">
            <h2>Current Deals</h2>
            <ul class="products columns-6">
                <?php printing\woocommerce\get_featured(); ?>
            </ul>
         </div>
    </div>

</section>
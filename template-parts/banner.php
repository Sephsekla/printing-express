<?php

use printing\utilities as utilities;

$banner_id = utilities\get_banner_id();

$color = utilities\get_banner_color();


?>

<section class="banner border-<?php echo $color?>" style="background-image: url('<?php echo wp_get_attachment_image_url( $banner_id, 'banner')?>')">

<?php utilities\picture($banner_id,'banner') ?>

</section>
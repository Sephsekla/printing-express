<?php

use printing\utilities as utilities;

$banner_id = utilities\get_banner_id();

$color = 'blue';

?>

<section class="banner border-<?php echo $color?>" style="background-image: url('<?php echo wp_get_attachment_image_url( $banner_id, 'banner')?>')">

</section>
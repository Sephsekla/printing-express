<article class="restricted">
    <div class="container">
  <h1>Restricted</h1>
  <p>This area is restricted to logged in users. Please login or sign up.</p>

  <div class="woocommerce">
  <h2>Login</h2>
  <?php woocommerce_login_form(
    [
      'redirect' => get_permalink( 0 );
    ]
  ) ?>

<p><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="btn">Register</a></p>


  </div>

        
    </div>
</article>

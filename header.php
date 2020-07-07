<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SY_Video
 */

 use printing\nav as nav;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sy' ); ?></a>

	<header id="header-main" class="site-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col">
		<?php the_custom_logo(); ?>
</div>
<div class="col">
	

					<div class="nav-toggle-wrapper">
						<button class="toggle-nav toggle-button">
							<span class="inner">Menu</span>
							<span class="line line-1"></span>
							<span class="line line-2"></span>
							<span class="line line-3"></span>
							<span class="line line-4"></span>
						</div>
					</div>


					</div>       
					</div>      
		
	</header><!-- #masthead -->
	<div class="nav-overlay toggle-nav"></div>
					<nav class="main-nav">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'walker'         => new nav\jbr_Nav_Menu(),
						)
					);
					?>
					</nav>

	<div id="content" class="site-content">

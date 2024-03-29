<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Miles_2023
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<style>
	  *:not(:defined) {
	    display: none;
	  }
	</style>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'miles_2020' ); ?></a>
	<header id="masthead" class="site-header fixed">
	  <div class="site-header-container">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="Forside Miles.no">
				<miles-logo height="40.5" color="#ffffff"></miles-logo>
			</a>
		</div><!-- .site-branding -->
		<?php get_template_part( 'template-parts/primary-mega-menu', 'menu' ); ?>
	  </div>
	</header><!-- #masthead -->

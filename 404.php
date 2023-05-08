<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Miles_2020
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Ups, siden du lette etter eksisterer ikke.', 'miles_2020' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'Siden kan ha blitt flyttet, eller sjekk om adressen er skrevet riktig', 'miles_2020' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                   Gå til forsiden
                </a>
			</div><!-- .page-content -->
	
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();

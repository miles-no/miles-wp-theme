<?php
/**
 * Custom template for the archive page. In practise, this page is used for "News".
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Miles_2023
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<section class="pre-entry-content">
				<?php
                $description = get_theme_mod('miles_archive_description');
                $title = get_theme_mod('miles_archive_title');
                if( $title ) {
                    echo '<h1>' . esc_html( $title ) . '</h1>';
                }
                if( $description ) {
                    echo '<p class="has-medium-font-size">' . $description . '</p>';
                }
                //the_archive_title( '<h1>', '</h1>' );
				//the_archive_description( '<p class="has-medium-font-size">', '</p>' );
				?>
			</section><!-- .page-header -->

            <section class="blog-grid">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-blog', get_post_type() );

			endwhile;
        ?>
        </section>
        <?php
		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content-blog', 'none' );

	endif;
	?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

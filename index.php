<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Miles_2023
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php

        if ( have_posts() ) :

            $page_for_posts_id = get_option('page_for_posts');
            $posts_page_content =  get_post_field('post_content', $page_for_posts_id);

			if ( is_home() && ! is_front_page() ) :
				?>

				<section class="pre-entry-content">
					<?php echo do_blocks($posts_page_content); 	?>
				</section>


				<?php
			endif;
			?> <section class="blog-grid"> <?php
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
			<section class="blog-pagination"> 
                <?php
				the_posts_navigation();
                ?>
            </section>
            <section>
                <?php echo shortcode_podcast_teaser() ?>
            </section>
            <?php

		else :
			get_template_part( 'template-parts/content-blog', 'none' );
		endif;
		?>


	</main><!-- #main -->



<?php

get_footer();

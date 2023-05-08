<?php
/**
 * Menneskene single page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Miles_2020
 */

get_header();


?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-single-menneskene', get_post_type() );
			?>
			
			<div class="post-navigation">
				<div class="nav-links">
					<a href="#">
						<span class="nav-item">
							<a href="javascript:history.back()">Tilbake</a>
						</span>
					</a>
				</div>
			</div>

		<?php endwhile;?>

	</main><!-- #main -->

<?php

get_footer();

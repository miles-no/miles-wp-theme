<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Miles_2023
 */

 include_once 'shortcode_util.php';
 include_once 'RssFeedReader.php';
 
 $PAGE_SIZE = 6; // episodes per page
 $page = get_query_var('paged') ? get_query_var('paged') : 1; // current page
 
 $start = ($page - 1) * $PAGE_SIZE;
 $end = $start + $PAGE_SIZE;
 
 $episodes = ( new RssFeedReader() )->get_episodes();
 $totalEpisodes = count($episodes);
 $totalPages = ceil($totalEpisodes / $PAGE_SIZE);
 
 $episodes = array_slice( $episodes, $start, $PAGE_SIZE );
 
 $result = '';
 
 foreach ( $episodes as $episode ) {
     $attributes = array(
         "episode_number" => $episode["episode_number"],
         "episode_title"  => $episode["episode_title"],
         "published_date" => $episode["published_date"],
         "url"            => $episode["mp3_link"],
         "length"         => $episode["length"]
     );
 
     $body = podcast_sanitize_description( $episode["description"] );
 
     $result .= shortcode_util\toWebComponent( "miles-podcast-card", $attributes, $body );
 }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- <header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>-->

	<?php miles_2020_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

        echo $result;

        $pagination_args = array(
            'base'      => add_query_arg('paged','%#%'),
            'format'    => '?paged=%#%',
            'current'   => $page,
            'total'     => $totalPages,
            'mid_size'  => 0, // hide page numbers
            'prev_text' => __('Nyere episoder', 'textdomain'),
            'next_text' => __('Eldre episoder', 'textdomain'),
            'prev_next' => true,
            'type'      => 'array',
        );

        $links = paginate_links($pagination_args);

        if (is_array($links)) {
            echo '<div class="pagination-wrapper">';
            //prev links
            if ($page > 1 && isset($links[0])) {
                echo '<div class="nav-prev alignleft">' . $links[0] . '</div>';
            }
            
            //post links
            if ($page < $totalPages && isset($links[count($links) - 1])) {
                echo '<div class="nav-next alignright">' . $links[count($links) - 1] . '</div>';
            }
            echo '</div>';
        }

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'miles_2020' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'miles_2020' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

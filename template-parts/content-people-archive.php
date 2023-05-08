<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package miles
 */
    $postid = get_the_ID(); // For ACF when loading this as a block: The post id must be passed explicitly IOK 2020-06-22
 	$name = get_field( 'firstname', $postid );
?>

<?php

$offboarding_date = get_field('offboarding_date',$postid);
$offtime = strtotime(str_replace('/', '-', $offboarding_date));

$onboarding_date = get_field('onboarding_date',$postid);
$ontime = strtotime(str_replace('/', '-', $onboarding_date));


if (!empty($offboarding_date) && $offtime < time()) {
	// we have offboarded
}
elseif (!empty($onboarding_date) && $ontime > time()) {
	// we have not yet onboarded
}
else { ?>

<article id="post-<?php the_ID(); ?>" class="menneskene-post five-columns">

	<?php echo '<a href="'. get_the_permalink() . '">'; ?>

		<?php if ( has_post_thumbnail() ) { ?>
			<figure class="person-thumbnail">
				<?php the_post_thumbnail('thumbnail'); ?>
			</figure>
		<?php } ?>
			<figure class="person-thumbnail">

				<?php
				$thumbnail = ''; // init of var PMB 2020-02-05
				if (!empty(get_field('thumbnail',$postid))) {
					// use thumbnail if it is there. for backward compatibility and flexibility PMB 2020-02-05
					$thumbnail = get_field('thumbnail',$postid);
				}
				else if (!empty(get_field('image',$postid))) {
					$cloudinary_string = 'c_fill,f_auto,g_face:center,h_260,w_260';
					$delimiter = 'upload/';
					$img_parts = explode('upload/', get_field('image',$postid));

					// put the parts together PMB 2020-02-05
					$thumbnail = $img_parts[0] . $delimiter . $cloudinary_string . '/' . $img_parts[1];
				}
				else {
					// if we have no image at all, then we use the image based on gender PMB 2020-02-05
					$thumbnail = '/wp-content/themes/miles/image/' .get_field('sex',$postid) . '.png';
				}

				?>
				<?php 
				// Old code doing the image thumbnail PMB 2020-02-05
				// $thumbnail = (!empty(get_field('thumbnail',$postid))) ? get_field('thumbnail',$postid) : '/wp-content/themes/miles/image/' .get_field('sex',$postid) . '.png'; 
				?>

				<?php echo '<img class="attachment-thumbnail size-thumbnail wp-post-image" src="' . $thumbnail . '">'; ?>		
			</figure>
		<div class="person-name">
                  <?php echo $name;  ?>
		</div>

	<?php echo '</a>'; ?>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'miles' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

<?php } ?>

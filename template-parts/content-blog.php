<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Miles_2020
 */

?>

 <?php /* echo '<a href="'. get_the_permalink() . '" class="fagblogg-thumbnail fagblogg-column">'; */ ?> 
<miles-blog-card id="post-<?php echo the_ID(); ?>" url="<?php echo get_permalink(); ?>" author="<?php echo the_author(); ?>">
	<?php if ( has_post_thumbnail() ) { ?>
		<figure slot="image">
			<?php the_post_thumbnail('feature-image'); ?>
		</figure>
	<?php } ?>

	<?php  the_title( '<h2 slot="title">', '</h2>' ); ?>
	<div slot="meta">
		<?php miles_2020_posted_on();?>
	</div><!-- .entry-meta -->
</miles-blog-card><!-- #post-<?php the_ID(); ?> -->
<!-- <?php post_class(); ?>  -->

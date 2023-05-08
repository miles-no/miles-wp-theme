<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Miles_2020
 */

$name = get_field('firstname');
$surname = get_field('lastname');
$social = get_field('social');	
$email = get_field('email');
$phone = get_field('phone');
$sex = get_field('sex');
$rol = get_field('roles');
$category = get_categories('taxonomy=by&post_type=surgical');
$terms = get_the_terms(get_the_ID(), 'by');
//print_r($terms);
$firstCategory = $terms[0]->name; 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="person-header">
		  
		<div class="person-meta-data">
		  	  <div class="name"><?php echo $name; ?> <?php echo $surname; ?></div>
			  <div class="title-location"><?php echo $rol; ?>, <?php echo $firstCategory ?></div>
			  <div class="email"><?php echo $email; ?></div>
			  <div class="phone"><?php echo $phone; ?></div>
		</div>
		
		
		<?php if( $social ): ?> 
				<ul class="person-socials-wrapper"> 

						<?php if( $social['blog'] ): ?>						
							<li class="icon">
								<a href="<?php echo $social['blog']; ?>"  class="icon-blog" target="_black">
									<span class="no-display">Blog</span>
								</a>
							</li>
						<?php endif; ?>
						<?php if( $social['linkedin'] ): ?>
							<li class="icon">
								<a href="https://www.linkedin.com/in/<?php echo $social['linkedin']; ?>" class="icon-linkedin" target="_black">
									<span class="no-display">Linkedin</span>
								</a>
							</li>
						<?php endif; ?>
						<?php if( $social['twitter'] ): ?>
							<li class="icon">
								<a href="https://twitter.com/<?php echo $social['twitter']; ?>" target="_black" class="icon-twitter">
									<span class="no-display">Twitter</span>
								</a>
							</li>
						<?php endif; ?>
					    <?php if( $social['github'] ): ?>
						   <li  class="icon">
							<a href="https://github.com/<?php echo $social['github']; ?>"  target="_black" class="icon-github">
								<span class="no-display">Github</span>
							</a>
						  </li>
						
					  <?php endif; ?>
				</ul>
		<?php endif; ?>		

    </header><!-- .entry-header -->
    
   	<?php $thumbnail = (!empty(get_field('image'))) ? get_field('image') : '/wp-content/themes/miles/image/' .get_field('sex') . '.png'; ?>
	<figure class="person-thumbnail" style="background-image: url('<?php echo $thumbnail; ?>');">
	</figure>
      
    
	<div class="entry-content">

		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'miles_2020' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'miles_2020' ),
				'after'  => '</div>',
			)
		);
		?>
	  </div><!-- .entry-content -->


	<footer class="entry-footer">
		<?php miles_2020_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

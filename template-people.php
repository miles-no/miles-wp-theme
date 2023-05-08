<?php
/**
 * Template Name: Menneskene List Template 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Miles_2020
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>
		
		<?php 
   $title = get_field('title');
   $selector = get_field('city_selector');  
?>
<div id="block-people" class="block-people">
      			        				 
     <div class="block-people-wrapper">
        <?php if( $title ) : ?>
           	 <h3 class="block-title">
           	     <?php echo $title; ?>
            </h3> 
        <?php endif; ?>   				           					            			
         <?php 
             $args = array(
             /*    'tax_query' => array(
        			array(
            			'taxonomy' => 'by',
            			'field' => 'slug',
                        'terms' => array( $selector )
        				),
    			),*/
	            'numberposts'	=> -1,
				'post_type' => 'menneskene',
				'orderby' => 'title',
                'order' => 'ASC',
             );
           ?>

		  <?php $loop = new WP_Query( $args ); ?>
			
			  <?php 
     				if($loop->have_posts()) {
     							
    					$term = $wp_query->queried_object;
     						while($loop->have_posts()) : $loop->the_post();
        							get_template_part( 'template-parts/content-people-archive', 'page' );
  
      						endwhile;
					}
				?>
									
			   	
           
	</div>
						
</div>

	</main><!-- #main -->

<?php

get_footer();

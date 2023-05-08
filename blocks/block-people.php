<?php 
   $title = get_field('title');
   $selector = get_field('city_selector');  

?>
<div id="custom-block-people" class="custom-block-people ">
      			        				  
        <?php if( $title ) : ?>
           	 <h3 class="block-title">
           	     <?php echo $title; ?>
            </h3> 
        <?php endif; ?>   				           					            			
         <?php 
             $args = array(
                 'tax_query' => array(
        			array(
            			'taxonomy' => 'by',
            			'field' => 'slug',
                        'terms' => array( $selector )
        				),
    			),
	            'numberposts'	=> -1,
				'post_type' => 'menneskene',
				'orderby' => 'title',
                'order' => 'ASC',
                'posts_per_page' => '90'
             );
           ?>
         					
		  <?php $loop = new WP_Query( $args ); ?>
	
			  <?php 
     				if($loop->have_posts()) {
     							
    					$term = $wp_query->queried_object;
     						while($loop->have_posts()) : $loop->the_post();
        							get_template_part( 'template-parts/content-people-archive', 'page' );
  
      						endwhile;
                    wp_reset_postdata();
					}
			?>
												   	
</div>
	

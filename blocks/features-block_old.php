<?php 
 $title = get_field('title');
 $bg_color = get_field('bg_color');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'features-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php echo $bg_color; ?>">

  <?php if( $title ): ?> 
     <h2 class="features-block-title">
        <?php echo $title; ?>
     </h2>
  <?php endif; ?>
     <?php if( have_rows('ad_feature') ): ?>
			<div class="features-wrapper">
					<?php 
    					while ( have_rows('ad_feature') ) : the_row();

    					  $image = get_sub_field('image');
    					  $size = 'feature-image';
                          $position = get_sub_field('position');
                          $title = get_sub_field('title');
                          $text = get_sub_field('text');
						?>
						<div class="feature-wrapper<?php if( $position ): ?> position-<?php echo $position; ?><?php endif; ?>">
						  <?php if( $image ): ?>
						     <figure class="feature-image">
                                 <?php echo wp_get_attachment_image( $image, $size ); ?>
                             </figure>
						  <?php endif; ?>
						  <div class="feature-content">
						     <?php if( $title ): ?>
						       <h2 class="feature-title">
						          <?php echo $title; ?>
						       </h2>
						      <?php endif; ?>
						      <?php if( $text ): ?>
						       <p class="feature-text">
						          <?php echo $text; ?>
						       </p>
						      <?php endif; ?>
						      
						      
						    <?php if( have_rows('link_repeater') ): ?>
			                  <div class="link_wrapper">
					            <?php 
    					          while ( have_rows('link_repeater') ) : the_row();
    					            $link_text = get_sub_field('link_text');
                                    $link_link = get_sub_field('url');
						         ?>
						        <?php if( $link_text ): ?>
							        <a href="<?php echo $linktext; ?>" class="link">
								        <?php echo $link_text; ?>
							        </a>
						         <?php endif; ?>
        			           <?php endwhile; ?>
    		                 </div>
    	                   <?php endif; ?>  
    	                   						     					     
						  </div>
						</div>
        			<?php endwhile; ?>
    		</div>
    	<?php endif; ?>  
  
</div>
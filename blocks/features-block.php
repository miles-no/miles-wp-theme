<?php 
 $image = get_field('image');
 $size = 'feature-image';
 $title = get_field('title');
 $text = get_field('text');
 $button = get_field('button');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-block-feature-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">


		<div class="feature-wrapper">
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
				    
				  <?php if( have_rows('list') ): ?>
	                  <ul class="list_wrapper">
			            <?php 
				          while ( have_rows('list') ) : the_row();
				            $list_item = get_sub_field('list_item');
				         ?>
				        <?php if( $list_item ): ?>
					       <li> <?php echo $list_item; ?></li>
				         <?php endif; ?>
			           <?php endwhile; ?>
						</ul>
                   <?php endif; ?>    
							  
						      
				    <?php if( have_rows('link_repeater') ): ?>
	                  <div class="link_wrapper">
			            <?php 
				          while ( have_rows('link_repeater') ) : the_row();
				            $link_text = get_sub_field('link_text');
                            $link_link = get_sub_field('url');
				         ?>
				        <?php if( $link_text ): ?>
					        <a href="<?php echo $link_link; ?>" class="link" >
						        <?php echo $link_text; ?>
					        </a>
				         <?php endif; ?>
			           <?php endwhile; ?>
	                 </div>
                   <?php endif; ?>  
                   <?php if( $button['text'] ): ?>
                     <a href="<?php echo esc_url( $button['url']['url'] ); ?>" class="feature-button__link">
                       <?php echo esc_html( $button['text'] ); ?>
                     </a>
                   <?php endif; ?>  
				</div>
		</div>       			
</div>

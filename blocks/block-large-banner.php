 <?php 
  $image_desktop = get_field('image_desktop');
  $image_mobile = get_field('image_mobile');
  $background_color = get_field('background_color');
  $text_color = get_field('text_color');
  $banner_title = get_field('banner_title');
  $banner_text = get_field('banner_text');
  $banner_position = get_field('banner_position');
// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-block-feature-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


 ?>
 
<div id="custom-block-large-banner" class="custom-block-large-banner <?php echo esc_attr($className); ?>">
<div class="front-slogan">
  <h1>
    <span>Miles -</span>
    faglig autoritet og varme
  </h1>
  <p>Ditt konsulentselskap - Vi dekker et bredt spekter av IT - kompetanse.</p>
  
</div>
  <figure class="large-banner-image image-desktop<?php if( $image_mobile ): ?> no-tablet<?php endif; ?>" style="background-image: url('<?php echo $image_desktop['sizes']['hero']; ?>');"> 
  </figure>
   <?php if( $image_mobile ): ?> 
     <figure class="large-banner-image image-mobile" style="background-image: url('<?php echo $image_mobile['sizes']['hero-mobile']; ?>');">
      
     </figure>
  <?php endif; ?>

  <!--
  <?php if( $banner_title ): ?> 
    <div class="large-banner-content <?php echo $background_color; ?> <?php echo $text_color; ?> content-<?php echo $banner_position ?>">      
        <h2 class="banner-title">
            <?php echo $banner_title; ?>
        </h2>
        <?php if( $banner_text ): ?> 
        
          <div class="banner_text">
             <?php echo $banner_text; ?>
          </div>
     
        <?php endif; ?>
        <?php if( have_rows('link_repeater') ): ?>
			<div class="link_wrapper">
					<?php 
    					while ( have_rows('link_repeater') ) : the_row();

    					  $button_text = get_sub_field('text');
                          $button_link = get_sub_field('link');
						?>
						<?php if( $button_text ): ?>
							<a href="<?php echo $button_link; ?>" class="link">
								<?php echo $button_text; ?>
							</a>
						<?php endif; ?>
        			<?php endwhile; ?>
    		</div>
    	<?php endif; ?>  
    </div> 
  <?php endif; ?>
  -->
</div>

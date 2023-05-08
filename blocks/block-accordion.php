<?php


?>
<div id="custom-block-accordion-block" class="custom-block-accordion-block" >

	<div class="accordion-container alignwide">
		<?php

			// check if the repeater field has rows of data
			if( have_rows('accordion_repeater_new') ):

 				// loop through the rows of data
    			while ( have_rows('accordion_repeater_new') ) : the_row();
    		?>    			
   			
    			<?php
    				$title = get_sub_field('title');
					$content = get_sub_field('content');	
        		?>	
			
  				<div class="accordion-content">	
					<div class="accordion-button">
						<span class="plus-icon">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 14 14" style="enable-background:new 0 0 14 14;" xml:space="preserve">
								<g id="Layer_2_1_">
									<g id="Layer_1-2">
										<line class="st0 vert" x1="7" y1="1" x2="7" y2="13"></line>
										<line class="st0 hori" x1="1" y1="7" x2="13" y2="7"></line>
									</g>
								</g>
							</svg>
						</span>
						<h3 class="accordion-title">
							<span>
								<?php echo $title; ?>
							</span>
						</h3>

					</div>					
					<div class="row-content">
						<?php echo $content; ?>
					</div>
  				</div>
        		<?php

    			endwhile;

		endif;
	?>		
	</div>
</div>
<?php
// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-block-feature-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

?>
<nav id="custom-block-menu-city-block" class="custom-block-menu-city-block ">
		<?php 

		   	 wp_nav_menu(
				 array(
					  'theme_location' => 'menu-1',
					  'menu_id'        => 'menu-city',
					  'container_class' => 'menu-city-container',	
                    								
				)
			 );
		?> 
 </nav>
 

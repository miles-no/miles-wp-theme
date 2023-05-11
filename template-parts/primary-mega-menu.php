
<miles-site-menu>
<nav class="main-navigation site-nav">
    <ul id="menu-topmenu" class="menu-topmenu">

        <?php
            $locations = get_nav_menu_locations();

            if ( isset( $locations[ 'mega_menu' ] ) ) {
                $menu = get_term( $locations[ 'mega_menu' ], 'nav_menu' );
                if ( $items = wp_get_nav_menu_items( $menu->name ) ) {                       
                    foreach ( $items as $item ) {
                    
                    	$hamburger = get_field('hamburger', $item);
						$mega_menu = get_field('has_megamenu_area', $item);

						
						
                        echo '<li class="menu-item '; if($hamburger  == 1): echo'has-hamburger';endif; echo join(" ",$item->classes);  echo '">';
                       		 echo $hamburger['value'];
                       		 
                       		 echo "<a href=\"{$item->url}\">
                                	<span class=\"item-title\">{$item->title}</span>
									</a>";
                            if ( is_active_sidebar( 'mega-menu-widget-area-' . $item->ID ) ) {
                                    
                                echo "<ul class=\"mega-menu-block\">
                                        <div class=\"mega-menu-container\">";
                                         		echo "<ul id=\"mega-menu-{$item->ID}\" class=\"mega-menu-grid\">";
                                            		dynamic_sidebar( 'mega-menu-widget-area-' . $item->ID );
                                          		echo "</ul>";  

                                        	echo "</div>
                                    </ul>";
                            }
                                    
                    	echo "</li>";

                    }
                }
            }
        ?>
 	</ul>               		
</nav>
</miles-site-menu>
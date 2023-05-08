<?php
/**
 * Miles 2020 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Miles_2020
 */



if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'miles_2020_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function miles_2020_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Miles 2020, use a find and replace
		 * to change 'miles_2020' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'miles_2020', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
			   'handheld' => esc_html__( 'Primary menu', 'miles_2020' ),		
				'menu-1' => esc_html__( 'Byer', 'miles_2020' ),
				
		//		'menu-2' => esc_html__( 'Byer', 'miles_2020' ),

			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'miles_2020_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 92,
				'width'       => 73,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'miles_2020_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function miles_2020_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'miles_2020_content_width', 640 );
}
add_action( 'after_setup_theme', 'miles_2020_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
 
 // Add City menu image

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	
	// loop
	foreach( $items as &$item ) {
		
		// vars
		$image = get_field('image', $item);
		$size = 'feature-image';		
		// append icon
		if( $image ) {
			$item->title .= '<figure class="city-menu-image">'.wp_get_attachment_image( $image, $size ).'</figure>';
		}
	}	
	
	// return
	return $items;
	
}

add_filter( 'render_block', 'miles_wrap_gallery', 10, 3);
 
function miles_wrap_gallery( $block_content, $block ) {
     
  if( "core/gallery" !== $block['blockName'] ) {
    return $block_content;
  }

  if (str_contains($block['attrs']['className'], 'miles-image-slider')) {
	$output = '<miles-image-slider inview="3" autoplay="true">';
	$output .= $block_content;
	$output .= '</miles-image-slider>';
	return $output;
  } else {
	return $block_content;
  }
}


add_filter( 'render_block', 'miles_fagblogg_teaser', 10, 3);
 
function miles_fagblogg_teaser( $block_content, $block ) {

  if( "core/latest-posts" !== $block['blockName'] ) {
    return $block_content;
  }

  if (str_contains($block['attrs']['className'], 'miles-fagblogg-teaser')) {

	$output = '<miles-fagblogg-teaser>';
	$output .= $block_content;
	$output .= '</miles-fagblogg-teaser>';
	return $output;
  } else {
	return $block_content;
  }
}

add_filter( 'render_block', 'miles_overlap_block', 10, 3);
 
function miles_overlap_block( $block_content, $block ) {
  if (!isset($block['attrs']['className'])) {
	  return $block_content;
  } elseif (str_contains($block['attrs']['className'], 'miles-overlap-block')) {
	$output = '<miles-overlap-block>';
	$output .= $block_content;
	$output .= '</miles-overlap-block>';
	return $output;
  } elseif(str_contains($block['attrs']['className'], 'office-banner')){
	$output = '<miles-office-banner>';
	$output .= $block_content;
	$output .= '</miles-office-banner>';
	return $output;
  } else {
	return $block_content;
  }
}



function miles_2020_widgets_init() {
	/*register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'miles_2020' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'miles_2020' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	); */
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Contacts', 'miles_2020' ),
		'id'            => 'footer-contact',
		'description'   => esc_html__( 'Add widgets here.', 'miles_2020' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Socials', 'miles_2020' ),
		'id'            => 'footer-social',
		'description'   => esc_html__( 'Add widgets here.', 'miles_2020' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer info', 'miles_2020' ),
		'id'            => 'footer-info',
		'description'   => esc_html__( 'Add widgets here.', 'miles_2020' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
}
add_action( 'widgets_init', 'miles_2020_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function miles_2020_scripts() {

	wp_enqueue_style(
			'miles_2020-style',
			get_stylesheet_uri(),
			array(), _S_VERSION
	);

	# https://cdn.jsdelivr.net/gh/miles-no/miles_web_components/style.css

	
	wp_style_add_data( 'miles_2020-style', 'rtl', 'replace' );
	
	wp_enqueue_script( 'miles_2020-navigation',
   						get_template_directory_uri() . '/js/navigation.js',
   						array(),
   						filemtime(get_template_directory() . '/js/navigation.js'),
   						true);

	
	   wp_enqueue_script( 'miles_2020-cvpartner',
   						get_template_directory_uri() . '/js/cvpartner.js',
   						array(),
   						filemtime(get_template_directory() . '/js/cvpartner.js'),
   						true);

	   wp_enqueue_script( 'miles_2020-wc',
	   get_template_directory_uri() . '/js/web-components/miles-wc.js',
	   array(),
	   filemtime(get_template_directory() . '/js/web-components/miles-wc.js'),
	   true);
	/*
	wp_enqueue_script( 'miles_2020-wc',
	'https://cdn.jsdelivr.net/gh/miles-no/miles_web_components/public/web-components/miles-wc.js',
	array(),
	'',
	true);
	*/	
   	
    // Translatable text for the navigation files IOK 2020-04-15
        $miles_2020n = array(
                                        'expand'   => __( 'Expand child menu', 'miles_2020' ),
                                        'collapse' => __( 'Collapse child menu', 'miles_2020' ),
        );
        
        wp_localize_script( 'miles_2020-navigation', 'miles2020ScreenReaderText', $miles_2020n );


/*	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	} */
}
add_action( 'wp_enqueue_scripts', 'miles_2020_scripts' );

/**
 * Gutenberg scripts
 */

function miles_2020_gutenberg_scripts() {

		wp_enqueue_script(
						'miles_2020_theme-editor',
    					get_template_directory_uri() . '/js/editor.js',
    					array( 'wp-blocks', 'wp-dom' ),
    					filemtime( get_template_directory() . '/js/editor.js' ),
    					true
    	);
}

add_action( 'enqueue_block_editor_assets', 'miles_2020_gutenberg_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* =========================================
   Mega-menu functions
  ========================================== */


function wpmm_setup() {
    register_nav_menus( array(
        'mega_menu' => 'Mega Menu'
    ) );
}
add_action( 'after_setup_theme', 'wpmm_setup' );

function wpmm_init() {
    $location = 'mega_menu';
    $css_class = 'has-mega-menu';
    $locations = get_nav_menu_locations();
    if ( isset( $locations[ $location ] ) ) {
        $menu = get_term( $locations[ $location ], 'nav_menu' );
        if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
            foreach ( $items as $item ) {
                if ( in_array( $css_class, $item->classes ) ) {
                
                    register_sidebar( array(
                        'id'   => 'mega-menu-widget-area-' . $item->ID,
                        'name' => $item->title . ' - Mega Menu, Primary menus',
                        'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
                    ) );

                }
            }
        }
    }
}
add_action( 'widgets_init', 'wpmm_init' );




/* =========================================
   Custom Post MENNESKENE 
  ========================================== */

function miles_menneskene() {

	$labels = array(
		'name'                  => _x( 'Menneskene', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Menneskene', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Menneskene', 'text_domain' ),
		'name_admin_bar'        => __( 'Menneskene', 'text_domain' ),
		'archives'              => __( 'menneskene', 'text_domain' ),


	);

	$args = array(
		'label'                 => __( 'menneskene', 'text_domain' ),
		'description'           => __( 'Menneskene liste', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'post-formats'),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 40,
	//	'show_in_admin_bar'     => true,
	//	'show_in_nav_menus'     => true,
	//	'can_export'            => true,
		'has_archive'           => false,	
	//	'exclude_from_search'   => true,
	//	'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' => array(  'slug' => 'ansatte' ),
            'show_in_rest' => true,
	);
	
	
	register_post_type( 'menneskene', $args );
	   // register taxonomy
    register_taxonomy('by', 'menneskene', 
    	array(
    		'hierarchical' => true, 
    		          'public' => false,
    	  'show_ui' => true,
    	  'show_in_rest' => true,
    		'label' => 'By', 
    		'query_var' => true, 
    		'has_archive'  => 'category-menneskene',
    		'rewrite' => array( 
    				'slug' => 'by', 
    				'with_front' => false
    		)
    	)
    );
    register_taxonomy('role', 'menneskene', 
    	array(
          'public' => false,
    	  'show_ui' => true,
    	  'show_in_rest' => true,
    		'hierarchical' => true, 
    		'label' => 'Role', 
    		'query_var' => true, 
    		'has_archive'  => 'category-role',
    		'rewrite' => array( 
    				'slug' => 'role', 
    				'with_front' => false
    		)
    	)
    );
}


add_action( 'init', 'miles_menneskene', 0 );


add_filter( 'manage_menneskene_posts_columns', 'miles_filter_posts_columns' );
function miles_filter_posts_columns( $columns ) {
	$columns = array(
 	'cb' => $columns['cb'],
 	'title' => 'Title',
 	 'onboarding_date' => __( 'Onboarding'),
  	  'offboarding_date' => __( 'Offboarding')
	);
  return $columns;
}

add_action( 'manage_menneskene_posts_custom_column', 'miles_menneskene_column', 10, 2);
function miles_menneskene_column( $column, $post_id ) {
  // Image column
  if ( 'onboarding_date' === $column ) {
    echo get_field('onboarding_date', $post_id);
  }
  else if( 'offboarding_date' === $column) {
  	echo get_field('offboarding_date', $post_id);
  }
}


add_filter( 'manage_edit-menneskene_sortable_columns', 'miles_menneskene_sortable_columns');
function miles_menneskene_sortable_columns( $columns ) {
  $columns['onboarding_date'] = 'onboarding_date';
  $columns['offboarding_date'] = 'offboarding_date';
  return $columns;
}

add_action( 'pre_get_posts', 'miles_posts_orderby' );
function miles_posts_orderby( $query ) {
  if( ! is_admin() || ! $query->is_main_query() ) {
    return;
  }

  if ( 'onboarding_date' === $query->get( 'orderby') ) {
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', 'onboarding_date' );
    $query->set( 'meta_type', 'date' );
  }
  else if ('offboarding_date' === $query->get( 'orderby') ) {
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', 'offboarding_date' );
    $query->set( 'meta_type', 'date' );
  }
}


function miles_menneskene_icon() {
  ?>
	<style type="text/css" media="screen">
	  li.menu-icon-menneskene div.wp-menu-image::before { 
				content: "\f338";
		}
	</style>
	<?php
  
  }
add_action( 'admin_head', 'miles_menneskene_icon' );


/********
Crop and resize images
********/

add_image_size( 'medium', 600, 350, true );

add_image_size( 'hero', 1440, 810, true );
add_image_size( 'hero-mobile', 600, 350, true );
add_image_size( 'feature-image', 1080, 721, true );
add_image_size( 'blog-feature-image', 385, 258, true );

add_image_size( 'medium-gallery', 500, 300, true );


/****************************************
# ACF google maps api key PMB 2019-20-07
*****************************************/

function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyBI-g6ODk1s3DMlHiMtejG3V-NeNf2U3Ms');
}

add_action('acf/init', 'my_acf_init');

/************************************************************************
Add Gutenberg custom editor-style
******************************************************************/

add_filter( 'wprss_ftp_link_post_title', '__return_true' );

add_editor_style( 'editor-style.css' );


/*******************************************
  Gutenberg functions and custom setups
 ******************************************/
 
// Editor Styles
add_theme_support( 'editor-styles' );
add_editor_style( 'editor.css' );

/******  Register Full and wide aligments ****/

add_theme_support( 'align-wide' );
/******  Register Gutemberg color pallette  ****/
 
 // -- Disable Custom Colors
add_theme_support( 'disable-custom-colors' );

 // -- Enable Custom Colors
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Black', 'miles_2020' ),
		'slug'  => 'black',
		'color'	=> '#2b353f',
	),
	array(
		'name'  => __( 'Miles red', 'miles_2020' ),
		'slug'  => 'miles-red',
		'color' => '#b8261c',
	),
	array(
		'name'  => __( 'Dark blue', 'miles_2020' ),
		'slug'  => 'dark-blue',
		'color' => '#051d34',
	),
	array(
		'name'	=> __( 'Silver', 'miles_2020' ),
		'slug'	=> 'silver',
		'color'	=> '#B5BBC4',
	),
	array(
		'name'	=> __( 'Silver light', 'miles_2020' ),
		'slug'	=> 'silver-light',
		'color'	=> '#e5eBf4',
	),
	array(
		'name'	=> __( 'White', 'miles_2020' ),
		'slug'	=> 'white',
		'color'	=> '#ffffff',
	),
	array(
		'name'	=> __( 'Transparent', 'miles_2020' ),
		'slug'	=> 'transparent',
		'color'	=> 'transparent',
	),
) );

add_filter( 'wprss_ftp_link_post_title', '__return_true' );

/**
 * Add custom short codes
 */
include_once 'shortcodes.php';
include_once 'shortcodes_dev.php';

if (function_exists('register_shortcodes') && function_exists('register_shortcodes_dev')) {
    add_action('init', 'register_shortcodes');
	add_action('init', 'register_shortcodes_dev');
} else {
    echo "shortcode functions are not available.<br />\n";
}

/**
 * enable use of shortcodes in php files
 */
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Register Custom Blocks 
 *
 */
function be_register_blocks() {
	
	if( ! function_exists( 'acf_register_block_type' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'large-banner',
		'title'			=> __( 'Hero', 'miles_2020' ),
		'render_template'	=> 'blocks/block-large-banner.php',
		'category'		=> 'common',
		'icon'			=> 'welcome-view-site',
		'align'         => false,
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'      => array(
                'align' => array( false ),
                'mode'	=> 'preview'
        ),
	));
	
	acf_register_block_type( array(
		'name'			=> 'features-block',
		'title'			=> __( 'Feature', 'miles_2020' ),
		'render_template'	=> 'blocks/features-block.php',
		'category'		=> 'common',
		'icon'			=> 'id-alt',
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'      => array(
                'align' => array( true ),
                'mode'	=> 'auto'
        ),
	));

	acf_register_block_type( array(
		'name'			=> 'people-block',
		'title'			=> __( 'People', 'miles_2020' ),
		'render_template'	=> 'blocks/block-people.php',
		'category'		=> 'common',
		'icon'			=> 'businessman',
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'      => array(
                'align' => array( false ),
                'mode'	=> 'preview'
        ),
		
	));

	acf_register_block_type( array(
		'name'			=> 'location-menu',
		'title'			=> __( 'City menu block', 'miles_2020' ),
		'render_template'	=> 'blocks/block-menu-city.php',
		'category'		=> 'common',
		'icon'			=> 'location-alt',
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'      => array(
                'align' => array( false ),
                'mode'	=> 'auto'
        ),
	));
	 
    acf_register_block_type( array(
		'name'			=> 'aventia-video',
		'title'			=> __( 'Aventia video embed', 'miles_2020' ),
		'render_template'	=> 'blocks/block-aventia-video.php',
		'category'		=> 'embed',
		'icon'			=> 'embed-video',
		'keywords'		=> array( 'profile', 'user', 'author' ),
		'supports'      => array(

                'mode'	=> 'auto'
        ),
	));

}
add_action('acf/init', 'be_register_blocks' );


 
// Adds support for editor font sizes.

add_theme_support( 'editor-font-sizes', array(
	array(
		'name'      => __( 'Small', 'miles_2020' ),
		'shortName' => __( 'S', 'miles_2020' ),
		'size'      => 16,
		'slug'      => 'small'
	),
	array(
		'name'      => __( 'Regular', 'miles_2020' ),
		'shortName' => __( 'M', 'miles_2020' ),
		'size'      => 20,
		'slug'      => 'regular'
	),
	array(
		'name'      => __( 'Large', 'miles_2020' ),
		'shortName' => __( 'L', 'miles_2020' ),
		'size'      => 24,
		'slug'      => 'large'
	),

) );

add_theme_support( 'disable-custom-font-sizes' );

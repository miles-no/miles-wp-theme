<?php
/**
 * Miles 2023 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Miles_2023
 */



if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.9' );
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

#add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

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







function miles_2020_widgets_init() {

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


	/*
		   wp_enqueue_script( 'miles_2020-cvpartner',
							   get_template_directory_uri() . '/js/cvpartner.js',
							   array(),
							   filemtime(get_template_directory() . '/js/cvpartner.js'),
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




/********
Crop and resize images
********/

add_image_size( 'medium', 600, 350, true );

add_image_size( 'hero', 1440, 810, true );
add_image_size( 'hero-mobile', 600, 350, true );
add_image_size( 'feature-image', 1080, 721, true );
add_image_size( 'blog-feature-image', 385, 258, true );

add_image_size( 'medium-gallery', 500, 300, true );



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
 * Adjust font sizes
 */
function adjust_font_sizes( $settings ) {
    if ( isset( $settings['fontSizes'] ) && is_array( $settings['fontSizes'] ) ) {
        foreach ( $settings['fontSizes'] as &$font_size ) {
            if ( 'medium' === $font_size['slug'] ) {
                $font_size['size'] = 18;
            }
			if ( 'large' === $font_size['slug'] ) {
                $font_size['size'] = 20;
            }
        }
    }
    return $settings;
}
add_filter( 'block_editor_settings_all', 'adjust_font_sizes' );



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

//Settings for the "Nyheter" page (archive-miles_nyheter)
function customizer_miles_archive_settings( $wp_customize ) {

    $wp_customize->add_section( 'miles_archive_section', array(
        'title'       => __( 'News settings', 'textdomain' ),
        'priority'    => 30,
    ) );

     // title
     $wp_customize->add_setting( 'miles_archive_title', array(
        'default'           => 'Nyheter',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    // title control
    $wp_customize->add_control( 'miles_archive_title', array(
        'label'    => __( 'Title', 'textdomain' ),
        'section'  => 'miles_archive_section',
        'type'     => 'text',
    ) );

    //description
    $wp_customize->add_setting( 'miles_archive_description', array(
        'default'     => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    // description control
    $wp_customize->add_control( 'miles_archive_description', array(
        'label'       => __( 'Description', 'textdomain' ),
        'section'     => 'miles_archive_section',
        'type'        => 'textarea',
    ) );

}
add_action( 'customize_register', 'customizer_miles_archive_settings' );



 
// Adds support for editor font sizes.

add_theme_support( 'editor-font-sizes', array(
	array(
		'name'      => __( 'Small', 'miles_2020' ),
		'shortName' => __( 'S', 'miles_2020' ),
		'size'      => 16,
		'slug'      => 'small'
	),
	array(
		'name'      => __( 'Medium', 'miles_2020' ),
		'shortName' => __( 'M', 'miles_2020' ),
		'size'      => 18,
		'slug'      => 'medium'
	),
	array(
		'name'      => __( 'Large', 'miles_2020' ),
		'shortName' => __( 'L', 'miles_2020' ),
		'size'      => 20,
		'slug'      => 'large'
	),
) );


add_theme_support( 'disable-custom-font-sizes' );

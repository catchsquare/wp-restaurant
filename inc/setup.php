<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Reef 0.1
 */

if ( ! function_exists( 'wp_restaurant_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wp_restaurant_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Restaurant, use a find and replace
		 * to change 'wp-restaurant' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wp-restaurant', WP_RESTAURANT_TEMPLATE_DIR . '/languages' );
	
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
		
		
		/* Editor style. */
		$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )? '' : '.min';
		add_editor_style( get_theme_file_uri( '/assets/build/css/editor-style' . $min . '.css' ) );
	
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wp_restaurant_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		
		$args = array(    		
	        'default-text-color' => '000',
	        'width'              => 1000,
	        'height'             => 250,
	        'flex-width'         => true,
	        'flex-height'        => true,
		);
		
	    add_theme_support( 'custom-header', $args );
	
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		# Enable support for custom logo.
		add_theme_support( 'custom-logo', array(
			'width'       => 275,
			'height'      => 275,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		add_image_size( 'wp-restaurant-menu-thumbnail', 575, 400, true );
		add_image_size( 'wp-restaurant-menu-home-thumbnail', 200, 200, true );

		add_image_size( 'wp-restaurant-post-image-full', 1200, 500, true );
		add_image_size( 'wp-restaurant-post-image-side', 500, 500, true );

		add_image_size( 'wp-restaurant-logo', 275, 275, true );
	}
endif;
add_action( 'after_setup_theme', 'wp_restaurant_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_restaurant_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_restaurant_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_restaurant_content_width', 0 );
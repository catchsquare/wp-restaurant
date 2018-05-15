<?php
/**
 * WP Restaurant Scripts
 * 
 */
if ( ! function_exists( 'wp_restaurant_scripts' ) ) :
	/**
	 * wp_restaurant_scripts
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_scripts() {
		$min = '';
		if( defined( 'SCRIPT_DEBUG') && SCRIPT_DEBUG  ) {
			$min = '.min';
		}

		# Styles
		# use get_theme_file_uri(). So that child theme can overwrite it.
		# @link  https://developer.wordpress.org/reference/functions/get_theme_file_uri/

		wp_enqueue_style( 'wp-restaurant-google-fonts', esc_url( '//fonts.googleapis.com/css?family=Dancing+Script:400,700|Ubuntu:300,400,800|Roboto:300,700' ) );	
		
		wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/build/vendors/font-awesome/font-awesome' . $min . '.css' ), NULL, '4.7.0' );	

		wp_enqueue_style( 'wp-restaurant-style', WP_RESTAURANT_STYLESHEET_URI, array( 'wp-restaurant-google-fonts' , 'font-awesome' ), WP_RESTAURANT_VER );

		wp_enqueue_style( 'wp-restaurant-style-custom', get_theme_file_uri( '/assets/build/css/main' . $min . '.css' ), array('wp-restaurant-style'), WP_RESTAURANT_VER );
	
		# Scripts
		wp_enqueue_script( 'wp-restaurant-main', get_theme_file_uri( '/assets/build/js/main-scripts' . $min . '.js' ), array( 'jquery' ), WP_RESTAURANT_VER, true );

		wp_localize_script( 'wp-restaurant-main',
							'WP_RESTAURANT',
							array(
								'menu_heading_image' => wp_restaurant_option( 'menu-item-heading-image', esc_url( get_theme_file_uri( '/assets/build/images/contact-image.jpg' ) ) )
							)
							);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'wp_restaurant_scripts' );


if( ! function_exists( 'wp_restaurant_admin_scripts' ) ) :
	/**
	 * wp_restaurant_admin_scripts function
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_admin_scripts( $hook ) {
		global $post_type;
    	if( 'nova_menu_item' == $post_type ){
			return;
		}
		
		if( 'post-new.php' == $hook || 'post.php' == $hook ) {
			wp_enqueue_style( 'wp-restaurant-admin-style', get_theme_file_uri( '/assets/build/css/admin.css' ), WP_RESTAURANT_VER );
		}

	}
endif;
add_action( 'admin_enqueue_scripts', 'wp_restaurant_admin_scripts', 10, 1 );
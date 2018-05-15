<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Restaurant
 */

 if ( ! function_exists( 'wp_restaurant_body_classes' ) ) :
	/**
	 * wp_restaurant_body_classes
	 * Adds custom classes to the array of body classes.
	 *
	 * @since WP Restaurant 1.0.0
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function wp_restaurant_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
endif;	
add_filter( 'body_class', 'wp_restaurant_body_classes' );

if ( ! function_exists( 'wp_restaurant_pingback_header' ) ) :
	/**
	 * wp_restaurant_pingback_header
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
endif;
add_action( 'wp_head', 'wp_restaurant_pingback_header' );

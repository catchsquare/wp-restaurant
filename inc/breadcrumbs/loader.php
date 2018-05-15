<?php
/**
* WP Restaurant breadcrumb.
*
* @since WP Restaurant 1.0
* @uses breadcrumb_trail()
*/
require get_parent_theme_file_path( '/inc/breadcrumbs/breadcrumbs.php' );
if ( ! function_exists( 'wp_restaurant_breadcrumb' ) ) :

	function wp_restaurant_breadcrumb() {

		$breadcrumb_args = apply_filters( 'wp_restaurant_breadcrumb_args', array(
			'show_browse' => false,
		) );

		breadcrumb_trail( $breadcrumb_args );
	}

endif;
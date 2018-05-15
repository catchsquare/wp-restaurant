<?php
/**
 * Recommended plugins.
 *
 * @package Restaurant
 */

if ( ! function_exists( 'wp_restaurant_activate_recommended_plugins' ) ) :
/**
 * Register recommended plugins.
 *
 * @since 1.0.0
 */
function wp_restaurant_activate_recommended_plugins() {

	$plugins = array(		
		array(
			'name'     => __( 'Jetpack', 'wp-restaurant' ),
			'slug'     => 'jetpack',
			'required' => false,
		),		
	);

	$config = array();

	tgmpa( $plugins, $config );

}
endif;
add_action( 'tgmpa_register', 'wp_restaurant_activate_recommended_plugins' );

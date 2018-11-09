<?php
/**
 * WP Restaurant Menu
 * 
 */
if ( ! function_exists('wp_restaurant_register_menu_setup') ) :
/**
 * wp_restaurant_register_menu_setup
 *
 * @since WP Restaurant 1.0.0
 * @return void
 */
 function wp_restaurant_register_menu_setup(){
 	 /*This theme uses wp_nav_menu() in one location.*/
 	 $menus = apply_filters( 
 	 						'wp_restaurant_register_menu',
 	 						array(
								'left-menu' => esc_html__( 'Left Menu', 'wp-restaurant' ),
								'right-menu' => esc_html__( 'Righ Menu', 'wp-restaurant' )								
							) 
						);
	register_nav_menus( $menus );
 }

add_action( 'after_setup_theme', 'wp_restaurant_register_menu_setup',11 );

endif;
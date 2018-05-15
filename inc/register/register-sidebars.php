<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

if ( ! function_exists( 'wp_restaurant_widgets_init' ) ) :
	
	/**
	 * wp_restaurant_widgets_init
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'wp-restaurant' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wp-restaurant' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		/**
		* Creates a footer sidebar
		*/

		register_sidebar( array(
			'name'          => __( 'Footer 1', 'wp-restaurant' ),
			'id'            => 'restaurant-footer-1',
			'description'   => esc_html__( 'Footer Sidebar 1', 'wp-restaurant' ),
			'before_widget' => '<div id="%1s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 2', 'wp-restaurant' ),
			'id'            => 'restaurant-footer-2',
			'description'   => esc_html__( 'Footer Sidebar 2', 'wp-restaurant' ),
			'before_widget' => '<div id="%1s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 3', 'wp-restaurant' ),
			'id'            => 'restaurant-footer-3',
			'description'   => esc_html__( 'Footer Sidebar 3', 'wp-restaurant' ),
			'before_widget' => '<div id="%1s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		) );
		
	}
endif;
add_action( 'widgets_init', 'wp_restaurant_widgets_init' );
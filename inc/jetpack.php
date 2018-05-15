<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Restaurant
 */
if ( ! function_exists( 'wp_restaurant_jetpack_setup' ) ) :

	/**
	 * wp_restaurant_jetpack_setup
	 * Jetpack setup function.
	 * 
	 * See: https://jetpack.com/support/infinite-scroll/
	 * See: https://jetpack.com/support/responsive-videos/
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_jetpack_setup() {
		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'wp_restaurant_infinite_scroll_render',
			'footer'    => 'page',
		) );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );

		// Add support for the Nova CPT (menu items).
		add_theme_support( 'nova_menu_item' );

	}
endif;
add_action( 'after_setup_theme', 'wp_restaurant_jetpack_setup' );

if ( ! function_exists( 'wp_restaurant_infinite_scroll_render' ) ) :
	
	/**
	 * wp_restaurant_infinite_scroll_render
	 * Custom render function for Infinite Scroll.
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	 function wp_restaurant_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			if ( is_search() ) :
				get_template_part( 'template-parts/content', 'search' );
			else :
				get_template_part( 'template-parts/content', get_post_format() );
			endif;
		}
	}
endif;


add_filter('jetpack_nova_menu_item_loop_close_element', 'wp_restaurant_jetpack_menu_item_loop_close_element', 	10, 4 );


if ( !function_exists( 'wp_restaurant_jetpack_menu_item_loop_close_element' ) ):	
	
	/**
	 * wp_restaurant_jetpack_menu_item_loop_close_element
	 * Custom render function for menu item loop
	 *
	 * @since WP Restaurant 1.0.0
	 * @param string $tag_close
	 * @param array $field
	 * @param mixed $markup
	 * @param mixed $term
	 * @return string $tag_close
	 */
	function wp_restaurant_jetpack_menu_item_loop_close_element( $tag_close, $field, $markup, $term ) {	
		if( 'header' ==  $markup[$field.'_tag' ] ) {
			$tag_close .= '<div class="collection-menu-items">';
		} else if(  'section' == $markup[$field.'_tag' ] ){
			$tag_close = '</div>'.$tag_close;		
		}
		return $tag_close;	
	}
endif;
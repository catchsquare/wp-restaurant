<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Restaurant
 * @since WP Restaurant 1.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

$side_settings = wp_restaurant_option( 'sidebar_settings', 'no-sidebar' );
if( is_singular( 'post' ) ||  is_singular( 'page' ) ) {
	global $post;
	$restaurant_single_sidebar_layout_meta = get_post_meta( $post->ID, 'restaurant-default-layout', true );
	if( false != $restaurant_single_sidebar_layout_meta ){
		$side_settings = $restaurant_single_sidebar_layout_meta;
	}
}

$classname = array();
if ( 'no-sidebar' != $side_settings ) {
	?>
	<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->
	<?php				
}

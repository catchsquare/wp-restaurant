<?php
/**
 * WP Restaurant Theme Customizer.
 *
 * @package WP Restaurant 1.0
 */

if ( ! function_exists( 'wp_restaurant_customize_register' ) ) :

	/**
	 * wp_restaurant_customize_register
	 * Add postMessage support for site title and description for the Theme Customizer. 
	 *
	 * @since WP Restaurant 1.0.0
	 * @param  WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @return void
	 */
	function wp_restaurant_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';			
	}
endif;
add_action( 'customize_register', 'wp_restaurant_customize_register' );


function wp_restaurant_defaults() {
	$background_color 	= wp_restaurant_option( 'background_color' );
	$background_image 	= wp_restaurant_option( 'background_image' );
	$header_color 		= wp_restaurant_option( 'header_textcolor' , 'fff' );
	?>
	<style type="text/css">
		<?php if ( $background_color ): ?>
		body.custom-background{
			background-color: #<?php echo esc_attr( $background_color )?>;
		}	
		<?php endif; ?>

		<?php if ( $header_color ): ?>
		.steak-house-texts .steak-house-text-on-image,
		.steak-house-texts .steak-house-text-description,
		
		.steak-house-navigation li a {
			color: #<?php echo esc_attr( $header_color )?>;
		}	
		<?php endif; ?>
	</style>
	<?php
}
add_action( 'wp_head', 'wp_restaurant_defaults' );
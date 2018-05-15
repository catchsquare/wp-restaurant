<?php
/**
 * Sets callback for contact
 */
if ( ! function_exists( 'wp_restaurant_banner_option' ) ):
	/**
	 * wp_restaurant_banner_option
	 *
	 * @param mixed $control
	 * @return bool
	 */
	function wp_restaurant_banner_option( $control ) {
		$restaurant_banner_option = $control->manager->get_setting( 'home_banner_option' )->value();
		$control_field = $control->id;
		switch ( $restaurant_banner_option) {
			case 'video':
				if( 'home_banner_video' == $control_field || 'home_banner_video_title' == $control_field  ) {
					return TRUE;
				}
				break;
			
			case 'image':
				if( 'home_banner_image' == $control_field ||  'home_banner_title' == $control_field  ) {
						return TRUE;
				}
				break;
		}

		return FALSE;
	}
	
endif;
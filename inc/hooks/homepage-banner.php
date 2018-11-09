<?php
/**
 *  WP Restaurant  banner
 */
if ( ! function_exists( 'wp_restaurant_banner_content' ) ) : 

	/**
	 * wp_restaurant_banner_content
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	*/
	function wp_restaurant_banner_content() {
				
		$home_banner_image_option 		= wp_restaurant_option( 'home_banner_image_option', absint( 0 ) );	
		
		if ( !$home_banner_image_option ) {
			return;
		}
		
		$home_banner_image 				= wp_restaurant_option( 'home_banner_image' );	
		
		$home_site_welcome 				= wp_restaurant_option( 'welcome_text', esc_html__( 'Welcome To', 'wp-restaurant' ) );	
		
		
		$home_site_title 				= get_bloginfo( 'name', 'display'  );
		$home_site_desc 				= get_bloginfo( 'description', 'display'  );		
		$home_show_title 				= wp_restaurant_option( 'show-title' );
		$home_show_tagline 				= wp_restaurant_option( 'show-tagline' );

		$home_contact_reservation 		= wp_restaurant_option( 'home_contact_reservation' );
		$home_contact_page_id 			= wp_restaurant_option( 'home_contact_page_id' );

		$home_contact_us_label 			= wp_restaurant_option( 'home_contact_us_label', esc_html__( 'Contact Us', 'wp-restaurant' ) );
		$home_contact_reservation_label = wp_restaurant_option( 'home_contact_reservation_label', esc_html__( 'Book a Reservation', 'wp-restaurant' ) );


		?>
		<!-- Banner Images with Fixed position Start-->
		<div class="img-banner" style="background-image: url( <?php echo esc_url( $home_banner_image );?> ); background-size: cover;" >
			<?php if( '' != $home_site_title ): ?>
			
				<div class="steak-house-texts">
					<?php if( absint(1) == $home_show_title ): ?>
						<h2 class="steak-house-text-on-image"><?php echo esc_html( $home_site_welcome );?></h2><br />					
						<h1 class="steak-house-text-on-image logo"><?php echo esc_html( $home_site_title );?></h1><br />
					<?php endif;?>

					<?php if( absint(1) == $home_show_tagline ): ?>
						<h3 class="steak-house-text-description site-description"><?php echo esc_html( $home_site_desc );?></h3><br />
					<?php endif;?>
					
					<div class="steak-house-banner-button">
						<?php if ( '' != $home_contact_reservation ): ?>
							<?php if( defined( 'POLYLANG_FILE' ) ) : ?>
							<?php $home_contact_reservation = pll_get_post( $home_contact_reservation, pll_current_language() );?>
							<?php endif;?>
							<a href="<?php echo esc_url( get_the_permalink( $home_contact_reservation ) );?>" class="btn-fill reservation_label"><?php echo esc_html( $home_contact_reservation_label );?></a>
						<?php endif;?>

						<?php if ( '' != $home_contact_page_id ): ?>
						<?php if( defined( 'POLYLANG_FILE' ) ) : ?>
							<?php $home_contact_page_id = pll_get_post( $home_contact_page_id, pll_current_language() );?>
							<?php endif;?>
							<a href="<?php echo esc_url( get_the_permalink( $home_contact_page_id ) );?>" class="btn-fill contact_us_label"><?php echo esc_html( $home_contact_us_label );?></a>
						<?php endif;?>						
					</div>
				
				</div>
			<?php endif; ?>
		</div>
		<!-- Banner Images with Fixed position End--> 
		<?php
	}
endif;
	
add_action( 'wp_restaurant_banner_content', 'wp_restaurant_banner_content', 10 );

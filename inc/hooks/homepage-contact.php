<?php
/**
 *  WP Restaurant  Contact
 */
if ( ! function_exists( 'wp_restaurant_contact_section') ) :
	/**
	 * wp_restaurant_contact_section 
	 * 
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_contact_section() {
		
		$show_contact_in_front 		= wp_restaurant_option( 'show_contact_in_front' ,absint( 0 ) );
		if ( !$show_contact_in_front ) {
			return;
		}
		$home_contact_address 			= wp_restaurant_option( 'contact_setting_address' );
		$contact_setting_phone 			= wp_restaurant_option( 'contact_setting_phone' );
		$contact_setting_email 			= wp_restaurant_option( 'contact_setting_email' );
		$home_contact_opening_time 		= wp_restaurant_option( 'home_contact_opening_time' );

		if ( '' == $home_contact_address && '' == $contact_setting_phone && '' == $contact_setting_email && '' == $home_contact_opening_time ) {
			?>
			<div class="full-width">
				<div class="steak-house-home-contact">
				<p class="steak-house-no-contact">
				<?php 
				/* translators: 1: break tag */
				printf( esc_html__( 'Contact information are empty. You need to add your contact information %s Customizer->Contact Information', 'wp-restaurant' ) , '<br />');
				?>
				</p>
				</div>
			</div>
			<?php
		} else {
		?>
			<div class="full-width">
				<div class="steak-house-home-contact">
					<?php if ( '' != $home_contact_address ): ?>
						<div class="find-us">
							<img src="<?php echo esc_url( WP_RESTAURANT_TEMPLATE_DIR_URI.'/assets/build/images/cs-location.png' );?>" />
							<p><?php esc_html_e('Find Us','wp-restaurant');?></p>
							<div class="steak-house-home-contact-division steak-house-contact-address">							
								<p><?php echo $home_contact_address;?></p>
							</div>
						</div>
					<?php endif;?>

					<?php if ( '' != $home_contact_opening_time ): ?>
					<div class="opening-time">
						<img src="<?php echo esc_url( WP_RESTAURANT_TEMPLATE_DIR_URI.'/assets/build/images/cs-opening.png' );?>" />
						<div class="steak-house-home-contact-division steak-house-opening-time">
							<?php echo $home_contact_opening_time;?>
						</div>
					</div>
					<?php endif;?>
				<?php if( '' != $contact_setting_phone || '' != $contact_setting_email ): ?>	
					<div class="location">
						<?php if( '' != $contact_setting_phone ): ?>	
						<img src="<?php echo esc_url( WP_RESTAURANT_TEMPLATE_DIR_URI.'/assets/build/images/cs-contact.png' );?>" />
						<div class="steak-house-contact-phone">
							<a href="tel:<?php echo esc_attr( $contact_setting_phone );?>"><?php echo esc_html( $contact_setting_phone );?></a>
						</div>
						<?php endif;?>

						<?php if( '' != $contact_setting_email ): ?>
						<div class="steak-house-contact-email">
							<a href="mailto:<?php echo esc_attr( $contact_setting_email );?>"><?php echo esc_html( $contact_setting_email );?></a>
						</div>
						<?php endif;?>
					</div>
				<?php endif;?>

			</div>
				
			</div>
		<?php
		}
	}
	
endif;

add_action( 'wp_restaurant_contact_section', 'wp_restaurant_contact_section', 10 );
<?php
/**
 *  WP Restaurant  menu banner
 */
if ( ! function_exists( 'wp_restaurant_menu_banner_section') ) :
	/**
	 * wp_restaurant_menu_banner_section 
	 * 
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_menu_banner_section() {		
		
		if ( ! class_exists( 'Jetpack' ) ) {
			return;
		}

		if ( ! class_exists( 'Nova_Restaurant' ) ) {
			return;
		}
		$home_menu_banner_option 		= wp_restaurant_option( 'home_menu_banner_option',  absint( 0 ) );

		if ( !$home_menu_banner_option ) {
			return;
		}

		$home_menu_banner_background_image 	= wp_restaurant_option( 'home_menu_banner_background_image' );
		$home_menu_banner_head_title 		= wp_restaurant_option( 'home_menu_banner_head_title', esc_html__( 'Prepare the best dishes', 'wp-restaurant' ) );
		$home_menu_banner_main_title 		= wp_restaurant_option( 'home_menu_banner_main_title', esc_html__( 'Our Restaurant And the Food They Serve their Guests', 'wp-restaurant' ) );
		$home_menu_banner_link_label 		= wp_restaurant_option( 'home_menu_banner_link_label',  esc_html__( 'View More', 'wp-restaurant' ) );
		$term_link 							= wp_restaurant_get_menu_page_template_link();
		?>
			
		<section class="home-menu-banner" style="background-image: url( <?php echo esc_url( $home_menu_banner_background_image );?> );background-size: cover;background-position: 50% 50%;">
			<div class="overlay-banner ">
				<div class="title-subtitle">		
					<?php if ( '' != $home_menu_banner_head_title  ) : ?>
					<div class="title-main-section"><?php echo esc_html( $home_menu_banner_head_title );?></div>
					<?php endif;?>
					<?php if ( '' != $home_menu_banner_main_title ) : ?>
					<div class="title-sub-section"><?php echo esc_html( $home_menu_banner_main_title );?></div>
					<?php endif;?>

					<?php if ( $term_link &&'' != $home_menu_banner_link_label ) : ?>
						<a class="btn-transparent home-menu-banner-view-more" href="<?php echo esc_url( get_permalink( $term_link ) );?>"><?php echo esc_html( $home_menu_banner_link_label );?></a>
					<?php endif;?>
				</div>
			</div>
		</section>

		<?php
	}
	
endif;

add_action( 'wp_restaurant_menu_banner_section', 'wp_restaurant_menu_banner_section', 10 );
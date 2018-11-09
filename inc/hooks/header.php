<?php
/**
 *  WP Restaurant  header
 */
if( ! function_exists( 'wp_restaurant_header' ) ):
	/**
	 * wp_restaurant_header
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_header(){		
		?>
			<header class="cs-header">

				<div class="steak-house-top-head">

					<div class="steak-house-container">					

						<div class="steak-house-top-nav">
							<?php 
								wp_nav_menu( apply_filters(
										'wp_restaurant_left_menu',
										array(
											'theme_location' 	=> 'left-menu', 
											'container' 		=> 'div',
											'menu_id'			=> 'menu-left-menu',
											'container_class'	=> 'steak-house-navigation alignleft',
											'fallback_cb'		=> 'wp_restaurant_menu_left_fallback',
										)
									)
								); 
							?>
							<span class="steak-house-menu-dot"></span>								
							<?php 									
								wp_nav_menu( apply_filters(
										'wp_restaurant_right_menu',
										array(
											'theme_location' 	=> 'right-menu', 
											'container' 		=> 'div',
											'menu_id'			=> 'menu-right-menu',											
											'container_class'	=> 'steak-house-navigation alignright',
											'fallback_cb'		=> 'wp_restaurant_menu_right_fallback'
										)
									)
								); 
							?>
						<div class="clear"></div>
						</div>
						<div class="cs-col">
							<div id="cs-resmenu">
								<div class="bar top"></div>
								<div class="bar middle"></div>
								<div class="bar bottom"></div>
							</div>

							<div class="clear"></div>
								<div id="cs-navigation">
									<?php 
										wp_nav_menu( apply_filters( 
												'wp_restaurant_left_menu', 
												array(
													'theme_location' 	=> 'left-menu', 
													'container' 		=> 'div',
													'container_class'	=> 'cs-res-navigation',
													'fallback_cb'		=> 'wp_restaurant_menu_left_fallback'
												) 
											) 
										); 																		
										wp_nav_menu( apply_filters(
												'wp_restaurant_right_menu',
												array(
													'theme_location' 	=> 'right-menu', 
													'container' 		=> 'div',
													'container_class'	=> 'cs-res-navigation',
													'fallback_cb'		=> 'wp_restaurant_menu_right_fallback'
												)
											)
										); 
									?>
								</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>

					</div>

		        </div>


		        <div class="steak-house-logo">
				<?php 
					$site_logo = wp_restaurant_option( 'custom_logo', esc_url( WP_RESTAURANT_TEMPLATE_DIR_URI.'assets/build/images/cs-logo.png' ) ); 
					
					if( is_numeric( $site_logo ) ) :
						$image_tag = wp_get_attachment_image( absint( $site_logo ), 'wp-restaurant-logo' );
						echo $image_tag;
					else:
						
							echo wpautop( get_bloginfo( 'name', 'display'  ) );
						?>
						<?php		
					endif;	
				
				?>
		        </div>

			</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'wp_restaurant_action_header', 'wp_restaurant_header', 10 );

if ( ! function_exists( 'wp_restaurant_blog_content_start' ) ) :
	/**
	 * wp_restaurant_blog_content_start
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_blog_content_start(){
		
		$sidebar_settings = wp_restaurant_option( 'sidebar_settings', 'no-sidebar' );
		$classname = array();
		
		if ( 'no-sidebar' != $sidebar_settings ) {				
			$classname[] = $sidebar_settings;
		}

		if( is_singular( 'post' ) ||  is_singular( 'page' ) ) {
			global $post;
			$restaurant_single_sidebar_layout_meta = get_post_meta( $post->ID, 'restaurant-default-layout', true );
			if( false != $restaurant_single_sidebar_layout_meta ){
				$sidebar_settings = $restaurant_single_sidebar_layout_meta;
			}
			$classname[] = $sidebar_settings;
		}
		
		if ( !is_page_template('templates/menu-page.php') && !is_front_page() && !is_page_template('templates/tpl-contactpage.php') ) { ?>
			<div class="blog-content <?php echo esc_attr( implode( ' ', $classname ) );?> ">
		<?php }
	}

endif;

add_action('wp_restaurant_blog_content_start', 'wp_restaurant_blog_content_start' );
<?php
/**
 *  WP Restaurant  menu items
 */
if ( ! function_exists( 'wp_restaurant_menu_section') ) :
	/**
	 * wp_restaurant_menu_section 
	 * 
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_menu_section() {
		$home_menu_option 		= wp_restaurant_option( 'home_menu_option',  absint( 0 ) );
		if ( !$home_menu_option ) {
			return;
		}

		if ( ! class_exists( 'Jetpack' ) ) {
			return;
		}

		if ( ! class_exists( 'Nova_Restaurant' ) ) {
			return;
		}
		$home_menu_title 			= wp_restaurant_option( 'home_menu_title' );
		$home_menu_subtitle 		= wp_restaurant_option( 'home_menu_subtitle' );
		$home_menu_category 		= wp_restaurant_option( 'home_menu_category' );
		$home_menu_view_more_label 	= wp_restaurant_option( 'home_menu_view_more_label', esc_html__( 'View More','wp-restaurant' ) );
		
		$link = wp_restaurant_get_menu_page_template_link();
		$menu_args = array( 
			'post_type' => 'nova_menu_item',			
			'posts_per_page' => 4, 
			'post_status' => 'publish',
		);
		$menu_args = wp_parse_args( 
						apply_filters(
							'wp_restaurant_menu_item_args', 
							array()  
						),
						$menu_args
					);
		$menu_loop = get_posts( $menu_args );		
		if( count( $menu_loop ) <= 0 ) {
			?>
			<div class="home-no-menu-items-list">			
				<p><?php esc_html_e( 'Menu section is empty. Add some Menu items first, to view the detail design', 'wp-restaurant' );?></p>
			</div>
			<?php
			return;
		}		
		?>
		<div class="home-menu-items-list">
			<div class="steak-house-menu-title-list">
				<?php if ( '' != $home_menu_title ) : ?>
				<div class="title-main-section"><?php echo esc_html( $home_menu_title );?></div>
				<?php endif;?>
				<?php if ( '' != $home_menu_subtitle ) : ?>
				<div class="title-sub-section"><?php echo esc_html( $home_menu_subtitle );?></div>
				<?php endif;?>
			</div>
			<div class="clear"></div>
			<?php if( $link ):?>
			<a href="<?php echo esc_url( get_permalink( $link ) ) ;?>" class="btn-transparent steak-house-home-view-more"><?php echo esc_html( $home_menu_view_more_label );?></a>
			<div class="clear"></div>
			<?php endif;?>
			<section class="menu-items">
			<div class="collection-menu-items">
				<?php $menu_count = 1;
					foreach( $menu_loop as $post ):
						$menu_classes = get_post_class( array( 'menu-item' ) );						
					?>
						<article id="post-<?php echo $post->ID; ?>" <?php post_class( 'menu-item' );?> >
							<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
								<?php 
									$image_size = 'wp-restaurant-menu-home-thumbnail';
									if( is_home() || is_front_page() ) :
										$image_size = '';
									endif;
									$image_url = get_the_post_thumbnail_url( $post->ID, $image_size ); 
								?>
								<div class="menu-home-thumbnail" style="background-image: url('<?php echo esc_url( $image_url );?>');"> </div>
								<div class="menu-title">
									<h3 class="entry-title"><?php echo $post->post_title; ?></h3>
									
									<?php
										$terms = wp_get_object_terms( $post->ID, 'nova_menu_item_label' );
										if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
									?>
									<span class="menu-labels">
										<?php
											foreach ( $terms as $term ) {						
												printf( '<span class="%s">%s</span>', esc_attr( $term->slug ), esc_attr( $term->name ) );
											}
										?>
									</span>
									<?php endif; ?>	
								</div>
							<?php endif; ?>
						</article><!-- #post-<?php echo $post->ID; ?> -->
					<?php
					if( $menu_count >= $menu_args['posts_per_page'] ) {
						break;
					}
					$menu_count++;
					endforeach; /* End of the Menu Item Loop. */
					wp_reset_postdata();
				?>
			</div>
			</section>
		</div>
		<?php
	}
	
endif;

add_action( 'wp_restaurant_menu_section', 'wp_restaurant_menu_section', 10 );
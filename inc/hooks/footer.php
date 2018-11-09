<?php
/**
 * WP Restaurant footer section
 */
if ( ! function_exists( 'wp_restaurant_blog_content_end' ) ) :
	/**
	 * wp_restaurant_blog_content_end
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_blog_content_end() {
		$sidebar_settings = wp_restaurant_option( 'sidebar-settings' , 'no-sidebar' ); 
		$classname = array();		
		if ( 'no-sidebar' != $sidebar_settings ) {				
			$classname[] = $sidebar_settings;
		}
		
		if ( !is_page_template('templates/menu-page.php') && !is_front_page() && !is_page_template('templates/tpl-contactpage.php') ) { ?>
		</div><?php
		}
	}
endif;
add_action('wp_restaurant_blog_content_end', 'wp_restaurant_blog_content_end' );

if ( ! function_exists( 'wp_restaurant_footer_sidebar' ) ) :
	
	/**
	 * wp_restaurant_footer_sidebar
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_footer_sidebar(){
		$footer_sidebar_number = wp_restaurant_option( 'footer_sidebar_number' , absint( 3 ) ); 
		
		?>
		<div class="foot">
		<?php for( $i = 1; $i <= $footer_sidebar_number; $i++){?>
			<?php if ( is_dynamic_sidebar( 'restaurant-footer-'.$i ) ) : ?>
				<div class="container cs-column-<?php echo esc_attr( $footer_sidebar_number );?>">
						<?php dynamic_sidebar( 'restaurant-footer-'.$i ); ?>
				</div>
			<?php endif;?>
		<?php } ?>
		<div class="clear"></div>
				
		</div>
		<?php
	}	
endif;

add_action( 'wp_restaurant_footer_sidebar', 'wp_restaurant_footer_sidebar', 10 );


if ( ! function_exists( 'wp_restaurant_footer_text' ) ) :

	/**
	 * wp_restaurant_footer_text
	 *
	 * @since WP Restaurant 1.0.0
	 * @return void
	 */
	function wp_restaurant_footer_text(){				
		$footer_text = wp_restaurant_option( 'footer_text' , esc_html__( '&copy; All Right Reserved.', 'wp-restaurant' ) ); 
		$footer_enable_text = wp_restaurant_option( 'footer_enable_theme_development_text' ); 		
	?>
	
	<div class="footer-information" >
		<div class="footer-wrapper">	
			<?php if( '' != $footer_text ) : ?>
				<span class="copyright-text alignleft"><?php echo esc_html( $footer_text );?></span>
			<?php endif; 
			 /* translators: 1: url, 2: label */		
			$catchsquare = sprintf('<a target="_blank" href="%s" >%s</a>', esc_url('http://catchsquarethemes.com'), esc_html__( 'Catchsquare Themes','wp-restaurant' ) );
			?>
			<span class="credit alignright">
				<?php 
				/* translators: 1: label */	
				printf( esc_html__( 'Designed & Developed by:','wp-restaurant' ).' %s',  $catchsquare );	
				?>
			</span>
			<div class="clear"></div>
		</div>			
	</div>	
	<?php
	}

endif;

add_action( 'wp_restaurant_footer_text', 'wp_restaurant_footer_text', 10 );
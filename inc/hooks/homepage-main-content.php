<?php
/**
 *  WP Restaurant  main content
 */
if ( ! function_exists( 'wp_restaurant_main_content' ) ) :
/**
 * Featured Banner Content 
 *
 * @since WP Restaurant 1.0.0
 * @return void
 *
 */ 
function wp_restaurant_main_content(){
	$home_page_option 			= wp_restaurant_option( 'home_page_option', absint( 0 )  );
	if ( !$home_page_option ) {
		return;
	}
	$home_page_content 			= wp_restaurant_option( 'home_page_content' );
	$home_contact_reservation 	= wp_restaurant_option( 'home_contact_reservation' );

	$home_contact_reservation_label 		= wp_restaurant_option( 'home_contact_reservation_label',esc_html__( 'Book a Reservation', 'wp-restaurant' )  );

  	if( '' != $home_page_content && is_numeric( $home_page_content ) ) : 

  		$home_page_content_args = apply_filters( 
  											'home_page_content_args',
  											 wp_parse_args( 
  											 	array(
  											 		'post_status' => 'publish',
  											 	), 
  											 	array(
  														'page_id' => $home_page_content,
												) 
  											)
  										) ;
  		$home_page_content = new WP_Query( $home_page_content_args );
  		if( $home_page_content->have_posts() ):
  			while( $home_page_content->have_posts() ) : $home_page_content->the_post();
  		?>
	 	<div class="steak-house-body-wrapper">
		 	<div class="steak-house-body-container">
		 		<div class="steak-house-intro alignleft <?php echo ( ! has_post_thumbnail( ) ) ? 'steak-full-content': '';?>">
		 			<div class="title-section">			 			
			 			<h2 class="main-title"><?php the_title();?></h2>
		 			</div>

		 			<div class="steak-house-trim-about">						
		 				<?php the_content();?>
						<?php if ( '' != $home_contact_reservation ): ?>
						<div class="steak-house-banner-button">
							<a href="<?php the_permalink( esc_url( $home_contact_reservation ) );?>" class="btn-transparent reservation_label"><?php echo esc_html( $home_contact_reservation_label );?></a>
						</div>
						<?php endif;?>
					 </div>
		 		</div>
		 		<?php if( has_post_thumbnail( ) ): ?>
		 		<div class="steak-house-intro-image alignright">
		 			<?php the_post_thumbnail( ); ?>  
		 		</div>
			 	<?php endif;?>
		 		<div class="clear"></div>		 		
		 	</div>
	 	</div>
 		<?php endwhile;?>
 		<?php endif;?>
 <?php endif;
}
	
endif;

add_action( 'wp_restaurant_main_content', 'wp_restaurant_main_content', 10 );
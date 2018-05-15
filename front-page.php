<?php
/**
 * Home page file
 *
 * This is the home page generic template file in a WordPress theme
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Restaurant
 */

get_header(); ?>

<?php 
	$home_banner_image_option 	= wp_restaurant_option( 'home_banner_image_option', absint( 0 ) );	
	$home_page_option 			= wp_restaurant_option( 'home_page_option', absint( 0 )  );
	$show_contact_in_front 		= wp_restaurant_option( 'show_contact_in_front' ,absint( 0 ) );

	if ( 0 == $home_banner_image_option || 0 == $home_page_option ) { 
			if ( 'posts' == get_option( 'show_on_front' ) ) {
			    include( get_home_template() );
			} else {
				do_action( 'wp_restaurant_no_section_added' );		
			} 
	} else {
		if ( 'posts' == get_option( 'show_on_front' ) ) {
		    include( get_home_template() );
		} else {
	 ?>
	
<div class="steak-house-full-width">

<!-- Restarurant Banner Start -->
	<?php do_action( 'wp_restaurant_banner_content' ); ?>
<!-- Restaurant Banner Ends  -->

<!-- About Us Trim Part Begin -->
	<?php do_action( 'wp_restaurant_main_content' ); ?>
<!-- About Us Trim Part End -->

<!-- Menu section begins -->
	<?php do_action( 'wp_restaurant_menu_section' ); ?>
<!-- Menu section End  -->

<!-- Menu Banner section begins -->
	<?php do_action( 'wp_restaurant_menu_banner_section' ); ?>
<!-- Menu Banner section End  -->
</div>

<!-- Contact Portion Start -->
<?php do_action( 'wp_restaurant_contact_section' ); ?>
<!-- Contact Portion Ends -->
<?php } } ?>

<?php get_footer( );
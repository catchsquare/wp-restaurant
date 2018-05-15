<?php
/**
 *  WP Restaurant generic image 
 */
if ( ! function_exists( 'wp_restaurant_action_generic_image' ) ) :
   /**
    * wp_restaurant_action_generic_image
    *
    * @since WP Restaurant 1.0.0    
    * @return void
    */
    function wp_restaurant_action_generic_image() {
                       
        $generic_image = wp_restaurant_option( 'generic_image' , esc_url( WP_RESTAURANT_TEMPLATE_DIR_URI . 'assets/build/images/1024x500.jpg' ) );
        if ( (!is_front_page() || 'posts' == get_option( 'show_on_front')) &&  $generic_image ) : 
        ?>
        	<div class="generic-background-image" style="background-image:url(<?php echo esc_url( $generic_image );?>);">
            </div>
        <?php
        endif;
        /**
         * Breadcrumb
         */
        if( !is_front_page() ){
            wp_restaurant_breadcrumb();
        }
    }
endif;

add_action( 'wp_restaurant_generic_image', 'wp_restaurant_action_generic_image' );
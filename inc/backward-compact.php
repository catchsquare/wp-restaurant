<?php
/**
 * WP Restaurant  Theme backward compatibility functionalities
 *
 * Prevents WP Restaurant Theme from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond 4.7 and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @since WP Restaurant 1.0.0
 */

if ( ! function_exists( 'wp_restaurant_switch_theme' ) ) :

    /**
     * wp_restaurant_switch_theme function
     * 
     * Prevent switching to WP Restaurant on old versions of WordPress.
     * Switches to the default theme.
     *
     * @since WP Restaurant 1.0.0
     * @return void
     */
    function wp_restaurant_switch_theme() {
        switch_theme( WP_DEFAULT_THEME );
        unset( $_GET['activated'] );
        add_action( 'admin_notices', 'wp_restaurant_upgrade_notice' );
    }

endif;
add_action( 'after_switch_theme', 'wp_restaurant_switch_theme' );

if ( ! function_exists( 'wp_restaurant_upgrade_notice' ) ) :

    /**
     * wp_restaurant_upgrade_notice function
     * 
     * Adding a message for unsuccessful theme switch.
     * Prints an update msg after an unsuccessful attempt to switch to
     * WP Restaurant on WordPress versions prior to 4.7.
     *
     * @since WP Restaurant 1.0.0
     * @return string $wp_version WordPress version.
     */

    function wp_restaurant_upgrade_notice() {
        /* translators: 1: WordPress version */	        
        $message = sprintf( esc_html__( 'WP Restaurant Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wp-restaurant' ), esc_html( $GLOBALS['wp_version'] ) );
	    printf( '<div class="error"><p>%s</p></div>', esc_html( $message ) );
    }

endif;

if ( ! function_exists( 'wp_restaurant_customize' ) ) :

    /**
     * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
     *
     *@since WP Restaurant 1.0.0
    *
    * @global string $wp_version WordPress version.
    */
    function wp_restaurant_customize() {
        /* translators: 1: WordPress version */	        
        wp_die( sprintf( esc_html__( 'WP Restaurant Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wp-restaurant' ), esc_html( $GLOBALS['wp_version'] ) ), '', array(
            'back_link' => true,
        ) );
    }
endif;
add_action( 'load-customize.php', 'wp_restaurant_customize' );


if ( ! function_exists( 'wp_restaurant_preview' ) ) :

    /**
     * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
     *
     *@since WP Restaurant 1.0.0
    * @global string $wp_version WordPress version.
    */
    function wp_restaurant_preview() {
        if ( isset( $_GET['preview'] ) ) {
        /* translators: 1: WordPress version */
            wp_die( sprintf( esc_html__( 'WP Restaurant Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wp-restaurant' ), esc_html( $GLOBALS['wp_version'] ) ) );
        }
    }
endif;
add_action( 'template_redirect', 'wp_restaurant_preview' );

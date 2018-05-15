<?php
/**
 * Sets sections for home page
 */
if ( ! function_exists( 'wp_restaurant_homepage_customizer' ) ) :
   /**
    * wp_restaurant_homepage_customizer
    *
    * @param mixed $setting_array
    * @return mixed $setting_array
    */
    function wp_restaurant_homepage_customizer( $setting_array ) {
        $capability = 'edit_theme_options';
        $theme_supports = '';
        $setting_array[] = array(
                'id'                => 'home-page', /* unique ID*/
                'title'             => esc_html__( 'Home Template', 'wp-restaurant' ), /* Panel name*/
                'priority'          => 150,
                'capability'        => $capability,
                'theme_supports'    => '',
                'section'    => array(
                        array(
                                'id'               => 'homepage-banner-section',
                                'title'            => esc_html__('Banner','wp-restaurant'),
                                'priority'         => 10,
                                'section_settings' => array(     
                                        array(
                                                'id'           => 'home_banner_image_option',
                                                'title'        => esc_html__('Show Banner Image','wp-restaurant'),
                                                'setting_type' => 'theme_mod', 
                                                'type'         => 'checkbox',                                                
                                                'transport'    => 'refresh',
                                        ),      
                                        array(
                                                'id'           => 'home_banner_image',
                                                'title'        => esc_html__('Banner Image','wp-restaurant'),
                                                'setting_type' => 'theme_mod', 
                                                'type'         => 'image',
                                                'valid'        => 'image',                                                 
                                                'transport'    => 'refresh',
                                        ),
                                        array(
                                                'id'    => 'heading1',
                                                'title' => esc_html__( 'Contact/Reservation Settings', 'wp-restaurant' ),
                                                'type'  => 'heading'
                                        ),
                                        array(
                                                'id'            => 'home_contact_page_id', 
                                                'title'         => esc_html__( 'Choose Contact Page','wp-restaurant' ), 
                                                'setting_type'  => 'theme_mod', 
                                                'type'          => 'dropdown-pages',
                                                'transport'     => 'refresh',
                                        ),
                                         array(
                                                'id'            => 'home_contact_us_label', 
                                                'title'         => esc_html__( 'Contact Us Link Label','wp-restaurant' ), 
                                                'setting_type'  => 'theme_mod', 
                                                'type'          => 'text',
                                                'valid'         => 'text',
                                                'default'       => esc_html__( 'Contact Us','wp-restaurant' ),
                                                'transport'     => 'postMessage',
                                        ),
                                        array(
                                                'id'            => 'home_contact_reservation', 
                                                'title'         => esc_html__( 'Choose Reservation Page','wp-restaurant' ), 
                                                'setting_type'  => 'theme_mod', 
                                                'type'          => 'dropdown-pages',
                                                'transport'     => 'refresh',
                                        ),
                                        array(
                                                'id'            => 'home_contact_reservation_label', 
                                                'title'         => esc_html__( 'Reservation Link Label','wp-restaurant' ), 
                                                'setting_type'  => 'theme_mod', 
                                                'type'          => 'text',
                                                'valid'         => 'text',
                                                'default'       => esc_html__( 'Reserve Now','wp-restaurant' ),
                                                'transport'     => 'postMessage',
                                        ),
                                )
                        ),
                        array(
                                'id'                    => 'homepage-content-section',
                                'title'                 => esc_html__('Home Content','wp-restaurant'),
                                'priority'              => 10,
                                'active_callback'       => '',
                                'section_settings'      => array(
                                         array(
                                                'id'           => 'home_page_option',
                                                'title'        => esc_html__('Show Home Page Content','wp-restaurant'),
                                                'setting_type' => 'theme_mod', 
                                                'type'         => 'checkbox',                                                
                                                'transport'    => 'refresh',
                                        ),      
                                        array(
                                                'id'            => 'home_page_content', 
                                                'title'         => esc_html__( 'Choose Content','wp-restaurant' ), 
                                                'setting_type'  => 'theme_mod', 
                                                'type'          => 'dropdown-pages',
                                                'transport'     => 'refresh',
                                        ),
                                         array(
                                                'id'            => 'home_page_content_length', 
                                                'title'         => esc_html__( 'Content Length','wp-restaurant' ), 
                                                'setting_type'  => 'theme_mod', 
                                                'type'          => 'number',
                                                'transport'     => 'refresh',
                                        ),
                                )
                        ),               
                ),
        );       


              

        return $setting_array;
    }
endif;
    
add_filter( 'wp_restaurant_customizer_settings', 'wp_restaurant_homepage_customizer', 15, 1 );

if ( ! function_exists( 'wp_restaurant_homepage_menu_setting_customizer' ) ):

        function wp_restaurant_homepage_menu_setting_customizer( $setting_array ) {
                if (  class_exists( 'Jetpack' ) && class_exists( 'Nova_Restaurant' )  ) {                        
                        $capability             = 'edit_theme_options';
                        $theme_supports         = '';
                        $setting_array[]        = array(
                                'id'                    => 'home-page', /* unique ID*/
                                'title'                 => esc_html__( 'Home Template', 'wp-restaurant' ), /* Panel name*/
                                'priority'              => 150,
                                'capability'            => $capability,
                                'theme_supports'        => '',
                                'section'               => array(
                                        array(
                                                'id'                    => 'homepage-menu-section',
                                                'title'                 => esc_html__('Menu' ,'wp-restaurant'),
                                                'priority'              => 10,
                                                'active_callback'       => '',
                                                'description'           => esc_html( 'Note: To use this section we recommend you to install Jetpack Plugin. Please create a page and choose Menu Page template for viewing menu item listing', 'wp-restaurant' ),
                                                'section_settings'      => array(
                                                        array(
                                                                'id'           => 'home_menu_option',
                                                                'title'        => esc_html__('Show menu section in frontpage','wp-restaurant'),
                                                                'setting_type' => 'theme_mod', 
                                                                'type'         => 'checkbox',                                                
                                                                'transport'    => 'refresh',
                                                        ),      
                                                        array(
                                                                'id'           => 'home_menu_title',
                                                                'title'        => esc_html__( 'Menu Main Title','wp-restaurant' ), 
                                                                'setting_type' => 'theme_mod', 
                                                                'type'         => 'text',
                                                                'valid'        => 'text', 
                                                                'transport'    => 'postMessage',
                                                        ), 
                                                        array(
                                                                'id'           => 'home_menu_subtitle',
                                                                'title'        => esc_html__( 'Menu Sub Title','wp-restaurant' ), 
                                                                'setting_type' => 'theme_mod', 
                                                                'type'         => 'text',
                                                                'valid'        => 'text', 
                                                                'transport'    => 'postMessage',
                                                        ),
                                                        array(
                                                                'id'           => 'home_menu_view_more_label',
                                                                'title'        => esc_html__( 'View More Text Label','wp-restaurant' ), 
                                                                'setting_type' => 'theme_mod', 
                                                                'type'         => 'text',
                                                                'valid'        => 'text', 
                                                                'transport'    => 'postMessage',
                                                        ),    
                                                
                                                ),
                                        ),

                                        array(
                                                'id'                    => 'homepage-menu-banner-section',
                                                'title'                 => esc_html__( 'Menu Banner','wp-restaurant'),
                                                'priority'              => 10,
                                                'description'           => esc_html( 'Note: To use this section we recommend you to install Jetpack Plugin. Please create a page and choose Menu Page template for viewing menu item listing', 'wp-restaurant' ),                                
                                                'section_settings'      => array(
                                                        array(
                                                                'id'           => 'home_menu_banner_option',
                                                                'title'        => esc_html__('Show menu banner section in frontpage','wp-restaurant'),
                                                                'setting_type' => 'theme_mod', 
                                                                'type'         => 'checkbox',                                                
                                                                'transport'    => 'refresh',
                                                        ), 
                                                        array(
                                                                'id'           => 'home_menu_banner_background_image',
                                                                'title'        => esc_html__('Menu Background Image','wp-restaurant'),
                                                                'setting_type' => 'theme_mod', 
                                                                'type'         => 'image',
                                                                'valid'        => 'image',                                                                
                                                                'transport'    => 'refresh',
                                                        ),
                                                        array(
                                                                'id'           => 'home_menu_banner_head_title',
                                                                'title'        => esc_html__( 'Menu Banner Head Title','wp-restaurant' ), 
                                                                'setting_type' => 'theme_mod', 
                                                                'type'         => 'text',
                                                                'valid'        => 'text', 
                                                                'default'      => esc_html__( 'Prepare the best dishes', 'wp-restaurant' ),
                                                                'transport'    => 'postMessage',
                                                        ),
                                                        array(
                                                                'id'           => 'home_menu_banner_main_title',
                                                                'title'        => esc_html__( 'Menu Banner Main Title','wp-restaurant' ), 
                                                                'setting_type' => 'theme_mod', 
                                                                'type'         => 'text',
                                                                'valid'        => 'text', 
                                                                'default'      => esc_html__( 'Our Restaurant And the Food They Serve their Guests', 'wp-restaurant' ),
                                                                'transport'    => 'postMessage',
                                                        ),                                     
                                                        array(
                                                                'id'           => 'home_menu_banner_link_label',
                                                                'title'        => esc_html__( 'Menu Banner Link Label','wp-restaurant' ), 
                                                                'setting_type' => 'theme_mod', 
                                                                'type'         => 'text',
                                                                'valid'        => 'text',
                                                                'default'      => esc_html__( 'View More', 'wp-restaurant' ),
                                                                'transport'    => 'postMessage',
                                                        ), 
                                                ),
                                                
                                        ),     
                                )
                        ); 
		}
                
        return $setting_array;
        
        }
endif;
add_filter( 'wp_restaurant_customizer_settings', 'wp_restaurant_homepage_menu_setting_customizer', 15, 1 );
<?php
/**
 * Sets sections for contact
 */
if ( ! function_exists( 'wp_restaurant_contact_customizer' ) ) :
   /**
    * wp_restaurant_contact_customizer
    *
    * @param mixed $setting_array
    * @return mixed $setting_array
    */
    function wp_restaurant_contact_customizer( $setting_array ) {

        $capability = 'edit_theme_options';
        $theme_supports = '';
        $setting_array[] = array(
                'id'               => 'contact-setting-section',
                'title'            => __('Contact Information','wp-restaurant'),
                'priority'         => 151, 
                'capability'       => $capability,
                'section_settings' => array(
                        array(
                                'id'            => 'show_contact_in_front', 
                                'title'         => esc_html__( 'Show Contact In Front page','wp-restaurant' ), 
                                'setting_type'  => 'theme_mod', 
                                'type'          => 'checkbox',
                                'transport'     => 'refresh',
                        ),
                        array(
                                'id'              => 'contact_setting_address',
                                'title'           => __('Contact Address','wp-restaurant'),
                                'setting_type'    => 'theme_mod', 
                                'type'            => 'editor',
                                'valid'           => 'text',
                                'default'         => '',
                                'transport'       => 'postMessage',
                        ),															
                        array(
                                'id'              => 'contact_setting_phone',
                                'title'           => __('Contact Number','wp-restaurant'),
                                'setting_type'    => 'theme_mod', 
                                'type'            => 'text',
                                'valid'           => 'text', 
                                'default'         => '',
                                'transport'       => 'postMessage',
                        ),                                                            
                        array(
                                'id'              => 'contact_setting_email',
                                'title'           => __('Email','wp-restaurant'),
                                'setting_type'    => 'theme_mod', 
                                'type'            => 'email',
                                'valid'           => 'email',
                                'default'         => '', 
                                'transport'       => 'postMessage',
                        ),                       
                        array(
                                'id'           => 'home_contact_opening_time',
                                'title'        => __( 'Opening Time','wp-restaurant' ), 
                                'setting_type' => 'theme_mod', 
                                'type'         => 'editor',
                                'valid'        => 'textarea', 
                                'transport'    => 'postMessage',
                        ),
                )
        );	
        return $setting_array;
    }
endif;   
add_filter( 'wp_restaurant_customizer_settings', 'wp_restaurant_contact_customizer', 15, 1 );   
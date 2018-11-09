<?php
/**
 * Sets sections for theme options
 */
if ( ! function_exists( 'wp_restaurant_generic_page_settings_customizer' ) ) :
   /**
    * wp_restaurant_generic_page_settings_customizer
    *
    * @param mixed $setting_array
    * @return mixed $setting_array
    */
   
    function wp_restaurant_generic_page_settings_customizer( $setting_array ) {
        $capability = 'edit_theme_options';
        $setting_type = 'theme_mod';
        $theme_supports = '';            

        $setting_array[] = array(
            'id'    => 'title_tagline',
            'title'             => __( 'Site Identity', 'wp-restaurant' ),
            'priority'          => 20,
            'capability'        => $capability,
            'theme_supports'    => '',           
            'section_settings' => array(
                array(
                    'id'            => 'welcome_text',
                    'title'         => __('Welcome Text','wp-restaurant'),
                    'setting_type'  => $setting_type, 
                    'priority'      => 9,                    
                    'type'          => 'text',
                    'valid'         => 'text',
                    'transport'     => 'postMessage',                    
                    'default'       => esc_html__( 'Welcome To', 'wp-restaurant' )
                ),
                array(
                    'id'            => 'show-title',
                    'title'         => __('Show Title','wp-restaurant'),
                    'setting_type'  => $setting_type, 
                    'priority'      => 10,                    
                    'type'          => 'checkbox',
                    'valid'         => 'checkbox',
                    'transport'     => 'postMessage',
                    'default'       => absint(1)
                ),
                array(
                    'id'            => 'show-tagline',
                    'title'         => __('Show Tagline','wp-restaurant'),
                    'setting_type'  => $setting_type, 
                    'priority'      => 11,                    
                    'type'          => 'checkbox',
                    'valid'         => 'checkbox',
                    'transport'     => 'postMessage',                    
                    'default'       => absint(1)
                ),
                		
            ),

        );

        $setting_array[] = array(
            'id'                => 'generic_page_settings', /* unique ID*/
            'title'             => esc_html__( 'Theme Options', 'wp-restaurant' ), /* Panel name*/
            'priority'          => 153,
            'capability'        => $capability,
            'theme_supports'    => $theme_supports,       
            'section_settings'  => array(              
                array(
                    'id'            => 'generic_image',
                    'title'         => esc_html__('Generic Image','wp-restaurant'),
                    'description'   => esc_html( 'Background Image for header background', 'wp-restaurant' ),                    
                    'setting_type'  => $setting_type, 
                    'type'          => 'image',
                    'valid'         => 'image'
                ),
                 array(
                    'id'            => 'menu-item-heading-image',
                    'title'         => esc_html__('Menu Label Heading','wp-restaurant'),
                    'description'   => esc_html( 'Background Image for display Menu Label Heading', 'wp-restaurant' ),
                    'setting_type'  => $setting_type, 
                    'type'          => 'image',
                    'valid'         => 'image'
                ),
                array(
                    'id'           => 'single-page-image-position',
                    'title'        => esc_html__('Image Position','wp-restaurant'),
                    'description'  => esc_html__('For single post\'s featured image position','wp-restaurant'),
                    'setting_type' =>  $setting_type,
                    'type'         => 'select',
                    'valid'        => 'select', 
                    'transport'    => 'refresh',
                    'choices'      => array(
                        'none'     => esc_html__( 'No Image', 'wp-restaurant' ),
                        'left'     => esc_html__( 'Left Side', 'wp-restaurant' ),
                        'right'    => esc_html__( 'Right Side', 'wp-restaurant' ),
                        'full'     => esc_html__( 'Full', 'wp-restaurant' ),
                    ),
                    'default' => 'no-image',
                ),
                array(
                    'id'          => 'sidebar_settings',
                    'title'       => esc_html__('Sidebar Setting','wp-restaurant'),
                    'description' => esc_html__('For single posts','wp-restaurant'),
                    'setting_type' =>  $setting_type,
                    'type'         => 'select',
                    'valid'        => 'select', 
                    'transport'    => 'refresh',
                    'choices'      => array(
                        'no-sidebar'    => esc_html__( 'No sidebar', 'wp-restaurant' ),
                        'right-sidebar' => esc_html__( 'Right Side', 'wp-restaurant' ),
                        'left-sidebar'  => esc_html__( 'Left Side', 'wp-restaurant' ),
                    ),
                    'default' => 'no-sidebar',
                ), 
                array(
                        'id'           => 'footer_sidebar_number',
                        'title'        => esc_html__( 'Number of Footer Sidebar', 'wp-restaurant' ),
                        'setting_type' => 'theme_mod',
                        'type'         => 'select',
                        'valid'        => 'select',
                        /* translators: 1: date */ 
                        'default'      => '3',  
                        'transport'    => 'postMessage',
                        'choices'      => array(
                            '0'     => esc_html__( 'None', 'wp-restaurant' ),
                            '1'     => esc_html__( 'One', 'wp-restaurant' ),
                            '2'     => esc_html__( 'Two', 'wp-restaurant' ),
                            '3'     => esc_html__( 'Three', 'wp-restaurant' ),
                        ),
                ),
                array(
                        'id'           => 'footer_text',
                        'title'        => esc_html__( 'Footer Copyright Text', 'wp-restaurant' ),
                        'setting_type' => 'theme_mod',
                        'type'         => 'text',
                        'valid'        => 'text',
                        /* translators: 1: date */ 
                        'default'      => sprintf( esc_html__( '&copy; %d. All Right Reserved.', 'wp-restaurant' ), date ('Y' ) ),  
                        'transport'    => 'postMessage',
                ),	
            ),
        );        
		return $setting_array;        
    }
endif;
    
add_filter( 'wp_restaurant_customizer_settings', 'wp_restaurant_generic_page_settings_customizer', 15, 1 );
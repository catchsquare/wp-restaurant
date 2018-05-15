<?php
/**
 * WP Restaurant Customizer
 */
define( 'WP_RESTAURANT_DIR', WP_RESTAURANT_TEMPLATE_DIR . 'inc/' . basename( dirname( __FILE__ ) ) );
/** The short name gives a unique element to each options id. */
define( 'WP_RESTAURANT_PANEL_PREFIX', 'restaurant');
define( 'WP_RESTAURANT_OPT_NAME', 'restaurant_option');

/**
 * Rewire custom control class
 */
require_once WP_RESTAURANT_TEMPLATE_CUSTOMIZER_DIR . 'customize-controls/customize-controls.php';

/**
 *  including customizer settings file
 */
require_once WP_RESTAURANT_TEMPLATE_CUSTOMIZER_DIR . 'customizer-fields/fields.php';



class WP_Restaurant_Customizer_Framework {

    /**
     * $panels
     *
     * @var array
     */
    private $panels;
    /**
     * $settings
     *
     * @var array
     */
    private $settings;
    /**
     * $controls
     *
     * @var array
     */
    private $controls;

    /**
     * $customizer_settings
     *
     * @var array
     */
    protected $customizer_settings;
    /**
     * $instance
     *
     * @var object
     */
    protected static $instance;

    /**
     * get_instance
     *
     * @return object
     */
    public static function get_instance() {
        if( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * __construct
     *
     * @return void
     */
    private function __construct() {
        $this->customizer_settings = apply_filters( 'wp_restaurant_customizer_settings' , array() );        
        add_action( 'customize_register', array( $this, 'restaurant_display_customizer_register' ),10,1 );
        add_action( 'customize_preview_init', array( $this, 'restaurant_customizer_script' ) );
        add_action( 'customize_controls_enqueue_scripts', array( $this, 'restaurant_editor_customizer_script' ) );
    } 
    
    /**
     * restaurant_editor_customizer_script
     *
     * @return void
     */
    public function restaurant_editor_customizer_script() {
        wp_enqueue_script( 'wp-editor-customizer', get_theme_file_uri( '/assets/build/js/customizer-panel.js' ), array( 'jquery' ), WP_RESTAURANT_VER, true ); 
    }

    /**
     * restaurant_customizer_script
     *
     * @return void
     */
    public function restaurant_customizer_script(){
        wp_enqueue_script( 'restaurant-customizer', get_theme_file_uri( '/assets/build/js/customizer.js' ), array( 'jquery', 'customize-preview' ), WP_RESTAURANT_VER, true );

        wp_localize_script( 'restaurant-customizer','resCustomizer', array(
            'location_title' => esc_html__('Find Us','wp-restaurant'),
            'location'       => esc_url( WP_RESTAURANT_TEMPLATE_DIR_URI.'/assets/build/images/cs-location.png' ),
            'opening'        => esc_url( WP_RESTAURANT_TEMPLATE_DIR_URI.'/assets/build/images/cs-opening.png' ),
            'contact'        => esc_url( WP_RESTAURANT_TEMPLATE_DIR_URI.'/assets/build/images/cs-contact.png' ),
            'no_contact'     => esc_html__( 'Contact information are empty. You need to add your contact information <br /> Customizer->Contact Information', 'wp-restaurant' ),
        ) );
    }

    /**
     * restaurant_display_customizer_register
     *
     * @param mixed $wp_customize
     * @return void
     */
    public function restaurant_display_customizer_register( $wp_customize ) {
        /*Remove Colors, Background image option from theme customizer */
        
        /**
         * Loops through each array element and calls the corresponding display function.
         */
        foreach ( $this->customizer_settings as $panel ) {
            /**
             * Add Panel
             */
            if( isset( $panel['section'] ) ) {

                $this->add_customizer_panel( $wp_customize, $panel );
                /**
                 * Add settings sections
                 */
                foreach ( $panel[ 'section' ] as $section ) {
                    $this->add_customizer_section( $wp_customize, $panel['id'], $section );
                }
            } else {
                $this->add_customizer_section( $wp_customize, FALSE, $panel );
            }

        } 
    }


    /**
     * add_customizer_panel 
     * adds panels to Customizer
     * @param [type] $wp_customize [customizer obj]
     * @param [type] $panel        [panel array]
     */
    public function add_customizer_panel( $wp_customize, $panel ) {

        $priority       = ( isset( $panel['priority'] ) ) ? $panel['priority'] : 10;
        $theme_supports = ( isset( $panel['theme_supports'] ) ) ? $panel['theme_supports'] : '';
        $capability     = ( isset( $panel['capability'] ) ) ? $panel['capability'] : '';
        $title          = ( isset( $panel['title'] ) ) ? esc_attr( $panel['title'] ) : __( 'Untitled Panel', 'wp-restaurant' );
        $description    = ( isset( $panel['description'] ) ) ? esc_attr( $panel['description'] ) : '';
    
        $panel_array = array(
                                'priority'          => $priority,
                                'capability'        => $capability,
                                'theme_supports'    => $theme_supports,
                                'title'             => $title,
                                'description'       => $description,
                            );
        if ( isset( $panel['active_callback'] ) ) {
            $panel_array['active_callback'] = $panel['active_callback'];
        }
      
        $wp_customize->add_panel( $panel['id'], $panel_array );
    }


    /**
     * add_customizer_section
     * adds section to Customizer
     * @param [type] $wp_customize [customizer obj]
     * @param [type] $section      [section array]
     */ 
    public function add_customizer_section( $wp_customize,$panel_id, $section ) {

        $title          = ( isset( $section['title'] ) ) ? esc_attr( $section['title'] ) : __( 'Untitled Section', 'wp-restaurant' );
        $description    = ( isset( $section['description'] ) ) ? esc_attr( $section['description'] ) : '';
        $capability     = ( isset( $section['capability'] ) ) ? esc_attr( $section['capability'] ) : 'edit_theme_options';
        $priority     = ( isset( $section['priority'] ) ) ? esc_attr( $section['priority'] ) : 10;
        $theme_supports = '';


        $restaurant_add_section = array();
        $restaurant_add_section['priority'] = 10;

        $restaurant_add_section['title']            = $title;
        $restaurant_add_section['description']      = $description;
        $restaurant_add_section['capability']       = $capability;
        $restaurant_add_section['theme_supports']   = $theme_supports;       
        $restaurant_add_section['priority']         = $section['priority'];       
        

        if( isset( $section['active_callback'] ) && $section['active_callback']  != '' ) {
            $restaurant_add_section['active_callback']  = $section['active_callback'];
        } 

        if( $panel_id ){
            $restaurant_add_section['panel'] = $panel_id;
        }

        $wp_customize->add_section( esc_attr( $section['id'] ), $restaurant_add_section );

        
        foreach( $section['section_settings'] as $settings ) {
            $this->add_customizer_controls( $wp_customize, $section['id'], $settings );
        }

    } 

    /**
     * add_customizer_controls
     * Adds settings and controls to Customizer
     * @param [type] $wp_customize [customizer obj]
     * @param [type] $section [section id]
     * @param [type] $settings      [settings array]
     */ 
    public function add_customizer_controls( $wp_customize, $section_id, $settings ) {       
        /*Add controls*/
        $default_setting_array = array( 
                                        'type' => 'theme_mod',
                                        'capability' => 'edit_theme_options',
                                        'active_callback' => '',
                                        'theme_supports' => '',
                                        'transport' => 'refresh',
                                        'sanitize_callback' => 'esc_attr',
                                        'sanitize_js_callback' => '',
                                    );
        $setting_array = array_merge( $default_setting_array, array() );

        if ( isset( $settings['default'] ) ) {
           
            $setting_array['default']  = $settings['default'];
        } else {
            $setting_array['default'] = '';
        }

        if ( isset( $settings['setting_type'] ) ) {
            $setting_array['type']  = $settings['setting_type'];
        }

        if ( isset( $settings['capability'] ) ) {
             $setting_array['capability'] =  $settings['capability'];
        }

        if ( isset( $settings['active_callback'] ) ) {
             $setting_array['active_callback'] =  $settings['active_callback'];
        }
        
        if ( isset( $settings['theme_supports'] ) ) {
            $setting_array['theme_supports'] =   $settings['theme_supports'];
        }

        if ( isset( $settings['transport'] ) ) {
            $setting_array['transport'] =   $settings['transport'];
        }

        $valid = 'text';
        $type = (isset( $settings['type'] ) ) ? $settings['type'] :'text';

        /**
         * Sets default input sanitization if empty.
         */
        if ( isset( $settings['valid'] ) ) {
            switch ( $type ) {
                case 'color':
                    $valid = 'color';
                    break;
                case 'html':
                case 'editor':
                case 'textarea':
                    $valid = 'html';
                    break; 
                case 'map':
                    $valid = 'map';
                    break; 
                case 'url':
                    $valid = 'url';
                    break; 
                case 'email':
                    $valid = 'email';
                    break; 
                case 'integer':
                    $valid = 'integer';
                    break;
                case 'currency':
                    $valid = 'currency';
                    break;   
                default:
                    $valid = 'text';
            }

        }
        $setting_array['sanitize_callback'] = $this->_sanitization_callback_assign( $valid );
        
        /**
         * Sets optional js sanitization.
        */
        if ( isset( $settings['valid_js'] ) ) {
            $setting_array[ 'sanitize_js_callback' ] = $settings['valid_js'];
        }         
        /**
         * Add control settings
         */ 
        $wp_customize->add_setting( esc_attr( $settings['id'] ), 
                                        array(
                                            'default'               => $this->get_default_theme_value(  $settings['id'], $setting_array['default'] ),
                                            'type'                  => $setting_array['type'],                                            
                                            'capability'            => $setting_array['capability'],
                                            'theme_supports'        => $setting_array['theme_supports'],
                                            'active_callback'       => $setting_array['active_callback'],
                                            'transport'             => $setting_array['transport'],
                                            'sanitize_callback'     => $setting_array['sanitize_callback'],
                                            'sanitize_js_callback'  => ( isset( $settings['valid_js'] ) ) ? $setting_array['sanitize_js_callback'] : '',
                                        )
                                    );
        $control_array = array(
                                'label'      => isset($settings['title']) ? $settings['title'] : __('Untited','wp-restaurant'),
                                'settings'   => $settings['id'],
                                'section'    => $section_id,
                                'type'       => $type,
                            );

        if( isset( $settings['description'] ) ) {
            $control_array['description'] = $settings['description'];
        }

        if( isset( $settings['mime_type'] ) ) {
            $control_array['mime_type'] = $settings['mime_type'];
        }

        if( isset( $settings['active_callback'] ) ) {
            $control_array['active_callback'] = $settings['active_callback'];
        }            

        if ( isset( $settings['priority'] ) ) {
            $control_array['priority'] = $settings['priority'];
        } else {
            $control_array['priority'] = 10;
        }

        if (  $type == "select" || $type == "radio"  ) {
            $control_array['choices'] = $settings['choices'];
        } 

        if( $type == "range" ) {
            $control_array['input_attrs'] = $settings['input_attrs'];
        } 

        $options = array();
        if( isset( $settings['args'] ) ) {
            $options = $settings['args'];
        }

      $this->_add_control_customize( $wp_customize, $settings['id'], $control_array, $options );
       
    } 

    /**
     * _sanitization_callback_assign
     *
     * @param mixed $valid
     * @return mixed $sanitize_val
     */
    private function _sanitization_callback_assign( $valid ){
        $sanitize = new WP_Restaurant_Sanitization();
        $sanitize_val = '';
        switch ( $valid ) {
            case 'text':
                 $sanitize_val  = 'sanitize_text_field';
                break;             
            case 'textarea':                
            case 'editor':
            case 'html':
                $sanitize_val  = array( $sanitize, 'sanitize_html' );
                break;
            case 'map':
                $sanitize_val  = $sanitize->sanitize_map( 'map' );
                break;
            case 'url':
                 $sanitize_val  = 'esc_url_raw';
                break;
            case 'email':
                $sanitize_val  = 'sanitize_email';
                break;
            case 'integer':
                 $sanitize_val  = array( $sanitize, 'sanitize_integer' );
                break;
            case 'currency':
                 $sanitize_val  = array( $sanitize, 'sanitize_currency' );
                break;
            case 'color':
                 $sanitize_val  = 'sanitize_hex_color';
                break;
            default:
            /**
            * If $valid isn't recognized , it sets the value of the variable
            * as the callback function name. This allows a custom callback function to be
            * called from the customizer setup array, typically in the functions.php file.
            */
                 /*$sanitize_val  = $valid;*/
                 $sanitize_val  = 'esc_attr';
                 
        } 
        return $sanitize_val;
    }

    /**
     * _add_control_customize
     *
     * @param mixed $wp_customize
     * @param mixed $id
     * @param mixed $control_array
     * @param mixed $args
     * @return void
     */
    private function _add_control_customize( $wp_customize, $id , $control_array, $args ) {
        switch ( $control_array['type'] ) {

            case 'number'         :
            case 'date'           :
            case 'url'            :
            case 'email'          :
            case 'password'       :
            case 'text'           :
            case 'textarea'       :
            case 'radio'          :
            case 'select'         :
            case 'checkbox'       :
            case 'range'          :
            case 'dropdown-pages' :
                    $wp_customize->add_control( esc_attr( $id ), $control_array );
            break;           
            case 'html' :
            case 'editor' :
                $wp_customize->add_control( new  WP_Restaurant_Customize_Html_Control( $wp_customize, esc_attr( $id ), $control_array ) );
            break;

            /*Image Upload Field*/
            case 'image': 
                    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, esc_attr( $id ), $control_array ) );
            break;

            /*File Upload Field*/
            case 'file':
                    $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, esc_attr( $id ), $control_array ) );
            break;

            /*Color Picker Field*/
            case 'color':
                    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, esc_attr( $id ), $control_array ) );
            break;
           
            /*Categories Field*/
            case 'categories':
                    $wp_customize->add_control( new WP_Restaurant_Customize_Categories_Control( $wp_customize, esc_attr( $id ), $control_array, $args ) );
            break;
        
            /*Menus Field*/
            case 'menus':
                    $wp_customize->add_control( new WP_Restaurant_Customize_Menus_Control( $wp_customize, esc_attr( $id ), $control_array ) );
            break;

            /*Users Field*/
            case 'users':
                $wp_customize->add_control( new WP_Restaurant_Customize_Users_Control( $wp_customize, esc_attr( $id ), $control_array ) );
            break;
           
            /*Posts Field*/
            case 'posts':
                $wp_customize->add_control( new WP_Restaurant_Customize_Posts_Control( $wp_customize, esc_attr( $id ), $control_array, $args ) );
            break;

            /*Post Types Field*/
            case 'post_types':
                $wp_customize->add_control( new WP_Restaurant_Customize_Post_Type_Control( $wp_customize, esc_attr( $id ), $control_array, $args ) );
            break;

            /*Tags Field*/
            case 'tags':
                $wp_customize->add_control( new WP_Restaurant_Customize_Tags_Control( $wp_customize, esc_attr( $id ), $control_array ) );
            break;

            case 'line' :
                $wp_customize->add_control( new WP_Restaurant_Customize_Head_Control( $wp_customize, esc_attr( $id ), $control_array ) );
            break;
            
            case 'heading' :
                $wp_customize->add_control( new WP_Restaurant_Customize_Head_Control( $wp_customize, esc_attr( $id ), $control_array ) );
            break;
        }
    }

    /**
     * get_default_theme_value
     *
     * @param mixed $id
     * @param mixed $default_value
     * @return mixed
     */
    private function get_default_theme_value( $id, $default_value ) {       
        return get_theme_mod( $id, $default_value );
    }

    public function get( $id, $default ){
        return $this->get_default_theme_value( $id, $default );        
    }
}

add_action( 'after_setup_theme', array( 'WP_Restaurant_Customizer_Framework', 'get_instance' ) );
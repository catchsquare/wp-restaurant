<?php
/**
 * Add Categories control
 */

if( ! class_exists( 'WP_Customize_Control' ) )
     return;

class WP_Restaurant_Customize_Categories_Control extends WP_Customize_Control {

    /**
     * $type
     *
     * @var string
     */
    public $type = 'categories';
    /**
     * $args
     *
     * @var array
     */
    public $args = array(
                        'echo'              => 0,
                        'option_none_value' => '0',
                        'hierarchical'      => 1
                    );

    /**
     * __construct
     *
     * @param mixed $manager
     * @param mixed $id
     * @param mixed $args
     * @return void
     */
    public function __construct( $manager, $id, $args = array(), $options = array() ) {
       
        $this->args = wp_parse_args( $options, $this->args );
        parent::__construct( $manager, $id, $args );
    }
 
 	
    /**
     * render_content
     *
     * @return void
     */
    public function render_content() {
        $args = wp_parse_args(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'show_option_none'  => __( '&mdash; Select &mdash;' , 'wp-restaurant' ),
                    'selected'          => $this->value(),
                ),
                $this->args
            );
        $wp_dropdown_categories = wp_dropdown_categories( $args );

        // Hackily add in the data link parameter.
        $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $wp_dropdown_categories );

        printf(
            '<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s</label>',
            esc_attr($this->label),
            esc_html( $this->description ),
            esc_html( $dropdown )
        );

    }
}

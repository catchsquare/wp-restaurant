<?php
/**
 * Add Line control
 */

if( ! class_exists( 'WP_Customize_Control' ) )
     return;


class WP_Restaurant_Customize_Head_Control extends WP_Customize_Control {

    /**
     * __construct
     *
     * @param mixed $manager
     * @param mixed $id
     * @param mixed $args
     * @return void
     */
    public function __construct( $manager, $id, $args = array(), $options = array() ) {
        parent::__construct( $manager, $id, $args );
    }

    /**
     * render_content
     *
     * @return void
     */
    public function render_content() {
       switch ( $this->type ) {         

            case 'heading':
            printf( '<span class="%s">%s</span><span class="%s">%s</span>', "customize-control-title", esc_html( $this->label ), 'description customize-control-description', esc_html( $this->description ) ); 
            break;
            
            case 'line' :
              echo '<hr />';
              break;
        }
    }
}

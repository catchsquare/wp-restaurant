<?php
/**
 * Add Post Types control
 */

if( ! class_exists( 'WP_Customize_Control' ) )
     return;


class WP_Restaurant_Customize_Post_Type_Control extends WP_Customize_Control {
    
    /**
     * $type
     *
     * @var string
     */
    public $type = 'post_types';
    
    /**
     * $post_types
     *
     * @var boolean
     */
    private $post_types = false;

    /**
     * __construct
     *
     * @param mixed $manager
     * @param mixed $id
     * @param mixed $args
     * @return void
     */
    public function __construct( $manager, $id, $args = array(), $options = array() ) {

        $postargs = wp_parse_args( $options, array( 'public' => true ) );
        $this->post_types = get_post_types( $postargs, 'object' );
        parent::__construct( $manager, $id, $args );

    }

    /**
     * render_content
     *
     * @return void
     */
    public function render_content() {

        if( empty( $this->post_types ) )
            return;
            ?>
            <label class="customize-control-select">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
                <select <?php $this->link(); ?>>
                <option value=""><?php esc_html_e( '&mdash; Select &mdash;' , 'wp-restaurant' ); ?></option>
                <?php
                    foreach ( $this->post_types as $k => $post_type ) {
                        printf('<option value="%s" %s>%s</option>', 
                            esc_attr( $k ),
                            selected( $this->value(), esc_attr( $k ), false ),
                            esc_html( $post_type->labels->name )
                        );
                    }
                ?>
                </select>
            </label>
        <?php
    }
}
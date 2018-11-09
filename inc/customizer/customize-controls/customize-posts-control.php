<?php
/**
 * Add Posts control
 */

if( ! class_exists( 'WP_Customize_Control' ) )
     return;


class WP_Restaurant_Customize_Posts_Control extends WP_Customize_Control {

    /**
     * $type
     *
     * @var string
     */
    public $type = 'posts';
    
    /**
     * $posts
     *
     * @var boolean
     */
    private $posts = false;

    /**
     * __construct
     *
     * @param mixed $manager
     * @param mixed $id
     * @param mixed $args
     * @return void
     */
    public function __construct( $manager, $id, $args = array(), $options = array() ) {

        $postargs = wp_parse_args( $options, array( 'numberposts' => '-1' ) );
        $this->posts = get_posts( $postargs );
        parent::__construct( $manager, $id, $args );
    }

    /**
     * render_content
     *
     * @return void
     */
    public function render_content() {

        if( empty( $this->posts) )
            return;
            ?>
            <label class="customize-control-select">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
                <select <?php $this->link(); ?>>
                <option value=""><?php esc_html_e( '&mdash; Select &mdash;', 'wp-restaurant' ); ?></option>
                <?php
                    foreach ( $this->posts as $post ) {
                        printf( '<option value="%s" %s>%s</option>', 
                            esc_attr( $post->ID ),
                            selected( $this->value(), esc_attr( $post->ID ), false ),
                            esc_html( $post->post_title )
                        );
                    }
                ?>
                </select>
            </label>
        <?php
    }
}
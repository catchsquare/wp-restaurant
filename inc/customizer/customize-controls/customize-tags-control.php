<?php
/**
 * Add Tags control
 */

if( ! class_exists( 'WP_Customize_Control' ) )
     return;


class WP_Restaurant_Customize_Tags_Control extends WP_Customize_Control {

    /**
     * $type
     *
     * @var string
     */
    public $type = 'tags';
    /**
     * $tags
     *
     * @var boolean
     */
    private $tags = false;

    /**
     * __construct
     *
     * @param mixed $manager
     * @param mixed $id
     * @param mixed $args
     * @return void
     */
    public function __construct( $manager, $id, $args = array(), $options = array() ) {

        $this->tags = get_tags( $options );
        parent::__construct( $manager, $id, $args );

    }

    /**
     * render_content
     *
     * @return void
     */
    public function render_content() {
        if( empty( $this->tags ) )
            return;
        ?>
            <label class="customize-control-select">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
                <select <?php $this->link(); ?>>
                <option value=""><?php esc_html_e( '&mdash; Select &mdash;', 'wp-restaurant' ); ?></option>
                <?php foreach ( $this->tags as $tag ) {
                        printf( '<option value="%s" %s>%s</option>',
                            esc_attr( $tag->term_id ),
                            selected( $this->value(), esc_attr( $tag->term_id ), false ),
                            esc_html( $tag->name )
                        );
                    }
                ?>
                </select>
            </label>
        <?php
    }
}

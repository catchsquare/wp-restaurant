<?php
/**
 * Add HTML editor control
 */

if( ! class_exists( 'WP_Customize_Control' ) )
     return;


class WP_Restaurant_Customize_Html_Control extends WP_Customize_Control {  

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
   * Render the content on the theme customizer page
   *
   * @return void
   */
  public function render_content() {
  ?>
    <label class="customize-control-html">
      <span class="customize-text_editor  customize-control-title"><?php echo esc_html( $this->label ); ?></span>        
      <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_html( $this->value() ); ?>">
      <?php $settings = array(
                  'textarea_name' => esc_attr( $this->id ),
                  'media_buttons' => false,
                  'drag_drop_upload' => false,
                  'teeny' => true,
                  'quicktags' => true,
                  'textarea_rows' => 5,                    
            );
            
          wp_editor( $this->value(), esc_attr( $this->id ), $settings ); 
          do_action('admin_print_footer_scripts');
          ?>
    </label>
          
  <?php
  }
}

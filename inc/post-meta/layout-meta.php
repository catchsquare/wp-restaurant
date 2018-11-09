<?php
/**
 * WP Restaurant Custom Metabox
 * 
 * @package WP Restaurant
 */

 function wp_restaurant_add_layout_metabox() {
    global $post;
    $restaurant_post_types = array(
        'post',
        'page'
    );

    $front_page_id = get_option( 'page_on_front' );
    if ( $post->ID == $front_page_id ) {
        return;
    }

    foreach ( $restaurant_post_types as $post_type ) {
        add_meta_box(
            'restaurant_layout_options',
            esc_html__( 'Layout Options', 'wp-restaurant' ),
            'wp_restaurant_layout_options_callback',
            $post_type,
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'wp_restaurant_add_layout_metabox' );

global $wp_restaurant_default_layout_options, $wp_restaurant_single_post_image_align_options;
/* Wp Restaurant sidebar layout */
$wp_restaurant_default_layout_options = array(
    'left-sidebar' => array(
        'value'     => 'left-sidebar',
        'thumbnail' => WP_RESTAURANT_TEMPLATE_DIR_URI . 'assets/build/images/left-sidebar.png'
    ),
    'right-sidebar' => array(
        'value' => 'right-sidebar',
        'thumbnail' => WP_RESTAURANT_TEMPLATE_DIR_URI . 'assets/build/images/right-sidebar.png'
    ),
    'no-sidebar' => array(
        'value'     => 'no-sidebar',
        'thumbnail' => WP_RESTAURANT_TEMPLATE_DIR_URI . 'assets/build/images/no-sidebar.png'
    )
);

/* Wp Restaurant featured layout */
$wp_restaurant_single_post_image_align_options = array(
    'full' => array(
        'value' => 'full',
        'label' => __( 'Full', 'wp-restaurant' )
    ),
    'right' => array(
        'value' => 'right',
        'label' => __( 'Right ', 'wp-restaurant' ),
    ),
    'left' => array(
        'value'     => 'left',
        'label' => __( 'Left', 'wp-restaurant' ),
    ),
    'no-image' => array(
        'value'     => 'no-image',
        'label' => __( 'No Image', 'wp-restaurant' )
    )
);



function wp_restaurant_layout_options_callback() {

    global $post, $wp_restaurant_default_layout_options, $wp_restaurant_single_post_image_align_options;

    /*default layout*/
    $restaurant_single_sidebar_layout = wp_restaurant_option( 'single-page-image-position', 'no-sidebar' );
    $restaurant_single_post_image_align = wp_restaurant_option( 'sidebar_settings', 'no-sidebar' );

    wp_nonce_field( basename( __FILE__ ), 'restaurant_layout_options_nonce' );
    ?>
    
    <table class="form-table page-meta-box">
        <!--Image alignment-->
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'wp-restaurant' ); ?></em></td>
        </tr>
        <tr>
            <td>
                <?php
                $restaurant_single_sidebar_layout_meta = get_post_meta( $post->ID, 'restaurant-default-layout', true );
                if( false != $restaurant_single_sidebar_layout_meta ){
                   $restaurant_single_sidebar_layout = $restaurant_single_sidebar_layout_meta;
                }
                foreach ($wp_restaurant_default_layout_options as $field) {
                    ?>
                    <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                        <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="restaurant-default-layout"
                               value="<?php echo esc_attr( $field['value'] ); ?>"
                            <?php checked( $field['value'], $restaurant_single_sidebar_layout ); ?>/>
                        <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                            <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </label>
                    </div>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
        <tr>
            <td><em class="f13"><?php esc_html_e( 'You can set up the sidebar content', 'wp-restaurant' ); ?> <a href="<?php echo esc_url( admin_url('/widgets.php') ); ?>"><?php esc_html_e( 'Here', 'wp-restaurant' ); ?></a></em></td>
        </tr>
        <!--Image alignment-->
        <tr>
            <td colspan="4"><?php esc_html_e( 'Featured Image Alignment', 'wp-restaurant' ); ?></td>
        </tr>
        <tr>
            <td>
                <?php
                $restaurant_single_post_image_align_meta = get_post_meta( $post->ID, 'restaurant-single-post-image-align', true );
                if( false != $restaurant_single_post_image_align_meta ){
                    $restaurant_single_post_image_align = $restaurant_single_post_image_align_meta;
                }
                foreach ($wp_restaurant_single_post_image_align_options as $field) {
                    ?>
                    <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="restaurant-single-post-image-align" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $restaurant_single_post_image_align ); ?>/>
                    <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                        <?php echo esc_html( $field['label'] ); ?>
                    </label>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table>

<?php }

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function wp_restaurant_save_sidebar_layout( $post_id ) {
    global $post;
    // Verify the nonce before proceeding.
    if( isset( $_POST[ 'restaurant_layout_options_nonce' ] ) && !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['restaurant_layout_options_nonce'] ) ) , basename( __FILE__ ) ) ) {
        return;
    }

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( !current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
    }
    
    if ( isset( $_POST['restaurant-default-layout'] ) ) {
        $old = get_post_meta( $post_id, 'restaurant-default-layout', true);
        $new = sanitize_text_field(  wp_unslash( $_POST['restaurant-default-layout'] ) );
        if ($new && $new != $old) {
            update_post_meta($post_id, 'restaurant-default-layout', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'restaurant-default-layout', $old);
        }
    }

    /*image align*/
    if ( isset( $_POST['restaurant-single-post-image-align'] ) ) {
           
        $old = get_post_meta( $post_id, 'restaurant-single-post-image-align', true);
        $new = sanitize_text_field( wp_unslash( $_POST['restaurant-single-post-image-align'] ) );
        if ($new && $new != $old) {
            update_post_meta($post_id, 'restaurant-single-post-image-align', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'restaurant-single-post-image-align', $old);
        }
    }
}
add_action('save_post', 'wp_restaurant_save_sidebar_layout');
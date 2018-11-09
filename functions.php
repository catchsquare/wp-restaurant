<?php
/**
 * Restaurant functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Restaurant
 * @since WP Restaurant 1.0
 */
define( 'WP_RESTAURANT_VER', '1.0.16' );

define( 'WP_RESTAURANT_STYLESHEET_URI', get_stylesheet_uri() );

define( 'WP_RESTAURANT_TEMPLATE_DIR', trailingslashit( get_template_directory() ) );

define( 'WP_RESTAURANT_TEMPLATE_DIR_URI', trailingslashit( get_template_directory_uri() ) );

define( 'WP_RESTAURANT_TEMPLATE_CUSTOMIZER_DIR', WP_RESTAURANT_TEMPLATE_DIR . 'inc/customizer/' );

/**
 * WP Restaurant Theme only works in WordPress ver 4.7 or higher.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require WP_RESTAURANT_TEMPLATE_DIR . 'inc/backward-compact.php';
	return;
}



/**
 * Custom template tags for this theme.
 */
require_once get_parent_theme_file_path( 'inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_parent_theme_file_path( 'inc/extras.php' );

/**
 * Customizer additions.
 */
require_once get_parent_theme_file_path( 'inc/customizer.php' );


require_once get_parent_theme_file_path( 'inc/init.php' );

/**
 * Load Jetpack compatibility file.
 */
require_once get_parent_theme_file_path( 'inc/jetpack.php' );

/**
 * Load Jetpack compatibility file.
 */
require_once get_parent_theme_file_path( 'inc/post-meta/layout-meta.php' );

/**
 * Load Setup
 */
require_once get_parent_theme_file_path( 'inc/setup.php' );
/**
 * Breadcrumbs
 */
require_once get_parent_theme_file_path( 'inc/breadcrumbs/loader.php' );

/**
 * wp_restaurant_option
 *
 * @since WP Restaurant 1.0
 * @return array
 */

function wp_restaurant_option( $id, $default = '' ) {
	$theme_mod_val = WP_Restaurant_Customizer_Framework::get_instance()->get( $id, $default );
	return ( $theme_mod_val ) ? $theme_mod_val : $default;
}

/**
 * wp_restaurant_excerpt_length
 *
 * excerpt lenth
 * @since WP Restaurant 1.0
 * @param [type] $length
 * @return integer
 */

function wp_restaurant_excerpt_length( $length ) {		
	if ( is_front_page() || is_home() ) :
		$length = wp_restaurant_option( 'home_page_content_length', absint(175) );
		return $length;
	endif;
	return 20;
}
add_filter( 'excerpt_length', 'wp_restaurant_excerpt_length', 11 );

/**
 * wp_restaurant_excerpt_more
 *
 * excerpt more link and label
 * @since WP Restaurant 1.0
 * @param [string] $more
 * @return string
 */

function wp_restaurant_excerpt_more( $more ) {	
	/* translators: 1: url, 2: read more label */	
	return sprintf( __( '<a href="%1$s" class="read-more-link">%2$s;</a>', 'wp-restaurant' ), esc_url( get_permalink( get_the_ID() ) ),  __( ' Read More &raquo', 'wp-restaurant' ) ); 
}
add_filter( 'excerpt_more', 'wp_restaurant_excerpt_more' );

/**
 * wp_restaurant_menu_right_fallback
 * 
 * Fallback menu is not chosen
 *
 * @since WP Restaurant 1.0
 * @return void
 */
function wp_restaurant_menu_right_fallback() {
	?>
	<div class="steak-house-navigation alignright">
		<ul id="menu-right-menu" class="menu">
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) );?>"><?php esc_html_e( 'Home', 'wp-restaurant' );?></a>
			</li>
			<li>
				<a href="<?php echo esc_url( admin_url( '/nav-menus.php' ) );?>"><?php esc_html_e( 'Menu', 'wp-restaurant' );?></a>
			</li>
		</ul>
	</div>
	<?php
}

/**
 * wp_restaurant_menu_left_fallback
 * 
 * Fallback menu is not chosen
 *
 * @since WP Restaurant 1.0
 * @return void
 */
function wp_restaurant_menu_left_fallback() {
?>
	<div class="steak-house-navigation alignleft">
		<ul id="menu-left-menu" class="menu">
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) );?>"><?php esc_html_e( 'Home', 'wp-restaurant' );?></a>
			</li>
			<li>
				<a href="<?php echo esc_url( admin_url( '/customize.php' ) );?>"><?php esc_html_e( 'Menu', 'wp-restaurant' );?></a>
			</li>
		</ul>
	</div>	
	<?php
}

/**
 * wp_restaurant_get_menu_page_template_link
 * 
 * function to determine which template is being used by page
 *
 * @since WP Restaurant 1.0
 * @return integer page_id
 */
function wp_restaurant_get_menu_page_template_link() {
	$pages = get_pages( array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'templates/menu-page.php'
					)
				);
	$page_id = false;			
	foreach($pages as $page){
		$page_id =  $page->ID;
		break;
	}
	/* if polylang is activated */
	if( defined( 'POLYLANG_FILE' ) ) {
		$page_id = pll_get_post( $page_id, pll_current_language() );
	}			
	return $page_id;
}
/**
 * wp_restaurant_no_section_added_func
 * 
 * function to determine which template is being used by page
 *
 * @since WP Restaurant 1.0
 * @return void
 */

function wp_restaurant_no_section_added_func() {
	?>
	<section class="cs-no-content" style="margin-top:250px;">
		<i class="fa fa-info-circle"></i>
	   <p><?php 
	/* translators: 1: break tag */	   
	   printf( esc_html__( 'All Section are based on pages. Enable each Section from Customizer:%s for Banner: Home Template->Banner->Show Banner Image. likewise to other sections', 'wp-restaurant'), '<br />' );?>
	   </p>
       <a href="<?php echo esc_url( admin_url('customize.php') );?>"><?php esc_html_e( 'Goto Customizer','wp-restaurant' );?></a>
   </section>
	<?php
}
add_action( 'wp_restaurant_no_section_added', 'wp_restaurant_no_section_added_func' );
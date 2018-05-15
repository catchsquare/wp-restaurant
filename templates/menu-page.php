<?php
/**
 * Template Name: Menu Page
 *
 * Template for displaying menu template page
 * 
 * @package restaurant
 * @since WP Restaurant 1.0
 */
get_header(); ?>

<?php
if ( class_exists( 'Nova_Restaurant' ) ) {
	Nova_Restaurant::init( array(
		'menu_tag'               => 'section',
		'menu_class'             => 'menu-items',
		'menu_header_tag'        => 'header',
		'menu_header_class'      => 'menu-group-header',
		'menu_title_tag'         => 'h2',
		'menu_title_class'       => 'menu-group-title',
		'menu_description_tag'   => 'div',
		'menu_description_class' => 'menu-group-description',
	) );
	
}
?>

	<div class="menu-background-image">
	</div>

	<div id="primary" class="content-area menu-page">

		<main id="main" class="site-main" role="main">


			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

			<?php if ( class_exists( 'Jetpack' ) ) : ?>
			
				<?php
					$loop = new WP_Query( array( 'post_type' => 'nova_menu_item', 'post_status' => 'publish' ) );
					while ( $loop->have_posts() ) : $loop->the_post();
						get_template_part( 'template-parts/content', 'menu' );
					endwhile; // End of the Menu Item Loop. ?>
				<?php wp_reset_postdata(); ?>
			
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();

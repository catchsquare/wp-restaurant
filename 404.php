<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Restaurant
 * @since WP Restaurant 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area error-container">
		<main id="main" class="site-main" role="main">
			<div class="not-found-page">
				<div class="not-found-content">
					<h1><?php esc_html_e('404','wp-restaurant');?></h1>
					<span><?php esc_html_e('Page Not Found','wp-restaurant');?></span>
				</div>
			</div>
			
			<?php get_search_form(); ?>
			<div class="clear"></div>			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

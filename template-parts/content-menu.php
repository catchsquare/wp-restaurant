<?php
/**
 * Template part for displaying a  posts of emnu cpt
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Restaurant
 * @since WP Restaurant 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'menu-item' ); ?>>
	<div class="menu-entry-wrapper">
		<header class="entry-header">
			<h3 class="entry-title"><?php the_title(); ?></h3>
			<?php $price = get_post_meta( $post->ID, 'nova_price', true ); ?>
			<?php if ( ! empty( $price ) ) : ?>
				<span class="menu-price"><?php echo esc_html( $price ); ?></span>
			<?php endif; ?>
			<div class="clear"></div>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-restaurant' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php
				$terms = wp_get_object_terms( $post->ID, 'nova_menu_item_label' );
				if ( ! empty ( $terms ) && ! is_wp_error( $terms ) ) :
				?>
				<span class="menu-labels">
					<?php
						foreach( $terms as $term ) {
							$term_name = $term->name;
							$term_slug = $term->slug;
							echo '<span class="' . esc_attr( $term_slug ) .'">' . esc_html( $term_name ) . '</span>';
						}
					?>
				</span>
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</div> <!-- .menu-entry-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->

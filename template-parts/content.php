<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP Restaurant
 * @since WP Restaurant 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php wp_restaurant_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php 
	if ( is_singular() ) {
		$restaurant_single_post_image_align = wp_restaurant_option( 'single-page-image-position', 'no-image' );

		$restaurant_single_post_image_align_meta = get_post_meta( $post->ID, 'restaurant-single-post-image-align', true );
		if( false != $restaurant_single_post_image_align_meta ){
			$restaurant_single_post_image_align = $restaurant_single_post_image_align_meta;
		}
		
		$post_image_size = false;
		
		if( 'full' == $restaurant_single_post_image_align ){
			$post_image_size = 'wp-restaurant-post-image-full';
		} else if( 'left' == $restaurant_single_post_image_align || 'right' == $restaurant_single_post_image_align ) {
			$post_image_size = 'wp-restaurant-post-image-side';
		} 
		
		if ( has_post_thumbnail() && 'no-image' !=  $restaurant_single_post_image_align ):
			?>
			<figure class="image-<?php echo esc_attr( $restaurant_single_post_image_align );?>">
				<?php the_post_thumbnail( $post_image_size ); ?>
			</figure>
			<?php
		endif;
	}
	?>	
	<div class="entry-content">
		<?php
			if ( is_single() ) : 
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'wp-restaurant' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
			else:
				the_excerpt();
			endif;			

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-restaurant' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php wp_restaurant_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

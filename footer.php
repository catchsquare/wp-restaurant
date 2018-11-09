<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Restaurant
 * @since WP Restaurant 1.0
 */

?>
<?php do_action('wp_restaurant_blog_content_end' ); ?>
</div> <!-- content -->


<footer id="footer">
<!-- restaurant footer sidebar start -->
	<?php do_action( 'wp_restaurant_footer_sidebar' ); ?>		
<!--  restaurant footer sidebar end -->

<!-- resturant footer text start -->
	<?php do_action( 'wp_restaurant_footer_text' ); ?>
<!-- resturant footer text end -->

</footer>

<?php wp_footer(); ?>

</body>
</html>

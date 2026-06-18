<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _it_start
 */
$logo          = get_field( 'logo', 'option' );
$enable_to_top = get_field( 'enable_to_top', 'option' );
?>

</main><!-- /.site-content -->

<footer class="site-footer">
	<div class="container">
		<?php if ( $logo ) : ?>
			<a href="<?php echo home_url(); ?>" class="site-logo" rel="home">
				<?php echo wp_get_attachment_image( $logo, 'medium' ); ?>
			</a>
		<?php endif; ?>

		<?php wp_nav_menu( array(
			'theme_location'  => 'footer',
			'container_class' => 'footer-links__container',
			'menu_class'      => 'footer-links',
			'fallback_cb'     => false
		) ); ?>

		<?php get_template_part( 'template-parts/socials' ); ?>
	</div>

	<div class="site-footer__copyright">
		<div class="container">
			<span>&copy; <?php echo date( 'Y' ) ?> <?php esc_html_e( 'All rights reserved', '_it_start' ); ?></span>
		</div>
	</div>
</footer>

<?php get_template_part( 'template-parts/svg' ); ?>

<?php if ( $enable_to_top && ! is_404() ) : ?>
	<a id="to-top" href="#top">
		<svg>
			<use xlink:href="#angle-up"></use>
		</svg>
		<span class="screen-reader-text"><?php esc_html_e( 'Scroll to top', '_it_start' ); ?></span>
	</a>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>

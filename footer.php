<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _iag
 */
$logo          	      = get_field( 'footer_logo', 'option' ) ?? false;
$enable_top_menu      = get_field( 'enable_footer_top_menu', 'option' ) ?? false;
$enable_bottom_menu   = get_field( 'enable_footer_bottom_menu', 'option' ) ?? false;
$enable_contacts_menu = get_field( 'enable_footer_contacts_menu', 'option' ) ?? false;
?>

</main><!-- /.site-content -->

<footer class="site-footer">
	<div class="container">
		<?php if ( $enable_top_menu ) : ?>
		<?php wp_nav_menu( array(
			'theme_location'  => 'footer-top',
			'container_class' => 'site-footer__top',
			'menu_class'      => 'footer-links',
			'fallback_cb'     => false
		) ); ?>
		<?php endif; ?>
		<div class="site-footer__middle">
			<div class="row">
				<?php if ( $logo ) : ?>
					<div class="col-4">
						<a href="<?php echo home_url(); ?>" class="site-footer__logo" rel="home">
							<?php echo wp_get_attachment_image( $logo, 'full' ); ?>
						</a>
						<?php get_template_part( 'template-parts/socials' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $enable_contacts_menu && have_rows( 'contacts_list', 'option' ) ) : ?>
					<div class="col-4">
						<div class="site-footer__contacts">
							<?php while ( have_rows( 'contacts_list', 'option' ) ) : the_row();
								$type 		  = get_sub_field( 'contact_type' ) ?? false;
								$phone 		  = $type == 'phone' ? get_sub_field( 'phone' ) : false;
								$email 		  = $type == 'email' ? get_sub_field( 'email' ) : false;
								$address 	  = $type == 'address' ? get_sub_field( 'address_title' ) : false;
								$address_url  = $type == 'address' ? get_sub_field( 'address_url' ) : false; ?>

								<?php if ( $type == 'phone' && $phone ) : ?>
									<?php $clean_phone = it_phone_cleaner( $phone ); ?>
									<a class="contact-link" href="tel:<?php echo $clean_phone; ?>">
										<svg class="svg-icon"><use xlink:href="#<?php echo $type; ?>"></use></svg>
										<?php echo esc_html( $phone ); ?>
									</a>
								<?php endif; ?>
								<?php if ( $type == 'email' && $email ) : ?>
									<a class="contact-link" href="mailto:<?php echo esc_attr( $email ); ?>">
										<svg class="svg-icon"><use xlink:href="#<?php echo $type; ?>"></use></svg>
										<?php echo esc_html( $email ); ?>
									</a>
								<?php endif; ?>
								<?php if ( $type == 'address' && $address && $address_url ) : ?>
									<a class="contact-link" href="<?php echo esc_attr( $address_url ); ?>">
										<svg class="svg-icon"><use xlink:href="#<?php echo $type; ?>"></use></svg>
										<?php echo esc_html( $address ); ?>
									</a>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $enable_bottom_menu ) : ?>
					<div class="col-4">
						<?php wp_nav_menu( array(
							'theme_location'  => 'footer-bottom',
							'container_class' => 'site-footer__menu',
							'menu_class'      => 'footer-links',
							'fallback_cb'     => false
						) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		

		<div class="site-footer__bottom">
			<div class="site-footer__bottom-copyright">
				<span>&copy; <?php echo date( 'Y' ) ?> <?php esc_html_e( 'All rights reserved', '_iag' ); ?></span>
			</div>
			<?php wp_nav_menu( array(
				'theme_location'  => 'footer-copyright',
				'container_class' => 'site-footer__bottom-menu',
				'menu_class'      => 'footer-links',
				'fallback_cb'     => false
			) ); ?>
		</div>
	</div>

</footer>

<?php get_template_part( 'template-parts/svg' ); ?>

<?php wp_footer(); ?>

</body>
</html>

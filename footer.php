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
$logo          	        = get_field( 'footer_logo', 'option' ) ?? false;
$logo_description 	    = get_field( 'footer_logo_description', 'option' ) ?? false;
$enable_top_menu        = get_field( 'enable_footer_top_menu', 'option' ) ?? false;
$modal_cf_header        = get_field( 'header_cta_cf', 'option' ) ?? false;
$modal_cf_id            = $modal_cf_header ? $modal_cf_header->ID : false;
$modal_cf_title 		= $modal_cf_header ? get_the_title( $modal_cf_header->ID ) : false;
$enable_footer_column_1 = get_field( 'enable_footer_column_1_menu', 'option' ) ?? false;
$enable_footer_column_2 = get_field( 'enable_footer_column_2_menu', 'option' ) ?? false;
$enable_footer_column_3 = get_field( 'enable_footer_column_3_menu', 'option' ) ?? false;
$enable_footer_contacts = get_field( 'enable_footer_contacts_menu', 'option' ) ?? false;
?>

</main>

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
		<div class="site-footer__content">
			<?php if ( $logo ) : ?>
				<div class="site-footer__content-logo">
					<a href="<?php echo home_url(); ?>" class="site-footer__logo" rel="home">
						<?php echo wp_get_attachment_image( $logo, 'full' ); ?>
					</a>
					<?php if ( $logo_description ) : ?>
						<span class="site-footer__content-logo__description">
							<?php echo esc_html( $logo_description ); ?>
						</span>
					<?php endif; ?>
					<?php get_template_part( 'template-parts/socials' ); ?>
				</div>
			<?php endif; ?>
			<div class="site-footer__content-menus">
				<?php if ( $enable_footer_column_1 ) : ?>
					<?php wp_nav_menu( array(
						'theme_location'  => 'footer-column-1',
						'container_class' => 'footer-menu',
						'menu_class'      => 'footer-menu__links',
						'fallback_cb'     => false
					) ); ?>
				<?php endif; ?>
				<?php if ( $enable_footer_column_2 ) : ?>
					<?php wp_nav_menu( array(
						'theme_location'  => 'footer-column-2',
						'container_class' => 'footer-menu',
						'menu_class'      => 'footer-menu__links',
						'fallback_cb'     => false
					) ); ?>
				<?php endif; ?>
				<?php if ( $enable_footer_column_3 ) : ?>
					<?php wp_nav_menu( array(
						'theme_location'  => 'footer-column-3',
						'container_class' => 'footer-menu',
						'menu_class'      => 'footer-menu__links',
						'fallback_cb'     => false
					) ); ?>
				<?php endif; ?>
				<?php if ( $enable_footer_contacts && have_rows( 'contacts_list', 'option' ) ) : ?>
					<div class="footer-menu footer-menu__contacts">
						<div class="footer-menu__links">
							<div class="menu-item column-title">
								<a href="#" target='_blank'>
									<?php echo _e( 'Contacts', '_iag' ); ?>
								</a>
							</div>
	
							<?php while ( have_rows( 'contacts_list', 'option' ) ) : the_row();
								$type 		  = get_sub_field( 'contact_type' ) ?? false;
								$phone 		  = $type == 'phone' ? get_sub_field( 'phone' ) : false;
								$email 		  = $type == 'email' ? get_sub_field( 'email' ) : false;
								$address 	  = $type == 'address' ? get_sub_field( 'address_title' ) : false;
								$address_url  = $type == 'address' ? get_sub_field( 'address_url' ) : false; ?>
		
								<?php if ( $type === 'phone' && $phone ) : ?>
									<?php $clean_phone = it_phone_cleaner( $phone ); ?>
									<div class="menu-item">
										<a class="contact-link" href="tel:<?php echo $clean_phone; ?>">
											<?php echo esc_html( $phone ); ?>
										</a>
									</div>
								<?php endif; ?>
								<?php if ( $type === 'email' && $email ) : ?>
									<div class="menu-item">
										<a class="contact-link" href="mailto:<?php echo esc_attr( $email ); ?>">
											<?php echo esc_html( $email ); ?>
										</a>
									</div>
								<?php endif; ?>
								<?php if ( $type === 'address' && $address && $address_url ) : ?>
									<div class="menu-item">
										<a class="contact-link" href="<?php echo esc_attr( $address_url ); ?>" target="_blank">
											<?php echo esc_html( $address ); ?>
										</a>
									</div>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
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

<?php if ( $modal_cf_header && $modal_cf_id && $modal_cf_title ) : ?>
	<div id="contact" class="modal modal--contact">

		<div class="modal__overlay"></div>

		<div class="modal__inner">

			<div class="modal__content bg-white">

				<div class="modal__close js-modal-close" aria-label="Close modal">
					<svg>
						<use xlink:href="#close"></use>
					</svg>
				</div>

				<div class="contact-form__wrapper">
					<h2 class="contact-form__title">
						<?php _e( 'Submit RFP', '_iag' ); ?>
					</h2>
					<?php echo do_shortcode( '[contact-form-7 id="'.$modal_cf_id.'" title="'.$modal_cf_title.'"]' ); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>

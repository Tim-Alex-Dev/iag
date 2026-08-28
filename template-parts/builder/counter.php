<?php
$module_id     = get_sub_field('module_id') ?: '';
$color_theme   = get_sub_field( 'color_theme' ) ?: 'white';
$is_gallery    = get_sub_field('icons_type') === 'gallery' ? true : false;
$is_slider     = get_sub_field('icons_type') === 'slider' ? true : false;
$content_title = ( $is_gallery || $is_slider ) ? get_sub_field('content_title') : false;
?>


<section id="<?php echo esc_attr($module_id); ?>" class="module m-counter bg-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">
		<?php if ( have_rows( 'counter_list' ) ) : ?>
			<div class="m-counter__list">
				<?php while ( have_rows( 'counter_list' ) ) : the_row();
					$is_animated   = get_sub_field( 'animated_counter' ) ?? false;
					$item_title    = get_sub_field( 'counter_item_title' ) ?? false;
					$item_subtitle = get_sub_field( 'counter_item_subtitle' ) ?? false; ?>

					<?php if ( $item_title ) : ?>
						<div class="counter-item<?php echo $is_animated ? ' animated-item' : ''; ?>">
							<div class="counter-item__title" data-counter="<?php echo esc_attr( $item_title ); ?>">
								<?php echo esc_html( $is_animated ? '0' : $item_title ); ?>
							</div>

							<?php if ( $item_subtitle ) : ?>
								<div class="counter-item__subtitle">
									<?php echo esc_html( $item_subtitle ); ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>

		<?php if ( $is_gallery && have_rows( 'icons_list' ) ) : ?>
			<div class="m-counter__gallery">
				<?php if ( $content_title ) : ?>
					<span class="m-counter__gallery-title">
						<?php echo esc_html( $content_title ); ?>
					</span>
				<?php endif; ?>

				<div class="m-counter__gallery-list">
					<?php while ( have_rows( 'icons_list' ) ) : the_row();
						$icon_id    = get_sub_field( 'icon' ) ?? false;
						$icon_title = get_sub_field( 'icon_title' ) ?? false; ?>

						<?php if ( $icon_id ) : ?>
							<div class="icon-item">
								<div class="icon-item__image">
									<?php echo wp_get_attachment_image( $icon_id, 'thumbnail', false, [ 'class' => 'icon-item__image-icon' ] ); ?>
								</div>
								<?php if ( $icon_title ) : ?>
									<span class="icon-item__title">
										<?php echo esc_html( $icon_title ); ?>
									</span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $is_slider && have_rows( 'icons_list' ) ) : ?>
			<div class="m-counter__slider">
				<?php if ( $content_title ) : ?>
					<span class="m-counter__slider-title">
						<?php echo esc_html( $content_title ); ?>
					</span>
				<?php endif; ?>

				<div class="m-counter__slider-swiper swiper is-centered">
					<div class="swiper-wrapper">
						<?php while ( have_rows( 'icons_list' ) ) : the_row();
							$icon_id    = get_sub_field( 'icon' ) ?? false;
							$icon_title = get_sub_field( 'icon_title' ) ?? false; ?>

							<?php if ( $icon_id ) : ?>
								<div class="m-counter__slider-slide swiper-slide">
									<div class="slide-image">
										<?php echo wp_get_attachment_image( $icon_id, 'thumbnail', false, [ 'class' => 'slide-image__img' ] ); ?>
									</div>

									<?php if ( $icon_title ) : ?>
										<span class="slide-title">
											<?php echo esc_html( $icon_title ); ?>
										</span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
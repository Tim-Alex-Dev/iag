<?php
$module_id        = get_sub_field('module_id') ?: '';
$is_slider        = get_sub_field('slider') ?? false;
$slider_title     = get_sub_field('slider_title') ?? false;
?>


<section id="<?php echo esc_attr($module_id); ?>" class="module m-counter">
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
		<?php if ( $is_slider && have_rows( 'slider_list' ) ) : ?>
			<div class="m-counter__slider">
				<?php if ( $slider_title ) : ?>
					<div class="m-counter__slider-title">
						<?php echo esc_html( $slider_title ); ?>
					</div>
				<?php endif; ?>

				<div class="m-counter__slider-swiper swiper is-centered">
					<div class="swiper-wrapper">
						<?php while ( have_rows( 'slider_list' ) ) : the_row();
							$slide_image = get_sub_field( 'slider_image' ) ?? false;
							$slide_title = get_sub_field( 'slider_title' ) ?? false; ?>

							<?php if ( $slide_image ) : ?>
								<div class="m-counter__slider-slide swiper-slide">
									<div class="slide-image">
										<?php echo wp_get_attachment_image( $slide_image, 'thumbnail', false, [ 'class' => 'slide-image__img' ] ); ?>
									</div>

									<?php if ( $slide_title ) : ?>
										<span class="slide-title">
											<?php echo esc_html( $slide_title ); ?>
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
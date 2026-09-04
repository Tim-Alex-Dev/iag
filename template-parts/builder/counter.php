<?php

$module_id    = get_sub_field( 'module_id' ) ?: '';
$color_theme  = get_sub_field( 'color_theme' ) ?: 'white';
$content_type = get_sub_field( 'content_type' ) ?: 'global';

$is_global = $content_type === 'global';

/**
 * Counter list
 * Assuming this field name is the same for Custom and Global.
 */
$counter_list = $is_global
	? get_field( 'counter_list', 'option' )
	: get_sub_field( 'counter_list' );

/**
 * Icons settings
 */
$icons_type = $is_global
	? get_field( 'counter_icons_type', 'option' )
	: get_sub_field( 'icons_type' );

$content_title = $is_global
	? get_field( 'counter_content_title', 'option' )
	: get_sub_field( 'content_title' );

$icons_list = $is_global
	? get_field( 'counter_icons_list', 'option' )
	: get_sub_field( 'icons_list' );

$counter_list = $counter_list ?: [];
$icons_list   = $icons_list ?: [];

$is_gallery = $icons_type === 'gallery';
$is_slider  = $icons_type === 'slider';

$content_title = ( $is_gallery || $is_slider )
	? $content_title
	: false;
?>

<section
	id="<?php echo esc_attr( $module_id ); ?>"
	class="module m-counter bg-<?php echo esc_attr( $color_theme ); ?>"
>
	<div class="container">

		<?php if ( $counter_list ) : ?>
			<div class="m-counter__list">
				<?php foreach ( $counter_list as $counter_item ) :
					$is_animated   = $counter_item['animated_counter'] ?? false;
					$item_title    = $counter_item['counter_item_title'] ?? false;
					$item_subtitle = $counter_item['counter_item_subtitle'] ?? false;
					?>

					<?php if ( $item_title ) : ?>
						<div class="counter-item<?php echo $is_animated ? ' animated-item' : ''; ?>">

							<div
								class="counter-item__title"
								data-counter="<?php echo esc_attr( $item_title ); ?>"
							>
								<?php echo esc_html( $is_animated ? '0' : $item_title ); ?>
							</div>

							<?php if ( $item_subtitle ) : ?>
								<div class="counter-item__subtitle">
									<?php echo esc_html( $item_subtitle ); ?>
								</div>
							<?php endif; ?>

						</div>
					<?php endif; ?>

				<?php endforeach; ?>
			</div>
		<?php endif; ?>


		<?php if ( $is_gallery && $icons_list ) : ?>
			<div class="m-counter__gallery">

				<?php if ( $content_title ) : ?>
					<span class="m-counter__gallery-title">
						<?php echo esc_html( $content_title ); ?>
					</span>
				<?php endif; ?>

				<div class="m-counter__gallery-list">

					<?php foreach ( $icons_list as $icon_item ) :
						$icon_id    = $icon_item['icon'] ?? false;
						$icon_title = $icon_item['icon_title'] ?? false;
						?>

						<?php if ( $icon_id ) : ?>
							<div class="icon-item">

								<div class="icon-item__image">
									<?php
									echo wp_get_attachment_image(
										$icon_id,
										'thumbnail',
										false,
										[
											'class' => 'icon-item__image-icon',
										]
									);
									?>
								</div>

								<?php if ( $icon_title ) : ?>
									<span class="icon-item__title">
										<?php echo esc_html( $icon_title ); ?>
									</span>
								<?php endif; ?>

							</div>
						<?php endif; ?>

					<?php endforeach; ?>

				</div>
			</div>
		<?php endif; ?>


		<?php if ( $is_slider && $icons_list ) : ?>
			<div class="m-counter__slider">

				<?php if ( $content_title ) : ?>
					<span class="m-counter__slider-title">
						<?php echo esc_html( $content_title ); ?>
					</span>
				<?php endif; ?>

				<div class="m-counter__slider-swiper swiper is-centered">
					<div class="swiper-wrapper">

						<?php foreach ( $icons_list as $icon_item ) :
							$icon_id    = $icon_item['icon'] ?? false;
							$icon_title = $icon_item['icon_title'] ?? false;
							?>

							<?php if ( $icon_id ) : ?>
								<div class="m-counter__slider-slide swiper-slide">

									<div class="slide-image">
										<?php
										echo wp_get_attachment_image(
											$icon_id,
											'thumbnail',
											false,
											[
												'class' => 'slide-image__img',
											]
										);
										?>
									</div>

									<?php if ( $icon_title ) : ?>
										<span class="slide-title">
											<?php echo esc_html( $icon_title ); ?>
										</span>
									<?php endif; ?>

								</div>
							<?php endif; ?>

						<?php endforeach; ?>

					</div>
				</div>

			</div>
		<?php endif; ?>

	</div>
</section>
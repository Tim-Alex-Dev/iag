<?php

$module_id    = it_id_attr( get_sub_field( 'module_id' ) ); // ' id="..."' or ''
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
 * Global counters always show the icons as a gallery.
 */
$icons_type = $is_global
	? 'gallery'
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

$content_title = $is_gallery
	? $content_title
	: false;
?>

<section<?php echo $module_id; ?>
	class="module m-counter bg-<?php echo esc_attr( $color_theme ); ?>"
>
	<div class="container">

		<?php if ( $counter_list ) : ?>
			<div class="m-counter__list">
				<?php foreach ( $counter_list as $counter_item ) :
					$is_animated   = $counter_item['animated_counter'] ?? false;
					$item_title    = $counter_item['counter_item_title'] ?? false;
					$item_subtitle = $counter_item['counter_item_subtitle'] ?? false; ?>

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
						$icon_url   = $icon_item['icon_url'] ?? false; ?>

						<?php if ( $icon_id ) : ?>
							<?php if ( $icon_url ) : ?>
								<a class="icon-item icon-item-url" href="<?php echo esc_url( $icon_url ); ?>">
							<?php else : ?>
								<div class="icon-item">
							<?php endif; ?>

								<div class="icon-item__image">
									<?php echo wp_get_attachment_image(
										$icon_id,
										'thumbnail',
										false,
										[
											'class' => 'icon-item__image-icon',
										]
									); ?>
								</div>

								<?php if ( $icon_title ) : ?>
									<span class="icon-item__title">
										<?php echo esc_html( $icon_title ); ?>
									</span>
								<?php endif; ?>

							<?php if ( $icon_url ) : ?>
								</a>
							<?php else : ?>
								</div>
							<?php endif; ?>

						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php
$field_group = isset( $args['field_group'] ) ? $args['field_group'] : 'images';
$image_ids   = get_sub_field( $field_group );
$count       = count( $image_ids );
?>
<?php if ( $image_ids ) : ?>
	<?php if ( $count > 1 ) : ?>

		<div class="swiper swiper-images">
			<div class="swiper-wrapper">
				<?php foreach ( $image_ids as $image_id ): ?>
					<div class="swiper-slide">
						<div class="c-image">
							<?php echo wp_get_attachment_image( $image_id, 'large', false, [ 'class' => 'img-cover' ] ); ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev">
				<svg>
					<use xlink:href="#angle-left"></use>
				</svg>
			</div>
			<div class="swiper-button-next">
				<svg>
					<use xlink:href="#angle-right"></use>
				</svg>
			</div>
		</div>

	<?php else : ?>

		<div class="c-image">
			<?php echo wp_get_attachment_image( $image_ids[0], 'large' ); ?>
		</div>

	<?php endif; ?>
<?php endif; ?>

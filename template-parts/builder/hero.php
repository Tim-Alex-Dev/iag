<?php
$text             = get_sub_field( 'text' );
$bg_type          = get_sub_field( 'background_type' ); // possible values: image, video, color
$bg_overlay_color = get_sub_field( 'background_overlay_color' );
$bg_image         = get_sub_field( 'background_image' );
$bg_video         = get_sub_field( 'background_video' );
$bg_color         = get_sub_field( 'background_color' );
$bg_color_html    = 'color' === $bg_type ? 'style="background-color: ' . $bg_color . '"' : '';
?>
<section class="m-hero c-block"<?php echo $bg_color_html; ?>>
	<?php if ( 'image' === $bg_type && $bg_image ) : ?>
		<div class="m-hero__bg">
			<?php echo wp_get_attachment_image( $bg_image, 'full', false, [ 'class' => 'img-cover' ] ); ?>
		</div>
	<?php elseif ( 'video' === $bg_type && $bg_video ) : ?>
		<video class="m-hero__bg-video img-cover" src="<?php echo esc_url( $bg_video ); ?>" autoplay muted loop></video>
	<?php endif; ?>
	<?php if ( in_array( $bg_type, [ 'image', 'video' ] ) && $bg_overlay_color ) : ?>
		<div class="m-hero__bg-overlay" style="background-color: <?php echo esc_attr( $bg_overlay_color ); ?>"></div>
	<?php endif; ?>
	<div class="container">
		<div class="m-hero__content color-white">
			<div class="row">
				<div class="col-lg-8">
					<?php if ( $text ) : ?>
						<div class="editor"><?php echo wp_kses_post( $text ); ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

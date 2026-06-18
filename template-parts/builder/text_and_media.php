<?php
$order       = get_sub_field( 'order' ); // possible values: text_first, text_last
$bg_color    = get_sub_field( 'background_color' );
$extra_class = ! empty( $bg_color ) && '#FFFFFF' !== $bg_color ? ' c-block--padding' : '';
$media_type  = get_sub_field( 'media_type' ); // possible values: images, video
$text        = get_sub_field( 'text' );
?>
<section class="m-text-media c-block<?php echo $extra_class; ?>" style="background-color: <?php echo $bg_color; ?>">
	<div class="container">
		<div class="row <?php echo 'text_last' === $order ? 'flex-lg-row-reverse' : ''; ?>">
			<div class="col-lg-6">
				<?php if ( $text ) : ?>
					<div class="editor"><?php echo wp_kses_post( $text ); ?></div>
				<?php endif; ?>
			</div>
			<div class="col-lg-6">
				<?php get_template_part( 'template-parts/builder/components/' . $media_type ); // also 'field_group' can be passed as an argument, if custom field group's name was used. ?>
			</div>
		</div>
	</div>
</section>

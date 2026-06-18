<?php
$field_group = isset( $args['field_group'] ) ? $args['field_group'] : 'video';
$video_group = get_sub_field( $field_group )['video_group'];
?>
<?php if ( ! empty( $video_group ) ) : ?>
	<?php
	$type   = $video_group['type']; // possible values: embed, file
	$file   = $video_group['file'];
	$poster = $video_group['poster'];
	$embed  = $video_group['embed'];
	?>

	<?php if ( 'embed' === $type && $embed ) : ?>

		<?php echo $embed; ?>

	<?php elseif ( 'file' === $type && $file ) : ?>

		<?php if ( $poster ) : ?>
			<a class="c-video" data-fancybox="video" href="<?php echo esc_url( $file ); ?>">
				<span class="c-video__poster">
					<?php echo wp_get_attachment_image( $poster, 'large', false, [ 'class' => 'img-cover' ] ); ?>
					<svg><use xlink:href="#play-circle"></use></svg>
				</span>
			</a>
		<?php else: ?>
			<video class="c-video" src="<?php echo esc_url( $file ); ?>" controls></video>
		<?php endif; ?>

	<?php endif; ?>
<?php endif; ?>

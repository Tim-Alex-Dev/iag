<?php
/**
 * Video Box Component
 */

$type     = $args['type'] ?? 'file';
$video    = $args['video'] ?? '';
$banner   = $args['banner'] ?? false;
$category = $args['category'] ?? '';
$title    = $args['title'] ?? '';
$duration = $args['duration'] ?? '';
$class    = $args['class'] ?? '';
$video_id           = ( $type === 'file' && $video ) ? attachment_url_to_postid( $video ) : false;
$video_metadata     = $video_id ? wp_get_attachment_metadata( $video_id ) : false;
$video_duration     = $video_metadata ? $video_metadata['length_formatted'] : false;

if ( ! $video ) {
	return;
}

$classes = array_filter( [
	'video-box',
	'video-box-' . $type,
	$class,
] );

$class_attr = implode( ' ', $classes );
?>


<?php if ( $type === 'file' ) : ?>

	<?php if ( $banner ) : ?>

		<a class="<?php echo esc_attr( $class_attr ); ?>" data-fancybox="video" href="<?php echo esc_url( $video ); ?>">

			<?php echo wp_get_attachment_image( $banner, 'large', false, [ 'class' => 'video-box__banner' ] ); ?>

			<div class="video-box__controls">
				<svg><use xlink:href="#play-circle"></use></svg>
			</div>

			<?php if ( $category ) : ?>
				<span class="video-box__category">
					<?php echo esc_html( $category ); ?>
				</span>
			<?php endif; ?>

			<?php if ( $title || $duration ) : ?>
				<div class="video-box__footer">
					<?php if ( $title ) : ?>
						<span class="video-box__footer-title">
							<?php echo esc_html( $title ); ?>
						</span>
					<?php endif; ?>

					<?php if ( $video_duration ) : ?>
						<span class="video-box__footer-duration">
							<?php echo esc_html( $video_duration ); ?>
						</span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</a>
	<?php else : ?>

		<video class="<?php echo esc_attr( $class_attr ); ?>" src="<?php echo esc_url( $video ); ?>" controls playsinline preload="metadata"></video>

	<?php endif; ?>


<?php elseif ( $type === 'embed' ) : ?>

	<div class="<?php echo esc_attr( $class_attr ); ?>">
		<?php echo wp_oembed_get($video); ?>
	</div>

<?php endif; ?>
<?php
// Social links (Theme Settings): the icon links get the network name as their accessible name
$labels = [
	'facebook'  => 'Facebook',
	'instagram' => 'Instagram',
	'linkedin'  => 'LinkedIn',
	'twitter'   => 'X',
	'xing'      => 'XING',
	'youtube'   => 'YouTube',
];
?>
<?php if ( have_rows( 'socials_list', 'option' ) ) : ?>
	<div class="socials">
		<?php while ( have_rows( 'socials_list', 'option' ) ) : the_row();
			$name = get_sub_field( 'social_title' );
			$url  = get_sub_field( 'social_url' ); ?>

			<?php if ( $name ) : ?>
				<a class="socials__item" href="<?php echo esc_url( $url ) ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $labels[ $name ] ?? ucfirst( $name ) ); ?>">
					<svg class="icon-<?php echo esc_attr( $name ); ?>" aria-hidden="true">
						<use xlink:href="#<?php echo esc_attr( $name ); ?>"></use>
					</svg>
				</a>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
<?php endif; ?>

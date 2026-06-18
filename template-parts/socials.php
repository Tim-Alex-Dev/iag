<?php if ( have_rows( 'socials', 'option' ) ) : ?>
	<div class="socials">
		<?php while ( have_rows( 'socials', 'option' ) ) : the_row(); ?>
			<?php
			$name = get_sub_field( 'name' );
			$url  = get_sub_field( 'url' );
			?>
			<?php if ( $name ) : ?>
				<a class="socials__item" href="<?php echo esc_url( $url ) ?>" target="_blank" rel="nofollow">
					<svg class="icon-<?php echo esc_attr( $name ); ?>">
						<use xlink:href="#<?php echo esc_attr( $name ); ?>"></use>
					</svg>
				</a>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
<?php endif; ?>

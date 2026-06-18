<?php $count = ! empty( get_sub_field( 'columns' ) ) ? count( get_sub_field( 'columns' ) ) : 0; ?>
<?php if ( have_rows( 'columns' ) ) : ?>
	<section class="m-text-columns c-block">
		<div class="container">
			<div class="row">
				<?php while ( have_rows( 'columns' ) ) : the_row(); ?>
					<?php $text = get_sub_field( 'text' ); ?>
					<?php if ( $text ) : ?>
						<div class="<?php echo $count > 1 ? 'col-lg-6 col-xl' : 'col-12'; ?>">
							<div class="editor"><?php echo wp_kses_post( $text ); ?></div>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

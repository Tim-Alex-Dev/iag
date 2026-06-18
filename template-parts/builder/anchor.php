<?php $id = get_sub_field( 'anchor_id' ); ?>
<?php if ( $id ) : ?>
	<div class="anchor" id="<?php echo sanitize_title( $id ); ?>"></div>
<?php endif; ?>

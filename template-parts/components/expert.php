<?php $expert_id = $args['expert_id'] ?? false;
      $class     = $args['class'] ?? false;

if ( ! $expert_id ) {
    return;
}

$photo            = get_field( 'expert_photo', $expert_id );
$name             = get_field( 'expert_title', $expert_id );
$position         = get_field( 'expert_position', $expert_id );
$description      = get_field( 'expert_subtitle', $expert_id );
$permalink        = get_permalink( $expert_id );

$term         = null;
$primary_term = new WPSEO_Primary_Term( 'therapeutic-area', $expert_id );
$primary_id   = $primary_term->get_primary_term();

if ( ! is_wp_error( $primary_id ) && $primary_id ) {
	$term = get_term( $primary_id );
}

if ( ! $term || is_wp_error( $term ) ) {
	$terms = get_the_terms( $expert_id, 'therapeutic-area' );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$term = reset( $terms );
	}
}

if ( ! $name  ) {
    return;
}
?>


<div class="expert-card <?php echo esc_attr( $class ); ?>">
    <?php if ( $photo ) : ?>
        <div class="expert-card__photo">
            <?php echo wp_get_attachment_image( $photo, 'medium', false, [ 'class' => 'expert-card__photo-img', ] ); ?>
        </div>
    <?php endif; ?>

    <span class="expert-card__name">
        <?php echo esc_html( $name ); ?>
    </span>

    <?php if ( $position ) : ?>
        <span class="expert-card__position">
            <?php echo esc_html( $position ); ?>
        </span>
    <?php endif; ?>

    <?php if ( $description ) : ?>
        <div class="expert-card__description">
            <?php echo esc_html( $description ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $term ) : ?>
        <span class="expert-card__category">
            <?php echo esc_html( $term->name ); ?>
        </span>
    <?php endif; ?>
</div>
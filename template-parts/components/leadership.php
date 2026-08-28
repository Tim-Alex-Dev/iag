<?php $leadership_id = $args['leadership_id'] ?? false;
      $class         = $args['class'] ?? false;

if ( ! $leadership_id ) {
    return;
}

$photo            = get_field( 'leadership_photo', $leadership_id );
$name             = get_field( 'leadership_name', $leadership_id );
$position         = get_field( 'leadership_position', $leadership_id );
$description      = get_field( 'leadership_description', $leadership_id );
$permalink        = get_permalink( $leadership_id );
?>


<?php if ( $class === 'swiper-slide' ) : ?>
    <a class="leadership-card <?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $permalink ); ?>" target="_blank">
        <?php if ( $photo ) : ?>
            <div class="leadership-card__photo">
                <?php echo wp_get_attachment_image( $photo, 'medium', false, [ 'class' => 'leadership-card__photo-img', ] ); ?>
            </div>
        <?php endif; ?>
    
        <span class="leadership-card__name">
            <?php echo esc_html( $name ); ?>
        </span>
    
        <?php if ( $position ) : ?>
            <span class="leadership-card__position">
                <?php echo esc_html( $position ); ?>
            </span>
        <?php endif; ?>
    
        <?php if ( $description ) : ?>
            <div class="leadership-card__description">
                <?php echo esc_html( $description ); ?>
            </div>
        <?php endif; ?>
    </a>
<?php endif; ?>

<?php if ( $class === 'grid-element' ) : ?>
    <div class="leadership-card <?php echo esc_attr( $class ); ?>">
        <div class="leadership-card__header">
            <?php if ( $photo ) : ?>
                <div class="leadership-card__header-photo">
                    <?php echo wp_get_attachment_image( $photo, 'medium', false, [ 'class' => 'leadership-card__header-photo__img', ] ); ?>
                </div>
            <?php endif; ?>
            <div class="leadership-card__header-data">
                <span class="data-name">
                    <?php echo esc_html( $name ); ?>
                </span>
                <?php if ( $position ) : ?>
                    <span class="data-position">
                        <?php echo esc_html( $position ); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <?php if ( $description ) : ?>
            <div class="leadership-card__description">
                <?php echo esc_html( $description ); ?>
            </div>
        <?php endif; ?>

        <a class="btn btn-simple leadership-card__link" href="<?php echo esc_url( $permalink ); ?>" target="_blank">
            <?php echo _e( 'View Profile', '_iag' ); ?>
            <svg class="arrow-right"><use xlink:href="#arrow-right"></use></svg>
        </a>
    </div>
<?php endif; ?>

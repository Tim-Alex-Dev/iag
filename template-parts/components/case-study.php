<?php $case_id = $args['case_id'] ?? false;

if ( ! $case_id ) {
    return;
}

$case_title    = get_field( 'case_study_title', $case_id );
$case_category = get_field( 'case_study_category', $case_id );
$case_file     = get_field( 'case_study_file', $case_id );
$case_banner   = get_field( 'case_study_banner', $case_id );

if ( ! $case_title || ! $case_file ) {
    return;
}
?>

<div class="case-study-card">
    <?php if ( $case_banner ) : ?>
        <div class="case__banner">
            <?php echo wp_get_attachment_image( $case_banner, 'medium', false, [ 'class' => 'case__banner-img', ] ); ?>
        </div>
    <?php endif; ?>

    <div class="case__content">
        <?php if ( $case_category ) : ?>
            <div class="case__content-category">
                <?php echo esc_html( $case_category ); ?>
            </div>
        <?php endif; ?>
    
        <div class="case__content-title">
            <?php echo esc_html( $case_title ); ?>
        </div>        
    </div>

    <a class="case__button" href="<?php echo esc_url( wp_get_attachment_url( $case_file ) ); ?>" download target="_blank" rel="noopener">
        <?php esc_html_e( 'Download PDF', '_iag' ); ?>
        <svg class="icon">
            <use xlink:href="#arrow-bottom"></use>
        </svg>
    </a>
</div>
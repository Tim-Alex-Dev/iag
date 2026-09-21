<?php

$resource_id = $args['post_id'] ?? false;

if ( ! $resource_id ) {
    return;
}

$post_thumbnail    = get_field( 'post_thumbnail', $resource_id ) ?? false;
$post_banner       = $post_thumbnail ? $post_thumbnail : get_field( 'post_banner', $resource_id ) ?? false;
$post_title        = get_field( 'post_title', $resource_id ) ?? false;
$resource_date     = get_the_date( 'M j, Y', $resource_id );
$resource_link     = get_permalink( $resource_id );
$resource_category = get_primary_category( $resource_id );
?>

<div class="resource-post-card">
    <?php if ( $post_banner ) : ?>
        <div class="post-banner">
            <?php
            echo wp_get_attachment_image(
                $post_banner,
                'full',
                false,
                [ 'class' => 'post-banner__img' ]
            );
            ?>
        </div>
    <?php endif; ?>

    <div class="post-content">
        <?php if ( $resource_category ) : ?>
            <div class="post-content__category">
                <?php echo esc_html( $resource_category ); ?>
            </div>
        <?php endif; ?>

        <?php if ( $post_title ) : ?>
            <h3 class="post-content__title">
                <?php echo esc_html( $post_title ); ?>
            </h3>
        <?php endif; ?>

        <div class="post-content__details">
            <div class="post-date">
                <?php echo esc_html( $resource_date ); ?>
            </div>
        </div>
    </div>

    <a class="post-permalink" href="<?php echo esc_url( $resource_link ); ?>" target="_blank">
        <?php esc_html_e( 'Read More', '_iag' ); ?>
        <svg class="icon">
            <use xlink:href="#arrow-right"></use>
        </svg>
    </a>
</div>
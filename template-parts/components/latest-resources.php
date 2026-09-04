<?php

$category_id = $args['category_id'] ?? false;

$resource_query = [
    'post_type'      => 'resource',
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'fields'         => 'ids',
];

if ( $category_id ) {
    $resource_query['meta_query'] = [
        [
            'key'     => '_yoast_wpseo_primary_source',
            'value'   => $category_id,
            'compare' => '=',
            'type'    => 'NUMERIC',
        ],
    ];

    $resource_query['tax_query'] = [
        [
            'taxonomy'         => 'source',
            'field'            => 'term_id',
            'terms'            => $category_id,
            'include_children' => false,
        ],
    ];
}

$resource_ids = get_posts( $resource_query );

if ( ! $resource_ids ) {
    return;
}

$main_resource_id   = array_shift( $resource_ids );
$main_post_title    = get_field( 'post_title', $main_resource_id ) ?? false;
$main_post_subtitle = get_field( 'post_subtitle', $main_resource_id ) ?? false;
$main_post_banner   = get_field( 'post_banner', $main_resource_id ) ?? false;
$main_post_date     = get_the_date( 'M j, Y', $main_resource_id ) ?? false;
$main_post_link     = get_permalink( $main_resource_id ) ?? false;
$main_post_category = get_primary_category( $main_resource_id ) ?? false;
$posts_page_url     = get_permalink( get_option( 'page_for_posts' ) );
?>


<div class="c-latest-resources">
    <div class="c-latest-resources__header">
        <h2 class="c-latest-resources__header-title">
            <?php echo _e( 'Latest Resources', '_iag' ); ?>
        </h2>    
        <?php if ( !is_home() ) : ?>
            <a href="<?php echo esc_url( $posts_page_url ); ?>" class="btn btn-ghost c-latest-resources__header-button">
                <?php echo _e( 'View All Articles', '_iag' ); ?>
                <svg><use xlink:href="#arrow-right"></use></svg>
            </a>
        <?php endif; ?>
    </div>
    
    <div class="c-latest-resources__body">
        <div class="c-latest-resources__main">
            <?php if ( $main_post_banner ) : ?>
                <div class="main-post__banner">
                    <?php echo wp_get_attachment_image( $main_post_banner, 'full', false, [ 'class' => 'main-post__banner-img' ] ); ?>
                </div>
            <?php endif; ?>

            <div class="main-post__details">
                <?php if ( $main_post_category ) : ?>
                    <span class="main-post__details-category">
                        <?php echo esc_html( $main_post_category ); ?>
                    </span>
                <?php endif; ?>
                <?php if ( $main_post_date ) : ?>
                    <span class="main-post__details-date">
                        <?php echo esc_html( $main_post_date ); ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if ( $main_post_title ) : ?>
                <h3 class="h3 main-post__title">
                    <?php echo esc_html( $main_post_title ); ?>
                </h3>
            <?php endif; ?>

            <?php if ( $main_post_subtitle ) : ?>
                <p class="h3 main-post__subtitle">
                    <?php echo esc_html( $main_post_subtitle ); ?>
                </p>
            <?php endif; ?>

            <?php if ( $main_post_link ) : ?>
                <a class="btn btn-primary main-post__link" href="<?php echo esc_url( $main_post_link ); ?>" target="_blank">
                    <?php echo _e( 'Read the release notes', '_iag' ); ?>
                    <svg class="arrow-right"><use xlink:href="#angle-right"></use></svg>
                </a>
            <?php endif; ?>


        </div>

        <div class="c-latest-resources__list">
            <?php foreach ( $resource_ids as $resource_id ) :
                $resource_category = get_primary_category( $resource_id );
                $resource_title    = get_field( 'post_title', $resource_id );
                $resource_banner   = get_field( 'post_banner', $resource_id );
                $resource_date     = get_the_date( 'M j, Y', $resource_id );
                $resource_link     = get_permalink( $resource_id ); ?>

                <?php if ( $resource_title && $resource_banner ) : ?>
                    
                    <a class="list-post" href="<?php echo esc_url( $resource_link ); ?>" target="_blank">
                        <div class="list-post__banner">
                            <?php echo wp_get_attachment_image( $main_post_banner, 'full', false, [ 'class' => 'list-post__banner-img' ] ); ?>
                        </div>

                        <div class="list-post__content">
                            <?php if ( $resource_category ) : ?>
                                <span class="list-post__content-category">
                                    <?php echo esc_html( $resource_category ); ?>
                                </span>
                            <?php endif; ?>
                            <h4 class="h4 list-post__content-title">
                                <?php echo esc_html( $resource_title ); ?>
                            </h4>
                            <div class="list-post__content-details">
                                <?php if ( $resource_date ) : ?>
                                    <span class="list-post__content-details__date">
                                        <?php echo esc_html( $resource_date ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="list-post__icon">
                            <svg><use xlink:href="#arrow-right"></use></svg>
                        </div>
                    </a>

                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <?php get_template_part( 'template-parts/components/latest-next' ); ?>

</div>
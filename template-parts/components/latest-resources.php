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

$latest_webinar_id = get_posts(
    [
        'post_type'      => 'resource',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'fields'         => 'ids',
        'tax_query'      => [
            [
                'taxonomy' => 'source',
                'field'    => 'name',
                'terms'    => 'Webinar',
            ],
        ],
        'meta_query'     => [
            [
                'key'     => 'post_type',
                'value'   => 'webinar',
                'compare' => '=',
            ],
        ],
    ]
)[0] ?? false;

if ( $latest_webinar_id ) {
    $webinar_title     = get_field( 'post_title', $latest_webinar_id );
    $webinar_status    = get_field( 'webinar_status', $latest_webinar_id );
    $webinar_time      = get_field( 'webinar_time', $latest_webinar_id );
    $webinar_date      = get_field( 'webinar_date', $latest_webinar_id );
    $webinar_permalink = get_permalink( $latest_webinar_id );

    if ( $webinar_date ) {
        $date = DateTime::createFromFormat( 'F j, Y', $webinar_date );

        $webinar_day   = $date->format( 'j' );
        $webinar_month = $date->format( 'M' );
        $webinar_year  = $date->format( 'Y' );
    }
}

$latest_event_id = get_posts(
    [
        'post_type'      => 'resource',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'fields'         => 'ids',
        'tax_query'      => [
            [
                'taxonomy' => 'source',
                'field'    => 'name',
                'terms'    => 'Event',
            ],
        ],
        'meta_query'     => [
            [
                'key'     => 'post_type',
                'value'   => 'event',
                'compare' => '=',
            ],
        ],
    ]
)[0] ?? false;

if ( $latest_event_id ) {
    $event_title     = get_field( 'post_title', $latest_event_id );
    $event_location  = get_field( 'event_location', $latest_event_id );
    $event_time      = get_field( 'event_time', $latest_event_id );
    $event_date      = get_field( 'event_date', $latest_event_id );
    $event_permalink = get_permalink( $latest_event_id );

    if ( $event_date ) {
        $date = DateTime::createFromFormat( 'F j, Y', $event_date );

        $event_day   = $date->format( 'j' );
        $event_month = $date->format( 'M' );
        $event_year  = $date->format( 'Y' );
    }
}
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

    <div class="c-latest-resources__next">
        <span class="c-latest-resources__next-title">
            <svg class="icon"><use xlink:href="#calendar"></use></svg>
            <?php echo _e( 'Up Next', '_iag' ); ?>
        </span>

        <div class="c-latest-resources__next-grid">
            <?php if ( $latest_event_id ) : ?>
                <div class="next-post next-post__event">
                    <?php if ( $event_day || $event_month || $event_year ) : ?>
                        <div class="next-post__date">
                            <?php if ( $webinar_month ) : ?>
                                <span class="date-month">
                                    <?php echo esc_html( $event_month ); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( $webinar_day ) : ?>
                                <span class="date-day">
                                    <?php echo esc_html( $event_day ); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( $webinar_year ) : ?>
                                <span class="date-year">
                                    <?php echo esc_html( $event_year ); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
    
                    <div class="next-post__content">
                        <span class="content-label">
                            <?php echo _e( 'Next Event', '_iag' ); ?>
                        </span>
                        <h3 class="content-title">
                            <?php echo esc_html( $event_title ); ?>
                        </h3>
                        <div class="content-details">
                            <?php if ( $event_location ) : ?>
                                <span class="content-details__item">
                                    <?php echo esc_html( $event_location ); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( $event_time ) : ?>
                                <span class="content-details__item">
                                    <?php echo esc_html( $event_time . ' BST' ); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <a class="btn btn-simple content-link" href="#" target="_blank">
                            <?php echo _e( 'View Event', '_iag' ); ?>
                            <svg><use xlink:href="#arrow-right"></use></svg>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $latest_webinar_id ) : ?>
                <div class="next-post next-post__webinar">
                    <?php if ( $webinar_day || $webinar_month || $webinar_year ) : ?>
                        <div class="next-post__date">
                            <?php if ( $webinar_month ) : ?>
                                <span class="date-month">
                                    <?php echo esc_html( $webinar_month ); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( $webinar_day ) : ?>
                                <span class="date-day">
                                    <?php echo esc_html( $webinar_day ); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( $webinar_year ) : ?>
                                <span class="date-year">
                                    <?php echo esc_html( $webinar_year ); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="next-post__content">
                        <span class="content-label">
                            <?php echo _e( 'Next Webinar', '_iag' ); ?>
                        </span>
                        <h3 class="content-title">
                            <?php echo esc_html( $webinar_title ); ?>
                        </h3>
                        <div class="content-details">
                            <?php if ( $webinar_status ) : ?>
                                <span class="content-details__item">
                                    <?php echo esc_html( $webinar_status ); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( $webinar_time ) : ?>
                                <span class="content-details__item">
                                    <?php echo esc_html( $webinar_time . ' BST' ); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <a class="btn btn-simple content-link" href="#" target="_blank">
                            <?php echo _e( 'Register', '_iag' ); ?>
                            <svg><use xlink:href="#arrow-right"></use></svg>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
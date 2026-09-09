<?php

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
                'terms'    => 'Webinars',
            ],
        ],
        'meta_query' => [
            [
                'key'     => 'post_type',
                'value'   => 'webinar',
                'compare' => '=',
            ],
        ],
    ]
)[0] ?? false;

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
                'terms'    => 'Events',
            ],
        ],
        'meta_query' => [
            [
                'key'     => 'post_type',
                'value'   => 'event',
                'compare' => '=',
            ],
        ],
    ]
)[0] ?? false;

if ( ! $latest_webinar_id && ! $latest_event_id ) {
    return;
}


// Event
if ( $latest_event_id ) {
    $event_title     = get_field( 'post_title', $latest_event_id );
    $event_location  = get_field( 'event_location', $latest_event_id );
    $event_time      = get_field( 'event_time', $latest_event_id );
    $event_date      = get_field( 'event_date', $latest_event_id );
    $event_permalink = get_permalink( $latest_event_id );

    if ( $event_date ) {
        $date = DateTime::createFromFormat( 'F j, Y', $event_date );

        if ( $date ) {
            $event_day   = $date->format( 'j' );
            $event_month = $date->format( 'M' );
            $event_year  = $date->format( 'Y' );
        }
    }
}


// Webinar
if ( $latest_webinar_id ) {
    $webinar_title     = get_field( 'post_title', $latest_webinar_id );
    $webinar_status    = get_field( 'webinar_status', $latest_webinar_id );
    $webinar_time      = get_field( 'webinar_time', $latest_webinar_id );
    $webinar_date      = get_field( 'webinar_date', $latest_webinar_id );
    $webinar_permalink = get_permalink( $latest_webinar_id );

    if ( $webinar_date ) {
        $date = DateTime::createFromFormat( 'F j, Y', $webinar_date );

        if ( $date ) {
            $webinar_day   = $date->format( 'j' );
            $webinar_month = $date->format( 'M' );
            $webinar_year  = $date->format( 'Y' );
        }
    }
}
?>

<div class="c-latest-resources__next">
    <span class="c-latest-resources__next-title">
        <svg class="icon"><use xlink:href="#calendar"></use></svg>
        <?php _e( 'Up Next', '_iag' ); ?>
    </span>

    <div class="c-latest-resources__next-grid">

        <?php if ( $latest_event_id ) : ?>
            <div class="next-post next-post__event">

                <?php if ( $event_date ) : ?>
                    <div class="next-post__date">
                        <span class="date-month">
                            <?php echo esc_html( $event_month ); ?>
                        </span>
                        <span class="date-day">
                            <?php echo esc_html( $event_day ); ?>
                        </span>
                        <span class="date-year">
                            <?php echo esc_html( $event_year ); ?>
                        </span>
                    </div>
                <?php endif; ?>

                <div class="next-post__content">
                    <span class="content-label">
                        <?php _e( 'Next Event', '_iag' ); ?>
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

                    <a class="btn btn-simple content-link"
                       href="<?php echo esc_url( $event_permalink ); ?>">
                        <?php _e( 'View Event', '_iag' ); ?>
                        <svg><use xlink:href="#arrow-right"></use></svg>
                    </a>
                </div>
            </div>
        <?php endif; ?>


        <?php if ( $latest_webinar_id ) : ?>
            <div class="next-post next-post__webinar">

                <?php if ( $webinar_date ) : ?>
                    <div class="next-post__date">
                        <span class="date-month">
                            <?php echo esc_html( $webinar_month ); ?>
                        </span>
                        <span class="date-day">
                            <?php echo esc_html( $webinar_day ); ?>
                        </span>
                        <span class="date-year">
                            <?php echo esc_html( $webinar_year ); ?>
                        </span>
                    </div>
                <?php endif; ?>

                <div class="next-post__content">
                    <span class="content-label">
                        <?php _e( 'Next Webinar', '_iag' ); ?>
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

                    <a class="btn btn-simple content-link"
                       href="<?php echo esc_url( $webinar_permalink ); ?>">
                        <?php _e( 'View Webinar', '_iag' ); ?>
                        <svg><use xlink:href="#arrow-right"></use></svg>
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
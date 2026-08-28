<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
$resource_type    = get_sub_field( 'resource_type' ) ?? false;
$header_link      = get_sub_field( 'resources_page_link' ) ?? false;


if ( $resource_type === 'resource' ) {
    $resource_ids = get_posts(
        [
            'post_type'      => 'resource',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'fields'         => 'ids',

            'meta_query'     => [
                'relation' => 'OR',
                [
                    'key'     => 'post_type',
                    'compare' => 'NOT EXISTS',
                ],
                [
                    'key'     => 'post_type',
                    'value'   => [ 'webinar', 'event' ],
                    'compare' => 'NOT IN',
                ],
            ],
        ]
    );

    if ( ! $resource_ids ) {
        return;
    }

    $resource_id         = $resource_ids[0];
    $resource_label      = __( 'Latest News', '_iag' );
    $resource_link       = get_permalink( $resource_id );
    $resource_link_label = __( 'Learn More', '_iag' );
    $resource_status     = false;
    $resource_duration   = false;
    $resource_free       = false;
    $resource_price      = false;
    $resource_date       = false;
    $resource_time       = false;
    $resource_archive    = false;
    $archive_title       = false;
}

if ( $resource_type === 'webinar' ) {
    $resource_ids = get_posts(
        [
            'post_type'      => 'resource',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'fields'         => 'ids',

            'meta_query'     => [
                [
                    'key'     => 'post_type',
                    'value'   => 'webinar',
                    'compare' => '=',
                ],
            ],
        ]
    );

    if ( ! $resource_ids ) {
        return;
    }

    $resource_id         = $resource_ids[0];
    $resource_label      = __( 'Next Webinar', '_iag' );
    $resource_status     = get_field( 'webinar_status', $resource_id ) === 'online' ? __( 'Live', '_iag' ) : __( 'Offline', '_iag' ); 
    $resource_duration   = get_field( 'webinar_duration', $resource_id ) ?? false; 
    $resource_free       = get_field( 'free_webinar', $resource_id ) ?? false; 
    $resource_price      = $resource_free ? __( 'Free', '_iag' ) : get_field( 'webinar_price', $resource_id ); 
    $resource_date       = get_field( 'webinar_date', $resource_id ) ?? false; 
    $resource_time       = get_field( 'webinar_time', $resource_id ) ?? false; 
    $resource_link       = get_field( 'webinar_link', $resource_id ) ?? false;
    $resource_link_label = __( 'Register Now', '_iag' );
    $resource_archive    = get_term_link( 'webinar', 'source' );
    $archive_title       = __( 'View All Webinars', '_iag' );
}

if ( $resource_type === 'event' ) {
    $resource_ids = get_posts(
        [
            'post_type'      => 'resource',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'fields'         => 'ids',

            'meta_query'     => [
                [
                    'key'     => 'post_type',
                    'value'   => 'event',
                    'compare' => '=',
                ],
            ],
        ]
    );

    if ( ! $resource_ids ) {
        return;
    }

    $resource_id = $resource_ids[0];
    $resource_label    = __( 'Next Event', '_iag' );
    $resource_date     = get_field( 'event_date', $resource_id ) ?? false;
    $resource_time     = get_field( 'event_time', $resource_id ) ?? false;
    $resource_link     = get_field( 'event_url', $resource_id ) ?? false;
    $resource_link_label = __( 'Learn More', '_iag' );
    $resource_archive    = get_term_link( 'event', 'source' );
    $archive_title       = __( 'View All Events', '_iag' );
    $resource_status     = false; 
    $resource_duration   = false;
    $resource_free       = false;
    $resource_price      = false;
}

if ( $resource_id) {
    $resource_title    = get_field( 'post_title', $resource_id ) ?? false;
    $resource_subtitle = get_field( 'post_subtitle', $resource_id ) ?? false;
    $resource_banner   = get_field( 'post_banner', $resource_id ) ?? false;
    $resource_category = get_primary_category( $resource_id ) ?? false;
}
?>


<section id="<?php echo esc_attr($module_id); ?>" class="module m-latest bg-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">
        <div class="m-latest__header">
            <?php if ( $module_title || $module_subtitle || $module_uptitle ) : ?>
                <div class="module-header alignment-<?php echo esc_attr( $module_alignment ); ?>">
                    <?php if ( $module_uptitle ) : ?>
                        <span class="module-header__uptitle">
                            <?php echo esc_html( $module_uptitle ); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ( $module_title ) : ?>  
                        <?php get_template_part( 'template-parts/builder/components/title', null ); ?>
                    <?php endif; ?>
                    <?php if ( $module_subtitle ) : ?>
                        <p class="module-header__subtitle">
                            <?php echo esc_html( $module_subtitle ); ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( $header_link ) :
                $link_url = $header_link['url'];
                $link_title = $header_link['title'];
                $link_target = $header_link['target'] ? $header_link['target'] : '_self'; ?>
    
                <a class="btn btn-simple" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                    <?php echo esc_html( $link_title ); ?>
                    <svg><use xlink:href="#arrow-right"></use></svg>
                </a>
            <?php endif; ?>

        </div>
        
        <div class="m-latest__resource">
            <div class="m-latest__resource-banner">
                <?php echo wp_get_attachment_image( $resource_banner, 'full', false, [ 'class' => 'm-latest__resource-banner__img' ] ); ?>
            </div>
            <div class="resource-content">
                <div class="resource-content__header">
                    <?php if ( $resource_label ) : ?>
                        <span class="resource-label">
                            <?php echo esc_html( $resource_label ); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ( $resource_status ) : ?>
                        <span class="resource-elem">
                            <?php echo esc_html( $resource_status ); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ( $resource_duration ) : ?>
                        <span class="resource-elem">
                            <?php echo esc_html( $resource_duration ); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ( $resource_price ) : ?>
                        <span class="resource-elem">
                            <?php echo esc_html( $resource_price ); ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="resource-content__body">
                    <?php if ( $resource_title ) : ?>
                        <span class="resource-title">
                            <?php echo esc_html( $resource_title ); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ( $resource_subtitle ) : ?>
                        <p class="resource-subtitle">
                            <?php echo esc_html( $resource_subtitle ); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ( $resource_date || $resource_time ) : ?>
                        <div class="resource-details">
                            <?php if ( $resource_date ) : ?>
                                <span class="resource-elem">
                                    <?php echo esc_html( $resource_date ); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( $resource_time ) : ?>
                                <span class="resource-elem">
                                    <?php echo esc_html( $resource_time . ' BST' ); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="resource-content__footer">
                    <?php if ( $resource_link && $resource_link_label ) : ?>
                        <a class="btn btn-primary" href="<?php echo esc_url( $resource_link ); ?>" target="_blank">
                            <?php echo esc_html( $resource_link_label ); ?>
                            <svg><use xlink:href="#arrow-right"></use></svg>
                        </a>
                    <?php endif; ?>

                    <?php if ( $resource_archive && $archive_title ) : ?>
                        <a class="btn btn-simple" href="<?php echo esc_url( $resource_archive ); ?>" target="_blank">
                            <?php echo esc_html( $archive_title ); ?>
                            <svg><use xlink:href="#arrow-right"></use></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if ( have_rows( 'module_buttons' ) ) : ?>
            <div class="m-latest__buttons">
                <?php while ( have_rows( 'module_buttons' ) ) : the_row();
                    $btn_icon = get_sub_field( 'button_icon' ) ?? false;
                    $btn_url  = get_sub_field( 'button_url' ) ?? false;
                    $btn_text = get_sub_field( 'button_text' ) ?? false; ?>

                    <?php if ( $btn_text && $btn_url ) : ?>
                        <a class="btn btn-ghost" href="<?php echo esc_url( $btn_url ); ?>" target="_blank">
                            <?php if ( $btn_icon ) : ?>
                                <?php echo wp_get_attachment_image( $btn_icon, 'full', false, [ 'class' => 'icon' ] ); ?>
                            <?php endif; ?>
                            <?php echo esc_html( $btn_text ); ?>
                        </a>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
	</div>
</section>
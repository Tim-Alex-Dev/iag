<?php

$current_term = get_queried_object();

$resource_categories = [];

$source_terms = get_terms(
    [
        'taxonomy'   => 'source',
        'hide_empty' => true,
    ]
);

if ( ! empty( $source_terms ) && ! is_wp_error( $source_terms ) ) {
    foreach ( $source_terms as $source_term ) {
        $term_link = get_term_link( $source_term );

        if ( is_wp_error( $term_link ) ) {
            continue;
        }

        $resource_categories[] = [
            'term_id' => $source_term->term_id,
            'title'   => $source_term->name,
            'link'    => $term_link,
        ];
    }
}

$resource_ids = get_posts(
    [
        'post_type'      => 'resource',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'orderby'        => 'date',
        'order'          => 'DESC',

        'tax_query'      => [
            [
                'taxonomy'         => 'source',
                'field'            => 'term_id',
                'terms'            => $current_term->term_id,
                'include_children' => false,
            ],
        ],
    ]
);

$page_title     = $current_term->name ?? false;
$page_subtitle  = term_description( $current_term->term_id, 'source' ) ?: false;
$page_banner    = get_field( 'resource_banner', 'source_' . $current_term->term_id ) ?? false;
$youtube_url    = get_field( 'main_youtube_url', 'options' ) ?? false;
$linkedin_url   = get_field( 'main_linkedin_url', 'options' ) ?? false;
$youtube_icon   = get_field( 'main_youtube_icon', 'options' ) ?? false;
$linkedin_icon  = get_field( 'main_linkedin_icon', 'options' ) ?? false;
$posts_page_url = get_permalink( get_option( 'page_for_posts' ) );

get_header();
?>

<section class="category-banner">

    <?php echo wp_get_attachment_image( $page_banner, 'full', false, [ 'class' => 'category-banner-img' ] ); ?>
    
    <div class="container">
        <div class="category-banner__content">
            <?php get_template_part( 'template-parts/breadcrumbs' ); ?>

            <?php if ( $page_title ) : ?>
                <h1 class="h1 content-title">
                    <?php echo esc_html( $page_title ); ?>
                </h1>
            <?php endif; ?>

            <?php if ( $page_subtitle ) : ?>
                <p class="content-subtitle">
                    <?php echo esc_html( wp_strip_all_tags( $page_subtitle ) ); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="category-banner__share">
            <span class="share-label">
                <?php echo _e( 'Follow & Share:'); ?>
            </span>

            <?php if ( $linkedin_url && $linkedin_icon ) : ?>
                <a class="share-link" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank">
                    <?php echo wp_get_attachment_image( $linkedin_icon, 'thumbnail', false, [ 'class' => 'share-link__img' ] ); ?>
                </a>
            <?php endif; ?>

            <?php if ( $youtube_url && $youtube_icon ) : ?>
                <a class="share-link" href="<?php echo esc_url( $youtube_url ); ?>" target="_blank">
                    <?php echo wp_get_attachment_image( $youtube_icon, 'thumbnail', false, [ 'class' => 'share-link__img' ] ); ?>
                </a>
            <?php endif; ?>

            <div class="share-button">
                <svg><use xlink:href="#chain"></use></svg>
                <?php echo _e( 'Share', '_iag' ); ?>
            </div>
        </div>
    </div>
</section>

<section class="category-links">
    <div class="container">
        <div class="category-links__list">
            <a class="list-item" href="<?php echo esc_url( $posts_page_url ); ?>">
                <?php esc_html_e( 'All Resources', '_iag' ); ?>
            </a>

            <?php foreach ( $resource_categories as $resource_category ) : ?>
                <a class="list-item <?php echo $current_term->term_id === $resource_category['term_id'] ? 'is-active' : ''; ?>" href="<?php echo esc_url( $resource_category['link'] ); ?>">
                    <?php echo esc_html( $resource_category['title'] ); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="category-latest bg-blue">
    <div class="container">
        <?php get_template_part( 'template-parts/components/latest-resources', null, [ 'category_id' => $current_term->term_id, ] ); ?>
    </div>
</section>

<section class="category-posts" id="categories">
    <div class="container">

        <?php if ( $resource_ids ) : ?>
            <div class="category-posts__list">

                <?php foreach ( $resource_ids as $resource_id ) : ?>

                    <?php get_template_part( 'template-parts/components/resource-card', null, [ 'post_id' => $resource_id, ] );?>

                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>






<?php
get_footer(); 
?>
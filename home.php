<?php
/**
 *Template Name: Resource Hub
 */

$resource_categories = [];

$source_terms = get_terms(
    [
        'taxonomy'   => 'source',
        'hide_empty' => true,
    ]
);

if ( ! empty( $source_terms ) && ! is_wp_error( $source_terms ) ) {
    foreach ( $source_terms as $source_term ) {

        $latest_resource_ids = get_posts(
            [
                'post_type'      => 'resource',
                'post_status'    => 'publish',
                'posts_per_page' => 3,
                'fields'         => 'ids',
                'orderby'        => 'date',
                'order'          => 'DESC',

                'meta_query' => [
                    [
                        'key'     => '_yoast_wpseo_primary_source',
                        'value'   => $source_term->term_id,
                        'compare' => '=',
                        'type'    => 'NUMERIC',
                    ],
                ],

                'tax_query' => [
                    [
                        'taxonomy'         => 'source',
                        'field'            => 'term_id',
                        'terms'            => $source_term->term_id,
                        'include_children' => false,
                    ],
                ],

                'no_found_rows'          => true,
                'update_post_meta_cache' => false,
                'update_post_term_cache' => false,
            ]
        );

        // Do not include categories without primary Resources.
        if ( empty( $latest_resource_ids ) ) {
            continue;
        }

        $term_link = get_term_link( $source_term );

        if ( is_wp_error( $term_link ) ) {
            continue;
        }

        $resource_categories[] = [
            'term_id'  => $source_term->term_id,
            'title'    => $source_term->name,
            'link'     => $term_link,
            'post_ids' => $latest_resource_ids,
        ];
    }
}

$page_title    = get_field( 'page_title' ) ?? false;
$page_subtitle = get_field( 'page_subtitle' ) ?? false;
$page_banner   = get_field( 'page_banner' ) ?? false;
$youtube_url   = get_field( 'main_youtube_url', 'options' ) ?? false;
$linkedin_url  = get_field( 'main_linkedin_url', 'options' ) ?? false;
$youtube_icon  = get_field( 'main_youtube_icon', 'options' ) ?? false;
$linkedin_icon = get_field( 'main_linkedin_icon', 'options' ) ?? false;

get_header();
?>

<section class="resource-hub__banner">

    <?php echo wp_get_attachment_image( $page_banner, 'full', false, [ 'class' => 'resource-hub__banner-img' ] ); ?>
    
    <div class="container">
        <div class="resource-hub__banner-content">
            <?php get_template_part( 'template-parts/breadcrumbs' ); ?>

            <?php if ( $page_title ) : ?>
                <h1 class="h1 content-title">
                    <?php echo esc_html( $page_title ); ?>
                </h1>
            <?php endif; ?>

            <?php if ( $page_subtitle ) : ?>
                <p class="content-subtitle">
                    <?php echo esc_html( $page_subtitle ); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="resource-hub__banner-share">
            <span class="share-label">
                <?php echo _e( 'Follow & Share'); ?>
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

<section class="resource-hub__links">
    <div class="container">
        <div class="resource-hub__links-list">
            <a class="list-item <?php echo is_home() ? 'is-active' : '';?>" href="#categories">
                <?php esc_html_e( 'All Resources', '_iag' ); ?>
            </a>

            <?php foreach ( $resource_categories as $resource_category ) : ?>
                <a class="list-item" href="<?php echo esc_url( $resource_category['link'] ); ?>">
                    <?php echo esc_html( $resource_category['title'] ); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="resource-hub__latest bg-blue">
    <div class="container">
        <?php get_template_part( 'template-parts/components/latest-resources' ); ?>
    </div>
</section>

<section class="resource-hub__categories" id="#categories">
    <div class="container">
        <?php if ( $resource_categories ) : ?>
            <div class="resource-categories">

                <?php foreach ( $resource_categories as $index => $resource_category ) :
	                $color_class = ( $index % 2 === 0 ) ? 'col-primary' : 'col-secondary'; ?>

                    <div class="resource-category <?php echo esc_attr( $color_class ); ?>">
                        <div class="resource-category__header">
                            <h2 class="category-title">
                                <?php echo esc_html( $resource_category['title'] ); ?>
                            </h2>
                            <a class="btn btn-simple" href="<?php echo esc_url( $resource_category['link'] ); ?>" target="_blank">
                                <?php echo _e( 'VIEW ALL', '_iag'); ?>
                                <svg><use xlink:href="#arrow-right"></use></svg>
                            </a>
                        </div>
                        <div class="resource-category__list">
                            <?php if ( $resource_category['post_ids'] ) : ?>
                                <?php foreach ( $resource_category['post_ids'] as $resource_id ) : ?>

                                    <?php get_template_part( 'template-parts/components/resource-card', null, [ 'post_id' => $resource_id, ] );?>

                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer(); 
?>
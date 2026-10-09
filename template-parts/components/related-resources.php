<?php
$category_id = (int) ( $args['category_id'] ?? 0 );
$current_id  = get_queried_object_id();

$section_title = __( 'Latest resources', '_iag' );
$section_link  = get_post_type_archive_link( 'resource' );

$query_args = [
    'post_type'           => 'resource',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'post__not_in'        => [ $current_id ],
    'orderby'             => 'date',
    'order'               => 'DESC',
    'fields'              => 'ids',
    'no_found_rows'        => true,
    'ignore_sticky_posts' => true,
];

$related_ids = [];
$source_term = $category_id ? get_term( $category_id, 'source' ) : null;

if ( $source_term && ! is_wp_error( $source_term ) ) {
    $category_args = $query_args;

    $category_args['tax_query'] = [
        [
            'taxonomy'         => 'source',
            'field'            => 'term_id',
            'terms'            => [ $category_id ],
            'include_children' => false,
        ],
    ];

    $related_query = new WP_Query( $category_args );
    $related_ids   = $related_query->posts;

    if ( $related_ids ) {
        $term_link     = get_term_link( $source_term );
        $section_link  = ! is_wp_error( $term_link ) ? $term_link : false;
    }
}

// Use all categories only when no related resources were found.
if ( empty( $related_ids ) ) {
    $related_query = new WP_Query( $query_args );
    $related_ids   = $related_query->posts;
}

if ( empty( $related_ids ) ) {
    return;
}
?>

<section class="resource-related">
    <div class="container">
        <div class="resource-related__header">
            <h2 class="resource-related__header-title">
                <?php echo esc_html( $section_title ); ?>
            </h2>

            <?php if ( $section_link ) : ?>
                <a class="btn btn-simple" href="<?php echo esc_url( $section_link ); ?>">
                    <?php esc_html_e( 'VIEW ALL', '_iag' ); ?>
                    <svg><use xlink:href="#arrow-right"></use></svg>
                </a>
            <?php endif; ?>
        </div>

        <div class="resource-related__list">
            <?php foreach ( $related_ids as $related_id ) : ?>
                <?php get_template_part( 'template-parts/components/resource-card', null, [ 'post_id' => $related_id ] ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
/**
 * The template for displaying all single Expert Pages
 */

get_header();
the_post();

$expert_id = get_the_ID();

// Expert Main Data
$expert_name        = get_field( 'expert_title', $expert_id ) ?? false;
$expert_photo       = get_field( 'expert_photo', $expert_id ) ?? false;
$expert_degrees     = get_field( 'expert_degrees', $expert_id ) ?? false;
$expert_subtitle    = get_field( 'expert_subtitle', $expert_id ) ?? false;
$sticky_header      = get_field( 'add_sticky_header', $expert_id ) ?? false;
$sticky_header_link = get_field( 'sticky_header_button', $expert_id ) ?? false;
$expert_video_type  = get_field( 'expert_video', $expert_id ) ?? false;
$video_url          = get_field( 'video_url', $expert_id ) ?? false;
$video_file         = get_field( 'video_file', $expert_id ) ?? false;
$video_banner       = get_field( 'video_banner', $expert_id ) ?? false;

// Expert Biography
$biography_title    = get_field( 'biography_title', $expert_id ) ?? false;
$biography_subtitle = get_field( 'biography_subtitle', $expert_id ) ?? false;
$biography_uptitle  = get_field( 'biography_uptitle', $expert_id ) ?? false;

// Case Studies
$case_studies_title    = get_field( 'case_studies_title', $expert_id ) ?? false;
$case_studies_subtitle = get_field( 'case_studies_subtitle', $expert_id ) ?? false;
$case_studies_uptitle  = get_field( 'case_studies_uptitle', $expert_id ) ?? false;
$case_studies_list     = get_field( 'case_study_list', $expert_id ) ?? false;

// Publications
$publications_title    = get_field( 'publications_title', $expert_id ) ?? false;
$publications_subtitle = get_field( 'publications_subtitle', $expert_id ) ?? false;
$publications_uptitle  = get_field( 'publications_uptitle', $expert_id ) ?? false;
$publications_link     = get_field( 'publications_link', $expert_id ) ?? false;

// Appointments and Advisory Roles
$appointments_title    = get_field( 'appointments_title', $expert_id ) ?? false;
$appointments_subtitle = get_field( 'appointments_subtitle', $expert_id ) ?? false;
$appointments_uptitle  = get_field( 'appointments_uptitle', $expert_id ) ?? false;

// Education and Training
$education_title    = get_field( 'education_title', $expert_id ) ?? false;
$education_subtitle = get_field( 'education_subtitle', $expert_id ) ?? false;
$education_uptitle  = get_field( 'education_uptitle', $expert_id ) ?? false;

// External Resources
$resources_title    = get_field( 'resources_title', $expert_id ) ?? false;
$resources_subtitle = get_field( 'resources_subtitle', $expert_id ) ?? false;
$resources_uptitle  = get_field( 'resources_uptitle', $expert_id ) ?? false;
$websites_title     = get_field( 'websites_column_title', $expert_id ) ?? false;
$profiles_title     = get_field( 'profiles_column_title', $expert_id ) ?? false;
$locations_title    = get_field( 'locations_column_title', $expert_id ) ?? false;


$expert_categories = array(
    array(
        'taxonomy' => 'therapeutic-area',
        'title'    => __( 'Therapeutic Area', '_iag' ),
    ),
    array(
        'taxonomy' => 'indicator-area',
        'title'    => __( 'Key Indicator Area', '_iag' ),
    ),
    array(
        'taxonomy' => 'expertise',
        'title'    => __( 'Expertise Areas', '_iag' ),
    ),
);

// CTA Form
?>


<article class="expert">
    <?php if ( $sticky_header && $sticky_header_link ) : ?>
        <div class="sticky-header">
            <div class="container">
                <?php if ( $expert_photo ) : ?> 
                    <div class="sticky-header__photo">
                        <?php echo wp_get_attachment_image( $expert_photo, 'thumbnail', false, [ 'class' => 'sticky-header__photo-img' ]); ?>
                    </div>
                <?php endif; ?>

                <span class="sticky-header__name">
                    <?php echo $expert_name; ?>
                    <?php if ( $expert_degrees ) : ?>
                        <span class="sticky-header__name-degree">
                            <?php echo $expert_degrees; ?>
                        </span>
                    <?php endif; ?>
                </span>

                <?php if ( $sticky_header_link ) : 
                    $link_url    = $sticky_header_link['url'];
                    $link_title  = $sticky_header_link['title'];
                    $link_target = $sticky_header_link['target'] ? $sticky_header_link['target'] : '_self'; ?>

                    <a class="btn btn-outline-primary sticky-header__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                        <?php echo esc_html( $link_title ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="expert-main">
        <div class="container">
            <div class="expert-main__content">
                <?php if ( $expert_photo ) : ?>
                    <div class="expert-main__photo">
                        <?php echo wp_get_attachment_image( $expert_photo, 'full', false, [ 'class' => 'expert-main__photo-img' ]); ?>
                    </div>
                <?php endif; ?>
                <?php if ( $expert_name ) : ?>
                    <div class="expert-main__data">
                        <div class="expert-main__data-header">
                            <div class="expert-main__data-photo">
                                <?php echo wp_get_attachment_image( $expert_photo, 'medium', false, [ 'class' => 'expert-main__data-photo-img' ]); ?>
                            </div>
                            <div class="expert-main__data-info">
                                <div class="expert-main__title">
                                    <h1 class="h1 expert-main__title-name">
                                        <?php echo $expert_name; ?>
                                        <?php if ( $expert_degrees ) : ?>
                                            <span class="expert-main__title-degree">
                                                <?php echo $expert_degrees; ?>
                                            </span>
                                        <?php endif; ?>
                                    </h1>
                                </div>
                                <?php if ( $expert_subtitle ) : ?>
                                    <p class="expert-main__subtitle">
                                        <?php echo $expert_subtitle; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="expert-main__categories">
                            <?php foreach ( $expert_categories as $group ) :
                                $terms = get_the_terms( $expert_id, $group['taxonomy'] );
    
                                if ( empty( $terms ) || is_wp_error( $terms ) ) {
                                    continue;
                                } ?>
    
                                <div class="expert-main__categories-group">
                                    <span class="category-title">
                                        <?php echo esc_html( $group['title'] ); ?>
                                    </span>
    
                                    <div class="category-list">
                                        <?php foreach ( $terms as $term ) : ?>
                                            <span class="category-list__item chip chip-lg chip-secondary">
                                                <?php echo esc_html( $term->name ); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
    
                        <div class="expert-main__buttons">
                            <?php if ( ( $expert_video_type === 'embed' && $video_url ) || ( $expert_video_type === 'file' && $video_file ) ) : ?>

                                <div class="expert-video-btn js-modal-open"
                                    data-modal="video"
                                    data-video-type="<?php echo esc_attr( $expert_video_type ); ?>"
                                    <?php if ( $expert_video_type === 'embed' && $video_url ) : ?>
                                        data-video-url="<?php echo esc_url( $video_url ); ?>"
                                    <?php endif; ?>
                                    <?php if ( $expert_video_type === 'file' && $video_file ) : ?>
                                        data-video-file="<?php echo esc_url( $video_file ); ?>"

                                        <?php if ( $video_banner ) : ?>
                                            data-video-banner="<?php echo esc_url( wp_get_attachment_image_url( $video_banner, 'full' ) ); ?>"
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    >
                                    <svg><use xlink:href="#youtube"></use></svg>

                                </div>

                            <?php endif; ?>
                            <a class="expert-main__buttons-btn btn btn-primary" href="/contact-us/#contact-us" target="_self">
                                <?php echo _e( 'Talk to this expert', '_iag' ); ?>
                                <svg><use xlink:href="#arrow-right"></use></svg>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if ( have_rows( 'biography_list', $expert_id ) ) : ?>
        <div class="expert-biography expert-block bg-white">
            <div class="container">
                <?php if ( $biography_title || $biography_subtitle || $biography_uptitle ) : ?>
                    <div class="expert-block__header">
                        <?php if ( $biography_uptitle ) : ?>
                            <span class="expert-block__uptitle">
                                <?php echo esc_html( $biography_uptitle ); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ( $biography_title ) : ?>
                            <h2 class="h2 expert-block__title">
                                <?php echo esc_html( $biography_title ); ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ( $biography_subtitle ) : ?>
                            <span class="expert-block__subtitle">
                                <?php echo esc_html( $biography_subtitle ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="expert-biography__blocks">
                    <?php while ( have_rows( 'biography_list', $expert_id ) ) : the_row();
                        $title          = get_sub_field( 'section_title' ) ?? false;
                        $content        = get_sub_field( 'section_content' ) ?? false;
                        $hidden_content = get_sub_field( 'hidden_content' ) ?? false;
                        $show_more_func = get_sub_field( 'show_more_functionality' ) ?? false; ?>

                        <?php if ( $title && $content ) : ?>
                            <div class="expert-biography__block js-accordion">
                                <span class="h3 block-title">
                                    <?php echo esc_html( $title ); ?>
                                </span>

                                <div class="editor block-content">
                                    <?php echo wp_kses_post( $content ); ?>
                                </div>

                                <?php if ( $show_more_func && $hidden_content ) : ?>
                                    <div class="js-accordion-item">
                                        <div class="editor js-accordion-content block-content__hidden">
                                            <?php echo wp_kses_post( $hidden_content ); ?>
                                        </div>
                                        <div class="js-accordion-title block-content__btn">
                                            <?php echo _e( 'Read More', '_iag' ); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ( $case_studies_list ) : ?>
        <div class="expert-cases expert-block bg-blue">
            <div class="container">
                <?php if ( $case_studies_title || $case_studies_subtitle || $case_studies_uptitle ) : ?>
                    <div class="expert-block__header">
                        <?php if ( $case_studies_uptitle ) : ?>
                            <span class="expert-block__uptitle">
                                <?php echo esc_html( $case_studies_uptitle ); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ( $case_studies_title ) : ?>
                            <h2 class="h2 expert-block__title">
                                <?php echo esc_html( $case_studies_title ); ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ( $case_studies_subtitle ) : ?>
                            <span class="expert-block__subtitle">
                                <?php echo esc_html( $case_studies_subtitle ); ?>
                            </span>
                        <?php endif; ?>
                        <div class="expert-cases__list">
                            <?php foreach ( $case_studies_list as $resource_id ) : ?>
                                <?php get_template_part( 'template-parts/components/resource-card', null, [ 'post_id' => $resource_id, ] );?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ( have_rows( 'publications_list', $expert_id ) ) : ?>
        <div class="expert-publications expert-block bg-gray">
            <div class="container">
                <?php if ( $publications_title || $publications_subtitle || $publications_uptitle ) : ?>
                    <div class="expert-block__header">
                        <?php if ( $publications_uptitle ) : ?>
                            <span class="expert-block__uptitle">
                                <?php echo esc_html( $publications_uptitle ); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ( $publications_title ) : ?>
                            <h2 class="h2 expert-block__title">
                                <?php echo esc_html( $publications_title ); ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ( $publications_subtitle ) : ?>
                            <span class="expert-block__subtitle">
                                <?php echo esc_html( $publications_subtitle ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <div class="expert-publications__table c-table">
                    <div class="table-header">
                        <span class="table-header__title"><?php echo _e( 'Title', '_iag' ); ?></span>
                        <span class="table-header__title"><?php echo _e( 'Journal', '_iag' ); ?></span>
                        <span class="table-header__title"><?php echo _e( 'Year', '_iag' ); ?></span>
                        <span class="table-header__title"><?php echo _e( 'Link', '_iag' ); ?></span>
                    </div>
                    <div class="table-body">
                        <?php while ( have_rows( 'publications_list', $expert_id ) ) : the_row(); 
                            $title    = get_sub_field( 'publication_title' ) ?? false;
                            $journal  = get_sub_field( 'journal' ) ? get_sub_field( 'journal' ) : "";
                            $year     = get_sub_field( 'publication_year' ) ? get_sub_field( 'publication_year' ) : "";
                            $link     = get_sub_field( 'publication_link' ) ? get_sub_field( 'publication_link' ) : ""; ?>
    
                            <?php if ( $title ) : ?>
                                <div class="table-body__item publication">
                                    <div class="table-body__item-element text-element">
                                        <span class="text-element__content">
                                            <?php echo esc_html( $title ); ?>
                                        </span>
                                    </div>
                                    <div class="table-body__item-element text-element">
                                        <?php if ( $journal ) : ?>
                                            <span class="text-element__content">
                                                <?php echo esc_html( $journal ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="table-body__item-element text-element">
                                        <?php if ( $year ) : ?>
                                            <span class="text-element__content">
                                                <?php echo esc_html( $year ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="table-body__item-element link-element">
                                        <?php if ( $link ) : 
                                            $link_url    = $link['url'];
                                            $link_title  = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
        
                                            <a class="link-element__button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                                <?php echo esc_html( $link_title ); ?>
                                                <svg class="icon">
                                                    <use xlink:href="#arrow-top-right"></use>
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>

                    </div>
                </div>

                <?php if ( $publications_link ) : 
                    $link_url    = $publications_link['url'];
                    $link_title  = $publications_link['title'];
                    $link_target = $publications_link['target'] ? $publications_link['target'] : '_self'; ?>

                    <a class="btn btn-simple expert-publications__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                        <?php echo esc_html( $link_title ); ?>
                        <svg class="icon">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ( have_rows( 'content_column', $expert_id ) ) : ?>
        <div class="expert-appointments expert-block bg-blue">
            <div class="container">
                <?php if ( $appointments_title || $appointments_subtitle || $appointments_uptitle ) : ?>
                    <div class="expert-block__header">
                        <?php if ( $appointments_uptitle ) : ?>
                            <span class="expert-block__uptitle">
                                <?php echo esc_html( $appointments_uptitle ); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ( $appointments_title ) : ?>
                            <h2 class="h2 expert-block__title">
                                <?php echo esc_html( $appointments_title ); ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ( $appointments_subtitle ) : ?>
                            <span class="expert-block__subtitle">
                                <?php echo esc_html( $appointments_subtitle ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="expert-appointments__list">
                    <?php while ( have_rows( 'content_column', $expert_id ) ) : the_row(); 
                        $column_title = get_sub_field( 'column_title' ); ?>

                        <?php if ( have_rows( 'column_items' ) ) : ?>
                            <div class="appointments-column">
                                <?php if ( $column_title ) : ?>
                                    <h4 class="appointments-column__title">
                                        <?php echo esc_html( $column_title ); ?>
                                    </h4>
                                <?php endif; ?>

                                <?php while ( have_rows( 'column_items' ) ) : the_row();
                                    $item_title       = get_sub_field( 'item_title' );
                                    $item_description = get_sub_field( 'item_description' ); ?>

                                    <?php if ( $item_title ) : ?>
                                        <div class="appointments-column__item">
                                            <span class="appointments-column__item-title">
                                                <?php echo esc_html( $item_title ); ?>
                                            </span>

                                            <?php if ( $item_description ) : ?>
                                                <span class="appointments-column__item-description">
                                                    <?php echo esc_html( $item_description ); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ( have_rows( 'education_and_training_list', $expert_id ) ) : ?>
        <div class="expert-education expert-block bg-white">
            <div class="container">
                <?php if ( $education_title || $education_subtitle || $education_uptitle ) : ?>
                    <div class="expert-block__header">
                        <?php if ( $education_uptitle ) : ?>
                            <span class="expert-block__uptitle">
                                <?php echo esc_html( $education_uptitle ); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ( $education_title ) : ?>
                            <h2 class="h2 expert-block__title">
                                <?php echo esc_html( $education_title ); ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ( $education_subtitle ) : ?>
                            <span class="expert-block__subtitle">
                                <?php echo esc_html( $education_subtitle ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <div class="expert-education__table c-table">
                    <div class="table-header">
                        <span class="table-header__title"><?php echo _e( 'Year', '_iag' ); ?></span>
                        <span class="table-header__title"><?php echo _e( 'Qualification / Role', '_iag' ); ?></span>
                        <span class="table-header__title"><?php echo _e( 'Institution', '_iag' ); ?></span>
                    </div>
                    <div class="table-body">
                        <?php while ( have_rows( 'education_and_training_list', $expert_id ) ) : the_row(); 
                            $year          = get_sub_field( 'year' ) ? get_sub_field( 'year' ) : "";
                            $qualification = get_sub_field( 'qualification' ) ? get_sub_field( 'qualification' ) : "";
                            $institution   = get_sub_field( 'institution' ) ? get_sub_field( 'institution' ) : "" ?>

                            <div class="table-body__item education">
                                <div class="table-body__item-element text-element">
                                    <?php if ( $year ) : ?>
                                        <span class="text-element__content">
                                            <?php echo $year; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="table-body__item-element text-element">
                                    <?php if ( $qualification ) : ?>
                                        <span class="text-element__content">
                                            <?php echo $qualification; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="table-body__item-element text-element">
                                    <?php if ( $institution ) : ?>
                                        <span class="text-element__content">
                                            <?php echo $institution; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="expert-resources expert-block bg-gray">
        <div class="container">
            <?php if ( $resources_title || $resources_subtitle || $resources_uptitle ) : ?>
                <div class="expert-block__header">
                    <?php if ( $resources_uptitle ) : ?>
                        <span class="expert-block__uptitle">
                            <?php echo esc_html( $resources_uptitle ); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ( $resources_title ) : ?>
                        <h2 class="h2 expert-block__title">
                            <?php echo esc_html( $resources_title ); ?>
                        </h2>
                    <?php endif; ?>
                    <?php if ( $resources_subtitle ) : ?>
                        <span class="expert-block__subtitle">
                            <?php echo esc_html( $resources_subtitle ); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="expert-resources__list">
                <?php if ( have_rows( 'websites_list', $expert_id ) ) : ?>
                    <div class="resources-column">
                        <?php if ( $websites_title ) : ?>
                            <span class="resources-column__title">
                                <?php echo $websites_title; ?>
                            </span>
                        <?php endif; ?>
                        <?php while ( have_rows( 'websites_list', $expert_id ) ) : the_row();
                            $website_link = get_sub_field( 'website_link' ) ?? false; ?>

                            <?php if ( $website_link ) : ?>
                                <?php if ( $website_link ) : 
                                    $link_url    = $website_link['url'];
                                    $link_title  = $website_link['title'];
                                    $link_target = $website_link['target'] ? $website_link['target'] : '_self'; ?>

                                    <a class="btn btn-simple resources-column__website" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                        <?php echo esc_html( $link_title ); ?>
                                        <svg class="icon">
                                            <use xlink:href="#arrow-top-right"></use>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php if ( have_rows( 'profiles_list', $expert_id ) ) : ?>
                    <div class="resources-column">
                        <?php if ( $profiles_title ) : ?>
                            <span class="resources-column__title">
                                <?php echo $profiles_title; ?>
                            </span>
                        <?php endif; ?>
                        <?php while ( have_rows( 'profiles_list', $expert_id ) ) : the_row();
                            $link = get_sub_field( 'profile_link' ) ?? false;
                            $data = get_sub_field( 'profile_extra_data' ) ?? false; ?>

                            <?php if ( $link ) : ?>
                                <div class="resources-column__profile">
                                    <?php if ( $link ) : 
                                        $link_url    = $link['url'];
                                        $link_title  = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self'; ?>
    
                                        <a class="btn btn-simple resources-column__profile-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                            <?php echo esc_html( $link_title ); ?>
                                            <svg class="icon">
                                                <use xlink:href="#arrow-top-right"></use>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ( $data ) : ?>
                                        <span class="resources-column__profile-data">
                                            <?php echo $data; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php if ( have_rows( 'locations_list', $expert_id ) ) : ?>
                    <div class="resources-column">
                        <?php if ( $locations_title ) : ?>
                            <span class="resources-column__title">
                                <?php echo $locations_title; ?>
                            </span>
                        <?php endif; ?>
                        <?php while ( have_rows( 'locations_list', $expert_id ) ) : the_row();
                            $location_title = get_sub_field( 'location_title' ) ?? false; ?>

                            <?php if ( $location_title ) : ?>
                                <span class="resources-column__location">
                                    <?php echo $location_title; ?>
                                </span>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- <div class="expert-contact" id="expert-contacts">
        <div class="container">
            form here
        </div>
    </div> -->
</article>


<?php
get_footer();
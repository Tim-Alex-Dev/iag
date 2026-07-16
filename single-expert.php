<?php
/**
 * The template for displaying all single Expert Pages
 */

get_header();
the_post();

$expert_id       = get_the_ID();

// Expert Main Data
$expert_name        = get_field( 'expert_title', $expert_id ) ?? false;
$expert_photo       = get_field( 'expert_photo', $expert_id ) ?? false;
$expert_degrees     = get_field( 'expert_degrees', $expert_id ) ?? false;
$expert_subtitle    = get_field( 'expert_subtitle', $expert_id ) ?? false;
$sticky_header      = get_field( 'add_sticky_header', $expert_id ) ?? false;
$sticky_header_link = get_field( 'sticky_header_button', $expert_id ) ?? false;
// Expert Biography
$current_role              = get_field( 'current_role', $expert_id ) ?? false;
$background_training       = get_field( 'background_training', $expert_id ) ?? false;
$research_focus            = get_field( 'research_focus', $expert_id ) ?? false;
$clinical_trial_experience = get_field( 'clinical_trial_experience', $expert_id ) ?? false;
$impact                    = get_field( 'impact', $expert_id ) ?? false;
// Case Studies
$case_studies_list     = get_field( 'case_study_list', $expert_id ) ?? false;
$case_studies_title    = get_field( 'case_studies_title', $expert_id ) ?? false;
$case_studies_subtitle = get_field( 'case_studies_subtitle', $expert_id ) ?? false;
// Publications
$publications_title    = get_field( 'publications_title', $expert_id ) ?? false;
$publications_subtitle = get_field( 'publication_subtitle', $expert_id ) ?? false;
$publications_link     = get_field( 'publications_link', $expert_id ) ?? false;
// Appointments and Advisory Roles
$appointments_title    = get_field( 'appointments_title', $expert_id ) ?? false;
// Education and Training
// External Resources
$websites_title  = get_field( 'websites_column_title', $expert_id ) ?? false;
$profiles_title  = get_field( 'profiles_column_title', $expert_id ) ?? false;
$locations_title = get_field( 'locations_column_title', $expert_id ) ?? false;


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
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

<article class="expert">
    <div class="container">
        <div class="expert-main">
            <?php if ( $expert_photo ) : ?>
                <div class="expert-main__photo">
                    <?php echo wp_get_attachment_image( $expert_photo, 'full', false, [ 'class' => 'expert-main__photo-img' ]); ?>
                </div>
            <?php endif; ?>
            <?php if ( $expert_name ) : ?>
                <div class="expert-main__data">
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

                    <div class="expert-main__categories">
                        <?php foreach ( $expert_categories as $group ) :
                            $terms = get_the_terms( $expert_id, $group['taxonomy'] );

                            if ( empty( $terms ) || is_wp_error( $terms ) ) {
                                continue;
                            } ?>

                            <div class="expert-main__categories-group">
                                <span class="h3 category-title">
                                    <?php echo esc_html( $group['title'] ); ?>
                                </span>

                                <div class="category-list">
                                    <?php foreach ( $terms as $term ) : ?>
                                        <span class="category-list__item">
                                            <?php echo esc_html( $term->name ); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

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
    
                        <a class="new-btn new-btn-primary sticky-header__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                            <?php echo esc_html( $link_title ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( have_rows( 'biography_list', $expert_id ) ) : ?>
            <div class="expert-biography expert-block">
                <h2 class="h2 expert-block__title">
                    <?php echo _e( 'About', '_iag' ) . ' ' . $expert_name; ?>
                </h2>

                <div class="expert-biography__blocks js-accordion">
                    <?php while ( have_rows( 'biography_list', $expert_id ) ) : the_row();
                        $title   = get_sub_field( 'section_title' ) ?? false;
                        $content = get_sub_field( 'section_content' ) ?? false; 
                        $show_more_item    = get_sub_field( 'show_more_functionality' ) ?  'js-accordion-item' : '';   
                        $show_more_title   = get_sub_field( 'show_more_functionality' ) ?  'js-accordion-title' : 'no-icon';   
                        $show_more_content = get_sub_field( 'show_more_functionality' ) ?  'js-accordion-content' : '';   ?>

                        <?php if ( $title && $content ) : ?>
                            <div class="expert-biography__block <?php echo $show_more_item; ?>">
                                <span class="h3 expert-biography__block-title <?php echo $show_more_title; ?>">
                                    <?php echo $title; ?>
                                </span>
                                <div class="editor expert-biography__block-content <?php echo $show_more_content; ?>">
                                    <?php echo wp_kses_post( $content ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( $case_studies_list ) : ?>
            <div class="expert-cases expert-block">
                <?php if ( $case_studies_title ) : ?>
                    <h2 class="h2 expert-block__title">
                        <?php echo $case_studies_title; ?>
                    </h2>
                <?php endif; ?>
                <?php if ( $case_studies_subtitle ) : ?>
                    <p class="expert-block__subtitle">
                        <?php echo $case_studies_subtitle; ?>
                    </p>
                <?php endif; ?>
                <div class="expert-cases__list">
                    <?php foreach ($case_studies_list as $case_id) : 
                        $case_title    = get_field( 'case_study_title', $case_id ) ?? false;
                        $case_category = get_field( 'case_study_category', $case_id ) ?? false;
                        $case_file     = get_field( 'case_study_file', $case_id ) ?? false;
                        $case_banner   = get_field( 'case_study_banner', $case_id ) ?? false; ?>

                        <?php if ( $case_title && $case_file ) : ?>
                            <div class="expert-case expert-cases__list-item">
                                <?php if ( $case_banner ) : ?>
                                    <div class="expert-case__banner">
                                        <?php echo wp_get_attachment_image( $case_banner, 'full', false, [ 'class' => 'expert-case__banner-img' ]); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $case_category ) : ?>
                                    <div class="expert-case__category">
                                        <?php echo $case_category; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="expert-case__title">
                                    <?php echo $case_title; ?>
                                </div>
                                <a class="new-btn new-btn-primary expert-case__button" href="<?php echo esc_url(wp_get_attachment_url($case_file)); ?>" download target="_blank">
                                    <?php echo _e( 'Download PDF', '_iag' ); ?>
                                    <svg class="icon">
                                        <use xlink:href="#arrow-bottom"></use>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( have_rows( 'publications_list', $expert_id ) ) : ?>
            <div class="expert-publications expert-block">
                <?php if ( $publications_title ) : ?>
                    <h2 class="h2 expert-block__title">
                        <?php echo $publications_title; ?>
                    </h2>
                <?php endif; ?>
                <?php if ( $publications_subtitle ) : ?>
                    <p class="expert-block__subtitle">
                        <?php echo $publications_subtitle; ?>
                    </p>
                <?php endif; ?>
                
                <div class="expert-publications__table">
                    <div class="table-header">
                        <span class="table-header__title"><?php echo _e( 'Title', '_iag' ); ?></span>
                        <span class="table-header__title"><?php echo _e( 'Journal', '_iag' ); ?></span>
                        <span class="table-header__title"><?php echo _e( 'Year', '_iag' ); ?></span>
                        <span class="table-header__title"><?php echo _e( 'Cited By', '_iag' ); ?></span>
                        <span class="table-header__title"><?php echo _e( 'Link', '_iag' ); ?></span>
                    </div>
                    <div class="table-body">
                        <?php while ( have_rows( 'publications_list', $expert_id ) ) : the_row(); 
                            $title    = get_sub_field( 'publication_title' ) ?? false;
                            $journal  = get_sub_field( 'journal' ) ? get_sub_field( 'journal' ) : "";
                            $year     = get_sub_field( 'publication_year' ) ? get_sub_field( 'publication_year' ) : "";
                            $cited_by = get_sub_field( 'cited_by' ) ? get_sub_field( 'cited_by' ) : "";
                            $link     = get_sub_field( 'publication_link' ) ? get_sub_field( 'publication_link' ) : ""; ?>
    
                            <?php if ( $title ) : ?>
                                <div class="publication">
                                    <div class="publication__item publication__title">
                                        <span class="publication__item-content">
                                            <?php echo $title; ?>
                                        </span>
                                    </div>
                                    <div class="publication__item publication__journal">
                                        <span class="publication__item-content">
                                            <?php echo $journal; ?>
                                        </span>
                                    </div>
                                    <div class="publication__item publication__year">
                                        <span class="publication__item-content">
                                            <?php echo $year; ?>
                                        </span>
                                    </div>
                                    <div class="publication__item publication__cited">
                                        <span class="publication__item-content">
                                            <?php echo $cited_by; ?>
                                        </span>
                                    </div>
                                    <div class="publication__item publication__link">
                                        <?php if ( $link ) : 
                                            $link_url    = $link['url'];
                                            $link_title  = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
       
                                            <a class="publication__link-button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
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

                    <a class="expert-publications__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                        <?php echo esc_html( $link_title ); ?>
                        <svg class="icon">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ( have_rows( 'content_column', $expert_id ) ) : ?>
            <div class="expert-appointments expert-block">
                <?php if ( $appointments_title ) : ?>
                    <h2 class="h2 expert-block__title">
                        <?php echo $appointments_title; ?>
                    </h3>
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
        <?php endif; ?>

        <?php if ( have_rows( 'education_and_training_list', $expert_id ) ) : ?>
            <div class="expert-education expert-block">
                <h2 class="h2 expert-block__title">
                    <?php echo _e( 'Education & Training', '_iag' ); ?>
                </h2>
                
                <div class="expert-education__table">
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
    

                            <div class="education">
                                <div class="education__item education__year">
                                    <?php echo $year; ?>
                                </div>
                                <div class="education__item education__qualification">
                                    <?php echo $qualification; ?>
                                </div>
                                <div class="education__item education__institution">
                                    <?php echo $institution; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="expert-resources expert-block">
            <h2 class="h2 expert-block__title">
                <?php echo _e( 'External Resources & Links', '_iag' ); ?>
            </h3>
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

                                    <a class="resources-column__website" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
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
    
                                        <a class="resources-column__profile-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
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
                            $location_type  = get_sub_field( 'location_type' ) ?? false;
                            $location_title = get_sub_field( 'location_title' ) ?? false; ?>

                            <?php if ( $location_title ) : ?>
                                <div class="resources-column__location">
                                    <?php if ( $location_type ) : ?>
                                        <span class="resources-column__location-type">
                                            <?php echo $location_type; ?>
                                        </span>
                                    <?php endif; ?>
                                    <span class="resources-column__location-title">
                                        <?php echo $location_title; ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="expert-contact" id="expert-contacts"></div>
    </div>
</article>


<?php
get_footer();
<?php
/**
 *Template Name: System Page
 */

get_header();

$page_uptitle	 = get_field( 'page_uptitle' ) ?? false;
$page_title	     = get_field( 'page_title' ) ?? false;
$page_subtitle   = get_field( 'page_subtitle' ) ?? false;
$page_banner     = get_field( 'page_banner' ) ?? false;
$youtube_url     = get_field( 'main_youtube_url', 'options' ) ?? false;
$linkedin_url    = get_field( 'main_linkedin_url', 'options' ) ?? false;
$youtube_icon    = get_field( 'main_youtube_icon', 'options' ) ?? false;
$linkedin_icon   = get_field( 'main_linkedin_icon', 'options' ) ?? false;
?>
<section class="system-page">
    <div class="system-page__banner">
        <?php if ( $page_banner ) : ?>
            <?php echo wp_get_attachment_image( $page_banner, 'full', false, [ 'class' => 'resource-banner__banner-img' ] ); ?>
        <?php endif; ?>

        <div class="container">
            <div class="system-page__banner-content">
                <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
                    
                <?php if ( $page_uptitle ) : ?>
                    <h1 class="h1 content-uptitle">
                        <?php echo esc_html( $page_uptitle ); ?>
                    </h1>
                <?php endif; ?>
    
                <?php if ( $page_title ) : ?>
                    <h1 class="h1 content-title">
                        <?php echo esc_html( $page_title ); ?>
                    </h1>
                <?php endif; ?>
                
                <?php if ( $page_subtitle ) : ?>
                    <p class="content-subtitle">
                        <?php echo esc_html( $page_subtitle ) ; ?>
                    </p>
                <?php endif; ?>
    
                <div class="system-page__banner-content__share">
                    <span class="share-label">
                        <?php echo _e( 'Follow & Share: '); ?>
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
        </div>
    </div>
</section>

<section class="system-page__main bg-white">
    <div class="container">
        <div class="system-page__main-table">
            <div class="table-of-content hidden">
                <span class="table-of-content__title"><?php echo _e( 'Table of Content', '_iag' ); ?></span>
                <div id="table_of_content"></div>
            </div>
        </div>
        <div class="system-page__main-content">
            <?php if ( have_rows( 'post_builder' ) ) : ?>
                <?php get_template_part( 'template-parts/post-builder' ); ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_footer();
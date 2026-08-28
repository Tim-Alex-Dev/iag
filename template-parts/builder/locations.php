<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-locations bg-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">
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

        <?php if ( have_rows( 'locations_list' ) ) : ?>
            <div class="m-locations__list">
                <?php while ( have_rows( 'locations_list' ) ) : the_row(); 
                    $map_banner       = get_sub_field( 'map_banner' ) ?? false;
                    $google_maps_url  = get_sub_field( 'google_maps_url' ) ?? false;
                    $location_type    = get_sub_field( 'location_type' ) ?? false;
                    $location_country = get_sub_field( 'location_country' ) ?? false;
                    $location_title   = get_sub_field( 'location_title' ) ?? false;
                    $location_phone   = get_sub_field( 'location_phone' ) ?? false; ?>

                    <div class="m-locations__list-location">
                        <?php if ( $map_banner ) : ?>
                            <div class="location-banner">
                                <?php echo wp_get_attachment_image( $map_banner, 'full', false, [ 'class' => 'location-banner__img' ] ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="location-content">
                            <?php if ( $location_type || $location_country ) : ?>
                                <div class="location-content__header">
                                    <?php if ( $location_type ) : ?>
                                        <span class="chip location-content__header-type">
                                            <?php echo esc_html( $location_type ); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ( $location_country ) : ?>
                                        <span class="location-content__header-country">
                                            <?php echo esc_html( $location_country ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $location_title ) : ?>
                                <div class="location-content__title">
                                    <div class="location-content__title-icon">
                                        <svg><use xlink:href="#address"></use></svg>
                                    </div>
                                    <span class="location-content__title-text">
                                        <?php echo wp_kses_post( $location_title ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <?php if ( $location_phone ) :
                                $tel = it_phone_cleaner($location_phone); ?>

                                <div class="location-content__phone">
                                    <div class="location-content__phone-icon">
                                        <svg><use xlink:href="#phone"></use></svg>
                                    </div>
                                    <a class="location-content__phone-link" href="tel:<?php echo esc_attr( $tel ); ?>">
                                        <?php echo esc_html( $location_phone ); ?>
                                    </a>
                                </div>
                                <?php if ( $google_maps_url ) : ?>
                                    <a class="location-content__url" href="<?php echo esc_url( $google_maps_url ); ?>" target="_blank">
                                        <svg><use xlink:href="#pointer"></use></svg>
                                        <?php _e( 'Get Directions', '_iag' ); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if ( have_rows( 'locations_url_list' ) ) : ?>
            <div class="m-locations__links">
                <?php while ( have_rows( 'locations_url_list' ) ) : the_row(); 
                    $item_icon   = get_sub_field( 'item_icon' ) ?? false;
                    $item_label  = get_sub_field( 'item_label' ) ?? false;
                    $item_url    = get_sub_field( 'item_url' ) ?? false; ?>

                    <?php if ( $item_label || $item_url ) : ?>
                        <div class="link-item">
                            <?php if ( $item_icon ) : ?>
                                <div class="link-item__icon">
                                    <?php echo wp_get_attachment_image( $item_icon, 'thumbnail', false, [ 'class' => 'link-item__icon-img' ] ); ?>
                                </div>
                                <?php if ( $item_label ) : ?>
                                    <span class="link-item__label">
                                        <?php echo esc_html( $item_label ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $item_url ) : 
                                    $link_url = $item_url['url'];
                                    $link_title = $item_url['title'];
                                    $link_target = $item_url['target'] ? $item_url['target'] : '_self'; ?>

                                    <a class="link-item__url" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                        <?php echo esc_html( $link_title ); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>  
    </div>
</section>
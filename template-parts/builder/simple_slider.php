<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-slider bg-<?php echo esc_attr( $color_theme ); ?>">
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

            <div class="m-slider__swiper-arrows swiper-arrows">
                <div class="swiper-button-prev m-slider__swiper-button-prev">
                    <svg class="arrow-left"><use xlink:href="#angle-left"></use></svg>
                </div>
                <div class="swiper-button-next m-slider__swiper-button-next">                    
                    <svg class="arrow-right"><use xlink:href="#angle-right"></use></svg>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( have_rows( 'slider_list' ) ) : ?>
            <div class="m-slider__swiper swiper">
                <div class="swiper-wrapper">
                    <?php while ( have_rows( 'slider_list' ) ) : the_row();
                        $slider_banner      = get_sub_field( 'slider_item_banner' ) ?? false;
                        $slider_title       = get_sub_field( 'slider_item_title' ) ?? false;
                        $slider_description = get_sub_field( 'slider_item_description' ) ?? false;
                        $slider_category    = get_sub_field( 'slider_item_category' ) ?? false;
                        $slider_link        = get_sub_field( 'slider_item_link' ) ?? false; ?>

                        <?php if ( $slider_title && $slider_banner ) : ?>
                            <div class="swiper-slide">
                                <div class="swiper-slide__banner">
                                    <?php echo wp_get_attachment_image( $slider_banner, 'full', false, [ 'class' => 'swiper-slide__banner-img' ] ); ?>
                                </div>
                                <div class="swiper-slide__content">
                                    <span class="swiper-slide__content-title">
                                        <?php echo esc_html( $slider_title ); ?>
                                    </span>
                                    <?php if ( $slider_description ) : ?>
                                        <div class="swiper-slide__content-description">
                                            <?php echo esc_html( $slider_description ); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( $slider_category || $slider_link ) : ?>
                                        <div class="swiper-slide__content-footer">
                                            <?php if ( $slider_category ) : ?>
                                                <div class="chip footer-category">
                                                    <?php echo esc_html( $slider_category ); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ( $slider_link ) :
                                                $link_url    = $slider_link['url'];
                                                $link_title  = $slider_link['title'];
                                                $link_target = $slider_link['target'] ? $slider_link['target'] : '_self'; ?>
                                    
                                                <a class="btn btn-simple footer-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                                    <?php echo esc_html( $link_title ); ?>
                                                    <svg class="icon">
                                                        <use xlink:href="#arrow-right"></use>
                                                    </svg>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
	</div>
</section>
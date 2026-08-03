<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-partnership bg-<?php echo esc_attr( $color_theme ); ?>">
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

        <div class="m-partnership__swipers">
            <?php if ( have_rows( 'module_gallery' ) ) : ?>
                <?php $row_index = 0; ?>
                <div class="m-partnership__swiper-top swiper">
                    <div class="swiper-wrapper">
                        <?php while ( have_rows( 'module_gallery' ) ) : the_row();
                            $row_index++;

                            if ( 0 === $row_index % 2 ) {
                                continue;
                            }

                            $slide_icon = get_sub_field( 'gallery_icon' );
                            $slide_text = get_sub_field( 'gallery_title' ); ?>

                            <?php if ( $slide_icon && $slide_text ) : ?>
                            <div class="m-partnership__swiper-slide swiper-slide">
                                <?php echo wp_get_attachment_image( $slide_icon, 'thumbnail', false, [ 'class' => 'slide-icon' ] ); ?>

                                <div class="slide-text">
                                    <?php echo wp_kses_post( $slide_text ); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( have_rows( 'module_gallery' ) ) : ?>
                <?php $row_index = 0; ?>
                <div class="m-partnership__swiper-bottom swiper">
                    <div class="swiper-wrapper">
                        <?php while ( have_rows( 'module_gallery' ) ) : the_row();
                            $row_index++;

                            if ( 0 !== $row_index % 2 ) {
                                continue;
                            }

                            $slide_icon = get_sub_field( 'gallery_icon' );
                            $slide_text = get_sub_field( 'gallery_title' ); ?>

                            <?php if ( $slide_icon && $slide_text ) : ?>
                                <div class="m-partnership__swiper-slide swiper-slide">
                                    <?php echo wp_get_attachment_image( $slide_icon, 'thumbnail', false, [ 'class' => 'slide-icon' ] ); ?>

                                    <div class="slide-text">
                                        <?php echo wp_kses_post( $slide_text ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
	    </div>
	</div>
</section>
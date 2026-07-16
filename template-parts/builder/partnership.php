<?php
$module_id              = get_sub_field( 'module_id' ) ?: '';
$color_theme            = get_sub_field( 'color_theme' ) ?: 'white';
$module_title           = get_sub_field( 'module_title' ) ?? false;
$module_title_alignment = get_sub_field( 'module_title_alignment' ) ?: 'center';
$module_subtitle        = get_sub_field( 'module_subtitle' ) ?? false;
$module_gallery 		= get_sub_field( 'module_gallery' ) ?? false;
$module_link     		= get_sub_field( 'module_link' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-partnership module-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">

        <?php if ( $module_title ) : ?>  
            <?php get_template_part( 'template-parts/builder/components/title', null, [ 'class' => 'm-partnership__title' ] ); ?>
        <?php endif; ?>
    
        <?php if ( $module_subtitle ) : ?>
            <p class="c-subtitle m-partnership__subtitle text-<?php echo esc_html( $module_title_alignment ); ?>">
                <?php echo esc_html( $module_subtitle ); ?>
            </p>
        <?php endif; ?>
        
        <?php if ( $module_gallery ) :
            $half = ceil( count( $module_gallery ) / 2 );
            $top_gallery    = array_slice( $module_gallery, 0, $half );
            $bottom_gallery = array_slice( $module_gallery, $half ); ?>

            <div class="m-partnership__swipers">
                <div class="m-partnership__swiper-top swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ( $top_gallery as $slide_id ) : ?>
                            <div class="swiper-slide">
                                <div class="slide-icon__wrapper">
                                    <?php echo wp_get_attachment_image( $slide_id, 'thumbnail', false, [ 'class' => 'slide-icon' ] ); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="m-partnership__swiper-bottom swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ( $bottom_gallery as $slide_id ) : ?>
                            <div class="swiper-slide">
                                <?php echo wp_get_attachment_image( $slide_id, 'thumbnail', false, [ 'class' => 'swiper-slide-icon' ] ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( $module_link ) :
            $link_url = $module_link['url'];
            $link_title = $module_link['title'];
            $link_target = $module_link['target'] ? $module_link['target'] : '_self'; ?>
    
            <a class="btn btn-primary btn-lg m-partnership__btn btn-<?php echo esc_html( $module_title_alignment ); ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                <?php echo esc_html( $link_title ); ?>
            </a>
        <?php endif; ?>
	</div>
</section>
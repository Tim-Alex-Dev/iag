<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
$stars_group      = get_sub_field( 'stars_group' ) ?? false;
$is_link          = get_sub_field( 'add_archive_link' ) ?? false;
$experts          = get_sub_field( 'experts_list' ) ?? false;
$leadership       = get_sub_field( 'leadership_members_list' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-stars bg-<?php echo esc_attr( $color_theme ); ?>">
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

            <div class="m-stars__swiper-arrows swiper-arrows">
                <div class="swiper-button-prev m-stars__swiper-button-prev">
                    <svg class="arrow-left"><use xlink:href="#angle-left"></use></svg>
                </div>
                <div class="swiper-button-next m-stars__swiper-button-next">                    
                    <svg class="arrow-right"><use xlink:href="#angle-right"></use></svg>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( $stars_group === 'experts' && $experts ) : ?>
            <div class="m-stars__swiper swiper">
                <div class="swiper-wrapper">
                    <?php foreach ( $experts as $expert_id ) : ?>
                        <?php get_template_part( 'template-parts/components/expert', null, [ 'expert_id' => $expert_id, 'class' => 'swiper-slide' ] ); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ( $stars_group === 'leadership' && $leadership ) : ?>
            <div class="m-stars__swiper">
	            <?php foreach ( $leadership as $leadership_id ) : ?>
		            <?php get_template_part( 'template-parts/components/leadership', null, [ 'leadership_id' => $leadership_id, ] ); ?>
	            <?php endforeach; ?>
            </div>
        <?php endif; ?>
	</div>
</section>
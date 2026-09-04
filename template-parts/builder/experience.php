<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
?>


<section id="<?php echo esc_attr($module_id); ?>" class="module m-experience bg-<?php echo esc_attr( $color_theme ); ?>">
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
    
        <?php if ( have_rows( 'tabs_list' ) ) : ?>
            <div class="m-experience__tabs js-tabs tabs ">
                <div class="m-experience__tabs-titles tabs__titles">
                    <?php while ( have_rows( 'tabs_list' ) ) : the_row(); 
                        $title     = get_sub_field( 'tab_title' ) ?? false; 
                        $index     = get_row_index(); 
                        $is_active = $index === 1 ? ' is-active' : ''; ?>
                        
                        <?php if ( $title ) : ?>
                            <div class="m-experience__tabs-titles-title js-tab-title<?php echo esc_attr( $is_active ); ?>" 
                                data-item="expert-tab-<?php echo $index; ?>">
                                <?php echo esc_html( $title ); ?>
                            </div>
                        <?php endif; ?>
    
                    <?php endwhile; ?>
    
                </div>


                <div class="m-experience__tabs-contents tabs__contents">
                    <?php while ( have_rows( 'tabs_list' ) ) : the_row();
                        $index     = get_row_index(); 
                        $is_active = $index === 1 ? ' is-active' : ''; ?>
    
                        <div class="m-experience__swiper swiper js-tab-content<?php echo esc_attr( $is_active ); ?>" id="expert-tab-<?php echo $index; ?>"> 
                            <?php if ( have_rows( 'tab_content' ) ) : ?>

                                <div class="m-experience__swiper-pagination swiper-pagination"></div>
                                
                                <div class="swiper-wrapper">
                                    <?php while ( have_rows( 'tab_content' ) ) : the_row(); 
                                        $title       = get_sub_field( 'card_title' ) ?? false; 
                                        $description = get_sub_field( 'card_description' ) ?? false; 
                                        $banner      = get_sub_field( 'card_banner' ) ?? false; 
                                        $link        = get_sub_field( 'card_link' ) ?? false; ?>
                                        
                                        <?php if ( $title && $banner ) : ?>
                                            <div class="m-experience__card swiper-slide">
                                                <?php echo wp_get_attachment_image( $banner, 'medium', false, [ 'class' => 'm-experience__card-banner' ] ); ?>
                                                <span class="h4 m-experience__card-title">
                                                    <?php echo esc_html( $title ); ?>
                                                </span>
                                                <?php if ( $description || $link ) : ?>
                                                    <div class="m-experience__card-details">
                                                        <?php if ( $description ) : ?>
                                                            <div class="m-experience__card-description">
                                                                <?php echo esc_html( $description ); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ( $link ) :
                                                            $link_url = $link['url'];
                                                            $link_title = $link['title'];
                                                            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                
                                                            <a class="btn btn-primary m-experience__card-btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                                                <?php echo esc_html( $link_title ); ?>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
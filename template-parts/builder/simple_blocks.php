<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_alignment = get_sub_field( 'module_title_alignment' ) ?: 'left';
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-simple-blocks bg-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">
		<?php if ( $module_title || $module_subtitle || $module_uptitle ) : ?>
            <div class="module-header alignment-<?php echo esc_html( $module_alignment ); ?>">
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

        <?php if ( have_rows( 'block_lists' ) ) : ?>
            <div class="m-simple-blocks__repeater">
                <?php while ( have_rows( 'block_lists' ) ) : the_row(); 
                    $list_grid = get_sub_field( 'module_grid' ) ?? false;
                    $list_type = get_sub_field( 'module_type' ) ?? false;
                    $is_follow = get_sub_field( 'follow_icon' ) ? ' is-follow' : ' no-follow'; ?>

                    <?php if ( have_rows( 'blocks_list' ) ) : ?> 
                        <div class="m-simple-blocks__list grid-<?php echo esc_attr( $list_grid ); ?><?php echo esc_attr( $is_follow ); ?>">
                            <?php while ( have_rows( 'blocks_list' ) ) : the_row(); 
                                $title    = get_sub_field( 'block_title' ) ?? false; 
                                $icon     = get_sub_field( 'block_icon' ) ?? false; 
                                $link     = get_sub_field( 'block_link' ) ?? false; 
                                $subtitle = get_sub_field( 'block_subtitle' ) ?? false; 
                                $uptitle  = get_sub_field( 'block_uptitle' ) ?? false; 
                                $chip     = get_sub_field( 'block_header_chip' ) ?? false; 
                                $index    = get_row_index(); ?> 
            
                                <?php if ( $title && $subtitle ) : ?>
                                    <div class="simple-block">
                                        <div class="simple-block__header">
                                            <?php if ( $list_type === 'uptitle' ) : ?>
                                                <span class="simple-block__header-index">
                                                    0<?php echo $index; ?> 
                                                </span>
                                                <?php if ( $chip ) : ?>
                                                    <span class="simple-block__header-uptitle">
                                                        <?php echo esc_html( $chip ); ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ( $list_type === 'icon' && $icon ) : ?>
                                                <div class="simple-block__header-icon">
                                                    <?php echo wp_get_attachment_image( $icon, 'thumbnail', false, [ 'class' => 'icon' ] ); ?> 
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="simple-block__body">
                                            <?php if ( $uptitle ) : ?>
                                                <span class="simple-block__body-uptitle">
                                                    <?php echo esc_html( $uptitle ); ?>
                                                </span>
                                            <?php endif; ?>
                                            <span class="simple-block__body-title">
                                                <?php echo esc_html( $title ); ?>
                                            </span>
                                            <p class="simple-block__body-subtitle">
                                                <?php echo esc_html( $subtitle ); ?>
                                            </p>
                                        </div>
                                        <?php if ( $link ) : 
                                            $link_url    = $link['url'];
                                            $link_title  = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                        
                                            <a class="btn btn-simple simple-block__btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                                <?php echo esc_html( $link_title ); ?>
                                                <svg class="icon">
                                                    <use xlink:href="#arrow-right"></use>
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div> 
        <?php endif; ?>
	</div>
</section>
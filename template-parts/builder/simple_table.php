<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$table_header     = get_sub_field( 'table_header' ) ? 'true' : 'false';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-table bg-<?php echo esc_attr( $color_theme ); ?>">
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

        <?php if ( have_rows( 'module_table' ) ) : ?>
            <div class="m-table__main main-header-<?php echo esc_attr( $table_header ); ?>">
                <?php while ( have_rows( 'module_table' ) ) : the_row();
                    $content_left  = get_sub_field( 'left_column_content' );
                    $content_right = get_sub_field( 'right_column_content' );
                    $is_link_left  = get_sub_field( 'is_link_left' );
                    $is_link_right = get_sub_field( 'is_link_right' );
                    $url_left      = get_sub_field( 'item_url_left' );
                    $url_right     = get_sub_field( 'item_url_right' ); ?>

                    <?php if ( $content_left && $content_right ) : ?>
                        <div class="m-table__main-row">
                            <div class="table-item table-item__left">
                                <div class="table-item__text">
                                    <?php echo esc_html( $content_left ); ?>
                                </div>
                                <?php if ( $is_link_left && $url_left ) : ?>
                                    <a class="table-item__link" href="<?php echo esc_url( $url_left ); ?>" target="_blank">
                                        <svg><use xlink:href="#pointer"></use></svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="table-item table-item__right">
                                <div class="table-item__text">
                                    <?php echo esc_html( $content_right ); ?>
                                </div>
                                <?php if ( $is_link_right && $url_right ) : ?>
                                    <a class="table-item__link" href="<?php echo esc_url( $url_right ); ?>" target="_blank">
                                        <svg><use xlink:href="#pointer"></use></svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?> 
	</div>
</section>
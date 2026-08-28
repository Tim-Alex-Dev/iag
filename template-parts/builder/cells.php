<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
$module_link      = get_sub_field( 'module_link' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-cells bg-<?php echo esc_attr( $color_theme ); ?>">
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

        <?php if ( have_rows( 'cells_list' ) ) : ?>
            <div class="m-cells__list">
                <?php while ( have_rows( 'cells_list' ) ) : the_row(); 
                    $cell_title       = get_sub_field( 'cell_title' ) ?? false;
                    $cell_description = get_sub_field( 'cell_description' ) ?? false;
                    $primary_cell     = get_sub_field( 'primary_cell' ) ?? false;
                    $cell_category    = get_sub_field( 'cell_category' ) ?? false; ?>

                    <?php if ( $cell_title ) : ?>
                        <div class="cell-item<?php echo $primary_cell ? ' cell-item__primary' : ''; ?>">
                            <h3 class="h3 cell-item__title">
                                <?php echo esc_html( $cell_title ); ?>
                            </h3>
                            <?php if ( $cell_description ) : ?>
                                <span class="cell-item__description">
                                    <?php echo esc_html( $cell_description ); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( $primary_cell && $cell_category ) : ?>
                                <div class="chip cell-item__category">
                                    <?php echo esc_html( $cell_category ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
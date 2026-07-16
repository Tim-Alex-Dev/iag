<?php
$module_id              = get_sub_field( 'module_id' ) ?: '';
$color_theme            = get_sub_field( 'color_theme' ) ?: 'white';
$module_title           = get_sub_field( 'module_title' ) ?? false;
$module_title_alignment = get_sub_field( 'module_title_alignment' ) ?: 'center';
$module_subtitle        = get_sub_field( 'module_subtitle' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-accordion module-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">
		<?php if ( $module_title || $module_subtitle ) : ?>
			<div class="m-accordion__content">
				<?php if ( $module_title ) : ?>  
					<?php get_template_part( 'template-parts/builder/components/title', null, [ 'class' => 'm-accordion__title' ] ); ?>
				<?php endif; ?>
			
				<?php if ( $module_subtitle ) : ?>
					<p class="subtitle m-accordion__subtitle text-<?php echo esc_html( $module_title_alignment ); ?>">
						<?php echo esc_html( $module_subtitle ); ?>
					</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

        <?php if ( have_rows( 'accordion_list' ) ) : ?>
            <div class="m-accordion__list js-accordion">
                <?php while ( have_rows( 'accordion_list' ) ) : the_row();
                    $title = get_sub_field( 'item_title' ) ?? false; ?>

                    <?php if ( $title ) : ?>
                        <div class="m-accordion__list-item js-accordion-item">
                            <div class="m-accordion__list-title js-accordion-title">
                                <?php echo esc_html( $title ); ?>
                                <svg class="m-accordion__list-title-icon"><use xlink:href="#close"></use></svg>
                            </div>
                            <?php if ( have_rows( 'item_content' ) ) : ?>
                                <div class="js-accordion-content">
                                    <div class="m-accordion__list-content">
                                        <?php while ( have_rows( 'item_content' ) ) : the_row();
                                            $title = get_sub_field( 'title' ) ?? false;
                                            $description = get_sub_field( 'description' ) ?? false; ?>
    
                                            <?php if ( $title || $description ) : ?>
                                                <div class="content-card">
                                                    <?php if ( $title ) : ?>
                                                        <span class="h5 content-card__title">
                                                            <?php echo esc_html( $title ); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if ( $description ) : ?>
                                                        <p class="content-card__description">
                                                            <?php echo esc_html( $description ); ?>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endwhile ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
        <?php endif; ?>
	</div>
</section>
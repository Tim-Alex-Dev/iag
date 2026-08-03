<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-testimonials bg-<?php echo esc_attr( $color_theme ); ?>">
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

        <?php if ( have_rows( 'info_blocks_list' ) || have_rows( 'testimonials_list' ) ) : ?>
            <div class="m-testimonials__content">
                <?php if ( have_rows( 'info_blocks_list' ) ) : ?>
                    <div class="m-testimonials__info">
                        <?php while ( have_rows( 'info_blocks_list' ) ) : the_row();
                            $title_primary   = get_sub_field( 'title_primary' );
                            $title_secondary = get_sub_field( 'title_secondary' );
                            $description     = get_sub_field( 'description' );
                            $category        = get_sub_field( 'category' ); ?>

                            <?php if ( $title_primary || $title_secondary ) : ?>
                                <div class="info-block">
                                    <div class="info-block__title">
                                        <?php if ( $title_primary ) : ?>
                                            <span class="title-primary">
                                                <?php echo esc_html( $title_primary ); ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ( $title_secondary ) : ?>
                                            <span class="title-secondary">
                                                <?php echo esc_html( $title_secondary ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ( $description ) : ?>
                                        <p class="info-block__description">
                                            <?php echo esc_html( $description ); ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if ( $category ) : ?>
                                        <p class="info-block__category">
                                            <?php echo esc_html( $category ); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if ( have_rows( 'testimonials_list' ) ) : ?>
                    <div class="m-testimonials__list">
                        <?php while ( have_rows( 'testimonials_list' ) ) : the_row();
                            $content = get_sub_field( 'testimonial_text' );
                            $author  = get_sub_field( 'author' );
                            $company = get_sub_field( 'company' ); ?>

                            <?php if ( $content ) : ?>
                                <div class="testimonial-block">
                                    <p class="testimonial-block__content">
                                        <?php echo esc_html( $content ); ?>
                                    </p>

                                    <?php if ( $author ) : ?>
                                        <div class="testimonial-block__author">
                                            <span class="author">
                                                <?php echo esc_html( $author ); ?>
                                            </span>
                                            <?php if ( $company ) : ?>
                                                <span class="company">
                                                    <?php echo esc_html( $company ); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>    
            </div>
        <?php endif; ?> 
	</div>
</section>
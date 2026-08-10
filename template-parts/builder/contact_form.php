<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
$module_link      = get_sub_field( 'module_link' ) ?? false;
$contact_form     = get_sub_field( 'contact_form' ) ?? false;
?>


<section id="<?php echo esc_attr($module_id); ?>" class="module m-cf bg-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">
        <div class="m-cf__content">
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

            <?php if ( have_rows( 'content_list' ) ) : ?>
                <div class="m-cf__list">
                    <?php while ( have_rows( 'content_list' ) ) : the_row(); 
                        $item_title       = get_sub_field( 'content_title' );
                        $item_description = get_sub_field( 'content_description' ); ?>

                        <?php if ( $item_title ) : ?>
                            <div class="m-cf__list-item">
                                <div class="list-item__icon">
                                    <svg><use xlink:href="#checkmark"></use></svg>
                                </div>
                                <div class="list-item__content">
                                    <span class="list-item__content-title">
                                        <?php echo esc_html( $item_title ); ?>
                                    </span>
                                    <?php if ( $item_description ) : ?>
                                        <span class="list-item__content-description">
                                            <?php echo esc_html( $item_description ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <?php if ( $module_link ) : 
                $link_url    = $module_link['url'];
                $link_title  = $module_link['title'];
                $link_target = $module_link['target'] ? $module_link['target'] : '_self'; ?>

                <a class="btn btn-primary m-cf__btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                    <?php echo esc_html( $link_title ); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if ( $contact_form ) : 
            $id    = $contact_form->ID ?? false;
            $title = get_the_title( $contact_form->ID ) ?? false; ?>

            <div class="m-cf__form">
                <?php if ( $id && $title ) : ?>
                    <div class="contact-form__wrapper">
                        <?php echo do_shortcode( '[contact-form-7 id="'.$id.'" title="'.$title.'"]' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
	</div>
</section>
<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$color_theme      = get_sub_field( 'color_theme' ) ?: 'white';
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_alignment = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle  = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
$follow_link      = get_sub_field( 'cta_button_link' ) ?? false;
$follow_icon      = get_sub_field( 'cta_button_icon' ) ?? false;
$follow_subtitle  = get_sub_field( 'cta_button_subtitle' ) ?? false;

?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-follow bg-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">
        <div class="m-follow__inner">
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
            
            <?php if ( $follow_link ) : 
                $link_url = $follow_link['url'];
                $link_title = $follow_link['title'];
                $link_target = $follow_link['target'] ? $follow_link['target'] : '_self'; ?>
                
                <div class="m-follow__inner-content">                
                    <a class="btn btn-primary content-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                        <?php if ( $follow_icon ) : ?>
                        	<?php echo wp_get_attachment_image( $follow_icon, 'thumbnail', false, [ 'class' => 'content-link__icon' ] ); ?>
                        <?php endif; ?>
                        <?php echo esc_html( $link_title ); ?>
                    </a>
                    <?php if ( $follow_subtitle ) : ?>
                        <span class="content-subtitle">
                            <?php echo esc_html( $follow_subtitle ); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
	</div>
</section>
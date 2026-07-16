<?php
$module_id              = get_sub_field( 'module_id' ) ?: '';
$color_theme            = get_sub_field( 'color_theme' ) ?: 'white';
$module_title           = get_sub_field( 'module_title' ) ?? false;
$module_title_alignment = get_sub_field( 'module_title_alignment' ) ?: 'center';
$module_subtitle        = get_sub_field( 'module_subtitle' ) ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-simple-blocks module-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">
		<?php if ( $module_title || $module_subtitle ) : ?>
			<div class="m-partnership__content">
				<?php if ( $module_title ) : ?>  
					<?php get_template_part( 'template-parts/builder/components/title', null, [ 'class' => 'm-simple-blocks__title' ] ); ?>
				<?php endif; ?>
			
				<?php if ( $module_subtitle ) : ?>
					<p class="c-subtitle m-simple-blocks__subtitle text-<?php echo esc_html( $module_title_alignment ); ?>">
						<?php echo esc_html( $module_subtitle ); ?>
					</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

        <?php if ( have_rows( 'blocks_list' ) ) : ?> 
            <div class="m-simple-blocks__list"> 
                <?php while ( have_rows( 'blocks_list' ) ) : the_row(); 
                    $title = get_sub_field( 'block_title' ) ?? false; 
                    $banner = get_sub_field( 'block_banner' ) ?? false; 
                    $description = get_sub_field( 'block_description' ) ?? false; 
                    $url = get_sub_field( 'block_url' ) ?? false; ?> 
                    
                    <?php if ( $title && $banner ) : ?> 
                        <?php if ( $url ) : ?> 
                            <a class="simple-block block-url" href="<?php echo esc_url( $url ); ?>" target='_blank'> 
                        <?php else : ?> 
                            <div class="simple-block"> 
                        <?php endif; ?> 

                        <div class="simple-block__banner"> 
                            <?php echo wp_get_attachment_image( $banner, 'large', false, [ 'class' => 'simple-block__banner-img' ] ); ?> 
                        </div> 

                        <span class="h4 simple-block__title"> 
                            <?php echo esc_html( $title ); ?> 
                        </span> 

                        <?php if ( $description ) : ?> 
                            <div class="simple-block__description"> 
                                <?php echo esc_html( $description ); ?> 
                            </div> 
                        <?php endif; ?> 

                        <?php if ( $url ) : ?> 
                            </a> 
                        <?php else : ?> 
                            </div> 
                        <?php endif; ?> 
                    <?php endif; ?> 
                <?php endwhile; ?> 
            </div> 
        <?php endif; ?>
	</div>
</section>
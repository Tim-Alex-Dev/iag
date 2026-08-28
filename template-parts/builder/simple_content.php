<?php
$module_id          = get_sub_field( 'module_id' ) ?: '';
$color_theme        = get_sub_field( 'color_theme' ) ?: 'white';
$module_type        = get_sub_field( 'content_type' ) ?? false;
$media_type         = get_sub_field( 'media_type' ) ? get_sub_field( 'media_type' ) : 'image';
$module_orientation = get_sub_field( 'media_orientation' ) ?: 'media-right';

$module_title       = get_sub_field( 'module_title' ) ?? false;
$module_alignment   = get_sub_field( 'module_header_alignment' ) ?: 'left';
$module_subtitle    = get_sub_field( 'module_subtitle' ) ?? false;
$module_uptitle     = get_sub_field( 'module_uptitle' ) ?? false;

$module_text        = get_sub_field( 'text_content' ) ?? false;
$module_link        = get_sub_field( 'module_link' ) ?? false;

$media_image        = get_sub_field( 'module_image' ) ?? false;
$media_video        = get_sub_field( 'module_video' ) ?? false;
$video_title        = $media_video ? get_sub_field( 'video_title' ) : false;
$media_video_banner = get_sub_field( 'video_banner' ) ?? false;
$media_embed        = get_sub_field( 'embed_video' ) ?? false;

$video_id           = ( $media_type === 'video' && $media_video ) ? attachment_url_to_postid( $media_video ) : false;
$video_metadata     = $video_id ? wp_get_attachment_metadata( $video_id ) : false;
$video_duration     = $video_metadata ? $video_metadata['length_formatted'] : false;
?>


<section id="<?php echo esc_attr($module_id); ?>" class="module m-simple-content content-<?php echo esc_attr( $module_type ); ?> <?php echo esc_attr( $module_orientation ); ?> bg-<?php echo esc_attr( $color_theme ); ?>">
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

        <div class="m-simple-content__inner">
            <?php if ( ( $module_type === 'text' || $module_type === 'mixed' ) && $module_text ) : ?>
                <div class="m-simple-content__text left">
                    <div class="editor text-content">
                        <?php echo wp_kses_post( $module_text ); ?>
                    </div>
                    <?php if ( $module_link ) : 
                        $link_url    = $module_link['url'];
                        $link_title  = $module_link['title'];
                        $link_target = $module_link['target'] ? $module_link['target'] : '_self'; ?>
            
                        <a class="btn btn-primary link-content" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                            <?php echo esc_html( $link_title ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
    
            <?php if ( ( $module_type === 'media' || $module_type === 'mixed' ) && ( $media_image || $media_video || $media_embed) ) : ?>
                <?php if ( $media_type === 'image' && $media_image ) : ?>
                    <div class="m-simple-content__media media-image right">
                        <?php echo wp_get_attachment_image( $media_image, 'full', false, [ 'class' => 'media-image__img' ] ); ?>
                    </div>
                <?php endif; ?>
            
                <?php if ( $media_type === 'video' && $media_video ) : ?>
                    <?php if ( $media_video_banner ) : ?>
                        <a class="m-simple-content__media media-video right" data-fancybox="video" href="<?php echo esc_url( $media_video ); ?>">
                            <?php echo wp_get_attachment_image( $media_video_banner, 'large', false, [ 'class' => 'video-poster' ] ); ?>
                            
                            <div class="video-controls">
                                <svg><use xlink:href="#play-circle"></use></svg>
                            </div>
        
                            <?php if ( $video_title || $video_duration ) : ?>
                                <div class="video-footer">
                                    <?php if ( $video_title ) : ?>
                                        <span class="video-footer__title">
                                            <?php echo esc_html( $video_title ); ?>
                                        </span>
                                    <?php endif; ?>
        
                                    <?php if ( $video_duration ) : ?>
                                        <span class="video-footer__duration">
                                            <?php echo esc_html( $video_duration ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </a>
                    <?php else: ?>
                        <video class="m-simple-content__media media-video" src="<?php echo esc_url( $media_video ); ?>" controls></video>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ( $media_type === 'embed' && $media_embed ) : ?>
                    <div class="m-simple-content__media media-embed right">
                        <?php echo $media_embed; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
	</div>
</section>
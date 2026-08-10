<?php if ( have_rows( 'main_content' ) ) : ?>
    <section class="main-content">
        <div class="main-content__list">
            <?php while ( have_rows( 'main_content' ) ) : the_row(); 
                $content_type   = get_sub_field( 'content_type' ) ?? false;
                $media_type     = get_sub_field( 'media_type' ) ?? false;
                $media_subtitle = get_sub_field( 'media_subtitle' ) ?? false;
                $title_tag      = get_sub_field( 'title_tag' ) ?: 'h2';
                $title          = get_sub_field( 'title' ) ?? false;
                $text_content   = get_sub_field( 'text_content' ) ?? false;
                $image_content  = get_sub_field( 'image_content' ) ?? false;
                $video_file     = get_sub_field( 'video_file' ) ?? false;
                $video_poster   = get_sub_field( 'video_poster' ) ?? false;
                $youtube_link   = get_sub_field( 'youtube_link' ) ?? false;
                $content_tag    = ($title_tag && $content_type === 'title') ? $title_tag : 'div';?>

                <<?php echo $content_tag; ?> class="content-item content-item__<?php echo esc_attr( $content_type ); ?>">
                    <?php if ( $content_type === 'title' && $title ) : ?>
                        <?php echo esc_html( $title ); ?>
                    <?php endif; ?>
                    <?php if ( $content_type === 'text' && $text_content ) : ?>
                        <?php echo wp_kses_post( $text_content ); ?>
                    <?php endif; ?>
                    <?php if ( $content_type === 'media' && $media_type === 'image' && $image_content ) : ?>
                        <div class="content-item__media-wrapper">
                            <?php echo wp_get_attachment_image( $image_content, 'full', false, [ 'class' => 'content-item__media-wrapper__img' ] ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $content_type === 'media' && $media_type === 'video' && $video_file && $video_poster ) : ?>
                        <a class="content-item__media-video" data-fancybox="video" href="<?php echo esc_url( $video_file ); ?>">
                            <?php echo wp_get_attachment_image( $video_poster, 'full', false, [ 'class' => 'content-item__media-video__poster' ] ); ?>
                            <div class="content-item__media-video__controls">
                                <svg><use xlink:href="#play-circle"></use></svg>
                            </div>
                        </a>
                    <?php endif; ?>
                    <?php if ( $content_type === 'media' && $media_type === 'embed' && $youtube_link ) : ?>
                        <?php echo $youtube_link; ?>
                    <?php endif; ?>

                    <?php if ( ( $content_type === 'media' && $image_content ) || ( $content_type === 'media' && $video_file ) || ( $content_type === 'media' && $youtube_link ) ) : ?>
                        <?php if ( $media_subtitle ) : ?>
                            <span class="content-item__media-subtitle">
                                <?php echo esc_html( $media_subtitle ); ?>
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                </<?php echo $content_tag; ?>>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>
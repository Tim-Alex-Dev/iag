<?php
$module_id        = get_sub_field( 'module_id' ) ?: '';
$is_banner        = get_sub_field( 'add_banner' ) ?? false;
$is_breadcrumbs   = get_sub_field( 'add_banner' ) ?? false;
$module_title     = get_sub_field( 'module_title' ) ?? false;
$module_uptitle   = get_sub_field( 'module_uptitle' ) ?? false;
$module_subtitle  = get_sub_field('module_subtitle' ) ?? false;
$module_banner    = $is_banner ? get_sub_field( 'banner_image' ) : false;
$banner_size      = $is_banner ? get_sub_field( 'banner_size' ) : 'full';
$youtube_url      = get_field( 'main_youtube_url', 'options' ) ?? false;
$linkedin_url     = get_field( 'main_linkedin_url', 'options' ) ?? false;
$youtube_icon     = get_field( 'main_youtube_icon', 'options' ) ?? false;
$linkedin_icon    = get_field( 'main_linkedin_icon', 'options' ) ?? false;
?>


<section id="<?php echo esc_attr($module_id); ?>" class="module m-banner <?php echo $is_banner ? 'is-banner' : 'no-banner'; ?> banner-<?php echo esc_attr( $banner_size ); ?>">
	<?php if ( $is_banner && $banner_size === 'full' && $module_banner ) : ?>
		<?php echo wp_get_attachment_image( $module_banner, 'full', false, [ 'class' => 'm-banner__banner' ] ); ?>
	<?php endif; ?>

	<div class="container">
		<div class="m-banner__inner">
			<?php if ( $module_title || $module_subtitle || $module_uptitle ) : ?>
				<div class="m-banner__content">
					<?php if ( $is_breadcrumbs ) : ?>
						<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
					<?php endif; ?>
					<?php if ( $module_uptitle ) : ?>
						<span class="m-banner__content-uptitle">
							<?php echo esc_html( $module_uptitle ); ?>
						</span>
					<?php endif; ?>
					<?php if ( $module_title ) : ?> 
						<h1 class="h1 m-banner__content-title">
							<?php echo esc_html( $module_title ); ?>
						</h1> 
					<?php endif; ?>
					<?php if ( $module_subtitle ) : ?>
						<p class="m-banner__content-subtitle">
							<?php echo esc_html( $module_subtitle ); ?>
						</p>
					<?php endif; ?>
				</div>
	
				<?php if ( $youtube_url && $linkedin_url && $youtube_icon && $linkedin_icon ) : ?>
					<div class="m-banner__share">
						<span class="share-label">
							<?php echo _e( 'Follow & Share:'); ?>
						</span>
	
						<a class="share-link" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank">
							<?php echo wp_get_attachment_image( $linkedin_icon, 'thumbnail', false, [ 'class' => 'share-link__img' ] ); ?>
						</a>
			
						<a class="share-link" href="<?php echo esc_url( $youtube_url ); ?>" target="_blank">
							<?php echo wp_get_attachment_image( $youtube_icon, 'thumbnail', false, [ 'class' => 'share-link__img' ] ); ?>
						</a>
	
						<div class="share-button">
							<svg><use xlink:href="#chain"></use></svg>
							<?php esc_html_e( 'Share', '_iag' ); ?>
	
							<span class="share-button__message">
								<?php esc_html_e( 'Link copied!', '_iag' ); ?>
							</span>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php if ( $is_banner && $banner_size === 'small' && $module_banner ) : ?>
			<div class="m-banner__media">
				<?php echo wp_get_attachment_image( $module_banner, 'full', false, [ 'class' => 'm-banner__media-img' ] ); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
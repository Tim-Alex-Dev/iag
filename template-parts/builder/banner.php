<?php
$module_id        = get_sub_field('module_id') ?: '';
$is_banner        = get_sub_field('add_banner') ?? false;
$is_breadcrumbs   = get_sub_field('add_banner') ?? false;
$module_title     = get_sub_field('module_title') ?? false;
$module_subtitle  = get_sub_field('module_subtitle') ?? false;
$module_banner    = $is_banner ? get_sub_field('banner_image') : false;
$youtube_url      = get_field('banner_youtube_link', 'option' ) ?? false;
$linkedin_url     = get_field('banner_linkedin_link', 'option' ) ?? false;
?>


<?php if ( $module_title || $module_banner ) : ?>
	<section id="<?php echo esc_attr($module_id); ?>" class="module m-banner">
		<?php if ( $is_banner && $module_banner ) : ?>
			<?php echo wp_get_attachment_image( $module_banner, 'full', false, [ 'class' => 'm-banner__bg' ] ); ?>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
		
		<div class="container">
			<?php if ( $module_title ) : ?>
				<h1 class="h1 m-banner__title">
					<?php echo esc_html( $module_title ); ?>
				</h1>
			<?php endif; ?>
	
			<?php if ( $module_subtitle ) : ?>
				<p class="m-banner__subtitle">
					<?php echo esc_html( $module_subtitle ); ?>
				</p>
			<?php endif; ?>
			
			<?php if ( $youtube_url || $linkedin_url ) : ?>
				<div class="m-banner__links">
					<span class="m-banner__links-title">
						<?php echo _e( 'Follow & Share', '_iag' ); ?>
					</span>
		
					<div class="m-banner__links-follow">
						<?php if ( $linkedin_url ) : ?>
							<a class="follow-link follow-link__linkedin" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"></a>	
						<?php endif; ?>
						<?php if ( $youtube_url ) : ?>
							<a class="follow-link follow-link__youtube" href="<?php echo esc_url( $youtube_url ); ?>" target="_blank"></a>	
						<?php endif; ?>
					</div>
		
					<div class="m-banner__links-share">
						<svg class="share-icon"><use xlink:href="#share-link"></use></svg>
						<span class="share-label"><?php echo _e( 'Share', '_iag' ); ?></span>
					</div>
				</div>
			<?php endif; ?>
		</div>

	</section>
<?php endif; ?>
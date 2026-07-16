<?php
$module_id              = get_sub_field('module_id') ?: '';
$module_title           = get_sub_field('module_title') ?? false;
$module_title_alignment = get_sub_field('module_title_alignment') ?: 'center';
$module_subtitle        = get_sub_field('module_subtitle') ?? false;
$module_banner 			= get_sub_field('banner_image') ?? false;
$module_cta_btn 		= get_sub_field('cta_button') ?? false;
?>


<section id="<?php echo esc_attr($module_id); ?>" class="module m-hero">
	<?php if ( $module_title || $module_subtitle ) : ?>
		<div class="m-hero__content">
			<?php if ( $module_title ) : ?>  
				<?php get_template_part( 'template-parts/builder/components/title', null, [ 'class' => 'm-hero__title' ] ); ?>
			<?php endif; ?>

			<?php if ( $module_subtitle ) : ?>
				<p class="subtitle m-hero__subtitle text-<?php echo esc_html( $module_title_alignment ); ?>">
					<?php echo esc_html( $module_subtitle ); ?>
				</p>
			<?php endif; ?>
			
			<?php if ( $module_cta_btn ) :
				$link_url = $module_cta_btn['url'];
				$link_title = $module_cta_btn['title'];
				$link_target = $module_cta_btn['target'] ? $module_cta_btn['target'] : '_self'; ?>

				<a class="btn btn-primary btn-lg m-hero__btn btn-<?php echo esc_html( $module_title_alignment ); ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
					<?php echo esc_html( $link_title ); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( $module_banner ) : ?>
		<div class="m-hero__banner">
			<?php echo wp_get_attachment_image( $module_banner, 'full', false, [ 'class' => 'm-hero__banner-image' ] ); ?>
		</div>
	<?php endif; ?>
</section>
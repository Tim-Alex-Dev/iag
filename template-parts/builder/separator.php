<?php
$module_id              = get_sub_field('module_id') ?: '';
$module_type            = get_sub_field('module_type') ?: 'slider';
$module_title           = get_sub_field('module_title') ?? false;
$module_title_alignment = get_sub_field('module_title_alignment') ?: 'center';
$module_subtitle        = get_sub_field('module_subtitle') ?? false;
$module_banner 			= get_sub_field('banner_image') ?? false;
$module_cta_btn 		= get_sub_field('cta_button') ?? false;
$module_gallery 		= get_sub_field('slider_gallery') ?? false;
?>

<section id="<?php echo esc_attr($module_id); ?>" class="module m-separator module-<?php echo esc_html( $module_type ); ?>">

	<?php if ( $module_type === 'cta' && $module_banner ) : ?>
		<?php echo wp_get_attachment_image( $module_banner, 'full', false, [ 'class' => 'm-separator__bg' ] ); ?>
	<?php endif; ?>

	<div class="container">
		<?php if ( $module_title || $module_subtitle ) : ?>
			<div class="m-separator__content">
				<?php if ( $module_title ) : ?>  
					<?php get_template_part( 'template-parts/builder/components/title', null, [ 'class' => 'm-separator__title' ] ); ?>
				<?php endif; ?>
			
				<?php if ( $module_subtitle ) : ?>
					<p class="subtitle m-separator__subtitle text-<?php echo esc_html( $module_title_alignment ); ?>">
						<?php echo esc_html( $module_subtitle ); ?>
					</p>
				<?php endif; ?>

				<?php if ( $module_type === 'cta' && $module_cta_btn ) :
					$link_url = $module_cta_btn['url'];
					$link_title = $module_cta_btn['title'];
					$link_target = $module_cta_btn['target'] ? $module_cta_btn['target'] : '_self'; ?>
			
					<a class="btn btn-primary btn-lg m-separator__btn btn-<?php echo esc_html( $module_title_alignment ); ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
						<?php echo esc_html( $link_title ); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
		<?php if ( $module_type === 'slider' && $module_gallery ) : ?>
			<div class="m-separator__swiper swiper is-centered">
				<div class="swiper-button-prev m-separator__swiper-button-prev">
					<svg class="arrow-left"><use xlink:href="#arrow-left"></use></svg>
				</div>
				<div class="swiper-button-next m-separator__swiper-button-next">                    
					<svg class="arrow-right"><use xlink:href="#arrow-right"></use></svg>
				</div>
			<div class="swiper-wrapper">
				<?php foreach ( $module_gallery as $slide_id ) : ?>
					<div class="m-separator__swiper-slide swiper-slide">
						<div class="slide-icon__wrapper">
							<?php echo wp_get_attachment_image( $slide_id, 'thumbnail', false, [ 'class' => 'slide-icon' ] ); ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
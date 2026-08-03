<?php
$module_id              = get_sub_field('module_id') ?: '';
$module_title           = get_sub_field('module_title') ?? false;
$module_title_alignment = get_sub_field('module_title_alignment') ?: 'center';
$module_subtitle        = get_sub_field('module_subtitle') ?? false;
$primary_btn     		= get_sub_field('primary_button') ?? false;
$secondary_btn     		= get_sub_field('secondary_button') ?? false;
$content_type		    = get_sub_field('hero_content_type') ? get_sub_field('hero_content_type') : 'banner';
$module_banner 			= $content_type === 'banner' ? get_sub_field('banner_image') : false;
$blocks_title 			= $content_type === 'blocks' ? get_sub_field('blocks_title') : false;
$blocks_category 		= $content_type === 'blocks' ? get_sub_field('blocks_category') : false;
$blocks_subject 		= $content_type === 'blocks' ? get_sub_field('blocks_subject') : false;
$blocks_read 			= $content_type === 'blocks' ? get_sub_field('blocks_read') : false;
$blocks_status 			= $content_type === 'blocks' ? get_sub_field('blocks_status') : false;
?>


<section id="<?php echo esc_attr($module_id); ?>" class="module m-hero">
	<div class="container">
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
				
				<?php if ( $primary_btn || $secondary_btn ) : ?>
					<div class="m-hero__buttons btn-group-<?php echo esc_html( $module_title_alignment ); ?>">
						<?php if ( $primary_btn ) :
							$link_url = $primary_btn['url'];
							$link_title = $primary_btn['title'];
							$link_target = $primary_btn['target'] ? $primary_btn['target'] : '_self'; ?>
			
							<a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
								<?php echo esc_html( $link_title ); ?>
								<svg><use xlink:href="#arrow-right"></use></svg>

							</a>
						<?php endif; ?>
	
						<?php if ( $secondary_btn ) :
							$link_url = $secondary_btn['url'];
							$link_title = $secondary_btn['title'];
							$link_target = $secondary_btn['target'] ? $secondary_btn['target'] : '_self'; ?>
			
							<a class="btn btn-ghost" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
								<?php echo esc_html( $link_title ); ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				
				<?php if ( have_rows( 'hero_list' ) ) : ?>
					<div class="m-hero__list">
						<?php while ( have_rows( 'hero_list' ) ) : the_row(); 
							$list_item = get_sub_field( 'list_item' ); ?>
		
							<?php if ( $list_item ) : ?>
								<div class="m-hero__list-item">
									<svg class="list-item__icon"><use xlink:href="#checkmark"></use></svg>
									<span class="list-item__text">
										<?php echo esc_html( $list_item ); ?>
									</span>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>			
			</div>
	
			<?php if ( $content_type === "banner" && $module_banner ) : ?>
				<div class="m-hero__banner">
					<?php echo wp_get_attachment_image( $module_banner, 'full', false, [ 'class' => 'm-hero__banner-image' ] ); ?>
				</div>
			<?php endif; ?>
	
			<?php if ( $content_type === "blocks" ) : ?>
				<div class="m-hero__blocks-wrapper">
					<div class="m-hero__blocks">
						<div class="m-hero__blocks-inner">
							<?php if ( $blocks_title || $blocks_category ) : ?>
								<div class="m-hero__blocks-header">
									<?php if ( $blocks_title ) : ?>
										<span class="blocks-header__title">
											<?php echo esc_html( $blocks_title ); ?>
										</span>
									<?php endif; ?>
									<?php if ( $blocks_category ) : ?>
										<span class="chip chip-primary">
											<?php echo esc_html( $blocks_category ); ?>
										</span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
		
							<?php if ( have_rows( 'blocks_images' ) ) : ?>
								<div class="m-hero__blocks-images">
									<?php while ( have_rows( 'blocks_images' ) ) : the_row();
										$image = get_sub_field( 'image' ) ?? false;
										$title = get_sub_field( 'image_title' ) ?? false; ?>
		
										<?php if ( $image ) : ?>
											<div class="image-block">
												<?php echo wp_get_attachment_image( $image, 'medium', false, [ 'class' => 'image-block__img' ] ); ?>
												<?php if ( $title ) : ?>
													<span class="image-block__title">
														<?php echo esc_html( $title ); ?>
													</span>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
		
							<?php if ( $blocks_subject || $blocks_read || $blocks_status ) : ?>
								<div class="m-hero__blocks-footer">
									<?php if ( $blocks_subject ) : ?>
										<div class="footer-block">
											<span class="footer-block__label">
												<?php echo _e( 'Subject', '_iag' ); ?>
											</span>
											<span class="footer-block__text">
												<?php echo esc_html( $blocks_subject ); ?>
											</span>
										</div>
									<?php endif; ?>
									<?php if ( $blocks_read ) : ?>
										<div class="footer-block">
											<span class="footer-block__label">
												<?php echo _e( 'Read', '_iag' ); ?>
											</span>
											<span class="footer-block__text">
												<?php echo esc_html( $blocks_read ); ?>
											</span>
										</div>
									<?php endif; ?>
									<?php if ( $blocks_status ) : ?>
										<div class="footer-block">
											<span class="footer-block__label">
												<?php echo _e( 'Status', '_iag' ); ?>
											</span>
											<span class="footer-block__text block-status">
												<?php echo esc_html( $blocks_status ); ?>
											</span>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>
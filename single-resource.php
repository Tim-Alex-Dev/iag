<?php
get_header();
the_post();

$resource_id     = get_the_ID ();
$post_title	     = get_field( 'post_title', $resource_id ) ?? false;
$post_subtitle   = get_field( 'post_subtitle', $resource_id ) ?? false;
$post_banner     = get_field( 'post_banner', $resource_id ) ?? false;
$post_date       = get_the_date( 'M j, Y', $resource_id ) ?? false;
$youtube_url     = get_field( 'main_youtube_url', 'options' ) ?? false;
$linkedin_url    = get_field( 'main_linkedin_url', 'options' ) ?? false;
$youtube_icon    = get_field( 'main_youtube_icon', 'options' ) ?? false;
$linkedin_icon   = get_field( 'main_linkedin_icon', 'options' ) ?? false;
$category        = get_primary_category( $resource_id, 'id' );
$banner_image    = (!$post_banner && $category ) ? get_field( 'resource_banner', 'source_' . $category ) : $post_banner;

$cta_icon        = get_field( 'default_cta_icon', 'options' ) ?? false;
$cta_uptitle     = get_field( 'default_cta_uptitle', 'options' ) ?? false;
$cta_title       = get_field( 'default_cta_title', 'options' ) ?? false;
$cta_description = get_field( 'default_cta_description', 'options' ) ?? false;
$cta_link        = get_field( 'default_cta_link', 'options' ) ?? false;
?>

<article class="resource">
	<div class="resource-banner">
		<?php if ( $banner_image ) : ?>
			<?php echo wp_get_attachment_image( $banner_image, 'full', false, [ 'class' => 'resource-banner__category-banner' ] ); ?>
		<?php endif; ?>
		<div class="container">
			<div class="resource-banner__inner">
				<div class="resource-banner__content">
					<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
					
					<?php if ( $post_title ) : ?>
						<h1 class="h1 content-title">
							<?php echo esc_html( $post_title ); ?>
						</h1>
					<?php endif; ?>
			
					<?php if ( $post_subtitle ) : ?>
						<p class="content-subtitle">
							<?php echo esc_html( $post_subtitle ) ; ?>
						</p>
					<?php endif; ?>
				</div>
				<div class="resource-banner__share">
					<span class="share-label">
						<?php echo _e( 'Follow & Share:'); ?>
					</span>
	
					<?php if ( $linkedin_url && $linkedin_icon ) : ?>
						<a class="share-link" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank">
							<?php echo wp_get_attachment_image( $linkedin_icon, 'thumbnail', false, [ 'class' => 'share-link__img' ] ); ?>
						</a>
					<?php endif; ?>
	
					<?php if ( $youtube_url && $youtube_icon ) : ?>
						<a class="share-link" href="<?php echo esc_url( $youtube_url ); ?>" target="_blank">
							<?php echo wp_get_attachment_image( $youtube_icon, 'thumbnail', false, [ 'class' => 'share-link__img' ] ); ?>
						</a>
					<?php endif; ?>
	
					<div class="share-button">
						<svg><use xlink:href="#chain"></use></svg>
						<?php echo _e( 'Share', '_iag' ); ?>
					</div>
				</div>
				<div class="resource-banner__data">
					<div class="data-posted">
						<span class="label">
							<?php echo _e( 'Posted:', '_iag' ); ?>
						</span>
						<span class="data">
							<?php echo esc_html( $post_date ); ?>
						</span>
					</div>
					<!-- <div class="data-reading">
						<span class="label">
							<?php echo _e( 'Reading Time:', '_iag' ); ?>
						</span>
					</div>
					<div class="data-views">
						<span class="label">
							<?php echo _e( 'Views:', '_iag' ); ?>
						</span>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	<div class="resource-main">
		<div class="container">
			<div class="resource-main__table">
				<div class="table-of-content hidden">
					<span class="table-of-content__title"><?php echo _e( 'Table of Content', '_iag' ); ?></span>
					<div id="table_of_content"></div>
				</div>
			</div>
			<div class="resource-main__content">
				<?php if ( have_rows( 'post_builder' ) ) : ?>
					<?php get_template_part( 'template-parts/post-builder' ); ?>
				<?php endif; ?>
			</div>
			<?php if ( $cta_title ) : ?>
				<div class="resource-main__cta">
					<?php if ( $cta_icon ) : ?>
						<div class="resource-main__cta-trigger">
							<?php echo wp_get_attachment_image( $cta_icon, 'thumbnail', false, [ 'class' => 'cta-trigger-icon' ] ); ?>
						</div>
					<?php endif; ?>
					<?php if ( $cta_icon || $cta_uptitle ) : ?>
						<div class="resource-main__cta-header">
							<?php if ( $cta_icon ) : ?>
								<?php echo wp_get_attachment_image( $cta_icon, 'thumbnail', false, [ 'class' => 'cta-header-icon' ] ); ?>
							<?php endif; ?>
							<?php if ( $cta_uptitle ) : ?>
								<span class="cta-header-text">
									<?php echo esc_html( $cta_uptitle ); ?>
								</span>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="resource-main__cta-body">
						<span class="cta-body-title">
							<?php echo esc_html( $cta_title ); ?>
						</span>
						<?php if ( $cta_description ) : ?>
							<span class="cta-body-description">
								<?php echo esc_html( $cta_description ); ?>
							</span>
						<?php endif; ?>

						<?php if ( have_rows( 'default_cta_list', 'options' ) ) : ?>
							<div class="cta-body-list">
								<?php while ( have_rows( 'default_cta_list', 'options' ) ) : the_row();
									$item_text = get_sub_field( 'list_item_text' ) ?? false; ?>

									<?php if ( $item_text ) : ?>
										<div class="cta-body-list__item">
											<div class="list-item__icon">
												<svg><use xlink:href="#checkmark"></use></svg>
											</div>
											<span class="list-item__text">
												<?php echo esc_html( $item_text ); ?>
											</span>
										</div>
									<?php endif; ?>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
						<?php if ( $cta_link ) : 
							$link_url    = $cta_link['url'];
							$link_title  = $cta_link['title'];
							$link_target = $cta_link['target'] ? $cta_link['target'] : '_self'; ?>
	
							<a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
								<?php echo esc_html( $link_title ); ?>
								<svg><use xlink:href="#arrow-right"></use></svg>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

</article>



<?php
get_footer();
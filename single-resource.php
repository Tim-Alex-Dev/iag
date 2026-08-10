<?php
/**
 * The template for displaying all single Leadership Pages
 */

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
$category_banner = $category ? get_field( 'resource_banner', 'source_' . $category ) : false;
?>

<article class="resource">
	<div class="resource-banner">
		<?php if ( $category_banner ) : ?>
			<?php echo wp_get_attachment_image( $category_banner, 'full', false, [ 'class' => 'resource-banner__banner' ] ); ?>
		<?php endif; ?>
		<div class="container">
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
					<?php echo _e( 'Follow & Share'); ?>
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
				<div class="data-reading">
					<span class="label">
						<?php echo _e( 'Reading Time:', '_iag' ); ?>
					</span>
				</div>
				<div class="data-views">
					<span class="label">
						<?php echo _e( 'Views:', '_iag' ); ?>
					</span>
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
			<div class="resource-main__cta">
			</div>
		</div>
	</div>

</article>



<?php
get_footer();
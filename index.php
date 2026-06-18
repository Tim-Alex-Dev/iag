<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _it_start
 */

get_header();
?>

	<div class="archive-wrapper">
		<div class="container">

			<header class="archive-header">
				<?php if ( is_home() && ! is_front_page() ) : ?>
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				<?php else : ?>
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				<?php endif; ?>
			</header>

			<?php if ( have_posts() ) : ?>

				<div class="row">
					<?php while ( have_posts() ) : the_post(); ?>

						<div class="col-md-6 col-lg-4">
							<?php
							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called 'article-post_type_name.php' and that will be used instead.
							 */
							get_template_part( 'template-parts/article', get_post_type() ); ?>
						</div>

					<?php endwhile; ?>
				</div>
				<?php get_template_part( 'template-parts/pagination' ); ?>

			<?php else: ?>

				<div class="row">
					<div class="col-lg-6">
						<?php get_template_part( 'template-parts/content-none' ); ?>
					</div>
				</div>

			<?php endif; ?>

		</div>
	</div>

<?php
get_footer();

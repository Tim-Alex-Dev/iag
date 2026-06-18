<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package _it_start
 */

get_header();
?>

	<div class="archive-wrapper">
		<div class="container">
			<header class="archive-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', '_it_start' ), '<strong>' . get_search_query() . '</strong>' );
					?>
				</h1>
			</header>

			<div class="row">
				<div class="col-lg-6">
					<?php get_search_form(); ?>
				</div>
			</div>

			<div class="row">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<div class="col-md-6 col-lg-4">
							<?php get_template_part( 'template-parts/article' ); ?>
						</div>

					<?php endwhile; ?>

					<?php get_template_part( 'template-parts/pagination' ); ?>

				<?php else : ?>

					<div class="col-lg-6">
						<?php get_template_part( 'template-parts/content-none' ); ?>
					</div>

				<?php endif; ?>
			</div>

		</div>
	</div>

<?php
get_footer();

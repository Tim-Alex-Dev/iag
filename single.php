<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _it_start
 */

get_header();
the_post();
?>

<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

	<div class="container">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( '1536x1536' ); ?>
			</div>
		<?php endif; ?>

		<div class="row justify-content-center">
			<div class="col-lg-9">

				<header class="post-header">
					<h1 class="post-title"><?php the_title(); ?></h1>
					<div class="entry-meta">
						<?php it_posted_on(); ?><?php it_posted_by(); ?>
						<?php it_cat_links(); ?>
						<?php it_tag_links(); ?>
					</div>
				</header>

				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_it_start' ),
							'after'  => '</div>',
						)
					);
					?>

					<?php
					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', '_it_start' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', '_it_start' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>
				</div>

			</div>
		</div>

		<?php get_template_part( 'template-parts/post-related' ); ?>
	</div>

<?php
get_footer();

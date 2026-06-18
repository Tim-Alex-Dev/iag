<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _it_start
 */

get_header();
the_post();
?>

<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php if ( have_rows( 'builder' ) ) : ?>

	<?php get_template_part( 'template-parts/builder' ); ?>

<?php else : ?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<section class="entry-content">
					<?php the_content(); ?>
				</section>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php
get_footer();

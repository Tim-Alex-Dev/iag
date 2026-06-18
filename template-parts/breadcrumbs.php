<?php
/**
 * Output Yoast breadcrumbs if they are enabled, and it is not a homepage
 *
 * @package _it_start
 */

if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) : ?>
	<div class="breadcrumbs">
		<div class="container">
			<?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ); ?>
		</div>
	</div>
<?php endif; ?>

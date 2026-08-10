<?php
/**
 * Output Yoast breadcrumbs if they are enabled, and it is not a homepage
 *
 * @package _iag
 */

if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) : ?>
	<div class="breadcrumbs">
		<?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ); ?>
	</div>
<?php endif; ?>

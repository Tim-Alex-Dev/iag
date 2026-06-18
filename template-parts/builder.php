<?php
/**
 * Flexible Content
 */

$index = 1;
// loop over the ACF flexible fields of this page / post
while ( the_flexible_field( 'builder' ) ) {
	// load the layout from sub folder
	get_template_part( 'template-parts/builder/'. get_row_layout(), null, [ 'index' => $index ] );
	$index++;
}
?>

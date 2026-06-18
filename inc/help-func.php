<?php
/**
 * Custom functions which help to speed up development
 *
 * @package _it_start
 */

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function it_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
	/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', '_it_start' ), $time_string
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}


/**
 * Prints HTML with meta information for the current author.
 */
function it_posted_by() {
	$byline = sprintf(
	/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', '_it_start' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}


/**
 * Prints HTML with meta information for the post categories.
 */
function it_cat_links() {
	$categories_list = get_the_category_list( esc_html__( ', ', '_it_start' ) );
	if ( $categories_list ) {
		printf( '<div class="cat-links">' . esc_html__( 'Posted in %1$s', '_it_start' ) . '</div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


/**
 * Prints HTML with meta information for the post tags.
 */
function it_tag_links() {
	$tags_list = get_the_tag_list( '', ', ' );
	if ( $tags_list ) {
		printf( '<div class="tag-links">' . esc_html__( 'Tagged %1$s', '_it_start' ) . '</div>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


/**
 * Limit Excerpt Length
 *
 * @param $word_limit
 */
function it_excerpt( $word_limit ) {

	$excerpt = explode( ' ', get_the_excerpt(), $word_limit );

	if ( count( $excerpt ) >= $word_limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}

	$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );

	echo $excerpt;
}


/**
 * Phone number cleaner
 */
function it_phone_cleaner( $tel ) {
	return preg_replace('/[^+\d]+/', '', $tel);
}


/**
 * Hide email from Spam Bots using a shortcode.
 */
function it_hide_email_shortcode( $atts, $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	$email = antispambot( $content );

	return sprintf( '<a href="%s">%s</a>', esc_url( "mailto:$email" ), esc_html( $email ) );
}

add_shortcode( 'email', 'it_hide_email_shortcode' );


/**
 * Image Placeholder
 */
function it_image_placeholder() {
	echo '<span class="img-placeholder"><svg id="image" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm16 336c0 8.822-7.178 16-16 16H48c-8.822 0-16-7.178-16-16V112c0-8.822 7.178-16 16-16h416c8.822 0 16 7.178 16 16v288zM112 232c30.928 0 56-25.072 56-56s-25.072-56-56-56-56 25.072-56 56 25.072 56 56 56zm0-80c13.234 0 24 10.766 24 24s-10.766 24-24 24-24-10.766-24-24 10.766-24 24-24zm207.029 23.029L224 270.059l-31.029-31.029c-9.373-9.373-24.569-9.373-33.941 0l-88 88A23.998 23.998 0 0 0 64 344v28c0 6.627 5.373 12 12 12h360c6.627 0 12-5.373 12-12v-92c0-6.365-2.529-12.47-7.029-16.971l-88-88c-9.373-9.372-24.569-9.372-33.942 0zM416 352H96v-4.686l80-80 48 48 112-112 80 80V352z"/></svg></span>';
}


if ( ! function_exists( 'it_console_log' ) ) {
	/**
	 * Output like the var_dump() in the browser's JS console
	 *
	 * @param $content - content to display
	 * @param $as_text - display type: text, JS object
	 */
	function it_console_log( $content = null, $as_text = true ) {
		echo '<div class="php-to-js-console-log" style="display: none!important;" data-as-text="' . esc_attr( (bool) $as_text ) . '" data-variable="' . htmlspecialchars( wp_json_encode( $content ) ) . '">' . htmlspecialchars( var_export( $content, true ) ) . '</div>';

		$hook = is_admin() ? 'admin_footer' : 'wp_footer';
		add_action( $hook, function () {
			echo '<script>(function ($) { $(document).ready(function ($) { var phpToJsElements = $(".php-to-js-console-log").detach(); $("body").append("<div id=\"php-to-js-console-logs\" style=\"display: none!important;\"></div>"); $("#php-to-js-console-logs").append(phpToJsElements); phpToJsElements.each(function (i, el) { var $e = $(el); console.log("PHP debug is below:"); (!$e.attr("data-as-text")) ? console.log(JSON.parse($e.attr("data-variable"))) : console.log($e.text()); }); }); }(jQuery));</script>';
		}, 1 );
	}
}

/**
 * Inline SVG
 */
function it_inline_svg( $svg_url ) {
	$remote_svg_file = wp_remote_get( $svg_url, [ 'sslverify' => false ] );
	$svg_content     = wp_remote_retrieve_body( $remote_svg_file );
	return $svg_content;
}

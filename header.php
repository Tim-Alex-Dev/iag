<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _it_start
 */
$logo     = get_field( 'logo', 'option' );
$has_hero = false;
if ( have_rows( 'builder' ) ) {
	while ( have_rows( 'builder' ) ) {
		the_row();
		if ( get_row_layout() == 'hero' ) {
			$has_hero = true;
		}
	}
}
$extra_classes = $has_hero ? 'has-hero' : ''; // page with Hero requires extra header's styling
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( $extra_classes ); ?> id="top">
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_it_start' ); ?></a>

<header class="site-header">
	<div class="container">
		<?php if ( $logo ) : ?>
			<a href="<?php echo home_url(); ?>" class="site-logo" rel="home">
				<?php echo wp_get_attachment_image( $logo, 'medium' ); ?>
			</a>
		<?php endif; ?>

		<nav class="main-nav">
			<?php
			wp_nav_menu( [
				'theme_location'  => 'main',
				'container_class' => 'main-menu__container',
				'menu_class'      => 'main-menu',
				'depth'           => 2,
				'fallback_cb'     => false
			] );
			?>
			<?php if ( is_active_sidebar( 'language-switcher' ) ) : ?>
				<div class="hidden-sm-up">
					<?php dynamic_sidebar( 'language-switcher' ); ?>
				</div>
			<?php endif; ?>
		</nav>
		<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<?php $count = WC()->cart->get_cart_contents_count(); ?>
			<a class="mini-cart <?php echo ( 0 === $count ) ? 'mini-cart--empty' : ''; ?>" href="<?php echo wc_get_cart_url(); ?>">
				<svg>
					<use xlink:href="#cart"></use>
				</svg>
				<?php if ( 0 !== $count ) : ?>
					<span class="mini-cart__total"><?php echo $count; ?></span>
				<?php endif; ?>
			</a>
			<a class="user-account" href="<?php echo esc_url( home_url() . '/my-account/' ); ?>">
				<svg id="user-circle" class="color-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" width="36" height="36">
					<path d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm128 421.6c-35.9 26.5-80.1 42.4-128 42.4s-92.1-15.9-128-42.4V416c0-35.3 28.7-64 64-64 11.1 0 27.5 11.4 64 11.4 36.6 0 52.8-11.4 64-11.4 35.3 0 64 28.7 64 64v13.6zm30.6-27.5c-6.8-46.4-46.3-82.1-94.6-82.1-20.5 0-30.4 11.4-64 11.4S204.6 320 184 320c-48.3 0-87.8 35.7-94.6 82.1C53.9 363.6 32 312.4 32 256c0-119.1 96.9-216 216-216s216 96.9 216 216c0 56.4-21.9 107.6-57.4 146.1zM248 120c-48.6 0-88 39.4-88 88s39.4 88 88 88 88-39.4 88-88-39.4-88-88-88zm0 144c-30.9 0-56-25.1-56-56s25.1-56 56-56 56 25.1 56 56-25.1 56-56 56z"/>
				</svg>
			</a>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'language-switcher' ) ) : ?>
			<div class="visible-md-up">
				<?php dynamic_sidebar( 'language-switcher' ); ?>
			</div>
		<?php endif; ?>
		<span class="icon-burger hidden-lg-up" aria-label="<?php esc_html_e( 'Toggle navigation', '_it_start' ); ?>"><i></i></span>
	</div>
</header>

<main class="site-content" id="content">

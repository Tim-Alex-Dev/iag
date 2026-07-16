<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _iag
 */
$logo     			 = get_field( 'logo', 'option' );
$header_phone_number = get_field( 'header_phone_button', 'option' );
$header_cta_text     = get_field( 'header_cta_button', 'option' );

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
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_iag' ); ?></a>

<header class="site-header">
	<div class="container">
		<?php if ( $logo ) : ?>
			<a href="<?php echo home_url(); ?>" class="site-logo" rel="home">
				<?php echo wp_get_attachment_image( $logo, 'medium' ); ?>
			</a>
		<?php endif; ?>

		<nav class="main-nav">
			<?php wp_nav_menu([
				'theme_location' => 'main',
				'items_wrap'     => '%3$s',
				'menu_class'     => '',
				'container'      => false,
				'walker'         => new IAG_Mega_Menu_Walker('header-menu'),
			]); ?>
		</nav>
		
		<!-- <?php if ( $header_cta_text ) : ?>
			<div class="btn btn-primary" id="header-cta-button">
				<?php echo esc_html( $header_cta_text ); ?>
			</div>
		<?php endif; ?> -->

		<?php if ( $header_phone_number ) :
			$tel = it_phone_cleaner($header_phone_number); ?>
			<a class="btn btn-primary" href="tel:<?php echo esc_attr( $tel ); ?>" aria-label="<?php echo esc_attr( 'Call ' . $header_phone_number ); ?>">
				<svg class="btn-icon"><use xlink:href="#phone"></use></svg>
				<?php echo esc_html( $header_phone_number ); ?>
			</a>
		<?php endif; ?>


		<span class="icon-burger hidden-lg-up" aria-label="<?php esc_html_e( 'Toggle navigation', '_iag' ); ?>"><i></i></span>
	</div>
</header>

<main class="site-content" id="content">

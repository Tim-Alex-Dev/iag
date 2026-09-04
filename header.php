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

	<!-- Start of Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-VPPRV7J2ZE"></script>

	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}

		gtag('js', new Date());
		gtag('config', 'G-VPPRV7J2ZE');
	</script>
	<!-- End of Google tag -->


	<!-- Start of Clarity -->
	<script type="text/javascript">
		(function(c, l, a, r, i, t, y) {
			c[a] = c[a] || function() {
				(c[a].q = c[a].q || []).push(arguments);
			};

			t = l.createElement(r);
			t.async = 1;
			t.src = 'https://www.clarity.ms/tag/' + i;

			y = l.getElementsByTagName(r)[0];
			y.parentNode.insertBefore(t, y);

		})(window, document, 'clarity', 'script', 'xbzyzucf2o');
	</script>
	<!-- End of Clarity -->


	<!-- Start of RB2B -->
	<script>
		!function(key) {

			if (window.reb2b) {
				return;
			}

			window.reb2b = {
				loaded: true
			};

			var s = document.createElement('script');

			s.async = true;
			s.src = 'https://ddwl4m2hdecbv.cloudfront.net/b/' + key + '/' + key + '.js.gz';

			document
				.getElementsByTagName('script')[0]
				.parentNode
				.insertBefore(
					s,
					document.getElementsByTagName('script')[0]
				);

		}('GOYPYHQ90KOX');
	</script>
	<!-- End of RB2B -->


	<!-- Start of HubSpot -->
	<script
		type="text/javascript"
		id="hs-script-loader"
		async
		defer
		src="//js-eu1.hs-scripts.com/144692094.js">
	</script>
	<!-- End of HubSpot -->

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
		
		<?php if ( $header_cta_text ) : ?>
			<div class="btn btn-primary header-cta-button">
				<?php echo esc_html( $header_cta_text ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $header_phone_number ) :
			$tel = it_phone_cleaner($header_phone_number); ?>
			<a class="btn btn-primary header-phone-button" href="tel:<?php echo esc_attr( $tel ); ?>" aria-label="<?php echo esc_attr( 'Call ' . $header_phone_number ); ?>">
				<svg class="btn-icon"><use xlink:href="#phone"></use></svg>
				<?php echo esc_html( $header_phone_number ); ?>
			</a>
		<?php endif; ?>


		<span class="icon-burger hidden-lg-up" aria-label="<?php esc_html_e( 'Toggle navigation', '_iag' ); ?>"><i></i></span>
	</div>
</header>

<main class="site-content" id="content">

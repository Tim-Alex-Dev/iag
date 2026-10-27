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
$header_cta_cf       = get_field( 'hubspot_header_form', 'option' );

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

	<!-- Start of cookie consent helper
	     Trackers below load only after the visitor accepts the matching CookieYes category:
	     Analytics = Google Analytics, Microsoft Clarity, HubSpot tracking. Advertisement = RB2B.
	     If consent is missing or withdrawn, their cookies are removed. -->
	<script>
		(function() {
			var loaded = {};
			var trackerCookies = {
				analytics: [/^_ga(_.+)?$/, /^_cl(ck|sk)$/, /^__hs(tc|sc|src)$/, /^hubspotutk$/],
				advertisement: [/^_reb2b/]
			};

			function hasConsent(category) {
				var match = document.cookie.match(/(?:^|;\s*)cookieyes-consent=([^;]*)/);
				return !!match && new RegExp('(?:^|,)' + category + ':yes(?:,|$)').test(decodeURIComponent(match[1]));
			}

			function deleteCookies(category) {
				var host = location.hostname.split('.');
				document.cookie.split(';').forEach(function(pair) {
					var name = pair.split('=')[0].trim();
					if (!trackerCookies[category].some(function(re) { return re.test(name); })) return;
					for (var i = 0; i <= host.length - 2; i++) {
						document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; domain=.' + host.slice(i).join('.');
					}
					document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';
				});
			}

			// Runs callback once, as soon as the visitor has accepted the category (now or later).
			window.iagOnConsent = function(category, callback) {
				function run() {
					if (run.done) return;
					run.done = true;
					loaded[category] = true;
					callback();
				}
				if (hasConsent(category)) {
					run();
					return;
				}
				document.addEventListener('cookieyes_consent_update', function(e) {
					if (e.detail && e.detail.accepted && e.detail.accepted.indexOf(category) !== -1) run();
				});
			};

			window.iagLoadScript = function(src, id) {
				var s = document.createElement('script');
				s.async = true;
				s.src = src;
				if (id) s.id = id;
				document.head.appendChild(s);
			};

			// No consent (or cookies left from before consent was required): remove tracker cookies.
			Object.keys(trackerCookies).forEach(function(category) {
				if (!hasConsent(category)) deleteCookies(category);
			});

			// Consent withdrawn later via "Cookie Settings": remove cookies and reload so running trackers stop.
			document.addEventListener('cookieyes_consent_update', function(e) {
				var rejected = (e.detail && e.detail.rejected) || [];
				var reload = false;
				Object.keys(trackerCookies).forEach(function(category) {
					if (rejected.indexOf(category) === -1) return;
					deleteCookies(category);
					if (loaded[category]) reload = true;
				});
				if (reload) location.reload();
			});
		})();
	</script>
	<!-- End of cookie consent helper -->


	<!-- Start of Google tag (gtag.js), loads only after "Analytics" consent -->
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}

		// Google consent mode: nothing is stored until the visitor agrees.
		gtag('consent', 'default', {
			analytics_storage: 'denied',
			ad_storage: 'denied',
			ad_user_data: 'denied',
			ad_personalization: 'denied'
		});

		iagOnConsent('advertisement', function() {
			gtag('consent', 'update', {
				ad_storage: 'granted',
				ad_user_data: 'granted',
				ad_personalization: 'granted'
			});
		});

		iagOnConsent('analytics', function() {
			gtag('consent', 'update', { analytics_storage: 'granted' });
			gtag('js', new Date());
			gtag('config', 'G-VPPRV7J2ZE');
			iagLoadScript('https://www.googletagmanager.com/gtag/js?id=G-VPPRV7J2ZE');
		});
	</script>
	<!-- End of Google tag -->


	<!-- Start of Clarity, loads only after "Analytics" consent -->
	<script type="text/javascript">
		iagOnConsent('analytics', function() {
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

			window.clarity('consent');
		});
	</script>
	<!-- End of Clarity -->


	<!-- Start of HubSpot tracking, loads only after "Analytics" consent (HubSpot forms work without it) -->
	<script>
		iagOnConsent('analytics', function() {
			iagLoadScript('https://js-eu1.hs-scripts.com/144692094.js', 'hs-script-loader');
		});
	</script>
	<!-- End of HubSpot -->


	<!-- Start of RB2B, loads only after "Advertisement" consent -->
	<script>
		iagOnConsent('advertisement', function() {
			if (window.reb2b) return;
			window.reb2b = {loaded: true};
			iagLoadScript('https://ddwl4m2hdecbv.cloudfront.net/b/GOYPYHQ90KOX/GOYPYHQ90KOX.js.gz');
		});
	</script>
	<!-- End of RB2B -->

</head>

<body <?php body_class( $extra_classes ); ?> id="top">
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_iag' ); ?></a>

<header class="site-header">
	<div class="container">
		<?php if ( $logo ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
				<?php echo wp_get_attachment_image( $logo, 'medium', false, [ 'loading' => 'eager' ] ); ?>
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
		
		<?php if ( $header_cta_text && $header_cta_cf ) : ?>
			<div class="btn btn-primary header-cta-button js-modal-open" data-modal="contact">
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


		<button type="button" class="icon-burger hidden-lg-up" aria-label="<?php esc_attr_e( 'Toggle navigation', '_iag' ); ?>" aria-expanded="false"><i></i></button>
	</div>
</header>

<main class="site-content" id="content">

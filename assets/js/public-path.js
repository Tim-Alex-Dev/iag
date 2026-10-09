// URL of dist/js/ from PHP (itSettings.jsUrl): the on-demand modules load from the right place even when an optimization
// plugin (e.g. WP Rocket combine/minify) serves main.js from another folder. Without it webpack uses the location of main.js.
if (window.itSettings && window.itSettings.jsUrl) {
	__webpack_public_path__ = window.itSettings.jsUrl;
}

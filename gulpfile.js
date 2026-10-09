/**************** gulpfile.js configuration ****************/
'use strict';

const

	// directory locations
	dir = {
		nm: 'node_modules/',
		src: 'assets/',
		build: 'dist/'
	},
	url = 'http://iagnew.loc', // local site URL for BrowserSync proxy

	// modules
	gulp = require('gulp'),
	gulpif = require('gulp-if'),
	browsersync = require('browser-sync').create(),
	cleanCSS = require('gulp-clean-css'),
	notify = require('gulp-notify'),
	plumber = require('gulp-plumber'),
	postcss = require('gulp-postcss'),
	PluginError = require('plugin-error'),
	rimraf = require('gulp-rimraf'),
	sass = require('gulp-sass')(require('sass')),
	sassGlob = require('gulp-sass-glob'),
	size = require('gulp-size'),
	sourcemaps = require('gulp-sourcemaps'),
	webpackStream = require('webpack-stream');

// Working environment
let isProd = false; // dev by default

/**************** fonts task ****************/

const fontsConfig = {
	src: dir.src + 'fonts/**/*',
	build: dir.build + 'fonts/',
	watch: dir.src + 'fonts/**/*',
};

function fonts() {
	return gulp.src(fontsConfig.src)
		.pipe(gulp.dest(fontsConfig.build));
}

/**************** images task ****************/

const imgConfig = {
	src: dir.src + 'img/**/*',
	build: dir.build + 'img/',
	watch: dir.src + 'img/**/*',
};

function images() {
	return gulp.src(imgConfig.src)
		.pipe(size({showFiles: true}))
		.pipe(gulp.dest(imgConfig.build));
}

/**************** CSS task ****************/

const cssConfig = {
	src: dir.src + 'scss/*.scss',
	watch: dir.src + 'scss/**/*',
	build: dir.build + 'css/',
	sassOpts: {
		sourceMap: false,
		outputStyle: 'compressed',
		imagePath: '../img/',
		precision: 5,
		errLogToConsole: true,
		includePaths: [
			dir.nm
		]
	},
	cleanOpts: {
		level: {
			2: {
				mergeMedia: false
			}
		}
	},
	postCSS: [
		require('autoprefixer')
	]
};

function css() {
	return gulp.src(cssConfig.src)
		.pipe(sourcemaps.init())
		.pipe(sassGlob())
		.pipe(sass(cssConfig.sassOpts).on('error', function (error) {
			const message = new PluginError('sass', error.messageFormatted).toString();
			process.stderr.write(`${message}\n`);
			this.emit('end');
			if (isProd) {
				throw new Error('Check your sass files');
			}
		}))
		.pipe(postcss(cssConfig.postCSS))
		.pipe(gulpif(!isProd, sourcemaps.write()))
		.pipe(gulpif(isProd, cleanCSS(cssConfig.cleanOpts)))
		.pipe(gulpif(isProd, sourcemaps.write('.')))
		.pipe(size({showFiles: true}))
		.pipe(gulp.dest(cssConfig.build))
		.pipe(gulpif(!isProd, browsersync.reload({stream: true})));
}

function cleanDest() {
	return gulp
		.src('dist', {
			allowEmpty: true
		})
		.pipe(rimraf());
}

/**************** JS task ****************/

const jsConfig = {
	srcMain: dir.src + 'js/main.js',
	srcCopy: dir.src + 'js/copy/*.js',
	watch: dir.src + 'js/**/*',
	build: dir.build + 'js/'
};

function js() {
	return gulp.src(jsConfig.srcMain)
		.pipe(plumber(
			notify.onError({
				title: 'JS',
				message: 'Error: <%= error.message %>'
			})
		))
		.pipe(webpackStream({
			mode: isProd ? 'production' : 'development',
			output: {
				filename: 'main.js',
			},
			module: {
				rules: [{
					test: /\.m?js$/,
					exclude: /node_modules/,
					use: {
						loader: 'babel-loader',
						options: {
							presets: [
								['@babel/preset-env', {
									targets: 'defaults'
								}]
							]
						}
					}
				}]
			},
			devtool: !isProd ? 'source-map' : false
		}))
		.on('error', function (err) {
			console.error('WEBPACK ERROR', err);
			this.emit('end');
		})
		.pipe(gulp.dest(jsConfig.build))
		.pipe(gulpif(!isProd, browsersync.reload({stream: true})));
}

function jsCopy() {
	return gulp.src(jsConfig.srcCopy)
		.pipe(gulp.dest(jsConfig.build));
}

/**************** browser-sync task ****************/

const syncConfig = {
	proxy: {
		target: url
	},
	port: 8000,
	files: [
		'./**/*.php'
	],
	open: false
};

function bs() {
	return browsersync.init(syncConfig);
}

/**************** watch task ****************/

function watchimages() {
	gulp.watch(imgConfig.watch, images);
}

function watchfonts() {
	gulp.watch(fontsConfig.watch, fonts);
}

function watchcss() {
	gulp.watch(cssConfig.watch, css);
}

function watchjs() {
	gulp.watch(jsConfig.watch, gulp.parallel(js, jsCopy));
}

const toProd = (done) => {
	isProd = true;
	done();
};

const build = gulp.parallel(fonts, images, css, js, jsCopy);
const watchers = gulp.parallel(watchcss, watchjs, watchfonts, watchimages);

exports.css = css;
exports.js = js;
exports.jsCopy = jsCopy;
exports.fonts = fonts;
exports.images = images;
exports.cleanDest = cleanDest;

exports.default = gulp.parallel(build, watchers); // gulp: build in dev mode + watch
exports.watch = gulp.parallel(build, bs, watchers); // gulp watch: same + BrowserSync on http://localhost:8000
exports.prod = gulp.series(toProd, cleanDest, build); // gulp prod: clean dist + minified production build

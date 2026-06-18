/**************** gulpfile__.js configuration ****************/

const

	// directory locations
	dir = {
		nm: 'node_modules/',
		theme: '.',
		src: 'assets/',
		build: 'dist/'
	},
	url = 'http://starter2.local',
	themeTextDomain = '_it_start', // run `gulp textdomain` separately for replacing domain

	isGutenberg = false, // whether using Gutenberg in theme or not

	// modules
	gulp = require('gulp'),
	gulpif = require('gulp-if'),
	babel = require('gulp-babel'),
	browsersync = require('browser-sync').create(),
	cleanCSS = require('gulp-clean-css'),
	notify = require('gulp-notify'),
	plumber = require('gulp-plumber'),
	postcss = require('gulp-postcss'),
	PluginError = require('plugin-error'),
	rename = require('gulp-rename'),
	replace = require('gulp-replace'),
	rimraf = require('gulp-rimraf'),
	sass = require('gulp-sass')(require('sass')),
	sassGlob = require('gulp-sass-glob'),
	size = require('gulp-size'),
	sourcemaps = require('gulp-sourcemaps'),
	uglify = require('gulp-uglify'),
	webpackStream = require('webpack-stream');

'use strict';

// Working environment
let isProd = false; // dev by default

// Default error handler
const onError = function (err) {

	console.log('An error occured:', err.message);
	this.emit('end');
};

/**************** textdomain task ****************/

function textdomain() {

	return gulp.src('./**/*', {ignore: ['gulpfile.js', dir.nm]})
		.pipe(replace('_it_start', themeTextDomain))
		.pipe(gulp.dest('./'));

}

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

	src: [dir.src + 'img/**/*', './blocks/**/img/**/*'],
	build: dir.build + 'img/',
	watch: dir.src + 'img/**/*',
	minOpts: {
		optimizationLevel: 5
	}
};

function images() {

	return gulp.src(imgConfig.src)
		.pipe(size({showFiles: true}))
		.pipe(gulp.dest(imgConfig.build));

}

/**************** CSS task ****************/

const cssConfig = {

	src: [dir.src + 'scss/*.scss', './*.scss'],
	srcGutenberg: './blocks/**/*.scss',
	lint: dir.src + 'scss/**/*.scss',
	watch: [dir.src + 'scss/**/*', './*.scss'],
	watchGutenberg: './blocks/**/*.scss',
	build: dir.build + 'css/',
	main: dir.build + 'css/main.css',
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
			2 : {
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
		.pipe(sass(cssConfig.sassOpts).on('error', function(error){
			const message = new PluginError('sass', error.messageFormatted).toString();
			process.stderr.write(`${message}\n`);
			this.emit('end');
			if ( isProd ) {
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

function cssGutenberg() {

	return gulp.src(cssConfig.srcGutenberg)
		.pipe(sassGlob())
		.pipe(sass(cssConfig.sassOpts).on('error', sass.logError))
		.pipe(postcss(cssConfig.postCSS))
		.pipe(size({showFiles: true}))
		.pipe(rename({dirname: ''}))
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

	src: [dir.src + 'js/libs/*.js', dir.src + 'js/custom/*.js'],
	srcMain: dir.src + '/js/main.js',
	srcLibs: dir.src + 'js/libs/*.js',
	srcLint: dir.src + 'js/custom/*.js',
	srcCopy: [dir.src + 'js/copy/*.js'],
	srcGutenberg: './blocks/**/*.js',
	watch: dir.src + 'js/**/*',
	watchGutenberg: './blocks/**/*.js',
	build: dir.build + 'js/'

};

const jsBabelOpts = {
	presets: ['@babel/preset-env']
};


function js() {

	return gulp.src(jsConfig.srcMain)
		.pipe(plumber(
			notify.onError({
				title: "JS",
				message: "Error: <%= error.message %>"
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
									targets: "defaults"
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

function jsGutenberg() {

	return gulp.src(jsConfig.srcGutenberg)
		.pipe(babel(jsBabelOpts))
		.pipe(rename({dirname: ''}))
		.pipe(gulp.dest(jsConfig.build))
		.pipe(uglify())
		.pipe(gulp.dest(jsConfig.build))
		.pipe(gulpif(!isProd, browsersync.reload({stream: true})));
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

// browser-sync
function bs() {

	return browsersync.init(syncConfig);
}

/**************** watch task ****************/

function watchimages() {
	gulp.watch(imgConfig.watch, images);
}

function watchjs() {
	gulp.watch(jsConfig.watch, js);
}

function watchjsCopy() {
	gulp.watch(jsConfig.watch, jsCopy);
}

function watchjsGutenberg() {
	gulp.watch(jsConfig.watchGutenberg, jsGutenberg);
}

function watchcss() {
	gulp.watch(cssConfig.watch, gulp.series(css));
}

function watchcssGutenberg() {
	gulp.watch(cssConfig.watchGutenberg, gulp.series(cssGutenberg));
}

function watchfonts() {
	gulp.watch(fontsConfig.watch, fonts);
}

const toProd = (done) => {
	isProd = true;
	done();
};

const start = gulp.parallel(fonts, images, css, cssGutenberg, js, jsCopy, jsGutenberg, watchcss, watchcssGutenberg, watchjs, watchjsCopy, watchjsGutenberg, watchfonts, watchimages);
const watch = gulp.parallel(fonts, images, css, cssGutenberg, js, jsCopy, jsGutenberg, bs, watchcss, watchcssGutenberg, watchjs, watchjsCopy, watchjsGutenberg, watchfonts, watchimages);
const prod = gulp.series(toProd, cleanDest, gulp.parallel(cssGutenberg, fonts, images, css, cssGutenberg, js, jsCopy, jsGutenberg));

exports.css = css;
exports.cssGutenberg = cssGutenberg;
exports.images = images;
exports.js = js;
exports.jsCopy = jsCopy;
exports.jsGutenberg = jsGutenberg;
exports.bs = bs;
exports.watchimages = watchimages;
exports.watchfonts = watchfonts;
exports.watchjs = watchjs;
exports.watchjsCopy = watchjsCopy;
exports.watchjsGutenberg = watchjsGutenberg;
exports.watchcss = watchcss;
exports.watchcssGutenberg = watchcssGutenberg;
exports.textdomain = textdomain;
exports.cleanDest = cleanDest;

exports.default = start;
exports.watch = watch;
exports.prod = prod;

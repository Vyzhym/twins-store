const browserSync  = require('browser-sync').create(),
      gulp         = require('gulp'),
      gpug          = require('gulp-pug'),
      gsass         = require('gulp-sass'),
      cleancss     = require('gulp-clean-css'),
      autoprefixer = require('gulp-autoprefixer'),
      imagemin     = require('gulp-imagemin'),
      notify       = require('gulp-notify'),
      rename       = require('gulp-rename'),
      del          = require('del'),
      sourcemaps   = require('gulp-sourcemaps'),
      uglify       = require('gulp-uglify'),
	  wait         = require('gulp-wait'),
	  concat	   = require('gulp-concat');

const path = {
	build: {
		pug   : 'build/',
		js    : 'build/js/',
		style : 'build/style/',
		image : 'build/img/',
		font  : 'build/fonts/',
		jslib : 'build/js/lib/',
		csslib: 'build/style/lib/'
	},
	src: {
		pug  : 'src/pug/*.pug',
		js   : 'src/js/*.js',
		style: 'src/sass/**/*.{sass,scss}',
		image: 'src/img/**/*.{jpg,jpeg,png,gif,svg,ico}',
		font : 'src/font/**/*'
	},
	watch: {
		pug  : 'src/pug/**/*.pug',
		js   : 'src/js/*.js',
		style: 'src/sass/**/*.{sass,scss}',
		image: 'src/img/**/*.{jpg,jpeg,png,gif,svg,ico}',
		font : 'src/font/**/*'
	}
};

function browserSyncServer(done) {
	browserSync.init({
		server: {
			baseDir: path.build.pug
		},
		notify: true
	});
	done();
}

function reload(done) {
	browserSync.reload();
	done();
}

function js() {
	return gulp
		.src([path.src.js])
		.on('error', notify.onError({
			message: '\n<%= error.message %>',
			title: 'SCRIPTS'
		}))
		.pipe(sourcemaps.init())
		.pipe(concat('app.js'))
		.pipe(uglify())
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(path.build.js))
		.pipe(browserSync.stream());
}

function sass() {
	return gulp
		.src([path.src.style])
		.pipe(wait(200))
		.pipe(gsass())
		.on('error', notify.onError({
			message: '\n<%= error.message %>',
			title: 'SASS'
		}))
		.pipe(sourcemaps.init())
		.pipe(autoprefixer({
			browsers: ['last 4 versions']
		}))
		.pipe(cleancss())
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(path.build.style))
		.pipe(browserSync.stream());
}

function pug() {
	return gulp
		.src([path.src.pug])
		.pipe(gpug({
			pretty: true
		}))
		.on('error', notify.onError({
			message: '\n<%= error.message %>',
			title: 'PUG'
		}))
		.pipe(gulp.dest(path.build.pug))
		.pipe(browserSync.stream());
}

function image() {
	return gulp
		.src([path.src.image])
		.pipe(imagemin([
			imagemin.gifsicle({
				interlaced: true
			}),
			imagemin.jpegtran({
				progressive: true
			}),
			imagemin.optipng({
				optimizationLevel: 5
			}),
			imagemin.svgo({
				plugins: [{
						removeViewBox: true
					},
					{
						cleanupIDs: false
					}
				]
			})
		]))
		.pipe(gulp.dest(path.build.image))
		.pipe(browserSync.stream());
}

function font() {
	return gulp
		.src([path.src.font])
		.pipe(gulp.dest(path.build.font))
		.pipe(browserSync.stream());
};

function jslib() {
	return gulp
		.src([
			'src/lib/js/*.js',
		])
		.pipe(gulp.dest(path.build.jslib))
		.pipe(browserSync.stream());
}

function csslib() {
	return gulp
		.src([
			'./node_modules/normalize.css/normalize.css',
		])
		.pipe(gulp.dest(path.build.csslib))
		.pipe(browserSync.stream());
}

function watcher() {
	gulp.watch(path.watch.pug, gulp.series(pug, reload));
	gulp.watch(path.watch.style, gulp.series(sass, reload));
	gulp.watch(path.watch.js, gulp.series(js, reload));
	gulp.watch(path.watch.image, gulp.series(image, reload));
	gulp.watch(path.watch.font, gulp.series(font, reload));
	gulp.watch(path.build.jslib, gulp.series(jslib, reload));
	gulp.watch(path.build.csslib, gulp.series(csslib, reload));
}

function clean() {
	return del([path.build.pug]);
}

gulp.task('default', gulp.series(clean, pug, js, sass, jslib, csslib, image, font, browserSyncServer, watcher));
gulp.task('build', gulp.series(clean, pug, js, sass, jslib, csslib, image, font));
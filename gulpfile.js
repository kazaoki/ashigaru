const gulp         = require('gulp');
const plumber      = require('gulp-plumber');
// const rename       = require('gulp-rename');
// const csslint      = require('gulp-csslint');
const sourcemaps   = require('gulp-sourcemaps');
const sass         = require('gulp-sass')(require('sass'));
const autoPrefixer = require('gulp-autoprefixer');
const cssComb      = require('gulp-csscomb');
const cmq          = require('gulp-merge-media-queries');
const cleanCss     = require('gulp-clean-css');
const browserSync  = require('browser-sync');
const typescript   = require('gulp-typescript');
const terser       = require('gulp-terser');

/**
 * sass compile
 */
gulp.task('main-sass', done=>{
	gulp.src(['public/assets/scss/*.scss'])
		.pipe(plumber({
			handleError: function (err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(autoPrefixer())
		.pipe(cssComb())
		.pipe(cmq({log:true}))
		// .pipe(csslint())
		// .pipe(csslint.formatter())
		// .pipe(gulp.dest('public/assets/css'))
		// .pipe(rename({suffix: '.min'}))
		.pipe(cleanCss())
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('public/assets/css'))
		.pipe(browserSync.stream())
	done()
});

gulp.task('manage-sass', done=>{
	gulp.src(['public/assets-manage/scss/*.scss'])
		.pipe(plumber({
			handleError: function (err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(autoPrefixer())
		.pipe(cssComb())
		.pipe(cmq({log:true}))
		// .pipe(csslint())
		// .pipe(csslint.formatter())
		// .pipe(gulp.dest('public/assets/manage/css'))
		// .pipe(rename({suffix: '.min'}))
		.pipe(cleanCss())
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('public/assets-manage/css'))
		.pipe(browserSync.stream())
	done()
});

/**
 * typescript compile
 */
gulp.task('main-ts', done=>{
	gulp.src(['public/assets/ts/*.ts'])
		.pipe(sourcemaps.init())
		.pipe(typescript({
			out: 'main.js',
			// target: 'es5',
			// module: "system",
			removeComments: true,
		}))
		// .pipe(gulp.dest('public/assets/js'))
		// .pipe(rename({suffix: '.min'}))
		.pipe(terser({
			compress: {
				sequences: false
			}
		}))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('public/assets/js'))
		.pipe(browserSync.stream())
	done()
});

gulp.task('manage-ts', done=>{
	gulp.src(['public/assets-manage/ts/*.ts'])
		.pipe(sourcemaps.init())
		.pipe(typescript({
			out: 'main.js',
			// target: 'es5',
			// module: "system",
			removeComments: true,
		}))
		// .pipe(gulp.dest('public/assets-manage/js'))
		// .pipe(rename({suffix: '.min'}))
		.pipe(terser({
			compress: {
				sequences: false
			}
		}))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('public/assets-manage/js'))
		.pipe(browserSync.stream())
	done()
});

/**
 * watch files change
 */
gulp.task('watch', ()=>{
	gulp.watch('public/assets/scss/**/*.scss', gulp.task('main-sass'));
	gulp.watch('public/assets/ts/**/*.ts', gulp.task('main-ts'));
	gulp.watch('public/assets-manage/scss/**/*.scss', gulp.task('manage-sass'));
	gulp.watch('public/assets-manage/ts/**/*.ts', gulp.task('manage-ts'));
	gulp.watch("public/**/*.php").on('change', browserSync.reload);
});

/**
 * Sync server proxy: http://localhost:3000 -> localhost:80
 */
gulp.task('server', ()=>{
	browserSync.init({proxy: 'localhost'});
});

// /**
//  * build only
//  */
gulp.task('build', gulp.series(
	'main-sass',
	'main-ts',
	'manage-sass',
	'manage-ts',
));

// /**
//  * build & watch (default))
//  */
gulp.task('default', gulp.series(
	'main-sass',
	'main-ts',
	'manage-sass',
	'manage-ts',
	gulp.parallel(
		'server',
		'watch',
	)
));

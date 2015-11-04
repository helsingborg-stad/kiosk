/**
 * Require Gulp
 */
var gulp = require('gulp');

/**
 * Require plugins
 */
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var copy = require('gulp-copy');
var plumber = require('gulp-plumber');

/**
 * Variables
 */
var bower_components = 'bower_components/';
var bootstrap_components = 'boostrap_components/';

/**
 * Compiles jQuery and jQuery UI
 */

gulp.task('jquery-core', function () {
    return gulp.src([
                bower_components + 'jquery/dist/jquery.min.js'
            ])
            .pipe(concat('jquery.min.js'))
            .pipe(gulp.dest('assets/js/dist'))
});

gulp.task('jquery', ['jquery-core']);

/**
 * Compiles the SASS for distribution
 */
gulp.task('sass-dist', function () {
    return gulp.src([
                'assets/css/src/app.scss',
                bower_components + 'foundation-multiselect/zmultiselect/zurb5-multiselect.css',
                bower_components + 'datetimepicker/jquery.datetimepicker.css'
            ])
            .pipe(plumber())
            .pipe(concat('app.css'))
            .pipe(sass())
            .pipe(autoprefixer(
                'last 2 version',
                'safari 5',
                'ie 8',
                'ie 9',
                'opera 12.1'
            ))
            .pipe(gulp.dest('assets/css/dist/'))
            .pipe(rename({
                suffix: '.min'
            }))
            .pipe(minifycss())
            .pipe(gulp.dest('assets/css/dist/'))
});

gulp.task('sass-admin-dist', function () {
    return gulp.src([
                'assets/css/src/admin.scss'
            ])
            .pipe(plumber())
            .pipe(concat('admin.css'))
            .pipe(sass())
            .pipe(autoprefixer(
                'last 2 version',
                'safari 5',
                'ie 8',
                'ie 9',
                'opera 12.1'
            ))
            .pipe(rename({
                suffix: '.min'
            }))
            .pipe(minifycss())
            .pipe(gulp.dest('assets/css/dist/'))
});

/**
 * Compiles the JavaScripts for distribution
 */
gulp.task('scripts-dev', function () {
    return gulp.src([
                'assets/js/src/dev/**/*.js',
                bower_components + 'foundation/js/foundation/foundation.js',
                bower_components + 'foundation/js/foundation/foundation.equalizer.js',
                bower_components + 'foundation/js/foundation/foundation.orbit.js',
                bower_components + 'foundation-multiselect/zmultiselect/zurb5-multiselect.js',
                bower_components + 'datetimepicker/jquery.datetimepicker.js'
            ])
            .pipe(concat('app.js'))
            .pipe(gulp.dest('assets/js/dist'))
            .pipe(rename('app.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('assets/js/dist'));
});


gulp.task('scripts-admin', function () {
    return gulp.src('assets/js/src/admin/*.js')
            .pipe(concat('admin.js'))
            .pipe(gulp.dest('assets/js/dist'))
            .pipe(rename('admin.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('assets/js/dist'));
});

gulp.task('scripts-dist', ['scripts-dev', 'scripts-admin']);


/**
 * Watch for changes
 * Recompile any changes to js or scss
 */
gulp.task('watch', function () {
    gulp.watch('assets/css/src/**/*.scss', ['sass-dist', 'sass-admin-dist']);
    gulp.watch('assets/js/src/**/*.js', ['scripts-dist']);
});

/**
 * Default task
 * Compiles sass, js and starts the watch task
 */
gulp.task('default', ['jquery', 'sass-dist', 'sass-admin-dist', 'scripts-dist', 'watch']);
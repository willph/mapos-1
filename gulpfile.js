/*

=========================================================
* Volt - Bootstrap 5 Admin Dashboard
=========================================================

* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2020 Themesberg (https://www.themesberg.com)

* Designed and coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal.

Customized for Map-OS by @ramonsilva20

*/

var autoprefixer = require('gulp-autoprefixer');
var browserSync = require('browser-sync').create();
var cleanCss = require('gulp-clean-css');
const minify = require('gulp-minify');
var del = require('del');
const cssbeautify = require('gulp-cssbeautify');
var gulp = require('gulp');
const npmDist = require('gulp-npm-dist');
var sass = require('gulp-sass');
var wait = require('gulp-wait');
var sourcemaps = require('gulp-sourcemaps');

// Define paths
const paths = {
    dist: {
        base: './public/',
        css: './public/css',
        js: './public/js',
        assets: './public/assets',
        img: './public/assets/img',
        vendor: './public/vendor'
    },
    dev: {
        base: './html&css/',
        css: './html&css/css',
        js: './html&js/js',
        assets: './html&css/assets',
        img: './html&css/assets/img',
        vendor: './html&css/vendor'
    },
    base: {
        base: './',
        node: './node_modules'
    },
    src: {
        base: './resources/',
        css: './resources/css',
        js: './resources/js/**/*.*',
        assets: './resources/assets/**/*.*',
        scss: './resources/sass',
        node_modules: './node_modules/',
        vendor: './vendor'
    },
    temp: {
        base: './.temp/',
        css: './.temp/css',
        js: './.temp/js',
        assets: './.temp/assets',
        vendor: './.temp/vendor'
    }
};

// Compile SCSS
gulp.task('scss', function () {
    return gulp.src([paths.src.scss + '/app.scss', paths.src.scss + '/volt/**/*.scss', paths.src.scss + '/volt.scss'])
        .pipe(wait(500))
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            overrideBrowserslist: ['> 1%']
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.temp.css))
        .pipe(browserSync.stream());
});


gulp.task('assets', function () {
    return gulp.src([paths.src.assets])
        .pipe(gulp.dest(paths.temp.assets))
        .pipe(browserSync.stream());
});

gulp.task('vendor', function () {
    return gulp.src(npmDist(), { base: paths.src.node_modules })
        .pipe(gulp.dest(paths.temp.vendor));
});

gulp.task('js', function () {
    return gulp.src([paths.src.js])
        .pipe(gulp.dest(paths.temp.js))
        .pipe(browserSync.stream());
});

// Beautify CSS
gulp.task('beautify:css', function () {
    return gulp.src([
        paths.dev.css + '/app.css'
    ])
        .pipe(cssbeautify())
        .pipe(gulp.dest(paths.dev.css))
});

// Minify CSS
gulp.task('minify:css', function () {
    return gulp.src([
        paths.dist.css + '/app.css'
    ])
        .pipe(cleanCss())
        .pipe(gulp.dest(paths.dist.css))
});


// Minify JS
gulp.task('minify:js', function () {
    return gulp.src(paths.dist.js + '/*.js')
        .pipe(minify())
        .pipe(gulp.dest(paths.dist.js))
});

// Clean
gulp.task('clean:dist', function () {
    return del([paths.dist.vendor, paths.dist.js, paths.dist.css]);
});

gulp.task('clean:dev', function () {
    return del([paths.dev.base]);
});

// Compile and copy scss/css
gulp.task('copy:dist:css', function () {
    return gulp.src([paths.src.scss + '/volt/**/*.scss', paths.src.scss + '/app.scss'])
        .pipe(wait(500))
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            overrideBrowserslist: ['> 1%']
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.dist.css))
});

gulp.task('copy:dev:css', function () {
    return gulp.src([paths.src.scss + '/volt/**/*.scss', paths.src.scss + '/app.scss'])
        .pipe(wait(500))
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            overrideBrowserslist: ['> 1%']
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.dev.css))
});

// Copy assets
gulp.task('copy:dist:assets', function () {
    return gulp.src(paths.src.assets)
        .pipe(gulp.dest(paths.dist.assets))
});

gulp.task('copy:dev:assets', function () {
    return gulp.src(paths.src.assets)
        .pipe(gulp.dest(paths.dev.assets))
});

// Copy js
gulp.task('copy:dist:js', function () {
    return gulp.src(paths.src.js)
        .pipe(gulp.dest(paths.dist.js))
});

gulp.task('copy:dev:js', function () {
    return gulp.src(npmDist(), { base: paths.src.js })
        .pipe(gulp.dest(paths.dist.base))
});

// Copy node_modules to vendor
gulp.task('copy:dist:vendor', function () {
    return gulp.src(npmDist(), { base: paths.src.node_modules })
        .pipe(gulp.dest(paths.dist.vendor));
});

gulp.task('copy:dev:vendor', function () {
    return gulp.src(npmDist(), { base: paths.src.node_modules })
        .pipe(gulp.dest(paths.dev.vendor));
});

gulp.task('build:dev', gulp.series('clean:dev', 'copy:dev:css', 'copy:dev:assets', 'beautify:css', 'copy:dev:vendor', 'copy:dev:js'));
gulp.task('build:dist', gulp.series('clean:dist', 'copy:dist:css', 'copy:dist:assets', 'minify:css', 'copy:dist:vendor', 'copy:dist:js', 'minify:js'));

// Default
gulp.task('default', gulp.series('build:dist'));

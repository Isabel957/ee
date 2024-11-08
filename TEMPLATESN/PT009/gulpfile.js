// Plugins

const gulp = require('gulp');
const pug = require('gulp-pug');
const beautify = require('gulp-beautify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssmqpacker = require('@hail2u/css-mqpacker');
const sass = require('gulp-dart-sass');
const cleanCSS = require('gulp-clean-css');
const include = require('gulp-include');
const terser = require('gulp-terser');
const svgmin = require('gulp-svgmin');
const webp = require('gulp-webp');
const svgstore = require('gulp-svgstore');
const rename = require('gulp-rename');
const changed = require('gulp-changed');
const ext_replace = require('gulp-ext-replace');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();
const compress = require('compression');
const watch = require('gulp-watch');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const wait = require('gulp-wait');
const cheerio = require('gulp-cheerio');

// Paths

var directory = {
    source: 'source',
    dest: 'html'
}

var path = {

    html: {
        pages: [directory.source + '/pug/views/*.pug'],
        templates: [directory.source + '/pug/templates/*.pug'],
        includes: [directory.source + '/pug/includes/*.pug'],
        phpSource: [directory.source + '/pug/includes/*.pug', '!' + directory.source + '/pug/includes/config.pug'],
        dest: directory.dest
    },
    css: {
        stylus: [directory.source + '/stylus/**/*.styl'],
        scss: [directory.source + '/scss/**/*.scss'],
        dest: directory.dest + '/css/'
    },
    js: {
        js: [directory.source + '/js/*.js'],
        anyJs: [directory.source + '/js/**/*.js'],
        mainJS: [directory.source + '/js/main.js'],
        dest: directory.dest + '/js/'
    },
    fonts: {
        all: [directory.source + '/fonts/**/*.*'],
        dest: directory.dest + '/fonts/'
    },
    images: {
        images: [directory.source + '/images/**/*.{jpg,png}'],
        icons: [directory.source + '/images/icons/*.svg'],
        svgs: [directory.source + '/images/**/*.svg', '!' + directory.source + '/images/icons/*.svg'],
        dest: directory.dest + '/images/',
        destIcons: directory.dest + '/images/icons/'
    }
}

// Tasks

// Pug

gulp.task('pages', function buildPages() {
    return gulp.src(path.html.pages)
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>'),
            sound: false
        }))
        .pipe(changed(path.html.dest, { extension: '.html' }))
        .pipe(pug())
        .pipe(beautify.html({ indent_size: 4, inline: ["svg", "use"] }))
        .pipe(gulp.dest(path.html.dest))
        .pipe(notify({
            message: '<%= file.relative %> completed',
            sound: false,
            onLast: true
        }));
});

gulp.task('all-pug', function buildHTML() {
    return gulp.src(path.html.pages)
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>'),
            sound: false
        }))
        .pipe(pug())
        .pipe(beautify.html({ indent_size: 4, inline: ["svg", "use"] }))
        .pipe(gulp.dest(path.html.dest))
        .pipe(browserSync.reload({ stream: true }))
        .pipe(notify({
            message: 'Site updated',
            sound: false,
            onLast: true
        }));
});

// Scss

gulp.task('scss', function buildCss() {
    var plugins = [
        autoprefixer(),
        cssmqpacker({
            sort: true
        })
    ];
    return gulp.src(path.css.scss)
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>'),
            sound: false
        }))
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(cleanCSS({level: 2}))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(path.css.dest))
        .pipe(browserSync.reload({ stream: true }))
        .pipe(notify({
            message: 'CSS completed',
            sound: false,
            onLast: true
        }));
});

// JS

gulp.task('js', function () {
    return gulp.src(path.js.js)
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>'),
            sound: false
        }))
        .pipe(sourcemaps.init())
        .pipe(include({
            extensions: 'js',
            includePaths: [
                __dirname + '/node_modules'
            ]
        }))
        .pipe(terser())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(path.js.dest))
        .pipe(browserSync.reload({ stream: true }))
        .pipe(notify({
            message: 'JS completed',
            sound: false,
            onLast: true
        }));
});

// Fuentes

gulp.task('fonts', function () {
    return gulp.src(path.fonts.all)
        .pipe(gulp.dest(path.fonts.dest))
        .pipe(notify({
            message: 'Fonts ready',
            sound: false,
            onLast: true
        }));
});

// Images

gulp.task('images', function () {
    return gulp.src(path.images.images)
        .pipe(webp({                    
            alphaQuality: 85,
            quality: 85
        }))
        .pipe(gulp.dest(path.images.dest))
        .pipe(notify({
            message: 'Images completed',
            sound: false,
            onLast: true
        }));
});

// SVGs

gulp.task('svgs', function () {
    return gulp.src(path.images.svgs)
        .pipe(svgmin({
            plugins: [
                'removeComments'
            ]
        }))
        .pipe(cheerio({
            run: function ($) {
                if ($('[viewBox]').length == 0) {
                    let width = $('svg').attr('width');
                    let height = $('svg').attr('height');
                    let viewBox = '0 0 ' + width + ' ' + height;
                    $('svg').attr('viewBox', viewBox);
                } else if ($('[viewBox]').length && $('[width]').length == 0 && $('[height]').length == 0) {
                    let viewBox = $('svg').attr('viewBox');
                    let splitViewBox = viewBox.split(' ');
                    $('svg').attr('width', splitViewBox[2]);
                    $('svg').attr('height', splitViewBox[3]);
                }
            },
            parserOptions: { xmlMode: true }
        }))
        .pipe(gulp.dest(path.images.dest))
        .pipe(notify({
            message: 'Svgs completed',
            sound: false,
            onLast: true
        }));
});

// Icons

gulp.task('icons', function () {
    return gulp.src(path.images.icons)
        .pipe(svgmin({
            plugins: [
                'removeDoctype',
                'removeComments'
            ]
        }))
        .pipe(cheerio({
            run: function ($) {
                $('g[mask]').remove();
                $('[fill]').removeAttr('fill');
                $('[stroke]').removeAttr('stroke');
                $('[style]').removeAttr('style');
                if ($('[viewBox]').length == 0) {
                    let width = $('svg').attr('width');
                    let height = $('svg').attr('height');
                    let viewBox = '0 0 ' + width + ' ' + height;
                    $('svg').attr('viewBox', viewBox);
                } else if ($('[viewBox]').length && $(['width']).length == 0 && $(['height']).length == 0) {
                    let viewBox = $('svg').attr('viewBox');
                    let splitViewBox = viewBox.split(' ');
                    $('svg').attr('width', splitViewBox[2]);
                    $('svg').attr('height', splitViewBox[3]);
                }
            },
            parserOptions: { xmlMode: true }
        }))
        .pipe(svgstore())
        .pipe(rename('icons.svg'))
        .pipe(gulp.dest(path.images.destIcons))
        .pipe(notify({
            message: 'Icons compiled',
            sound: false,
            onLast: true
        }));
});

// LPs PHP

gulp.task('php', function buildHTML() {
    return gulp.src(path.html.phpSource)
        .pipe(plumber())
        .pipe(pug({ pretty: true }))
        .pipe(ext_replace('.php'))
        .pipe(gulp.dest(path.html.dest))
        .pipe(notify({
            message: 'PHP completed',
            sound: false,
            onLast: true
        }));
});

// Watch

gulp.task('watch', function watch() {
    browserSync.init({
        server: {
            baseDir: directory.dest,
            httpModule: 'http2',
            middleware: [compress()]
        }     
        
    });
    gulp.watch(path.html.pages, gulp.series('pages'));
    gulp.watch(path.html.templates, gulp.series('all-pug'));
    gulp.watch(path.html.includes, gulp.series('all-pug'));
    gulp.watch(path.css.scss, gulp.series('scss'));
    gulp.watch(path.js.js, gulp.series('js'));
    gulp.watch(path.js.anyJs, gulp.series('js'));
    gulp.watch(directory.dest + '/*.html').on('change', browserSync.reload);
    gulp.watch(directory.dest + '/images/**/*.*').on('change', browserSync.reload);
});

gulp.task('default', gulp.series('watch'));
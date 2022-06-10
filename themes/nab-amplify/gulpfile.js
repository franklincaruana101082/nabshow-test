const {src, dest, watch, series} = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const postcss = require('gulp-postcss')
const cleancss = require('gulp-clean-css')
const autoprefixer = require('autoprefixer')
const rename = require('gulp-rename')
const sourcemaps = require('gulp-sourcemaps')

const imagemin = require('gulp-imagemin');

const babel = require('gulp-babel');
const terser = require('gulp-terser');
const concat = require('gulp-concat');

const browserSync = require('browser-sync').create();



const paths = {
  html: {
    src: './src/**/*.html',
    dest: './assets/'
  },
  styles: {
    src: './src/scss/**/*.scss',
    dest: './'
  },
  scripts: {
    src: './src/js/**/*.js',
    dest: './js'
  },
  vendors: {
    src: './src/js/vendors/**/*.js',
    dest: './assets/js'
  },
  images: {
    src: './src/images/**/*',
    dest: './assets/images'
  }
};

function serve () {
  browserSync.init({
    proxy: "https://amplify.nabshow.vipdev.lndo.site/"
  })
}

function css () {
  // ...
  return src(paths.styles.src)
    .pipe(sourcemaps.init())
    .pipe(sass()
      .on('error', sass.logError)
    )
    .pipe(postcss([autoprefixer()]))
    .pipe(cleancss())
    .pipe(rename({
        basename: 'style'
      }))
    .pipe(sourcemaps.write('.'))
    .pipe(dest(paths.styles.dest))
    .pipe(browserSync.stream());
}

function images () {
  return src(paths.images.src)
    .pipe(imagemin())
    .pipe(dest(paths.images.dest))
}

// Minify all javascript files and concat them into a single app.min.js
function scripts () {
  return src(paths.scripts.src)
    .pipe(sourcemaps.init())
    .pipe(
      babel({
        presets: ['@babel/preset-env']
      })
    )
    .pipe(terser())
    .pipe(concat('app.min.js'))
    .pipe(sourcemaps.write('.'))
    .pipe(dest(paths.scripts.dest));
}

// Minify all javascript vendors/libs and concat them into a single vendors.min.js
function vendors () {
  return src(paths.vendors.src)
    .pipe(sourcemaps.init())
    .pipe(
      babel({
        presets: ['@babel/preset-env']
      })
    )
    .pipe(terser())
    .pipe(concat('vendors.min.js'))
    .pipe(sourcemaps.write('.'))
    .pipe(dest(paths.vendors.dest));
}

function reload (cb) {
  browserSync.reload();
  cb();
}

function watcher (cb) {
  series(css, images, scripts);
  serve();
  watch(paths.styles.src, series(css), cb);
  watch(paths.images.src, series(images, reload), cb);
  watch(paths.scripts.src, series(scripts, reload), cb);
}

exports.watch = watcher
exports.css = css
exports.images = images
exports.scripts = scripts
exports.default = watcher
const { src, dest, watch, series, parallel } = require("gulp");
//SASS
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("autoprefixer");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");
const cssnano = require("cssnano");
const concat = require("gulp-concat");
//JS
const terser = require("gulp-terser-js");
const rename = require("gulp-rename");
//IMG
const imagemin = require("gulp-imagemin"); // Minificar imagenes
const notify = require("gulp-notify");
const cache = require("gulp-cache");
const clean = require("gulp-clean");
const webp = require("gulp-webp");

const paths = {
  imagenes: "src/img/**/*",
};

function imagenes() {
  return src(paths.imagenes)
    .pipe(cache(imagemin({ optimizationLevel: 3 })))
    .pipe(dest("public/src/img"))
    .pipe(notify({ message: "Imagen Completada" }));
}

function versionWebp() {
  return src(paths.imagenes)
    .pipe(webp())
    .pipe(dest("public/src/img"))
    .pipe(notify({ message: "Imagen Webp Completada" }));
}

function watchArchivos() {
  watch(paths.imagenes, imagenes);
  watch(paths.imagenes, versionWebp);
}

exports.watchArchivos = watchArchivos;
exports.default = parallel(imagenes, versionWebp, watchArchivos);

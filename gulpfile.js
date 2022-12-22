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
  scss: "src/scss/**/*.scss",
  js: "src/js/**/*.js",
  imagenes: "src/img/**/*",
};

// css es una función que se puede llamar automaticamente
function css() {
  return (
    src(paths.scss)
      .pipe(sourcemaps.init()) //Para identificar donde modificar el codigo
      .pipe(sass()) //Compilar
      .pipe(postcss([autoprefixer(), cssnano()])) //Comprimir el codigo CSS
      // .pipe(postcss([autoprefixer()]))
      .pipe(sourcemaps.write("."))
      .pipe(dest("public/src/css"))
  );
}

function javascript() {
  return src(paths.js)
    .pipe(sourcemaps.init())
    .pipe(terser()) //Comprimir el codigo JS
    .pipe(sourcemaps.write("."))
    .pipe(dest("public/src/js"));
}

//Optimizar todas las imagenes
function imagenes() {
  return src(paths.imagenes)
    .pipe(cache(imagemin({ optimizationLevel: 3 })))
    .pipe(dest("public/src/img"))
    .pipe(notify({ message: "Imagen Completada" }));
}

//convertir a .webp
function versionWebp() {
  return src(paths.imagenes)
    .pipe(webp())
    .pipe(dest("public/src/img"))
    .pipe(notify({ message: "Imagen Webp Completada" }));
}

//Para que se compile los cambios automaticamente
function watchArchivos() {
  watch(paths.scss, css);
  watch(paths.js, javascript);
  watch(paths.imagenes, imagenes);
  watch(paths.imagenes, versionWebp);
}

exports.css = css;
exports.watchArchivos = watchArchivos;
exports.default = parallel(
  css,
  javascript,
  imagenes,
  versionWebp,
  watchArchivos
);

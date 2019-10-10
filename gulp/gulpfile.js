"use strict";

let gulp = require( "gulp" ),
    watch = require( "gulp-watch" ),
    rigger = require( "gulp-rigger" ),
    concat = require( "gulp-concat" ),
    sourcemaps = require( "gulp-sourcemaps" ),
    cssmin = require( "gulp-minify-css" ),
    minify = require( "gulp-minify" ),
    stylus = require( "gulp-stylus" ),
    rename = require( "gulp-rename" ),
    prefixer = require( "gulp-autoprefixer" ),
    replace = require('gulp-replace'),
    rimraf = require( "rimraf" );

let projectPath = "../";
let lib = projectPath + "assets/";
let css = lib + "/css/stylus/";
let js = lib + "/js/main/";


let projectPaths = {
    "app" : {
        "css" : [
            css + "main.styl"
        ],
        "js" : [
            js + "main.js"
        ]
    },
    "watch" : {
        "css" : css + "*.styl",
        "js" : [
            js + "*.js",
            js + "**/*.js"
        ]
    },
    "dist" : {
        css: lib + "css/",
        js: lib + "js/"
    },
    "clean" : projectPath
};

function JsBuild() {
    return gulp.src( projectPaths.app.js )
            .pipe( concat( "main.js" ) )
            .pipe( rigger() )
            .pipe( sourcemaps.init() )
            .pipe( minify() )
            .pipe( sourcemaps.write() )
            .pipe( gulp.dest( projectPaths.dist.js ) );
}

function StylusBuild() {
    return gulp.src( projectPaths.app.css ) //Выберем наш main.scss
            .pipe( sourcemaps.init() ) //То же самое что и с js
            .pipe( stylus() ) //Скомпилируем
            .pipe( concat("style.css") )
            .pipe( prefixer( [
                    'last 15 versions',
                    '> 1%',
                    'ie 8',
                    'ie 7'
                ],
                { cascade: true }
                )
            ) //Добавим вендорные префиксы
            .pipe( sourcemaps.write() )
            .pipe( gulp.dest( projectPaths.dist.css ) );
}

function CssBuild() {
	return gulp.src( projectPaths.dist.css + "style.css"  ) // Выбираем файл для минификации
		.pipe( cssmin() ) // Сжимаем
		.pipe( rename( { suffix: ".min" } ) ) // Добавляем суффикс .min
		.pipe( gulp.dest( projectPaths.dist.css ) ); // Выгружаем в папку app/css
}

function Clean(cb) {
    rimraf( projectPaths.clean, cb );
}


let _css = gulp.series( StylusBuild, CssBuild );

function WatchFiles() {
    watch( projectPaths.watch.css, _css );
    watch( projectPaths.watch.js, JsBuild );
}

gulp.task( "build", gulp.series( JsBuild, _css ) );
gulp.task( "watch", gulp.parallel( WatchFiles ) );

gulp.task( "clean", Clean );
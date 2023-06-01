var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var rename = require("gulp-rename");
var babel = require("gulp-babel");
var uglify = require("gulp-uglify")

gulp.task('sass', () =>
    gulp.src('scss/main.scss')
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('css'))
);

gulp.task("js",  () =>
    gulp.src("js/*.js",)
        .pipe(babel())
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest("dist/js/"))
);


gulp.task("watch", function () {
    //gulp.watch("js/*.js", gulp.series(["js"]));
    gulp.watch("scss/*.scss", gulp.series(["sass"]));
});


gulp.task('default', gulp.series(['watch']));

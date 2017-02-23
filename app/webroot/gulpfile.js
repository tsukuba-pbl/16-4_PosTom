var gulp = require('gulp');
var concat = require("gulp-concat");
var uglify = require("gulp-uglify");
var rename = require('gulp-rename');

gulp.task('js', function() {
    return gulp.src('./js/posmapp_js/*.js')
        .pipe(concat('posmapp.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./js/posmapp_js/'));
    console.log('JSを結合しました。');
});

gulp.task('default', ['js']);

var gulp = require('gulp');
var concat = require("gulp-concat");
var uglify = require("gulp-uglify");
var rename = require('gulp-rename');

gulp.task('js', function() {
    return gulp.src('./vote_js/*.js')
        .pipe(concat('vote_app.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./vote_js'));
    console.log('JSを結合しました。');
});

gulp.task('default', ['js']);

var gulp = require('gulp');
var concat = require("gulp-concat");

gulp.task('js', function() {
    gulp.src('./vote_js/*.js')
        .pipe(concat('vote_app.js'))
        .pipe(gulp.dest('./vote_js'));
    console.log('JSを結合しました。');
});

gulp.task('default', ['js']);

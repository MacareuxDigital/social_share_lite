var gulp = require('gulp');
var zip = require('gulp-zip');

gulp.task('zip', function () {
    return gulp.src(['social_share_lite/**/*'], {base: "."})
        .pipe(zip('social_share_lite.zip'))
        .pipe(gulp.dest('./build'));
});

gulp.task('default', ['zip']);
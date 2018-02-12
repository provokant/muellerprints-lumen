const gulp = require('gulp');
const phpunit = require('gulp-phpunit');


gulp.task('phpunit', () => {
  const options = {
    clear: true, 
    debug: true
  };

  gulp.src('phpunit.xml')
    .pipe(phpunit('./vendor/bin/phpunit', options));
});

gulp.task('watch', () => {
  gulp.watch('**/*.php', ['phpunit']);
});

gulp.task('default', ['phpunit', 'watch']);
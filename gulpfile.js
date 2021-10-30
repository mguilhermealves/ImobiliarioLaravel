var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var siteName = 'localhost';

var paths = {
  php: [
    'config/cms.php',
    'resources/views/**/*',
    'app/Models/**/*',
  ],
  scripts: [
    'resources/assets/sistema/css/**/*.css', 
    'resources/assets/sistema/js/**/*', 
    'resources/assets/backend/**/*', 
  ]
};

gulp.task('default', function () {
  browserSync.init({
    proxy: 'http://' + siteName + '/88',
    host: siteName,
    open: 'local',
    port: 8080
  });

  gulp.watch(paths.php).on('change', browserSync.reload);
  gulp.watch(paths.scripts).on('change', browserSync.reload);

});
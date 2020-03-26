const gulp        = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('browser-sync', () => {
    browserSync.init({
        proxy: "localhost:8000",
        files: [
            "src/**/**.php",
            "public/index.php",
            "templates/**/*.phtml"
        ]
    })
});
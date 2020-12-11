const gulp = require("gulp");
const postCss = require("gulp-postcss");
const browserSync = require("browser-sync");
const server = browserSync.create();

// BrowserSync
function serve(done) {
	server.init({
		open: false,
		proxy: "http://aquavita/",
	});
	done();
}

//BrowserSync realod
function reload(done) {
	server.reload();
	done();
}

// CSS
function css() {
	return gulp
		.src(["./src/css/style.css"])
		.pipe(postCss())
		.pipe(gulp.dest("./"));
}

// Watch
function watchFiles() {
	gulp.watch("./src/css/**/*.css", gulp.series(css, reload));
	gulp.watch("./**/*.php", reload);
}

exports.default = gulp.series(serve, watchFiles);

exports.build = css;

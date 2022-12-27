var project = require('./package.json'),
	gulp = require('gulp'),
	sass = require('gulp-sass')(require('sass'));
autoPrefixer = require('gulp-autoprefixer'),
	wpPot = require('gulp-wp-pot'),
	clean = require('gulp-clean'),
	zip = require('gulp-zip');
rtlcss = require('gulp-rtlcss');
gulpfilter = require('gulp-filter');
rename = require("gulp-rename");

sass.compiler = require('node-sass');

gulp.task('sass-admin', function () {
	return gulp.src(['style.scss',], { cwd: 'src/sass/admin' })
		.pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
		.pipe(autoPrefixer({ browsers: ["> 1%", "last 2 versions"] }))
		.pipe(gulp.dest('admin/css/'))
});

gulp.task('pot', function () {
	return gulp.src(['**/*.php', '!__*/**', '!src/**', '!assets/**'])
		.pipe(wpPot({
			domain: 'all-in-one-content-restriction',
		}))
		.pipe(gulp.dest('languages/all-in-one-content-restriction.pot'));
});

gulp.task('clean', function () {
	return gulp.src('__build/*.*', { read: false })
		.pipe(clean());
});

gulp.task('zip', function () {
	return gulp.src(
		[
			'**',
			'!__*/**',
			'!node_modules/**',
			'!src/**',
			'!.gitignore',
			'!readme.md',
			'!gulpfile.js',
			'!package.json',
			'!package-lock.json',
		],
		{ base: '..' })
		.pipe(zip(project.name + '.zip'))
		.pipe(gulp.dest('__build'));
});


gulp.task('watch', function () {
	gulp.watch('src/sass/**/*.scss', gulp.series('sass-admin'));
});

// gulp.task('run', gulp.parallel('sass','pot'));
// gulp.task('build', gulp.series('run','clean','zip'));
// gulp.task('default', gulp.series('run','watch'));

gulp.task('build', gulp.series('pot', 'clean', 'zip', 'sass-admin'));
var project = require('./package.json'),
	gulp = require('gulp'),
	wpPot = require('gulp-wp-pot'),
	clean = require('gulp-clean'),
	zip = require('gulp-zip');

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


gulp.task('build', gulp.series('pot', 'clean', 'zip'));
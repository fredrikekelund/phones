module.exports = function (karma) {
	karma.set({
		frameworks: ["browserify", "mocha", "chai"],
		files: [
			"build/js/*.js",
			"test/*.js"
		],
		preprocessors: {
			"test/*.js": ["browserify"]
		},
		reporters: ["progress"],
		logLevel: karma.LOG_INFO,
		autoWatch: true,
		browsers: ["Chrome"]
	});
};

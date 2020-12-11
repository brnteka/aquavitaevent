module.exports = {
	plugins: [
		require("postcss-import"),
		require("postcss-calc"),
		require("postcss-easing-gradients"),
		require("tailwindcss"),
		// require("postcss-current-selector"),
		// require("postcss-simple-vars"),
		require("postcss-nested"),
		...(process.env.NODE_ENV === "production"
			? [
					require("autoprefixer"),
					require("cssnano")({
						preset: "default",
					}),
			  ]
			: []),
	],
};

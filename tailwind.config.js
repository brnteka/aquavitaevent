module.exports = {
	purge: ["./**/*.php"],
	theme: {
		fontFamily: {
			gothampro: ['"Gotham Pro"'],
		},
		screens: {
			sm: "768px",
			md: "1024px",
			desktopmenu: "1200px",
			lg: "1440px",
			xl: "1920px",
		},
		aspectRatio: {
			none: 0,
			square: [1, 1],
			rectangle: [231, 122],
		},
		extend: {
			fontSize: {
				"3dot5xl": "2rem",
				"5dot5xl": "3.25rem",
				"7xl": "6rem",
				"8xl": "8rem",
				hero: "3.875rem",
			},
			colors: {
				black: "#2F3343",
			},
			spacing: {
				128: "32rem",
			},
			inset: {
				"1/4": "25%",
				"1/2": "50%",
			},
		},
	},
	variants: {},
	plugins: [
		function ({ addComponents }) {
			addComponents(
				{
					".container": {
						maxWidth: "100%",
						"@screen sm": {
							maxWidth: "704px",
						},
						"@screen md": {
							maxWidth: "936px",
						},
						"@screen lg": {
							maxWidth: "1248px",
						},
					},
				},
				{
					variants: ["responsive"],
				}
			);
		},
		function ({ addComponents }) {
			addComponents(
				{
					".header-container": {
						maxWidth: "100%",
						"@screen sm": {
							maxWidth: "704px",
						},
						"@screen md": {
							maxWidth: "936px",
						},
						"@screen desktopmenu": {
							maxWidth: "1200px",
						},
						"@screen lg": {
							maxWidth: "1248px",
						},
					},
				},
				{
					variants: ["responsive"],
				}
			);
		},
		function ({ addComponents }) {
			addComponents({
				".modal-container": {
					maxWidth: "100%",
					"@screen sm": {
						maxWidth: "704px",
					},
					"@screen md": {
						maxWidth: "936px",
					},
					"@screen lg": {
						maxWidth: "1248px",
					},
				},
			});
		},
		require("tailwindcss-aspect-ratio"),
		require("tailwindcss-multi-column")(),
	],
	corePlugins: {
		container: false,
	},
};

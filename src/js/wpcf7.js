document.addEventListener(
	"wpcf7mailsent",
	function (event) {
		if (wpml_browser_redirect_params.pageLanguage === "ua") {
			location = window.location.origin.concat("/thankyou");
		} else {
			location = window.location.origin
				.concat("/")
				.concat(wpml_browser_redirect_params.pageLanguage)
				.concat("/thankyou");
		}
	},
	false
);

function undisabledSubmitbuttonCF7(button) {
	button.classList.remove("button-disabled");
}
var wpcf7Elms = document.querySelectorAll(".wpcf7");

wpcf7Elms.forEach(function (form) {
	const submitButton = form.querySelector('[type="submit"]');

	submitButton.addEventListener("click", function (event) {
		if (submitButton.classList.contains("button-disabled")) {
			return false;
		}
		submitButton.classList.add("button-disabled");
	});
	form.addEventListener(
		"wpcf7invalid",
		function (event) {
			undisabledSubmitbuttonCF7(submitButton);
		},
		false
	);
	form.addEventListener(
		"wpcf7mailfailed ",
		function (event) {
			undisabledSubmitbuttonCF7(submitButton);
		},
		false
	);
	form.addEventListener(
		"wpcf7spam",
		function (event) {
			undisabledSubmitbuttonCF7(submitButton);
		},
		false
	);
});

function toggleBodyOverflow() {
	document.body.classList.toggle("overflow-hidden");
}

// Spruce.store("application", {
// 	activeSlideOut: "",
// });

// Spruce.watch("application.activeSlideOut", (old, next) => {
// 	if (next === "") {
// 		document.body.classList.remove("overflow-hidden");
// 	}
// 	if (next !== "") {
// 		document.body.classList.add("overflow-hidden");
// 	}
// });

// Footer slideout

function objMQ() {
	var mainContainer = document.querySelector(".main");
	var footer = document.querySelector(".footer");
	var marginIsSet = false;

	function addMargin() {
		// mainContainer.setAttribute(
		// 	"style",
		// 	"margin-bottom: ".concat(footer.offsetHeight, "px")
		// );
		mainContainer.style.marginBottom = footer.offsetHeight + "px";
		marginIsSet = true;
	}

	function removeMargin() {
		if (marginIsSet) {
			//mainContainer.setAttribute("style", "margin-bottom: 0px");
			mainContainer.style.marginBottom = "0px";
			marginIsSet = false;
		}
	}

	return {
		addMargin: addMargin,
		removeMargin: removeMargin,
	};
}

var competedTrack = objMQ();

function mqOptions(options) {
	var mqObj = {
		desktop: false,
	};

	var mq = window.matchMedia(options.mq);

	mq.addListener(setMQ);
	setMQ(mq);

	function setMQ(mq) {
		mqObj.desktop = mq.matches ? true : false;
	}

	window.addEventListener(
		"resize",
		debounce(function () {
			if (mqObj.desktop) {
				options.in();
			} else {
				options.out();
			}
		}, 250)
	);

	window.addEventListener("load", function () {
		if (mqObj.desktop) {
			options.in();
		}
	});
}

mqOptions({
	mq: "(min-width: 1440px)",
	in: function () {
		competedTrack.addMargin();
	},
	out: function () {
		competedTrack.removeMargin();
	},
});

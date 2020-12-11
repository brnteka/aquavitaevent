// Util functions
function map(x, in_min, in_max, out_min, out_max) {
	return ((x - in_min) * (out_max - out_min)) / (in_max - in_min) + out_min;
}

const maxTranslate = 30;
function setTranslate(item) {
	const rect = item.getBoundingClientRect();
	const top = Math.min(0, Math.max(-100, (rect.top * 100) / rect.height));
	const bot = Math.min(
		100,
		Math.max(0, ((rect.bottom - window.innerHeight) * 100) / rect.height)
	);

	let minAbsValue = 0;
	// If bot values are 0 it means the image is inside viewport

	// Always get biggest value
	if (Math.abs(top) > Math.abs(bot)) {
		minAbsValue = top;
	}
	if (Math.abs(bot) > Math.abs(top)) {
		minAbsValue = bot;
	}
	// If image is smaller that viewport
	// Caculate closest percentage.
	// If the image extends to the top and the bot the same height
	// then value will be 0
	if (top != 0 && bot != 0) {
		minAbsValue = top + bot;
	}
	// Then map it to a number between MaxTranslate negative and positive
	const mapped = map(
		minAbsValue,
		-100,
		100,
		-maxTranslate,
		maxTranslate
	).toFixed(6);
	item.style.transform = "translateY(" + mapped * -1 + "%)";
}

function layOutItems(items) {
	items.forEach(function (item) {
		var image = item.element.querySelector(".tile-bg");

		if (item.element.classList.contains("tile-hidden")) {
			var bg = image.dataset.bg;

			var img = new Image();

			img.onload = function () {
				image.style.backgroundImage = "url(" + bg + ")";

				imagesLoaded(image, { background: true }, function () {
					item.element.classList.remove("tile-hidden");
					// image.dataset.bg = "loaded";
				});
			};
			img.src = bg;
			if (img.complete) img.onload();
		}

		if (image.dataset.initiated === "false") {
			setTranslate(image);

			window.addEventListener("scroll", function (e) {
				setTranslate(image);
			});

			image.dataset.initiated = "true";
		}
	});
}

function portfolio() {
	return {
		paged: 2,
		totalposts: null,
		loadedposts: 0,
		language: null,
		initMasonry() {
			this.masonry = new Masonry(this.$refs.masonry, {
				itemSelector: ".tile",
				transitionDuration: 0,
				initLayout: false,
			});
		},
		init() {
			this.initMasonry();

			this.registerEventMasonry();

			this.masonry.layout();

			this.deregisterEventMasonry();
		},
		registerEventMasonry() {
			this.masonry.on("layoutComplete", layOutItems);
		},
		deregisterEventMasonry() {
			this.masonry.off("layoutComplete", layOutItems);
		},
		getData() {
			var _this = this;

			var xhttp = new XMLHttpRequest();

			xhttp.onreadystatechange = function () {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					var parsedResponse = JSON.parse(xhttp.responseText);

					_this.totalposts = parsedResponse.totalposts;

					var DOMResponse = new DOMParser().parseFromString(
						parsedResponse.html,
						"text/html"
					);
					var masonryItems = DOMResponse.querySelectorAll(".tile");

					_this.loadedposts = _this.loadedposts + masonryItems.length;

					_this.$nextTick(function () {
						var fragment = document.createDocumentFragment();
						var elems = [];

						for (var i = 0; i < masonryItems.length; i++) {
							fragment.appendChild(masonryItems[i]);
							elems.push(masonryItems[i]);
						}

						_this.$refs.masonry.appendChild(fragment);

						_this.registerEventMasonry();

						_this.masonry.appended(elems);

						_this.deregisterEventMasonry();

						_this.masonry.layout();

						_this.paged++;
					});
				}
			};

			xhttp.open("POST", localize.ajaxurl, true);

			xhttp.setRequestHeader(
				"Content-Type",
				"application/x-www-form-urlencoded"
			);

			xhttp.send(
				"action=more_post_ajax" +
					"&paged=" +
					_this.paged +
					"&language=" +
					_this.language
			);
		},
		initPortfolioItem(id, posttype) {
			fetch(localize.ajaxurl, {
				method: "POST",
				headers: {
					"Content-Type": "application/x-www-form-urlencoded",
				},
				body:
					"action=portfolioContent&id=" +
					id +
					"&language=" +
					wpml_browser_redirect_params.pageLanguage,
			})
				.then(function (response) {
					return response.json();
				})
				.then(function (data) {
					console.log(data);
					if (posttype === "portfolio_gallery") {
						jQuery.magnificPopup.open(
							{
								items: data,
								gallery: {
									enabled: true,
								},
								type: "image",
							},
							0
						);
					}

					if (posttype === "portfolio_video") {
						jQuery.magnificPopup.open(
							{
								items: {
									src: data.src,
								},
								type: "iframe",
								iframe: {
									markup:
										'<div class="mfp-iframe-scaler">' +
										'<div class="mfp-close"></div>' +
										'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
										"</div>",
									patterns: {
										youtube: {
											index: "youtube.com/",
											id: "v=",
											src:
												"//www.youtube.com/embed/%id%?autoplay=1",
										},
									},
									srcAction: "iframe_src",
								},
							},
							0
						);
					}
				});
		},
	};
}

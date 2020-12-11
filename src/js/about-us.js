(function ($) {
	$("#team-slider-main").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		swipe: false,
		fade: true,
	});

	$("#team-slider-supportive").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		dots: false,
		nextArrow: $("#team-slider-supportive-next-arrow"),
		prevArrow: $("#team-slider-supportive-prev-arrow"),
		initialSlide: 1,
		swipe: false,
		fade: true,
	});

	$("#team-slider-supportive").on("beforeChange", function (
		event,
		slick,
		currentSlide,
		nextSlide
	) {
		$("#team-slider-main").slick("slickGoTo", nextSlide - 1);
	});
})(jQuery);

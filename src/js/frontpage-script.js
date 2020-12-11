var numbersCompleted = document
	.getElementById("competedCounters")
	.querySelectorAll("[data-counter]");

inView("#competedCounters").once("enter", function (invewitem) {
	var options = {
		useEasing: true,
	};
	[].forEach.call(numbersCompleted, function (item) {
		var countUp = new CountUp(
			item,
			0,
			parseInt(item.dataset.countto, 10),
			0,
			0,
			options
		);
		if (!countUp.error) {
			countUp.start();
		} else {
			console.error(countUp.error);
		}
	});
});

var numbersImplemented = document
	.getElementById("implementedCounter")
	.querySelectorAll("[data-counter]");

inView("#implementedCounter").once("enter", function (invewitem) {
	var options = {
		useEasing: true,
	};
	[].forEach.call(numbersImplemented, function (item) {
		var countUp = new CountUp(
			item,
			0,
			parseInt(item.dataset.countto, 10),
			0,
			0,
			options
		);
		if (!countUp.error) {
			countUp.start();
		} else {
			console.error(countUp.error);
		}
	});
});

(function () {
	// Add event listener
	document.addEventListener("mousemove", parallax);
	const elem = document.querySelector("#bgThankYou");
	// Magic happens here
	function parallax(e) {
		let _w = window.innerWidth / 2;
		let _h = window.innerHeight / 2;
		let _mouseX = e.clientX;
		let _mouseY = e.clientY;
		let _background = `${50 - (_mouseX - _w) * 0.01}% ${
			50 - (_mouseY - _h) * 0.01
		}%`;
		let _cloudsBack = `${50 - (_mouseX - _w) * 0.02}% ${
			50 - (_mouseY - _h) * 0.02
		}%`;
		let _cloudsFront = `${50 - (_mouseX - _w) * 0.25}% ${
			50 - (_mouseY - _h) * 0.25
		}%`;
		let x = `${_cloudsFront}, ${_cloudsFront}, center center, ${_cloudsBack}, ${_cloudsBack}, ${_background}`;
		elem.style.backgroundPosition = x;
	}
})();

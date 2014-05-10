!function (window, document) {

	var counter = 0,
	    value,
	    timer

	function show_slider () {

		value = counter - 130

		document.getElementById('content').style.left = value + 'px'
		document.getElementById('opener').style.left = counter + 'px'


		if (counter >= 130)
			clearTimeout(timer)

		else {
			counter += 10
			timer = setTimeout(show_slider, 10)
		}

	}


	function hide_slider () {

		value = counter - 130

		document.getElementById('content').style.left = value + 'px'
		document.getElementById('opener').style.left = counter + 'px'


		if (counter <= 0)
			clearTimeout(timer)

		else {
			counter -= 10
			timer = setTimeout(hide_slider, 10)
		}
	}

	window.show_slider = show_slider
	window.hide_slider = hide_slider

}(window, document)

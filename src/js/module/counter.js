(function() {
	let count = parseInt($('.counter-number').text()),
		max = parseInt($('.counter').data('max'));

	const addCount = number => number += 1;
	const removeCount = number => number -= 1;
	const setCount = number => $('.counter-number').text(number);

	$('.counter-plus').click(function (e) {
		e.preventDefault();
		if (count <= max - 1 && count >= 1)
			count = addCount(count);
		setCount(count);
	});

	$('.counter-minus').click(function (e) {
		e.preventDefault();
		if (count > 1)
			count = removeCount(count);
		setCount(count);
	});

})();

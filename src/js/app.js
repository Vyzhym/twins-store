$(window).on('load', function() {
	$('body').animate({
		opacity: 1
	});
});

$(function () {
	var globalWidth = $(window).width();

	$('.line__list').marquee({
		duration: 7000,
		startVisible: true,
		duplicated: true
	});

	console.log(globalWidth);

	if (globalWidth <= 420)
		$('.header__after-text').marquee({
			duration: 7000,
			startVisible: true,
			duplicated: true
		});
});

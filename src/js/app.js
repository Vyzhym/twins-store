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

	if (globalWidth <= 420)
		$('.header__after-text').marquee({
			duration: 7000,
			startVisible: true,
			duplicated: true
		});

	$(".price-range").ionRangeSlider();
});

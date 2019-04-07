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

	$('.price-range').ionRangeSlider();

	$('.size__list-item').click(function (e) {
		e.preventDefault();
		$('.size__list-item').filter(function() {
			return $(this).attr('aria-select') != false;
		}).attr('aria-select', false);
		$(this).attr('aria-select', true);
	});

	$('.color__list span').click(function (e) {
		e.preventDefault();
		let color = $(this).data('color');
		$('.color__list span').filter(function() {
			return $(this).attr('aria-select') != false;
		}).attr('aria-select', false).css('border', 'none');
		$(this).attr('aria-select', true).css('border', '1px solid ' + color);
	});
});

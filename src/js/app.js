$(function () {
	$('.line__list').marquee({
		duration: 7000,
		startVisible: true,
		duplicated: true
	});

	$('.corporate-carousel').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 5000,
	});
});

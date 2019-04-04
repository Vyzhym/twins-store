$(function () {
	$('.corporate-carousel').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 5000,
	});

	$('.card__poster-carousel-nav').slick({
		infinite      : false,
		slidesToShow  : 4,
		slidesToScroll: 1,
		focusOnSelect : true,
		arrows        : false,
		centerMode    : true,
		centerPadding : '40px',
		dots          : false,
		asNavFor      : '.card__poster-carousel',
		// responsive : [
		// 	{
		// 		breakpoint: 420,
		// 		settings: {
		// 			slidesToShow : 3,
		// 		}
		// 	}
		// ]
	});

	$('.card__poster-carousel').slick({
		infinite      : true,
		slidesToShow  : 1,
		slidesToScroll: 1,
		arrows        : false,
		fade          : true,
		asNavFor      : '.card__poster-carousel-nav',
	});
});

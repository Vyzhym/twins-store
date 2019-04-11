$(function () {
	$('.header__nav-search').click(function (e) {
		e.preventDefault();
		let container = $('.search-popup'),
			containerContent = container.children('.popup__container'),
			containerWidth = container.children('.popup__container').width();

		if(container.css('display') == 'none') {
			$(this).children().attr('src', '/img/icon/close.svg');
			container.css('display', 'flex').hide().fadeIn('fast')
			containerContent.animate({
				'right': '0'
			}, 500);
		} else {
			$(this).children().attr('src', '/img/icon/search.svg');
			if (container.has(e.target).length === 0) {
				container.fadeOut(500)
					.children('.popup__container')
					.animate({
						'right': '-' + containerWidth
					}, 500);
			}
		}
	});

	$(document).mouseup(function (e) {
		let container = $('.search-popup'),
			containerWidth = container.children('.popup__container').width();

		$('.header__nav-search').children().attr('src', '/img/icon/search.svg');

		if (container.has(e.target).length === 0) {
			container.fadeOut(500)
				.children('.popup__container')
				.animate({
					'right': '-' + containerWidth
				}, 500);
		}
	});
});

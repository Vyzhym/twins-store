$(function () {
	$('.header__cart-image').click(function (e) {
		e.preventDefault();
		let container = $('.cart-popup'),
			containerContent = container.children('.popup__container'),
			containerWidth = container.children('.popup__container').width();

		if(container.css('display') == 'none') {
			$(this).attr('src', '/img/icon/close.svg');
			container.css('display', 'flex').hide().fadeIn('fast')
			containerContent.animate({
				'right': '0'
			}, 500);
		} else {
			$(this).attr('src', '/img/icon/cart.svg');
			container.fadeOut(500)
				.children('.popup__container')
				.animate({
					'right': '-' + containerWidth
				}, 500);
		}
	});

	$(document).mouseup(function (e) {
		let container = $('.cart-popup'),
			containerWidth = container.children('.popup__container').width();

		if (container.has(e.target).length === 0) {
			$('.header__cart-image').attr('src', '/img/icon/cart.svg');
			container.fadeOut(500)
				.children('.popup__container')
				.animate({
					'right': '-' + containerWidth
				}, 500);
		}
	});
});

(function () {
	tabInit('.tab-card');

	function tabInit(element) {
		let selector = $(element),
			linkItem = selector.find('.tab-list__item'),
			contentItem = selector.find('.tab-content__item');

		$(linkItem).click(function (e) {
			e.preventDefault();

			let id = $(this).data('tab-id');

			linkItem.filter(function () {
				return $(this).data('tab-id') != id;
			}).attr('aria-active', false);

			$(this).attr('aria-active', true);

			contentItem.filter(function () {
				return $(this).data('tab-id') != id;
			}).fadeOut(300, function () {
				$(this).attr('aria-hidden', true);
			});

			contentItem.filter(function () {
				return $(this).data('tab-id') == id;
			}).delay(280)
			.fadeIn(300, function () {
				$(this).attr('aria-hidden', false);
			});
		});
	}
})();

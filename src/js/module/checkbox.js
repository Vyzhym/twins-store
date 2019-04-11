(function() {
	$('.checkbox').click(function (e) {
		if ($(this).attr('checked') == undefined)
			$(this).attr('checked', true);
		else
			$(this).attr('checked', false);
	});
})();

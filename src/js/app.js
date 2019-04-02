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

	var latlng = [50.44374, 30.51983],
    	twinsMap = L.map('twinsMap').setView(latlng, 17);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(twinsMap);
	L.marker(latlng).addTo(twinsMap);
});

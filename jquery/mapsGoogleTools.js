var directionsService;
var map;
var directionsDisplay;
var modeTransport;
var initialLocation;

function init(lat, long) {
    //window.scrollTo(0,1);
	
	console.log('start init()');
	
	var lesoptions = {
        center: new google.maps.LatLng(lat, long),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoom: 15
    }

    //La carte
	map = new google.maps.Map(document.getElementById("carteDyn"), lesoptions);
    directionsService = new google.maps.DirectionsService();

    //Itinéraire
    initDirectionDisplay();

    /*Try W3C Geolocation (Preferred) https://developers.google.com/maps/articles/geolocation?hl=FR    MANON*/
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {

            initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            //Premier calcul de la route
            calcRoute(lat, long);

        }, function () {
            handleNoGeolocation();
        });
    }
    // Browser doesn't support Geolocation
    else {
        handleNoGeolocation();
    }

    //Mode de transport par défaut
    modeTransport = google.maps.TravelMode.DRIVING;

    //Gros hack !! Pour que la map se rafraichisse après 0,5 seconde
    setTimeout(function () {
        google.maps.event.trigger(map, "resize");
    }, 500);

}

function changeTransportMode(mode,lat,long) {

    if (mode == "voiture") {
        modeTransport = google.maps.TravelMode.DRIVING;
        $('.pictovoiture').addClass('gmapvoitureOn').removeClass('gmapvoitureOff');
        $('.pictotransit').removeClass('gmaptransitOn').addClass('gmaptransitOff');
        $('.pictopieds').removeClass('gmappiedsOn').addClass('gmappiedsOff');
        $('.pictovelo').removeClass('gmapveloOn').addClass('gmapveloOff');
    }

    if (mode == "velo") {
        modeTransport = google.maps.TravelMode.BICYCLING;
        $('.pictovoiture').removeClass('gmapvoitureOn').addClass('gmapvoitureOff');
        $('.pictotransit').removeClass('gmaptransitOn').addClass('gmaptransitOff');
        $('.pictopieds').removeClass('gmappiedsOn').addClass('gmappiedsOff');
        $('.pictovelo').addClass('gmapveloOn').removeClass('gmapveloOff');
    }

    if (mode == "transit") {
        modeTransport = google.maps.TravelMode.TRANSIT;
        $('.pictovoiture').removeClass('gmapvoitureOn').addClass('gmapvoitureOff');
        $('.pictotransit').addClass('gmaptransitOn').removeClass('gmaptransitOff');
        $('.pictopieds').removeClass('gmappiedsOn').addClass('gmappiedsOff');
        $('.pictovelo').removeClass('gmapveloOn').addClass('gmapveloOff');
    }

    if (mode == "pieds") {
        modeTransport = google.maps.TravelMode.WALKING;
        $('.pictovoiture').removeClass('gmapvoitureOn').addClass('gmapvoitureOff');
        $('.pictotransit').removeClass('gmaptransitOn').addClass('gmaptransitOff');
        $('.pictopieds').addClass('gmappiedsOn').removeClass('gmappiedsOff');
        $('.pictovelo').removeClass('gmapveloOn').addClass('gmapveloOff');
    }

    calcRoute();
    return false;
}

function calcRoute(lat, long) {
console.log('calcRoute -- start');
    var start = initialLocation;
	
	console.log(initialLocation);
	
    var end = new google.maps.LatLng( long, lat);
	console.log(end);
    
	var request = {
        origin: start,
        destination: end,
        travelMode: modeTransport
    };

    //Calcul et affichage des tracés
    directionsService.route(request, function (result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            //Si on a un résultat  on l'affiche sur la carte
            directionsDisplay.setDirections(result);
        } else if (status == google.maps.DirectionsStatus.ZERO_RESULTS) {
            //Si pas de résultat on vide la carte de tous les tracés
            directionsDisplay.setMap(null);
            initDirectionDisplay();
            document.getElementById('detailParcours').innerHTML = "";
        }
    });
    return false;
	console.log('calcRoute -- end');

}

function initDirectionDisplay() {
    directionsDisplay = null;
    directionsDisplay = new google.maps.DirectionsRenderer();
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById('detailParcours'));
}

function handleNoGeolocation(errorFlag) {
    alert("Your browser doesn't support geolocation.");
    initialLocation = google.maps.LatLng(45.775356, 4.927904);
    map.setCenter(initialLocation);
    //AFFICHAGE DE L'ICONE
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(45.775356, 4.927904),
        map: map,
        title: "AToU",
        icon: "../img/mobilePictoLocalisation.png",
    });
}

$(document).ready(function (e) {

    $('.blocCache').hide();

    $('.go').click(function () {

		$('#carteDyn').remove();
		$('#detailParcours').remove();
		
		console.log($(this));
		var mythis = $(this);
		
        lat = $(this).data("lat");
		long = $(this).data("long");
		
		console.log(lat);
		console.log(long);
		
		$(this).parent().find('.blocCache').first().slideUp("slow", function () {
			console.log('before init');
			var e = $("<div></div>");
			var f = $("<div></div>");
	
			e.attr('id', 'carteDyn');
			
			e.css({'height': '500px', 'width': '98%'});
			
			f.attr('id', 'detailParcours');
			
			$(this).append(e);
			$(this).append(f);
			
            init(lat, long)
        });
        $('.go').addClass('toggleUp');
        $('.go').removeClass('toggleDown');

        if (!$(this).hasClass('accordeonActive')) {
            $('.go').removeClass('accordeonActive');
            $(this).next().slideToggle().siblings(".deroule:visible").slideUp("slow");
            $(this).addClass('accordeonActive');
            $(this).addClass('toggleDown');
            $(this).removeClass('toggleUp');
        } else {

            $('.go').removeClass('accordeonActive');
            //$(this).removeClass('accordeonActive');

            //On remet la voiture
            modeTransport = google.maps.TravelMode.DRIVING;
            $('.pictovoiture').addClass('gmapvoitureOn').removeClass('gmapvoitureOff');
            $('.pictotransit').removeClass('gmaptransitOn').addClass('gmaptransitOff');
            $('.pictopieds').removeClass('gmappiedsOn').addClass('gmappiedsOff');
            $('.pictovelo').removeClass('gmapveloOn').addClass('gmapveloOff');

            currentMap = null;
        }
        return false;
    })
})
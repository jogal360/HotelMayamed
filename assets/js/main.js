/*Archivo javascript*/

(function($) {
  "use strict"; // Start of use strict

  // jQuery for page scrolling feature - requires jQuery Easing plugin
  $('a.page-scroll').bind('click', function(event) {
  	var $anchor = $(this);
    $('html, body').stop().animate({
    	scrollTop: ($($anchor.attr('href')).offset().top - 52)
    }, 1250, 'easeInOutExpo');
    event.preventDefault();
  });

  //Para cambiar de tamaño el logo del hotel
  $(document).scroll(function() {
  	var valor = 50;
    var targetOffset = $('.navbar').offset().top -valor;
    var tar = $('.logo-hotel');
    var velocidad = 10;
    if(targetOffset >= valor) {
      $(tar).animate({
      	right: -40,
      	height: "70px",
      },velocidad);
    } else {
    	$(tar).animate({
      	right: -80,
      	height: "140px",
      },velocidad);
    }
  });

  // Para cerrar el menu al dar tap (Vista movil)
  $('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
  });
	
	// Para evitar que sombree el menu
  $(window).scroll(function() {
    $(".nav li").removeClass('active');
  });
  $(window).load(function() {
    $(".nav li").removeClass('active'); 
  });

  //Cambiar el color de imagenes SVG
  $('svg').mouseenter(function() {
    $(this).find("path, line, polyline, text, rect").attr("stroke", "#0e4c5b");
    $(this).find(".svg-fill").attr("fill", "#0e4c5b");
  });
  $('svg').mouseleave(function() {
    $(this).find("path, line, polyline, text, rect").attr("stroke", "#A8B28E");
    $(this).find(".svg-fill").attr("fill", "#A8B28E");
  });

  // Generador para el mapa del API de Google Maps
  function initMap() {
  	var location   = new google.maps.LatLng(20.481564, -97.013209);
    var mapCanvas  = document.getElementById('map');
    var mapOptions = {
    	center: location,
      zoom: 17,
      panControl: false,
      scrollwheel: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      styles: [
        {"stylers": [{ "hue": "#0097ff" }]},
        {
          "featureType": "road",
          "elementType": "labels",
          "stylers": [{"visibility": "off"}]
        },
        {
          "featureType": "road",
          "elementType": "geometry",
          "stylers": [{"lightness": 100},
          {"visibility": "simplified"}]
        }
      ] 
    }
    var map         = new google.maps.Map(mapCanvas, mapOptions);
    var markerImage = 'assets/img/ubicacion/ub.png';
    var marker      = new google.maps.Marker({
    	position: location,
      map: map,
      icon: markerImage
    });
  }
  google.maps.event.addDomListener(window, 'load', initMap);
  /*---*/

})(jQuery); // End of use strict

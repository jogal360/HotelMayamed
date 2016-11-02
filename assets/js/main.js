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

  //Creación de SVG
    //Alberca
    var s = Snap("#svg-alberca");
    var tux = Snap.load("../assets/img/servicios/svg/iconos servicios-01.svg",
      function ( loadedFragment ) {
        s.append( loadedFragment );
      } 
    );

    //Asoleadero
    var s2 = Snap("#svg-asoleadero");
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-02.svg",
      function ( loadedFragment ) {
        s2.append( loadedFragment );
      } 
    );

    //Recepcion
    var s3 = Snap("#svg-recepcion");
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-03.svg",
      function ( loadedFragment ) {
        s3.append( loadedFragment );
      } 
    );

    //A/A
    var s4 = Snap("#svg-aa");
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-10.svg",
      function ( loadedFragment ) {
        s4.append( loadedFragment );
      } 
    );

    //Restaurante
    var s5 = Snap("#svg-restaurante");
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-05.svg",
      function ( loadedFragment ) {
        s5.append( loadedFragment );
      } 
    );

    //TV
    var s6 = Snap("#svg-tv");
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-06.svg",
      function ( loadedFragment ) {
        s6.append( loadedFragment );
      } 
    );

    //WiFi
    var s7 = Snap("#svg-wifi");
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-09.svg",
      function ( loadedFragment ) {
        s7.append( loadedFragment );
      } 
    );

    //
    var s8 = Snap("#svg-ventilador");
    var g8 = s8.group();
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-11.svg",
      function ( loadedFragment ) {
        g8.append( loadedFragment );
        g8.hover( hoverovers8, hoverouts8 );
      });
    var hoverovers8 = function() { g8.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts8 = function() { g8.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //
    var s9 = Snap("#svg-estacionamiento");
    var g9 = s9.group();
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-04.svg",
      function ( loadedFragment ) {
        g9.append( loadedFragment );
        g9.hover( hoverovers9, hoverouts9 );
      });
    var hoverovers9 = function() { g9.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts9 = function() { g9.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //Agua caliente
    var s10 = Snap("#svg-agua");
    var g10 = s10.group();
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-12.svg",
      function ( loadedFragment ) {
        g10.append( loadedFragment );
        g10.hover( hoverovers10, hoverouts10 );
      });
    var hoverovers10 = function() { g10.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts10 = function() { g10.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };


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

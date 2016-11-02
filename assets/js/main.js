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
    var g = s.group();
    var tux = Snap.load("../assets/img/servicios/svg/iconos servicios-01.svg",
      function ( loadedFragment ) {
        g.append( loadedFragment );
        g.hover( hoverovers, hoverouts );
      });
    var hoverovers = function() { g.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts = function() { g.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //Asoleadero
    var s2 = Snap("#svg-asoleadero");
    var g2 = s2.group();
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-02.svg",
      function ( loadedFragment ) {
        g2.append( loadedFragment );
        g2.hover( hoverovers2, hoverouts2 );
      });
    var hoverovers2 = function() { g2.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts2 = function() { g2.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //Recepcion
    var s3 = Snap("#svg-recepcion");
    var g3 = s3.group();
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-03.svg",
      function ( loadedFragment ) {
        g3.append( loadedFragment );
        g3.hover( hoverovers3, hoverouts3 );
      });
    var hoverovers3 = function() { g3.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts3 = function() { g3.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //A/A
    var s4 = Snap("#svg-aa");
    var g4 = s4.group();
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-10.svg",
      function ( loadedFragment ) {
        g4.append( loadedFragment );
        g4.hover( hoverovers4, hoverouts4 );
      });
    var hoverovers4 = function() { g4.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts4 = function() { g4.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //Restaurante
    var s5 = Snap("#svg-restaurante");
    var g5 = s5.group();
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-05.svg",
      function ( loadedFragment ) {
        g5.append( loadedFragment );
        g5.hover( hoverovers5, hoverouts5 );
      });
    var hoverovers5 = function() { g5.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts5 = function() { g5.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //TV
    var s6 = Snap("#svg-tv");
    var g6 = s6.group();
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-06.svg",
      function ( loadedFragment ) {
        g6.append( loadedFragment );
        g6.hover( hoverovers6, hoverouts6 );
      });
    var hoverovers6 = function() { g6.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts6 = function() { g6.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //WiFi
    var s7 = Snap("#svg-wifi");
    var g7 = s7.group();
    var aso = Snap.load("../assets/img/servicios/svg/iconos servicios-09.svg",
      function ( loadedFragment ) {
        g7.append( loadedFragment );
        g7.hover( hoverovers7, hoverouts7 );
      });
    var hoverovers7 = function() { g7.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts7 = function() { g7.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

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

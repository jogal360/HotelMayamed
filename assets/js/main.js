/*Archivo javascript*/

//Atributos de Datepicker para mostrarlo en español
$.datepicker.regional['es'] = {
  closeText: 'Cerrar',
  prevText: '<Ant',
  nextText: 'Sig>',
  currentText: 'Hoy',
  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
  monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
  dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
  weekHeader: 'Sm',
  dateFormat: 'dd/mm/yy',
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);


(function($) {
  "use strict"; // Start of use strict

  //Obtencion de viewport
  var w = $(window).width();
  var h = $(window).height();
  var n = h-50;
  $('#myCarousel').css('height',n);
  $('#myCarousel').css('width',w);
  $('.img-car').css('height',n);
  $('.img-car').css('width',w);

  //Obtención de los precios
  $.ajax({
    type    : "POST",
    url     : "assets/controlador/controlador-precios.php",
    success : function(datos) {
      var json=JSON.parse(datos);
      if(json.respuesta=='bien') {
        $('#sen').html(json.habSen);
        $('#dob').html(json.habDob);
        $('#tri').html(json.habTri);
      } else {
        console.log("Error: No se pueden mostrar los precios de habitación");
      }
    },
  });

  $.validator.addMethod(
    "dateMex",
    function(value, element) {
      return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
    },
    "dd/mm/yyy"
  );

  $.validator.addMethod(
    "soloLetras",
    function(value, element) {
      return value.match(/^[a-zA-Z_áéíóúñ\s]*$/);
    },"Sólo están permitidas letras"
  );

  $('#myForm').validate({
    errorElement: 'div',
    errorClass: 'inp-error',
    rules: { 
      inputNombre:  {required: true, soloLetras: true},
      inputCorreo:  {required: true},
      inputTipoHab: {required: true},
      checkin:      {required: true, dateMex: true},
      checkout:     {required: true, dateMex: true},
      personas:     {required: true}
    },
    messages: {
      inputNombre: {required: "Llena la información"},
      inputCorreo: {required: "Llena el campo", email: "Introduce un correo válido"},
      checkin:     {required: "Llena el campo", dateMex: "Introduce una fecha válida"},
      checkout:    {required: "Llena el campo", dateMex: "Introduce una fecha válida"},
      personas:    {required: "Selecciona la cantidad de personas",}
    },
    submitHandler: function (form) {
      var dataString = $(form).serialize();
      $.ajax({
        type      : "POST",
        url       : "assets/controlador/controlador-registrar.php",
        data      : dataString,
        beforeSend: function() {
          $('.formu').prop('disabled', true);
        },
        success   : function(data) {
          $('.formu').prop('disabled', false);
          var json=JSON.parse(data);
          if(json.respuesta=='bien') {
            $('#myModal').modal('hide');
            swal({ 
              title: json.res, 
              text: "Te hemos enviado un email con los datos de tu reservación.", 
              type: "success"
            });
          } else {
            console.log("Error: "+json.error);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }
      });
    }
  });

  $('#frmContacto').validate({
    errorElement: 'div',
    errorClass: 'inp-error',
    rules: { 
      inNombre: {required: true, soloLetras: true},
      inEmail: {required: true},
      inAsunto: {required: true},
      inMensaje: {required: true}
    },
    messages: {
      inNombre: {required: "Llena la información", soloLetras: "Introduce solo letras"},
      inEmail: {required: "Llena el campo", email: "Introduce un correo válido"},
      inAsunto: {required: "Llena la información"},
      inMensaje: {required: "Llena la información"}
    },
    submitHandler: function (form) {
      var dataString = $(form).serialize();
      //alert(dataString);
      $.ajax({
        type: "POST",
        url: "assets/controlador/controlador-contacto.php",
        data: dataString,
        beforeSend: function() {
          //alert("Enviando");
          $('.inpu').prop('disabled', true);
        },
        success: function(data) {
          console.log(data);
          //alert("Recibiendo");
          $('.inpu').prop('disabled', false);
          var json=JSON.parse(data);
          if(json.respuesta=='bien') {
            $('.inpu').val('');
            swal({ 
              title: json.res, 
              text: "Gracias por tu mensaje.", 
              type: "success"
            });
          } else {
            console.log("Error: "+json.error+" | Data: "+data);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }
      });
    }
  });


  // jQuery scroll
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
    var scrollUp = $('#scrollUp');
    var velocidad = 10;
    if(targetOffset >= valor) {
      $(tar).animate({
      	right: -30,
      	height: "75px",
      },velocidad);
      $(scrollUp).css("display",'inline-block');
    } else {
    	$(tar).animate({
      	right: -70,
      	height: "140px",
      },velocidad);
      $(scrollUp).css("display",'none');
    }
  });

  //Animación
  $('#inf-uno').css('opacity', 0);
  $('#inf-dos').css('opacity', 0);
  $('#inf-tres').css('opacity', 0);
  $('#hab1').css('opacity', 0);
  $('#hab2').css('opacity', 0);
  $('#hab3').css('opacity', 0);
  $('#svg-alberca').css('opacity', 0);
  $('#svg-asoleadero').css('opacity', 0);
  $('#svg-recepcion').css('opacity', 0);
  $('#svg-aa').css('opacity', 0);
  $('#svg-restaurante').css('opacity', 0);
  $('#svg-tv').css('opacity', 0);
  $('#svg-wifi').css('opacity', 0);
  $('#svg-ventilador').css('opacity', 0);
  $('#svg-estacionamiento').css('opacity', 0);
  $('#svg-agua').css('opacity', 0);
  $('#gal1').css('opacity', 0);
  $('#gal2').css('opacity', 0);
  $('#gal3').css('opacity', 0);
  $('#contacto-uno').css('opacity', 0);
  $('#contacto-dos').css('opacity', 0);
  $('#map').css('opacity', 0);

  $(".informacion").waypoint(function() {
     $("#inf-uno").addClass('fadeInLeft');
     $("#inf-dos").addClass('fadeInRight');
     $("#inf-tres").addClass('fadeInUp');
  }, { offset: '75%'});

  $("#habitaciones").waypoint(function() {
     $("#hab1").addClass('fadeInLeft');
     $("#hab2").addClass('fadeInUp');
     $("#hab3").addClass('fadeInRight');
  }, { offset: '50%'});

  $(".servicios").waypoint(function() {
     $("#svg-alberca").addClass('fadeInLeft');
     $("#svg-asoleadero").addClass('fadeInLeft');
     $("#svg-recepcion").addClass('fadeInRight');
     $("#svg-aa").addClass('fadeInRight');
     $("#svg-restaurante").addClass('fadeInLeft');
     $("#svg-tv").addClass('fadeInLeft');
     $("#svg-wifi").addClass('fadeInRight');
     $("#svg-ventilador").addClass('fadeInRight');
     $("#svg-estacionamiento").addClass('fadeInUp');
     $("#svg-agua").addClass('fadeInUp');
  }, { offset: '60%'});

  $(".galeria").waypoint(function() {
    $('#gal1').addClass('fadeInLeft');
    $('#gal2').addClass('fadeInUp');
    $('#gal3').addClass('fadeInRight');
  }, { offset: '50%'});

  $(".contacto").waypoint(function() {
    $('#contacto-dos').addClass('fadeInLeft');
    $('#contacto-uno').addClass('fadeInRight');
  }, { offset: '60%'});

  $(".ubicacion").waypoint(function() {
    $('#map').addClass('fadeInUp');
  }, { offset: '60%'});

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
    var tux = Snap.load("assets/img/servicios/svg/servicios-01.svg",
      function ( loadedFragment ) {
        g.append( loadedFragment );
        g.hover( hoverovers, hoverouts );
      });
    var hoverovers = function() { g.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts = function() { g.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //Asoleadero
    var s2 = Snap("#svg-asoleadero");
    var g2 = s2.group();
    var aso = Snap.load("assets/img/servicios/svg/iconos servicios-02.svg",
      function ( loadedFragment ) {
        g2.append( loadedFragment );
        g2.hover( hoverovers2, hoverouts2 );
      });
    var hoverovers2 = function() { g2.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts2 = function() { g2.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //Recepcion
    var s3 = Snap("#svg-recepcion");
    var g3 = s3.group();
    var aso = Snap.load("assets/img/servicios/svg/iconos servicios-03.svg",
      function ( loadedFragment ) {
        g3.append( loadedFragment );
        g3.hover( hoverovers3, hoverouts3 );
      });
    var hoverovers3 = function() { g3.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts3 = function() { g3.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //A/A
    var s4 = Snap("#svg-aa");
    var g4 = s4.group();
    var aso = Snap.load("assets/img/servicios/svg/iconos servicios-10.svg",
      function ( loadedFragment ) {
        g4.append( loadedFragment );
        g4.hover( hoverovers4, hoverouts4 );
      });
    var hoverovers4 = function() { g4.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts4 = function() { g4.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //Restaurante
    var s5 = Snap("#svg-restaurante");
    var g5 = s5.group();
    var aso = Snap.load("assets/img/servicios/svg/iconos servicios-05.svg",
      function ( loadedFragment ) {
        g5.append( loadedFragment );
        g5.hover( hoverovers5, hoverouts5 );
      });
    var hoverovers5 = function() { g5.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts5 = function() { g5.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //TV
    var s6 = Snap("#svg-tv");
    var g6 = s6.group();
    var aso = Snap.load("assets/img/servicios/svg/iconos servicios-06.svg",
      function ( loadedFragment ) {
        g6.append( loadedFragment );
        g6.hover( hoverovers6, hoverouts6 );
      });
    var hoverovers6 = function() { g6.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts6 = function() { g6.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //WiFi
    var s7 = Snap("#svg-wifi");
    var g7 = s7.group();
    var aso = Snap.load("assets/img/servicios/svg/iconos servicios-09.svg",
      function ( loadedFragment ) {
        g7.append( loadedFragment );
        g7.hover( hoverovers7, hoverouts7 );
      });
    var hoverovers7 = function() { g7.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts7 = function() { g7.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //
    var s8 = Snap("#svg-ventilador");
    var g8 = s8.group();
    var aso = Snap.load("assets/img/servicios/svg/iconos servicios-11.svg",
      function ( loadedFragment ) {
        g8.append( loadedFragment );
        g8.hover( hoverovers8, hoverouts8 );
      });
    var hoverovers8 = function() { g8.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts8 = function() { g8.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //
    var s9 = Snap("#svg-estacionamiento");
    var g9 = s9.group();
    var aso = Snap.load("assets/img/servicios/svg/iconos servicios-04.svg",
      function ( loadedFragment ) {
        g9.append( loadedFragment );
        g9.hover( hoverovers9, hoverouts9 );
      });
    var hoverovers9 = function() { g9.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts9 = function() { g9.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };

    //Agua caliente
    var s10 = Snap("#svg-agua");
    var g10 = s10.group();
    var aso = Snap.load("assets/img/servicios/svg/iconos servicios-12.svg",
      function ( loadedFragment ) {
        g10.append( loadedFragment );
        g10.hover( hoverovers10, hoverouts10 );
      });
    var hoverovers10 = function() { g10.animate({ transform: 's2r45,50,55' }, 1000, mina.bounce ) };
    var hoverouts10 = function() { g10.animate({ transform: 's1r0,150,150' }, 1000, mina.bounce ) };
  //Ventana modal
  $('.reserva').click(function() {
    var tipo = $(this).attr("tipo");
    $('#personas')
      .find('option')
      .remove()
      .end();
    switch(tipo) {
      case 'Sencilla':
        $("<option value=''>Selecciona...</option>").appendTo("#personas");
        $("<option value='1'>1 persona</option>").appendTo("#personas");
        $("<option value='2'>2 personas</option>").appendTo("#personas");
        break;
      case 'Doble':
        $("<option value=''>Selecciona...</option>").appendTo("#personas");
        $("<option value='1'>1 persona</option>").appendTo("#personas");
        $("<option value='2'>2 personas</option>").appendTo("#personas");
        $("<option value='3'>3 personas</option>").appendTo("#personas");
        $("<option value='4'>4 personas</option>").appendTo("#personas");
        break;
      case 'Triple':
        $("<option value=''>Selecciona...</option>").appendTo("#personas");
        $("<option value='1'>1 persona</option>").appendTo("#personas");
        $("<option value='2'>2 personas</option>").appendTo("#personas");
        $("<option value='3'>3 personas</option>").appendTo("#personas");
        $("<option value='4'>4 personas</option>").appendTo("#personas");
        $("<option value='5'>5 personas</option>").appendTo("#personas");
        $("<option value='6'>6 personas</option>").appendTo("#personas");
        break;
    }
  	$('#myModal').modal('show');
    $('#inputTipoHab').val(tipo);
  });

  //Datepicker para 
  $('.datepicker').datepicker({
  	minDate: 0,
    onSelect: function(dateValue, inst) {
      $('.datepicker-salida').datepicker();
      var date2 = $(this).datepicker('getDate','+1d');
      $('.datepicker-salida').datepicker('destroy');
      date2.setDate(date2.getDate() + 1);
      $('.datepicker-salida').datepicker({
        minDate: date2,
      });
    }
  });

  //Funcion que desencadena metodos al cerrar la ventana modal
  $('#myModal').on('hidden.bs.modal', function () {
    $(this)
      .find("input,textarea,select")
      .val('')
      .find(".form-group")
      .removeClass("has-error")
      .end();
    $('.form-group').removeClass('has-error has-danger');
    $('.form-control').removeClass('inp-error');
    $(".inp-error").remove();
    $('div.error').remove();

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

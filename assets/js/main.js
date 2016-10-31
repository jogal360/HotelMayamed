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

  $.ajax({
    type: "POST",
    url: "assets/controlador/controlador-precios.php",
    success: function(datos) {
      //alert(datos);
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

  $('#myForm').validate({
    errorElement: 'div',
    rules: { 
      inputNombre: {required: true},
      inputCorreo: {required: true},
      inputTipoHab: {required: true},
      checkin: {required: true, dateMex: true},
      checkout: {required: true, dateMex: true},
      personas: {required: true}
    },
    messages: {
      inputNombre: {required: "Llena la información"},
      inputCorreo: {required: "Llena el campo", email: "Introduce un correo válido"},
      checkin: {required: "Llena el campo", dateMex: "Introduce una fecha válida"},
      checkout: {required: "Llena el campo", dateMex: "Introduce una fecha válida"},
      personas: {required: "Selecciona la cantidad de personas",}
    },
    submitHandler: function (form) {
      var dataString = $(form).serialize();
      //alert(dataString);
      $.ajax({
        type: "POST",
        url: "assets/controlador/controlador-registrar.php",
        data: dataString,
        beforeSend: function() {
          //alert("Enviando");
          $('.formu').prop('disabled', true);
        },
        success: function(data) {
          //alert("Recibido: "+data);
          var json=JSON.parse(data);
          if(json.respuesta=='bien') {
            $('#myModal').modal('hide');
            swal({ 
              title: "Registro correcto!", 
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


  // jQuery for page scrolling feature - requires jQuery Easing plugin
  $('a.page-scroll').bind('click', function(event) {
  	var $anchor = $(this);
    $('html, body').stop().animate({
    	scrollTop: ($($anchor.attr('href')).offset().top - 52)
    }, 1250, 'easeInOutExpo');
    event.preventDefault();
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

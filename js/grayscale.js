//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('.page-scroll a').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

//Google Map Skin - Get more at http://snazzymaps.com/
var myOptions = {
    zoom: 15,
    center: new google.maps.LatLng(-22.9083, -43.1964),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: true,
    styles: [{
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [{
            "color": "#000000"
        }, {
            "lightness": 17
        }]
    }, {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [{
            "color": "#000000"
        }, {
            "lightness": 20
        }]
    }, {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [{
            "color": "#000000"
        }, {
            "lightness": 17
        }]
    }, {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [{
            "color": "#000000"
        }, {
            "lightness": 29
        }, {
            "weight": 0.2
        }]
    }, {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [{
            "color": "#000000"
        }, {
            "lightness": 18
        }]
    }, {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [{
            "color": "#000000"
        }, {
            "lightness": 16
        }]
    }, {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [{
            "color": "#000000"
        }, {
            "lightness": 21
        }]
    }, {
        "elementType": "labels.text.stroke",
        "stylers": [{
            "visibility": "on"
        }, {
            "color": "#000000"
        }, {
            "lightness": 16
        }]
    }, {
        "elementType": "labels.text.fill",
        "stylers": [{
            "saturation": 36
        }, {
            "color": "#000000"
        }, {
            "lightness": 40
        }]
    }, {
        "elementType": "labels.icon",
        "stylers": [{
            "visibility": "off"
        }]
    }, {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [{
            "color": "#000000"
        }, {
            "lightness": 19
        }]
    }, {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [{
            "color": "#000000"
        }, {
            "lightness": 20
        }]
    }, {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [{
            "color": "#000000"
        }, {
            "lightness": 17
        }, {
            "weight": 1.2
        }]
    }]
};

$(document).ready(function() {
    $('#loginPass').keydown(function(event) {
        if (event.keyCode == 13) {
            this.form.submit();
            return false;
         }
    });

});

var map = new google.maps.Map(document.getElementById('map'), myOptions);

function submitForm( formName ){
    var hasError = false;
    $(formName).find(':input:not(button)').each(function(){
            var $this       = $(this);
            var valueLength = $this.val().length;
            if(valueLength == ''){
                hasError = true;
                $this.css({
                    'background-color':'#FFEDEF',
                    'box-shadow':'0 0 10px #FF0000'
                    });
                var container = $(formName).find(".scrollDiv");
                container.scrollTop(
                   $this.offset().top - container.offset().top + container.scrollTop()
                );
            }
            else
                $this.css({
                    'background-color':'#FFFFFF',
                    'box-shadow':'0 0 0px #FF0000'
                    }); 
        });
    if(!hasError){
        $(formName).submit();
    }
}

function signup(){
    var firstname = $( "#firstname" ),
      lastname = $( "#lastname"),
      email = $( "#email" ),
      password = $( "#password" ),
      allFields = $( [] ).add( firstname ).add( lastname ).add( email ).add( password ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "El " + n + " debe tener entre " +
          min + " y " + max + " letras." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }

$(".dialogForm").dialog({
        autoOpen: false,
        position: 'center' ,
        title: 'Crear Cuenta',
        draggable: false,
        width : 350,
        height : 460, 
        resizable : false,
        modal : true,
        buttons: {
        "Crear Cuenta": function() {
              var bValid = true;
              allFields.removeClass( "ui-state-error" );

              bValid = bValid && checkLength( firstname, "first name", 1, 16);
              bValid = bValid && checkLength( lastname, "last name", 1, 16);
              bValid = bValid && checkLength( email, "email", 6, 80 );
              bValid = bValid && checkLength( password, "password", 5, 16 );

              // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
              bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. brazil@gmail.com" );
              
              if ( bValid ) {
                submitForm(".signupForm");
                $( this ).dialog( "close" );
              }          
        },
        Cancelar: function() {
          updateTips("Todos los campos son obligatorios.");
          $( this ).dialog( "close" );
        }
      },
      Cerrar: function() {
        updateTips("Todos los campos son obligatorios.");
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
    $(".dialogForm").dialog("open");    
};

function login(){
    var email = $("#loginEmail");
    var pass = $("#loginPass");
    if(email.val().length == 0){
        email.addClass( "ui-state-error" );
    }else if(pass.val().length == 0){
        pass.addClass( "ui-state-error" );
    }else{
        email.removeClass( "ui-state-error" );
        pass.removeClass( "ui-state-error" );
        $(".loginForm").submit();
    }
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function submitBonus(){
    var selects = $("select.group");
    //var j =0;
    var arr = [];
    $.each(selects, function(j,s){
        arr[j] = s.options[s.selectedIndex].value;
        //j++;
    });

    var i,
    len=arr.length,
    out=[],
    obj={};

    for (i=0;i<len;i++) {
        if (obj[arr[i]] != null) {
            if (!obj[arr[i]]) {
                out.push(arr[i]);
                obj[arr[i]] = 1;
            }
        } else {
            obj[arr[i]] = 0;            
        }
    }

    if(out.length > 0){
        alert("Los Siguientes Equipos están seleccionados más de una vez: " + out);
        return;
    } 

    $('.bonoform').submit();
}
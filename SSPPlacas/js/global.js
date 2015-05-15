// JavaScript Document
//Envio notificacion de envio de correo.
$(document).ready(function () {
	
	$('.modal-trigger').leanModal();
	
    // Esta primera parte crea un loader no es necesaria
    $().ajaxStart(function () {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function () {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    // Interceptamos el evento submit
    $('#form, #fat, #fo3').submit(function () {
        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function (data) {
                // toast(message, displayLength, className, completeCallback);
                toast('Mensaje enviado, gracias!', 4000, 'rounded') // 4000 is the duration of the toast  //$('#result').html(data);
                limpiar();
                $(document).ready(function () {
                    setTimeout(function () {
                        $("#result").fadeOut(1500);
                    }, 3000);
                });

            }
        })
        return false;
    });
	function limpiar() {
		document.getElementById("icon_prefix").value = "";
		document.getElementById("icon_email").value = "";
		document.getElementById("icon_telephone").value = "";
		document.getElementById("icon_prefix2").value = "";
	}
	
	$('a.ancla').click(function (e) {
        e.preventDefault();
        $('html, body').stop().animate({ scrollTop: $($(this).attr('href')).offset().top }, 1000);
    });
	
	
	
});






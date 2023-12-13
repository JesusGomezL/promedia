(function() {

	const on = (type, el, listener) => {
		let selectEl = document.querySelector(el);
		if (selectEl) {
			selectEl.addEventListener(type, listener)
		}
	}

	on('click', '#enviar', function(e) {
		e.preventDefault();

		// Campos requeridos
		if (($('#nombre').val() == '') || ($('#email').val() == '') || ($('#comentarios').val() == '')){
			$('.alert-message').html('<p>Faltan algunos campos requeridos por completar.</p>');
			$('.alert-message').fadeIn('slow').delay(3000).fadeOut('slow');
			return;
		}

		// Política de privacidad requerida
		if (!$('#checkAcepto').is(":checked")){
			$('.alert-message').html('<p>Es preciso que acepte antes la <strong>política de privacidad</strong>.</p>');
			$('.alert-message').fadeIn('slow').delay(3000).fadeOut('slow');
			return;
		}

		// Envío Ajax
		$.post('php/registrarContacto.php', $('#f_enviar').serialize(), function(data){}, 'json')
		.done(function(msg){
			if (msg.res == 'ok'){
				$('.sent-message').html('<p>Sus datos de contacto han sido registrados correctamente. ¡Gracias!</p>');
				$('.sent-message').fadeIn('slow').delay(3000).fadeOut('slow');
			} else {
				$('.error-message').html('<p>Ha ocurrido un error y los datos no han podido ser registrados correctamente.</p>');
				$('.error-message').fadeIn('slow').delay(3000).fadeOut('slow');
			}
		})
    .fail(function(xhr, status, error) {
			console.log (error, 'err');
		});
	});

})();
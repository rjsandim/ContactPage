$(document).ready(function() { 
    
	$('#estados').change(function(event) {
		var estadoId = $(this).val();

		$.ajax({
			url: 'contact_page/contatos/buscarCidadesPeloIdDoEstado/' + estadoId,
			dataType: 'html'
		}).done(function(data) {
			$('#cidades').empty().append(data);
		});	
	});

    function showResponse(responseText, statusText, xhr, $form)  { 
        $('.loader').fadeOut('slow', function() {
            $('.sucesso').slideUp('slow', function() {
                $('.alert').slideUp('slow', function() {
                    if ($.trim(responseText) !== 'enviado') {
                        $('.alert').slideDown('slow');
                        setTimeout(function() {
                            $('.alert').slideUp('slow');
                        }, 5000);
                    } else {
                        $('.sucesso').slideDown('slow');
                        $("#contato").each(function(){
                            this.reset();
                        });
                        setTimeout(function() {
                            $('.sucesso').slideUp('slow');
                        }, 5000);
                    }
                });
            });
        });
    } 

    function showRequest(formData, jqForm, options) { 
        $('.loader').fadeIn('slow');
        return true; 
    } 

    $('.close-alert').on('click', function() {
        $('.alert').slideUp('slow');
    });

    $('.close-sucesso').on('click', function() {
        $('.sucesso').slideUp('slow');
    });

    var options = { 
        target: '#responseContato',
        success: showResponse,
        beforeSubmit: showRequest,
        timeout: 30000 
    }; 
    
    $('#contato').ajaxForm(options); 

    $('form').formValidator();

});

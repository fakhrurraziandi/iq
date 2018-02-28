
$(function(){
	var formLogin = $('#form-login');
	formLogin.on('submit', function(e){
		e.preventDefault();
		formLogin.find('.help-block').remove();
		formLogin.find('.has-error').removeClass('has-error');
		$.ajax({
			url: '/iq/login/submit',
			type: 'POST',
			data: $(this).serialize(),
			success: function(result){
				if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formLogin.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }else{
                	window.location = 'http://localhost/iq/dashboard';
                }
			}
		})
	});
});
'use strict';

/**
 *
 * SQRF Controller
 *
 */

var SQRF_form = {
	Core: {}
};

SQRF_form.Core = {
	init: function(){
		Log.log('SQRF initialized');
	},
	validar: function(){
		var error_inputs = 0;
		 $.each($('#sqrf_form').serializeArray(), function(i, field) {
		 	CustomValidation.validar($('#'+field.name));
		 	var response_input = CustomValidation.response;
		 	if(!response_input.flag){
		 		error_inputs++;
		 		CustomValidation.showError($('#'+field.name), response_input.error);
		 	}else{
		 		CustomValidation.hideError($('#'+field.name));
		 	}
		});

		if(error_inputs == 0){
			grecaptcha.execute();
		}
	},
	validar2: function(){
		var error_inputs = 0;
		 $.each($('#sqrf_form').serializeArray(), function(i, field) {
		 	CustomValidation.validar($('#'+field.name));
		 	var response_input = CustomValidation.response;
		 	if(!response_input.flag){
		 		error_inputs++;
		 		CustomValidation.showError($('#'+field.name), response_input.error);
		 	}else{
		 		CustomValidation.hideError($('#'+field.name));
		 	}
		});

		if(error_inputs == 0){
			this.submitForm();
		}
	},
	submitForm: function(){
		
		Log.log(_App.Config.api_uri+'sqrf_req');
		Ajax.service('sqrf_req', $('#sqrf_form').serialize(), SQRF_form.Core.formRequest);
	},
	formRequest: function(response){
		if(response.status){
			alert(response.content);
			$('#sqrf_form')[0].reset();
		}else{
			alert("Ha ocurrido un error al intentar tomar su solicitud, por favor comuniquese por vía teléfonica con nosotros al +57 313 895 5200 ó al e-mail info@wanderlustcolombianexperience.com");
			$('#sqrf_form')[0].reset();
		}
	}
}


_App.Core.on('ready', function () {
  SQRF_form.Core.init();

  _App.Core.elementEvent('sqrf_submit', 'click', SQRF_form.Core.validar);
});

var nlej5rntje462l5 = function(){
	SQRF_form.Core.validar2();
}

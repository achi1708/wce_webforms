var _App = {
  Config: {
    name: 'Wanderlust Colombian Experience',
    loginPage: '',
    homePage: '',
    page_uri: URL_BASE,
    api_uri: URL_BASE + 'api/v1/',
    debug: true
  },
  Core: {}
}

_App.Core = {
  start: function(){
    this.helpers();
  },
  helpers: function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  },
  loadViews: function () {
    
  },
  attachEvents: function () {
    
  },
  on: function (e, callback) {
    $(document).on(e, function () {
      Log.log('_App.Core.on: ' + e);
      callback();
    });
  },
  trigger: function (e) {
    $(document).trigger(e);
  },
  onload: function (callback) {
    $(window).on('load', function () {
      Log.log('_App.Core.onload');
      callback();
    });
  },
  elementEvent: function(elementID, event, callback) {
      $('#'+elementID).on(event, function () {
        Log.log(elementID+'.'+event);
        callback();
      });
  },
  loadComponentsApp: function(){
    
  }
};

var View = {
  loadContent: function(name){
    
  }
}

var Copy = {
  formValidate:{
    required: 'Por favor completa este campo',
    email_format: 'Ingresa una dirección de correo válida',
    number_length: 'Ingresa un número valido'
  }
};

var CustomValidation = {
  flag: true,
  error: '',
  response: {},
  validar: function(elemento){
    this.reset();

    if(elemento.attr('required') && !elemento.val()){
      this.flag = false;
      this.error = Copy.formValidate.required;
    }else if(elemento.attr('type') == 'email' && !this.checkEmail(elemento.val())){
      this.flag = false;
      this.error = Copy.formValidate.email_format;
    }else if(elemento.attr('type') == 'number'){
      var max_elemento = elemento.attr('max');

      if(max_elemento){
        if(elemento.val().length > max_elemento.length){
          this.flag = false;
          this.error = Copy.formValidate.number_length;
        }
      }
    }

    this.setResponse()
  },
  checkEmail: function(email){
    var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return reg.test(email);
  },
  reset: function(){
    this.flag = true;
    this.error = '';
    this.response = {};
  },
  setResponse: function(){
    this.response = {
      flag: this.flag,
      error: this.error
    }
  },
  showError: function(elemento, msgError){
    var $label_elem = $("label[for='"+elemento.attr('id')+"']");
    var data_label = $label_elem.attr('data-label');
    $label_elem.html(data_label+' <span class="error-label">* ('+msgError+')</span>');
  }
  ,
  hideError: function(elemento){
    var $label_elem = $("label[for='"+elemento.attr('id')+"']");
    $label_elem.html($label_elem.attr('data-label'));
  }
};

var Ajax = {
  service: function(service, data, callback, methodService, dataType, inputFiles, loaderShow){
    methodService || ( methodService = 'POST' );
    dataType || ( dataType = 'json' );
    inputFiles || ( inputFiles = false );

    if(typeof loaderShow == 'undefined'){
      loaderShow = true;
    }

    var url = _App.Config.api_uri + service;

    if (! service) { return {msg: 'You must consume a service'}; }
    if (! data) { return {msg: 'You must pass data'}; }

    if(inputFiles){
      $.ajax({
        type: methodService,
        dataType: dataType,
        url: url,
        data: data,
        contentType: false,
        processData: false,
        beforeSend: function(xhrObj){
          /*var token = sessionStorage.getItem('token') || "";
          if(token != ""){
            xhrObj.setRequestHeader("Token", token);                
          }*/

          if(loaderShow){
            Modal.loader.show();
          }
        }
      })
      .done(function (data) {
        Log.dir('Ajax ' + service + ':', data);
        Modal.loader.hide();
        callback(data);
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        Log.error('Ajax ' + service + ': ' + textStatus + ' ' + errorThrown);
        Modal.loader.hide();
      });
    }else{
      $.ajax({
        type: methodService,
        dataType: dataType,
        url: url,
        crossDomain: true,
        data: data,
        beforeSend: function(xhrObj){
          /*var token = sessionStorage.getItem('token') || "";

          if(token != ""){
            xhrObj.setRequestHeader("Token", token);                
          }*/

          if(loaderShow){
            Modal.loader.show();
          }
        }
      })
      .done(function (data) {
        Log.dir('Ajax ' + service + ':', data);
        Modal.loader.hide();
        callback(data);
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        Log.error('Ajax ' + service + ': ' + textStatus + ' ' + errorThrown);
        Modal.loader.hide();
      });
    }
  }
};

var Page = {
  is: function (page) {
    return $(page).size() > 0;
  },
  redirect: function (page) {
    var queryString = '';

    
    location.href = _App.Config.page_uri + page + queryString;
  }
};

var Modal = {
  loader: {
    show: function () { $('#modal_loader').show(); },
    hide: function () { $('#modal_loader').hide(); },
  },
  message: {
    show: function (msg) {
      $('.modal_default .msg_default').text(msg);
      $('.modal_default').show();
    },
    hide: function () {
      $('.modal_default').hide();
    }
  }
};

var Log = {
  log: function (l) {
    if (_App.Config.debug) { console.log(JSON.stringify(l)); }
  },
  /**
   * Useful for objects and ajax debugging
   */
  dir: function (tag, l) {
    if (_App.Config.debug) {
      if (! tag) {
        console.error('You must provide tag parameter.');
        return;
      }

      if (_App.Config.debug_collapsed) {
        console.groupCollapsed(tag);
      } else {
        console.group(tag);
      }

      console.table(l);
      console.warn(tag + ' Object');
      console.dir(l);
      console.groupEnd();
    }
  },
  /**
   * Useful for error messages
   */
  error: function (l) {
    console.log('debug: '+_App.Config.debug)
    //if (_App.Config.debug) { console.error(l); }
  }
};


/**
 * -----------------------------------------------------------------------------
 * [INITIALIZATION]
 * -----------------------------------------------------------------------------
 */
_App.Core.start();
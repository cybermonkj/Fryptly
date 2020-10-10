
var prosessingDialog = prosessingDialog || (function ($) {
    'use strict';

  // Creating modal dialog's DOM
  var $dialog = $(
    '<div class="modal fade" data-backdrop="static" id="myModal" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
    '<div class="modal-dialog modal-m">' +
    '<div class="modal-content modal-processing" style="position: relative;">' +
      '<div class="modal-body" style="left: 37%; top: 0%;">' +
        '<img src="'+ BASE +'/assets/images/loading.gif" style="width: 12%;">' +
      '</div>' +
    '</div></div></div>');

  return {
    
    show: function (message, options) {
      // Assigning defaults
      if (typeof options === 'undefined') {
        options = {};
      }
      if (typeof message === 'undefined') {
        message = 'Loading';
      }
      var settings = $.extend({
        dialogSize: 'm',
        progressType: '',
        onHide: null // This callback runs after the dialog was hidden
      }, options);

      // Configuring dialog
      $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
      $dialog.find('.progress-bar').attr('class', 'progress-bar');
      if (settings.progressType) {
        $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
      }
      $dialog.find('h3').text(message);
      // Adding callbacks
      if (typeof settings.onHide === 'function') {
        $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
          settings.onHide.call($dialog);
        });
      }
      // Opening dialog
      $dialog.modal();
    },
    /**
     * Closes dialog
     */
    hide: function () {
      $dialog.modal('hide');
    }
  };

})(jQuery);




// Confirm notice
function confirm_notice(_ms) {
    switch(_ms) {
      case 'deleteItem':
          return confirm(deleteItem);
          break;
      case 'deleteItems':
          return confirm(deleteItems);
          break;
      default:
          return confirm(_ms);
  }
  return confirm(_ms);
}

// Reload page
function reloadpage(_module, _url = false){
  if(!_url){
    if(_module != ''){
      setTimeout(function(){window.location = PATH +_module;},2000);
    }else{
      setTimeout(function(){location.reload()},2000);
    }
  }else{
    setTimeout(function(){window.location.href =  _module;},2000);
  }
}

// Reload page (from SMM)
function reloadPage(_url = ""){
  if(_url != ''){
    setTimeout(function(){window.location = _url;}, 4500);
  }else{
    setTimeout(function(){location.reload()}, 4500);
  }
}

function is_json(str) {
  try {
      JSON.parse(str);
  } catch (e) {
      return false;
  }
  return true;
}
// notification
function notification(_type,_message) {
  switch(_type){
      case "success":
          title = 'Success! ';
          icon = 'fa fa-check';
          backgroundColor = "#a3e1b2";
          break;

      case "error":
          title = 'Error! ';
          icon = 'fa fa-exclamation-triangle';
          backgroundColor = "#f7b8b8";
          break;

      case "default":
          title = '';
          icon ='';
          backgroundColor = "#CCD5DB";
          break;
  }
  iziToast.show({
    them:'dark',
    icon: icon,
    title: title,
    timeout: 4000,
    message: _message,
    messageColor: 'blue',
    backgroundColor: backgroundColor,
    progressBarColor: 'rgb(0, 255, 184)',
  });
}


  

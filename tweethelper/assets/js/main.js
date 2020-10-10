
function Main(){
	var self = this;
	this.init = function(){
    if($(".app-content").length > 0){
  		//call function
      self.moduleActivity();
      self.general();
      self.schedule();
      self.scheduleModule();
      self.oauth();
      self.settings();
      self.uploadSettings();
      self.twitterAccounts();
      self.twitterSearch();
      self.language();
      // new
      self.generalOption();
    }

    _url = window.location.href;
    _url = _url.split("?id=");
    if(_url.length == 2){
        $('[data-ids="'+_url[1]+'"]').trigger("click");
        $('[data-ids="'+_url[1]+'"] a').trigger("click");
    }

  };

  this.generalOption = function(){

    // callback Delete item
    $(document).on("click", ".ajaxDeleteItem", function(){
      event.preventDefault();
      if(!confirm_notice('deleteItem')){
          return;
      }
      _that       = $(this);
      _action     = _that.attr("href");
      _data       = $.param({token:token});

      $.post(_action, _data, function(_result){
          prosessingDialog.show();
          setTimeout(function () {
            if(_result.status =='success'){
                $(".tr_" + _result.ids).remove();
            }
            prosessingDialog.hide();
            notification(_result.status, _result.message);
          }, 2000);
      },'json')
    })
    
    // callback actionForm smm
    $(document).on("submit", ".actionForm", function(){
        prosessingDialog.show();
        event.preventDefault();
        _that       = $(this);
        _action     = _that.attr("action");
        _redirect   = _that.data("redirect");

        if ($("#mass_order").hasClass("active")) {
            _data = $("#mass_order").find("input[name!=mass_order]").serialize();
            _mass_order_array = [];
            _mass_orders = $("#mass_order").find("textarea[name=mass_order]").val();
            if (_mass_orders.length > 0 ) {
                _mass_orders = _mass_orders.split(/\n/);
                for (var i = 0; i < _mass_orders.length; i++) {
                    // only push this line if it contains a non whitespace character.
                    if (/\S/.test(_mass_orders[i])) {
                        _mass_order_array.push($.trim(_mass_orders[i]));
                    }
                }
            }
            _data       = _data + '&' + $.param({mass_order:_mass_order_array, token:token});
        }else{
            _data       = _that.serialize();
            _data       = _data + '&' + $.param({token:token});
        }

        $.post(_action, _data, function(_result){
            if (is_json(_result)) {
                _result = JSON.parse(_result);
                if(_result.status == 'success' && typeof _redirect != "undefined"){
                  reloadPage(_redirect);
                }
                setTimeout(function(){
                  prosessingDialog.hide();
                },2000)
                setTimeout(function () {
                  notification(_result.status, _result.message);
                }, 3000);
            }else{
                setTimeout(function(){
                  prosessingDialog.hide();
                  $("#result_notification").html(_result);
                },2000)
            }
        })
        return false;
    })
  }

  this.moduleActivity = function(){
    // load content from each account
    
    $(document).on('click','.select-account', function(){
        prosessingDialog.show();
        _that   = $(this);
        _that.siblings().removeClass('active');
        _that.addClass('active');
        _action = _that.data('callback');

        _data = $.param({token:token});
        $.post(_action,_data,function(_result){
          if(_result.length<=200){
            _result = jQuery.parseJSON(_result);
            notification(_result.status,_result.message);
          }else{
            $(".activity-content").html(_result);
            history.pushState(null, "", _action.replace("/content/","?id="));
          }
          setTimeout(function () {prosessingDialog.hide();}, 500);
        });
        return false;
    });  
      
    $(document).on('click','.ajaxLoadContent', function(){
      event.preventDefault();
      prosessingDialog.show();
      _that   = $(this);
      _action = _that.attr('href');
      _data = $.param({token:token});
      $.post(_action,_data,function(_result){
        if(_result.length <= 200){
          _result = jQuery.parseJSON(_result);
          notification(_result.status,_result.message);
        }else{

          $(".result-content").html(_result);
        }
        setTimeout(function () {prosessingDialog.hide();}, 500);
      });
      return false;
    });

    $(document).on('click','.btnDeletePackage',function(){
      event.preventDefault();
      if(confirm_notice('deleteItem')){
        _that   = $(this);
        _action = _that.attr('href');
        _data   = $.param({token:token});
        $.post(_action,_data,function(_result){
          if(_result.status =='success'){
            console.log(_result.ids);
            $("#tr_" + _result.ids).remove();
          }
          notification(_result.status,_result.message);
        },'json');
        return false;
      }
      return false;
    })


    $(document).on('click','.view-logs', function(){
        // prosessingDialog.show();
        _that   = $(this);
        _action = _that.data('callback');
        _data = $.param({token:token});
        console.log(_action);
        $.post(_action,_data,function(_result){
          if(_result.length<=200){
            _result = jQuery.parseJSON(_result);
            notification(_result.status,_result.message);
          }else{
            $(".activity-logs").html(_result);
          }
          setTimeout(function () {prosessingDialog.hide();}, 500);
        });
        return false;
    });

    
  }

  this.general = function(){
    $('#popoverData').popover();

    $('input[name="target"]').click(function () {
      _type = $(this).val();
      switch(_type) {
          case 'tag':
              $(".target-tag").removeClass('d-none');
              $(".target-username").addClass('d-none');
              break;
          case 'username':
              $(".target-tag").addClass('d-none');
              $(".target-username").removeClass('d-none');
              break;
          default:
              $(".target-tag").addClass('d-none');
              $(".target-username").addClass('d-none');
              break;
      }
    });

    $(document).on('change','.dashboard .select-account-list', function(){
      $(".dashboard .content").html('');
      _that   = $(this);
      _ids    = _that.val();
      _url    = _that.attr("data-url");
      _action = _url+"/"+_ids;
      _data   = $.param({token:token});

      $.post(_action,_data,function(_result){
        if(_result.length<=200){
          _result = jQuery.parseJSON(_result);
          notification(_result.status,_result.message);
        }else{
          $(".dashboard .content").html(_result);
        }
        setTimeout(function () {prosessingDialog.hide();}, 500);
      });

      return false;
    })
    // Delete item
    $(document).on('click','.btnActionDeleteItem',function(){
      if(confirm_notice('deleteItem')){
        _that   = $(this);
        _ids    = _that.data('ids');
        _action = _that.data('action');
        _data   = $.param({token:token, ids:_ids});
        $.post(_action,_data,function(_result){
          if(_result.status =='success'){
            $("#tr_" + _ids).remove();
          }
          notification(_result.status,_result.message);
        },'json');
        return false;
      }
      return false;
    })

    $(document).on('click','.btnActionDeleteItems',function(){
      if(confirm_notice('deleteItems')){
        prosessingDialog.show();
        _that = $(this);
        _form = _that.closest('form');
        _action = _form.attr('action');
        _ids = _form.serialize();
        _data = _ids + '&' +$.param({token:token});
        $.post(_action,_data,function(_result){
          if(_result.status =='success'){
            _data_ids = $.parseJSON(_result.ids);
            $.each(_data_ids,function(i,id){
              $("#tr_" + id).remove();
            });
          }
          setTimeout(function () {
            prosessingDialog.hide();
            notification(_result.status,_result.message);
          }, 1000);
          
        },'json');
        return false;
      }

    });


  }
  // schedule
  this.schedule = function(){
    // delete schedule Logs
    $(document).on('click','.btnDeleteSchedule',function(){
      if(confirm_notice('deleteItems')){
        prosessingDialog.show();
        _that = $(this);
        _form = _that.closest('form');
        _action = _form.attr('action');
        _ids = _form.serialize();
        _data = _ids + '&' +$.param({token:token});
        $.post(_action,_data,function(_result){
          if(_result.status =='success'){
            _data_ids = $.parseJSON(_result.ids);
            // remove html
            $.each(_data_ids,function(i,id){
              $("#tr_" + id).remove();
            });
          }
          setTimeout(function () {prosessingDialog.hide();}, 500);
          notification(_result.status,_result.message);
        },'json');
        return false;
      }

    });
  }

  this.scheduleModule = function(){
    $(document).on('click', '.btnScheduleAction', function(){
      prosessingDialog.show();
      _that     = $(this);
      _form   = _that.closest('form');
      _action = _form.attr('action');
      _callBackUrl = _form.attr('data-callBackUrl');
      _data   = _form.serialize();
      _data   = _data + '&' +$.param({token:token});
      $.post(_action,_data,function(_result){
        setTimeout(function () {prosessingDialog.hide();}, 500);
        notification(_result.status,_result.message);
      },'json');
      return false;
    }); 
  };
  // Oauth
  this.oauth = function(){
    // register
    $(document).on('click','.btnUserRegister',function(){
      prosessingDialog.show();
      _that = $(this);
      _form = _that.closest('form');
      _action = _form.attr('action');
      _data = _form.serialize();
      _data = _data + '&' +$.param({token:token});
      $.post(_action,_data,function(_result){
        
        if(_result.status == 'success'){
          setTimeout(reloadpage('twitter'),2000);
        }
        setTimeout(function () {
          prosessingDialog.hide();
          notification(_result.status,_result.message);
        }, 2000);
      },'json');
      return false;
    })

    // login
    $(document).on('click','.btnUserLogin',function(){
      _that = $(this);
      _form = _that.closest('form');
      _action = _form.attr('action');
      _data = _form.serialize();
      _data = _data + '&' +$.param({token:token});
      $.post(_action,_data,function(_result){
        notification(_result.status,_result.message);
        if(_result.status == 'success'){
          setTimeout(reloadpage('dashboard'),2000);
        }
      },'json');
      return false;
    })

    //Delete user
    $(document).on('click','.users .btnActionDeteleUser',function(){
      if(confirm_notice('deleteItem')){
        _that   = $(this);
        _ids    = _that.data('ids');
        _data   = $.param({token:token, ids:_ids});
        _action = PATH + 'users/ajax_delete_user';
        $.post(_action,_data,function(_result){
          notification(_result.status,_result.message);
          if(_result.status == 'success'){
            setTimeout(reloadpage('users'),2000);
          }
        },'json');
      }
      return false;
    })    

    //Delete all users
    $(document).on('click','.btnActionDeteleAll',function(){
      if(confirm_notice('deleteItems')){
        _that   = $(this);
        _form   =_that.closest('form');
        _action = _form.attr('action');
        _data   = _form.serialize();
        _data   = _data + '&' +$.param({token:token});
        $.post(_action,_data,function(_result){
          if(_result.status =='success'){
            _data_ids = $.parseJSON(_result.ids);
            // remove html
            $.each(_data_ids,function(i,id){
              $("#tr_" + id).remove();
            });
          }
          notification(_result.status,_result.message);
        },'json');
        return false;
      }
      return false;
    })

    // Edit,Add new User
    $(document).on('click','.user-edit .btnActionEditUser',function(){
      prosessingDialog.show();
      _that = $(this);
      _form = _that.closest('form');
      _action = _form.attr('action');
      _data = _form.serialize();
      _data = _data + '&' + $.param({token:token});
      $.post(_action,_data,function(_result){
        notification(_result.status,_result.message);
        if(_result.status == 'success'){
          setTimeout(reloadpage('users'),1000);
        }
        setTimeout(function () {prosessingDialog.hide();}, 1000);
      },'json');
      return false;
    })    

    // Update Profile
    $(document).on('click','.profile .btnActionEditProfile',function(){
      prosessingDialog.show();
      _that = $(this);
      _form = _that.closest('form');
      _action = _form.attr('action');
      _data = _form.serialize();
      _data = _data + '&' + $.param({token:token});
      $.post(_action,_data,function(_result){
        notification(_result.status,_result.message);
        if(_result.status == 'success'){
          setTimeout(reloadpage('profile'),1000);
        }
        setTimeout(function () {prosessingDialog.hide();}, 1000);
      },'json');
      return false;
    })
  };

  // settings;
  this.settings = function(){
    $(document).on('click','.settings .btnActionSaveSettings',function(){
      prosessingDialog.show();
      _that = $(this);
      _form = _that.closest('form');
      _action = _form.attr('action');
      _data = _form.serialize();
      _data = _data + '&' + $.param({token:token});
      $.post(_action,_data,function(_result){
        notification(_result.status,_result.message);
        if(_result.status == 'success'){
          setTimeout(reloadpage('settings'),2000);
        }
        setTimeout(function () {prosessingDialog.hide();}, 2000);
      },'json');
      return false;
    })
  };
  // Upload media on gallery
  this.uploadSettings = function () {
    var url = PATH + "gallery/upload_media";
    $(document).on('click','.settings_fileupload',function(){
      _that = $(this);
      _closest_div = _that.closest('div');
      $('.settings .settings_fileupload').fileupload({
          url: url,
          dataType: 'json',
          done: function (e, data) {
            if (data.result.status=="success") {
              _img_link = data.result.link;
              _closest_div.children('input').val(_img_link);
              _closest_div.siblings('div').children('a').attr('href',_img_link);
              _closest_div.siblings('div').find('img').attr('src',_img_link);
            }
          },
      });
    });
  }

  this.twitterAccounts =function(){
    // update
    $(document).on('click','.btnUpdateTwitteraccount',function(){
      prosessingDialog.show();
      _that = $(this);
      _ids = _that.data('ids');
      _action = PATH + 'twitter/ajax_update_item';
      _data   = $.param({token:token, ids:_ids});
      $.post(_action,_data,function(_result){
        notification(_result.status,_result.message);
        if(_result.status == 'success'){
          setTimeout(reloadpage('twitter'),2000);
        }
        setTimeout(function () {prosessingDialog.hide();}, 2000);
      },'json');
      return false;
    });

    // Delete
    $(document).on('click','.btnDeleteTwitteraccount',function(){
      if(confirm_notice('deleteItem')){
        _that   = $(this);
        _action = PATH + 'twitter/ajax_delete_item';
        _ids    = _that.data('ids');
        _data   = $.param({token:token, ids:_ids});
        $.post(_action,_data,function(_result){
          if(_result.status =='success'){
            $("#div_" + _result.ids).remove();
          }
          notification(_result.status,_result.message);
        },'json');
        return false;
      }
      return false;
    })

  }
  // Twitter search
  this.twitterSearch = function(){
    $(document).on('click','.search .btnActionTwitterSearch',function(){
      prosessingDialog.show();
      _that = $(this);
      _form = _that.closest('form');
      _action = _form.attr('action');
      _data = _form.serialize();
      _data = _data + '&' + $.param({token:token});
      $.post(_action,_data,function(_result){
        if(_result.length<=200){
          _result = jQuery.parseJSON(_result);
          notification(_result.status,_result.message);
        }else{
          $(".result_search").html(_result);
        }
        setTimeout(function () {prosessingDialog.hide();}, 500);
      });
      return false;
    })
  }

  // Language
  this.language = function(){
    // edit button
    $(document).on('click','.btnActionSaveLanguage',function(){
      prosessingDialog.show();
      _that = $(this);
      _form = _that.closest('form');
      _action = _form.attr('action');
      _data = _form.serialize();
      _data = _data + '&' + $.param({token:token});
      $.post(_action,_data,function(_result){
        notification(_result.status,_result.message);
        if(_result.status == 'success'){
          setTimeout(reloadpage('language'),2000);
        }
        setTimeout(function () {prosessingDialog.hide();}, 2000);
      },'json');
      return false;
    })

    // Set language;
     $(document).on('click','.actionSetLanguage',function(){
      prosessingDialog.show();
      _that   = $(this);
      _action = PATH + 'language/set_language';
      _ids    = _that.data('ids');
      _currentUrl   = _that.data('url');
      _data   = $.param({token:token, ids:_ids});
      $.post(_action,_data,function(_result){
        if (_result.status =='success') {
          setTimeout(reloadpage(_currentUrl),500);
          setTimeout(function () {prosessingDialog.hide();},2000);
        }
      },'json');
      return false;
    })
  }

};


Main= new Main();
$(function(){
    Main.init();
});




function Gallery(){
  var self = this;
  this.init = function(){
    //call function

    self.is_schedule();
    self.uploadMedia();
    self.uploadMediaPost();
    self.manageGallery();
    self.post();
  };

  this.post = function(){
    $(document).on("click",".btnPostNow",function(){
      prosessingDialog.show();
      _that   = $(this);
      _form   = _that.closest('form');
      _action = _form.attr('action');
      _data   = _form.serialize();
      _data   = _data + '&' +$.param({token:token});
      $.post(_action,_data,function(_result){
        notification(_result.status,_result.message);
        if(_result.status=='success'){
          reloadpage('schedule');
        }
        setTimeout(function () {prosessingDialog.hide();}, 500);
      },'json');
      return false;
    });
  }

  // Check is_schedule
  this.is_schedule = function(){
    $(document).on("change", ".enable_schedule", function(){
      _that = $(this);
      if(!_that.hasClass("checked")){
        $('.time_post').removeClass('d-none');
        $('.btnPostNow').addClass("d-none");
        $('.btnSchedulePost').removeClass("d-none");
        _that.addClass('checked');
      }else{
        $('.time_post').addClass('d-none');
        $('.btnPostNow').removeClass("d-none");
        $('.btnSchedulePost').addClass("d-none");
        _that.removeClass('checked');        
      }
    });

    // Check post type
    $(document).on("change","input[type=radio][name=type]",function(){
      _that = $(this);
      _type = _that.val();
      if(_type=='text'){
        $('.image-content').addClass('d-none');
      }else{
        $('.image-content').removeClass('d-none');
        if(_type =='photo'){
          $('.image-content .photo').removeClass('d-none');
          $('.image-content .video').addClass('d-none');
        };        
        if(_type =='video'){
          $('.image-content .photo').addClass('d-none');
          $('.image-content .video').removeClass('d-none');
        };
      }
    });
    
  };

  // Upload media on gallery
  this.uploadMedia = function (_id) {
    var url = PATH + "gallery/upload_media";
    $('.gallery #fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
          notification(data.result.status,data.result.message);
          if (data.result.status=="success") {
            reloadpage('gallery');
          }
        },
        progressall: function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          $('#progress .progress-bar').css(
              'width',
              progress + '%'
          );
        }

    }).prop('disabled', !$.support.fileInput)
      .parent().addClass($.support.fileInput ? undefined : 'disabled');
  }

  // Upload media on POST
  this.uploadMediaPost = function (_id) {
      var url = PATH + "gallery/upload_media";
    $('.post #fileupload').fileupload({
      url: url,
      dataType: 'json',

      done: function (e, data) {
        if(data.result.status=="success"){
          self.addFile(data.result.ids,data.result.link);
        }else{
          notification(data.result.status,data.result.message);
        }
      }

    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

  }

  // manageGallery
  this.manageGallery = function(){
    // Delete single file
    $(document).on("click",".btnDeleteItem",function(){
      if(confirm_notice('deleteItem')){
        prosessingDialog.show();
        _that = $(this);
        _ids          = _that.data('ids');
        _file_name    = _that.data('image_name');
        _data         = $.param({token:token, ids:_ids,file_name:_file_name});
        _action       = PATH + 'gallery/ajax_delete_item';
        $.post(_action,_data,function(_result){
          notification(_result.status,_result.message);
          setTimeout(function () {prosessingDialog.hide();}, 500);
          if(_result.status =='success'){
            $("#div_" + _ids).remove();
          }
        },'json');
      }
      return false;
    })

    // Delete multi file
    $(document).on("click",".delete_multi_file",function(){
      if(confirm_notice('deleteItems')){
        prosessingDialog.show();
        _that = $(this);
        _ids = "delete_all";
        _url = PATH + "gallery/ajax_delete_multi_items";
        _data = $.param({token:token, ids: _ids});
        $.post(_url,_data,function(_result){
          prosessingDialog.hide();
          if(_result.status=="success"){
            notification(_result.status,_result.message);
            reloadpage('gallery');
          }          
          if(_result.status=="error"){
            notification(_result.status,_result.message);
          }
          setTimeout(function () {prosessingDialog.hide();}, 500);
        },'json');
        return false;
      };
      return false;
    })

    // Open Gallery
    $(document).on("click",".btnOpenGallery",function(){
      $('#mainmodal').modal('show');
    });

    // View Video MP4
    $(document).on("click",".btnViewVideo",function(){
      _that = $(this);
      _media_link = _that.data('link');
      $('#mainmodal').modal('show');
      _target = $('#mainmodal .viewVideo .view')[0];
      _target.src = _media_link;
      _target.load();
      _target.play();
    });


    // Add media
    $(document).on("click",".btnAddMedia",function(){
      if($(".from-gallery").length > 0){
        $(".gallery-item-checkbox:checkbox:checked").each(function(i){
          _ids = $(this).data('ids');
          _media_link = $(this).val();
          self.addFile(_ids,_media_link);
        });
      }
    });
  }

  // Addfile function
  this.addFile = function(_ids,_media_link){
    // check mp4 or jpg
    _media_link_arr = _media_link.split(".");
    if(_media_link_arr[_media_link_arr.length-1]=="mp4"){
      $(".image-content-upload .item-list").append('<div class="item" id="'+_ids+'"><input type="hidden" name="media[]" value="'+_media_link+'"><video class="img"><source src="'+_media_link+'" type="video/mp4"> </video><button type="button" class="close" data-target="#'+_ids+'" data-dismiss="alert"><i class="fa fa-times"></i></button></div>');
    }else{
      $(".image-content-upload .item-list").append('<div class="item" id="'+_ids+'"><input type="hidden" name="media[]" value="'+_media_link+'"><img class="img" src="'+_media_link+'"><button type="button" class="close" data-target="#'+_ids+'" data-dismiss="alert"><i class="fa fa-times"></i></button></div>');
    };
  }

  // reloadpage
  this.reloadpage = function(_module){
    setTimeout(function(){window.location = PATH +_module;},3000);
  };

};


Gallery = new Gallery();
$(function(){
    Gallery.init();
});



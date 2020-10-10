  <div class="min-height-200px post">
    <form action="<?=PATH?>post/ajax_post" method="POST" class="actionForm">
    <div class="row clearfix">
      <div class="col-xl-4 col-lg-6 col-md-4 col-sm-12 mb-30 ">
        <div class="border-radius-4 box-shadow bg-white">
          <h5 class="mb-20 pl-3 pt-20"><i class="nav-icon fa fa-twitter-square"></i> <?=lang('Twitter_accounts')?></h5>
          <?php if (!empty($tw_accounts)) {
            foreach ($tw_accounts as $key => $row) {
           ?>
          <div class="account-list pl-3 pd">
            <div class="custom-control custom-checkbox mb-5">
              <input type="checkbox" class="custom-control-input" name="account_ids[]" value="<?=$row->ids?>" id="<?=$row->ids?>">
              <label class="custom-control-label" for="<?=$row->ids?>">@<?=$row->screen_name?></label>
            </div>
          </div>          
          <hr>
          <?php }}else{  ?>

          <div class="account-list empty-account text-center">
            <a href="<?=cn('twitter/oauth')?>" class="btn" data-bgcolor="#00bcf2" data-color="#ffffff"><i class="fa fa-plus"></i> <?=lang('Add_account')?></a>
          </div>
          <hr>
          <?php } ?>
        </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow">
          <h5 class="weight-500 mb-20 d-inline"><i class="nav-icon fa fa-edit"></i> <?=lang('New_Tweet')?></h5>
          <div class="btn-group btn-group-toggle float-right post-type" data-toggle="buttons">
            <label class="btn btn-outline-secondary active">
              <input type="radio" name="type" value="text" autocomplete="off" checked> <?=lang('Text')?>
            </label>
            <label class="btn btn-outline-secondary">
              <input type="radio" name="type" value="photo" autocomplete="off"> <?=lang('Photos')?>
            </label>
            <label class="btn btn-outline-secondary">
              <input type="radio" name="type" value="video" autocomplete="off"> <?=lang('Video')?>
            </label>
          </div>
          <div class="clearfix"></div>
          <hr>
            <div class="form-group">
              <textarea class="form-control" id="text-emoji" name="caption" placeholder="<?=lang('Add_a_capption')?>" rows="5"></textarea>
            </div>

            <div class="image-content d-none">
              <h6 class="mb-10 photo d-none"><?=lang('Choose_Media_Photos')?></h6>
              <h6 class="mb-10 video d-none"><?=lang('Choose_Media_Video')?></h6>
              <div class="image-content-upload">
                <div class="btn-group upload-header">
                  <a href="#" class="button-item btnOpenGallery" data-toggle="tooltip" data-placement="bottom" title="From gallery"><i class="fa fa-picture-o"></i></a>

                  <a href="javascript:void(0)" class="btn  button-item fileinput-button" data-toggle="tooltip" data-placement="bottom" title="Upload">
                    <i class="fa fa-cloud-upload"></i>
                    <!-- <span> Media</span> -->
                    <input id="fileupload" type="file" name="files[]" multiple>
                  </a>
                </div>
                <!-- Image Preview -->
                <div class="item-list">

                </div>
                <div class="clearfix"></div>
              </div>
            </div>

            <div class="form-group">
              <div class="custom-control custom-checkbox mb-5">
                <input type="checkbox" class="custom-control-input enable_schedule" id="customCheck1" name="is_schedule">
                <label class="custom-control-label" for="customCheck1"><?=lang('Schedule')?></label>
              </div>
            </div>

            <div class="form-group time_post d-none">
              <label for="example-datetime-local-input" class="col-form-label"><?=lang('Time_Post_Date_and_time')?></label>
              <input class="form-control datetimepicker" name="time_post" placeholder="<?=lang('Choose_Date_and_time')?>" type="text">
            </div>
            <div class="form-group">
              <a href="javascript:void(0)" class="btn btn-block btn-outline-primary btnPostNow btn-lg"><?=lang('Tweet_Now')?></a>
              <div class="clearfix"></div>
              <a href="javascript:void(0)" class="btn btn-block btn-outline-primary btnPostNow btnSchedulePost btn-lg d-none"><?=lang('Schedule_Tweet')?></a>
              <div class="clearfix"></div>
            </div>
        </div>
      </div>
    </div>
    </form>
  </div>
  <!-- pop-up open gallery -->
  <div class="modal fade bs-example-modal-lg" id="mainmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel"> <?=lang('Gallery')?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body from-gallery">
  
          <div class="empty <?=(!empty($gallery))?"d-none":""?>">
            <?=lang('')?>Your gallery is empty.
          </div>

          <?php if(!empty($gallery)){
            foreach ($gallery as $key => $row) {
          ?>
          
          <?php if ($row->file_ext=='jpg') {?>
          <div class="item-detail">
            <img class="img" src="<?=get_media_path($row->file_name)?>">
            <div class="custom-control custom-checkbox">
              <span class="file_type text-white"><?=$row->file_ext?></span>
              <input type="checkbox" class="custom-control-input gallery-item-checkbox checkbox" name="id[]" data-ids="<?=$row->ids?>" value="<?=get_media_path($row->file_name)?>" id="gallery_<?=$row->ids?>">
              <label class="custom-control-label" for="gallery_<?=$row->ids?>"></label>
            </div>
          </div>           
          <?php }?>
          
          <?php if ($row->file_ext=='mp4') {?>
          <div class="item-detail">
            <video class="img">
              <source src="<?=get_media_path($row->file_name)?>" type="video/mp4">
            </video>
            <div class="custom-control custom-checkbox">
              <span class="file_type text-white"><?=$row->file_ext?></span>
              <input type="checkbox" class="custom-control-input gallery-item-checkbox checkbox" name="id[]" data-ids="<?=$row->ids?>" value="<?=get_media_path($row->file_name)?>" id="gallery_<?=$row->ids?>">
              <label class="custom-control-label" for="gallery_<?=$row->ids?>"></label>
            </div>
          </div>  
          <?php }?>
          
          <?php }}?>
          <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=lang('')?>Close</button>
          <button type="button" class="btn btn-primary btnAddMedia" data-dismiss="modal"><?=lang('')?>Add media</button>
        </div>
      </div>
    </div>
  </div>


            

<div class="min-height-200px gallery">
  <form action="javascript:void(0);" method="post" enctype="multipart/form-data">
    <div class="page-header">
      <div class="row">
        <div class="col-md-12 pd-20">
          <div class="title">
            <h6 class="text-uppercase float-left"><i class="<?=$module_icon?>" aria-hidden="true"></i> <?=lang('Gallery')?></h6>
          </div>
          <div class="float-right">
              <div class="btn-group">
                <a href="javascript:void(0)"  class="btn btn-outline-secondary fileinput-button">
                    <i class="fa fa-cloud-upload"></i>
                    <input id="fileupload" type="file" name="files[]" multiple>
                </a>
                <button type="button" class="btn btn-outline-secondary delete_multi_file" data-toggle="tooltip" data-placement="bottom" title="<?=lang('Delete_all')?>"><i class="fa fa-trash-o"></i> 
                </button>
              </div>
          </div>
        </div>
      </div>
    </div>
        <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
    <br>

    <div class="gallery-wrap clearfix gallery-manager-list text-center">
        <?php if(!empty($media_data)) {
          foreach ($media_data as $key => $row) {
        ?>
        <?php if($row->file_ext=="mp4"){?>
        <div class="item-detail pd-10" id="div_<?=$row->ids?>">
          <div class="da-card box-shadow" data-toggle="tooltip" data-placement="top" title="<?=$row->file_type?>">
            <div class="da-card-photo">
              <video class="img">
                <source src="<?=get_media_path($row->file_name)?>"  type="video/mp4">
              </video>
              <input type="text" name="ids[]" hidden>
              <div class="da-overlay">
                <div class="da-social">
                  <ul class="clearfix">
                    <li><a href="#" class="btnViewVideo" data-link="<?=get_media_path($row->file_name)?>"><i class="fa fa-play-circle"></i></a></li>
                    <li><a href="javascript:void(0)" data-ids="<?=$row->ids?>" data-image_name="<?=$row->file_name?>" class="btnDeleteItem"><i class="fa fa-trash-o"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php }else{
        ?>
        <div class="item-detail pd-10" id="div_<?=$row->ids?>">
          <div class="da-card box-shadow" data-toggle="tooltip" data-placement="top" title="<?=$row->file_type?>">
            <div class="da-card-photo">
              <div class="img" style="background-image: url(<?=get_media_path($row->file_name)?>)">
              </div>
              <div class="da-overlay">
                <div class="da-social">
                  <ul class="clearfix">
                    <li><a href="<?=get_media_path($row->file_name)?>" data-fancybox="images"><i class="fa fa-picture-o"></i></a></li>
                    <li><a href="javascript:void(0)" data-ids="<?=$row->ids?>" data-image_name="<?=$row->file_name?>" class="btnDeleteItem"><i class="fa fa-trash-o"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php }}}else{ ?>
          <?=lang('No_items_found')?>
        <?php }?>
    </div>
  </form>
</div>

  <!-- pop-up view Video -->
  <div class="modal fade" id="mainmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center viewVideo">
          <div class="modal-header" style="padding: 0px!important;margin-bottom: 5px;">
            <h6 id="myLargeModalLabel">Video</h6>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <video class="view" width="450" height="300" controls autoplay> 
            <source src=""  type="video/mp4"> 
          </video>
        </div>
      </div>
    </div>
  </div>


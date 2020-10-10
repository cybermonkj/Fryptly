  <div class="min-height-200px post activity-follow-setting module-setting">
    <div class="row clearfix">
      <div class="col-xl-4 col-lg-6 col-md-4 col-sm-12 mb-30 ">
        <div class="border-radius-4 box-shadow bg-white account-list">
          <h5 class="mb-20 pl-3 pt-20"><i class="nav-icon fa fa-twitter-square"></i> <?=lang('Twitter_accounts')?></h5>
          <?php if (!empty($tw_accounts)) {
            foreach ($tw_accounts as $key => $row) {
           ?>
          <div class="item select-account" data-ids="<?=$row->ids?>" data-callback="<?=cn(segment(1).'/content/'.$row->ids)?>">
            <span> @<?=$row->screen_name?> </span>
          </div>          
          <?php }}else{  ?>

          <div class="account-list empty-account text-center">
            <a href="<?=cn('twitter/oauth')?>" class="btn" data-bgcolor="#00bcf2" data-color="#ffffff"><i class="fa fa-plus"></i> <?=lang('Add_account')?></a>
          </div>
          <hr>
          <?php } ?>
        </div>
      </div>
      <div class="col-xl-8 col-lg-6 col-md-4 col-sm-12 mb-30 activity-content">

      </div>
    </div>
  </div>


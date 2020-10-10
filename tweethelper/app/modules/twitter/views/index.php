  <?php 
    $permission = check_permission();
    if($permission->max_accounts){
  ?>

  <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="alert alert-warning" role="alert">
      <?=lang("you_have_exceeded_the_maximum_number_of_twitter_accounts_you_are_allowed_to_create_in_this_domain")?>
    </div>
  </div>

  <?php }?>

  <div class="min-height-200px twitter social_acccount">
    <div class="page-header">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title breadcrumb">
            <h6 class="text-uppercase"><i class="<?=$module_icon?>" aria-hidden="true"></i> <?=lang('Twitter_accounts')?></h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <?php 
        $permission = check_permission();
        if(!$permission->max_accounts){
      ?>
      <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="bg-white box-shadow border-radius-5 height-100-p  text-center">
          <a href="<?=cn('twitter/oauth')?>">
            <div class="da-card">
              <div class="da-card-photo" style="padding-top:35px;">
                <img class="rounded-circle mx-auto d-block" src="<?=BASE?>assets/images/plus-icon.png" style="width:75px;height:75px;" alt="">
                <div class="clearfix"></div>
                <div class="pt-20 pb-20">
                  <div> <?=lang('Add_account')?></div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <?php }?>
      <?php 
          foreach ($tw_accounts as $key => $row) {
            $info = json_decode($row->data_profile);
      ?>
      <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 mb-30" id="div_<?=$row->ids?>">
        <div class="bg-white box-shadow border-radius-5 height-100-p">
          <div class="da-card">
            <div class="da-card-photo pt-10">
              <img class="rounded-circle float-left pd-20" src="<?=$row->avatar?>" style="width:80px;height:80px" alt="">
              <h6 class="weight-500 pt-20"><?=$row->screen_name?></h6>
              <p>@<?=$row->screen_name?></p>
              <div class="clearfix"></div>
              <ul class="list-group">
                <li class="list-group-item d-flex align-items-center justify-content-between"><?=lang('Tweets')?> 
                  <span class="badge badge-primary badge-pill"><?=$info->statuses_count?></span>
                </li>
                <li class="list-group-item d-flex align-items-center justify-content-between"><?=lang('Followers')?>
                  <span class="badge badge-primary badge-pill"><?=$info->followers_count?></span>
                </li>
                <li class="list-group-item d-flex align-items-center justify-content-between"><?=lang('Followings')?>
                  <span class="badge badge-primary badge-pill"><?=$info->friends_count?></span>
                </li>
              </ul>
              <div class="da-overlay">
                <div class="da-social">
                  <ul >
                    <li><a href="<?=cn($module.'/oauth')?>"><i class="fa fa-pencil-square-o"></i></a></li>
                    <li><a href="javascript:void(0)" data-ids="<?=$row->ids?>" class="btnUpdateTwitteraccount"><i class="fi-loop"></i></a></li>
                    <li><a href="javascript:void(0)" data-ids='<?=$row->ids?>' class="btnDeleteTwitteraccount" data-id="<?=$row->ids?>"><i class="fa fa-user-times"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>


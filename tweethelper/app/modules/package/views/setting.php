<?php 
  $ids = "";
  if (isset($package->ids)) {
    $ids = $package->ids;
  }
?>
<form action="<?=cn("$module/ajax_save/$ids")?>">
<div class="pd-20">
  <div class="automation">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="small-text"><?lang("package_name")?></label>
          <input class="form-control" name="name" type="text" value="<?=(isset($package->name))?$package->name:''?>">
        </div>

        <?php 
          if(isset($package->permission)){
            $permission             = $package->permission;
            $account                = get_value($permission, "account");
            $auto_post              = get_value($permission, "auto_post");
            $auto_like              = get_value($permission, "auto_like");
            $auto_follow            = get_value($permission, "auto_follow");
            $auto_unfollow          = get_value($permission, "auto_unfollow");
            $auto_reweet            = get_value($permission, "auto_reweet");
            $auto_direct_messages   = get_value($permission, "auto_direct_messages");
            $search_tweet           = get_value($permission, "search_tweet");
          }
        ?>

        <div class="form-group">
          <label class="small-text"><?=lang('Number_of_accounts')?></label>
          <input class="form-control" name="account" value="<?=(isset($account) && $account != "" )?$account: 1?>" type="number">
        </div> 

        <?php
          if (table_exists(TRANSACTION_LOGS)) {

        ?> 
        <div class="form-group">
          <label class="small-text"><?=lang("Number_of_days")?></label>
          <input class="form-control" name="day" value="<?=(isset($package->day))?$package->day: 30 ?>" type="number">
        </div>

        <div class="form-group">
          <label class="small-text"><?=lang("Price")?> <?="(".getOption('currency_code', 'USD').")"?></label>
          <input class="form-control" name="price" value="<?=(isset($package->price))? $package->price : 20?>" type="number">
        </div>
        <?php } ?>
      </div>
      <div class="col-md-6  mt-3">
        <div class="form-group">
          <div class="custom-control custom-checkbox mb-5">
            <input type="checkbox" class="custom-control-input" <?=(isset($auto_post) && $auto_post == 1)? "checked" :""?> id="customCheck1" name="auto_post">
            <label class="custom-control-label" for="customCheck1"><?=lang("Tweet_and_Scheduled_Tweets")?></label>
          </div>
        </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox mb-5">
            <input type="checkbox" class="custom-control-input" <?=(isset($auto_like) && $auto_like == 1)? "checked" :""?> id="customCheck6" name="auto_like">
            <label class="custom-control-label" for="customCheck6"><?=lang("auto_like")?></label>
          </div>
        </div>

        <div class="form-group">
          <div class="custom-control custom-checkbox mb-5">
            <input type="checkbox" class="custom-control-input" <?=(isset($auto_follow) && $auto_follow == 1)? "checked" :""?> id="customCheck2" name="auto_follow">
            <label class="custom-control-label" for="customCheck2"><?=lang("auto_follow")?></label>
          </div>
        </div>


        <div class="form-group">
          <div class="custom-control custom-checkbox mb-5">
            <input type="checkbox" class="custom-control-input" <?=(isset($auto_unfollow) && $auto_unfollow == 1)? "checked" :""?> id="customCheck3" name="auto_unfollow">
            <label class="custom-control-label" for="customCheck3"><?=lang("auto_unfollow")?></label>
          </div>
        </div>

        <div class="form-group">
          <div class="custom-control custom-checkbox mb-5">
            <input type="checkbox" class="custom-control-input" <?=(isset($auto_reweet) && $auto_reweet == 1)? "checked" :""?> id="customCheck4" name="auto_reweet">
            <label class="custom-control-label" for="customCheck4"><?=lang("auto_reweet")?></label>
          </div>
        </div>

        <div class="form-group">
          <div class="custom-control custom-checkbox mb-5">
            <input type="checkbox" class="custom-control-input" <?=(isset($auto_direct_messages) && $auto_direct_messages == 1)? "checked" :""?> id="customCheck7" name="auto_direct_messages">
            <label class="custom-control-label" for="customCheck7"><?=lang("auto_direct_messages")?></label>
          </div>
        </div>

        <div class="form-group">
          <div class="custom-control custom-checkbox mb-5">
            <input type="checkbox" class="custom-control-input" <?=(isset($search_tweet) && $search_tweet == 1)? "checked" :""?> id="customCheck5" name="search_tweet">
            <label class="custom-control-label" for="customCheck5"><?=lang("Search_Tweets")?></label>
          </div>
        </div>

      </div>
      <hr>
      <div class="row col-md-12 form-group ml-1">
        <button type="button" class="btn btn-outline-primary btnScheduleAction"><?=lang('Save')?></button>
      </div>
    </div>
  </div>
</div>
</form>



      
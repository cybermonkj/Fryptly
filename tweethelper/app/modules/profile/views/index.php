  <div class="min-height-200px profile">
    <div class="row">
      <div class="col-md-8">
        <form action="<?=cn('profile/ajax_update_user')?>" method="POST">
          <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix mb-20">
              <div class="pull-left">
                <h5 class="text-uppercase"><i class="fa fa-address-card-o" aria-hidden="true"></i> <?=lang('My_profile')?></h5>
              </div>
            </div>
            <hr>
            <div class="row">            
              <div class="form-group col-md-6">
                <label class="weight-600"><?=lang('Username')?></label>
                <input class="form-control" name="username" type="text" value="<?=(isset($user->username))?$user->username:''?>">
                <input name="ids" type="hidden" value="<?=(isset($user->ids))?$user->ids:''?>">
              </div>

              <div class="form-group col-md-6">
                <label class="weight-600"><?=lang('expiration_date')?></label>
                <input class="form-control"  value="<?=(isset($user->expired_date))?date("d/m/Y",strtotime(convert_timezone($user->expired_date,('user')))):''?>" type="text" disabled>
              </div>

              <div class="form-group col-md-6">
                <label class="weight-600"><?=lang('Email')?></label>
                <input class="form-control" name="email" value="<?=(isset($user->email))?$user->email:''?>" type="email" >
              </div>

              <div class="form-group col-md-6">
                <label class="weight-600"><?=lang('package')?></label>
                <input class="form-control"  value="<?=(isset($user->package_name))?$user->package_name:''?>" type="text" disabled>
              </div>

              <div class="form-group col-md-6">
                <label class="weight-600"><?=lang('Password')?></label>
                <input class="form-control" name="password" value="" type="password">
              </div>
                    
              <div class="form-group col-md-6">
                <label class="weight-600"><?=lang('Number_of_accounts')?></label>
                <input class="form-control" value="<?=(isset($user->package_no_account))?$user->package_no_account:''?>" type="number" disabled>
              </div>

              <div class="form-group col-md-6">
                <label class="weight-600"><?=lang('Confirm_Password')?></label>
                <input class="form-control" name="re_password" value="" type="password">
              </div>

              <div class="form-group col-md-6">
                <label class="weight-600"><?=lang('Your_Timezone')?></label>
                <select name="timezone" class="form-control">
                  <?php if(!empty(tz_list())){
                    foreach (tz_list() as $key => $value) {
                  ?>
                  <option <?=(isset($user->timezone)&&$value['zone']==$user->timezone)?'selected':''?>  value="<?=$value['zone']?>"><?=$value['time']?></option>
                  <?php }}?>    
                </select>
              </div>
              

              <div class="form-group col-md-6">
                <label class="weight-600">Twitter Consumer Key</label>
                <input class="form-control" name="twitter_consumer_key" value="<?=(isset($user->twitter_consumer_key))?$user->twitter_consumer_key:''?>" type="twitter_consumer_key" type="text">
                <small class="text-light-orange">Note: If you don't want add Twitter Consumer Key and Sercret Key, then leave these informations fields empty!</small>
              </div>

              <div class="form-group col-md-6">
                <label class="weight-600">Twitter Secret Key</label>
                <input class="form-control" name="twitter_secret_key" value="<?=(isset($user->twitter_secret_key))?$user->twitter_secret_key:''?>" type="text">
              </div>

            </div>
            <button type="button" class="btn btn-primary btnActionEditProfile"><?=lang('Submit')?></button>
            <div class="clearfix"></div>
          </div>
        </form>
      </div>
    </div>
  </div>

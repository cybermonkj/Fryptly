  <div class="min-height-200px user-edit">
    <div class="row">
      <div class="col-md-8">
      <form action="<?=cn('users/ajax_update_user')?>" method="POST">
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
          <div class="clearfix mb-20">
            <div class="pull-left">
              <h5 class="text-uppercase"><i class="fa fa-address-card-o" aria-hidden="true"></i> <?=lang('Edit_User')?></h5>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="weight-600"><?=lang('Admin')?></label>
                <select class="form-control" name="admin">
                  <option <?=(isset($user->admin) && $user->admin==0)?'selected':''?> value="0"><?=lang('No')?></option>
                  <option <?=(isset($user->admin) && $user->admin==1)?'selected':''?> value="1"><?=lang('Yes')?></option>
                </select>
            </div>  

            <div class="form-group col-md-6">
              <label class="weight-600"><?=lang('package')?></label>
              <select name="package_id" class="form-control">
                <?php if(!empty($packages)){
                  foreach ($packages as $key => $package) {
                ?>
                <option <?=(isset($user->id) && $package->id == $user->package_id)?'selected':''?>  value="<?=$package->id?>"><?=$package->name?></option>
                <?php }}?>    
              </select>
            </div>            

            <div class="form-group col-md-6">
              <label class="weight-600"><?=lang('Username')?></label>
              <input class="form-control" name="username" type="text" value="<?=(isset($user->username))?$user->username:''?>">
              <input name="ids" type="hidden" value="<?=(isset($user->ids))?$user->ids:''?>">
            </div>

            <div class="form-group col-md-6">
              <label class="weight-600"><?=lang('expiration_date')?></label>
              <input class="form-control date-picker" name="expiration_date" placeholder="<?=lang('Choose_Date_and_time')?>" value="<?=(isset($user->expired_date))?date("d/m/Y",strtotime(convert_timezone($user->expired_date,('user')))):date("d/m/Y", strtotime(convert_timezone(NOW,('user'))))?>" type="text">
            </div>

            <div class="form-group col-md-6">
              <label class="weight-600"><?=lang('Email')?></label>
              <input class="form-control" name="email" value="<?=(isset($user->email))?$user->email:''?>" type="email" >
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
              <label class="weight-600"><?=lang('Password')?></label>
              <input class="form-control" name="password" value="" type="password">
            </div>

            <div class="form-group col-md-6">
              <label class="weight-600"><?=lang('Status')?></label>
              <div class="row">
                <div class="col-md-4">
                  <div class="custom-control custom-radio mb-5">
                    <input type="radio" id="customRadio1" name="status" <?php if(isset($user->status)&&$user->status==1) echo 'checked'?> value="1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio1"><?=lang('Active')?></label>
                  </div>
                </div>              
                <div class="col-md-4">
                  <div class="custom-control custom-radio mb-5">
                    <input type="radio" id="customRadio2" name="status" <?php if(isset($user->status)&&$user->status==0) echo 'checked'?> value="0" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio2"><?=lang('Deactive')?></label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label class="weight-600"><?=lang('Confirm_Password')?></label>
              <input class="form-control" name="re_password" value="" type="password">
            </div>
          </div>  
          <button type="button" class="btn btn-primary btnActionEditUser"><?=lang('Submit')?></button>
          <div class="clearfix"></div>
        </div>
      </form>
      </div>
    </div>
  </div>

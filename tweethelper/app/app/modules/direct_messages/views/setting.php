<?php
  $default = false; 
  if(!empty($setting->schedule)){
    $act            = json_decode($setting->schedule);
  }else{
    $default = true;
  }
?>


<form action="<?=cn(segment(1).'/ajax_save_schedule/'.$setting->ids)?>">
<div class="pd-20">
  <div class="row automation">
    <div class="form-group target-setting status">
      <h6 class="inline-block"><?=lang("activity_status")?> </h6>
      <div class="switch inline-block">
        <label class="switch">
          <input type="checkbox" name="is_schedule" <?=(isset($setting->is_schedule) && $setting->is_schedule == 5) ? 'checked':''?>  value="1" >
          <span class="slider round"></span>
        </label>
      </div>
    </div>

    <div class="target-setting">
      <span class="small-text"><?=lang("Select_what_you_want_to_do")?></span>
      <div class="form-group  pt-10">
     <!--    
        <label class="custom-control custom-radio inline-block item">
          <input type="radio" id="customRadio1" name="target" value="tag" class="custom-control-input" <?=($default || (!empty($act) && get_value($act, "target") == "tag"))?"checked":""?>>
          <label class="custom-control-label" for="customRadio1"><?=lang("hashtag")?></label>
        </label>

        <label class="custom-control custom-radio inline-block item">
          <input type="radio" id="customRadio2" name="target" value="username" class="custom-control-input" <?=(!empty($act) && get_value($act, "target") == "username")?"checked":""?>>
          <label class="custom-control-label" for="customRadio2"><?=lang("Username")?><?=lang("usernames_followers")?></label>
        </label> -->

        <label class="custom-control custom-radio inline-block item">
          <input type="radio" id="customRadio3" name="target" value="follower" class="custom-control-input" <?=(!empty($act) && get_value($act, "target") == "follower")?"checked":""?>>
          <label class="custom-control-label" for="customRadio3"><?=lang("Followers")?></label>
        </label>

        <label class="custom-control custom-radio inline-block item">
          <input type="radio" id="customRadio4" name="target" value="following" class="custom-control-input" <?=(!empty($act) && get_value($act, "target") == "following")?"checked":""?>>
          <label class="custom-control-label" for="customRadio4"><?=lang("Followings")?></label>
        </label>

      </div>
    </div>
                    
    <div class="form-group target-setting target-tag d-none <?=((!empty($act) && get_value($act, 'target') == 'tag')) ? '':'d-none'?>">
      <span class="small-text"><i class="icon-copy ion-pound"></i> <?=lang("hashtag")?></span>
      <div class="pt-10">
        <input class="target-item" type="text" name="tags" value="<?=(!empty($act) && get_value($act, "tags"))? get_value($act, "tags"):"#blackhistorymonth,#womenshistorymonth,#photography,#happybirthday,#friends,#worldwaterday,#funny"?>" data-role="tagsinput" placeholder="<?=lang("add_tags")?>">
      </div>
    </div>
    
    <div class="form-group target-setting target-username d-none <?=($default || (!empty($act) && get_value($act, 'target') == 'username'))?'':'d-none'?>">
      <span class="small-text"><i class="icon-copy ion-person"></i> <?=lang("Username")?></span>
      <div class="pt-10">
        <input class="target-item" type="text" name="usernames" value="<?=(!empty($act) && get_value($act, "usernames"))? get_value($act, "usernames"):"BarackObama,taylorswift13,ladygaga"?>" data-role="tagsinput" placeholder="<?=lang('add_usernames')?>">
      </div>
    </div>    
    
    <div class="target-setting">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="small-text"><?=lang("Messages")?></label>
            <input class="target-item" type="text" name="messages" data-role="tagsinput" value="<?=(!empty($act) && get_value($act, "messages"))? get_value($act, "messages"):"Hi {{username}}! how are you today,Hello {{username}}! Nice to meet you!, Hi {{username}}! How's it going?"?>" placeholder="<?=lang("Add_Message")?>">
            <span class="small-text"><?=lang("you_can_use_following_variables_in_the_messages_username_twitters_username")?></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="small-text"><?=lang("Speed")?></label>
            <select class="form-control" name="speed" data-style="btn-outline-info">
              <option <?=(!empty($act) && get_value($act, "speed")=="auto")?"selected":""?> value="auto"><?=lang('auto')?> <?=sprintf(lang('x_requests_per_hour'),getOption('direct_messages_speed_auto', 3))?></option>
              <option <?=(!empty($act) && get_value($act, "speed")=="slow")?"selected":""?> value="slow"><?=lang('slow')?> <?=sprintf(lang('x_requests_per_hour'),getOption('direct_messages_speed_slow', 2))?></option>
              <option <?=(!empty($act) && get_value($act, "speed")=="medium")?"selected":""?> value="medium"><?=lang('medium')?> <?=sprintf(lang('x_requests_per_hour'),getOption('direct_messages_speed_medium', 4))?></option>
              <option  <?=(!empty($act) && get_value($act, "speed")=="fast")?"selected":""?> value="fast"><?=lang('fast')?> <?=sprintf(lang('x_requests_per_hour'),getOption('direct_messages_speed_fast', 7))?></option>
            </select>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label class="small-text"><?=lang("auto_stop_after_x_requests")?></label>
            <input class="form-control stop" name="stop" value="<?=(!empty($act) && get_value($act, "stop") >= 0)? get_value($act, "stop"):"60"?>" type="number">
            <i class="small-text"><?=lang("set_to_zero_to_disable_the_limit")?></i>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="custom-control custom-checkbox mb-5">
        <input type="checkbox" class="custom-control-input enable_schedule" data-toggle="collapse" data-target="#auto-pause" id="customCheck1" name="auto_pause_daily" <?=(!empty($act) && get_value($act, "auto_pause_daily") == 1)? "checked":""?>>
        <label class="custom-control-label" for="customCheck1"><?=lang("auto_pause_every_day")?></label>
      </div>
    </div>

    <div class="target-setting form-group">
      <div id="auto-pause" class="collapse <?=(!empty($act) && get_value($act, 'auto_pause_daily') == 1)? 'show':''?>">
        <div class="row">
          <?php
            if (isset($act)) {
              $pause_daily_from       = get_value($act, 'pause_daily_from');
              $pause_daily_to         = get_value($act, 'pause_daily_to');
            }
          ?>
          <div class="col-md-3">
            <div class="form-group">
              <label class="small-text"><?=lang("from")?></label>
              <select class="form-control" name="pause_daily_from">
                <?php 
                  $daily_24h = get_24h_daily($minute = 60);
                  foreach ($daily_24h as $key => $row) {

                ?>
                <option <?=($default)?($row == '22:00')?'selected':'':(isset($pause_daily_from) && $row == $pause_daily_from)? 'selected':''?> value="<?=$row?>"><?=$row?></option>
                <?php }?>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label class="small-text"><?=lang("to")?></label>
              <select class="form-control" name="pause_daily_to">
                <?php 
                  foreach ($daily_24h as $key => $row) {
                ?>
                <option <?=($default)?($row == '9:00')?'selected':'':(isset($pause_daily_to) && $row == $pause_daily_to)? 'selected':''?> value="<?=$row?>"><?=$row?></option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12" style="padding-right: 0px; padding-left: 0px;">
      <div class="form-group ">
        <button type="button" class="btn btn-lg btn-outline-primary btn-block btnScheduleAction"><?=lang('Save')?></button>
      </div>
    </div>

    <div class="clearfix"></div>
  </div>
</div>
</form>


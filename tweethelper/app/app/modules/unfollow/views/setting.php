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
  <div class="automation">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group target-setting status">
          <h6 class="inline-block"><?=lang("activity_status")?> </h6>
          <div class="switch inline-block">
            <label class="switch">
              <input type="checkbox" name="is_schedule" <?=(isset($setting->is_schedule) && $setting->is_schedule == 5) ? 'checked':''?>  value="1" >
              <span class="slider round"></span>
            </label>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <div class="custom-control custom-checkbox mb-5">
            <input type="checkbox" class="custom-control-input" id="customCheck2" name="keep_my_followers" <?=(!empty($act) && get_value($act, "keep_my_followers") == 1)? "checked":""?>>
            <label class="custom-control-label" for="customCheck2">Don't unfollow my followers</label>
          </div>
        </div>
      </div>
    </div>

    <div class="target-setting">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="small-text"><?=lang("Speed")?></label>
            <select class="form-control" name="speed" data-style="btn-outline-info">
              <option <?=(!empty($act) && get_value($act, "speed")=="auto")?"selected":""?> value="auto"><?=lang('auto')?> <?=sprintf(lang('x_requests_per_hour'),getOption('unfollow_speed_auto', 5))?></option>
              <option <?=(!empty($act) && get_value($act, "speed")=="slow")?"selected":""?> value="slow"><?=lang('slow')?> <?=sprintf(lang('x_requests_per_hour'),getOption('unfollow_speed_slow', 3))?></option>
              <option <?=(!empty($act) && get_value($act, "speed")=="medium")?"selected":""?> value="medium"><?=lang('medium')?> <?=sprintf(lang('x_requests_per_hour'),getOption('unfollow_speed_medium', 4))?></option>
              <option  <?=(!empty($act) && get_value($act, "speed")=="fast")?"selected":""?> value="fast"><?=lang('fast')?> <?=sprintf(lang('x_requests_per_hour'),getOption('unfollow_speed_fast', 8))?></option>
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
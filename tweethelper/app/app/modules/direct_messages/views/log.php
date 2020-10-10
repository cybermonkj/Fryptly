<?php
  $counter = (!empty(get_value($account->data_logs, $account->type)))? get_value($account->data_logs, $account->type) :0;
?>
<div class="module-logs">
  <div class="text-center pd-10 ">
      <?php 
        $counter = (!empty(get_value($account->data_logs, $account->type)))? get_value($account->data_logs, $account->type) :0;
      ?>
      <?=sprintf(lang("total_x_actions"),$counter)?>
      <br>
      <?php
        if (isset($account->result) && get_value($account->result, 'error') != "") {
      ?>

      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Warming!</strong> 
        <?php
          $error_content = get_value($account->result, 'error');
          if (strlen(strstr($error_content, "You cannot send messages to this user")) > 0) {
            $error = $error_content .". It means you can also send messages to a user that is not following you, but this user is not following or has blocked you, then you will not be able to send messages to the user.";
          }else{
            $error = get_value($account->result, 'error');
          }
        ?>
        <?=$error?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <?php }else{?>
	    <span class="next-request">
	      <?php
	      if(isset($account->is_schedule) && $account->is_schedule == 5 && $account->status == 1){
	          echo sprintf(lang('next_request_will_be_sent_in_approximately_X_time'), estimated_time_arrival_string($account->schedule_time));
	        }
	      ?>
	    </span>
      <?php }?>
	  </div>
    <div class="row clearfix ">
      <?php
        if (!empty($logs)) {
          foreach ($logs as $key => $row) {
      ?>
      <div class="col-md-6 pd-10">
        <div class="item  border-radius-4 pd-20">
          <a href="https://twitter.com/<?=get_value($row->data,'screen_name')?>/status/<?=get_value($row->data,'id_post')?>" target="_blank">
            <img class="img-account" src="<?=get_value($row->data,'profile_image_url')?>" alt="">
            
            <div class="info">
              <div class="name">@<?=get_value($row->data,'screen_name')?></div>
              <div class="action"><?=module_type_lang($row->type)?></div>
              <div class="time"><?=convert_timezone(get_timezone_system($row->created),'user')?></div>
            </div>
          </a>
        </div>
      </div>     
      <?php }}else{ ?>
        <div class="empty_data text-center col-md-12">
          <img src="<?=BASE?>/assets/images/empty_state.jpg" alt="">
        </div>        
      <?php }?>
    </div>
    <div class="text-center note-logs col-md-12">
      <div class="text-center">
        <?php if(!empty($logs) && count($logs) >= 3){?>
          <div class="action-number">
            <?=lang("recent_actions_will_be_displayed_in_40_actions")?>
          </div>
        <?php }?>
        <div class="note"><i><?=sprintf(lang('note_logs_will_be_save_in_approximately_x_days'), getOption('default_save_logs', 5))?></i></div>
      </div>
    </div>
  </div>

  
  <div class="min-height-200px dashboard">
  	
	<div class="page-header">
      <div class="row">
        <div class="col-xs-3 col-sm-3">
          <div class="form-group">
              <span style="opacity: 0.6;"><?=lang("Select_account")?></span>
              <select name="account-list" class="form-control select-account-list" style="border-radius: 5px;" data-url="<?=cn("dashboard/stats")?>">
                <option value="859637fd"><?=lang('All')?></option>
                <?php 
                if(!empty($accounts)){
                	foreach ($accounts as $key => $row) {
                ?>
                <option value="<?=$row->ids?>"><?=$row->screen_name?></option>
                <?php }}?>
              </select>
            </div>
        </div>
      </div>
    </div>
	<div class="content">
		<?php $this->load->view('content', $data_logs);?>
	</div>
  </div>


  
  
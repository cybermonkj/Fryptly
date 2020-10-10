  
  <div class="pre-loader"></div>
  <div class="header clearfix">
    <div class="header-right">
      <div class="menu-icon m-l-10">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="user-info-dropdown mobile-layout">
        <div class="dropdown">
          <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <span class="user-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
            <span class="user-name"><?=getField('username',USERS,session('uid'))?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">

            <a class="dropdown-item" href="<?=cn('profile')?>"><i class="fa fa-user-md" aria-hidden="true"></i> <?=lang('Profile')?></a>
            <a class="dropdown-item" href="<?=cn('users/logout')?>"><i class="fa fa-sign-out" aria-hidden="true"></i> <?=lang('Log_out')?></a>
          </div>
        </div>
      </div>
      <div class="user-info-dropdown">

        <div class="dropdown">
          <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <span class="label label-default"><span class="flag-icon flag-icon-<?=strtolower($langCurrent->country_code)?>"></span> <span class="text-uppercase"><?=$langCurrent->code?></span></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" >
            <?php 
              if (!empty($languages)) {
                 foreach ($languages as $key => $row) {
            ?>
            <a class="dropdown-item actionSetLanguage" data-ids="<?=$row->ids?>" data-url="<?=$this->uri->uri_string()?>" style="padding-left: 15px;"><i class="flag-icon flag-icon-<?=strtolower($row->country_code)?>" aria-hidden="true"></i>  <?=language_codes($row->code)?>
            </a>
            <?php }}?>
          </div>
        </div>

      </div>
      <?php
        if (table_exists(TRANSACTION_LOGS)) {
      ?>
      <div class="user-notification upgrade-button">
        <a href="<?=cn("upgrade")?>" class="btn btn-outline-primary"><?=lang("Upgrade")?></a>
      </div>
      <?php }?>
    </div>
  </div>
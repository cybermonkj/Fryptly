  <div class="left-side-bar">
    <div class="brand-logo">
      <a href="<?=cn('')?>">
        <img src="<?=getOption("website_brand_logo", BASE.'assets/images/logo-white.png')?>" alt="">
      </a>
    </div>
    <div class="menu-block ">
      <div class="sidebar-menu customscroll">
        <ul id="accordion-menu">
          <li>
            <a href="<?=cn('dashboard')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='dashboard')?'active':'';?>">
              <span class="fa fa-home"></span><span class="mtext"><?=lang('Dashboard')?></span>
            </a>
          </li>
          <?php
            $permission = check_permission();
            if($permission->expired_date){
          ?>
          <?php 
            if($permission->post){
          ?>
          <li>
            <a href="<?=cn('post')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='post')?'active':'';?>">
              <span class="fa fa-plus-circle"></span><span class="mtext"><?=lang('Add_new_tweet')?></span>
            </a>
          </li>
          <?php }?>

          
          <li>
            <a href="<?=cn('schedule')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='schedule')?'active':'';?>">
              <span class="fa fa-calendar-o"></span><span class="mtext"><?=lang('Scheduled_tweet')?></span>
            </a>
          </li>

          <?php 
            if($permission->follow){
          ?>

          <li>
            <a href="<?=cn('follow')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='follow')?'active':'';?>">
              <span class="fa fa-user-plus"></span><span class="mtext"><?=lang('auto_follow')?></span>
            </a>
          </li>
          <?php }?>
          <?php 
            if($permission->unfollow){
          ?>
          <li>
            <a href="<?=cn('unfollow')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='unfollow')?'active':'';?>">
              <span class="fa fa-user-times"></span><span class="mtext"><?=lang('auto_unfollow')?></span>
            </a>
          </li>
          <?php }?>
          <?php 
            if($permission->reweet){
          ?>
          <li>
            <a href="<?=cn('reweet')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='reweet')?'active':'';?>">
              <span class="fa fa-retweet"></span><span class="mtext"><?=lang('auto_reweet')?></span>
            </a>
          </li>
          <?php }?>
          <?php 
            if($permission->like){
          ?>
          <li>
            <a href="<?=cn('like')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='like')?'active':'';?>">
              <span class="fa fa-heart-o"></span><span class="mtext"><?=lang('auto_like')?></span>
            </a>
          </li>
          <?php }?>
          <?php 
            if($permission->direct_messages){
          ?>
          <li>
            <a href="<?=cn('direct_messages')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='direct_messages')?'active':'';?>">
              <span class="fa fa-paper-plane-o"></span><span class="mtext"><?=lang("auto_direct_messages")?></span>
            </a>
          </li>
          <?php }?>
          <?php 
            if($permission->search){
          ?>
          <li>
            <a href="<?=cn('search')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='search')?'active':'';?>">
              <span class="fa fa-search"></span><span class="mtext"><?=lang('Search_Tweets')?> </span>
            </a>
          </li>
          <?php }?>
          <li>
            <a href="<?=cn('gallery')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='gallery')?'active':'';?>">
              <span class="fa fa-folder-open-o"></span><span class="mtext"><?=lang('Gallery')?></span>
            </a>
          </li>

          <?php }?>
          <li>
            <a href="<?=cn('twitter')?>" class="dropdown-toggle no-arrow <?=(segment(1)=='twitter')?'active':'';?>">
              <span class="fa fa-twitter"></span><span class="mtext"><?=lang('Twitter_accounts')?></span>
            </a>
          </li>
          
          <?php if(get_Role()){?>

          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle" data-option="off">
              <span class="fa fa-user"></span><span class="mtext"><?=lang('admin_area')?></span>
            </a>
            <ul class="submenu">
              <li><a class="<?=(segment(1)=='package')?'active':'';?>" href="<?=cn('package')?>"><?=lang('package')?></a></li>
              <?php
                if (table_exists(TRANSACTION_LOGS)) {
              ?>
              <li><a class="<?=(segment(1)=='transaction')?'active':'';?>" href="<?=cn('transaction')?>"><?=lang("Transaction_logs")?></a></li>
              <?php }?>
              <li><a class="<?=(segment(1)=='settings')?'active':'';?>" href="<?=cn('settings')?>"><?=lang('Settings')?></a></li>
              <li><a class="<?=(segment(1)=='users')?'active':'';?>" href="<?=cn('users')?>"><?=lang('Users')?></a></li>              
              <li><a class="<?=(segment(1)=='language')?'active':'';?>" href="<?=cn('language')?>"><?=lang('Language')?></a></li>

              <li><a href="http://amazcode.ooo"><?=('AMAZCODE')?></a></li>
            </ul>
          </li>

          <?php }?>
        </ul>
      </div>
    </div>
    <div class="sidebar-footter">
      <a href="javascript:void(0);">&copy;<?=lang('2018_Tweetpost')?> V2.4</a>
    </div>
  </div>

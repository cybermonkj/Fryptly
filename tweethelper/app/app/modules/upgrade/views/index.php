<div class="min-height-200px pricing-table">
  <div class="row clearfix justify-content-md-center">
    
    <?php 
      if (!empty($packages)) {
        foreach ($packages as $key => $row) {
    ?>
    <div class="col-md-3 col-sm-12 item">
      <div class="card mb-30">
        <div class="card-body text-center">
          <div class="price-header">
            <div class="price">
                <?=currency_format($row->price)?>
                <div class="expired-date"><?=getOption("currency_code")?>/<?=$row->day?> <?=lang("Days")?></div>
            </div>
            <div class="card-title price-name">
              <?=$row->name?>
            </div>
          </div>
          <?php 
          if(isset($row->permission)){
            $permission    = $row->permission;
            $account       = get_value($permission, "account");
            $auto_post     = get_value($permission, "auto_post");
            $auto_like     = get_value($permission, "auto_like");
            $auto_follow   = get_value($permission, "auto_follow");
            $auto_unfollow = get_value($permission, "auto_unfollow");
            $auto_reweet   = get_value($permission, "auto_reweet");
            $auto_direct_messages   = get_value($permission, "auto_direct_messages");
            $search_tweet  = get_value($permission, "search_tweet");
          }
        ?>
          <ul class="list-group list-group-flush weight-500 mb-20 features">
            <li class="list-group-item"><?=sprintf(lang('up_to_X_account'), $account)?> </li>

            <li class="list-group-item <?=($auto_post)? '': 'limited'?>"><i class="<?=($auto_post)? 'fa fa-check text-blue': 'fa fa-times'?>"> </i> <?=lang("Tweet_and_Scheduled_Tweets")?></li>
            <li class="list-group-item <?=($auto_follow)? '': 'limited'?>"><i class="<?=($auto_follow)? 'fa fa-check text-blue': 'fa fa-times'?>"> </i> <?=lang("auto_follow")?></li>
            <li class="list-group-item <?=($auto_unfollow)? '': 'limited'?>"><i class="<?=($auto_unfollow)? 'fa fa-check text-blue': 'fa fa-times'?>"> </i> <?=lang("auto_unfollow")?></li>
            <li class="list-group-item <?=($auto_like)? '': 'limited'?>"><i class="<?=($auto_like)? 'fa fa-check text-blue': 'fa fa-times'?>"> </i> <?=lang("auto_like")?></li>
            <li class="list-group-item <?=($auto_reweet)? '': 'limited'?>"><i class="<?=($auto_reweet)? 'fa fa-check text-blue': 'fa fa-times'?>"> </i> <?=lang("auto_reweet")?></li>            
            <li class="list-group-item <?=($auto_direct_messages)? '': 'limited'?>"><i class="<?=($auto_direct_messages)? 'fa fa-check text-blue': 'fa fa-times'?>"> </i> <?=lang("auto_direct_messages")?></li>
            <li class="list-group-item <?=($search_tweet)? '': 'limited'?>"><i class="<?=($search_tweet)? 'fa fa-check text-blue': 'fa fa-times'?>"> </i> <?=lang("Search_Tweets")?></li>
            <li class="list-group-item"><i class="fa fa-check text-blue"> </i> <?=lang("Spintax_support")?></li>
            <li class="list-group-item"><i class="fa fa-check text-blue"> </i> <?=lang("Upload_Media")?></li>
          </ul>
          <a href="<?=cn("upgrade/review/".$row->ids)?>" class="btn btn-primary weight-500"><?=lang("Get_it_now")?></a>
        </div>
      </div>
    </div>    
    <?php }}?>

  </div>
</div>
  <div class="min-height-200px settings">
    <div class="row">
      <div class="col-md-12">
        <form action="<?=cn('settings/ajax_update')?>" method="POST">
          <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix mb-10">
              <div class="pull-left">
                <h5 class="text-uppercase"><i class="<?=$module_icon?>" aria-hidden="true"></i> <?=lang('Settings')?></h5>
              </div>
            </div>

            <div class="tab">
              <ul class="nav nav-pills" role="tablist">

                <li class="nav-item">
                  <a class="nav-link active text-blue" data-toggle="tab" href="#purchase_code" role="tab" aria-selected="false"><i class="fa fa-key" aria-hidden="true"></i> <?=lang("purchase_code")?></a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-blue" data-toggle="tab" href="#general" role="tab" aria-selected="true"><i class="fa fa-align-justify" aria-hidden="true"></i> <?=lang('General')?></a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-blue" data-toggle="tab" href="#default_setting" role="tab" aria-selected="true"><i class="fa fa-cog" aria-hidden="true"></i> <?=lang("default_settings")?></a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-blue" data-toggle="tab" href="#twitter_app" role="tab" aria-selected="false"><i class="fa fa-twitter" aria-hidden="true"></i> <?=lang('Twitter_API_key')?></a>
                </li>
                
                <?php
                  if (table_exists(TRANSACTION_LOGS)) {
                ?>
                <li class="nav-item">
                  <a class="nav-link text-blue" data-toggle="tab" href="#payment" role="tab" aria-selected="false"><i class="fa fa-paypal" aria-hidden="true"></i> <?=lang("Payment")?></a>
                </li>
                <?php }?>

              </ul>
              <hr>
              <div class="tab-content">
                <!-- Purchase code -->
                <div class="tab-pane fade show active " id="purchase_code" role="tabpanel">
                  <div class="pd-10">
                    <div class="form-group">
                      <label class="weight-500"> <?=lang("purchase_code")?></label>
                      <input class="form-control" name="purchase_code" value="<?=getOption('purchase_code','')?>" type="password" >
                    </div>

                    <?php 
                      $error = get('error');
                      if (isset($error) && !empty($error)) {
                        echo "<h5 style='color:red;'>".base64_decode($error)."</h5 style='color:red;'>";
                      }
                    ?>
                  </div>
                </div>
                <!-- General -->
                <div class="tab-pane fade general" id="general" role="tabpanel">
                  <div class="pd-10">
                    <div class="form-group">
                      <label class="weight-500"><?=lang('Website_title')?></label>
                      <input class="form-control" name="website_title" value="<?=getOption('website_title','')?>" type="text" >
                    </div>

                    <div class="form-group">
                      <label class="weight-500"><?=lang('Website_description')?></label>
                      <input class="form-control" name="website_description" value="<?=getOption('website_description','')?>" type="text">
                    </div>

                    <div class="form-group">
                      <label class="weight-500"><?=lang('Website_keykords')?></label>
                      <input class="form-control" name="website_keyword" value="<?=getOption('website_keyword','')?>" type="text" >
                    </div>

                    <div class="form-group">
                      <label class="weight-500"><?=lang('Website_Favicon')?></label>
                      <div class="img-detail">
                        <a href="<?=getOption('website_favicon','')?>" target="_blank" title="view"><img style="max-width: 40px" src="<?=getOption('website_favicon','')?>"></a>
                      </div>
                      <div class="input-group">
                        <input name="website_favicon" type="text" class="form-control" value="<?=getOption('website_favicon','')?>">
                        <span class="input-group-btn">
                            <a href="javascript:void(0)" class="btn  button-item fileinput-button" style="border-radius: 0px; color: white; background: #3e99ff; padding: 13px 16px; " data-toggle="tooltip" data-placement="bottom" title="Upload">
                              <i class="fa fa-folder-open"></i>
                              <input class="settings_fileupload" type="file" name="files[]" multiple>
                            </a>
                        </span>
                      </div>
                    </div>


                    <div class="form-group">
                      <label class="weight-500"><?=lang('Website_brand_logo')?></label>
                      <div class="img-detail">
                        <a href="<?=getOption('website_brand_logo','')?>" target="_blank" title="view"><img src="<?=getOption('website_brand_logo','')?>"></a>
                      </div>
                      <div class="input-group">
                        <input name="website_brand_logo" type="text" class="form-control" value="<?=getOption('website_brand_logo','')?>">
                        <span class="input-group-btn">
                            <a href="javascript:void(0)" class="btn  button-item fileinput-button" style="border-radius: 0px; color: white; background: #3e99ff; padding: 13px 16px;" data-toggle="tooltip" data-placement="bottom" title="Upload">
                              <i class="fa fa-folder-open"></i>
                              <input class="settings_fileupload" id="Website_logo" type="file" name="files[]" multiple>
                            </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Default Setting -->
                <div class="tab-pane fade" id="default_setting" role="tabpanel">
                  <div class="item">
                    <h5 class="text-blue mb-3"><i class="fa fa-link"></i> <?=lang("history_logs")?></h5>
                    <label class="small-text"><?=lang("clear_the_job_history_log_affer_x_days")?></label>
                    <div class="row">
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <select class="form-control" name="default_save_logs">
                            <?php
                              for ($i=1; $i <= 30; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('default_save_logs', 5)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="item">
                    <h5 class="text-blue mb-3"><i class="fa fa-link"></i> <?=lang("default_speed")?></h5>
                    <label class="pb-10"><?=lang("follow_speed_requests_hour")?></label>
                    <div class="row">
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('auto')?></label>
                          <select class="form-control" name="follow_speed_auto">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('follow_speed_auto', 5)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('slow')?></label>
                          <select class="form-control" name="follow_speed_slow">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('follow_speed_slow', 3)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('medium')?></label>
                          <select class="form-control" name="follow_speed_medium">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('follow_speed_medium', 4)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('fast')?></label>
                          <select class="form-control" name="follow_speed_fast">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('follow_speed_fast', 8)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <label class="pb-10"><?=lang("unfollow_speed_requests_hour")?></label>
                    <div class="row">
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('auto')?></label>
                          <select class="form-control" name="unfollow_speed_auto">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('unfollow_speed_auto', 5)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('slow')?></label>
                          <select class="form-control" name="unfollow_speed_slow">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('unfollow_speed_slow', 3)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('medium')?></label>
                          <select class="form-control" name="unfollow_speed_medium">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('unfollow_speed_medium', 4)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('fast')?></label>
                          <select class="form-control" name="unfollow_speed_fast">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('unfollow_speed_fast', 8)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <label class="pb-10"><?=lang("like_speed_requests_hour")?></label>
                    <div class="row">
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('auto')?></label>
                          <select class="form-control" name="like_speed_auto">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('like_speed_auto', 5)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('slow')?></label>
                          <select class="form-control" name="like_speed_slow">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('like_speed_slow', 3)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('medium')?></label>
                          <select class="form-control" name="like_speed_medium">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('like_speed_medium', 4)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('fast')?></label>
                          <select class="form-control" name="like_speed_fast">
                            <?php
                              for ($i=1; $i <= 20; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('like_speed_fast', 8)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <label class="pb-10"><?=lang("reweet_speed_requests_day")?></label>
                    <div class="row">
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('auto')?></label>
                          <select class="form-control" name="reweet_speed_auto">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('reweet_speed_auto', 2)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('slow')?></label>
                          <select class="form-control" name="reweet_speed_slow">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('reweet_speed_slow', 1)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('medium')?></label>
                          <select class="form-control" name="reweet_speed_medium">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('reweet_speed_medium', 2)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('fast')?></label>
                          <select class="form-control" name="reweet_speed_fast">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('reweet_speed_fast', 3)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <label class="pb-10"><?=lang("reweet_speed_requests_day")?></label>
                    <div class="row">
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('auto')?></label>
                          <select class="form-control" name="reweet_speed_auto">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('reweet_speed_auto', 2)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('slow')?></label>
                          <select class="form-control" name="reweet_speed_slow">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('reweet_speed_slow', 1)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('medium')?></label>
                          <select class="form-control" name="reweet_speed_medium">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('reweet_speed_medium', 2)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('fast')?></label>
                          <select class="form-control" name="reweet_speed_fast">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('reweet_speed_fast', 3)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <label class="pb-10"><?=lang("direct_messages_speed_requests_hour")?></label>
                    <div class="row">
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('auto')?></label>
                          <select class="form-control" name="direct_messages_speed_auto">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('direct_messages_speed_auto', 2)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('slow')?></label>
                          <select class="form-control" name="direct_messages_speed_slow">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('direct_messages_speed_slow', 1)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('medium')?></label>
                          <select class="form-control" name="direct_messages_speed_medium">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('direct_messages_speed_medium', 2)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>                      
                      <div class="ol-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <div class="form-group">
                          <label class="small-text"><?=lang('fast')?></label>
                          <select class="form-control" name="direct_messages_speed_fast">
                            <?php
                              for ($i=1; $i <= 10; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=getOption('direct_messages_speed_fast', 3)==$i?"selected":""?>><?=$i?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-8">
                    <p class="font-14 pt-10 text-light-orange"><strong><?=lang('Note')?></strong> <?=lang("to_avoid_being_rate_limited_requests_from_twitter_api_recommend_you_should_set_up_in_the_normal_speed_dont_use_auto_module_in_the_high_speed_and_dont_use_this_script_for_spamming")?></p>
                  </div>
                </div>
                <!-- Twitter API key -->
                <div class="tab-pane fade" id="twitter_app" role="tabpanel">
                  <div class="pd-10">
                    <div class="form-group">
                      <label class="weight-500"><?=lang('Consumer_key')?></label>
                      <input class="form-control" name="twitter_consumer_key" value="<?=getOption('twitter_consumer_key','')?>" type="text" >
                    </div>
                    
                    <div class="form-group">
                      <label class="weight-500"><?=lang('Secret_key')?></label>
                      <input class="form-control" name="twitter_secret_key" value="<?=getOption('twitter_secret_key','')?>" type="text" >
                    </div>
                  </div>
                </div> 
               <!-- Payment -->
                <div class="tab-pane fade" id="payment" role="tabpanel">
                  <div class="pd-10">
                    <h5 class="text-blue mb-3"><i class="fa fa-link"></i> <?=lang("currency_setting")?></h5>
                    
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label"><?=lang("currency_code")?></label>
                          <small><?=lang("the_paypal_payments_only_supports_these_currencies")?></small>
                          <select  name="currency_code" class="form-control square">
                            <?php 
                              $currency_codes = currency_codes();
                              if(!empty($currency_codes)){
                                foreach ($currency_codes as $key => $row) {
                            ?>
                            <option value="<?=$key?>" <?=(getOption("currency_code", "USD") == $key)? 'selected': ''?>> <?=$key." - ".$row?></option>
                            <?php }}else{?>
                            <option value="USD" selected> USD - United States dollar</option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label"><?=lang("currency_decimal_places")?></label>
                          <select  name="currency_decimal" class="form-control square">
                            <option value="0" <?=(getOption('currency_decimal',"2") == 0)? 'selected': ''?>> 0</option>
                            <option value="1" <?=(getOption('currency_decimal',"2") == 1)? 'selected': ''?>> 0.0</option>
                            <option value="2" <?=(getOption('currency_decimal',"2") == 2)? 'selected': ''?>> 0.00</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label"><?=lang("currency_symbol")?></label>
                          <input class="form-control" name="currency_symbol" value="<?=getOption('currency_symbol',"$")?>">
                        </div>
                      </div>
                    </div>
                    <h5 class="text-blue mb-3"><i class="fa fa-link"></i> <?=lang("Environment")?></h5>
                    <div class="form-group">
                      <select  name="payment_environment" class="form-control square">
                        <option value="sandbox" <?=(getOption("payment_environment", "sandbox") == 'sandbox')? 'selected': ''?>><?=lang("sandbox_test")?></option>
                        <option value="live" <?=(getOption("payment_environment", "sandbox") == 'live')? 'selected': ''?>><?=lang("Live")?></option>
                      </select>
                    </div>

                    <h5 class="text-blue mb-3"><i class="fa fa-link"></i> <?=lang("Paypal")?></h5>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label"><?=lang("paypal_client_id")?></label>
                          <input class="form-control" name="paypal_client_id" value="<?=getOption('paypal_client_id',"")?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label"><?=lang("paypal_client_secret")?></label>
                          <input class="form-control" name="paypal_client_secret" value="<?=getOption('paypal_client_secret',"")?>">
                        </div>
                      </div>
                    </div>
                    <h5 class="text-blue mb-3"><i class="fa fa-link"></i> <?=lang("Stripe")?></h5>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label"><?=lang("publishable_key")?></label>
                          <input class="form-control" name="stripe_publishable_key" value="<?=getOption('stripe_publishable_key',"")?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label"><?=lang("secret_key")?></label>
                          <input class="form-control" name="stripe_secret_key" value="<?=getOption('stripe_secret_key',"")?>">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>

            <button type="button" class="btn btn-primary btn-lg btnActionSaveSettings" style="margin-left: 10px;"><?=lang('Save')?></button>

            <div class="clearfix"></div>
          </div>
        </form>
      </div>
    </div>
  </div>

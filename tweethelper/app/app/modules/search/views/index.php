  <div class="min-height-200px search">
      <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
          <div class="pull-left">
            <h5 class="text-uppercase"><i class="<?=$module_icon?>" aria-hidden="true"></i> <?=lang('Search_Tweets')?></h5>

          </div>
        </div>
        <form action="<?=cn('search/ajax_lockup')?>" method="POST">
          <div class="row">
            <div class="form-group col-md-3">
              <label  data-toggle="tooltip" data-placement="top" title="Tooltip on top"><?=lang('Twitter_accounts')?></label>
              <select name="ids" class="form-control square">
                <option value="0" selected><?=lang('Twitter_accounts')?></option>
                <?php if(!empty($tw_accounts)){
                  foreach ($tw_accounts as $key => $row) {
                ?>
                <option value="<?=$row->ids?>"><?=$row->screen_name?></option>
                <?php }}?>
              </select>
            </div>
            <div class="form-group col-md-9">
                <label><?=lang('Keywords_returns_a_collection_of_relevant_Tweets_matching_a_specified_query')?></label>
                <div class="input-group">
                  <input name="keywords" type="text" class="form-control">
                  <span class="input-group-btn" style="font-size: 20px;">
                      <a href="javascript:void(0)" class="btn button-item btnActionTwitterSearch" style="border-radius: 0px; color: white; background: #3e99ff; padding: 9px 16px;" >
                        <i class="fa fa-search"></i>
                      </a>
                  </span>
                </div>
              </div>
          </div>
        </form>
        <hr>

        <div class="row result_search">
        </div>
      </div>
    
  </div>

  <script>
      handleChange = (event) => {
          event.preventDefault();
          var keyCode = event.keyCode || event.which;
          if (keyCode == '13'){
              console.log('enter pressed');
              return false;
          }
      }
  </script>
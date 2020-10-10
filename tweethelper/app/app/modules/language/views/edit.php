  
  <div class="min-height-200px language_edit">
    <form action="<?=cn('language/ajax_edit')?>" method="POST">
      <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
          <div class="pull-left">
            <h4 class="text-uppercase"><i class="<?=$module_icon?>" aria-hidden="true"></i> <?=lang('Language')?></h4>
          </div>
        </div>
        <div class="row">

          <div class="col-md-3">
            <div class="form-group">
              <label class=""><?=lang('Language_Code')?></label>
              <select name="language_code" class="form-control">
                <option value="0"><?=lang('Choose_a_Language_code')?></option>
                <?php 
                  $data_languageCodes = language_codes();
                  if (is_array($data_languageCodes)) {
                    foreach ($data_languageCodes as $key => $value) {
                ?>
                <option value="<?=$key?>" <?=(isset($lang->code)&&$lang->code==$key)?'Selected':''?>><?=$key?> - <?=$value?></option>
                <?php }} ?>
              </select>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group">
              <label class=""><?=lang('Location')?></label>
              <input type="hidden" name="ids" value="<?=(isset($lang->ids))?$lang->ids:""?>">
              <select name="country_code" class="form-control">
                <option value="0"><?=lang('Choose_your_country')?></option>
                <?php 
                  $data_countryCodes = country_codes();
                  if (is_array($data_countryCodes)) {
                    foreach ($data_countryCodes as $key => $value) {
                ?>
                <option value="<?=$key?>" <?=(isset($lang->country_code)&&$lang->country_code==$key)?'Selected':''?>> <?=$value?></option>
                <?php }} ?>
              </select>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group">
              <label class=""><?=lang('Status')?></label>
              <select name="status" class="form-control">
                <option value="1" <?=(isset($lang->status)&&$lang->status==1)?'Selected':''?>><?=lang('Enable')?></option>
                <option value="0" <?=(isset($lang->status)&&$lang->status==0)?'Selected':''?>><?=lang('Disable')?></option>
              </select>
            </div>
          </div>   

          <div class="col-md-3">
            <div class="form-group">
              <label class=""><?=lang('')?>Set defaut</label>
              <select name="default" class="form-control">
                <option value="0" <?=(isset($lang->is_default)&&$lang->is_default==0)?'Selected':''?>><?=lang('No')?></option>
                <option value="1" <?=(isset($lang->is_default)&&$lang->is_default==1)?'Selected':''?>><?=lang('Yes')?></option>
              </select>
            </div>
          </div>

        </div>
        <div class="row">
          <h5 class="pd-10"><i class="nav-icon fa fa-edit" aria-hidden="true"></i> <?=lang('Translation_editor')?></h5>
          <hr>
          <table class="hover cell-border" id="datatable-language">
            <thead>
              <tr>
                <th class="table-plus datatable-nosort"><?=lang('Key')?></th>
                <th class="datatable-nosort"><?=lang('Value')?></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $data_languageKeys = all_langugage_keys();
                if(is_array($data_languageKeys)){
                  foreach ($data_languageKeys as $key => $value) {
              ?>
              <tr>
                <td class="table-plus" style="width: 40%">
                  <?=(strlen($key)>=20)?substr($key,0,17).'...':$key?></td>
                <td style="width: 60%;">
                  <?php if(strlen($value) >= 64){?>
                  <div class="form-group">
                    <textarea class="form-control" name="lang[<?=$key?>]" style="max-height: 55px;"><?=(isset($lang_db[$key]))?$lang_db[$key]:$value?>
                    </textarea>
                  </div>
                  <?php }else{?>
                    <div class="form-group">
                      <input class="form-control" type="text" name="lang[<?=$key?>]" value="<?=(isset($lang_db[$key]))?$lang_db[$key]:$value?>">
                    </div>
                  <?php }?>
                </td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
        </div>
        <hr>
        <button type="button" class="btn btn-primary btnActionSaveLanguage" style="margin-left: 10px;"> <?=lang('Save')?></button>
      </div>
    </form>
  </div>

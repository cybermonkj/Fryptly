  <div class="min-height-200px schedule">
    <form action="<?=cn('schedule/ajax_delete_item')?>" method="POST">
      <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
          <div class="pull-left">
            <h5 class="text-uppercase"><i class="<?=$module_icon?>" aria-hidden="true"></i> <?=lang('Scheduled_tweet')?></h5>
          </div>
          <div class="pull-right">
            <button type="button" class="btn btn-outline-warning btnDeleteSchedule"><i class="fa fa-trash-o"></i></button>
          </div>
        </div>
        <div class="row">
          <table class="stripe hover multiple-select-row data-table-export nowrap">
            <thead>
              <tr>
                <th class="table-plus datatable-nosort" width="7px">
                  <div class="custom-control custom-checkbox" style="padding-left: 0px!important">
                    <input type="checkbox" class="custom-control-input checkbox" name="ids[]" id="checkAll">
                    <label class="custom-control-label" for="checkAll"></label>
                  </div>
                </th>
                <th><?=lang('Account')?></th>
                <th><?=lang('Tweet_type')?></th>
                <th><?=lang('Caption')?></th>
                <th><?=lang('Created_on')?></th>
                <th><?=lang('Published_on')?></th>
                <th><?=lang('Status')?></th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($schedules)){
                foreach ($schedules as $key => $row) {
                  $data = json_decode($row->data);
                  $caption = (isset($data->caption)&$data->caption!='')?$data->caption:'';
              ?>
              <tr id="tr_<?=$row->ids?>">
                <td>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input checkbox" name="ids[]" id="customCheck<?=$row->ids?>" value="<?=$row->ids?>">
                    <label class="custom-control-label" for="customCheck<?=$row->ids?>"></label>
                  </div>
                </td>
                <td class="table-plus"><?=$row->screen_name?></td>
                <td><?=$row->type?></td>
                <td><?=(strlen($caption)>=10)?substr($caption,0,7).'...':$caption?></td>
                <td><?=convert_timezone(get_timezone_system($row->created),'user')?></td>
                <td><?=(isset($row->time_post))?convert_timezone(get_timezone_system($row->time_post),'user'):''?></td>
                <td>
                    <?=(isset($row->result))?$row->result:'Unknow error'?>
                </td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>

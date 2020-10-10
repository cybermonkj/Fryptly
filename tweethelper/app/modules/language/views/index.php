  <div class="min-height-200px language">
    <form action="<?=cn('language/ajax_delete_items')?>" method="POST">
      <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
          <div class="pull-left">
            <h6 class="text-uppercase"><i class="<?=$module_icon?>" aria-hidden="true"></i> <?=lang('Language')?> </h6> 
          </div>
          <div class="pull-right">
            <a class="btn btn-outline-primary" href="<?=cn('language/edit')?>"><i class="icon-copy fa fa-plus" aria-hidden="true"></i> <?=lang('')?>Add</span> </a>
            <button type="button" class="btn btn-outline-warning btnActionDeleteItems"> <i class="fa fa-trash-o"></i></button>
          </div>
        </div>
        <div class="row">
          <table class="stripe hover data-table-export nowrap">
            <thead>
              <tr>
                <th class="table-plus datatable-nosort" width="7px">
                  <div class="custom-control custom-checkbox" style="padding-left: 0px!important">
                    <input type="checkbox" class="custom-control-input checkbox" name="ids[]" id="checkAll">
                    <label class="custom-control-label" for="checkAll"></label>
                  </div>
                </th>
                <th><?=lang('Language')?></th>
                <th><?=lang('Code')?></th>
                <th class="table-plus datatable-nosort"><?=lang('Flag_Icon')?></th>
                <th class="table-plus datatable-nosort"><?=lang('Default')?></th>
                <th class="table-plus datatable-nosort"><?=lang('Status')?></th>
                <th class="table-plus datatable-nosort"><?=lang('Created')?></th>
                <th class="table-plus datatable-nosort"><?=lang('Action')?></th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($langLists)){
                foreach ($langLists as $key => $row) {
              ?>
              <tr id="tr_<?=$row->ids?>">
                <td>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input checkbox" name="ids[]" id="customCheck<?=$row->ids?>" value="<?=$row->ids?>">
                    <label class="custom-control-label" for="customCheck<?=$row->ids?>"></label>
                  </div>
                </td>
                <td class="table-plus text-uppercase"><?=language_codes($row->code)?></td>
                <td class="text-uppercase"><?=$row->code?></td>
                <td class="text-center">
                  <span class="flag-icon flag-icon-<?=strtolower($row->country_code)?>"></span>
                </td>
                <td class="text-center"><?=($row->is_default==1)?'Yes':'No'?></td>
                <td class="text-center"><?=($row->status==1)?'Enable':'Disable'?></td>
                <td><?=convert_timezone($row->created,('user'))?></td>
                <td>
                  <div class="dropdown">
                      <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?=cn("language/edit?ids=$row->ids")?>"><i class="fa fa-pencil"></i> <?=lang('Edit')?></a>
                        <a class="dropdown-item btnActionDeleteItem" data-action="<?=cn("language/ajax_delete_item")?>" data-ids="<?=$row->ids?>"><i class="fa fa-trash"></i> <?=lang('Delete')?></a>
                      </div>
                    </div>
                  </td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>

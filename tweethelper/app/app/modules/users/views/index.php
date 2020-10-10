  <div class="min-height-200px users">
    <form action="<?=cn('users/ajax_delete_users')?>" method="POST">
      <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
          <div class="pull-left">
            <h5 class="text-uppercase"><i class="<?=$module_icon?>" aria-hidden="true"></i> <?=lang('Manage_Users')?></h5>
          </div>

          <div class="float-right">
            <a class="btn btn-outline-primary" href="<?=cn('users/add')?>"><i class="icon-copy fa fa-plus" aria-hidden="true"></i> <?=lang('Add')?></span> </a>
            <button type="button" class="btn btn-outline-warning btnActionDeteleAll"><i class="fa fa-trash-o"></i></button>
          </div>
        </div>
        <hr style="margin-top: 0px">
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
                <th><?=lang('Username')?></th>
                <th><?=lang('Email')?></th>
                <th><?=lang('package')?></th>
                <th><?=lang('expiration_date')?></th>
                <th><?=lang('Admin')?></th>
                <th><?=lang('Status')?></th>
                <th><?=lang('Created')?></th>
                <th class="table-plus datatable-nosort"><?=lang('Action')?></th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($users)){
                foreach ($users as $key => $row) {
              ?>
              <tr id="tr_<?=$row->ids?>">
                <td>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input checkbox" name="ids[]" id="customCheck<?=$row->ids?>" value="<?=$row->ids?>">
                    <label class="custom-control-label" for="customCheck<?=$row->ids?>"></label>
                  </div>
                </td>
                <td class="table-plus"><?=$row->username?></td>
                <td><?=$row->email?></td>
                <td>
                  <?php 
                    foreach ($packages as $key => $package) {
                      if ($row->package_id == $package->id) {
                        echo $package->name;
                      }
                    }
                  ?>
                </td>
                <td><?=date("Y-m-d",strtotime(convert_timezone($row->expired_date,('user'))))?></td>
                <td><?=($row->admin==1)?lang('Yes'):lang('No')?></td>
                <td><?=($row->status==1)?lang('Active'):lang('Deactive')?></td>
                <td><?=convert_timezone($row->created,('user'))?></td>
                <td>
                  <div class="dropdown">
                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                      <i class="fa fa-ellipsis-h"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="<?=cn("users/edit?ids=$row->ids")?>"><i class="fa fa-pencil"></i> <?=lang('Edit')?></a>
                      <button class="dropdown-item btnActionDeteleUser" data-ids="<?=$row->ids?>"><i class="fa fa-trash"></i> <?=lang('Delete')?></button>
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

  <div class="min-height-200px schedule">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <div class="clearfix mb-20">
        <div class="pull-left">
          <h5 class="text-uppercase"><i class="<?=$module_icon?>" aria-hidden="true"></i> <?=lang("Transaction_logs")?></h5>
        </div>
      </div>
      <div class="row">
        <table class="stripe hover data-table-export nowrap">
          <thead>
            <tr>
              <th class="table-plus datatable-nosort text-center" width="7px">
                No.
              </th>
              <th><?=lang("User")?></th>
              <th><?=lang("Transaction_ID")?></th>
              <th><?=lang("Payment_method")?></th>
              <th><?=lang("Amount")?></th>
              <th><?=lang("Created")?></th>
              <th><?=lang("Action")?></th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($transactions)){
              $i = 0;
              foreach ($transactions as $key => $row) {
                ++$i;
            ?>
            <tr class="tr_<?=$row->ids?>">
              <td class="text-center">
                <?=$i?>
              </td>
              <td class="table-plus"><?=getField("email", USERS, $row->uid)?></td>
              <td><?=$row->transaction_id?></td>
              <td>
                <?php if($row->type == 'paypal'){?>
                <i class="fa fa-cc-paypal" style="font-size: 25px;"></i> 
                <?php }?>
                
                <?php if($row->type == 'stripe'){?>
                <i class="fa fa-cc-stripe" style="font-size: 25px;"></i> 
                <?php }?>
              </td>
              <td><?=getOption("currency_symbol","").$row->amount?></td>
              <td><?=(isset($row->created))?convert_timezone(get_timezone_system($row->created),'user'):''?></td>
              <td>
                <div class="dropdown">
                  <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-h"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a href="<?=cn($module."/ajax_delete_item/".$row->ids)?>" class="dropdown-item ajaxDeleteItem"><i class="fa fa-trash"></i> <?=lang('Delete')?></a>
                  </div>
                </div>
              </td>
            </tr>
            <?php }} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

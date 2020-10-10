
<div class="min-height-200px post activity-follow-setting module-setting">
  <div class="row clearfix">
    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-12 mb-30 ">
      <div class="border-radius-4 box-shadow bg-white account-list">
        <h5 class="mb-20 pl-3 pt-20">
          <a class="btn-outline-info ajaxLoadContent" href="<?=cn("$module/content/")?>" data-toggle="tooltip" data-placement="top" title="<?=lang("Add")?>"><span><i class="nav-icon fa fa-plus-circle"></i></span ></a> <?=lang("package")?>
        </h5>
        <?php if(!empty($packages)){
          foreach ($packages as $key => $row) {
        ?>
        <div class="item select-account" id="tr_<?=$row->ids?>" data-ids="<?=$row->ids?>" data-callback="<?=cn("$module/content/$row->ids")?>">
          <span class="title"> <i class="fa fa-gift" aria-hidden="true"></i> <?=$row->name?> </span>
          <?php
            if ($row->type == 2) {
          ?>
          <div class="option"> <span >
            <a href="<?=cn("$module/ajax_delete/$row->ids")?>" class="btnDeletePackage">
              <i class="fa fa-trash-o"></i> 
            </a>
          </div>

        <?php }?>
        </div>

        <?php }}?>

         
      </div>
    </div>
    <div class="col-xl-8 col-lg-6 col-md-4 col-sm-12 mb-30 activity-content result-content">

    </div>
  </div>
</div>

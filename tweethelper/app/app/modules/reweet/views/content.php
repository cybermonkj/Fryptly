  <div class="pd-20 bg-white border-radius-4 box-shadow ">
    <div class="profile-avatar">
      <img class="img-profile" src="<?=$setting->avatar?>" width="74px" alt="">
      <span class="screen-name">@<?=$setting->screen_name?></span>
    </div>
    <div class="tab">
      <ul class="nav nav-tabs customtab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#setting" role="tab" aria-selected="true"><?=lang("Settings")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link view-logs" data-callback="<?=cn(segment(1).'/logs/'.$setting->ids)?>" data-toggle="tab" href="#logs" role="tab" aria-selected="false"><?=lang("logs")?></a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="setting" role="tabpanel">
          <?php 
            $data = array(
              "setting" => $setting,
            );
            $this->load->view('setting', $data);
          ?>
        </div>
        <div class="tab-pane fade activity-logs" id="logs" role="tabpanel">

        </div>
      </div>
    </div>
  </div>

  <script src="<?=BASE?>assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
  <script>
    // Switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
    $('.switch-btn').each(function() {
      new Switchery($(this)[0], $(this).data());
    });
</script>
<script type="text/javascript">
  $(function(){
    Main.general();
  });
</script>
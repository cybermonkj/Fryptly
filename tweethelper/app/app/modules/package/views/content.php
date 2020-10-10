  <div class="pd-20 bg-white border-radius-4 box-shadow ">
    <div class="profile-avatar">
      <h5 class=""></i> <?=(isset($package->name)? $package->name : lang("new_package"))?></h5>
    </div>
    <div class="tab">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="setting" role="tabpanel">
          <?php 
            $data = array(
              "package" => $package,
            );
            $this->load->view('setting', $data);
          ?>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
  $(function(){
    Main.general();
  });
</script>
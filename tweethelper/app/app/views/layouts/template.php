<!DOCTYPE html>
<html>
<head>
  <title><?=getOption('website_title','TweetPost - Twitter Marketing Tool')?></title>
  <meta name="description" content="<?=getOption("website_description", "save time, do more, manage multiple Twitter accounts at one place")?>"/>

  <meta name="keywords" content="<?=getOption("website_keyword", 'auto pilot tool, twitter auto schedule, automation, twitter follow, twitter unfollow')?>"/>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="icon" type="image/png" href="<?=getOption("website_favicon", BASE.'assets/images/favicon.png')?>" />

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/emoji/emojionearea.min.css" media="screen">

  <?php if(segment('1')=='gallery'||segment('1')=='post'||segment('1')=='settings'){ ?>
  <link rel="stylesheet" href="<?=BASE?>assets/plugins/jquery-upload/css/style.css">
  <link rel="stylesheet" href="<?=BASE?>assets/plugins/jquery-upload/css/jquery.fileupload.css">

  <?php }?>

  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/switchery/dist/switchery.css">
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css">
  <link rel="stylesheet" href="<?=BASE?>assets/plugins/iziToast/css/iziToast.min.css">
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/fancybox/dist/jquery.fancybox.css">
  <link rel="stylesheet" href="<?=BASE?>assets/css/style.css">
  <link href="<?=BASE?>assets/plugins/flags/css/docs.css" rel="stylesheet">
  <link href="<?=BASE?>assets/plugins/flags/css/flag-icon.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/fonts/fa/css/font-awesome.min.css">
  <?php if(segment(1)=='schedule'||segment(1)=='package'||segment(1)=='users'||segment(1)=='search'||segment(1)=='language'||segment(1)=='transaction'){ ?>
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/datatables/media/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/datatables/media/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/datatables/media/css/responsive.dataTables.css">
  <?php } ?>
  <script src="<?=BASE?>assets/plugins/chart/dist/Chart.bundle.js"></script>
  <script src="<?=BASE?>assets/plugins/chart/utils.js"></script>
  <script src="<?=BASE?>assets/js/script.js"></script>
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/login/css/util.css">
  <link rel="stylesheet" href="<?=BASE?>assets/css/custom.css">
  <script type="text/javascript">
    var    token = '07c6542e82084816e9bfd25b9e9b45a1';
    var    BASE = '<?=BASE?>';
    var    PATH = '<?=PATH?>';
    var    deleteItem = '<?=lang("Are_you_sure_you_want_to_delete_this_item")?>';
    var    deleteItems = '<?=lang("Are_you_sure_you_want_to_delete_all_items")?>';

  </script>

</head>
<body >
  <?=Modules::run('blocks/header')?>
  <?=Modules::run('blocks/sidebar')?>
  <div class="main-container">
    <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10 p-t-30">
      <?php 
        $permission = check_permission();
        if(!$permission->expired_date){
      ?>
      <div class="pd-20 bg-white border-radius-4 box-shadow mb-30 ">
        <div class="alert alert-danger" role="alert">
          <?=lang("oops_your_expiration_date_is_available_in_your_account_on_the_website_to_renew_please_contact_administrator")?>
        </div>
      </div>
      <?php }?>
    <div class="app-content">
      <?=$template['body']?>  
    </div>
    </div>
  </div>

  
  <script src="<?=BASE?>assets/plugins/iziToast/js/iziToast.min.js"></script>
  <script type="text/javascript" src="<?=BASE?>assets/plugins/emoji/emojionearea.min.js"></script>
  <script src="<?=BASE?>assets/plugins/fancybox/dist/jquery.fancybox.js"></script>
  <script src="<?=BASE?>assets/plugins/flags/js/docs.js"></script>
  <script src="<?=BASE?>assets/js/process.js"></script>
  <?php if(segment('1')=='gallery'||segment('1')=='post'||segment('1')=='settings'){ ?>
  <script src="<?=BASE?>assets/plugins/jquery-upload/js/vendor/jquery.ui.widget.js"></script>
  <script src="<?=BASE?>assets/plugins/jquery-upload/js/jquery.iframe-transport.js"></script>
  <script src="<?=BASE?>assets/plugins/jquery-upload/js/jquery.fileupload.js"></script>
  <?php } ?>

  <?php if(segment(1)=='schedule'||segment(1)=='package'||segment(1)=='users'||segment(1)=='search'||segment(1)=='language'||segment(1) == 'transaction'){ ?>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/dataTables.bootstrap4.js"></script>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/dataTables.responsive.js"></script>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/responsive.bootstrap4.js"></script>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/button/buttons.print.js"></script>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/button/buttons.html5.js"></script>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/button/buttons.flash.js"></script>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/button/pdfmake.min.js"></script>
  <script src="<?=BASE?>assets/plugins/datatables/media/js/button/vfs_fonts.js"></script>
  
  <script>
    $('document').ready(function(){
      $('.data-table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [{
          targets: "datatable-nosort",
          orderable: false,
        }],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
          "info": "_START_-_END_ of _TOTAL_ entries",
          searchPlaceholder: "Search"
        },
      });

      $('.data-table-follow').DataTable({
        columnDefs: [{
          targets: "datatable-nosort",
        }],
      });

      $('.data-table-export').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [{
          targets: "datatable-nosort",
          orderable: false,
        }],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
          "info": "_START_-_END_ of _TOTAL_ entries",
          searchPlaceholder: "Search"
        },
        dom: 'Bfrtip',
        buttons: [
        'copy', 'csv', 'pdf', 'print'
        ]
      });
      $('#datatable-language').DataTable({
        scrollCollapse: true,
        autoWidth: true,
        responsive: true,
        columnDefs: [{
          targets: "datatable-nosort",
        }],
        "paging":   false,
        "ordering": false,
        "info":     false,
        "bFilter": false,
      });

      var multipletable = $('.multiple-select-row').DataTable();
      $('.multiple-select-row tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
      });

      // check All
      $("#checkAll").change(function(){ 
          $(".checkbox").prop('checked', $(this).prop("checked")); 
      });

      $('.checkbox').change(function(){ 
          if(false == $(this).prop("checked")){ 
              $("#CheckAll").prop('checked', false); 
          }
          if ($('.checkbox:checked').length == $('.checkbox').length ){
              $("#CheckAll").prop('checked', true);
          }
      });
    });
  </script>
  <?php } ?>

  
  <?php if(segment(1)=='post'||segment(1)=='gallery'){ ?>
  <script src="<?=BASE?>assets/js/gallery.js"></script>
  <?php }?>
  
  <script src="<?=BASE?>assets/plugins/switchery/dist/switchery.min.js"></script>
  <script src="<?=BASE?>assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
  <script src="<?=BASE?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>
  <script>
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
    $('.switch-btn').each(function() {
      new Switchery($(this)[0], $(this).data());
    });
  </script>
  <script src="<?=BASE?>assets/js/main.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {

      $("#text-emoji").emojioneArea({
        pickerPosition: "bottom",
        tonesStyle: "bullet"
      });

      $("#text-emoji").emojioneArea({
        pickerPosition: "bottom",
        tonesStyle: "bullet"
      });

    });

  </script>
</body>
</html>
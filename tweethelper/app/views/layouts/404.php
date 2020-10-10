<!DOCTYPE html>
<html>
<head>
  <title><?=getOption('website_title','TweetPost - Twitter Marketing Tool')?></title>
  <meta name="description" content="<?=getOption("website_description", "save time, do more, manage multiple Twitter accounts at one place")?>" />

  <meta name="keywords" content="<?=getOption("website_keyword", 'auto pilot tool, twitter auto schedule, automation, twitter follow, twitter unfollow')?>"/>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="icon" type="image/png" href="<?=getOption("website_favicon", BASE.'assets/images/favicon.png')?>" />
  
  <!--CSS -->
  <link rel="stylesheet" href="<?=BASE?>assets/css/style.css">
</head>
<body>
  <div class="error-page login-wrap bg-cover height-100-p customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
    <img src="vendors/images/error-bg.jpg" alt="" class="bg_img">
    <div class="pd-10">
      <div class="error-page-wrap text-center color-white">
        <h1 class="color-white weight-500"><?=lang('Error_404_Page_Not_Found')?></h1>
        <img src="vendors/images/404.png" alt="">
        <p><?=lang('Sorry_the_page_you_are_looking_for_cannot_be_accessed')?><br><?=lang('Either_check_the_URL')?> <a href="<?=cn()?>"><?=lang('go_home')?></a>.</p>
      </div>
    </div>
  </div>

  <!-- js -->
  <script src="<?=BASE?>assets/js/script.js"></script>
</body>
</html>
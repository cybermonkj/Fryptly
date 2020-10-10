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
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
  <link rel="stylesheet" href="<?=BASE?>assets/css/style.css">
  <link rel="stylesheet" href="<?=BASE?>assets/plugins/iziToast/css/iziToast.min.css">
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/login/css/login.css">
  <script type="text/javascript">
    var token = '07c6542e82084816e9bfd25b9e9b45a1',
        BASE = '<?=BASE?>',
        PATH = '<?=PATH?>';

  </script>
</head>
<body>
    <div class="app-content">
      <?=$template['body']?>  
    </div>
    
  <script src="<?=BASE?>assets/js/script.js"></script>
  <script src="<?=BASE?>assets/plugins/iziToast/js/iziToast.min.js"></script>
  <script src="<?=BASE?>assets/js/process.js"></script>
  <script src="<?=BASE?>assets/login/js/login.js"></script>
  <script src="<?=BASE?>assets/js/main.js"></script>
</body>
</html>
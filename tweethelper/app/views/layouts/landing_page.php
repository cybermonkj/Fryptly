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
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/fonts/fa/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=BASE?>assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/css/landing_page.css">
</head>
<body>
  <header class="bg-dark text-light">
    <div class="app-content">
      <div id="particles-js"></div>
      <div class="overlay"></div>
      <div class="wrap">
        <nav class="navbar navbar-expand-lg">
          <div class="container">
            <a href="<?=cn("")?>" class="navbar-brand brand-website-logo">
              <img src="<?=getOption("website_brand_logo", BASE.'assets/images/logo-white.png')?>">
            </a>
            <ul class="navbar-nav">
                  <li class="nav-item"><a href="<?=cn("users/login")?>" class="btn-login"><?=lang("Login")?></a></li>
                  <li class="nav-item"><a href="<?=cn("users/register")?>" class="btn-register"><?=lang("Register")?></a></li>
            </ul>
          </div>
        </nav>
        <div class="content">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-md-8 text-center header-title">
                <h3 class="text-title"><?=lang("twitter_scheduling_tool")?></h3>
                <p><?=lang("the_great_tool_to_increase_marketing_effectivences_on_twitter_it_helps_you_manage_your_twitter_accounts_and_it_helps_you_build_your_following_influence_and_increase_twitter_engagement")?></p>
                <a href="<?=cn("users/login")?>">
                  <button type="button" class="btn btn-outline-light btn-lg btn-get-start"><?=lang("get_start_now")?></button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Feature -->
  <div class="section-1">
    <div class="container">
      <h2 class="title text-center"><?=lang("features")?></h2>
      <p class="text-center"><?=lang("the_tool_can_help_your_marketing_plan_reach_many_clients_as_much_as_you_want")?></p>
      <hr>
      <div class="row content">
        <div class="col-md-4 text-center feature">
          <div class="icon">
                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                    </div>
          <h4 class="title"><?=lang("tweet__scheduled_tweet")?></h4>
          <p class="desc">
            <?=lang("auto_tweet_photo_text_and_videos_on_your_twitter_account_with_tweet_now_or_scheduled_tweet")?>
          </p>
        </div>  
              
        <div class="col-md-4 text-center feature">
          <div class="icon">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </div>
          <h4 class="title"><?=lang("auto_follow")?></h4>
          <p class="desc">
            <?=lang("you_can_set_up_before_following_any_twitter_account_who_has_hashtags_or_by_twitter_screen_name")?>
          </p>
        </div>  

        <div class="col-md-4 text-center feature">
          <div class="icon">
                        <i class="fa fa-user-times" aria-hidden="true"></i>
                    </div>
          <h4 class="title"><?=lang("auto_unfollow")?></h4>
          <p class="desc">
            <?=lang("the_tool_will_auto_unfriend_all_your_followings_who_you_are_following_with_many_options")?>
          </p>
        </div>    
                
        <div class="col-md-4 text-center feature">
          <div class="icon">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </div>
          <h4 class="title"><?=lang("auto_like")?></h4>
          <p class="desc">
            <?=lang("this_feature_will_help_you_increase_interactive_like_with_options_from_hashtags_or_twitter_screen_name")?>
          </p>
        </div>    

        <div class="col-md-4 text-center feature">
          <div class="icon">
                        <i class="fa fa-retweet" aria-hidden="true"></i>
                    </div>
          <h4 class="title"><?=lang("auto_reweet")?></h4>
          <p class="desc">
            <?=lang("retweets_a_public_tweet_by_hashtag_or_twitter_screen_name_it_is_similar_to_hitting_the_retweet_button_against_a_tweet_on_the_twitter_website_or_mobile_app")?>.
          </p>
        </div>  

        <div class="col-md-4 text-center feature">
          <div class="icon">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
          <h4 class="title"><?=lang("Search_Tweets")?></h4>
          <p class="desc">
            <?=lang("search_tweets_profiles_by_keywork_the_tool_returns_a_collection_of_relevant_tweets_matching_a_specified_query")?>
          </p>
        </div>

      </div>
    </div>
  </div>

  <!-- About us -->
  <div class="section-2">
    <div class="container">
      <div class="content">
        <div class="row justify-content-md-center">
          <div class="col-md-8 text-center header-title">
            <h2 class="title"><?=lang("TweetPost")?></h2>
            <p class="desc"><?=lang("the_great_tool_to_increase_marketing_effectivences_on_twitter")?></p>
            <hr>
          </div>
          <div class="col-md-10 about-contact">
            <div class="row">
              <div class="col-md-6">
                <h2 class="title text"><?=lang("contact_us")?></h2>
                <p class="desc"><?=lang("company_location_country")?>
                <br><?=lang("donotreply_tweetpostcom")?>
                <br><?=lang("tel_number")?></p>
              </div>
              <div class="col-md-6 text-right">
                <ul class="footer-social-icon">
                  <li class="icon"><a href="#"><span class="fa fa-facebook" aria-hidden="true"></span></a></li>
                  <li class="icon"><a href="#"><span class="fa fa-instagram" aria-hidden="true"></span></a></li>
                  <li class="icon"><a href="#"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="text-center"><?=lang("copyright")?></div>
    </div>
  </footer>

  <script src="<?=BASE?>assets/js/script.js"></script>
  <script type="text/javascript" src="<?=BASE?>assets/plugins/particles/particles.js"></script>
  <script type="text/javascript" src="<?=BASE?>assets/plugins/particles/app.js"></script>
  
</body>
</html>
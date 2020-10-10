<?php
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class twitterapi{
    private $consumer_key;
    private $consumer_secret;
    private $oauth_token;
    private $oauth_token_secret;
    private $twitter;

    public function __construct($consumer_key = null, $consumer_secret = null,$oauth_token='',$oauth_token_secret=''){
        $this->consumer_key    = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->twitter         = $this->getConnectionWithAccessToken($oauth_token, $oauth_token_secret);
    }

	function login_url(){
        $twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
        $oauth_token = (object)$twitter->oauth('oauth/request_token', ['oauth_callback' => cn("twitter/add_account")]);
        $this->oauth_token = $oauth_token->oauth_token;
        $this->oauth_token_secret = $oauth_token->oauth_token_secret;

		$url = $twitter->url("oauth/authorize", ["oauth_token" => $this->oauth_token]);

		unset_session("twitter_oauth_token");
        unset_session("twitter_oauth_token_secret");
        if(!session("twitter_oauth_token") && !session("twitter_oauth_token_secret")){
            set_session("twitter_oauth_token", $this->oauth_token);
            set_session("twitter_oauth_token_secret", $this->oauth_token_secret);
        }

		return $url;

	}
    
    function get_access_token(){
        try {
        	$this->oauth_token = session("twitter_oauth_token");
            $this->oauth_token_secret = session("twitter_oauth_token_secret");
            $this->twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->oauth_token, $this->oauth_token_secret);

            $access_token = $this->twitter->oauth("oauth/access_token", ["oauth_verifier" => get("oauth_verifier")]);

            unset_session("twitter_oauth_token");
            unset_session("twitter_oauth_token_secret");
            return $access_token;
        } catch (Exception $e) {
            redirect(cn("twitter/oauth"));
        }
	}

    function set_access_token($token){
        $token = json_decode($token);
        $this->twitter->setOauthToken($token->oauth_token, $token->oauth_token_secret);
    }

    function check_status_upload($media_id){
        return $this->twitter->get('media/upload', array("command" => "STATUS", "media_id" => $media_id));
    }

    function getConnectionWithAccessToken($token=''){
        if(!empty($token)){
            if(!is_object($token)){
                $token  = json_decode($token);
            }
            $this->twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $token->oauth_token, $token->oauth_token_secret);
        }else{
            $this->twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
        }

    }

    // Get request data
    function get_request($method, $array = array()){
        $data = $this->twitter->get($method, $array);
        if(is_object($data)){
            return $data;
        }
        return false;
    }    

    function get_self_followings(){
        $followings = $this->twitter->get('friends/ids', array());
        if(!empty($followings)){
            $followings = $followings->ids;
            $followings = array_reverse($followings);
            return $followings;
        }
        return false;
    }

    function get_self_followers(){
        $followers = $this->twitter->get('followers/ids', array());
        if(!empty($followers)){
            $followers = $followers->ids;
            return $followers;
        }
        return false;
    }

    function get_followers($screen_name, $count){
        $user_followers = $this->twitter->get('followers/ids',['screen_name'=> trim($screen_name),'count'=> $count]);
        if(!empty($user_followers)){
            return $user_followers->ids;
        }
        return false;
    }

    // get tweetByUser
    function get_tweet_by_user($screen_name, $no_tweets){
        $result = $this->twitter->get("statuses/user_timeline", ['screen_name' => trim($screen_name),"count" => $no_tweets, "exclude_replies" => true]);
        return $result;
    }

    // get tweetByhash_tag
    function get_tweet_by_keyword($hash_tag, $no_tweets , $type = ""){
        $this->twitter->setTimeouts(120, 60);
        $result = $this->twitter->get("search/tweets", ['q'=> $hash_tag,'count'=> $no_tweets,'result_type' => 'recent']);
        if(!empty($result->statuses)){
            switch ($type) {
                case 'hashtag':
                    # code...
                    $data = $result->statuses;
                    foreach ($data as $key => $row) {
                        $text = $row->text;
                        $tags = getDataFromString($text, 'hashtag');
                        if (!in_array(strtolower($hash_tag), $tags)) {
                            unset($data[$key]);
                        }
                    }
                    $result = array_values($data);
                    return $result;

                    break;
                
                default:
                    return $result->statuses;
                    break;
            }
        }
        return false;
    }

    // Get request data
    function post_request($method, $array = array()){
        $data = $this->twitter->post($method, $array);
        if(is_object($data)){
            return $data;
        }
        return $data;
    }

    // reweet
    function reweet($id){
        return $result = $this->post_request("statuses/retweet", array("id" => $id));
    }

    // follow
    function follow($id){
        return $result = $this->post_request("friendships/create", array("user_id" => $id));
    }

    // unfollow
    function unfollow($id){
        return $result = $this->post_request("friendships/destroy", array("user_id" => $id));
    }
    
    // favorites
    function favorites($id){
        return $result = $this->post_request("favorites/create", array("id" => $id));
    }


    // DM
    function direct_messages_event($userId, $message){
        $spintax  = new Spintax();
        $caption  = @$spintax->process($message);
        $data = [
            'event' => [
                'type' => 'message_create',
                'message_create' => [
                    'target' => [
                        'recipient_id' => $userId
                        ],
                    'message_data' => [
                          'text' => $message
                    ]
                ]
            ] 
        ];
        $result = $this->twitter->post('direct_messages/events/new', $data, true);
        return $result;
    }


    // Post request
    function postMedia($data){
        $spintax          = new Spintax();
        $data             = (object)($data);
        $response         = array();
        $data_content     = (object)json_decode($data->data);
        $media            = $data_content->media;
        $caption          = @$spintax->process($data_content->caption);
        
        try {
            switch ($data->type) {
                case 'text':
                    $parameters       = array('status' => $caption);
                    $response         = $this->twitter->post("statuses/update", $parameters);
                    break;

                case 'photo':
                    $this->twitter->setTimeouts(120,60);
                    $parameters       = array('status' => $caption);
                    foreach ($media  as $item) {
                        $item = str_replace(BASE, "", $item);
                        $media = $this->twitter->upload('media/upload', ['media' => $item]);
                        $media_ids[] = $media->media_id_string;
                    }
                    $parameters['media_ids'] = implode(',', $media_ids);
                    $response = $this->twitter->post('statuses/update', $parameters);
                    break;
                
                case 'video':
                    $this->twitter->setTimeouts(120,60);
                    $parameters  = array('status' => $caption);
                    $media       = $this->twitter->upload('media/upload', array(
                        'media'          => str_replace(BASE, "", $media[0]),
                        'media_type'     => 'video/mp4',
                        'media_category' => 'tweet_video'
                    ), true);

                    $videoCount = 0;
                    do{
                        $statusResponse = $this->twitter->mediaStatus($media->media_id_string);
                        if ($statusResponse->processing_info->state != 'succeeded'){ 
                            sleep(5); 
                        }
                        $videoCount++;
                    }
                    
                    while ($statusResponse->processing_info->state != 'succeeded' && $videoCount < 5);
                    $parameters['media_ids'] = $media->media_id;
                    $response = $this->twitter->post('statuses/update', $parameters);
                    break;
            }

            if ($this->twitter->getLastHttpCode() == 200) {
                return array(
                    "status"  => "success",
                    "message" => "Published successfully",
                    "response" => $response,
                );
            } else if(isset($response->errors)){
                
                return array(
                    "status"  => "error",
                    "message" => $response->errors[0]->message
                );

            }else {
                return array(
                    "status"  => "error",
                    "message" => "Could not connect to Twitter. Refresh the page or try again later.",
                );
            }
        } catch (Exception $e) {
            return array(
                "status"  => "error",
                "message" => $e->getMessage(),
            );
        }

    }

    function post($data){
        $data     = (object)$data;
        $response = array();
        try {
            $data->data = (object)json_decode($data->data);
            $media      = $data->data->media;
            $caption    = $data->data->caption;
            $params     = array('status' => $caption);

            switch ($data->type) {
                case 'text':
                    $response = $this->twitter->post('statuses/update', $params);
                    break;

                case 'photo':
                    $this->twitter->setTimeouts(120,60);
                    $media_ids = array();
                    foreach ($media as $item) {
                        $image_info = get_image_size($item);
                        if(!empty($image_info)){
                            $uploadedMedia = $this->twitter->upload('media/upload', array('media' => get_path_file($item) ));
                            $media_ids[] = $uploadedMedia->media_id_string;
                        }
                    }

                    $params['media_ids'] = implode(',', $media_ids);
                    $response = $this->twitter->post('statuses/update', $params);
                    break;

                case 'video':
                    $this->twitter->setTimeouts(120,60);
                    $uploadedMedia = $this->twitter->upload('media/upload', array(
                        'media' => get_path_file($media[0]),
                        'media_type' => 'video/mp4',
                        'media_category' => 'tweet_video'
                    ), true);

                    $videoCount = 0;
                    do{
                        $statusResponse = $this->twitter->get_upload(
                            'media/upload',
                            array(
                                "command" => "STATUS",
                                "media_id" => $uploadedMedia->media_id_string
                            ),
                            true  //I added a boolean variable to override the endpoint, if true, get use the UPLOAD endpoint, not the API 
                        );

                        if ($statusResponse->processing_info->state != 'succeeded'){ 
                            sleep(5); 
                        }
                        $videoCount++;
                    }

                    while ($statusResponse->processing_info->state != 'succeeded' && $videoCount < 5);

                    $params['media_ids'] = $uploadedMedia->media_id;
                    $response = $this->twitter->post('statuses/update', $params);
                    break;
            }

            if(isset($response->id)){
                return $response->id;
            }else if(isset($response->errors)){
                return array(
                    "status"  => "error",
                    "message" => $response->errors[0]->message
                );
            }else{
                return array(
                    "status"  => "error",
                    "message" => "Unknow error"
                );
            }
            
        } catch (Exception $e) {
            return array(
                "status"  => "error",
                "message" => $e->getMessage()
            );
        }
    }
}




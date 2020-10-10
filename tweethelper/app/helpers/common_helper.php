<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('pr')) {
    function pr($data, $type = 0) {
        print '<pre>';
        print_r($data);
        print '</pre>';
        if ($type != 0) {
            exit();
        }
    }
}

if(!function_exists('pr_sql')){
	function pr_sql($type=0){
		$CI = &get_instance();
		$sql = $CI->db->last_query();
		pr($sql,$type);
	}
}



// get Setting

if (!function_exists('updateLogsCounter')) {
	function updateLogsCounter($field,$key,$case,$table,$id = null){
		$CI = &get_instance();
		$item  = $CI->model->get($field,$table,"id ='".$id."'")->$field;
		if(empty($item)){
			$option[$key] = 1;
			$CI->db->update($table,[$field => json_encode($option)],"id ='".$id."'");
			return true;
		}else{
			$option  = json_decode($item);
			if(is_array($option)||is_object($option)){
				$option = (array)$option;
				if(isset($option[$key])){
					switch ($case) {
						case 'down':
							if($option[$key] > 0){
								$option[$key] = $option[$key]-1;
								$CI->db->update($table,[$field => json_encode($option)],"id ='".$id."'");
							}
							break;	
												
						case 'up':
							$option[$key] = $option[$key]+1;
							$CI->db->update($table,[$field => json_encode($option)],"id ='".$id."'");
							break;
							
						case 'zero':
							$option[$key] = 0;
							$CI->db->update($table,[$field => json_encode($option)],"id ='".$id."'");
							break;

					}
					return true;
				}else{
					$option[$key] = 1;
					$CI->db->update($table,[$field => json_encode($option)],"id ='".$id."'");
					return true;
				}
			}
		}
	}
}

// Get option 
if(!function_exists('getOption')){
	function getOption($slug,$value = ""){
		$CI = &get_instance();
		$CI->load->model('model');
		// Check option
		$checkOption = $CI->model->get('*','options',"slug ='{$slug}'");
		if(!empty($checkOption)){
			return $checkOption->value;
		}else{
			$CI->db->insert('options',array('slug' => $slug, 'value' => $value));
			return $value;
		}
	}
}
// Get option 
if(!function_exists('get_purchase_code')){
	function get_purchase_code($slug, $value = ""){
		$CI = &get_instance();
		$CI->load->model('model');
		// Check option
		$checkOption = $CI->model->get('*','general_purchase',"pid ='{$slug}'");
		if(!empty($checkOption)){
			return $checkOption->$value;
		}
	}
}

// Update option
if(!function_exists('updateOption')){
	function updateOption($slug,$value = ""){
		$CI = &get_instance();
		$CI->load->model('model');
		// Check option
		$checkOption = $CI->model->get('*','options',"slug ='{$slug}'");
		if(!empty($checkOption)){
			$CI->db->update('options',array('value' => $value),"slug ='{$slug}'");
		}else{
			$CI->db->insert('options',array('slug' => $slug, 'value' => $value));
		}
	}
}

// get any field from Table
if(!function_exists('getField')){
	function getField($field,$table,$conditionById){
		$CI = &get_instance();
		$CI->load->model('model');
		$item = $CI->model->get($field,$table,['id' => $conditionById]);
		if(!empty($item)){
			return $item->$field;
		}
		return false;
	}
}

// Get role for user
if(!function_exists('get_Role')){
	function get_Role(){
		$is_admin = getField('admin','users',session('uid'));
		if($is_admin == 1){
			return true;
		}
		return false;	
	}
}



// get array different
if (!function_exists('get_array_diff')) {
	function get_array_diff($large, $small){
		$array_diff = array();
		$array_diff = array_diff($large, $small);
		return array_values($array_diff);
	}
}


if (!function_exists('ids')) {
	function ids(){
		$CI = &get_instance();
		return md5($CI->encryption->encrypt(time()));
	};
}


if (!function_exists('encrypt_encode')) {
	function encrypt_encode($text){
		$CI = &get_instance();
		return $CI->encryption->encrypt($text);
	};
}

if (!function_exists('encrypt_decode')) {
	function encrypt_decode($key){
		$CI = &get_instance();
		return $CI->encryption->decrypt($key);
	};
}

if (!function_exists('xml_attribute')) {
	function xml_attribute($object, $attribute)
	{
	    if(isset($object[$attribute]))
	        return (string) $object[$attribute];
	}
}

if (!function_exists('deleteDir')) {
	function deleteDir($path){
		return is_file($path) ? @unlink($path) : array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
	}
}

if (!function_exists('format_number')) {
	function format_number($number = ""){
		return number_format($number, 0, ',',',');
	}
}


if (!function_exists('filter_input_xss')){
	function filter_input_xss($input){
        if($input)
		  $input= htmlspecialchars($input, ENT_QUOTES);
		return $input;
	}
}

if (!function_exists('segment')){
	function segment($index){
		$CI = &get_instance();
        if($CI->uri->segment($index)){
		  return $CI->uri->segment($index);
        }else{
            return false;
        }
	}
}

if(!function_exists('post')){
	function post($name = ""){
		$CI = &get_instance();
		if($name != ""){
			$post = $CI->input->post(trim($name));
			if(is_string($post)){
				return addslashes($CI->input->post(trim($name)));
			}else{
				return $post;
			}
		}else{
			return $CI->input->post();
		}
	}
}

if(!function_exists('create_folder')){
   function create_folder(){
   	$path = APPPATH."../assets/uploads/user" . session("uid")."/";
  	if(!file_exists($path)){
 	  	$uold     = umask(0);
    	if(!mkdir($path, 0700,True)){
    		pr("Can't create the folder");
    	}
		umask($uold);
		file_put_contents($path."index.html", "<h1>404 Not Found</h1>");
 	}
   }
}


if(!function_exists('check_file_type')){
	function check_file_type($link,$type){
		$link_arr = explode(".",$link);
		if(strtolower(end($link_arr))==$type){
			return true;
		}
		return false;
	}
}

if(!function_exists('is_image_exists')){
	function is_image_exists($path){
		$headers = @get_headers($path);
		if(strpos($headers[0],'404') === false) {
			return $path;
		} else {
			return $path = BASE."/assets/images/default_profile_normal.png";
		}
	}
}


if(!function_exists("ms")){
	function ms($array){
		print_r(json_encode($array));
		exit(0);
	}
}


if (!function_exists('get')){
	function get($input){
		$CI = &get_instance();
		return $CI->input->get($input);
	}
}

if (!function_exists('session')){
	function session($input){
		$CI = &get_instance();
		return $CI->session->userdata($input);
	}
}

if (!function_exists('set_session')){
	function set_session($name,$input){
		$CI = &get_instance();
		return $CI->session->set_userdata($name,$input);
	}
}

if (!function_exists('unset_session')){
	function unset_session($name){
		$CI = &get_instance();
		return $CI->session->unset_userdata($name);
	}
}

if (!function_exists('array_flatten')) {
	function array_flatten($data) { 
	  	$it =  new RecursiveIteratorIterator(new RecursiveArrayIterator($data));
		$l = iterator_to_array($it, false);
	  	return $l;
	} 
}

if (!function_exists("l")) {
    function l($slug=""){
        $lang=json_decode(file_get_contents("lang/lang.json"),true);
        if (isset($lang[$slug])&&!empty($lang[$slug])) {
            return $lang[$slug];
        }else {
            return $slug;
        }
    }
}  

if (!function_exists("cn")) {
	function cn($module=""){
		return PATH.$module;
	}
}

if(!function_exists('segment')){
	function segment($index){
		$CI = &get_instance();
		return $CI->uri->segment($index);
	}
}

// media
if(!function_exists('get_media_path')){
	function get_media_path($file_name){
		$path = BASE."assets/uploads/user".session('uid')."/".$file_name;
		return $path;
	}
}

// array_rand
if (!function_exists('get_value_rand_array')) {
	function get_value_rand_array($data, $type = ""){
		if(!empty($data)){
			if(is_string($data)){
				$data = explode(',',$data);
			}
			$item = $data[mt_rand(0, count($data)-1)];
			switch ($type) {
				case 'feed':
					return $item;
					break;
				
				default:
					return trim($item);
					break;
			}
		}
		return false;
	}
}

// redirect 404
if(!function_exists('get_layout')){
	function get_layout($params=''){
		$CI  = &get_instance();
		$data= array();
		switch ($params) {
			case '404':
				$CI->template->set_layout('404');
				$CI->template->build('index', $data=array());
				break;
		}

	}
}

// time
if(!function_exists("get_to_time")){
	function get_to_time($date){
		if(is_numeric($date)){
			return date("Y-m-d H:i:s", $date);
		}else{
			return strtotime(str_replace('/', '-', $date));
		}
	}
}

if(!function_exists('get_timezone_system')){
	function get_timezone_system($datetime){
		$datetime = get_to_time($datetime);
		$datetime = (is_numeric($datetime))?date("Y-m-d H:i:s", $datetime):$datetime;
		return $datetime;
	};
}


// ****Timezone***
if(!function_exists('tz_list')){
	function tz_list(){
		$zones = array();
		$dataZones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
		foreach ($dataZones as $key => $zone) {
			date_default_timezone_set($zone);
			$zones[$key]['zone'] = $zone;
			$zones[$key]['time'] = "(UTC ".date('P',time()).") ".$zone;
			$zones[$key]['sort'] = date('P',time());
		}

		usort($zones,function($a,$b){
			return $a['sort'] - $b['sort'];
		});

	  	return $zones;
	}
}

// Convert time zone for user.
if(!function_exists('convert_timezone')){
	function convert_timezone($datetime, $case, $uid = ''){
		$zonesystem  = date_default_timezone_get();

		if ($uid != '') {
			$zoneuser    = get_user_timezone($uid);
		}else{
			$zoneuser    = get_user_timezone(session('uid'));
		}

		switch ($case) {
			case 'user':
				$currentTZ   = new DateTimeZone($zonesystem);
				$newTZ       = new DateTimeZone($zoneuser);
				break;

			case 'system':
				$currentTZ   = new DateTimeZone($zoneuser);
				$newTZ       = new DateTimeZone($zonesystem);
				break;
		}
		
		$date        = new DateTime( $datetime, $currentTZ );
		$date->setTimezone( $newTZ );
		return $date->format('Y-m-d H:i:s');
	}
}

//Get User's timezone, return zone
if(!function_exists("get_user_timezone")){
	function get_user_timezone($uid = null){
		if(!empty($uid)){
			$userZone = getField('timezone', USERS, $uid);
			if(!empty($userZone)){
				return $userZone;
			}
		}
		return false;
	}
}

class Spintax
{
    public function process($text)
    {
        return preg_replace_callback(
            '/\{(((?>[^\{\}]+)|(?R))*)\}/x',
            array($this, 'replace'),
            $text
        );
    }

    public function replace($text)
    {
        $text = $this->process($text[1]);
        $parts = explode('|', $text);
        return $parts[array_rand($parts)];
    }
}

if(!function_exists("get_value")){
	function get_value($data , $key){
		if(is_string($data)){
			$data = json_decode($data);
		}

		if(is_array($data)){
			if (isset($data[$key])) {
				return $data[$key];
			}
		}

		if(is_object($data)){
			if (isset($data->$key)) {
				return $data->$key;
			}
		}
		return false;
	}
}

if (!function_exists('estimated_time_arrival_string')) {
	function estimated_time_arrival_string($datetime) {
	    $now  = new DateTime;
	    $next = new DateTime($datetime);
	    $string = array(
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    $interval = $next->diff($now);

	    foreach ($string as $k => $v) {
    		$string[$k] =  $interval->$k . ' ' . lang($v .($interval->$k > 1 ? 's' : ''));
	    }
	    if($interval->h > 0){
	    	$result = $string['h'].' '.$string['i'].' '.$string['s'];
	    }else{
	    	$result = $string['i'].' '.$string['s'];
	    }
	    return $result;
	}
}



//add
if (!function_exists('get_24h_daily')) {
	function get_24h_daily($minute){
		$time = "00:00";
		$str_time = strtotime($time);
		$data = array();
		$loops = (60*60*24)/(60*$minute);
		for ($i=0; $i <= $loops; $i++) { 
			$time_format = date('H:i', $str_time);
			$str_time += $minute*60;
			$data[$i] = $time_format;
		}
		return $data;
	}
}

if (!function_exists('check_auto_pause_daily')) {
	function check_auto_pause_daily($from, $to, $time, $uid){
		$from = $from.":00";
		$to   = $to.":00";
		$time_user  = convert_timezone(NOW, 'user', $uid);
		$hour_real  = date("G", strtotime($time_user));
		$hour_from  = date("G", strtotime($from));
		$hour_to    = date("G", strtotime($to));
		$next_time = "";
		$check = false;
		if($hour_to > $hour_from){
			if($hour_real >= $hour_from && $hour_real <= $hour_to){
				$next_time  = date("Y-m-d", strtotime($time_user)).' '.$to;
				$check = true;
			}
		}else{
			if(($hour_real >= $hour_from && $hour_real <= 23) || (($hour_real >= 0 && $hour_real < $hour_to) )){
				$next_time  = date("Y-m-d", strtotime(NOW)).' '.$to;
				if($hour_real <= 23 && $hour_real >= $hour_from){
					$next_time  = date("Y-m-d", strtotime(NOW . ' + 1 day')).' '.$to;
				}
				$check = true;
			}
		}

		return (object)array(
			"check_auto_pause_daily" => $check,
			"next_time"              => convert_timezone($next_time, 'system', $uid),
		);
	}
}

if (!function_exists('module_type_lang')) {
	function module_type_lang($key){
		switch ($key) {

			case 'like':
				return $result = lang("liked_tweet");
				break;
			case 'follow':
				return $result = lang("followed_user");
				break;
			case 'unfollow':
				return $result = lang("unfollowed_user");
				break;
			case 'reweet':
				return $result = lang("reweeted");
				break;
			case 'direct_messages':
				return $result = lang('sent_a_message');
				break;
		}
	}
}

if (!function_exists('getDataFromString')) {
	function getDataFromString($string, $target){
	    if ($target == "hashtag") {
	        $hashtags = array();
	        preg_match_all("/(#\w+)/u", $string, $matches);   
	        if ($matches) {
	            $hashtagsArray = array_count_values($matches[0]);
	            $hashtags = array_keys($hashtagsArray);
	            foreach ($hashtags as $key => $row) {
	            	$hashtags[$key] = strtolower($row);
	            }
	            return $hashtags;
	        }
	    }
	    if ($target == "usernames") {
	        $usernames = array();
	        preg_match_all("/(@\w+)/", $string, $matches);  
	        if ($matches) {
	            $usernamesArray = array_count_values($matches[0]);
	            $usernames = array_keys($usernamesArray);
	            return $usernames;
	        }
	    }
	}
}

if(!function_exists("check_permission")){
	function check_permission($uid = 0){
		$CI = &get_instance();
		$check_expired_date = false;
		$check_max_accounts = false;
		if($uid == 0){
			$uid = session("uid");
		}
		$user    = $CI->model->get("expired_date, package_id, admin", USERS, "id = '".$uid."'");
		if(!empty($user)){

			$today = strtotime(NOW);
			$expired_date = strtotime($user->expired_date);
			if($expired_date > $today){
				$check_expired_date = true;
			}

			$package = $CI->model->get("*", PACKAGE, "id = '".$user->package_id."'");
			if (empty($package)) {
				$package = $CI->model->get("*", PACKAGE, "id = 1");
			}
			$accounts   = $CI->model->fetch("*", TWITTER_ACCOUNTS, "uid = '".$uid."'");
			$max_accounts = get_value($package->permission, "account");

			if(!empty($accounts) && (count($accounts) >= $max_accounts)){
				$check_max_accounts = true;
			}

			if($user->admin == 1){
				$check_expired_date = true;
				$check_max_accounts = false;
			}
		}

		$permissions = (object)array(
			'expired_date'  => $check_expired_date,
			'max_accounts'  => $check_max_accounts,
			"post"          => ($user->admin == 1)? true : get_value($package->permission, "auto_post"),
			"like"          => ($user->admin == 1)? true : get_value($package->permission, "auto_like"),
			"follow"  	    => ($user->admin == 1)? true : get_value($package->permission, "auto_follow"),
			"unfollow"      => ($user->admin == 1)? true : get_value($package->permission, "auto_unfollow"),
			"reweet"        => ($user->admin == 1)? true : get_value($package->permission, "auto_reweet"),
			"direct_messages"        => ($user->admin == 1)? true : get_value($package->permission, "auto_direct_messages"),
			"search"        => ($user->admin == 1)? true : get_value($package->permission, "search_tweet"),
		);
		return $permissions;
	}
}

if (!function_exists("get_permission")) {
	function get_permission($field = "", $uid = ""){
		$CI = &get_instance();
		$check_permission = false;
		if ($uid = "") {
			$uid = session("uid");
		}
		$user  = $CI->model->get("expired_date, package_id, admin, permission", USERS, ["id" => $uid]);

		if (!empty($user)) {
			if ($user->admin == 1) {
				$check_permission = true;
			}else{

				switch ($field) {
					case 'expired_date':
						$today = strtotime(NOW);
						$expired_date = strtotime($user->expired_date);
						if($expired_date > $today){
							$check_permission = true;
						}
						break;

					default:
						$permission = $user->permission;
						switch ($field) {
							case 'max_accounts':
								$max_accounts = get_value($permission, "account");
								$current_accounts   = $CI->model->fetch("*", TWITTER_ACCOUNTS, "uid = '".$uid."'");

								if(!empty($accounts) && (count($current_accounts) >= $max_accounts)){
									$check_permission = true;
								}
								break;
							
							default:
								if (get_value($permission, $field)) {
									$check_permission = true;
								}
								break;
						}
						break;
				}	

			}
		}

		return $check_permission;
	}
}
/**
 *
 * Currency function
 *
 */
if (!function_exists("currency_codes")) {
	function currency_codes(){
		$data = array(
			"AUD" => "Australian dollar",
			"BRL" => "Brazilian dollar",
			"CAD" => "Canadian dollar",
			"CZK" => "Czech koruna",
			"DKK" => "Danish krone",
			"EUR" => "Euro",
			"HKD" => "Hong Kong dollar",
			"HUF" => "Hungarian forint",
			"INR" => "Indian rupee",
			"ILS" => "Israeli",
			"JPY" => "Japanese yen",
			"MYR" => "Malaysian ringgit",
			"MXN" => "Mexican peso",
			"TWD" => "New Taiwan dollar",
			"NZD" => "New Zealand dollar",
			"NOK" => "Norwegian krone",
			"PHP" => "Philippine peso",
			"PLN" => "Polish złoty",
			"GBP" => "Pound sterling",
			"RUB" => "Russian ruble",
			"SGD" => "Singapore dollar",
			"SEK" => "Swedish krona",
			"CHF" => "Swiss franc",
			"THB" => "Thai baht",
			"USD" => "United States dollar",
		);

		return $data;
	}
}

if (!function_exists("currency_format")) {
	function currency_format($number, $number_decimal = ""){
		$decimal = 2;
		if ($number_decimal == "") {
			$decimal = getOption('currency_decimal',"2");
		}else{
			$decimal = $number_decimal;
		}

		$number = number_format($number, $decimal, '.', ',');
		return $number;
	}
}


// check table_exists
if (!function_exists("table_exists")) {
	function table_exists($table_name) {
		$CI = &get_instance();
		$list_tables = $CI->db->list_tables();
		if (!empty($list_tables) && in_array($table_name, $list_tables)) {
			return true;
		}else{
			return false;
		}
	}
}

if(!function_exists("get_client_ip")){
	function get_client_ip() {
	    if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		} else if (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');

			if (strstr($ip, ',')) {
				$tmp = explode(',', $ip);
				$ip = trim($tmp[0]);
			}
		} else {
			$ip = getenv('REMOTE_ADDR');
		}

	    return $ip;
	}
}

if(!function_exists("info_client_ip")){
	function info_client_ip(){
		$result = get_curl("https://timezoneapi.io/api/ip");

		$result = json_decode($result);
		if(!empty($result)){
			return $result;
		}
		return false;
	}
}

function get_location_info_by_ip($ip_address){
	$result = (object)array();
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip_address));    
    if($ip_data && $ip_data->geoplugin_countryName != null){
        $result->country     = $ip_data->geoplugin_countryName;
        $result->timezone    = $ip_data->geoplugin_timezone;
        $result->city        = $ip_data->geoplugin_city;
    }else{
    	$result->country     = 'Unknown';
        $result->timezone    = 'Unknown';
        $result->city        = 'Unknown';
    }
    return $result;
}
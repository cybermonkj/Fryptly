<?php
function ism_return_item($args=array(), $url='', $list_align=''){

	if (isset($args['google_plus_one']) && $args['google_plus_one']==true) return ism_return_googleplusone_str($args, $url, $list_align);
	$str = "";

	/*************** <a> ******************/
	if(isset($args['after_share_id']) && $args['after_share_id']!=''){
		$str .= '<a href="javascript:void(0)" class="ism_link" ';
		$str .= 'onClick="';
		if (isset($args['onClick']) && $args['onClick']!='') {$str .= $args['onClick'];}

		$str .= 'ism_fake_increment(\'.'.$args['sm_class'].'_share_count\', \''.$args['sm_class'].'\', \''.$url.'\');';


		$height = 313;
		$width = 700;
		if(isset($args['custom_height'])) $height = $args['custom_height'];
		if(isset($args['custom_width'])) $width = $args['custom_width'];
		if( $args['link']!='javascript:void(0)' && $args['link']!='' ) $str .= 'ism_open_window(\''.$args['link'].'\', '.$width.', '.$height.', \''.$args['after_share_id'].'\');';
		$str .= '"';//close onClick event
		$str .= '>';

	} else {
		if (isset($args['twitter_href']) && $args['twitter_href']==true) $str .= '<a href="javascript:void(0)" class="ism_link" ';

	    else $str .= '<a href="'.$args['link'].'" class="ism_link" ';

		$str .= 'onClick="';
	    if(isset($args['onClick']) && $args['onClick']!='') $str .= $args['onClick'];

			if ( $args['sm_type']!='subscribe' ){
					$str .= 'ism_fake_increment(\'.'.$args['sm_class'].'_share_count\', \''.$args['sm_class'].'\', \''.$url.'\');';
			}

		if(isset($args['new_window'])){
			$height = 313;
			$width = 700;
	      	if(isset($args['custom_height'])) $height = $args['custom_height'];
		  	if(isset($args['custom_width'])) $width = $args['custom_width'];
		  	if(isset($args['twitter_href']) && $args['twitter_href']==true) $str .= 'return !window.open(\''.$args['link'].'\', \'\', \'width='.$width.',height='.$height.'\');'; #twitter default share
			else $str .= 'return !window.open(this.href, \'\', \'width='.$width.',height='.$height.'\');';
		}
	    $str .= '"';//close onClick event
	    $str .= '>';

	}


	/*************** end of <a> ******************/


	$str .= '<div class="ism_item_wrapper ism-align-'.$list_align.'">';
    $str .= '<div class="ism_item ism_box_'.$args['sm_class'].'">';

    //mobile
    $i_class = '';
    if (isset($args['i_color_class']) && $args['i_color_class']==true){
    	$i_class = ' ism_box_'.$args['sm_class'];
    }

    if (!empty($args['font']) && $args['font']=='socicon'){
    	$str .= '<i class="ism-sc-icon ism-socicon-' . $args['sm_class'] . $i_class . '"></i>';
    } else {
  		$str .= '<i class="fa-ism fa-' . $args['sm_class'] . '-ism' . $i_class . '"></i>';
    }

    if (isset($args['label']) && $args['label']!= '' ){
    	$str .= '<span class="ism_share_label">'.$args['label'].'</span>';
    }

	if (isset($args['display_counts']) ){

    	if (ism_return_min_count_sm($args['sm_class'])){

    		$str .= '<span class="ism_share_counts '.$args['sm_class'].'_share_count" ></span>';

			} else {
			//mobile
			if(isset($args['i_color_class']) && $args['i_color_class']==true){
				$str .= '<span class="mob-count-label">shares</span> ';
			}
				$str .= '<span class="ism_share_counts '.$args['sm_class'].'_share_count">0</span>';
		}
	}

    $str .= '<div class="clear"></div>';
    $str .= '</div>';
		$str .= '</div>';
    $str .= '</a>';

    return $str;
}


function ism_return_googleplusone_str($args, $url, $list_align=''){
	$str = '';
	$str .= '
	<style>
	.ismgplusbutton{
			position:relative;
		}
		#ism_custom_gplus_'.$args['locker_rand'].'{
			margin:0 auto;
			position:absolute;
			width: 100%;
			height: 100%;
			opacity:0;
			text-align:center;
			top:0px;
		}
	</style>
	';


	$str .= '<a href="javascript:void(0)" class="ism_link" onClick="'.$args['onClick'].' ism_fake_increment(\'.google_share_count\', \'google\', \''.$url.'\');">
	<div class="ism_item_wrapper ism-align-'.$list_align.'"">
	<div class="ism_item ism_box_google">
	<i class="fa-ism fa-google-ism"></i>';

if($args['display_full_name']=='true') $str .= '<span class="ism_share_label" >'.$args['label'].'</span>';
if( isset($args['display_counts']) && $args['display_counts']== 'true'){

		if(ism_return_min_count_sm('google'))    $str .= '<span class="ism_share_counts google_share_count"></span>';
			else 	$str .= '<span class="ism_share_counts google_share_count">0</span>';
}


$str .= '	<div class="ismgplusbutton">
		<div id="ism_custom_gplus_'.$args['locker_rand'].'"- >
	<div class="g-plusone" data-size="tall"></div>
	</div>
	</div>
	</div>
	</div>
	</a>
	';

	/* Deprecated */
	/* $str .= '
 	<a href="javascript:void(0)" class="ism_link"  onClick="ism_fake_increment(\'.google_share_count\', \'google\', \''.$url.'\');">
		<div class="ism_item_wrapper ism-align-'.$list_align.'"">
		<div class="ism_item ism_box_google">
		<i class="fa-ism fa-google-ism"></i>';
	if($args['display_full_name']=='true') $str .= '<span class="ism_share_label" >'.$args['label'].'</span>';
	if( isset($args['display_counts']) && $args['display_counts']== 'true'){

if(ism_return_min_count_sm('google'))  $str .= '<span class="ism_share_counts google_share_count"></span>';
		else 	$str .= '<span class="ism_share_counts google_share_count">0</span>';
}
	$str .= '
		<div class="ismgplusbutton">
		<div id="ism_custom_gplus_'.$args['locker_rand'].'"- >
				<div class="g-plusone" data-callback="gpRemoveLocker_'.$args['locker_rand'].'"  data-annotation="none" data-recommendations="false" data-href="'.$args['url'].'"></div>
			 <div class="g-plusone" data-callback="gpRemoveLocker_'.$args['locker_rand'].'"  data-annotation="none" data-recommendations="false" data-href="'.$args['url'].'"></div>
		</div>
	</div>
	<script type="text/javascript">
			gapi.plusone.go("ism_custom_gplus_'.$args['locker_rand'].'");

		function gpRemoveLocker_'.$args['locker_rand'].'(data){
				alert(123);

 			ism_unlock("#indeed_locker_' . $args['locker_rand'] . '", "#indeed_locker_content_' . $args['locker_rand'] . '", "'.$args['url'].'", "'.$args['unlock_type'].'");

		}

	</script>
	<div class="clear"></div>
	</div>
	</div>
	</a>
	'; */
	return $str;

}

function ism_preview_items_be( $arr=array(), $align ){
    $str = '';
    $str .= '<a href="#" class="ism_link">';
    if($align=='vertical') $display = 'block';
    else $display = 'inline-block';
		$str .= '<div class="ism_item_wrapper" style="display: '.$display.'">';
    $str .= '<div class="ism_item ism_box_' . $arr['type'] . '">';
    if($arr['icon']==true) $str .= '<i class="fa-ism fa-' . $arr['type'] . '-ism"></i>';
    if($arr['label']!='') $str .= '<span class="ism_share_label">' . $arr['label'] . '</span>';
    if($arr['count']==true) $str .= '<span class="ism_share_counts ' . $arr['type'] . '_share_count" >' . rand(0,50) . '</span>';
    $str .= '<div class="clear"></div>';
    $str .= '</div>';
	$str .= '</div>';
    $str .= '</a>';
    return $str;
}

function ism_checkSelected($val1, $val2, $type){
    // check if val1 is equal with val2 and return an select attribute for checkbox, radio or select tag
    if($val1==$val2){
        if($type=='select') return 'selected="selected"';
        else return 'checked="checked"';
    }else return '';
}





function ism_check_select_str($haystack, $needle){
    if(strpos($haystack, $needle)!==FALSE) return 'checked="checked"';
    else return '';
}

if (!function_exists('ismStringsAreEqual')):
function ismStringsAreEqual($stringOne='', $stringTwo=''){
		if (strcmp($stringOne, $stringTwo)===0){
				return true;
		}
		return false;
}
endif;

function ism_return_arr( $type ){
	switch($type){
		case 'wd': //website display metas
			$meta_arr = array(
					"wd_list"=>"fb,tw,li,goo",
					"wd_template"=>"ism_template_0",
					"wd_display_counts"=>'false',
					"wd_display_full_name" => 'false',
					"wd_display_where"=>"home,post,page",
					"wd_top_bottom" => "top",
					"wd_top_bottom_value" => 20,
					"wd_top_bottom_type" => "%",
					"wd_left_right" => "left",
					"wd_left_right_value" => 0,
					"wd_left_right_type" => "px",
					"wd_floating" => "yes",
					"wd_list_align" => "vertical",
					"wd_disable_mobile" => 0,
					'wd_animation' => 'none',
					'wd_print_total_shares' => 0,
					'wd_tc_position' => 'after',
					'wd_display_tc_label' => 1,
					'wd_display_tc_sublabel' => 0,
					'wd_tc_theme' => 'dark',
					'wd_ivc_display_views' => 0,
					'wd_ivc_position' => 'before',
					'wd_ivc_sublable_on' => 1,
					'wd_ivc_theme' => 'dark',
					'wd_after_share_enable' => 0,
					'wd_after_share_title' => 'Thanks for Sharing',
					'wd_after_share_content' => '',
			);
		break;

		case 'id': //inside display metas
			$meta_arr = array(
					"id_list"=>"fb,tw,li,goo,pt,dg,tbr,su,vk,rd,dl,wb,xg,pf,email",
					"id_template"=>"ism_template_0",
					"id_display_counts"=>'true',
					"id_display_where"=>"",
					"id_display_full_name" => 'true',
					"id_list_align" => "horizontal",
					"id_position" => "before",
					"id_top_bottom" => "top",
					"id_top_bottom_value" => 20,
					"id_left_right" => "left",
					"id_left_right_value" => 20,
					"id_disable_mobile" => 0,
					'id_animation' => 'none',
					'id_no_cols' => 0,
					'id_box_align' => 'left',
					'id_print_total_shares' => 0,
					'id_tc_position' => 'after',
					'id_display_tc_label' => 1,
					'id_display_tc_sublabel' => 0,
					'id_tc_theme' => 'dark',
					'id_ivc_display_views' => 0,
					'id_ivc_position' => 'before',
					'id_ivc_sublable_on' => 1,
					'id_ivc_theme' => 'dark',
					'id_after_share_enable' => 0,
					'id_after_share_title' => 'Thanks for Sharing',
					'id_after_share_content' => '',
					'id_display_only_in_single' => 0,
			);
		break;

		case 'g_o': //general options metas
			$meta_arr = array(
					'twitter_name' => '',
					'ism_twitter_share_img' => 0,
					'facebook_id' => '',
					'facebook_app_secret'	=> '',
					'feat_img' => ISM_DIR_URL . 'files/images/wordpress-logo.png',
					'email_box_title' => 'Share This Page',
					'email_subject' => 'Take a look on this page #LINK#',
					'email_message' => "I've found something very interesting here.
Check the next link: #LINK#",
					'email_capcha' => 0,
					'email_send_copy' => '',
					'email_success_message' => 'Thank You!',
					'ism_url_type' => 'url',
					'ism_check_counts_everytime' => 0,
					'ism_enable_statistics' => 1, /// set always @ 1
					'ism_general_sm_labels' => '',
					'ism_tc_label' => 'Total',
					'ism_tc_sublabel' => 'Shares',
					'ism_order' => array(),
					'ism_flattr_uid' => '',
					'ism_display_statistics_c_for_nci' => 1,//0
					'ism_enable_vc_locker' => 1,
					'bitly_user' => '',
					'bitly_api' => '',
					'ism_twitter_shortlink' => 0,
					'ism_general_custom_css' => '',
			);
		break;

		case 'md': //mobile display metas
			$meta_arr = array(
				"md_list" => "fb,tw,li,goo,pt,dg,tbr,su,vk,rd,dl,wb,xg,pf,email",
				"md_template" => "ism_template_0",
				"md_display_counts" => 'false',
				"md_display_full_name" => 'false',
				"md_display_where" => "home,post,page",
				"md_floating" => "yes",
				"md_list_align" => "horizontal",
				"md_top_bottom" => "top",
				"md_top_bottom_value" => 20,
				"md_top_bottom_type" => "%",
				"md_left_right" => "left",
				"md_left_right_value" => 0,
				"md_left_right_type" => "px",
				"md_predefined_position" => 'bottom',
				"md_zoom" => 1,
				"md_opacity" => 1,
				"md_custom_position" => 0,
				"md_pred_position" => 1,
				"md_behind_bk" => 0,
				"md_mobile_special_template" => '',
				'md_print_total_shares' => 0,
				'md_tc_position' => 'after',
				'md_display_tc_label' => 1,
				'md_display_tc_sublabel' => 0,
				'md_tc_theme' => 'dark',
				'md_ivc_display_views' => 0,
				'md_ivc_position' => 'before',
				'md_ivc_sublable_on' => 1,
				'md_ivc_theme' => 'dark',
				'md_after_share_enable' => 0,
				'md_after_share_title' => 'Thanks for Sharing',
				'md_after_share_content' => '',
			);
		break;

		case 's_in':
			$meta_arr = array(
								's_in_list' => 'fb,tw,li,goo,pt',
								's_in_template' => 'ism_template_2',
								's_in_list_align' => 'horizontal',
								's_in_display_counts' => 'true',
								's_in_display_full_name' => 'true',
								's_in_no_cols' => 0,
								's_in_box_align' => 'center',
								's_in_display_where' => '',
								's_in_top_bottom' => 'bottom',
								's_in_top_bottom_value' => 2,
								's_in_top_bottom_type' => 'px',
								's_in_left_right' => 'right',
								's_in_left_right_value' => 2,
								's_in_left_right_type' => 'px',
								's_in_width' => 310,
								's_in_padding' => 25,
								's_in_slide_type' => 'down',
								's_in_show_up' => 'scroll_middle',
								's_in_show_once' => 0,
								's_in_delay' => 0,
								's_in_slide_duration' => 0,
								's_in_title' => 'Share this Page',
								's_in_above_content' => 'Slide-In Box help you to share the page on the perfect time',
								's_in_bellow_content' => '',
								's_in_custom_css' => '.ism_slide_box{
															}
															.ism_slide_box .ism_top_side_slide{
															}
															.ism_slide_box .ism_close_popup_slide{
															}
															.ism_slide_box .ism_popup_above_content_slide{
															color:#999 !important;
															}
															.ism_slide_box .ism_popup_below_content_slide{
															}
															',
								's_in_disable_mobile' => 1,
								's_in_print_total_shares' => 0,
								's_in_tc_position' => 'after',
								's_in_display_tc_label' => 1,
								's_in_display_tc_sublabel' => 0,
								's_in_tc_theme' => 'dark',
								's_in_ivc_display_views' => 0,
								's_in_ivc_position' => 'before',
								's_in_ivc_sublable_on' => 1,
								's_in_ivc_theme' => 'dark',

								's_in_after_share_enable' => 0,
								's_in_after_share_title' => 'Thanks for Sharing',
								's_in_after_share_content' => '',
							  );
		break;

		case 'popup':
			$meta_arr = array(
								'popup_list' => 'fb,tw,li,goo,pt,vk,email',
								'popup_template' => 'ism_template_3',
								'popup_list_align' => 'horizontal',
								'popup_display_counts' => 'true',
								'popup_display_full_name' => 'true',
								'popup_no_cols' => 0,
								'popup_box_align' => 'center',
								'popup_display_where' => '',
								'popup_top_bottom_value' => 20,
								'popup_top_bottom_type' => '%',
								'popup_left_right' => 'right',
								'popup_left_right_value' => 0,
								'popup_left_right_type' => 'px',
								'popup_width' => 600,
								'popup_height' => 230,
								'popup_padding' => 20,
								'popup_show_effect' => 'fadeIn',
								'popup_show_up' => 'leave',
								'popup_show_once' => 1,
								'popup_delay' => 0,
								'popup_slide_duration' => 0,
								'popup_title' => 'Share this Page',
								'popup_above_content' => 'PopUp Share can help you to share the page when the user wants to leave the page',
								'popup_bellow_content' => '',
								'popup_custom_css' => '.ism_popup_box{
														}
														.ism_popup_box  .ism_top_side{
														}
														.ism_popup_box  .ism_close_popup{
														}
														.ism_popup_box .ism_popup_above_content{
														color:#999 !important;
														}
														.ism_popup_box  .ism_popup_below_content{
														}
														',
								'popup_disable_mobile' => 1,
								'popup_print_total_shares' => 0,
								'popup_tc_position' => 'after',
								'popup_display_tc_label' => 1,
								'popup_display_tc_sublabel' => 0,
								'popup_tc_theme' => 'dark',
								'popup_ivc_display_views' => 0,
								'popup_ivc_position' => 'before',
								'popup_ivc_sublable_on' => 1,
								'popup_ivc_theme' => 'dark',
								'popup_after_share_enable' => 0,
								'popup_after_share_title' => 'Thanks for Sharing',
								'popup_after_share_content' => '',
							  );
		break;
		case 'genie':
			$meta_arr = array(
					'genie_list' => 'fb,tw,goo,pt,li,dg,tbr,su,vk,rd,dl,wb,xg,pf,email,ok',
					'genie_template' => 'ism_template_point_1',
					'genie_list_align' => 'horizontal',
					'genie_display_counts' => 'true',
					'genie_display_full_name' => 'true',
					'genie_no_cols' => 0,
					'genie_box_align' => 'left',
					'genie_display_where' => '',
					'genie_top_bottom' => 'bottom',
					'genie_top_bottom_value' => 3,
					'genie_top_bottom_type' => '%',
					'genie_left_right' => 'right',
					'genie_left_right_value' => 3,
					'genie_left_right_type' => '%',
					'genie_show_up' => 'on_load',
					'genie_custom_css' => '',
					'genie_disable_mobile' => 1,
					'genie_print_total_shares' => 0,
					'genie_tc_position' => 'after',
					'genie_display_tc_label' => 1,
					'genie_display_tc_sublabel' => 0,
					'genie_tc_theme' => 'dark',
					'genie_ivc_display_views' => 0,
					'genie_ivc_position' => 'before',
					'genie_ivc_sublable_on' => 1,
					'genie_ivc_theme' => 'dark',
					'genie_after_share_enable' => 0,
					'genie_after_share_title' => 'Thanks for Sharing',
					'genie_after_share_content' => '',
					'genie_icon_color' => '#00ABF0',
					'genie_icon_image' => '',
					'genie_fa_icon' => 'fa-genie fa-share-alt-genie',
					'genie_icon_theme' => 'genie-fa-light',
					'genie_movable' => 1,
					'genie_close_bttn' => 1,
					'genie_dont_show_time' => '0',
					'genie_title' => 'Share On',
					'genie_above_content' => '',
					'genie_bellow_content' => '',
					);
		break;


	}
    return $meta_arr;
}

function ism_return_arr_val( $type ){

    $meta_arr = ism_return_arr( $type );
    foreach($meta_arr as $k=>$v){
        if( get_option( $k )===FALSE ) add_option($k, $v);
        else $meta_arr[$k] = get_option($k);
    }
    if(function_exists('indeed_custom_args_for_social')){
    	$meta_arr = indeed_custom_args_for_social($meta_arr, $type);
    }
    return $meta_arr;
}

function ism_return_arr_update( $type ){
    $wd_meta_arr = ism_return_arr( $type );

    foreach($wd_meta_arr as $k=>$v){
    	if(isset($_REQUEST[$k])){
    		if(get_option($k)===FALSE) add_option($k, $_REQUEST[$k]);
    		else update_option($k, $_REQUEST[$k]);
    	}
    }
}



function check_arr_for_prefix($arr, $prefix){
	$return_arr = FALSE;
	foreach($arr as $value){
		if(strpos($value, $prefix)!==FALSE){
			//it has the prefix
			$return_arr[] = str_replace($prefix, '', $value);
		}
	}
	return $return_arr;
}

function ism_return_post_types(){
    $post_types = array(
                   'home' => 'Home',
                   'post' => 'Post',
                   'page' => 'Page',
                   'cat' => 'Categories',
                   'tag' => 'Tags',
                   'archive' => 'Archives',
    			   'bp_group' => 'BuddyPress Group <span class="ism-info-inline">(Custom Post Type)</span>',
    			   'bp_activity' => 'BuddyPress Activity <span class="ism-info-inline">(Custom Post Type)</span>',
    		       'bp_members' => 'BuddyPress Members <span class="ism-info-inline">(Custom Post Type)</span>',
    			   'product' => 'Woo/JigoShop Products <span class="ism-info-inline">(Custom Post Type)</span>',
    );
    return $post_types;
}



function ism_remove_arr_prefix( $arr, $prefix ){
    $temp_arr = array();
    foreach( $arr as $k=>$v ){
        $new_k = str_replace( $prefix, '',$k );
        $temp_arr[$new_k] = $v;
    }
    $arr = $temp_arr;
    return $arr;
}



function ism_return_description($str, $num_words){
    $return = $str;
    $arr = explode(" ", $str);
    if (count($arr)<=$num_words){
        $return = $str;
    }
    else{
        array_splice($arr, $num_words);
        $return = implode(" ", $arr) . " ...";
    }
    return $return;
}

function ism_capcha_q( $k ){
    $arr = array(
                    91 => "2+3-1",
                    92 => "10-9+1",
                    93 => "0+1+2",
                    94 => "1+2*3",
                    95 => "1*2+2"
                );
    return $arr[$k];
}

function ism_capcha_a( $k ){
    $arr = array(
                    91 => 4,
                    92 => 2,
                    93 => 3,
                    94 => 7,
                    95 => 4
                );
    return $arr[$k];
}

function ism_return_templates(){
    //default templates 1-10
    for($i=1;$i<11;$i++){
        $t_arr["ism_template_".$i] = "Template ".$i;
    }
    $templates_dir = ISM_DIR_PATH . 'templates/' ;
    if(is_readable($templates_dir)){
        if ($handle = opendir( $templates_dir )) {
            while (false !== (@$entry = readdir($handle))) {
                if(strpos($entry, '.')>1){
                    $ism_content_file = file_get_contents( $templates_dir . $entry );
                    $templ_arr = explode('#INDEED_TEMPLATES#', $ism_content_file);
                    if(isset($templ_arr[1])){
                        $templ = (array)json_decode($templ_arr[1]);
                         $t_arr = array_merge($t_arr, $templ);
                    }
                }
            }
        }
    }
    return $t_arr;
}

function ism_enqueue_additional_templates(){
	$i = 0;
    $plugins_arr = array('indeed-social-media', 'indeed-share-mega-theme');//list of plugins where to search for template files
    foreach($plugins_arr as $name){
    	$plugin_dir = '';
    	if($name=='indeed-social-media'){
    		$plugin_dir = ISM_DIR_PATH;
    	}else{
    		$plugin_dir = str_replace('indeed-social-media', $name, ISM_DIR_PATH );
    	}
    	$plugin_dir .= 'templates/';

    	if(is_readable($plugin_dir)){
    		if ($handle = opendir( $plugin_dir )) {
    			while (false !== (@$entry = readdir($handle))) {
    				if(strpos($entry, '.')>1){
    					if($name=='indeed-social-media'){
    						$url = ISM_DIR_URL;
    					}else{
    						$url = str_replace('indeed-social-media', $name, ISM_DIR_URL);
    					}
    					$url .= 'templates/';
    					wp_enqueue_style ( 'ism_additional_template_' . $i, $url . $entry  );
    					$i++;
    				}
    			}
    		}
    	}
    }
}

function ism_get_data_from_url( $url, $timeout=1, $check_fgc=false ) {
	//$check_fgc - check file get contents
	$data = 0;
	if (in_array( 'curl', get_loaded_extensions() )){
		///////////////////CURL
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		@$data = curl_exec($ch);
		curl_close($ch);
		if($data) return $data;
	} else{
		//if curl is not installed go and check with file_get_contents
		$check_fgc = true;
	}
	if (function_exists('file_get_contents') && $check_fgc){
		////////////////FILE GET CONTENTS
		@$data = file_get_contents( $url );

	}
	return $data;
}

function ism_return_pinterest_popup(){
	?>
		<div class="popup_wrapp" id="popup_box">
		    <div class="the_popup">
		            <div class="popup_top pinterest_popup">
		                <div class="title">Share On Pinterest</div>
		                <div class="close_bttn" onclick="closePopup();"></div>
		                <div class="clear"></div>
		            </div>
		            <div class="popup_content">
		            	<div>Select Image:</div>
		            	<?php
		            		$j = 0;
		            		if(isset($_REQUEST['ism_images']) && count($_REQUEST['ism_images'])>0){
			            		foreach($_REQUEST['ism_images'] as $image){
			            			?>
			            				<div class="ism_pinterest_popup_wrap_img">
			            					<img src="<?php echo $image;?>" class="popup_mini_img" id="ism_pin_img_<?php echo $j;?>" onClick="pinterest_select_img(this);"/>
			            				</div>
			            			<?php
			            			$j++;
			            		}
		            		}
		            	?>
		            	<input type="hidden" value="<?php echo $_REQUEST['other_info'];?>" id="pin_hide_info"/>
		            	<div class="clear"></div>
		            </div>
		    </div>
		</div>
	<?php
}

function ism_return_pinterest_popup_after_action(){
	?>
			<div class="popup_wrapp" id="popup_box">
			    <div class="the_popup">
			            <div class="popup_top pinterest_popup">
			                <div class="title">Share On Pinterest</div>
			                <div class="close_bttn" onclick="closePopup();"></div>
			                <div class="clear"></div>
			            </div>
			            <div class="popup_content">
			            	<div>Select Image:</div>
			            	<?php
			            		$j = 0;
			            		if(isset($_REQUEST['ism_images']) && count($_REQUEST['ism_images'])>0){
				            		foreach($_REQUEST['ism_images'] as $image){
				            			?>
											<div class="ism_pinterest_popup_wrap_img">
				            				<img src="<?php echo $image;?>" class="popup_mini_img" id="ism_pin_img_<?php echo $j;?>" onClick="pinterest_select_img_afterAction(this, '<?php echo $_REQUEST['after_data_a'];?>');"/>
				            				</div>
										<?php
				            			$j++;
				            		}
			            		}
			            	?>
			            	<input type="hidden" value="<?php echo $_REQUEST['other_info'];?>" id="pin_hide_info"/>
			            	<div class="clear"></div>
			            </div>
			    </div>
			</div>
		<?php
}

function ism_test_special_counts($sm_type, $url){
	$count = 0;
	if( get_option('ism_special_count_'.$sm_type)!==FALSE ){
		$arr = get_option('ism_special_count_'.$sm_type);
		if(isset($arr[$url]) && $arr[$url]!=''){
			$count = (int)$arr[$url];
		}
	}
	if( $count==0 && get_option('ism_special_count_all')!==FALSE ){
		$arr = get_option('ism_special_count_all');
		if(isset($arr[$sm_type]) && $arr[$sm_type]!=''){
			$count = (int)$arr[$sm_type];
		}
	}
	return $count;
}

function ism_update_special_counts(){
	$_REQUEST['the_url'] = str_replace(' ', '', $_REQUEST['the_url']);
	if($_REQUEST['the_url']=='all' || $_REQUEST['the_url']=='All'){
		if(get_option('ism_special_count_all')!==FALSE){
			$arr = get_option('ism_special_count_all');
			$arr[$_REQUEST['sm_type']] = $_REQUEST['the_counts'];
			update_option('ism_special_count_all', $arr);
		}else{
			add_option('ism_special_count_all', array($_REQUEST['sm_type']=>$_REQUEST['the_counts']));
		}
	}else{
		if(get_option('ism_special_count_'.$_REQUEST['sm_type'])!==FALSE){
			$arr = get_option('ism_special_count_'.$_REQUEST['sm_type']);
			$arr[$_REQUEST['the_url']] = $_REQUEST['the_counts'];
			update_option('ism_special_count_'.$_REQUEST['sm_type'], $arr);
		}else{
			add_option('ism_special_count_'.$_REQUEST['sm_type'], array($_REQUEST['the_url']=>$_REQUEST['the_counts']));
		}
	}
}

function ism_return_special_counts($type){
	if($type=='all'){
		if(get_option('ism_special_count_all')!==FALSE){
			return get_option('ism_special_count_all');
		}
	}else{
		if(get_option('ism_special_count_'.$type)!==FALSE){
			return get_option('ism_special_count_'.$type);
		}
	}
}

function ism_return_min_count_sm($sm){
	@$arr = get_option('ism_min_count');

	if(isset($arr[$sm]) && $arr[$sm]!='') return $arr[$sm];

	else return FALSE;
}
function ism_add_timeout($content_id, $locker_id, $timeout){
	if($timeout!=FALSE && $timeout!=''){
		return '<script>
					jQuery(document).ready(function(){
						var ism_delaylocker = new ism_the_TimeOut('.$timeout.', "#'.$content_id.'", "'.$locker_id.'");
					});
				</script>';
	}
}

function ism_return_reset_after($reset, $type, $url, $str){
	if($type=='hours') $m = 60;//minutes in hour
	elseif($type=='days') $m = 1440;//minutes in day
	elseif($type=='minutes') $m = 1;//one minute

	$reset_after = $reset * $m * 60;//seconds
	$str .= "<script>
				old_time = jQuery.jStorage.get('{$url}');
				if(old_time){
					current_time = ism_return_current_date();
					locker_reset_after = {$reset_after};
					end_time = old_time + locker_reset_after;
					if(current_time>=end_time){
						jQuery.jStorage.set('{$url}', '');
						jQuery.jStorage.deleteKey('{$url}');
					}
				}
			</script>";
	return $str;
}

function ism_is_mobile(){
	$mobile_devices = "/Mobile|Android|BlackBerry|iPhone|iPad|Windows Phone/";
	if(preg_match($mobile_devices, $_SERVER['HTTP_USER_AGENT'])) return TRUE;
	else return FALSE;
}

function ism_return_current_url(){
	//permalink or url
	global $post;
	$url_type = get_option('ism_url_type');
	if(isset($url_type) && $url_type=='permalink') $url = get_permalink();
	else $url = ISM_PROTOCOL . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	return $url;
}

function ism_return_post_title(){
	//return post title
	global $post;
	if($post!=FALSE){
		$post_title = get_the_title();
		$post_title = html_entity_decode($post_title);
		if(strpos($post_title, '&rsquo;')!==FALSE) $post_title = str_replace('&rsquo', "'", $post_title);
		if(strpos($post_title, '&#8217;')!==FALSE) $post_title = str_replace('&#8217;', "'", $post_title);
		if(strpos($post_title, '&#8216;')!==FALSE) $post_title = str_replace('&#8216;', "'", $post_title);
		if(strpos($post_title, '&#8221;')!==FALSE) $post_title = str_replace('&#8221;', '"', $post_title);
		$post_title = rawurlencode($post_title);
		return $post_title;
	}
	return '';
}

function ism_return_post_description(){
	//post description
	global $post;
	if($post!=FALSE){
		$description = strip_shortcodes(get_the_content());
		$description = str_replace(array("\n", "\r"), '', strip_tags(addslashes($description)));
		$description = ism_return_description($description, 50);
		return $description;
	}
	return '';
}

function ism_format_like_post_description($description){
	$description = str_replace(array("\n", "\r"), '', strip_tags(addslashes($description)));
	$description = ism_return_description($description, 50);
	return $description;
}

function ism_return_feat_image($meta_arr){
	//feat image of #ISI_IMG#, tag that will be replace with current image
	global $post;
	@$feature_img_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ));
	if(isset($feature_img_arr[0]))$feat_img = $feature_img_arr[0];
	else{
		@$feat_img = get_option('feat_img');
		if( $feat_img===FALSE ) $feat_img = "";
	}
	//////ISI share image
	if(isset($meta_arr['ISI_image']) && $meta_arr['ISI_image']==TRUE){
		$feat_img = '#ISI_IMG#';
	}
	return $feat_img;
}

function ism_display_counts_js($ismitems_arr, $url, $indeed_wrap_id, $print_the_counts='false', $fc_arr=false){
	#return string with javascript function to load the counts

	if(!$ismitems_arr && !$fc_arr) return;

	$js = '';
	$print = 0;
	if ($print_the_counts=='true') $print = 1;


	if(isset($ismitems_arr) && count($ismitems_arr)>0){
		$ismItems = implode(',', $ismitems_arr);

		if(isset($ismItems) && $ismItems!=''){
			$js .= 'jQuery(document).ready(function(){';//start
			/***************** LOAD COUNTS ********************/
			$js .= 'items_str = "'.$ismItems.'";

			items_arr = items_str.split(",");';
			$check_everytime = get_option('ism_check_counts_everytime');

			if($check_everytime===FALSE){
				$h_arr = ism_return_arr('g_o');
				if(isset($h_arr['ism_check_counts_everytime']))	$check_everytime = $h_arr['ism_check_counts_everytime'];
			}
			if(isset($check_everytime) && $check_everytime==0){

				////////////////////FROM OUR DB
				$js .= '

				ism_load_counts_from_db(items_arr, \''.$url.'\', \'#'.$indeed_wrap_id.'\', '.$print.');
				ism_save_share_counts = 1;
				';

			}else{
				//////////////////DEFAULT: FROM SERVER
				$js .= '
				ism_load_counts(0, \''.$url.'\', \'#'.$indeed_wrap_id.'\', items_arr, '.$print.');
				';
				//$js .= ism_get_share_counts_from_server($url, $_REQUEST['sm_list'] );

			}
			$js .= '});';//end
		}
	}

	if($fc_arr){

		//counts for items with no counts
		$items = implode(',', $fc_arr);
		$js .= 'jQuery(document).ready(function(){
					fc_items_str = "'.$items.'";
					fc_items_arr = fc_items_str.split(",");
					var tempKey = fc_items_arr.indexOf("google_plus")
					if (tempKey>-1){
						fc_items_arr[tempKey] = "google";
						console.log(fc_items_arr);
					}
					ism_load_statistics_counts(fc_items_arr, \''.$url.'\', \'#'.$indeed_wrap_id.'\', '.$print.');
			  });';
	}

	return $js;

}

function ism_special_mobile_template($html_arr, $sm_num_count, $template, $url, $indeed_wrap_id, $meta_arr){
	$html = '';

	//total counts
	$html_before_loop = '';
	$html_after_loop = '';
	if(isset($meta_arr['print_total_shares']) && $meta_arr['print_total_shares']==1 ){
		if($meta_arr['tc_position']=='before'){
			$html_before_loop .= '<div class="ism_mobile_h_item">'.print_total_shares_html($meta_arr, '').'</div>';
		}else{
			$html_after_loop .= '<div class="ism_mobile_h_item">'.print_total_shares_html($meta_arr, '').'</div>';
		}
	}

	//total views
	if(function_exists('ispv_print_total_views')){
		if(isset($meta_arr['ivc_display_views']) && $meta_arr['ivc_display_views']==1){
			$ipsv_count = ispv_return_views_number($url);
			if($ipsv_count !== FALSE){
				if($meta_arr['ivc_position']=='before'){
					$html_before_loop .= '<div class="ism_mobile_h_item">'.ispv_print_total_views($meta_arr, '', $ipsv_count).'</div>';
				}else{
					$html_after_loop .= '<div class="ism_mobile_h_item">'. ispv_print_total_views($meta_arr, '', $ipsv_count).'</div>';
				}
			}
		}
	}

	switch($template){
		case 'ism_template_mob_1':
			# MOBILE 1
			if(isset($sm_num_count) && $sm_num_count>4){
				$hidden_html = array();
				$visible_html = '';
				$i = 0;
				foreach($html_arr as $k=>$v){
					if($i>2){
						$v['i_color_class'] = true;
						$hidden_html[] = ism_return_item($v, $url);
					}
					else{
						unset($v['display_counts']);
						unset($v['label']);
						$visible_html .= ism_return_item($v, $url);
					}
					$i++;
				}
				$html .= '<div class="ism_mobile-items_hidden" style="display: none;" id="ism_hidden_popup_sm" ><div class="top-share">Share On</div>';

					$html .= $html_before_loop;
				foreach($hidden_html as $val){
					$html .= '<div class="ism_mobile_h_item">'.$val.'</div>';
				}
					$html .= $html_after_loop;

				$html .= '</div>';
				$html .= '<div class="ism_mobi-parent_visible">'.$visible_html;
				$html .= '<div class="ism_item_wrapper mobi-more" onClick="ismMobilePopup(\'#ism_hidden_popup_sm\', \'down\');"></div>'; #read more special button
				$html .= '</div>';
			}else{
				foreach($html_arr as $val){
					unset($val['display_counts']);
					unset($val['label']);
					$html .= ism_return_item($val, $url);
				}
			}
		break;
		case 'ism_template_mob_2':
	   		# MOBILE 2
	   		$html .= '<div class="ism_mobile-items_hidden" style="display: none;" id="ism_hidden_popup_sm" ><div class="top-share">Share On</div>';

				$html .= $html_before_loop;
			foreach($html_arr as $k=>$v){
	   			$v['i_color_class'] = true;
	   			$html .= '<div class="ism_mobile_h_item">'.ism_return_item($v, $url).'</div>';
	   		}
		   		$html .= $html_after_loop;

	   		$html .= '</div>';
	   		$html .= '<div class="mobi-more" onClick="ismMobilePopup(\'#ism_hidden_popup_sm\', \'down\');"><img src="'.ISM_DIR_URL.'/files/images/share_ics_icon.png" /> Share On</div>';
		break;
		case 'ism_template_mob_3':
			# MOBILE 3
			$html .= '<div class="ism_mobile-items_hidden" id="ism_hidden_popup_sm" >';

				$html .= $html_before_loop;
			foreach($html_arr as $k=>$v){
				unset($v['display_counts']);
				unset($v['label']);
				$v['i_color_class'] = true;
				$html .= '<div class="ism_mobile_h_item">'.ism_return_item($v, $url).'</div>';
			}
				$html .= $html_after_loop;

			$html .= '</div>';
			$html .= '<div class="mobi-more" onClick="ismMoveDiv(\'#'.$indeed_wrap_id.'\');"><img src="'.ISM_DIR_URL.'/files/images/share_ics_icon_3.png" /></div>';
		break;
	}
	wp_enqueue_script('jquery-ui-effects');//adding jquery ui for ismMoveDiv to work
	return $html;
}

function check_mobile_os() {

$software_opt = $_SERVER['HTTP_USER_AGENT'];

if ( strpos($software_opt, 'Android') !== false )
 	{
		return $sign = "?";
 	}
 elseif ( strpos($software_opt, 'iOS') !== false )
 	{
		return $sign = "&";
 	}
}


function ism_return_sm_arr_ready($meta_arr, $attr){
	//labels
	$ism_list = ism_return_general_labels_sm('', false, '');//ism_return_general_labels_sm( $type='long_keys', $exculde_plusone = true, $only = '' )
	$html = '';
	$ismitems_arr = array();
	$fc_arr = array();

	if (empty($meta_arr['unlock_type'])){
		$meta_arr['unlock_type'] = 1;
	}

	if ($meta_arr['display_full_name']==1){
		$meta_arr['display_full_name'] = 'true';
	}
	if ($meta_arr['display_counts']==1){
		$meta_arr['display_counts'] = 'true';
	}

	$attr['url'] = ism_affiliate_filter_url($attr['url']);///affiliate

	/************************* SOCIAL MEDIA ITEMS *************************/
	//facebook
	$ourSocialListItems = explode(',', $meta_arr['list']);

	//if (strpos($meta_arr['list'], 'fb')!==FALSE){
	if (in_array('fb', $ourSocialListItems)){
		$key = 'fb';
		$long_key = $ism_list[$key]['long_key'];

		$fb_rand = rand(1, 5000);
		$html .= '<div id="fb_desc-'.$fb_rand.'" data-ism_description="'.$attr['description'].'" style="display: none;"></div>';
		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'javascript:void(0)';
		$fb_id = get_option('facebook_id');

		if ($fb_id!=false && $fb_id!=''){
			if (!defined('ISM_FB_APP_ID')){
				wp_localize_script( 'ism_front_end_f', 'ism_facebook_id', $fb_id );
				define('ISM_FB_APP_ID', 1);

			}
			if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
				//action after share
		
				$args['onClick'] = 'shareOnFacebook_afterAction( \''.$attr['post_title'].'\', \''.$attr['url'].'\', \''.$attr['feat_img'].'\', \'#fb_desc-'.$fb_rand.'\', \''.$attr['after_share_id'].'\', \'' . $meta_arr['unlock_type'] . '\' );';
				$args['after_share_id'] = $attr['after_share_id'];
			} else {
				//no action after
				$args['onClick'] = 'shareOnFacebook( \''.$attr['post_title'].'\', \''.$attr['url'].'\', \''.$attr['feat_img'].'\', \''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \'#fb_desc-'.$fb_rand.'\', \'' . $meta_arr['unlock_type'] . '\' );';
			}
		} else {
			if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
				//action after share
				$args['onClick'] = 'shareFacebookWI_afterAction(\''.$attr['url'].'\',\''.$attr['post_title'].'\', \'#fb_desc-'.$fb_rand.'\', \''.$attr['after_share_id'].'\', \'' . $meta_arr['unlock_type'] . '\');';
				$args['after_share_id'] = $attr['after_share_id'];
			} else {
				//no action after
				//$args['onClick'] = 'shareFacebookWI(\''.$attr['url'].'\',\''.$attr['post_title'].'\', \''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \'#fb_desc-'.$fb_rand.'\', \'' . $meta_arr['unlock_type'] . '\');';
				$args['onClick'] = 'shareFacebookWithoutI(\''.$attr['url'].'\',\''.$attr['post_title'].'\', \''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \'#fb_desc-'.$fb_rand.'\', \'' . $meta_arr['unlock_type'] . '\');';
			}
		}
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];//'Facebook';
		if($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}
		/*if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		} */

		$ismitems_arr[] = $long_key;
		$html_arr[ $long_key ] = $args;
	}


	//twitter
	//if(strpos($meta_arr['list'], 'tw')!==FALSE){
		if (in_array('tw', $ourSocialListItems)){
		$key = 'tw';
		$long_key = $ism_list[$key]['long_key'];

        if(isset($args)) unset($args);
        $args = array();
        @$twitter_name = get_option('twitter_name');

        if(isset($attr['locker_div_id']) && $attr['locker_div_id']!='0'){

        	if(isset($attr['twitter_unlock_onclick']) && $attr['twitter_unlock_onclick']==1 && ism_is_mobile() ){
        		//unlock on Click
	      		//$args['link'] = 'https://twitter.com/intent/tweet?text='.$attr['post_title'].' '.ism_bilty_shorturl( $attr['url'] );
	        	$args['new_window'] = true;
	        	$args['twitter_href'] = true;
        		$args['onClick'] = 'ism_unlock_on_c(\''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \''. $attr['url'] .'\', \'' . $meta_arr['unlock_type'] . '\');';
						}else{

        		//the real locker goes here
        		/********************* LOCKER **********************/
        		/*
        		if(!defined('ISM_TW_SET')){
        			wp_localize_script( 'ism_front_end_f', 'ism_twitter_set', '1' );
        			wp_enqueue_script('ism_twitter');
        			define('ISM_TW_SET', 1);
        		}
        		$args['link'] = 'https://twitter.com/intent/tweet?text='.$attr['post_title'].' '.ism_bilty_shorturl( $attr['url'] );
        		$args['onClick'] = 'setIds(\''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \''. $attr['url'] .'\', \'' . $meta_arr['unlock_type'] . '\' );';
        		*/

        		$args['link'] = 'javascript:void(0)';

        		$args['onClick'] = 'ism_general_locker(\''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \'' . $meta_arr['unlock_type'] . '\', \'tw\', \''.ism_bilty_shorturl($attr['url']).'\', \'' . $attr['feat_img'] . '\', \'' . $attr['post_title'] . '\', \'' . $attr['description'] . '\');';


					}
        } else {
        	/****************** WIDHOUT LOCKER ***********/
        	$args['link'] = 'https://twitter.com/intent/tweet?text='.$attr['post_title'].' '.ism_bilty_shorturl( $attr['url'] );
        	$args['new_window'] = true;
        	$args['twitter_href'] = true;
        	$args['onClick'] = '';
        	if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
        		$args['after_share_id'] = $attr['after_share_id'];
        	}
        }

        if( isset($twitter_name) && $twitter_name!='' ) $args['link'] .= ' %40'.$twitter_name;
        $args['sm_type'] = $key;
        $args['sm_class'] = $long_key;
        if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];//'Twitter';

        ////////////// for the moment twitter decide not to show the share counts, so we use counts from statistics
        if (!empty($meta_arr['ism_display_statistics_c_for_nci'])){
        	$fc_arr[] = $long_key;////////// TWITTER OFFLINE COUNTS
        	if ($meta_arr['display_counts']=='true'){
        		$args['display_counts'] = true;
        	}
        }
		$ismitems_arr[] = $long_key;
		$html_arr[ $long_key ] = $args;
	}

	//google plus
	//if(strpos($meta_arr['list'], 'goo')!==FALSE){
		if (in_array('goo', $ourSocialListItems)){
		$key = 'goo';
		$long_key = $ism_list[$key]['long_key'];

		if (isset($args)) unset($args);
		$args = array();
		$args['link'] = 'https://plus.google.com/share?url='.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		$args['onClick'] = '';
		if ($meta_arr['display_full_name']=='true'){
			$args['label'] = $ism_list[$key]['label'];//'Google+';
		}
	/*if ($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}*/
		if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}

		/*if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if ($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		} */
		$ismitems_arr[] = $long_key;
		$html_arr[ $long_key ] = $args;
}

	//google +1button  ############## AVAILABLE ONLY IN LOCKER #################
//	if (strpos($meta_arr['list'], 'go1')!==FALSE){
		if (in_array('go1', $ourSocialListItems)){
		$key = 'go1';
		$args['google_plus_one'] = true;

		$long_key = $ism_list[$key]['long_key'];
		$args['locker_rand'] = $attr['locker_rand'];
		$args['display_counts'] = $meta_arr['display_counts'];
		$args['display_full_name'] = $meta_arr['display_full_name'];

		if ($meta_arr['display_full_name']=='true'){
			$args['label'] = $ism_list['go1']['label'];
		}
		$args['url'] = $attr['url'];
		$args['unlock_type'] = $meta_arr['unlock_type'];
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;


		if (!empty($attr['locker_div_id']) && !empty($attr['content_id'])){

		$args['link'] = 'javascript:void(0)';
		$args['onClick'] = 'ism_general_locker(\''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \'' . $meta_arr['unlock_type'] . '\', \'go1\', \''.$attr['url'].'\');';
		$args['new_window'] = true;
		}
		$ismitems_arr[] = $long_key;
		$html_arr[$long_key] = $args;
		/*if (!empty($meta_arr['ism_display_statistics_c_for_nci'])){

			$fc_arr[] = $long_key;
			if ($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;

			}

		} */

	}

	//pinterest
	//if(strpos($meta_arr['list'], 'pt')!==FALSE){
		if (in_array('pt', $ourSocialListItems)){
		$key = 'pt';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();

		if (!empty($attr['locker_div_id']) && !empty($attr['content_id'])){

			//LOCKER
			$args['link'] = 'javascript:void(0)';

			$args['onClick'] = 'ism_general_locker(\''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \'' . $meta_arr['unlock_type'] . '\', \'pt\', \''.$attr['url'].'\', \'' . $attr['feat_img'] . '\', \'' . $attr['post_title'] . '\', \'' . $attr['description'] . '\');';

		} else {
			if (!empty($meta_arr['ISI_image'])){

				//ISI

				$args['link'] = 'http://pinterest.com/pin/create/bookmarklet/?media='.$attr['feat_img'].'&amp;url='.$attr['url'].'&amp;title='.$attr['post_title'].'&amp;description='.$attr['description'];

				$args['new_window'] = true;

				$args['onClick'] = '';

			} else {

				//DEFAULT

				$rand_pin = rand(1,10000);

				$html .= '<input type="hidden" value="&amp;url='.$attr['url'].'&amp;title='.$attr['post_title'].'&amp;description='.$attr['description'].'" id="pin_hide_info_'.$rand_pin.'"/>';

				$html .= '<input type="hidden" value="'.$attr['feat_img'].'" id="pin_default_feat_img_'.$rand_pin.'" />';

				$args['link'] = 'javascript:void(0)';

				if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){

					$args['onClick'] = 'indeedPinterestPopUp_afterAction('.$rand_pin.', \''.$attr['after_share_id'].'\');';

					$args['after_share_id'] = $attr['after_share_id'];

				}else{

					$args['onClick'] = 'indeedPinterestPopUp('.$rand_pin.');';

				}

			}
		}


		/*if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if ($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		} */


		$args['sm_type'] = $key;
		$args['sm_class'] = $ism_list[$key]['long_key'];
			if($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}

		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];//'Pinterest';

		$ismitems_arr[] = $long_key;
		$html_arr[ $long_key ] = $args;
	}

	//linkedin
	//if(strpos($meta_arr['list'], 'li')!==FALSE){
	if (in_array('li', $ourSocialListItems)){
		$key = 'li';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		if( $attr['locker_div_id']!==0 && $attr['content_id']!==0 ){
			//locker
			//wp_enqueue_script('ism_linkedinjs');
			//$args['onClick'] = 'ism_linkedin_share(\''.$attr['url'].'\', \''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \'' . $meta_arr['unlock_type'] . '\');';
			$args['link'] = 'javascript:void(0)';
			$args['onClick'] = 'ism_general_locker(\''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \'' . $meta_arr['unlock_type'] . '\', \'li\', \''.$attr['url'].'\');';
		}else{
			if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
				$args['after_share_id'] = $attr['after_share_id'];
			}
			$args['link'] = 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$attr['url'].'&title='.$attr['post_title'].'&summary='.$attr['description'];
			$args['new_window'] = true;
		}
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		$args['custom_height'] = 450;
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		/*if($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}*/


		if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if ($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}


		$ismitems_arr[] = $long_key;
		$html_arr[$long_key] = $args;
	}

	//digg
	//if(strpos($meta_arr['list'], 'dg')!==FALSE){
	if (in_array('dg', $ourSocialListItems)){
		$key = 'dg';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['new_window'] = true;
		$args['link'] = 'https://digg.com/submit?phase=2%20&amp;url='.$attr['url'].'&title='.$attr['post_title'];
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;

		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//stumbleupon
	//if(strpos($meta_arr['list'], 'su')!==FALSE){
	if (in_array('su', $ourSocialListItems)){
		$key = 'su';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		//$args['link'] = 'http://www.stumbleupon.com/badge/?url='.$attr['url'].'&title='.$attr['post_title'];
		$args['link'] = 'https://mix.com/mixit?su=badge&url='.$attr['url'].'&title='.$attr['post_title'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		$args['custom_height'] = 575;
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];//'Stumbleupon';
		/*if($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}*/
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}

		/*if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		} */

		$ismitems_arr[] = $long_key;
		$html_arr[$long_key] = $args;
	}

	//tumblr
	//if(strpos($meta_arr['list'], 'tbr')!==FALSE){
	if (in_array('tbr', $ourSocialListItems)){
		$key = 'tbr';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$title = str_replace('%26', ' ', $attr['post_title']);
		$title = str_replace('%3C', ' ', $title);
		$title = str_replace('%3E', ' ', $title);
		$args['link'] = 'https://www.tumblr.com/share/link?url=' . urlencode($attr['url']) . '&name=' . $title . '&description=' . $attr['description'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		$args['custom_height'] = 530;
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//vkontakte
	//if(strpos($meta_arr['list'], 'vk')!==FALSE){
	if (in_array('vk', $ourSocialListItems)){
		$key = 'vk';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		if (!empty($attr['locker_div_id']) && !empty($attr['content_id'])){

			$args['link'] = 'javascript:void(0)';

			$args['onClick'] = 'ism_general_locker(\''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \'' . $meta_arr['unlock_type'] . '\', \'vk\', \''.$attr['url'].'\', \'' . $attr['feat_img'] . '\', \'' . $attr['post_title'] . '\', \'' . $attr['description'] . '\');';

		} else {
			$args['link'] = 'https://vkontakte.ru/share.php?url='.$attr['url'].'&image='.$attr['feat_img'].'&title='.$attr['post_title'].'&description='.$attr['description'];
			$args['new_window'] = true;
		}

		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true'){
			$args['label'] = $ism_list[$key]['label'];
		}

		/*if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		} */

		$ismitems_arr[] = $long_key;
		$html_arr[$key] = $args;
	}

	//reddit
	//if(strpos($meta_arr['list'], 'rd')!==FALSE){
	if (in_array('rd', $ourSocialListItems)){
		$key = 'rd';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'https://www.reddit.com/submit?url='.$attr['url'].'&title='.$attr['post_title'];

		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];//'Reddit';

	/*	if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		} */

		$ismitems_arr[] = $long_key;
		$html_arr[$long_key] = $args;
	}

	//delicious
	//if(strpos($meta_arr['list'], 'dl')!==FALSE){
	if (in_array('dl', $ourSocialListItems)){
		$key = 'dl';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'http://delicious.com/post?url='.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){//// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//weibo
	//if(strpos($meta_arr['list'], 'wb')!==FALSE){
	if (in_array('wb', $ourSocialListItems)){
		$key = 'wb';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$title = str_replace('%26', ' ', $attr['post_title']);
		$title = str_replace('%3C', ' ', $title);
		$title = str_replace('%3E', ' ', $title);
		$args['link'] = 'https://service.weibo.com/share/share.php?url='.$attr['url'].'&appkey='.'&title='.$attr['post_title'].'&pic='.$attr['feat_img'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//xing
	//if(strpos($meta_arr['list'], 'xg')!==FALSE){
	if (in_array('xg', $ourSocialListItems)){
		$key = 'xg';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'https://www.xing.com/social_plugins/share?url='.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//printfriendly
//	if(strpos($meta_arr['list'], 'pf')!==FALSE){
	if (in_array('pf', $ourSocialListItems)){
		$key = 'pf';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'http://www.printfriendly.com/print/?source=site&url='.$attr['url'];
		$args['new_window'] = true;
		$args['onClick'] = 'indeedPrintFriendlyCount(\''.$attr['url'].'\');';
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		$args['custom_height'] = 600;
		$args['custom_width'] = 1040;
		if($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		/*if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}*/

		$ismitems_arr[] = $long_key;
		$html_arr[$long_key] = $args;
	}

	//email
	//if(strpos($meta_arr['list'], 'email')!==FALSE){
	if (in_array('email', $ourSocialListItems)){
		$key = 'email';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args['link'] = 'javascript:void(0)';
		$args['onClick'] = 'indeedPopUpEmail(\''.ISM_DIR_URL.'\', \''.$attr['url'].'\');';
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		/*if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		} */

		$ismitems_arr[] = $long_key;
		$html_arr[$long_key] = $args;
	}

	//odnoklassniki
	//if(strpos($meta_arr['list'], 'ok')!==FALSE){
	if (in_array('ok', $ourSocialListItems)){
		$key = 'ok';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		if (!empty($attr['locker_div_id']) && !empty($attr['content_id'])){

			$args['link'] = 'javascript:void(0)';

			$args['onClick'] = 'ism_general_locker(\''.$attr['locker_div_id'].'\', \''.$attr['content_id'].'\', \'' . $meta_arr['unlock_type'] . '\', \'ok\', \''.$attr['url'].'\');';

		} else {

			$args['link'] = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='.$attr['url'];
			$args['new_window'] = true;

		}
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		/*if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		} */

		$ismitems_arr[] = $long_key;
		$html_arr[$long_key] = $args;
	}

	//whatsapp
	//if(strpos($meta_arr['list'], 'whatsapp')!==FALSE){
	if (in_array('whatsapp', $ourSocialListItems)){
		$key = 'whatsapp';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'whatsapp://send?text='.$attr['post_title'].' - '.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//BUFFERAPP
	//if(strpos($meta_arr['list'], 'bufferapp')!==FALSE){
	if (in_array('bufferapp', $ourSocialListItems)){
		$key = 'bufferapp';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'https://bufferapp.com/add?url='.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		/*if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		} */

		$ismitems_arr[] = $long_key;
		$html_arr[$long_key] = $args;
	}

	//MAIL.RU
	//if(strpos($meta_arr['list'], 'mailru')!==FALSE){
		if (in_array('mailru', $ourSocialListItems)){
		$key = 'mailru';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'http://connect.mail.ru/share?url='.$attr['url'].'&title='.$attr['post_title'].'&description='.$attr['description'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//Meneame
	//if(strpos($meta_arr['list'], 'meneame')!==FALSE){
	if (in_array('meneame', $ourSocialListItems)){
		$key = 'meneame';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'https://www.meneame.net/submit.php?url='.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//Evernote
	//if(strpos($meta_arr['list'], 'evernote')!==FALSE){
		if (in_array('evernote', $ourSocialListItems)){
		$key = 'evernote';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'https://www.evernote.com/clip.action?url='.$attr['url'].'&title='.$attr['post_title'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//GetPocket
	//if(strpos($meta_arr['list'], 'getpocket')!==FALSE){
	if (in_array('getpocket', $ourSocialListItems)){
		$key = 'getpocket';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'https://getpocket.com/edit?url='.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//Flattr
	//if(strpos($meta_arr['list'], 'flattr')!==FALSE){
	if (in_array('flattr', $ourSocialListItems)){
		$key = 'flattr';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$u_id = get_option('ism_flattr_uid');
		if($u_id===FALSE) $u_id = '';
		$args['link'] = 'https://flattr.com/submit/auto?url='.$attr['url'].'&user_id='.$u_id;
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//managewp.org
	//if(strpos($meta_arr['list'], 'managewp')!==FALSE){
	if (in_array('managewp', $ourSocialListItems)){
		$key = 'managewp';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'https://managewp.org/share/form?url='.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//myspace
	//if(strpos($meta_arr['list'], 'myspace')!==FALSE){
		if (in_array('myspace', $ourSocialListItems)){
		$key = 'myspace';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'http://myspace.com/post?u='.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//yahoo mail
	//if(strpos($meta_arr['list'], 'ymail')!==FALSE){
	if (in_array('ymail', $ourSocialListItems)){
		$key = 'ymail';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'http://compose.mail.yahoo.com/?body='.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//gmail
	//if(strpos($meta_arr['list'], 'gmail')!==FALSE){
		if (in_array('gmail', $ourSocialListItems)){
		$key = 'gmail';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'https://mail.google.com/mail/u/0/?view=cm&fs=1&su='.$attr['post_title'].'&body='.$attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//hackernews
	//if(strpos($meta_arr['list'], 'hackernews')!==FALSE){
	if (in_array('hackernews', $ourSocialListItems)){
		$key = 'hackernews';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)) unset($args);
		$args = array();
		$args['link'] = 'https://news.ycombinator.com/submitlink?u='.$attr['url'].'&t='.$attr['post_title'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}

		$html_arr[$long_key] = $args;
	}

	//blogger
	//if(strpos($meta_arr['list'], 'blogger')!==FALSE){
	if (in_array('blogger', $ourSocialListItems)){
		$key = 'blogger';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)){
			unset($args);
		}
		$args = array();
		$args['link'] = 'https://www.blogger.com/blog-this.g?u='.$attr['url'].'&n='.$attr['post_title'].'&t=' . $attr['description'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}
		$args['font'] = 'socicon';
		$html_arr[$long_key] = $args;
	}

	//amazon
	//if(strpos($meta_arr['list'], 'amazon')!==FALSE){
	if (in_array('amazon', $ourSocialListItems)){
		$key = 'amazon';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)){
			unset($args);
		}
		$args = array();
		$args['link'] = 'https://www.amazon.com/gp/wishlist/static-add?u=' . $attr['url'] . '&t=' . $attr['post_title'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}
		$args['font'] = 'socicon';
		$html_arr[$long_key] = $args;
	}

	//newsvine
	//if(strpos($meta_arr['list'], 'newsvine')!==FALSE){
	if (in_array('newsvine', $ourSocialListItems)){
		$key = 'newsvine';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)){
			unset($args);
		}
		$args = array();
		$args['link'] = 'https://www.newsvine.com/_tools/seed&save?u=' . $attr['url'] . '&h=' . $attr['post_title'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}
		$args['font'] = 'socicon';
		$html_arr[$long_key] = $args;
	}

	//viadeo
	//if(strpos($meta_arr['list'], 'viadeo')!==FALSE){
	if (in_array('viadeo', $ourSocialListItems)){
		$key = 'viadeo';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)){
			unset($args);
		}
		$args = array();
		$args['link'] = 'https://www.viadeo.com/shareit/share/?url=' . $attr['url'] . '&title=' . $attr['post_title'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}
		$args['font'] = 'socicon';
		$html_arr[$long_key] = $args;
	}

	//DOUBAN
	//if(strpos($meta_arr['list'], 'douban')!==FALSE){
	if (in_array('douban', $ourSocialListItems)){
		$key = 'douban';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)){
			unset($args);
		}
		$args = array();
		$args['link'] = 'https://www.douban.com/share/service?name=&href=' . $attr['url'] . '&image=' . $attr['feat_img'] .'&updated=&bm=&url=' . $attr['url'] . '&title=' . $attr['post_title'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}
		$args['font'] = 'socicon';
		$html_arr[$long_key] = $args;
	}

	//baidu
	//if(strpos($meta_arr['list'], 'baidu')!==FALSE){
	if (in_array('baidu', $ourSocialListItems)){
		$key = 'baidu';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)){
			unset($args);
		}
		$args = array();
		$args['link'] = 'https://cang.baidu.com/do/add?it=' . $attr['url'] . '&fr=&dc=';
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}
		$args['font'] = 'socicon';
		$html_arr[$long_key] = $args;
	}

	//identica
	//if(strpos($meta_arr['list'], 'identica')!==FALSE){
	if (in_array('identica', $ourSocialListItems)){
		$key = 'identica';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)){
			unset($args);
		}
		$args = array();
		$args['link'] = 'https://identi.ca/?action=newnotice&status_textarea=' . $attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}
		$args['font'] = 'socicon';
		$html_arr[$long_key] = $args;
	}

	//yammer
	//if(strpos($meta_arr['list'], 'yammer')!==FALSE){
	if (in_array('yammer', $ourSocialListItems)){
		$key = 'yammer';
		$long_key = $ism_list[$key]['long_key'];

		if(isset($args)){
			unset($args);
		}
		$args = array();
		$args['link'] = 'https://www.yammer.com/messages/new?login=true&trk_event=yammer_share&status=' . $attr['post_title'] . ' ' . $attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}
		$args['font'] = 'socicon';
		$html_arr[$long_key] = $args;
	}

	//SMS
	//if (strpos($meta_arr['list'], 'sms')!==FALSE){
	if (in_array('sms', $ourSocialListItems)){
		$key = 'sms';
		$long_key = $ism_list[$key]['long_key'];

		if (isset($args)){
			unset($args);
		}
		$args = array();

		$args['link'] = 'sms:'.check_mobile_os().'body=' . $attr['post_title'] . ' ' . $attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];

		}
		if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){
			$fc_arr[] = $long_key;
			if ($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}
		$html_arr[$long_key] = $args;
	}

	//viber
//	if (strpos($meta_arr['list'], 'viber')!==FALSE){
	if (in_array('viber', $ourSocialListItems)){
		$key = 'viber';
		$long_key = $ism_list[$key]['long_key'];

		if (isset($args)){
			unset($args);
		}
		$args = array();
		$args['link'] = 'viber://forward?text=' . $attr['post_title'] . ' ' . $attr['url'];
		$args['new_window'] = true;
		$args['sm_type'] = $key;
		$args['sm_class'] = $long_key;
		if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
			$args['after_share_id'] = $attr['after_share_id'];
		}
		if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
		//display statistics counts
		if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
			$fc_arr[] = $long_key;
			if ($meta_arr['display_counts']=='true'){
				$args['display_counts'] = true;
			}
		}
		$html_arr[$long_key] = $args;
	}

	//TELEGRAM
	//if (strpos($meta_arr['list'], 'telegram')!==FALSE){
if (in_array('telegram', $ourSocialListItems)){
		$key = 'telegram';
		$long_key = $ism_list[$key]['long_key'];
		if (isset($args)){

			unset($args);

		}

		$args = array();
		$args['link'] = 'tg://msg?text='. rawurlencode($attr['post_title']) .' '. rawurlencode($attr['url']);

		$args['new_window'] = true;

		$args['sm_type'] = $key;

		$args['sm_class'] = $long_key;
		if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){

			$args['after_share_id'] = $attr['after_share_id'];

		}

		if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		//display statistics counts

		if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'

			$fc_arr[] = $long_key;

			if ($meta_arr['display_counts']=='true'){

				$args['display_counts'] = true;

			}

		}

		$html_arr[$long_key] = $args;
	}

	//COMMENTS

	//if (strpos($meta_arr['list'], 'comments')!==FALSE){

	if (in_array('comments', $ourSocialListItems)){
		$key = 'comments';

		$long_key = $ism_list[$key]['long_key'];

		if (isset($args)){

			unset($args);

		}

		$args = array();

		$args['link'] = '#comment';

		$args['sm_type'] = $key;

		$args['sm_class'] = $long_key;

		if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){

			$args['after_share_id'] = $attr['after_share_id'];


		}


		if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		//display statistics counts

		if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'

			//$fc_arr[] = $long_key;

			if ($meta_arr['display_counts']=='true'){

				$args['display_counts'] = true;

			}

		}
		$ismitems_arr[] = $long_key;

		$html_arr[$long_key] = $args;

	}

	//LIKE

	//if (strpos($meta_arr['list'], 'love_like')!==FALSE){

	if (in_array('love_like', $ourSocialListItems)){

		$key = 'love_like';

		$long_key = $ism_list[$key]['long_key'];

		if (isset($args)){

			unset($args);

		}

		$args = array();

		$args['link'] = 'javascript:void(0)';
		$args['onClick'] = 'ism_love_this(\''.$attr['url'].'\');';

		$args['sm_type'] = $key;

		$args['sm_class'] = $long_key;

		if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){

			$args['after_share_id'] = $attr['after_share_id'];

		}

		if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		//display statistics counts

		if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'


			//$fc_arr[] = $long_key;

			if ($meta_arr['display_counts']=='true'){

				$args['display_counts'] = true;

			}

		}


		$ismitems_arr[] = $long_key;

		$html_arr[$long_key] = $args;

	}

	//AOL
	//if (strpos($meta_arr['list'], 'aol')!==FALSE){

	if (in_array('aol', $ourSocialListItems)){
		$key = 'aol';

		$long_key = $ism_list[$key]['long_key'];

		if (isset($args)){

			unset($args);

		}

		$args = array();

		$args['link'] = 'http://webmail.aol.com/Mail/ComposeMessage.aspx?subject=' . $attr['post_title'] . '&body=' . $attr['url'];

		$args['new_window'] = TRUE;

		$args['sm_type'] = $key;

		$args['sm_class'] = $long_key;

		if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){

			$args['after_share_id'] = $attr['after_share_id'];

		}

		if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		//display statistics counts

		if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'

			$fc_arr[] = $long_key;

			if ($meta_arr['display_counts']=='true'){

				$args['display_counts'] = true;

			}

		}

		$html_arr[$long_key] = $args;

	}

	//FLIPBOARD
//	if (strpos($meta_arr['list'], 'flipboard')!==FALSE){

	if (in_array('flipboard', $ourSocialListItems)){
		$key = 'flipboard';

		$long_key = $ism_list[$key]['long_key'];

		if (isset($args)){

			unset($args);

		}

		$args = array();

		$args['link'] = 'https://share.flipboard.com/bookmarklet/popout?url=' . $attr['url'] . '&title=' . $attr['post_title'];

		$args['new_window'] = TRUE;
		$args['sm_type'] = $key;

		$args['sm_class'] = $long_key;

		if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){

			$args['after_share_id'] = $attr['after_share_id'];

		}

		if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		//display statistics counts

		if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'

			$fc_arr[] = $long_key;

			if ($meta_arr['display_counts']=='true'){

				$args['display_counts'] = true;

			}

		}

		$html_arr[$long_key] = $args;

	}

	//SEND EMAIL

	//if (strpos($meta_arr['list'], 'mailto')!==FALSE){

	if (in_array('mailto', $ourSocialListItems)){
		$key = 'mailto';

		$long_key = $ism_list[$key]['long_key'];

		if (isset($args)){

			unset($args);

		}

		$args = array();

		$args['link'] = 'mailto:receiver@mailservice.com?Subject=' . $attr['url'];

		//$args['new_window'] = TRUE;

		$args['sm_type'] = $key;

		$args['sm_class'] = $long_key;

		if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){

			$args['after_share_id'] = $attr['after_share_id'];

		}

		if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

		//display statistics counts

		if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'

			$fc_arr[] = $long_key;

			if ($meta_arr['display_counts']=='true'){

				$args['display_counts'] = true;

			}

		}

		$html_arr[$long_key] = $args;

	}


//SKYPE
//if (strpos($meta_arr['list'], 'skype')!==FALSE){
if (in_array('skype', $ourSocialListItems)){
	$key = 'skype';
	$long_key = $ism_list[$key]['long_key'];
	if (isset($args)){
		unset($args);
	}
	$args = array();
	$args['link'] = 'https://web.skype.com/share?url=' . $attr['url'];
	$args['sm_type'] = $key;
	$args['new_window'] = true;
	$args['sm_class'] = $long_key;
	if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
		$args['after_share_id'] = $attr['after_share_id'];
	}

//jquery for close window


	if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

	//display statistics counts

	if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
		$fc_arr[] = $long_key;
		if ($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}
	}

	$html_arr[$long_key] = $args;

}

 // Messenger
 //if (strpos($meta_arr['list'], 'messenger')!==FALSE){
	if (in_array('messenger', $ourSocialListItems)){
 	$key = 'messenger';
 	$long_key = $ism_list[$key]['long_key'];
 	if (isset($args)){
 		unset($args);
 	}
 	$args = array();
 	$args['link'] = 'fb-messenger://share/?link=' .$attr['url']. '&app_id='.$fb_id.'';
 	$args['sm_type'] = $key;
 	$args['sm_class'] = $long_key;
 	if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
 		$args['after_share_id'] = $attr['after_share_id'];
 	}

 	if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

 	//display statistics counts

 	if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
 		$fc_arr[] = $long_key;
 		if ($meta_arr['display_counts']=='true'){
 			$args['display_counts'] = true;
 		}
 	}

 	$html_arr[$long_key] = $args;


 }

// Renren
//if (strpos($meta_arr['list'], 'renren')!==FALSE){
	if (in_array('renren', $ourSocialListItems)){
 $key = 'renren';
 $long_key = $ism_list[$key]['long_key'];
 if (isset($args)){
	 unset($args);
 }
 $args = array();
 $args['link'] = 'http://widget.renren.com/dialog/share?resourceUrl=' . $attr['url'];
 $args['sm_type'] = $key;
 $args['sm_class'] = $long_key;
  $args['new_window'] = true;
 if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
	 $args['after_share_id'] = $attr['after_share_id'];

 }

 if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

 //display statistics counts

 if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
	 $fc_arr[] = $long_key;
	 if ($meta_arr['display_counts']=='true'){
		 $args['display_counts'] = true;
	 }
 }

 $html_arr[$long_key] = $args;

}

//LINE
//if (strpos($meta_arr['list'], 'line')!==FALSE){
if (in_array('line', $ourSocialListItems)){
	$key = 'line';
	$long_key = $ism_list[$key]['long_key'];
	if (isset($args)){
		unset($args);
	}
	$args = array();
	$args['link'] = 'http://line.me/R/msg/text/?'.$attr['post_title'] .' '. $attr['url'];
	 $args['new_window'] = true;
	$args['sm_type'] = $key;
	$args['sm_class'] = $long_key;
	if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
		$args['after_share_id'] = $attr['after_share_id'];
	}

	if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

	//display statistics counts

	if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
		$fc_arr[] = $long_key;
		if ($meta_arr['display_counts']=='true'){
			$args['display_counts'] = true;
		}
	}

	$html_arr[$long_key] = $args;

}

//Yummly
//if (strpos($meta_arr['list'], 'yummly')!==FALSE){
	if (in_array('yummly', $ourSocialListItems)){
 $key = 'yummly';
 $long_key = $ism_list[$key]['long_key'];
 if (isset($args)){
	 unset($args);
 }
$args = array();
 $args['link'] = 'http://www.yummly.com/urb/verify?url=' . $attr['url']. '&title=' . $attr['post_title'];
 $args['sm_type'] = $key;
 $args['sm_class'] = $long_key;
 $args['new_window'] = true;
 if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
	 $args['after_share_id'] = $attr['after_share_id'];

 }

 if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

 //display statistics counts

 if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
	 $fc_arr[] = $long_key;
	 if ($meta_arr['display_counts']=='true'){
		 $args['display_counts'] = true;
	 }
 }

$html_arr[$long_key] = $args;

}
// KAKAO
//if (strpos($meta_arr['list'], 'kakao')!==FALSE){
if (in_array('kakao', $ourSocialListItems)){
 $key = 'kakao';
 $long_key = $ism_list[$key]['long_key'];
 if (isset($args)){
	 unset($args);
 }
 $args = array();
 $args['link'] = 'https://story.kakao.com/share?url=' . $attr['url'];
 $args['sm_type'] = $key;
 $args['sm_class'] = $long_key;
  $args['new_window'] = true;
 if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
	 $args['after_share_id'] = $attr['after_share_id'];
 }

 if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

 //display statistics counts

 if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
	 $fc_arr[] = $long_key;
	 if ($meta_arr['display_counts']=='true'){
		 $args['display_counts'] = true;
	 }
 }

 $html_arr[$long_key] = $args;

}
 // liveJournal
 //if (strpos($meta_arr['list'], 'livejournal')!==FALSE){
	 if (in_array('livejournal', $ourSocialListItems)){
  $key = 'livejournal';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
 	 unset($args);
  }
  $args = array();
  $args['link'] = 'http://www.livejournal.com/update.bml?subject=' . $attr['url'];
  $args['sm_type'] = $key;
  $args['sm_class'] = $long_key;
	 $args['new_window'] = true;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
 	 $args['after_share_id'] = $attr['after_share_id'];
  }

  if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

  //display statistics counts

  if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
 	 $fc_arr[] = $long_key;
 	 if ($meta_arr['display_counts']=='true'){
 		 $args['display_counts'] = true;
 	 }
  }

  $html_arr[$long_key] = $args;

 }

 // Hatena
 //if (strpos($meta_arr['list'], 'hatena')!==FALSE){
if (in_array('hatena', $ourSocialListItems)){
  $key = 'hatena';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
 	unset($args);
  }
  $args = array();
  $args['link'] = 'http://b.hatena.ne.jp/bookmarklet?url=' . $attr['url'];
  $args['sm_type'] = $key;
  $args['sm_class'] = $long_key;
	 $args['new_window'] = true;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
 	$args['after_share_id'] = $attr['after_share_id'];
  }

  if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

  //display statistics counts

  if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
 	$fc_arr[] = $long_key;
 	if ($meta_arr['display_counts']=='true'){
 		$args['display_counts'] = true;
 	}
  }

  $html_arr[$long_key] = $args;

 }

 // tencent
// if (strpos($meta_arr['list'], 'tencent')!==FALSE){
if (in_array('tencent', $ourSocialListItems)){
	$key = 'tencent';
	$long_key = $ism_list[$key]['long_key'];
	if (isset($args)){
	 unset($args);
	}
	$args = array();
	$args['link'] = 'https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=' . $attr['url'];
	$args['sm_type'] = $key;
	$args['sm_class'] = $long_key;
	 $args['new_window'] = true;
	if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
	 $args['after_share_id'] = $attr['after_share_id'];
	}

	if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

	//display statistics counts

	if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
	 $fc_arr[] = $long_key;
	 if ($meta_arr['display_counts']=='true'){
		 $args['display_counts'] = true;
	 }
	}

	$html_arr[$long_key] = $args;

 }
 // Naver
 //if (strpos($meta_arr['list'], 'naver')!==FALSE){
if (in_array('naver', $ourSocialListItems)){
  $key = 'naver';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
  unset($args);
  }
  $args = array();
  $args['link'] = 'http://blog.naver.com/openapi/share?url=' . $attr['url'];
  $args['sm_type'] = $key;
  $args['sm_class'] = $long_key;
	 $args['new_window'] = true;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
  $args['after_share_id'] = $attr['after_share_id'];
  }

  if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

  //display statistics counts

  if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
  $fc_arr[] = $long_key;
  if ($meta_arr['display_counts']=='true'){
 	 $args['display_counts'] = true;
  }
  }

  $html_arr[$long_key] = $args;

 }

 // QR
 //if (strpos($meta_arr['list'], 'qr')!==FALSE){
if (in_array('qr', $ourSocialListItems)){
  $key = 'qr';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
  unset($args);
  }
  $args = array();
  $args['link'] = 'http://www.qrsrc.com/default.aspx?shareurl=' . $attr['url'];
  $args['sm_type'] = $key;
  $args['sm_class'] = $long_key;
	 $args['new_window'] = true;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
  $args['after_share_id'] = $attr['after_share_id'];
  }

  if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

  //display statistics counts

  if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
  $fc_arr[] = $long_key;
  if ($meta_arr['display_counts']=='true'){
 	 $args['display_counts'] = true;
  }
  }

  $html_arr[$long_key] = $args;

 }

 // Edgar

 //if (strpos($meta_arr['list'], 'edgar')!==FALSE){

if (in_array('edgar', $ourSocialListItems)){
  $key = 'edgar';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
  unset($args);
  }
  $args = array();
  $args['link'] = 'https://meetedgar.com';
	$args['new_window'] = true;
  $args['sm_type'] = $key;
  $args['sm_class'] = $long_key;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
  $args['after_share_id'] = $attr['after_share_id'];
  }

  if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

  //display statistics counts

  if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
  $fc_arr[] = $long_key;
  if ($meta_arr['display_counts']=='true'){
 	 $args['display_counts'] = true;
  }
  }

  $html_arr[$long_key] = $args;

 }

 // Fintel
 //if (strpos($meta_arr['list'], 'fintel')!==FALSE){
if (in_array('fintel', $ourSocialListItems)){
  $key = 'fintel';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
  unset($args);
  }
  $args = array();
  $args['link'] = 'https://fintel.io/submit?url=' . $attr['url'];
  $args['sm_type'] = $key;
  $args['sm_class'] = $long_key;
	 $args['new_window'] = true;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
  $args['after_share_id'] = $attr['after_share_id'];
  }

  if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

  //display statistics counts

  if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
  $fc_arr[] = $long_key;
  if ($meta_arr['display_counts']=='true'){
 	$args['display_counts'] = true;
  }
  }

  $html_arr[$long_key] = $args;

 }

 // Mix
 //if (strpos($meta_arr['list'], 'mix')!==FALSE){
if (in_array('mix', $ourSocialListItems)){
  $key = 'mix';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
  unset($args);
  }
  $args = array();
  $args['link'] = 'https://mix.com/extension/add?source=' . $attr['url'];
  $args['sm_type'] = $key;
  $args['sm_class'] = $long_key;
	 $args['new_window'] = true;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
  $args['after_share_id'] = $attr['after_share_id'];
  }

  if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

  //display statistics counts

  if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
  $fc_arr[] = $long_key;
  if ($meta_arr['display_counts']=='true'){
 	$args['display_counts'] = true;
  }
  }

  $html_arr[$long_key] = $args;

 }

 // wechat
 //if (strpos($meta_arr['list'], 'wechat')!==FALSE){
if (in_array('wechat', $ourSocialListItems)){
  $key = 'wechat';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
  unset($args);
  }
  $args = array();
  $args['link'] = 'weixin://dl/post?url/' . $attr['url'];
  $args['sm_type'] = $key;
  $args['sm_class'] = $long_key;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
  $args['after_share_id'] = $attr['after_share_id'];
  }

  if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

  //display statistics counts

  if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
  $fc_arr[] = $long_key;
  if ($meta_arr['display_counts']=='true'){
  $args['display_counts'] = true;
  }
  }

  $html_arr[$long_key] = $args;

 }


 // bibsonomy
 //if (strpos($meta_arr['list'], 'bibsonomy')!==FALSE){
if (in_array('bibsonomy', $ourSocialListItems)){
  $key = 'bibsonomy';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
  unset($args);
  }
  $args = array();
  $args['link'] = 'https://www.bibsonomy.org/ShowBookmarkEntry?url=' . $attr['url'];
  $args['sm_type'] = $key;
  $args['sm_class'] = $long_key;
	 $args['new_window'] = true;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
  $args['after_share_id'] = $attr['after_share_id'];
  }

  if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

  //display statistics counts

  if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
  $fc_arr[] = $long_key;
  if ($meta_arr['display_counts']=='true'){
  $args['display_counts'] = true;
  }
  }

  $html_arr[$long_key] = $args;

 }

 // diigo
 //if (strpos($meta_arr['list'], 'diigo')!==FALSE){
if (in_array('diigo', $ourSocialListItems)){
  $key = 'diigo';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
  unset($args);
  }
  $args = array();
 	$args['link'] = 'https://www.diigo.com/post?url='. $attr['url'];
  $args['sm_type'] = $key;
  $args['sm_class'] = $long_key;
	 $args['new_window'] = true;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
  $args['after_share_id'] = $attr['after_share_id'];
  }

  if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];

  //display statistics counts

  if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
  $fc_arr[] = $long_key;
  if ($meta_arr['display_counts']=='true'){
  $args['display_counts'] = true;
  }
  }

  $html_arr[$long_key] = $args;

 }
 // subscribe
// if (strpos($meta_arr['list'], 'subscribe')!==FALSE){
if (in_array('subscribe', $ourSocialListItems)){
  $key = 'subscribe';
  $long_key = $ism_list[$key]['long_key'];
  if (isset($args)){
  unset($args);
  }

  $args = array();
	$currentUrl = ISM_PROTOCOL . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$args['onClick'] = "ism_ns_open_modal_box('$currentUrl');";
	$args['link'] = 'javascript:void(0)';
  $args['sm_class'] = $long_key;
/*	if($meta_arr['display_counts']=='true'){
		$args['display_counts'] = true;
	} */
	$args['sm_type'] = $key;
 	//$args['new_window'] = true;
  if (isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
  $args['after_share_id'] = $attr['after_share_id'];
}

   if ($meta_arr['display_full_name']=='true') $args['label'] = $ism_list[$key]['label'];
	 //display statistics counts
 if (isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']){// && $meta_arr['display_counts']=='true'
	 $fc_arr[] = $long_key;
	 if ($meta_arr['display_counts']=='true'){
	 $args['display_counts'] = true;
 }
}
	$ismitems_arr[] = $long_key;
  $html_arr[$long_key] = $args;

 }



	/************************* END OF SOCIAL MEDIA ITEMS *************************/

	$arr['html_arr'] = $html_arr;
	$arr['ismitems_arr'] = $ismitems_arr;
	$arr['html'] = $html;
	$arr['fc_arr'] = $fc_arr;
	return $arr;
}

//////////////POPUP////////////////
function ism_style_for_popup($attr, $meta_arr){
	$css = '';
	$aditional_css = '';

	/********************************* PARENTS ***************************************/

		$css .= '
		.ism_popup_box{
		';
			//top
			if(isset($meta_arr['top_bottom_type'])) $type = $meta_arr['top_bottom_type'];
			else $type = 'px';
			$css .= "top : {$meta_arr['top_bottom_value']}$type;";

			$left_add = ($meta_arr['width']/2);

			//left or right
			if(isset($meta_arr['left_right_type'])) $type = $meta_arr['left_right_type'];
			else $type = 'px';

			if(isset($meta_arr['left_right'])){
				if($meta_arr['left_right'] == 'left'){
					 $css .= 'left: calc( 50% - '.$left_add.'px - '.$meta_arr['left_right_value'].$type.');';
				}else{
					$css .= 'left: calc( 50% - '.$left_add.'px + '.$meta_arr['left_right_value'].$type.');';
				}
			}

		if(isset($meta_arr['width'])) $css .= 'width: '.$meta_arr['width'].'px;';
		if(isset($meta_arr['height']) && $meta_arr['height']!='') $css .= 'height: '.$meta_arr['height'].'px;';
		$css .= '}';
		$css .= '
				.ism-popup-content{';
		if(isset($meta_arr['padding'])) $css .= 'padding: '.$meta_arr['padding'].'px;';
		$css .= '}';

	/*************************************** ITEMS **************************************/
	$css .= "
			#{$attr['indeed_wrap_id']} .ism_item{
				 ";
		if($meta_arr['list_align']=='vertical'){
			////VERTICAL ALIGN
				if((isset($meta_arr['position']) && $meta_arr['position']=='custom') || (isset($website_display) && $website_display==true) ){
					$margin_arr = array(
											'ism_template_0' => '4px 0px;',
											'ism_template_1' => '4px 0px;',
											'ism_template_2' => '4px 0px;',
											'ism_template_3' => '4px 0px;',
											'ism_template_4' => '7px 0px;',
											'ism_template_5' => '',
											'ism_template_6' => '7px 0px;',
											'ism_template_7' => '4px 0px;',
											'ism_template_8' => '4px 0px;',
											'ism_template_9' => '',
											'ism_template_10' => '3px 0px;',
										);
				if(isset($margin_arr[$meta_arr['template']]) && $margin_arr[$meta_arr['template']]!=''){
					$css .= 'margin: ' . $margin_arr[$meta_arr['template']] . ' !important;';
				}
			}
		}else{
					////HORIZONTAL ALIGN
			if((isset($meta_arr['position']) && $meta_arr['position']=='custom') || (isset($website_display) && $website_display==true) ){
					$margin_arr = array(
										'ism_template_0' => '0px 4px;',
										'ism_template_1' => '0px 4px;',
										'ism_template_2' => '0px 4px;',
										'ism_template_3' => '0px 4px;',
										'ism_template_4' => '0px 7px;',
										'ism_template_5' => '',
										'ism_template_6' => '0px 7px;',
										'ism_template_7' => '0px 4px;',
										'ism_template_8' => '0px 4px;',
										'ism_template_9' => '',
										'ism_template_10' => '0px 3px;',
										);
				if(isset($margin_arr[$meta_arr['template']]) && $margin_arr[$meta_arr['template']]!=''){
					$css .= 'margin: ' . $margin_arr[$meta_arr['template']] . ' !important;';
				}
			}
		}
		//CUSTOM TOP TEMPLATE 5
		if(isset($meta_arr['top_bottom']) && $meta_arr['top_bottom']=='top' && $meta_arr['template']=='ism_template_5'){
			$css .= '
					-webkit-box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
					-moz-box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
					box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
					';
					$aditional_css .= '
										#'.$attr['indeed_wrap_id'].' .ism_item:hover{
												top: initial !important;
												bottom: -1px !important;
										}';
		}
		//CUSTOM RIGHT FOR TEMPLATE 9
		if(isset($meta_arr['left_right']) && $meta_arr['left_right']=='right' && $meta_arr['template']=='ism_template_9'){
			$css .= '
					-webkit-box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
							-moz-box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
									box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
					border-top-left-radius:5px;
					border-bottom-left-radius:5px;
					margin-right:-5px;
					';
			$aditional_css .= '
								#'.$attr['indeed_wrap_id'].' .ism_item:hover{
									left: initial !important;
									right: 5px !important;
							}';
		}
	$css .= "}";

	if((!isset($meta_arr['display_full_name']) || $meta_arr['display_full_name']=='false') && (!isset($meta_arr['display_counts']) || $meta_arr['display_counts']=='false')  ){
		$css .="#$indeed_wrap_id .ism_item .fa-ism, #$indeed_wrap_id .ism_item .ism-sc-icon{";
		 $css .= "float:none;";
		$css .="}";
	}


	$css .="#{$attr['indeed_wrap_id']} .ism_item_wrapper{
				display: ";
	if($meta_arr['list_align']=='vertical'){
		$css .= "block;";
	}else{
					////HORIZONTAL ALIGN
			$css .= "inline-block;";
	}
	$css .= "}";


	if(isset($meta_arr['no_cols']) && $meta_arr['no_cols'] > 0){
		$cols = 100/$meta_arr['no_cols'];

		$css .= "#{$attr['indeed_wrap_id']} {
					display:block;
				}";
		$css .= "#{$attr['indeed_wrap_id']} .ism_item_wrapper{";
			$css .= "width:".$cols."%;";
		$css .= "}";

	}

	if(isset($meta_arr['box_align']) && $meta_arr['list_align']!='vertical'){
		$css .= "#{$attr['indeed_wrap_id']} {
					display:block;
					text-align:".$meta_arr['box_align']."
				}";
	}

	$css .= $aditional_css;

	return $css;
}
function ism_show_up_popup($id, $meta_arr){
	$display_once = 1;
	if(isset($meta_arr['show_once']) && $meta_arr['show_once']==1) $display_once = -1;
	if(!isset($meta_arr['slide_duration']) || $meta_arr['slide_duration']=='') $meta_arr['slide_duration'] = 0;

	$effect = $meta_arr['show_effect'];

	$str = '
			ism_popup_display_once = 0;';
	switch($meta_arr['show_up']){
		case 'on_load':
			$str .= '
					jQuery(window).load(function(){
						ism_show_popup( "#'.$id.'", "'.$effect.'", '.$meta_arr['delay'].', '.$meta_arr['slide_duration'].' );

					 });';
		break;
		case 'scroll_top':
			$str .= '
						jQuery(document).scroll(function(){
							if(jQuery(window).scrollTop() != 0 || ism_popup_display_once == 1) return;
							ism_show_popup( "#'.$id.'", "'.$effect.'", '.$meta_arr['delay'].', '.$meta_arr['slide_duration'].'  );
							ism_popup_display_once = '.$display_once.';
						});
			';
		break;
		case 'scroll_middle':
			$str .= '
						previous_scroll_pos = 0;
						display_scroll_down = 0;
						display_scroll_up = 1;
						jQuery(document).scroll(function(){
							s_h = (jQuery(document).height() - jQuery(window).height() )/2;
							scroll_pos = parseInt(jQuery(window).scrollTop());
							show = 0;
							if( scroll_pos > s_h && scroll_pos > previous_scroll_pos){
								if( ism_popup_display_once == 1 || display_scroll_down == 1) return;
								display_scroll_down = 1;
								display_scroll_up = 0;
								show = 1;
							}
							if( scroll_pos < s_h && scroll_pos < previous_scroll_pos){
								if( ism_popup_display_once == 1 || display_scroll_up == 1) return;
								display_scroll_down = 0;
								display_scroll_up = 1;
								show = 1;
							}
							if( show == 1){
								ism_show_popup( "#'.$id.'", "'.$effect.'", '.$meta_arr['delay'].', '.$meta_arr['slide_duration'].'  );
								ism_popup_display_once = '.$display_once.';
							}
							previous_scroll_pos	= parseInt(jQuery(window).scrollTop());
						});
			';
		break;
		case 'scroll_bottom':
			$str .= '
						jQuery(document).scroll(function(){
							if( jQuery(window).scrollTop() + jQuery(window).height() != jQuery(document).height() || ism_popup_display_once == 1 ) return;
							ism_show_popup( "#'.$id.'", "'.$effect.'", '.$meta_arr['delay'].', '.$meta_arr['slide_duration'].'  );
							ism_popup_display_once = '.$display_once.';
						});
			';
		case 'leave':
			$str .= '
						var stop_croll = 0;
						 jQuery( document ).ready(function(){
							jQuery(document).mousemove(function(e) {
								if((e.pageY-jQuery(window).scrollTop()) <= 10){
									 if(ism_popup_display_once == 1) return;
										ism_show_popup( "#'.$id.'", "'.$effect.'", '.$meta_arr['delay'].', '.$meta_arr['slide_duration'].'  );
										ism_popup_display_once = '.$display_once.';

								}
							});

						});
			';
		break;
	}
	return $str;
}
//////////////POPUP////////////////

//////////////SLIDE IN////////////////
function ism_show_up_slide($id, $meta_arr){

	$display_once = 1;
	if(isset($meta_arr['show_once']) && $meta_arr['show_once']==1) $display_once = -1;
	if(!isset($meta_arr['slide_duration']) || $meta_arr['slide_duration']=='') $meta_arr['slide_duration'] = 0;

	$effect = $meta_arr['slide_type'];

	$str = '
			ism_slide_display_once = 0;';
	switch($meta_arr['show_up']){
		case 'on_load':
			$str .= 'jQuery(window).load(function(){
						ism_slide_in( "#'.$id.'", "'.$effect.'", '.$meta_arr['delay'].', '.$meta_arr['slide_duration'].' );
					 });';
		break;
		case 'scroll_top':
			$str .= '
						jQuery(document).scroll(function(){
							if(jQuery(window).scrollTop() != 0 || ism_slide_display_once == 1) return;
							ism_slide_in( "#'.$id.'", "'.$effect.'", '.$meta_arr['delay'].', '.$meta_arr['slide_duration'].' );
							ism_slide_display_once = '.$display_once.';
						});
			';
		break;
		case 'scroll_middle':
			$str .= '
						slide_previous_scroll_pos = 0;
						slide_display_scroll_down = 0;
						slide_display_scroll_up = 1;
						jQuery(document).scroll(function(){
							s_h = (jQuery(document).height() - jQuery(window).height() )/2;
							slide_scroll_pos = parseInt(jQuery(window).scrollTop());
							slide_show = 0;
							if( slide_scroll_pos > s_h && slide_scroll_pos > slide_previous_scroll_pos){
								if( ism_slide_display_once == 1 || slide_display_scroll_down == 1) return;
								slide_display_scroll_down = 1;
								slide_display_scroll_up = 0;
								slide_show = 1;
							}
							if( slide_scroll_pos < s_h && slide_scroll_pos < slide_previous_scroll_pos){
								if( ism_slide_display_once == 1 || slide_display_scroll_up == 1) return;
								slide_display_scroll_down = 0;
								slide_display_scroll_up = 1;
								slide_show = 1;
							}
							if( slide_show == 1){
								ism_slide_in( "#'.$id.'", "'.$effect.'", '.$meta_arr['delay'].', '.$meta_arr['slide_duration'].' );
								ism_slide_display_once = '.$display_once.';
							}
							slide_previous_scroll_pos	= parseInt(jQuery(window).scrollTop());
						});
			';
		break;
		case 'scroll_bottom':
			$str .= '
						jQuery(document).scroll(function(){
							if( jQuery(window).scrollTop() + jQuery(window).height() != jQuery(document).height() || ism_slide_display_once == 1 ) return;
							ism_slide_in( "#'.$id.'", "'.$effect.'", '.$meta_arr['delay'].', '.$meta_arr['slide_duration'].' );
							ism_slide_display_once = '.$display_once.';
						});
			';
		break;
	}
	return $str;
}

function ism_style_for_slide($attr, $meta_arr){
	$css = '';
	$aditional_css = '';

	/********************************* PARENTS ***************************************/
		$css .= '
		.ism_slide_box{
		';
		if(isset($meta_arr['top_bottom'])){
			//top or bottom
			if(isset($meta_arr['top_bottom_type'])) $type = $meta_arr['top_bottom_type'];
			else $type = 'px';
			$css .= "{$meta_arr['top_bottom']} : {$meta_arr['top_bottom_value']}$type;";
		}
		if(isset($meta_arr['left_right'])){
			//left or right
			if(isset($meta_arr['left_right_type'])) $type = $meta_arr['left_right_type'];
			else $type = 'px';
			$css .= "{$meta_arr['left_right']} : {$meta_arr['left_right_value']}$type;";
		}

		if(isset($meta_arr['width'])) $css .= 'width: '.$meta_arr['width'].'px;';
		if(isset($meta_arr['height']) && $meta_arr['height']!='') $css .= 'height: '.$meta_arr['height'].'px;';
		if(isset($meta_arr['padding'])) $css .= 'padding: '.$meta_arr['padding'].'px;';
		$css .= '}';


	/*************************************** ITEMS **************************************/
	$css .= "

			#{$attr['indeed_wrap_id']} .ism_item{
				";
		if($meta_arr['list_align']=='vertical'){
			////VERTICAL ALIGN
				if((isset($meta_arr['position']) && $meta_arr['position']=='custom') || (isset($website_display) && $website_display==true) ){
					$margin_arr = array(
											'ism_template_0' => '4px 0px;',
											'ism_template_1' => '4px 0px;',
											'ism_template_2' => '4px 0px;',
											'ism_template_3' => '4px 0px;',
											'ism_template_4' => '7px 0px;',
											'ism_template_5' => '',
											'ism_template_6' => '7px 0px;',
											'ism_template_7' => '4px 0px;',
											'ism_template_8' => '4px 0px;',
											'ism_template_9' => '',
											'ism_template_10' => '3px 0px;',
										);
				if(isset($margin_arr[$meta_arr['template']]) && $margin_arr[$meta_arr['template']]!=''){
					$css .= 'margin: ' . $margin_arr[$meta_arr['template']] . ' !important;';
				}
			}
		}else{
					////HORIZONTAL ALIGN
			if((isset($meta_arr['position']) && $meta_arr['position']=='custom') || (isset($website_display) && $website_display==true) ){
					$margin_arr = array(
										'ism_template_0' => '0px 4px;',
										'ism_template_1' => '0px 4px;',
										'ism_template_2' => '0px 4px;',
										'ism_template_3' => '0px 4px;',
										'ism_template_4' => '0px 7px;',
										'ism_template_5' => '',
										'ism_template_6' => '0px 7px;',
										'ism_template_7' => '0px 4px;',
										'ism_template_8' => '0px 4px;',
										'ism_template_9' => '',
										'ism_template_10' => '0px 3px;',
										);
				if(isset($margin_arr[$meta_arr['template']]) && $margin_arr[$meta_arr['template']]!=''){
					$css .= 'margin: ' . $margin_arr[$meta_arr['template']] . ' !important;';
				}
			}
		}
		//CUSTOM TOP TEMPLATE 5
		if(isset($meta_arr['top_bottom']) && $meta_arr['top_bottom']=='top' && $meta_arr['template']=='ism_template_5'){
			$css .= '
					-webkit-box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
					-moz-box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
					box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
					';
					$aditional_css .= '#'.$attr['indeed_wrap_id'].' .ism_item:hover{
												top:initial !important;
												bottom: -1px !important;
										}';
		}
		//CUSTOM RIGHT FOR TEMPLATE 9
		if(isset($meta_arr['left_right']) && $meta_arr['left_right']=='right' && $meta_arr['template']=='ism_template_9'){
			$css .= '
					-webkit-box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
							-moz-box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
									box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
					border-top-left-radius:5px;
					border-bottom-left-radius:5px;
					margin-right:-5px;
					';
				$aditional_css .= '#'.$attr['indeed_wrap_id'].' .ism_item:hover{
										left: initial !important;
										right: 5px !important;
									}';

		}
	$css .= "}";

	if((!isset($meta_arr['display_full_name']) || $meta_arr['display_full_name']=='false') && (!isset($meta_arr['display_counts']) || $meta_arr['display_counts']=='false')  ){
		$css .="#".$attr['indeed_wrap_id']." .ism_item .fa-ism, #".$attr['indeed_wrap_id']." .ism_item .ism-sc-icon{";
		 $css .= "float:none;";
		$css .="}";
	}


	$css .="#{$attr['indeed_wrap_id']} .ism_item_wrapper{
				display: ";
	if($meta_arr['list_align']=='vertical'){
		$css .= "block;";
	}else{
					////HORIZONTAL ALIGN
			$css .= "inline-block;";
	}
	$css .= "}";


	if(isset($meta_arr['no_cols']) && $meta_arr['no_cols'] > 0){
		$cols = 100/$meta_arr['no_cols'];

		$css .= "#{$attr['indeed_wrap_id']} {
					display:block;
				}";
		$css .= "#{$attr['indeed_wrap_id']} .ism_item_wrapper{";
			$css .= "width:".$cols."%;";
		$css .= "}";

	}

	if(isset($meta_arr['box_align']) && $meta_arr['list_align']!='vertical'){
		$css .= "#{$attr['indeed_wrap_id']} {
					display:block;
					text-align:".$meta_arr['box_align']."
				}";
	}

	$css .= $aditional_css;

	return $css;
}
//////////////SLIDE IN////////////////


function ims_format_source_text( $str ){
	$str = preg_replace("/\n\n+/", "\n\n", $str);
	$str_arr = preg_split('/\n\s*\n/', $str, -1, PREG_SPLIT_NO_EMPTY);
	$str = '';

	foreach ( $str_arr as $str_val ) {
		$str .= '<p>' . trim($str_val, "\n") . "</p>\n";
	}
	return $str;
}

function ism_add_new_custom_share_url(){
	if(isset($_REQUEST['go_custom_share_url']) && $_REQUEST['go_custom_share_url']!=''){
		if($_REQUEST['go_custom_share_url']=='All' || $_REQUEST['go_custom_share_url']=='ALL') $_REQUEST['go_custom_share_url'] = 'all';
		$arr = array( 'title' => $_REQUEST['go_custom_share_title'],
					  'message' => $_REQUEST['go_custom_share_message'],
					  'feat_image' => $_REQUEST['go_custom_share_feat_image'],
					  'shared_url' => $_REQUEST['go_custom_share_shared_url'],
					);
		$data = get_option('ism_go_custom_share_c');
		if($data!==FALSE){
			//update
			$data[$_REQUEST['go_custom_share_url']] = $arr;
			update_option('ism_go_custom_share_c', $data);
		}else{
			//create
			$data[$_REQUEST['go_custom_share_url']] = $arr;
			add_option('ism_go_custom_share_c', $data);
		}
	}
}

function ism_check_custom_share_data($url){
	$data = get_option('ism_go_custom_share_c');
	if($data===FALSE) return FALSE;
	else{
		if(isset($data[$url]) && $data[$url]!=''){
			return $data[$url];
		}elseif(isset($data['all']) && count($data['all'])>0){
			return $data['all'];
		}else{
			return FALSE;
		}
	}
}

function ism_custom_share_url_return($url){
	$data = get_option('ism_go_custom_share_c');
	if($data!==FALSE){
		if(isset($data[$url]['shared_url']) && $data[$url]['shared_url']!='') return $data[$url]['shared_url'];
		elseif(isset($data['all']['shared_url']) && $data['all']['shared_url']!='')	return $data['all']['shared_url'];
	}
	return $url;//return standard url back
}

function print_total_shares_js($indeed_wrap_id){
	return 'if(typeof total_share_obj=="undefined"){
    				total_share_obj = {};
    			}
    			total_share_obj["#'.$indeed_wrap_id.'"]=0;';//true
}

function print_total_shares_html($meta_arr, $html){
	$display = 'inline-block';

	$str = '<div class="ism_total_share ism_'.$meta_arr['tc_theme'].'" style="display: '.$display.';">';
	if(isset($meta_arr['display_tc_label']) && $meta_arr['display_tc_label']==1){
		$label = get_option('ism_tc_label');
		$str .= '<div class="ism_tc_label">'.$label.'</div>';
	}
	$zoomed ='';
	if(!isset($meta_arr['display_tc_label']) || $meta_arr['display_tc_label']!=1 || !isset($meta_arr['display_tc_sublabel']) || $meta_arr['display_tc_sublabel']!=1){
		$zoomed ='ism-zoomed';
	}
	$str .= '<span class="ism_tc_count '.$zoomed.'">0</span>';
	if(isset($meta_arr['display_tc_sublabel']) && $meta_arr['display_tc_sublabel']==1){
		$sublabel = get_option('ism_tc_sublabel');
		$str .= '<div class="ism_tc_sublabel">'.$sublabel.'</div>';
	}
	$str .= '</div>';
	if($meta_arr['tc_position']=='after'){
		$html = $html . $str;
	}else $html = $str . $html;

	return $html;
}

function ism_reorder_sm_list($arr){
	$list = get_option('ism_order');
	if( !isset($list) || count($list)==0 || $list == FALSE) return $arr;
	asort($list);
	$new_arr = array();
	foreach($list as $k=>$v){
		if(isset($arr[$k])){
			$new_arr[] = $arr[$k];
			unset($arr[$k]);
		}
	}

	if(count($arr)>0){
		foreach($arr as $value){
			$new_arr[] = $value;
		}
	}

	return $new_arr;
}
function ismAfterShareHtml($meta_arr, $attr){
	if(!isset($meta_arr['after_share_enable']) || $meta_arr['after_share_enable']==0) return '';

	$str = '';

	if(!isset($meta_arr['after_share_title']) || $meta_arr['after_share_title']=='') $meta_arr['after_share_title'] = 'Thanks for Sharing';

	$data = ism_after_share_go_s_get_metas();
	if(isset($data['ism_after_share_m_custom_css']) && $data['ism_after_share_m_custom_css']!='') $str .= '<style>'.$data['ism_after_share_m_custom_css'].'</style>';

	$str .= '<div class="ism_after_share_wrapper" id="wrapper-'.$attr['after_share_id'].'" style="display: none;">'
	.'<div class="ism_after_share_box" id="'.$attr['after_share_id'].'" style="top: 20%;left: calc( 50% - '. $data['ism_after_share_m_width']/2 .'px);max-width:  '.$data['ism_after_share_m_width'].'px;min-height: '.$data['ism_after_share_m_height'].'px;display: none;">'
	.'<div class="ism_top_after_share"> '.$meta_arr['after_share_title'].'</div>'
	.'<div class="ism_close_after_share" onclick="ismas_close_popup(\''.$attr['after_share_id'].'\');"></div>'
	.'<div class="ism_after_share_above_content">';
	if($meta_arr['after_share_content']!==FALSE){
		$str .= stripslashes($meta_arr['after_share_content']);
	}
	$str .= '</div>'
	.'</div>'
	.'</div>';
	return $str;
}

function ism_print_outside_js_function($meta_arr, $attr, $html, $js){
	if(isset($meta_arr['position']) && $meta_arr['position']=='custom'){
		$js .= "jQuery(window).bind('load', function(){ismDisplayInsidePost('#".$attr['indeed_wrap_id']."', '#".$attr['before_wrap_id']."', '".$meta_arr['top_bottom']."', '".$meta_arr['top_bottom_value']."', '".$meta_arr['left_right']."', '".$meta_arr['left_right_value']."');});";
		$html = '<div id="'.$attr['before_wrap_id'].'" class="indeed_second_before_wrapp">' . $html . '</div>';
		$html = '<div class="indeed_before_wrapp">' . $html . '</div>';
	}
	$r_arr['html'] = $html;
	$r_arr['js'] = $js;
	return $r_arr;
}

function ism_after_share_go_s_get_metas(){
	$arr = array(
			'ism_after_share_m_width' => '500',
			'ism_after_share_m_height' => '200',
			'ism_after_share_m_custom_css' => '',
	);
	foreach($arr as $k=>$v){
		$data = get_option($k);
		if($data!==FALSE) $arr[$k] = $data;
	}
	return $arr;
}


function ism_return_general_labels_sm( $type='long_keys', $exculde_plusone = true, $only = '', $all_follow=FALSE, $return_all=FALSE ){
	$arr = array(
			'fb' => array( 'long_key' => 'facebook', 'label' => 'Facebook', 'count' => true, 'locker' => true),
			'tw' => array( 'long_key' => 'twitter', 'label' => 'Twitter', 'count' => true, 'locker' => true),
			'goo' => array( 'long_key' => 'google', 'label' => 'Google+', 'count' => true, 'locker' => false),
			'go1' => array( 'long_key' => 'google_plus', 'label' => 'Google +1', 'count' => false, 'locker' => true),
			'pt' => array( 'long_key' => 'pinterest', 'label' => 'Pinterest', 'count' => true, 'locker' => TRUE),
			'li' => array( 'long_key' => 'linkedin', 'label' => 'Linkedin', 'count' => true, 'locker' => true),
			'dg' => array( 'long_key' => 'digg', 'label' => 'DiggDigg', 'count' => false, 'locker' => false),
			'tbr' => array( 'long_key' => 'tumblr', 'label' => 'Tumblr', 'count' => false, 'locker' => false),
			'su' => array( 'long_key' => 'stumbleupon', 'label' => 'Stumbleupon', 'count' => true, 'locker' => false),
			'vk' => array( 'long_key' => 'vk', 'label' => 'VKontakte', 'count' => true, 'locker' => TRUE),
			'rd' => array( 'long_key' => 'reddit', 'label' => 'Reddit', 'count' => true, 'locker' => FALSE),
			'dl' => array( 'long_key' => 'delicious', 'label' => 'Delicious', 'count' => false, 'locker' => false),
			'wb' => array( 'long_key' => 'weibo', 'label' => 'Weibo', 'count' => false, 'locker' => false),
			'xg' => array( 'long_key' => 'xing', 'label' => 'Xing', 'count' => false, 'locker' => false),
			'pf' => array( 'long_key' => 'print', 'label' => 'Print', 'count' => true, 'locker' => false),
			'email' => array( 'long_key' => 'email', 'label' => 'E-mail', 'count' => true, 'locker' => false),
			'ok' => array( 'long_key' => 'ok', 'label' => 'Odnoklassniki', 'count' => true, 'locker' => TRUE),
			'whatsapp' => array( 'long_key' => 'whatsapp', 'label' => 'Whatsapp', 'count' => false, 'locker' => false),
			'bufferapp' => array( 'long_key' => 'bufferapp', 'label' => 'Bufferapp', 'count' => true, 'locker' => false),
			'mailru' => array( 'long_key' => 'mailru', 'label' => 'Mail.ru', 'count' => false, 'locker' => false),
			'meneame' => array( 'long_key' => 'meneame', 'label' => 'Meneame', 'count' => false, 'locker' => false),
			'evernote' => array( 'long_key' => 'evernote', 'label' => 'Evernote', 'count' => false, 'locker' => false),
			'getpocket' => array( 'long_key' => 'getpocket', 'label' => 'GetPocket', 'count' => false, 'locker' => false),
			'flattr' => array( 'long_key' => 'flattr', 'label' => 'Flattr', 'count' => false, 'locker' => false),
			'managewp' => array( 'long_key' => 'managewp', 'label' => 'ManageWP', 'count' => false, 'locker' => false),
			'myspace' => array( 'long_key' => 'myspace', 'label' => 'MySpace', 'count' => false, 'locker' => false),
			'ymail' => array('long_key' => 'ymail', 'label' => 'Yahoo Mail', 'count' => false, 'locker' => false),
			'gmail' => array('long_key' => 'gmail', 'label' => 'GMail', 'count' => false, 'locker' => false),
			'hackernews' => array('long_key' => 'hackernews', 'label' => 'HackerNews', 'count' => false, 'locker' => false),
			'blogger' => array('long_key'=>'blogger', 'label'=>'Blogger', 'count'=>FALSE, 'locker'=>FALSE, 'font'=>'socicon'),
			'amazon' => array('long_key'=>'amazon', 'label'=>'Amazon', 'count'=>FALSE, 'locker'=>FALSE, 'font'=>'socicon'),
			'newsvine' => array('long_key'=>'newsvine', 'label'=>'Newsvine', 'count'=>FALSE, 'locker'=>FALSE, 'font'=>'socicon'),
			'viadeo' => array('long_key'=>'viadeo', 'label'=>'Viadeo', 'count'=>FALSE, 'locker'=>FALSE, 'font'=>'socicon'),
			'douban' => array('long_key'=>'douban', 'label'=>'DOUBAN', 'count'=>FALSE, 'locker'=>FALSE, 'font'=>'socicon'),
			'baidu' => array('long_key'=>'baidu', 'label'=>'Baidu', 'count'=>FALSE, 'locker'=>FALSE, 'font'=>'socicon'),
			'identica' => array('long_key'=>'identica', 'label'=>'Identica', 'count'=>FALSE, 'locker'=>FALSE, 'font'=>'socicon'),
			'yammer' => array( 'long_key' => 'yammer', 'label' => 'Yammer', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'sms' => array( 'long_key' => 'sms', 'label' => 'SMS', 'count' => FALSE, 'locker' => FALSE),
			'viber' => array( 'long_key' => 'viber', 'label' => 'Viber', 'count' => FALSE, 'locker' => FALSE),
			'telegram' => array('long_key'=>'telegram', 'label'=>'Telegram', 'count'=>FALSE, 'locker'=>FALSE),
			'comments' => array('long_key'=>'comments', 'label'=>'Comments', 'count'=>TRUE, 'locker'=>FALSE),

			'love_like' => array('long_key'=>'love_like', 'label'=>'Love This', 'count'=>TRUE, 'locker'=>FALSE),
			'aol' => array('long_key'=>'aol', 'label'=>'AOL', 'count'=>FALSE, 'locker'=>FALSE),
			'flipboard' => array('long_key'=>'flipboard', 'label'=>'Flipboard', 'count'=>FALSE, 'locker'=>FALSE),
			'mailto' => array('long_key'=>'mailto', 'label'=>'Send Mail', 'count'=>FALSE, 'locker'=>FALSE),

			'line' => array('long_key'=>'line', 'label'=>'Line', 'count'=>FALSE, 'locker'=>FALSE),
			'yummly' => array('long_key'=> 'yummly', 'label'=> 'Yummly', 'count'=> FALSE, 'locker'=> FALSE),
			'skype' => array('long_key'=>'skype', 'label'=>'Skype', 'count'=>FALSE, 'locker'=>FALSE),
			'messenger' => array('long_key'=>'messenger', 'label'=>'Messenger', 'count'=>FALSE, 'locker'=>FALSE),
			'kakao' => array('long_key'=>'kakao', 'label'=>'Kakao', 'count'=>FALSE, 'locker'=>FALSE),
			'livejournal' => array('long_key'=>'livejournal', 'label'=>'LiveJournal', 'count'=>FALSE, 'locker'=>FALSE),
			'hatena' => array('long_key'=>'hatena', 'label'=>'Hatena', 'count'=>FALSE, 'locker'=>FALSE),
			'renren' => array('long_key'=>'renren', 'label'=>'Renren', 'count'=>FALSE, 'locker'=>FALSE),
			'tencent' => array('long_key'=>'tencent', 'label'=>'Tencent', 'count'=>FALSE, 'locker'=>FALSE),
			'naver' => array('long_key'=>'naver', 'label'=>'Naver', 'count'=>FALSE, 'locker'=>FALSE),
			'qr' => array('long_key'=>'qr', 'label'=>'QR', 'count'=>FALSE, 'locker'=>FALSE),
			'edgar' => array('long_key'=>'edgar', 'label'=>'Edgar', 'count'=>FALSE, 'locker'=>FALSE),
			'fintel' => array('long_key'=>'fintel', 'label'=>'Fintel', 'count'=>FALSE, 'locker'=>FALSE),
			'mix' => array('long_key'=>'mix', 'label'=>'Mix', 'count'=>FALSE, 'locker'=>FALSE),
			'wechat' => array('long_key'=>'wechat', 'label'=>'weChat', 'count'=>FALSE, 'locker'=>FALSE),
			'bibsonomy' => array('long_key'=>'bibsonomy', 'label'=>'BibSonomy', 'count'=>FALSE, 'locker'=>FALSE),
			'diigo' => array('long_key'=>'diigo', 'label'=>'Diigo', 'count'=>FALSE, 'locker'=>FALSE),
			'subscribe' => array('long_key'=>'subscribe', 'label'=>'Subscribe', 'count'=>TRUE, 'locker'=>FALSE)

	);

	if ($all_follow){
		$follow_arr = array(
			'foursquare' => array( 'long_key' => 'foursquare', 'label' => 'Foursquare', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'skype' => array( 'long_key' => 'skype', 'label' => 'Skype', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'yelp' => array( 'long_key' => 'yelp', 'label' => 'Yelp', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'feedburner' => array( 'long_key' => 'feedburner', 'label' => 'Feedburner', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'soundcloud' => array( 'long_key' => 'soundcloud', 'label' => 'Soundcloud', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'spotify' => array( 'long_key' => 'spotify', 'label' => 'Spotify', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'grooveshark' => array( 'long_key' => 'grooveshark', 'label' => 'Grooveshark', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'mixcloud' => array( 'long_key' => 'mixcloud', 'label' => 'Mixcloud', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'lastfm' => array( 'long_key' => 'lastfm', 'label' => 'last.fm', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'youtube' => array( 'long_key' => 'youtube', 'label' => 'youtube', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'vimeo' => array( 'long_key' => 'vimeo', 'label' => 'vimeo', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'dailymotion' => array( 'long_key' => 'dailymotion', 'label' => 'Dailymotion', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'vine' => array( 'long_key' => 'vine', 'label' => 'Vine', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'flickr' => array( 'long_key' => 'flickr', 'label' => 'Flickr', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'500px' => array( 'long_key' => '500px', 'label' => '500PX', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'instagram' => array( 'long_key' => 'instagram', 'label' => 'Instagram', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'technorati' => array( 'long_key' => 'technorati', 'label' => 'Technorati', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'dribbble' => array( 'long_key' => 'dribbble', 'label' => 'Dribbble', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'envato' => array( 'long_key' => 'envato', 'label' => 'Envato', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'behance' => array( 'long_key' => 'behance', 'label' => 'Behance', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'deviantart' => array( 'long_key' => 'deviantart', 'label' => 'Deviantart', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'forrst' => array( 'long_key' => 'forrst', 'label' => 'Forrst', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'play' => array( 'long_key' => 'play', 'label' => 'Play Store', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'zerply' => array( 'long_key' => 'zerply', 'label' => 'Zerply', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'wikipedia' => array( 'long_key' => 'wikipedia', 'label' => 'Wikipedia', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'apple' => array( 'long_key' => 'apple', 'label' => 'Apple', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'github' => array( 'long_key' => 'github', 'label' => 'Github', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'friendfeed' => array( 'long_key' => 'friendfeed', 'label' => 'Friendfeed', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'bebo' => array( 'long_key' => 'bebo', 'label' => 'Bebo', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'zynga' => array( 'long_key' => 'zynga', 'label' => 'Zynga', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'steam' => array( 'long_key' => 'steam', 'label' => 'Steam', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'xbox' => array( 'long_key' => 'xbox', 'label' => 'Xbox', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'windows' => array( 'long_key' => 'windows', 'label' => 'Windows', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'outlook' => array( 'long_key' => 'outlook', 'label' => 'Outlook', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'coderwall' => array( 'long_key' => 'coderwall', 'label' => 'Coderwall', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'tripadvisor' => array( 'long_key' => 'tripadvisor', 'label' => 'Tripadvisor', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'appnet' => array( 'long_key' => 'appnet', 'label' => 'Appnet', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'goodreads' => array( 'long_key' => 'goodreads', 'label' => 'Goodreads', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'tripit' => array( 'long_key' => 'tripit', 'label' => 'Tripit', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'lanyrd' => array( 'long_key' => 'lanyrd', 'label' => 'Lanyrd', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'slideshare' => array( 'long_key' => 'slideshare', 'label' => 'Slideshare', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'rss' => array( 'long_key' => 'rss', 'label' => 'RSS', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'disqus' => array( 'long_key' => 'disqus', 'label' => 'Disqus', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'houzz' => array( 'long_key' => 'houzz', 'label' => 'Houzz', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'mail' => array( 'long_key' => 'mail', 'label' => 'Mail', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'patreon' => array( 'long_key' => 'patreon', 'label' => 'Patreon', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'paypal' => array( 'long_key' => 'paypal', 'label' => 'Paypal', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'playstation' => array( 'long_key' => 'playstation', 'label' => 'Playstation', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'smugmug' => array( 'long_key' => 'smugmug', 'label' => 'Smugmug', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'swarm' => array( 'long_key' => 'swarm', 'label' => 'Swarm', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'triplej' => array( 'long_key' => 'triplej', 'label' => 'Triplej', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'stackoverflow' => array( 'long_key' => 'stackoverflow', 'label' => 'Stackoverflow', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'drupal' => array( 'long_key' => 'drupal', 'label' => 'Drupal', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'android' => array( 'long_key' => 'android', 'label' => 'Android', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'meetup' => array( 'long_key' => 'meetup', 'label' => 'Meeptup', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'persona' => array( 'long_key' => 'persona', 'label' => 'Mozilla Persona', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'ello' => array( 'long_key' => 'ello', 'label' => 'ello', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'8tracks' => array( 'long_key' => '8tracks', 'label' => '8tracks', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'twitch' => array( 'long_key' => 'twitch', 'label' => 'Twitch', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'airbnb' => array( 'long_key' => 'airbnb', 'label' => 'Airbnb', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'storehouse' => array( 'long_key' => 'storehouse', 'label' => 'Storehouse', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'icq' => array( 'long_key' => 'icq', 'label' => 'ICQ', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'modelmayhem' => array( 'long_key' => 'modelmayhem', 'label' => 'Model Mayhem', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'istock' => array( 'long_key' => 'istock', 'label' => 'Istock', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'angellist' => array( 'long_key' => 'angellist', 'label' => 'Angellist', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'periscope' => array( 'long_key' => 'periscope', 'label' => 'Periscope', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'ravelry' => array( 'long_key' => 'ravelry', 'label' => 'Ravelry', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'snapchat' => array( 'long_key' => 'snapchat', 'label' => 'Snapchat', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'qq' => array( 'long_key' => 'qq', 'label' => 'QQ', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),
			'renren' => array( 'long_key' => 'renren', 'label' => 'RenRen', 'count' => FALSE, 'locker' => FALSE, 'font'=>'socicon'),

		);
		$arr = $arr + $follow_arr;
		if (!$return_all){
			unset($arr['email']);
			unset($arr['pf']);
			unset($arr['whatsapp']);
		}
	}

	if ($exculde_plusone){
		unset($arr['go1']);
	}

	$data = get_option('ism_general_sm_labels');
	if ($only==''){
		foreach ( $arr as $k => $v ){
			$key = $v['long_key'];
			if (isset($data[$key]) && $data[$key]!=''){
				$arr[$k]['label'] = $data[$key];
			}
		}
	} else {
		foreach ( $arr as $k => $v ){
			if (isset($v[$only]) && $v[$only]){
				$key = $v['long_key'];
				if (isset($data[$key]) && $data[$key]!=''){
					$arr[$k]['label'] = $data[$key];
				}
			} else {
				unset($arr[$k]);
			}

		}
	}

	unset($data);
	if ($type=='long_keys'){
		//return array as $arr['facebook'] = 'Facebook';
		foreach($arr as $value ){
			$data[$value['long_key']] = $value['label'];
		}
	} else if ($type=='short_keys'){
		//return array as $arr['fb'] = 'Facebook';
		foreach($arr as $key=>$value ){
			$data[$key] = $value['label'];
		}
	} else {
		// return entire array 'fb' => array( 'long_key' => 'facebook', 'label' => 'Facebook', 'count' => true, 'locker' => true),
		$data = $arr;
	}
	return $data;
}

function ism_print_standard_style( $attr, $meta_arr ){
	$css = '';
	$aditional_css = '';

	$css .= '#'.$attr['indeed_wrap_id'].'{';
	//position
	if(isset($meta_arr['floating'])){
		$css .= "position: ";
		if($meta_arr['floating']=='no') $css .= "absolute;";
		else $css .= "fixed;";
	}

	if(isset($meta_arr['top_bottom'])){
		//top or bottom
		if(isset($meta_arr['top_bottom_type'])) $type = $meta_arr['top_bottom_type'];
		else $type = 'px';
		$css .= "{$meta_arr['top_bottom']} : {$meta_arr['top_bottom_value']}$type;";
		//left or right
		if(isset($meta_arr['left_right_type'])) $type = $meta_arr['left_right_type'];
		else $type = 'px';
		$css .= "{$meta_arr['left_right']} : {$meta_arr['left_right_value']}$type;";
	}
	if(isset($meta_arr['position']) && $meta_arr['position']=='custom'){
		$css .= "display: none;";
		$css .= "position: absolute;";
	}
	$css .= "}";
	$css .= '#'.$attr['indeed_wrap_id'] . ' .ism_item{';
	if($meta_arr['list_align']=='vertical'){
		////VERTICAL ALIGN
		if((isset($meta_arr['position']) && $meta_arr['position']=='custom') || ($meta_arr['type']=='ism-website-display') ){
			$margin_arr = array(
					'ism_template_0' => '0px 0px;',
					'ism_template_1' => '0px 0px;',
					'ism_template_2' => '4px 0px;',
					'ism_template_3' => '4px 0px;',
					'ism_template_4' => '7px 0px;',
					'ism_template_5' => '',
					'ism_template_6' => '7px 0px;',
					'ism_template_7' => '4px 0px;',
					'ism_template_8' => '0px 0px;',
					'ism_template_9' => '',
					'ism_template_10' => '3px 0px;',
			);
			if(isset($margin_arr[$meta_arr['template']]) && $margin_arr[$meta_arr['template']]!='') $css .= 'margin: ' . $margin_arr[$meta_arr['template']] . ' !important;';
		}
	}else{
		////HORIZONTAL ALIGN
		if((isset($meta_arr['position']) && $meta_arr['position']=='custom') || ($meta_arr['type']=='ism-website-display') ){
			$margin_arr = array(
					'ism_template_0' => '0px 4px;',
					'ism_template_1' => '0px 4px;',
					'ism_template_2' => '0px 4px;',
					'ism_template_3' => '0px 4px;',
					'ism_template_4' => '0px 7px;',
					'ism_template_5' => '',
					'ism_template_6' => '0px 7px;',
					'ism_template_7' => '0px 4px;',
					'ism_template_8' => '0px 4px;',
					'ism_template_9' => '',
					'ism_template_10' => '0px 3px;',
			);
			if(isset($margin_arr[$meta_arr['template']]) && $margin_arr[$meta_arr['template']]!='') $css .= 'margin: ' . $margin_arr[$meta_arr['template']] . ' !important;';
		}
	}
	//CUSTOM TOP TEMPLATE 5
	if(isset($meta_arr['top_bottom']) && $meta_arr['top_bottom']=='top' && $meta_arr['template']=='ism_template_5'){
		$css .= '
		-webkit-box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
		-moz-box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
		box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
		';
		$aditional_css = '#'.$attr['indeed_wrap_id'].' .ism_item:hover{
		top:initial !important;
		bottom: -1px !important;
	}';
	}
	//CUSTOM RIGHT FOR TEMPLATE 9
	if(isset($meta_arr['left_right']) && $meta_arr['left_right']=='right' && $meta_arr['template']=='ism_template_9'){
		$css .= '
		-webkit-box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
		-moz-box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
		box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
		border-top-left-radius:5px;
		border-bottom-left-radius:5px;
		margin-right:-5px;
		';
		$aditional_css = '#'.$attr['indeed_wrap_id'].' .ism_item:hover{
		left: initial !important;
		right: 5px !important;
	}';
	}
	$css .= "}"; //end of .ism_item style

	if((!isset($meta_arr['display_full_name']) || $meta_arr['display_full_name']=='false') && (!isset($meta_arr['display_counts']) || $meta_arr['display_counts']=='false')  ){
		$css .= '#'.$attr['indeed_wrap_id'].' .ism_item .fa-ism, #'.$attr['indeed_wrap_id'].' .ism_item .ism-sc-icon{';
		$css .= 'float:none;';
		$css .= '}';
	}

	$css .= '#'.$attr['indeed_wrap_id'] .' .ism_item_wrapper{';
	$css .= 'display: ';
	if($meta_arr['list_align']=='vertical'){
		///VERTICAL
		$css .= 'block;';
	}else{
		////HORIZONTAL
		$css .= 'inline-block;';
	}
	$css .= '}';

	if(isset($meta_arr['no_cols']) && $meta_arr['no_cols'] > 0){
		$cols = 100/$meta_arr['no_cols'];
		$css .= '#'. $attr['indeed_wrap_id'] .' {
		display:block;
	}';
		$css .= '#' .$attr['indeed_wrap_id'] . ' .ism_item_wrapper{';
		$css .= 'width:'.$cols.'%;';
		$css .= '}';
	}

	if(isset($meta_arr['box_align']) && $meta_arr['box_align'] != 'left' && $meta_arr['list_align']!='vertical'){
		$css .= '#' .$attr['indeed_wrap_id'] . '{';
		$css .= 'display: block;';
		$css .= 'text-align: '.$meta_arr['box_align'].';';
		$css .= '}';
	}

	$css .= $aditional_css;
	return $css;
}

function ism_print_mobile_style( &$meta_arr, $attr ){
	$css = '';
	if(isset($meta_arr['type']) && $meta_arr['type']=='ism-mobile-display'){ //available only in ism_mobile_display()
		$css .= '#'.$attr['indeed_wrap_id'].'{';//open #$attr['indeed_wrap_id']

		if(!isset($meta_arr['mobile_special_template']) || $meta_arr['mobile_special_template']=='0'){
			# ZOOM & OPACITY, not available in mobile special template
			if(isset($meta_arr['opacity']) && $meta_arr['opacity']!='') $css .= 'opacity: '.$meta_arr['opacity'].';';
			if(isset($meta_arr['zoom']) && $meta_arr['zoom']!='') $css .= 'zoom: '.$meta_arr['zoom'].';';

		}

		if(isset($meta_arr['mobile_special_template']) && $meta_arr['mobile_special_template']!='0'){
			//RE-write the template variable
			$meta_arr['template'] = $meta_arr['mobile_special_template'];
			if($meta_arr['mobile_special_template'] == 'ism_template_mob_1' || $meta_arr['mobile_special_template'] == 'ism_template_mob_2'){
				$css .= 'left: 0px;';
				$css .= 'width: 100%;';
			}
			//mobile predefined position
			$css .= 'bottom: 0px;';
			$css .= 'position: fixed;';
			//$css .= 'text-align: center;';
			unset($meta_arr['top_bottom']); //unset the top bottom options
			$meta_arr['list_align'] = 'horizontal';//for mobile predefined position only horizontal align it's ok

			if(isset($meta_arr['floating'])) unset($meta_arr['floating']);

		}elseif(isset($meta_arr['predefined_position']) && $meta_arr['predefined_position']!='' && isset($meta_arr['custom_position']) && $meta_arr['custom_position']==0){
			//mobile predefined position
			$css .= $meta_arr['predefined_position'].': 0px;';
			$css .= 'position: fixed;';
			$css .= 'text-align: center;';
			$css .= 'width: 100%;';//
			if(isset($meta_arr['behind_bk']) && $meta_arr['behind_bk']==1){
				$css .= 'background: rgba(255,255,255, 0.7);';
				$css .= 'padding: 7px 0px;';
			}
			unset($meta_arr['top_bottom']); //unset the top bottom options
			$meta_arr['list_align'] = 'horizontal';//for mobile predefined position only horizontal align it's ok
		}
		$css .= '}';//close #$attr['indeed_wrap_id']

		if(isset($meta_arr['mobile_special_template']) && $meta_arr['mobile_special_template'] == 'ism_template_mob_1'){
			$css .= '#'.$attr['indeed_wrap_id'].' .ism_item_wrapper{';//open	#$attr['indeed_wrap_id'] .ism_item
			$sm_num_count = count(explode(",",$meta_arr['list']));
			if($sm_num_count>4){
				$css .= "width: 25%;";
			}else{
				$sm_item_width = 100/$sm_num_count;
				$css .= "width: ".$sm_item_width."%;";
			}
			$css .= '}';//close	#$attr['indeed_wrap_id'] .ism_item
		}
	}

	return $css;
}

function ism_print_default_div_parents($attr, $meta_arr, $html){
	$class = '';
	$inline_style = '';
	if(isset($attr['locker_div_id']) && $attr['locker_div_id']!='') $inline_style = 'text-align: center;display: block;';
	if(isset($meta_arr['animation']) && $meta_arr['animation']!='' && $meta_arr['animation']!='none') $class = 'ism_animated '.$meta_arr['animation'];
	$html = '<div class="ism_wrap '.$meta_arr['template'].' '.$class.' '.$meta_arr['type'].'" id="'.$attr['indeed_wrap_id'].'" style="'.$inline_style.'" >' . $html . '</div>';
	return $html;
}



function ism_if_display($where, $disable_type=false){
	if(!$where) return FALSE;
	$arr = explode(',', $where);

	@$post_id = get_the_ID();
	$url = ISM_PROTOCOL . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

	if ($url!=get_permalink($post_id) && strpos($url, '?')!==FALSE){
		if(strpos($url, '&')!==FALSE && substr($url, 0, strpos($url, '&')) == get_permalink($post_id)){
			$url = get_permalink($post_id);
		}else{
			$url = substr($url, 0, strpos($url, '?'));//remove extra params
		}
	}

	if( $url && $url==get_permalink($post_id) ){
		/******************* check post, page, cpt *****************/
		if($post_id){
			if($disable_type){
				@$disable = get_post_meta($post_id, $disable_type, TRUE);
				if($disable==1) return FALSE;
			}

			$post_type = get_post_type($post_id);
			switch($post_type){
				case 'post':
					if(in_array('post', $arr)) return TRUE;
				break;
				case 'page':
					if(in_array('page', $arr)) return TRUE;
				break;
				case 'product':
					if(in_array('product', $arr)) return TRUE;
				break;
				case 'bp_group':
					if(in_array('bp_group', $arr)) return TRUE;
				break;
				case 'bp_activity':
					if(in_array('bp_activity', $arr)) return TRUE;
				break;
				case 'bp_members':
					if(in_array('bp_members', $arr)) return TRUE;
				break;
				default:
					//custom post type
					$custom_post_types = check_arr_for_prefix($arr, 'cpt_');
					if($custom_post_types!==FALSE && count($custom_post_types)>0 && !is_tax()){
						foreach($custom_post_types as $cpt){
							if( $post_type== $cpt) return TRUE;
						}
					}
				break;
			}

		}
	}

		/*****************************home, tax, category********************************/
		if( (is_home() || is_front_page()) && in_array('home', $arr) ) return TRUE;
		if( is_category() && in_array('cat', $arr) ) return TRUE;
		if( is_tag() && in_array('tag', $arr) ) return TRUE;
		if( is_archive() && !is_category() && !is_tag() && in_array('archive', $arr) ) return TRUE;

		//custom post types Taxonomies
		$cpt_tax = check_arr_for_prefix($arr, 'cptterm_');
		if($cpt_tax!==FALSE && count($cpt_tax)>0){
			if(is_tax()){
				global $wp_query;
				if($wp_query==FALSE) return FALSE;
				foreach($cpt_tax as $cpt){
					if(is_tax($cpt)) return TRUE;
				}
			}
		}
	return FALSE;
}

function ism_return_statistic_count_for_sm($sm, $url=false){
	global $wpdb;
	$query = "SELECT COUNT(id) as c ";
	$query .= "FROM ".$wpdb->prefix."ism_share_counts WHERE ";
	$query .= "sm='".$sm."' ";
	if($url) $query .= "AND url='".$url."' ";
	$query .= ";";
	if($sm !== 'subscribe') {
	$data = $wpdb->get_results($query);
}
if(isset($data[0]->c)) return $data[0]->c;
	return 0;
}

function ism_return_vc_locker_args($args){
	/*
	 * return args for locker from VC Locker
	 */
	$arr1 = array(
			'sm_list' => 'lk_sl',
			'template' => 'lk_t',
			'list_align' => 'lk_la',
			'display_counts' => 'lk_dc',
			'display_full_name' => 'lk_dfn',
			'sm_lock_bk' => 'lk_lb',
			'sm_lock_padding' => 'lk_lp',
			'sm_d_text' => 'lk_dt',
			'locker_template' => 'lk_lt',
			'sm_timeout_locker' => 'lk_tl',
			'enable_timeout_lk' => 'lk_etl',
			'not_registered_u' => 'lk_nru',
			'reset_locker' => 'lk_rl',
			'locker_reset_after' => 'lk_lra',
			'locker_reset_type' => 'lk_lrt',
			'ism_overlock' => 'lk_io',
			'disable_mobile' => 'lk_dm',
			'twitter_hide_mobile' => 'lk_thm',
			'twitter_unlock_onclick' => 'lk_tuo',
	);
	foreach ($arr1 as $k=>$v){
		ism_replace_arr_kv($arr, $k, $v, $args);
	}
	$arr3 = ism_convert_vc_variables($args);// prepare attr array for shortcode locker
	return $arr + $arr3;
}

function ism_replace_arr_kv(&$arr, $key, $replace, $args){
	if (isset($args[$replace])){
		$arr[$key] = $args[$replace];
	} else {
		$arr[$key] = '';
	}
}

function ism_bilty_shorturl($url){
	$enable = get_option('ism_twitter_shortlink');
	$user = get_option('bitly_user');
	$api = get_option('bitly_api');
	if($enable && $user && $api){
		$ch = curl_init('http://api.bitly.com/v3/shorten?login='.$user.'&apiKey='.$api.'&longUrl='.$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		if($ch){
			$result = (json_decode($result));
			if(isset($result->data->url)) return $result->data->url;
		}
	}
	return $url;
}

function ism_default_shortcode_variables($arr, $type="standard"){
	/*
	 * @param array with meta for shortcode, type string (standard/locker)
	 * @return array
	 */
	if ($type=='standard'){
		$default_arr = array(
				'list' => 'fb,tw,goo,pt,li,dg,tbr,su,vk,rd,dl,wb,xg',
				'list_align' => 'horizontal',
				'display_full_name' => 'true',
				'template' => 'ism_template_1',
				'display_counts' => 'false',
				'disable_mobile' => '0',
				'print_total_shares' => '0',
				'display_tc_label' => '0',
				'display_tc_sublabel' => '0',
				'tc_theme' => 'light'
		);
	} else {
		$default_arr = array(
				'sm_list' => 'fb,tw,li',
				'list_align' => 'horizontal',
				'template' => 'ism_template_1',
				'display_counts' => 'false',
				'display_full_name' => 'true',
				'locker_template' => 2,
				'sm_d_text' => '<h2>This content is locked</h2><p>Share This Page To Unlock The Content!</p>',
				'ism_overlock' => 'default'
		);
	}

	foreach ($default_arr as $k=>$v){
		if (!isset($arr[$k])){
			$arr[$k] = $v;
		}
	}

	return $arr;
}

function ism_convert_vc_variables($attr=array()){
	/*
	 * @param array
	 * @return array
	 */
	$new_arr = array();
	if (!empty($attr['ru_on']) && !empty($attr['ru_sh'])){
		$new_arr['reg_users'] = $attr['ru_sh'];
	}

	if (!empty($attr['uhc_on']) && !empty($attr['uhc_sh'])){
		$new_arr['user_commented'] = $attr['uhc_sh'];
	}

	if (!empty($attr['ur_on']) && !empty($attr['ur_sh'])){
		$new_arr['user_roles'] = $attr['ur_sh'];
		if (isset($attr['ur_val'])){
			$new_arr['user_roles_val'] = $attr['ur_val'];
		}
	}

	if (!empty($attr['ref_on']) && !empty($attr['ref_sh'])){
		$new_arr['referer_visits'] = $attr['ref_sh'];
		if (isset($attr['ref_val'])){
			$new_arr['referer_values'] = $attr['ref_val'];
		}
	}
	return $new_arr;
}

function ism_test_targeting($arr=array()){
	/*
	 * @param array
	 * @return boolean, TRUE if ok
	 */
	global $wpdb;

	//test user registered
	$cond1 = TRUE;
	if (!empty($arr['reg_users'])){
		if (is_user_logged_in() && $arr['reg_users'] == 'hide'){
			$cond1 = FALSE;
		}
		if (!is_user_logged_in() && $arr['reg_users'] == 'show'){
			$cond1 = FALSE;
		}
	}

	//user commented
	$cond2 = TRUE;
	if (!empty($arr['user_commented'])){
		$uid = get_current_user_id();
		$comments = $wpdb->get_results("SELECT comment_ID FROM {$wpdb->prefix}comments
											WHERE user_id = $uid
											AND comment_approved = 1;");
		if ($arr['user_commented'] == 'hide' && count($comments) > 0){
			$cond2 = FALSE;
		}
		if ($arr['user_commented'] == 'show' && count($comments) < 1){
			$cond2 = FALSE;
		}
	}

	//user roles
	$cond3 = TRUE;
	if (!empty($arr['user_roles'])){
		$current_user = wp_get_current_user();
		$roles = $current_user->roles;
		$role = array_shift($roles);
		if ($arr['user_roles_val']){
			$cond_roles = explode(',', $arr['user_roles_val']);
		} else {
			$cond_roles = array();
		}

		if ($arr['user_roles']=='show' && !in_array($role, $cond_roles)){
			$cond3 = FALSE;
		}
		if ($arr['user_roles']=='hide' && in_array($role, $cond_roles)){
			$cond3 = FALSE;
		}
	}

	//search engine visits
	$cond4 = TRUE;
	if (!empty($arr['referer_visits']) && !empty($_SERVER['HTTP_REFERER'])){
		if (!empty($arr['referer_values'])){
			$referers = explode(",", $arr['referer_values']);
		} else {
			$referers = array();
		}
		foreach ($referers as $v){
			if ($arr['referer_visits']=='show' && strpos($_SERVER['HTTP_REFERER'], $v)===FALSE){
				$cond4 = FALSE;
			}
			if ($arr['referer_visits']=='hide' && strpos($_SERVER['HTTP_REFERER'], $v)!==FALSE){
				$cond4 = FALSE;
			}
		}
	}


	if ($cond1 && $cond2 && $cond3 && $cond4){
		return TRUE;
	}
	return FALSE;
}

function ism_envato_check_license(){
	/*
	 * @param none
	 * @return bool
	 */
	$check = get_option('ism_license_set');
	if ($check!==FALSE){
		if ($check==1)
			return TRUE;
		return FALSE;
	}
	return TRUE;
}

function ism_envato_licensing($code=''){
	/*
	 * @param string
	 * @return boolean
	 */
	$return = FALSE;
	if (ism_check_envato_customer($code)){
		update_option('ism_license_set', 1);
		$return = TRUE;
	} else {
		update_option('ism_license_set', 0);
		$return = FALSE;
	}
	update_option('ism_envato_code', $code);
	return $return;
}

function ism_check_envato_customer($code=''){
	/*
	 * @param stirng
	 * @return boolean
	 */
	if (!empty($code)){
		if (!class_exists('Envato_marketplace')){
			require_once ISM_DIR_PATH . 'includes/Envato_marketplace.class.php';
		}
		$api_key = 'cye96rx8cec4vmzor3ozf9ya9fupzjbg';
		$user_name = 'azzaroco';
		$item_id = '8137709';
		$envato_object = new Envato_marketplaces($api_key);
		$buyer_verify = $envato_object->verify_purchase($user_name, $code);

		if ( isset($buyer_verify) && isset($buyer_verify->buyer)  && $buyer_verify->item->id==$item_id ){
					return TRUE;
				}
		//OLD API
		//if ( isset($buyer_verify) && isset($buyer_verify->buyer)  && $buyer_verify->item_id==$item_id ){
			//return TRUE;
		//}
	}
	return FALSE;
}

function ism_inside_dashboard_error_license($global=FALSE){
	/*
	 * @param none
	 * @return string
	 */
	$url = get_admin_url() . 'admin.php?page=ism_manage&tab=help';
	if (!ISMACTIVATEDMODE){
		if ($global) $class = 'error';
		else $class = 'ism-error-global-dashboard-message';
		return "<div class='$class'><p>This is a Trial Version of <strong>Social Share & Locker Pro</strong> plugin. Please add your purchase code into Licence section to enable the Full Social Share & Locker Pro Version. Check your <a href='" . $url . "'>licence section</a>.</p></div>";
	}
	return '';
}

function ism_public_notify_trial_version(){
	/*
	 * @param none
	 * @return string
	 */
	$str = '';
	$str .= '<div class="ism-public-trial-version">';
	$str .= "This is a Trial Version of <strong>Social Share & Locker Pro</strong> plugin. Please add your purchase code into Licence section to enable the Full Social Share & Locker Pro Version.";
	$str .= '</div>';
	return $str;
}

function ism_affiliate_filter_url($url=''){
	/*
	 * @param string
	 * @return string
	 */
	 if (!function_exists('is_plugin_active')){
	 	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	 }
	 if (is_plugin_active('indeed-affiliate-pro/indeed-affiliate-pro.php')){
		if (get_option('uap_license_set')==1){
			///
			global $indeed_db, $current_user;
			$uid = (empty($current_user->ID)) ? 0 : $current_user->ID;
			if ($uid){
				$username = '';
				$user_info = get_userdata($uid);
				if (!empty($user_info->user_login)){
					$username = $user_info->user_login;
				}
				$affiliate_id = $indeed_db->get_affiliate_id_by_username($username);

				$param = 'ref';
				$value = $affiliate_id;

				$settings = $indeed_db->return_settings_from_wp_option('general-settings');
				if (!empty($settings['uap_referral_variable'])){
					$param = $settings['uap_referral_variable'];
				}
				if ($uid && $settings['uap_default_ref_format']=='username'){
					$value = $username;
				}
				$url = uap_create_affiliate_link($url, $param, $value);
			}

		}
	}
	return $url;

}

if (!function_exists('dd')):
function dd($variable){
		indeed_debug_var($variable);
		die;
}
endif;
if (!function_exists('indeed_debug_var')):
function indeed_debug_var($variable){
	/*
	* print the array into '<pre>' tags
	* @param array, string, int ... anything
	* @return none (echo)
	*/
	if (is_array($variable) || is_object($variable)){
		echo '<pre>';
		print_r($variable);
		echo '</pre>';
	} else {
		var_dump($variable);
	}
}
endif;
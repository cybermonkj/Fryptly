<?php

if (!defined('ABSPATH')) exit;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

if (!class_exists('daftplugInstantifyPwaPublicPushnotifications')) {
    class daftplugInstantifyPwaPublicPushnotifications {
        public $name;
        public $description;
        public $slug;
        public $version;
        public $textDomain;
        public $optionName;
        public $pluginFile;
        public $pluginBasename;
        public $settings;
        public $vapidKeys;
        public $subscribedDevices;
        public $daftplugInstantifyPwaPublic;

        public function __construct($config, $daftplugInstantifyPwaPublic) {
            $this->name = $config['name'];
            $this->description = $config['description'];
            $this->slug = $config['slug'];
            $this->version = $config['version'];
            $this->textDomain = $config['text_domain'];
            $this->optionName = $config['option_name'];
            $this->pluginFile = $config['plugin_file'];
            $this->pluginBasename = $config['plugin_basename'];
            $this->settings = $config['settings'];
            $this->vapidKeys = get_option("{$this->optionName}_vapid_keys", true);            
            $this->subscribedDevices = get_option("{$this->optionName}_subscribed_devices", true);
            $this->daftplugInstantifyPwaPublic = $daftplugInstantifyPwaPublic;

            add_filter("{$this->optionName}_pwa_serviceworker", array($this, 'addPushToServiceWorker'));
            add_filter("{$this->optionName}_public_js_vars", array($this, 'addPushJsVars'));
            add_action("wp_ajax_{$this->optionName}_handle_subscription", array($this, 'handleSubscription'));
            add_action("wp_ajax_nopriv_{$this->optionName}_handle_subscription", array($this, 'handleSubscription'));

            if (daftplugInstantify::isWooCommerceActive()) {
                if (daftplugInstantify::getSetting('pwaPushWooNewOrder') == 'on') {
                    add_action('woocommerce_new_order', array($this, 'doWooNewOrderPush'));  
                }
                if (daftplugInstantify::getSetting('pwaPushWooLowStock') == 'on') {
                    add_action('woocommerce_thankyou', array($this, 'doWooLowStockPush'));  
                }
            }

            if (daftplugInstantify::isBuddyPressActive()) {
                if (daftplugInstantify::getSetting('pwaPushBpMemberMention') == 'on') {
                    add_action('bp_activity_sent_mention_email', array($this, 'doBpMemberMentionPush'), 10, 5);
                }
                if (daftplugInstantify::getSetting('pwaPushBpMemberReply') == 'on') {
                    add_action('bp_activity_sent_reply_to_update_notification', array($this, 'doBpMemberReplyPush'), 10, 4);
                    add_action('bp_activity_sent_reply_to_reply_notification', array($this, 'doBpMemberReplyPush'), 10, 4);
                }
                if (daftplugInstantify::getSetting('pwaPushBpNewMessage') == 'on') {
                    add_action('messages_message_sent', array($this, 'doBpNewMessagePush'), 10, 1);
                }
                if (daftplugInstantify::getSetting('pwaPushBpFriendRequest') == 'on') {
                    add_action('friends_friendship_requested', array($this, 'doBpFriendRequestPush'), 1, 4);
                }
                if (daftplugInstantify::getSetting('pwaPushBpFriendAccepted') == 'on') {
                    add_action('friends_friendship_accepted', array($this, 'doBpFriendAcceptedPush'), 1, 4);
                }
            }

            if (daftplugInstantify::getSetting('pwaPushButton') == 'on') {
                add_filter("{$this->optionName}_public_html", array($this, 'renderPushButton'));
            }

            if (daftplugInstantify::getSetting('pwaPushPrompt') == 'on') {
                add_filter("{$this->optionName}_public_html", array($this, 'renderPushPrompt'));
            }           
        }

        public function handleSubscription() {
            $subscribedDevices = $this->subscribedDevices;
            $endpoint = $_REQUEST['endpoint'];
            $userKey = $_REQUEST['userKey'];
            $userAuth = $_REQUEST['userAuth'];
            $deviceInfo = $_REQUEST['deviceInfo'];
            $date = date('j M Y');
            $country = json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip='.$_SERVER['REMOTE_ADDR']), true);
            $method = $_REQUEST['method'];
            $user = (is_user_logged_in() ? get_current_user_id() : esc_html__('Unregistered', $this->textDomain));
            $roles = (is_user_logged_in() ? (array)wp_get_current_user()->roles : array());
            
            switch ($method) {
                case 'add':
                    $subscribedDevices[$endpoint] = array(
                        'endpoint' => $endpoint,
                        'userKey' => $userKey,
                        'userAuth' => $userAuth,
                        'deviceInfo' => $deviceInfo,
                        'date' => $date,
                        'country' => @$country['geoplugin_countryName'],
                        'user' => $user,
                        'roles' => $roles,
                    );
                    break;
                case 'update':
                    if (array_key_exists($endpoint, $subscribedDevices)) {
                        foreach ($subscribedDevices as $key => $value) {
                            $subscribedDevices[$endpoint]['userKey'] = $userKey;
                            $subscribedDevices[$endpoint]['userAuth'] = $userAuth;
                        }
                    } else {
                        $subscribedDevices[$endpoint] = array(
                            'endpoint' => $endpoint,
                            'userKey' => $userKey,
                            'userAuth' => $userAuth,
                            'deviceInfo' => $deviceInfo,
                            'date' => $date,
                            'country' => @$country['geoplugin_countryName'],
                            'user' => $user,
                            'roles' => $roles,
                        );
                    }
                    break;
                case 'remove':
                    unset($subscribedDevices[$endpoint]);
                    break;
                default:
                    echo 'Error: method not handled';
                    return;
            }

            $handled = update_option("{$this->optionName}_subscribed_devices", $subscribedDevices);

            if ($handled) {
                wp_die('1');
            } else {
                wp_die('0');
            }
        }

        public function doWooNewOrderPush($orderId) {
            if (!$orderId) {
                return;
            }

            $order = wc_get_order($orderId);
            $pushData = array(
                'title' => esc_html__('WooCommerce New Order', $this->textDomain),
                'body' => sprintf(__('You have new order for total %s%s. Click on notification to see it.', $this->textDomain), html_entity_decode (get_woocommerce_currency_symbol($order->get_currency())), $order->get_total()),
                'data' => array(
                    'url' => $order->get_view_order_url(),
                ),
            );

            $this->sendNotification($pushData, 'wooNewOrder');
        }

        public function doWooLowStockPush($orderId) {
            if (!$orderId) {
                return;
            }
        
            $order = wc_get_order($orderId);
            $items = $order->get_items();
            
            foreach ($items as $item) {
                if ($item['variation_id'] > 0) {
                    $productId = $item['variation_id'];
                    $stock = get_post_meta($item['variation_id'], '_stock', true);
                    $sku = get_post_meta($item['variation_id'], '_sku', true);
                    $lowStockThreshold = get_post_meta($item['variation_id'], '_low_stock_amount', true);
                } else {
                    $productId = $item['product_id'];
                    $stock = get_post_meta( $item['product_id'], '_stock', true);
                    $sku = get_post_meta( $item['product_id'], '_sku', true);
                    $lowStockThreshold = get_post_meta($item['product_id'], '_low_stock_amount', true);
                }

                $lowStockThreshold = (!empty($lowStockThreshold) ? $lowStockThreshold : daftplugInstantify::getSetting('pwaPushWooLowStockThreshold'));

                if ($stock <= $lowStockThreshold && !get_post_meta($orderId, 'pwaPushWooLowStock', true)) {
                    update_post_meta($orderId, 'pwaPushWooLowStock', 1);
                    $pushData = array(
                        'title' => esc_html__('WooCommerce Low Stock', $this->textDomain),
                        'body' => sprintf(__('The product "%s" is running out of stock. Currently left %s in stock. Click on notification to see it.', $this->textDomain), $item['name'], $stock),
                        'data' => array(
                            'url' => get_permalink($productId),
                        ),
                    );

                    $this->sendNotification($pushData, 'wooLowStock');
                }
            }
        }

        public function doBpMemberMentionPush($activity, $subject, $message, $content, $receiverUserId) {
            $currentUser = get_userdata($activity->user_id);
            $friendDetail = get_userdata($receiverUserId);

            if ($activity->type == 'activity_comment') {
                $body = sprintf(__('%s has just mentioned you in a comment.', $this->textDomain), $currentUser->display_name);
            } else {
                $body = sprintf(__('%s has just mentioned you in an update.', $this->textDomain), $currentUser->display_name);
            }
    
            $pushData = array(
                'title' => sprintf(__('New mention from %s', $this->textDomain), $currentUser->display_name),
                'body' => $body,
                'data' => array(
                    'url' => home_url('members/'.$friendDetail->user_nicename.'/activity/mentions/'),
                ),
            );

            $this->sendNotification($pushData, 'bpActivity', $receiverUserId);
        }

        public function doBpMemberReplyPush($activity, $commentId, $commenterId, $params) {
            $currentUser = get_userdata($commenterId);
            $receiverDetail = get_userdata($activity->user_id);
            $pushData = array(
                'title' => sprintf(__('New reply from %s', $this->textDomain), $currentUser->display_name),
                'body' => sprintf(__('%s has just replied you.', $this->textDomain), $currentUser->display_name),
                'data' => array(
                    'url' => home_url('members/'.$receiverDetail->user_nicename.'/activity/'.$activity->item_id.'/#acomment-'.$commentId),
                ),
            );

            $this->sendNotification($pushData, 'bpActivity', $activity->user_id);
        }

        public function doBpNewMessagePush($params) {
            $senderDetail = get_userdata($params->sender_id);
            foreach ($params->recipients as $r) {
                $recipientDetail = get_userdata($r->user_id);
                $pushData = array(
                    'title' => sprintf(__('New message from %s', $this->textDomain), $senderDetail->display_name),
                    'body' => substr(strip_tags($params->message), 0, 77).'...',
                    'data' => array(
                        'url' => 'members/' . $recipientDetail->user_nicename . '/messages/view/' . $params->thread_id,
                    ),
                );
                
                $this->sendNotification($pushData, 'bpActivity', $r->user_id);
            }
        }

        public function doBpFriendRequestPush($id, $userId, $friendId, $friendship) {
            $friendDetail = get_userdata($friendId);
            $currentUser = get_userdata($userId);
            $pushData = array(
                'title' => sprintf(__('New friend request from %s', $this->textDomain), $currentUser->display_name),
                'body' => sprintf(__('%s has just sent you a friend request.', $this->textDomain), $currentUser->display_name),
                'data' => array(
                    'url' => home_url('members/' . $friendDetail->user_nicename . '/friends/requests/?new'),
                ),
            );
            
            $this->sendNotification($pushData, 'bpActivity', $friendId);
        }

        public function doBpFriendAcceptedPush($id, $userId, $friendId, $friendship) {
            $friendDetail = get_userdata($userId);
            $currentUser = get_userdata($friendId);
            $pushData = array(
                'title' => sprintf(__('%s accepted your friend request', $this->textDomain), $currentUser->display_name),
                'body' => sprintf(__('%s has just accepted your friend request.', $this->textDomain), $currentUser->display_name),
                'data' => array(
                    'url' => home_url('members/' . $friendDetail->user_nicename . '/friends'),
                ),
            );
            
            $this->sendNotification($pushData, 'bpActivity', $userId);
        }

        public function addPushToServiceWorker($serviceWorker) {
            $serviceWorker .= file_get_contents(plugins_url('pwa/public/assets/js/script-push.js', $this->pluginFile));

            return $serviceWorker;
        }

        public function addPushJsVars($vars) {
            $vars['pwaPublicKey'] = $this->vapidKeys['pwaPublicKey'];
            $vars['pwaSubscribeOnMsg'] = esc_html__('Notifications are turned on', $this->textDomain);
            $vars['pwaSubscribeOffMsg'] = esc_html__('Notifications are turned off', $this->textDomain);

            return $vars;
        }

        public function renderPushPrompt() {
            if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
                return;
            }
            
            include_once($this->daftplugInstantifyPwaPublic->partials['pushPrompt']);
        }

        public function renderPushButton() {
            if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
                return;
            }
            
            include_once($this->daftplugInstantifyPwaPublic->partials['pushButton']);
        }

        public function sendNotification($pushData, $type, $tagetUserId = null) {
            require_once plugin_dir_path($this->pluginFile) . implode(DIRECTORY_SEPARATOR, array('pwa', 'includes', 'libs', 'web-push-php', 'autoload.php'));

            $auth = array(
                'VAPID' => array(
                    'subject' => get_bloginfo('wpurl'),
                    'publicKey' => $this->vapidKeys['pwaPublicKey'],
                    'privateKey' => $this->vapidKeys['pwaPrivateKey'],
                ),
            );

            $webPush = new WebPush($auth);

            $pushData = wp_parse_args($pushData, array(
                'title' => '',
                'badge' => '',
                'body' => '',
                'icon' => '',
                'image' => '',
                'data' => '',
            ));

            switch ($type) {
                case 'wooNewOrder':
                    $subscriptions = array();
                    foreach ($this->subscribedDevices as $subscribedDevice) {
                        if (in_array(daftplugInstantify::getSetting('pwaPushWooNewOrderRole'), $subscribedDevice['roles'])) {
                            $subscriptions[] =  array(
                                                    'subscription' => Subscription::create(
                                                        array(
                                                            'endpoint' => $subscribedDevice['endpoint'],
                                                            'publicKey' => $subscribedDevice['userKey'],
                                                            'authToken' => $subscribedDevice['userAuth'],
                                                        )
                                                    ),
                                                    'payload' => null
                                                );
                        }
                    }
        
                    foreach ($subscriptions as $subscription) {
                        $webPush->sendNotification(
                            $subscription['subscription'],
                            json_encode($pushData)
                        );
                    }
                    break;
                case 'wooLowStock':
                    $subscriptions = array();
                    foreach ($this->subscribedDevices as $subscribedDevice) {
                        if (in_array(daftplugInstantify::getSetting('pwaPushWooLowStockRole'), $subscribedDevice['roles'])) {
                            $subscriptions[] =  array(
                                                    'subscription' => Subscription::create(
                                                        array(
                                                            'endpoint' => $subscribedDevice['endpoint'],
                                                            'publicKey' => $subscribedDevice['userKey'],
                                                            'authToken' => $subscribedDevice['userAuth'],
                                                        )
                                                    ),
                                                    'payload' => null
                                                );
                        }
                    }
    
                    foreach ($subscriptions as $subscription) {
                        $webPush->sendNotification(
                            $subscription['subscription'],
                            json_encode($pushData)
                        );
                    }
                    break;
                case 'bpActivity':
                    $subscriptions = array();
                    foreach ($this->subscribedDevices as $subscribedDevice) {
                        if ($tagetUserId == $subscribedDevice['user']) {
                            $subscriptions[] =  array(
                                                    'subscription' => Subscription::create(
                                                        array(
                                                            'endpoint' => $subscribedDevice['endpoint'],
                                                            'publicKey' => $subscribedDevice['userKey'],
                                                            'authToken' => $subscribedDevice['userAuth'],
                                                        )
                                                    ),
                                                    'payload' => null
                                                );
                        }
                    }
    
                    foreach ($subscriptions as $subscription) {
                        $webPush->sendNotification(
                            $subscription['subscription'],
                            json_encode($pushData)
                        );
                    }
                    break;
                default:
                    echo 'Undefined Push Type.';
            }

            foreach ($webPush->flush() as $report) {
                $endpoint = $report->getRequest()->getUri()->__toString();
                if (!$report->isSuccess()) {
                    unset($this->subscribedDevices[$endpoint]);
                    update_option("{$this->optionName}_subscribed_devices", $this->subscribedDevices);
                    //wp_die("[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}");
                } else {
                    return true;
                }
            }
        }
    }
}
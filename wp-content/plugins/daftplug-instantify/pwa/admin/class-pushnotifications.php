<?php

if (!defined('ABSPATH')) exit;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

if (!class_exists('daftplugInstantifyPwaAdminPushnotifications')) {
    class daftplugInstantifyPwaAdminPushnotifications {
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

        public function __construct($config) {
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

            add_action("wp_ajax_{$this->optionName}_send_notification", array($this, 'doModalPush'));
            add_action('add_meta_boxes', array($this, 'addMetaBoxes'), 10, 2);
            if (daftplugInstantify::isWooCommerceActive()) {
                add_filter('wp_insert_post_data', array($this, 'filterWooCommercePostData'), 10, 2);
            }
            add_action('save_post',  array($this, 'doAutoPush'), 10, 2);

			foreach ($this->subscribedDevices as $key => $value) {
			    if (!array_key_exists('endpoint', $this->subscribedDevices[$key])) {
			        unset($this->subscribedDevices[$key]);
			    }
			}

	        update_option("{$this->optionName}_subscribed_devices", $this->subscribedDevices);
        }

        public function doModalPush() {
            $pushData = array(
                'title' => !empty($_POST['pushTitle']) ? $_POST['pushTitle'] : '',
                'body' => !empty($_POST['pushBody']) ? $_POST['pushBody'] : '',
                'image' => !empty($_POST['pushImage']) ? esc_url_raw(wp_get_attachment_image_src($_POST['pushImage'], 'full')[0]) : '',
                'icon' => !empty($_POST['pushIcon']) ? esc_url_raw(wp_get_attachment_image_src($_POST['pushIcon'], 'full')[0]) : '',
                'data' => array(
                    'url' => !empty($_POST['pushUrl']) ? trailingslashit(esc_url_raw($_POST['pushUrl'])).'?utm_source=pwa-notification' : '',
                ),
            );

            if (!empty($_POST['pushActionbutton1Text'])) {
                $pushData['actions'][] = array('action' => 'action1', 'title' => $_POST['pushActionbutton1Text']);
                $pushData['data']['pushActionbutton1Url'] = trailingslashit(esc_url_raw($_POST['pushActionbutton1Url']));
            }

            if (!empty($_POST['pushActionbutton2Text'])) {
                $pushData['actions'][] = array('action' => 'action2', 'title' => $_POST['pushActionbutton2Text']);
                $pushData['data']['pushActionbutton2Url'] = trailingslashit(esc_url_raw($_POST['pushActionbutton2Url']));
            }

            $segment = sanitize_text_field($_POST['pushSegment']);

            if (wp_verify_nonce($_POST['nonce'], "{$this->optionName}_send_notification_nonce")) {
                $sendNotification = $this->sendNotification($pushData, $segment);
                if ($sendNotification) {
                    wp_die('1');
                } else {
                    wp_die('0');
                }
            } else {
                wp_die('0');
            }
        }

        public function renderMetaBoxContent($post, $callbackArgs) {
            $pwaNoPushNewContent = get_post_meta($post->ID, 'pwaNoPushNewContent', true);
            $pwaNoPushWooNewProduct = get_post_meta($post->ID, 'pwaNoPushWooNewProduct', true);
            $pwaNoPushWooPriceDrop = get_post_meta($post->ID, 'pwaNoPushWooPriceDrop', true);
            $pwaNoPushWooSalePrice = get_post_meta($post->ID, 'pwaNoPushWooSalePrice', true);
            $pwaNoPushWooBackInStock = get_post_meta($post->ID, 'pwaNoPushWooBackInStock', true);
            wp_nonce_field("{$this->optionName}_no_push_meta_nonce", "{$this->optionName}_no_push_meta_nonce");
            if (daftplugInstantify::isWooCommerceActive() && $post->post_type == 'product') {
                if (daftplugInstantify::getSetting('pwaPushWooNewProduct') == 'on') { ?>
                    <label style="display: block; margin: 5px;">
                        <input type="checkbox" name="pwaNoPushWooNewProduct" value="on" <?php checked($pwaNoPushWooNewProduct, 'on'); ?>>
                        <?php esc_html_e('Don\'t Send WooCommerce New Product Notification', $this->textDomain); ?>
                    </label style="display: block; margin: 5px;">
                <?php }
                if (daftplugInstantify::getSetting('pwaPushWooPriceDrop') == 'on') { ?>
                    <label style="display: block; margin: 5px;">
                        <input type="checkbox" name="pwaNoPushWooPriceDrop" value="on" <?php checked($pwaNoPushWooPriceDrop, 'on'); ?>>
                        <?php esc_html_e('Don\'t Send WooCommerce Price Drop Notification', $this->textDomain); ?>
                    </label>
                <?php }
                if (daftplugInstantify::getSetting('pwaPushWooSalePrice') == 'on') { ?>
                    <label style="display: block; margin: 5px;">
                        <input type="checkbox" name="pwaNoPushWooSalePrice" value="on" <?php checked($pwaNoPushWooSalePrice, 'on'); ?>>
                        <?php esc_html_e('Don\'t Send WooCommerce Sale Price Notification', $this->textDomain); ?>
                    </label>
                <?php }
                if (daftplugInstantify::getSetting('pwaPushWooBackInStock') == 'on') { ?>
                    <label style="display: block; margin: 5px;">
                        <input type="checkbox" name="pwaNoPushWooBackInStock" value="on" <?php checked($pwaNoPushWooBackInStock, 'on'); ?>>
                        <?php esc_html_e('Don\'t Send WooCommerce Back In Stock Notification', $this->textDomain); ?>
                    </label>
                <?php }
            } else {
                if (daftplugInstantify::getSetting('pwaPushNewContent') == 'on') { ?>
                    <label style="display: block; margin: 5px;">
                        <input type="checkbox" name="pwaNoPushNewContent" value="on" <?php checked($pwaNoPushNewContent, 'on'); ?>>
                        <?php esc_html_e('Don\'t Send New Content Notification', $this->textDomain); ?>
                    </label>
                <?php }
            }
        }

        public function addMetaBoxes($postType, $post)  {
            if (in_array($post->post_type, (array)daftplugInstantify::getSetting('pwaPushNewContentPostTypes')) || $post->post_type == 'product') {
                add_meta_box("{$this->optionName}_no_push_meta_box", esc_html__('Push Notifications', $this->textDomain), array($this, 'renderMetaBoxContent'), $postType, 'side', 'default', array());
            }
        }

        public function filterWooCommercePostData($data, $postArr) {
            global $post;

            if (!$post || $post->post_type != 'product') {
                return $data;
            }

            $wooCurrency = html_entity_decode(get_woocommerce_currency_symbol(get_option('woocommerce_currency')));
            $priceFormat = get_woocommerce_price_format();
            $oldSalePrice = get_post_meta($post->ID, '_sale_price', true);
            $newSalePrice = $postArr['_sale_price'];
            $oldRegularPrice = get_post_meta($post->ID, '_regular_price', true);
            $newRegularPrice = $postArr['_regular_price'];
            $oldStock = get_post_meta($post->ID, '_stock', true );
            $newStock = $postArr['_stock'];

            if ($oldRegularPrice) {
                set_transient("{$this->optionName}_regular_price", sprintf($priceFormat, $wooCurrency, $oldRegularPrice), 5);
            } else {
                set_transient("{$this->optionName}_regular_price", sprintf($priceFormat, $wooCurrency, $newRegularPrice), 5);
            }

            if ((!$oldSalePrice && $newSalePrice) || ($oldSalePrice > $newSalePrice && $newSalePrice != 0)) {
                set_transient("{$this->optionName}_sale_price", sprintf($priceFormat, $wooCurrency, $newSalePrice), 5);
            }

            if ($newRegularPrice < $oldRegularPrice) {
                set_transient("{$this->optionName}_dropped_price", sprintf($priceFormat, $wooCurrency, $newRegularPrice), 5);
            }

            if ($oldStock == 0 && $newStock > 0) {
                set_transient("{$this->optionName}_back_in_stock", true, 5);
            }

            return $data;
        }

        public function doAutoPush($id, $post) {
            $isAutosave = (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || wp_is_post_autosave($id);
            $isRevision = wp_is_post_revision($id);
            $isValidNonce = (isset($_POST["{$this->optionName}_no_push_meta_nonce"]) && wp_verify_nonce($_POST["{$this->optionName}_no_push_meta_nonce"], $this->pluginBasename)) ? 'true' : 'false';
            $pwaNoPushNewContentMeta = (isset($_POST['pwaNoPushNewContent']) ? $_POST['pwaNoPushNewContent'] : 'off');
            $pwaNoPushWooNewProductMeta = (isset($_POST['pwaNoPushWooNewProduct']) ? $_POST['pwaNoPushWooNewProduct'] : 'off');
            $pwaNoPushWooPriceDropMeta = (isset($_POST['pwaNoPushWooPriceDrop']) ? $_POST['pwaNoPushWooPriceDrop'] : 'off');
            $pwaNoPushWooSalePriceMeta = (isset($_POST['pwaNoPushWooSalePrice']) ? $_POST['pwaNoPushWooSalePrice'] : 'off');
            $pwaNoPushWooBackInStockMeta = (isset($_POST['pwaNoPushWooBackInStock']) ? $_POST['pwaNoPushWooBackInStock'] : 'off');

            if ($isAutosave || $isRevision || !$isValidNonce) {
                return;
            }

            if ($post->post_type !== 'product') {
                // New Content Push
                if (daftplugInstantify::getSetting('pwaPushNewContent') == 'on' && $pwaNoPushNewContentMeta == 'off' && in_array($post->post_type, (array)daftplugInstantify::getSetting('pwaPushNewContentPostTypes'))) {
                    if (isset($post->post_status) && 'auto-draft' == $post->post_status) {
                        return;
                    }

                    if ($post->post_date === $post->post_modified) {
                        $pushData = array(
                            'title' => sprintf(__('New %s - %s', $this->textDomain), get_post_type_labels($post)->singular_name, $post->post_title),
                            'body' => substr(strip_tags($post->post_content), 0, 77).'...',
                            'data' => array(
                                'url' => trailingslashit(get_permalink($id)),
                            ),
                        );

                        if (has_post_thumbnail($id)) {
                            $pushData['image'] = get_the_post_thumbnail_url($id);
                        }

                        $this->sendNotification($pushData, 'all');
                    }
                }
            } else {
                // New Product Push
                if (daftplugInstantify::getSetting('pwaPushWooNewProduct') == 'on' && $pwaNoPushWooNewProductMeta == 'off') {
                    if (isset($post->post_status) && 'auto-draft' == $post->post_status) {
                        return;
                    }

                    if ($post->post_date === $post->post_modified) {
                        $pushData = array(
                            'title' => sprintf(__('New Product - %s', $this->textDomain), $post->post_title),
                            'body' => substr(strip_tags($post->post_content), 0, 77).'...',
                            'data' => array(
                                'url' => trailingslashit(get_permalink($id)),
                            ),
                        );

                        if (has_post_thumbnail($id)) {
                            $pushData['image'] = get_the_post_thumbnail_url($id);
                        }

                        $this->sendNotification($pushData, 'all');
                    }
                }

                // Price Drop Push
                if (daftplugInstantify::getSetting('pwaPushWooPriceDrop') == 'on' && $pwaNoPushWooPriceDropMeta == 'off' && get_transient("{$this->optionName}_dropped_price")) {
                    $pushData = array(
                        'title' => sprintf(__('Price Drop - %s', $this->textDomain), $post->post_title),
                        'body' => sprintf(__('Price dropped from %s to %s', $this->textDomain), get_transient("{$this->optionName}_regular_price"), get_transient("{$this->optionName}_dropped_price")),
                        'data' => array(
                            'url' => trailingslashit(get_permalink($id)),
                        ),
                    );

                    if (has_post_thumbnail($id)) {
                        $pushData['image'] = get_the_post_thumbnail_url($id);
                    }

                    $this->sendNotification($pushData, 'all');
                }

                // Sale Price Push
                if (daftplugInstantify::getSetting('pwaPushWooSalePrice') == 'on' && $pwaNoPushWooSalePriceMeta == 'off' && get_transient("{$this->optionName}_sale_price")) {
                    $pushData = array(
                        'title' => sprintf(__('New Sale Price - %s', $this->textDomain), $post->post_title),
                        'body' => sprintf(__('New Sale Price: %s', $this->textDomain), get_transient("{$this->optionName}_sale_price")),
                        'data' => array(
                            'url' => trailingslashit(get_permalink($id)),
                        ),
                    );

                    if (has_post_thumbnail($id)) {
                        $pushData['image'] = get_the_post_thumbnail_url($id);
                    }

                    $this->sendNotification($pushData, 'all');
                }

                // Back In Stock Push
                if (daftplugInstantify::getSetting('pwaPushWooBackInStock') == 'on' && $pwaNoPushWooBackInStockMeta == 'off' && get_transient("{$this->optionName}_back_in_stock")) {
                    $pushData = array(
                        'title' => sprintf(__('Back In Stock - %s', $this->textDomain), $post->post_title),
                        'body' => sprintf(__('%s is now back in stock', $this->textDomain), $post->post_title),
                        'data' => array(
                            'url' => trailingslashit(get_permalink($id)),
                        ),
                    );

                    if (has_post_thumbnail($id)) {
                        $pushData['image'] = get_the_post_thumbnail_url($id);
                    }

                    $this->sendNotification($pushData, 'all');
                }
            }
        }

        public function sendNotification($pushData, $segment = 'all') {
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

            switch ($segment) {
                case 'all':
                    $subscriptions = array();
                    foreach ($this->subscribedDevices as $subscribedDevice) {
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
    
                    foreach ($subscriptions as $subscription) {
                        $webPush->sendNotification(
                            $subscription['subscription'],
                            json_encode($pushData)
                        );
                    }
                    break;
                case 'mobile':
                    $subscriptions = array();
                    foreach ($this->subscribedDevices as $subscribedDevice) {
                        if (preg_match('[Android|iOS]', $subscribedDevice['deviceInfo'])) {
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
                case 'desktop':
                    $subscriptions = array();
                    foreach ($this->subscribedDevices as $subscribedDevice) {
                        if (preg_match('[Windows|Linux|Mac|Ubuntu|Solaris]', $subscribedDevice['deviceInfo'])) {
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
                case 'registered':
                    $subscriptions = array();
                    foreach ($this->subscribedDevices as $subscribedDevice) {
                        if (is_numeric($subscribedDevice['user'])) {
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
                    $subscription = array(
                        'subscription' => Subscription::create(
                            array(
                                'endpoint' => $this->subscribedDevices[$segment]['endpoint'],
                                'publicKey' => $this->subscribedDevices[$segment]['userKey'],
                                'authToken' => $this->subscribedDevices[$segment]['userAuth'],
                            )
                        ),
                        'payload' => null
                    );

                    $webPush->sendNotification(
                        $subscription['subscription'],
                        json_encode($pushData)
                    );
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

        public function getPostTypes() {
            $excludes = array('product', 'attachment');
            $postTypes = get_post_types(
                            array(
                                'public' => true,
                            ),
                            'names'
                         );

            foreach ($excludes as $exclude) {
                unset($postTypes[$exclude]);
            }

            return array_values($postTypes);
        }
    }
}
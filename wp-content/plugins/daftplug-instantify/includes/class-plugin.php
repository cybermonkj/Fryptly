<?php

if (!defined('ABSPATH')) exit;

use Minishlink\WebPush\VAPID;

if (!class_exists('daftplugInstantify')) {
    class daftplugInstantify {
        public $name;
        public $description;
        public static $slug;
        public $version;
        public $textDomain;
        public $optionName;
        public static $pluginOptionName;

        public $pluginFile;
        public $pluginBasename;
        public $pluginUploadDir;

        public static $verifyUrl;
        public static $itemId;

        public static $website;

        public $purchaseCode;

        public $capability;

        public static $settings;

        public $defaultSettings;

        public $daftplugInstantifyPwa;
        public $daftplugInstantifyAmp;
        public $daftplugInstantifyFbia;
        public $daftplugInstantifyPublic;
        public $daftplugInstantifyAdmin;

        public function __construct($config) {
            $this->name = $config['name'];
            $this->description = $config['description'];
            self::$slug = $config['slug'];
            $this->version = $config['version'];
            $this->textDomain = $config['text_domain'];
            $this->optionName = $config['option_name'];
            self::$pluginOptionName = $config['option_name'];

            $this->pluginFile = $config['plugin_file'];
            $this->pluginBasename = $config['plugin_basename'];
            $this->pluginUploadDir = $config['plugin_upload_dir'];

            self::$verifyUrl = $config['verify_url'];
            self::$itemId = $config['item_id'];

            self::$website = parse_url(site_url(), PHP_URL_HOST);

            $this->purchaseCode = get_option("{$this->optionName}_purchase_code");

            $this->capability = 'manage_options';

            self::$settings = $config['settings'];

            $this->defaultSettings = array(
                'pwa' => 'on',
                'pwaDynamicManifest' => 'off',
                'pwaName' => get_bloginfo('name'),
                'pwaShortName' => get_bloginfo('name'),
                'pwaStartPage' => trailingslashit(home_url('/', 'https')),
                'pwaDescription' => get_bloginfo('description'),
                'pwaIcon' => '',
                'pwaDisplayMode' => 'standalone',
                'pwaOrientation' => 'any',
                'pwaIosStatusBarStyle' => 'default',
                'pwaThemeColor' => '#FFFFFF',
                'pwaBackgroundColor' => '#FFFFFF',
                'pwaCategories' => array(),
                'pwaRelatedApplication' => 'off',
                'pwaRelatedApplicationPlatform' => '',
                'pwaRelatedApplicationUrl' => '',
                'pwaRelatedApplicationId' => '',
                'pwaAppShortcut1' => '',
                'pwaAppShortcut1Name' => '',
                'pwaAppShortcut1Url' => '',
                'pwaAppShortcut1Icon' => '',
                'pwaAppShortcut2' => '',
                'pwaAppShortcut2Name' => '',
                'pwaAppShortcut2Url' => '',
                'pwaAppShortcut2Icon' => '',
                'pwaAppShortcut3' => '',
                'pwaAppShortcut3Name' => '',
                'pwaAppShortcut3Url' => '',
                'pwaAppShortcut3Icon' => '',
                'pwaAppShortcut4' => '',
                'pwaAppShortcut4Name' => '',
                'pwaAppShortcut4Url' => '',
                'pwaAppShortcut4Icon' => '',
                'pwaOverlays' => 'on',
                'pwaOverlaysBrowsers' => array('chrome', 'firefox', 'safari'),
                'pwaOverlaysTypes' => array('fullscreen'),
                'pwaOverlaysBackgroundColor' => '#0A10FF',
                'pwaOverlaysTextColor' => '#FFFFFF',
                'pwaOverlaysShowAgain' => '2',
                'pwaInstallButton' => 'off',
                'pwaInstallButtonShortcode' => '[pwa-install-button]',
                'pwaInstallButtonBrowsers' => array('chrome', 'firefox', 'safari'),
                'pwaInstallButtonText' => 'Install App',
                'pwaInstallButtonBackgroundColor' => '#0A10FF',
                'pwaInstallButtonTextColor' => '#FFFFFF',
                'pwaOfflineFallbackPage' => '',
                'pwaOfflineNotification' => 'on',
                'pwaOfflineForms' => 'off',
                'pwaOfflineGoogleAnalytics' => 'off',
                'pwaOfflineHtmlStrategy' => 'StaleWhileRevalidate',
                'pwaOfflineJavascriptStrategy' => 'StaleWhileRevalidate',
                'pwaOfflineStylesheetsStrategy' => 'StaleWhileRevalidate',
                'pwaOfflineImagesStrategy' => 'StaleWhileRevalidate',
                'pwaOfflineFontsStrategy' => 'StaleWhileRevalidate',
                'pwaNavigationTabBar' => 'off',
                'pwaNavigationTabBarBgColor' => '#FFFFFF',
                'pwaNavigationTabBarIconColor' => '#B3B9CA',
                'pwaNavigationTabBarIconActiveColor' => '#FFFFFF',
                'pwaNavigationTabBarIconActiveBgColor' => '#2552FE',
                'pwaNavigationTabBarIconStyle' => 'default',
                'pwaNavigationTabBarItem1' => '',
                'pwaNavigationTabBarItem1Icon' => '',
                'pwaNavigationTabBarItem1Page' => '',
                'pwaNavigationTabBarItem2' => '',
                'pwaNavigationTabBarItem2Icon' => '',
                'pwaNavigationTabBarItem2Page' => '',
                'pwaNavigationTabBarItem3' => '',
                'pwaNavigationTabBarItem3Icon' => '',
                'pwaNavigationTabBarItem3Page' => '',
                'pwaNavigationTabBarItem4' => '',
                'pwaNavigationTabBarItem4Icon' => '',
                'pwaNavigationTabBarItem4Page' => '',
                'pwaNavigationTabBarItem5' => '',
                'pwaNavigationTabBarItem5Icon' => '',
                'pwaNavigationTabBarItem5Page' => '',
                'pwaNavigationTabBarItem6' => '',
                'pwaNavigationTabBarItem6Icon' => '',
                'pwaNavigationTabBarItem6Page' => '',
                'pwaNavigationTabBarItem7' => '',
                'pwaNavigationTabBarItem7Icon' => '',
                'pwaNavigationTabBarItem7Page' => '',
                'pwaWebShareButton' => 'off',
                'pwaWebShareButtonIconColor' => '#FFFFFF',
                'pwaWebShareButtonBgColor' => '#3740FF',
                'pwaWebShareButtonPosition' => 'bottom-right',
                'pwaPullDownNavigation' => 'off',
                'pwaPullDownNavigationBgColor' => '#3740FF',
                'pwaSwipeNavigation' => 'off',
                'pwaShakeToRefresh' => 'off',
                'pwaPreloader' => 'off',
                'pwaPreloaderStyle' => 'default',
                'pwaToastMessages' => 'on',
                'pwaAjaxify' => 'off',
                'pwaAjaxifyForms' => 'off',
                'pwaAjaxifySelectors' => '',
                'pwaBackgroundSync' => 'off',
                'pwaPersistentStorage' => 'off',
                'pwaWebShareTarget' => 'off',
                'pwaWebShareTargetAction' => '',
                'pwaWebShareTargetUrlQuery' => '',
                'pwaVibration' => 'off',
                'pwaScreenWakeLock' => 'off',
                'pwaPushPrompt' => 'on',
                'pwaPushPromptMessage' => 'We would like to show you notifications for the latest news and updates.',
                'pwaPushPromptTextColor' => '#444F5B',
                'pwaPushPromptBgColor' => '#FFFFFF',
                'pwaPushButton' => 'on',
                'pwaPushButtonIconColor' => '#FFFFFF',
                'pwaPushButtonBgColor' => '#FF3838',
                'pwaPushButtonPosition' => 'bottom-left',
                'pwaPushButtonBehavior' => 'shown',
                'pwaPushNewContent' => 'off',
                'pwaPushNewContentPostTypes' => array('post'),
                'pwaPushWooNewProduct' => 'off',
                'pwaPushWooPriceDrop' => 'off',
                'pwaPushWooSalePrice' => 'off',
                'pwaPushWooBackInStock' => 'off',
                'pwaPushWooNewOrder' => 'off',
                'pwaPushWooNewOrderRoles' => array('administrator'),
                'pwaPushWooLowStock' => 'off',
                'pwaPushWooLowStockRole' => array('administrator'),
                'pwaPushWooLowStockThreshold' => '5',
                'pwaPushBpMemberMention' => 'off',
                'pwaPushBpMemberReply' => 'off',
                'pwaPushBpNewMessage' => 'off',
                'pwaPushBpFriendRequest' => 'off',
                'pwaPushBpFriendAccepted' => 'off',
                'amp' => 'on',
                'ampMode' => 'paired',
                'ampMobileRedirect' => 'off',
                'ampOnAll' => 'on',
                'ampOnPages' => array('post'),
                'ampOnPostTypes' => array('is_singular'),
                'ampAdSenseAutoAds' => 'off',
                'ampAdSenseAutoAdsClient' => '',
                'ampAdAboveContentSize' => 'responsive',
                'ampAdAboveContentClient' => '',
                'ampAdAboveContentSlot' => '',
                'ampAdInsideContentSize' => 'responsive',
                'ampAdInsideContentClient' => '',
                'ampAdInsideContentSlot' => '',
                'ampAdBelowContentSize' => 'responsive',
                'ampAdBelowContentClient' => '',
                'ampAdBelowContentSlot' => '',
                'ampAdAboveContent' => 'off',
                'ampAdInsideContent' => 'off',
                'ampAdBelowContent' => 'off',
                'ampGoogleAnalytics' => 'off',
                'ampGoogleAnalyticsTrackingId' => '',
                'ampGoogleAnalyticsAmpLinker' => 'off',
                'ampFacebookPixelId' => '',
                'ampSegmentAnalyticsWriteKey' => '',
                'ampStatCounterUrl' => '',
                'ampHistatsAnalyticsId' => '',
                'ampYandexMetrikaCounterId' => '',
                'ampChartbeatAnalyticsAccountId' => '',
                'ampClickyAnalyticsSiteId' => '',
                'ampFacebookPixel' => 'off',
                'ampSegmentAnalytics' => 'off',
                'ampStatCounter' => 'off',
                'ampHistatsAnalytics' => 'off',
                'ampYandexMetrika' => 'off',
                'ampChartbeatAnalytics' => 'off',
                'ampClickyAnalytics' => 'off',
                'ampAlexaMetrics' => 'off',
                'ampAlexaMetricsAccount' => '',
                'ampAlexaMetricsDomain' => '',
                'ampCookieNotice' => 'off',
                'ampCookieNoticeMessage' => 'This website uses cookies to ensure you get the best experience on our website.',
                'ampCookieNoticeButtonText' => 'Got it!',
                'ampCookieNoticePosition' => 'top',
                'fbia' => 'on',
                'fbiaPageId' => '',
                'fbiaPostTypes' => array('post'),
                'fbiaArticleStyle' => 'default',
                'fbiaCopyright' => '',
                'fbiaRtlPublishing' => 'off',
                'fbiaArticleQuantity' => '10',
                'fbiaArticleInteraction' => 'off',
                'fbiaAudienceNetwork' => 'off',
                'fbiaAudienceNetworkPlacementId' => '',
                'fbiaAnalytics' => 'off',
                'fbiaAnalyticsCode' => '',
            );
            
            if (get_transient("{$this->optionName}_updated")) {
                update_option("{$this->optionName}_settings", wp_parse_args(self::$settings, $this->defaultSettings));
                delete_transient("{$this->optionName}_updated");
            }

            if ($this->purchaseCode) {
                if (daftplugInstantify::getSetting('pwa') == 'on') {
                   require_once(plugin_dir_path(dirname(__FILE__)) . 'pwa/includes/class-plugin.php');
                   $this->daftplugInstantifyPwa = new daftplugInstantifyPwa($config);
                }

                if (daftplugInstantify::getSetting('amp') == 'on') {
                   require_once(plugin_dir_path(dirname(__FILE__)) . 'amp/includes/class-plugin.php');
                   $this->daftplugInstantifyAmp = new daftplugInstantifyAmp($config);
                }

                if (daftplugInstantify::getSetting('fbia') == 'on') {
                   require_once(plugin_dir_path(dirname(__FILE__)) . 'fbia/includes/class-plugin.php');
                   $this->daftplugInstantifyFbia = new daftplugInstantifyFbia($config);
                }

                if (!wp_next_scheduled("{$this->optionName}_verify_license_schedule_weekly")) {
                    wp_schedule_event(time(), 'weekly', "{$this->optionName}_verify_license_schedule_weekly");
                }
            }

            if ($this->isPublic()) {
                require_once(plugin_dir_path(dirname(__FILE__)) . 'public/class-public.php');
                $this->daftplugInstantifyPublic = new daftplugInstantifyPublic($config, $this->daftplugInstantifyPwa, $this->daftplugInstantifyAmp, $this->daftplugInstantifyFbia);
            }

            if ($this->isAdmin()) {
                require_once(plugin_dir_path(dirname(__FILE__)) . 'admin/class-admin.php');
                $this->daftplugInstantifyAdmin = new daftplugInstantifyAdmin($config, $this->daftplugInstantifyPwa, $this->daftplugInstantifyAmp, $this->daftplugInstantifyFbia);
            }

            add_action('plugins_loaded', array($this, 'loadTextDomain'));
            add_filter("plugin_action_links_{$this->pluginBasename}", array($this, 'addPluginActionLinks'));
            register_activation_hook($this->pluginFile, array($this, 'onActivate'));
            add_action('upgrader_process_complete', array($this, 'onUpdate'), 10, 2);
            register_deactivation_hook($this->pluginFile, array($this, 'onDeactivate'));
            add_action("{$this->optionName}_verify_license_schedule_weekly", array($this, 'verifyLicenseSchedule'));
        }

        public function loadTextDomain() {
            load_plugin_textdomain($this->textDomain, false, dirname($this->pluginBasename) . '/languages/');
        }

        public function addPluginActionLinks($links) {
            $slug = self::$slug;
            $links[] = '<a href="'.esc_url(admin_url("admin.php?page={$slug}")).'">Settings</a>';
            $links[] = '<a href="http://codecanyon.net/user/daftplug/portfolio?ref=DaftPlug" target="_blank">More plugins by DaftPlug</a>';
        
            return $links;
        }

        public function onActivate() {
            global $wp_version;

            $errors = array(
                'wpVersion' => array(
                    'message' => __('⚠️ Instantify features require later version of WordPress core. Please upgrade your WordPress core to later versions.', $this->textDomain),
                    'condition' => version_compare($wp_version, '4.7', '<'),
                ),
                'phpVersion' => array(
                    'message' => __('⚠️ Instantify features require at least PHP version 7.0 to function properly.', $this->textDomain),
                    'condition' => version_compare(PHP_VERSION, '7.0', '<'),
                ),
                'curl' => array(
                    'message' => __('⚠️ Instantify features require <i>curl</i> extension to function properly.', $this->textDomain),
                    'condition' => !extension_loaded('curl'),
                ),
                'dom' => array(
                    'message' => __('⚠️ Instantify features require <i>dom</i> extension to function properly.', $this->textDomain),
                    'condition' => !extension_loaded('dom'),
                ),
                'iconv' => array(
                    'message' => __('⚠️ Instantify features require <i>iconv</i> extension to function properly.', $this->textDomain),
                    'condition' => !extension_loaded('iconv'),
                ),
                'libxml' => array(
                    'message' => __('⚠️ Instantify features require <i>libxml</i> extension to function properly.', $this->textDomain),
                    'condition' => !extension_loaded('libxml'),
                ),
                'spl' => array(
                    'message' => __('⚠️ Instantify features require <i>spl</i> extension to function properly.', $this->textDomain),
                    'condition' => !extension_loaded('spl'),
                ),
            );

            foreach ($errors as $error) {
                if ($error['condition']) {
                    die('<p style="font-family:cursive;font-size:15px;font-weight:600;color:#4073ff;margin-top:16px;">'.$error['message'].' '. __('If you have trouble fixing this, please contact us on', $this->textDomain).' <i>support@daftplug.com</i></p>');
                }
            }

            add_option("{$this->optionName}_settings", $this->defaultSettings);
            add_option("{$this->optionName}_subscribed_devices", array());

            if (!version_compare(PHP_VERSION, '7.1', '<') && extension_loaded('gmp') && extension_loaded('mbstring') && extension_loaded('openssl')) {
                require_once plugin_dir_path($this->pluginFile) . implode(DIRECTORY_SEPARATOR, array('pwa', 'includes', 'libs', 'web-push-php', 'autoload.php'));
                $vapidKeys = VAPID::createVapidKeys();
                add_option("{$this->optionName}_vapid_keys", array('pwaPublicKey' => $vapidKeys['publicKey'], 'pwaPrivateKey' => $vapidKeys['privateKey']));
            }

            set_transient("{$this->optionName}_installation_analytics", array(
                date('j M Y') => 0,
            ));

            if (!is_dir($this->pluginUploadDir)) {
                wp_mkdir_p($this->pluginUploadDir);
            }
        }

        public function onUpdate($upgrader_object, $options) {
            if($options['action'] == 'update' && $options['type'] == 'plugin' && isset($options['plugins'])) {
                foreach ($options['plugins'] as $plugin) {
                    if ($plugin == $this->pluginBasename) {
                        set_transient("{$this->optionName}_updated", 'yes');
                    }
                }
            }
        }

        public function onDeactivate() {
            do_action("{$this->optionName}_on_deactivate");
        }

        public function verifyLicenseSchedule() {
            $verify = $this->handleLicense($this->purchaseCode, 'verify');

            if ($verify->verification->code == '404' || $verify->verification->code == '403') {
                delete_option("{$this->optionName}_purchase_code");
                include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                deactivate_plugins($this->pluginBasename);
            }
        }

        public static function handleLicense($purchaseCode, $action) {
            $params = array(
                'body' => array(
                    'action' => $action,
                    'slug' => urlencode(self::$slug),
                    'item_id' => urlencode(self::$itemId),
                    'purchase_code' => urlencode($purchaseCode),
                    'website' => self::$website
                ),
                'user-agent' => 'WordPress/'.get_bloginfo('version').'; '.get_bloginfo('url')
            );
        
            $response = wp_remote_post(self::$verifyUrl, $params);
        
            if (!is_wp_error($response) || wp_remote_retrieve_response_code($response) === 200) {
                $result = json_decode(wp_remote_retrieve_body($response));
            } else {
				$result = $response->get_error_message();
			}

            return $result;
        }

        public static function getSetting($key) {
            if (array_key_exists($key, self::$settings)) {
                return self::$settings[$key];
            } else {
                return false;
            }
        }

        public static function setSetting($key, $value) {
            $optionName = self::$pluginOptionName;
            self::$settings[$key] = $value;
            update_option("{$optionName}_settings", self::$settings);
        }

        public static function isAdmin() {
            if (function_exists('is_admin') && is_admin()) {
                return true;
            } else {
                $currentUrl = set_url_scheme(
                    sprintf(
                        'http://%s%s',
                        $_SERVER['HTTP_HOST'],
                        $_SERVER['REQUEST_URI']
                    )
                );
                $adminUrl = strtolower(admin_url());

                if (strpos($currentUrl, $adminUrl) !== false) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public static function isPublic() {
            if (function_exists('is_admin') && function_exists('wp_doing_ajax') && !is_admin() && wp_doing_ajax()) {
                return true;
            } else {
                $currentUrl = set_url_scheme(
                    sprintf(
                        'http://%s%s',
                        $_SERVER['HTTP_HOST'],
                        $_SERVER['REQUEST_URI']
                    )
                );
                $adminUrl = strtolower(admin_url());

                if (strpos($currentUrl, $adminUrl) !== false) {
                    if (strpos($currentUrl, 'admin-ajax.php') !== false) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }
            }
        }

        public static function isWooCommerceActive() {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
            return is_plugin_active('woocommerce/woocommerce.php');
        }

        public static function isBuddyPressActive() {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
            return is_plugin_active('buddypress/bp-loader.php');
        }
        
        public static function getCurrentUrl() {
            $http = 'http';
            if (isset($_SERVER['HTTPS'])) {
                $http = 'https';
            }
            $host = $_SERVER['HTTP_HOST'];
            $requestUri = $_SERVER['REQUEST_URI'];
            return $http.'://'.htmlentities($host).htmlentities($requestUri);
        }
    }
}
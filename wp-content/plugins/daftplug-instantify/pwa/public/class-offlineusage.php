<?php

if (!defined('ABSPATH')) exit;

if (!class_exists('daftplugInstantifyPwaPublicOfflineusage')) {
    class daftplugInstantifyPwaPublicOfflineusage {
        public $name;
        public $description;
        public $slug;
        public $version;
        public $textDomain;
        public $optionName;

        public $pluginFile;
        public $pluginBasename;

        public $settings;

        public $daftplugInstantifyPwaPublic;

        public static $serviceWorkerName;
        public $serviceWorker;

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

            $this->daftplugInstantifyPwaPublic = $daftplugInstantifyPwaPublic;

            self::$serviceWorkerName = (daftplugInstantifyPwa::isOnesignalActive() ? 'OneSignalSDKWorker.js.php' : 'daftplugInstantifyPwaServiceWorker');
            $this->serviceWorker = '';

            add_action('parse_request', array($this, 'generateServiceWorker'));
            add_action('wp_head', array($this, 'renderRegisterServiceWorker'));
        }

        public function generateServiceWorker() {
            global $wp;
            if ($wp->request == self::$serviceWorkerName) {
                header('Content-Type: text/javascript; charset=utf-8');
                $offlinePage = daftplugInstantify::getSetting('pwaOfflineFallbackPage');
                $routes = array(
                    'html' => array(
                        'destination' => 'document',
                        'strategy' => daftplugInstantify::getSetting('pwaOfflineHtmlStrategy'),
                    ),
                    'javascript' => array(
                        'destination' => 'script',
                        'strategy' => daftplugInstantify::getSetting('pwaOfflineJavascriptStrategy'),
                    ),
                    'stylesheets' => array(
                        'destination' => 'style',
                        'strategy' => daftplugInstantify::getSetting('pwaOfflineStylesheetsStrategy'),
                    ),
                    'images'  => array(
                        'destination' => 'image',
                        'strategy' => daftplugInstantify::getSetting('pwaOfflineImagesStrategy'),
                    ),
                    'fonts' => array(
                        'destination' => 'font',
                        'strategy' => daftplugInstantify::getSetting('pwaOfflineFontsStrategy'),
                    ),
                );

                $this->serviceWorker .= "const CACHE = '{$this->slug}';\n\n";

                $this->serviceWorker .= "importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');\n\n";

                $this->serviceWorker .= "if (workbox) {\n";
                    $this->serviceWorker .= "workbox.core.skipWaiting();\n";
                    $this->serviceWorker .= "workbox.core.clientsClaim();\n";
                    if (!empty($offlinePage)) {
                        $this->serviceWorker .= "workbox.precaching.precacheAndRoute([{url: '{$offlinePage}', revision: null}], {ignoreURLParametersMatching: [/.*/]});\n";
                        $this->serviceWorker .= "workbox.precaching.cleanupOutdatedCaches();\n";
                    }

                    $this->serviceWorker .= "workbox.routing.registerRoute(/wp-admin(.*)|wp-json(.*)|(.*)preview=true(.*)/, new workbox.strategies.NetworkOnly());\n";
                    foreach ($routes as $key => $values) {
                        if ($key == 'html') {
                            $this->serviceWorker .= "workbox.routing.registerRoute(({event}) => event.request.destination === '{$values['destination']}',
                                                        async (args) => {
                                                            try {
                                                                const response = await new workbox.strategies.{$values['strategy']}({
                                                                    cacheName: CACHE + '-{$key}',
                                                                    plugins: [
                                                                        new workbox.expiration.ExpirationPlugin({
                                                                            maxEntries: 50,
                                                                        }),
                                                                        new workbox.cacheableResponse.CacheableResponsePlugin({
                                                                            statuses: [0, 200]
                                                                        }),
                                                                    ],
                                                                }).handle(args);
                                                                return response || await caches.match('{$offlinePage}');
                                                            } catch (error) {
                                                                console.log('catch:', error);
                                                                return await caches.match('{$offlinePage}');
                                                            }
                                                        }
                                                    );\n\n";
                        } else {
                            $this->serviceWorker .= "workbox.routing.registerRoute(({event}) => event.request.destination === '{$values['destination']}',
                                                        new workbox.strategies.{$values['strategy']}({
                                                            cacheName: CACHE + '-{$key}',
                                                            plugins: [
                                                                new workbox.expiration.ExpirationPlugin({
                                                                    maxEntries: 30,
                                                                }),
                                                                new workbox.cacheableResponse.CacheableResponsePlugin({
                                                                    statuses: [0, 200]
                                                                }),
                                                            ],
                                                        })
                                                    );\n";
                        }
                    }
                                
                    if (daftplugInstantify::getSetting('pwaOfflineGoogleAnalytics') == 'on') {
                        $this->serviceWorker .= "workbox.googleAnalytics.initialize();\n";
                    }

                    $this->serviceWorker = apply_filters("{$this->optionName}_pwa_serviceworker_workbox", $this->serviceWorker);

                $this->serviceWorker .= "}\n";

                if (daftplugInstantifyPwa::isOnesignalActive()) {
                    $this->serviceWorker .= "importScripts('https://cdn.onesignal.com/sdks/OneSignalSDKWorker.js');\n";
                }
                                        
                $this->serviceWorker = apply_filters("{$this->optionName}_pwa_serviceworker", $this->serviceWorker);
                
                echo $this->serviceWorker;
                exit;
            }
        }

        public function renderRegisterServiceWorker() {
            include_once($this->daftplugInstantifyPwaPublic->partials['registerServiceWorker']);
        }

        public static function getServiceWorkerUrl($encoded = true) {
            $serviceWorkerUrl = untrailingslashit(home_url('/', 'https') . self::$serviceWorkerName);
            if ($encoded) {
                return wp_json_encode($serviceWorkerUrl);
            }

            return $serviceWorkerUrl;
        }
    }
}
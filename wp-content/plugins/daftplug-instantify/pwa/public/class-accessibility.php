<?php

if (!defined('ABSPATH')) exit;

if (!class_exists('daftplugInstantifyPwaPublicAccessibility')) {
    class daftplugInstantifyPwaPublicAccessibility {
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

            if (daftplugInstantify::getSetting('pwaPreloader') == 'on') {
                add_filter("{$this->optionName}_public_html", array($this, 'renderPreloader'));
            }
            
            if (wp_is_mobile()) {
            	if (daftplugInstantify::getSetting('pwaNavigationTabBar') == 'on') {
                    add_filter("{$this->optionName}_public_html", array($this, 'renderNavigationTabBar'));
                    if (daftplugInstantify::isWooCommerceActive()) {
                        add_filter('woocommerce_add_to_cart_fragments', array($this, 'refreshCartItemsCount'));
                    }
                }
                
                if (daftplugInstantify::getSetting('pwaWebShareButton') == 'on') {
                    add_filter("{$this->optionName}_public_html", array($this, 'renderWebShareButton'));
                }

            	if (daftplugInstantify::getSetting('pwaToastMessages') == 'on') {
                	add_filter("{$this->optionName}_public_js", array($this, 'handleToastMessages'));
            	}

                if (daftplugInstantify::getSetting('pwaSwipeNavigation') == 'on') {
                    add_filter("{$this->optionName}_public_js_vars", array($this, 'addSwipeJsVars'));
                }
            }
    	}
        
        public function renderPreloader() {
            if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
                return;
            }

            include_once($this->daftplugInstantifyPwaPublic->partials['preloader']);
        }

        public function renderNavigationTabBar() {
            if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
                return;
            }

            include_once($this->daftplugInstantifyPwaPublic->partials['navigationTabBar']);
        }

        public function refreshCartItemsCount($fragments) {
            ob_start();
            echo '<span class="daftplugPublicNavigationTabBar_cartcount">'.sizeof(WC()->cart->get_cart()).'</span>';
            $fragments['.daftplugPublicNavigationTabBar_cartcount'] = ob_get_clean();

            return $fragments;
        }
        
        public function renderWebShareButton() {
            if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
                return;
            }

            include_once($this->daftplugInstantifyPwaPublic->partials['webShareButton']);
        }

        public function handleToastMessages() {
            if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
                return;
            }

            $home = esc_html__('Homepage Opened', $this->textDomain);
            $post = esc_html__('Post Opened', $this->textDomain);
            $product = esc_html__('Product Opened', $this->textDomain);
            $page = esc_html__('Page Opened', $this->textDomain);
            $cart = esc_html__('Cart Opened', $this->textDomain);
            $checkout = esc_html__('Checkout Opened', $this->textDomain);
            $notFound = esc_html__('Page Not Found', $this->textDomain);
            $search = esc_html__('Search Results', $this->textDomain);
            $category = esc_html__('Category Opened', $this->textDomain);
            $shop = esc_html__('Shop Opened', $this->textDomain);
            $tag = esc_html__('Tag Opened', $this->textDomain);
            $author = esc_html__('Author Opened', $this->textDomain);

            if (is_front_page() || is_home()) {
                echo "jQuery.toast({
                          title: '{$home}',
                          duration: 3000,
                          position: 'bottom',
                      });";
            } elseif (is_single()) {
                if (function_exists('is_product') && is_product()) {
                    echo "jQuery.toast({
                        title: '{$product}',
                        duration: 3000,
                        position: 'bottom',
                    });";
                } else {
                    echo "jQuery.toast({
                        title: '{$post}',
                        duration: 3000,
                        position: 'bottom',
                    });";
                }
            } elseif (is_page()) {
                if (function_exists('is_cart') && is_cart()) {
                    echo "jQuery.toast({
                        title: '{$cart}',
                        duration: 3000,
                        position: 'bottom',
                    });";
                } elseif (function_exists('is_checkout') && is_checkout()) {
                    echo "jQuery.toast({
                        title: '{$checkout}',
                        duration: 3000,
                        position: 'bottom',
                    });";
                } else {
                    echo "jQuery.toast({
                        title: '{$page}',
                        duration: 3000,
                        position: 'bottom',
                    });";
                }
            } elseif (is_404()) {
                echo "jQuery.toast({
                          title: '{$notFound}',
                          duration: 3000,
                          position: 'bottom',
                      });";
            } elseif (is_search()) {
                echo "jQuery.toast({
                          title: '{$search}',
                          duration: 3000,
                          position: 'bottom',
                      });";
            } elseif (is_category()) {
                echo "jQuery.toast({
                          title: '{$category}',
                          duration: 3000,
                          position: 'bottom',
                      });";
            } elseif (function_exists('is_shop') && is_shop()) {
                echo "jQuery.toast({
                          title: '{$shop}',
                          duration: 3000,
                          position: 'bottom',
                      });";
            } elseif (is_tag()) {
                echo "jQuery.toast({
                          title: '{$tag}',
                          duration: 3000,
                          position: 'bottom',
                      });";
            } elseif (is_author()) {
                echo "jQuery.toast({
                          title: '{$author}',
                          duration: 3000,
                          position: 'bottom',
                      });";
            }
        }

        public function addSwipeJsVars($vars) {
            $vars['pwaSwipeBackMsg'] = esc_html__('Moved Back', $this->textDomain);
            $vars['pwaSwipeForwardMsg'] = esc_html__('Moved Forward', $this->textDomain);

            return $vars;
        }
    }
}
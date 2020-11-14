<?php

if (!defined('ABSPATH')) exit;

?>
<div class="daftplugAdminPage_subpage -accessibility -flex12" data-subpage="accessibility">
	<div class="daftplugAdminPage_content -flex8">
        <div class="daftplugAdminSettings -flexAuto">
            <form name="daftplugAdminSettings_form" class="daftplugAdminSettings_form" data-nonce="<?php echo wp_create_nonce("{$this->optionName}_settings_nonce"); ?>" spellcheck="false" autocomplete="off">
                <fieldset class="daftplugAdminFieldset">
                    <h4 class="daftplugAdminFieldset_title"><?php esc_html_e('Navigation Tab Bar', $this->textDomain); ?></h4>
                    <p class="daftplugAdminFieldset_description"><?php _e('Navigation tab bar provides app like experience by adding tabbed navigation menu bar on the bottom of your web app when accessed from mobile devices.', $this->textDomain); ?></p>
                    <div class="daftplugAdminField">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Enable or disable navigation tab bar.', $this->textDomain); ?></p>
                        <label for="pwaNavigationTabBar" class="daftplugAdminField_label -flex4"><?php esc_html_e('Navigation Tab Bar', $this->textDomain); ?></label>
                        <label class="daftplugAdminInputCheckbox -flexAuto">
                            <input type="checkbox" name="pwaNavigationTabBar" id="pwaNavigationTabBar" class="daftplugAdminInputCheckbox_field" <?php checked(daftplugInstantify::getSetting('pwaNavigationTabBar'), 'on'); ?>>
                        </label>
                    </div>
                    <div class="daftplugAdminField -pwaNavigationTabBarDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Select the background color of navigation tab bar.', $this->textDomain); ?></p>
                        <label for="pwaNavigationTabBarBgColor" class="daftplugAdminField_label -flex4"><?php esc_html_e('Background Color', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputColor -flexAuto">
                            <input type="text" name="pwaNavigationTabBarBgColor" id="pwaNavigationTabBarBgColor" class="daftplugAdminInputColor_field" value="<?php echo daftplugInstantify::getSetting('pwaNavigationTabBarBgColor'); ?>" data-placeholder="<?php esc_html_e('Background Color', $this->textDomain); ?>" required>
                        </div>
                    </div>
                    <div class="daftplugAdminField -pwaNavigationTabBarDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Select the color of icons in navigation tab bar.', $this->textDomain); ?></p>
                        <label for="pwaNavigationTabBarIconColor" class="daftplugAdminField_label -flex4"><?php esc_html_e('Icon Color', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputColor -flexAuto">
                            <input type="text" name="pwaNavigationTabBarIconColor" id="pwaNavigationTabBarIconColor" class="daftplugAdminInputColor_field" value="<?php echo daftplugInstantify::getSetting('pwaNavigationTabBarIconColor'); ?>" data-placeholder="<?php esc_html_e('Icon Color', $this->textDomain); ?>" required>
                        </div>
                    </div>
                    <div class="daftplugAdminField -pwaNavigationTabBarDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Select the color of active icon in navigation tab bar.', $this->textDomain); ?></p>
                        <label for="pwaNavigationTabBarIconActiveColor" class="daftplugAdminField_label -flex4"><?php esc_html_e('Icon Active Color', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputColor -flexAuto">
                            <input type="text" name="pwaNavigationTabBarIconActiveColor" id="pwaNavigationTabBarIconActiveColor" class="daftplugAdminInputColor_field" value="<?php echo daftplugInstantify::getSetting('pwaNavigationTabBarIconActiveColor'); ?>" data-placeholder="<?php esc_html_e('Active Icon Color', $this->textDomain); ?>" required>
                        </div>
                    </div>
                    <div class="daftplugAdminField -pwaNavigationTabBarDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Select the background color of active icon in navigation tab bar.', $this->textDomain); ?></p>
                        <label for="pwaNavigationTabBarIconActiveBgColor" class="daftplugAdminField_label -flex4"><?php esc_html_e('Icon Active Background Color', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputColor -flexAuto">
                            <input type="text" name="pwaNavigationTabBarIconActiveBgColor" id="pwaNavigationTabBarIconActiveBgColor" class="daftplugAdminInputColor_field" value="<?php echo daftplugInstantify::getSetting('pwaNavigationTabBarIconActiveBgColor'); ?>" data-placeholder="<?php esc_html_e('Active Icon Background Color', $this->textDomain); ?>" required>
                        </div>
                    </div>
                    <div class="daftplugAdminField -pwaNavigationTabBarDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Select the style of icon in navigation tab bar.', $this->textDomain); ?></p>
                        <label for="pwaNavigationTabBarIconStyle" class="daftplugAdminField_label -flex4"><?php esc_html_e('Icon Style', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputSelect -flexAuto">
                            <select name="pwaNavigationTabBarIconStyle" id="pwaNavigationTabBarIconStyle" class="daftplugAdminInputSelect_field" data-placeholder="<?php esc_html_e('Icon Style', $this->textDomain); ?>" autocomplete="off" required>
                                <option value="default" <?php selected(daftplugInstantify::getSetting('pwaNavigationTabBarIconStyle'), 'default') ?>><?php esc_html_e('Default', $this->textDomain); ?></option>
                                <option value="ios" <?php selected(daftplugInstantify::getSetting('pwaNavigationTabBarIconStyle'), 'ios') ?>><?php esc_html_e('iOS', $this->textDomain); ?></option>
                                <option value="material" <?php selected(daftplugInstantify::getSetting('pwaNavigationTabBarIconStyle'), 'material') ?>><?php esc_html_e('Material', $this->textDomain); ?></option>
                                <option value="windows10" <?php selected(daftplugInstantify::getSetting('pwaNavigationTabBarIconStyle'), 'windows10') ?>><?php esc_html_e('Windows 10', $this->textDomain); ?></option>
                                <option value="colorful" <?php selected(daftplugInstantify::getSetting('pwaNavigationTabBarIconStyle'), 'colorful') ?>><?php esc_html_e('Colorful', $this->textDomain); ?></option>
                                <option value="blueui" <?php selected(daftplugInstantify::getSetting('pwaNavigationTabBarIconStyle'), 'blueui') ?>><?php esc_html_e('Blue UI', $this->textDomain); ?></option>
                                <option value="gradientline" <?php selected(daftplugInstantify::getSetting('pwaNavigationTabBarIconStyle'), 'gradientline') ?>><?php esc_html_e('Gradient Line', $this->textDomain); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="daftplugAdminField -pwaNavigationTabBarDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Add items to the navigation tab bar.', $this->textDomain); ?></p>
                        <label for="pwaNavigationTabBarItem" class="daftplugAdminField_label -flex4"><?php esc_html_e('Navigation Items', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputAddField -flexAuto">
                            <span class="daftplugAdminButton -addField" data-add="pwaNavigationTabBarItem" data-max="11"><?php esc_html_e('+ Add Navigation Item', $this->textDomain); ?></span>
                        </div>
                    </div>
                    <?php for ($a = 1; $a <= 7; $a++) { ?>
                    <fieldset class="daftplugAdminFieldset -miniFieldset -pwaNavigationTabBarItem<?php echo $a; ?> -pwaNavigationTabBarDependentDisableD">
                        <h5 class="daftplugAdminFieldset_title"><?php printf(__('Navigation Item %s', $this->textDomain), $a); ?></h5>
                        <label class="daftplugAdminInputCheckbox -flexAuto -hidden">
                            <input type="checkbox" name="pwaNavigationTabBarItem<?php echo $a; ?>" id="pwaNavigationTabBarItem<?php echo $a; ?>" class="daftplugAdminInputCheckbox_field" <?php checked(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%s', $a)), 'on'); ?>>
                        </label>
                        <div class="daftplugAdminField">
                            <label for="pwaNavigationTabBarItem<?php echo $a; ?>Icon" class="daftplugAdminField_label -flex2"><?php esc_html_e('Icon', $this->textDomain); ?></label>
                            <div class="daftplugAdminInputSelect -flexAuto">
                                <select name="pwaNavigationTabBarItem<?php echo $a; ?>Icon" id="pwaNavigationTabBarItem<?php echo $a; ?>Icon" class="daftplugAdminInputSelect_field" data-placeholder="<?php esc_html_e('Icon', $this->textDomain); ?>" autocomplete="off" required>
                                    <option value="home" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'home') ?>><?php esc_html_e('Home', $this->textDomain); ?></option>
                                    <option value="search" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'search') ?>><?php esc_html_e('Search', $this->textDomain); ?></option>
                                    <?php if (daftplugInstantify::isWooCommerceActive()) { ?>
                                        <option value="shop" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'shop') ?>><?php esc_html_e('Shop', $this->textDomain); ?></option>
                                        <option value="cart" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'cart') ?>><?php esc_html_e('Cart', $this->textDomain); ?></option>
                                        <option value="checkout" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'checkout') ?>><?php esc_html_e('Checkout', $this->textDomain); ?></option>
                                    <?php } ?>
                                    <option value="blog" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'blog') ?>><?php esc_html_e('Blog', $this->textDomain); ?></option>
                                    <option value="notifications" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'notifications') ?>><?php esc_html_e('Notifications', $this->textDomain); ?></option>
                                    <option value="account" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'account') ?>><?php esc_html_e('Account', $this->textDomain); ?></option>
                                    <option value="about" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'about') ?>><?php esc_html_e('About', $this->textDomain); ?></option>
                                    <option value="contact" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'contact') ?>><?php esc_html_e('Contact', $this->textDomain); ?></option>
                                    <option value="faq" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'faq') ?>><?php esc_html_e('FAQ', $this->textDomain); ?></option>
                                    <option value="settings" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a)), 'settings') ?>><?php esc_html_e('Settings', $this->textDomain); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="daftplugAdminField">
                            <label for="pwaNavigationTabBarItem<?php echo $a; ?>Page" class="daftplugAdminField_label -flex2"><?php esc_html_e('Page', $this->textDomain); ?></label>
                            <div class="daftplugAdminInputSelect -flexAuto">
                                <select name="pwaNavigationTabBarItem<?php echo $a; ?>Page" id="pwaNavigationTabBarItem<?php echo $a; ?>Page" class="daftplugAdminInputSelect_field" data-placeholder="<?php esc_html_e('Page', $this->textDomain); ?>" autocomplete="off" required>
                                    <option value="<?php echo trailingslashit(home_url('/', 'https')); ?>" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sPage', $a)), trailingslashit(home_url('/', 'https'))); ?>><?php esc_html_e('Home Page', $this->textDomain); ?></option>
                                    <option value="*directSearch*" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sPage', $a)), '*directSearch*'); ?>><?php esc_html_e('*Direct Search*', $this->textDomain); ?></option>
                                    <?php foreach (get_pages() as $page) { ?>
                                    <option value="<?php echo get_page_link($page->ID) ?>" <?php selected(daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sPage', $a)), get_page_link($page->ID)); ?>><?php echo $page->post_title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <?php } ?>
                </fieldset>
                <fieldset class="daftplugAdminFieldset" data-feature-type="new">
                    <h4 class="daftplugAdminFieldset_title"><?php esc_html_e('Web Share Button', $this->textDomain); ?></h4>
                    <p class="daftplugAdminFieldset_description"><?php esc_html_e('With the Web Share API, web apps are able to use the same system-provided share capabilities as platform-specific apps. From this section you can enable floating share button with the native share functionality for your mobile device users.', $this->textDomain); ?></p>
                    <div class="daftplugAdminField">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Enable or disable web share button on your website.', $this->textDomain); ?></p>
                        <label for="pwaWebShareButton" class="daftplugAdminField_label -flex4"><?php esc_html_e('Web Share Button', $this->textDomain); ?></label>
                        <label class="daftplugAdminInputCheckbox -flexAuto">
                            <input type="checkbox" name="pwaWebShareButton" id="pwaWebShareButton" class="daftplugAdminInputCheckbox_field" <?php checked(daftplugInstantify::getSetting('pwaWebShareButton'), 'on'); ?>>
                        </label>
                    </div>
                    <div class="daftplugAdminField -pwaWebShareButtonDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Select the share icon color on your web share button.', $this->textDomain); ?></p>
                        <label for="pwaWebShareButtonIconColor" class="daftplugAdminField_label -flex4"><?php esc_html_e('Button Icon Color', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputColor -flexAuto">
                            <input type="text" name="pwaWebShareButtonIconColor" id="pwaWebShareButtonIconColor" class="daftplugAdminInputColor_field" value="<?php echo daftplugInstantify::getSetting('pwaWebShareButtonIconColor'); ?>" data-placeholder="<?php esc_html_e('Button Icon Color', $this->textDomain); ?>" required>
                        </div>
                    </div>
                    <div class="daftplugAdminField -pwaWebShareButtonDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Select the background color of your web share button.', $this->textDomain); ?></p>
                        <label for="pwaWebShareButtonBgColor" class="daftplugAdminField_label -flex4"><?php esc_html_e('Button Background Color', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputColor -flexAuto">
                            <input type="text" name="pwaWebShareButtonBgColor" id="pwaWebShareButtonBgColor" class="daftplugAdminInputColor_field" value="<?php echo daftplugInstantify::getSetting('pwaWebShareButtonBgColor'); ?>" data-placeholder="<?php esc_html_e('Button Background Color', $this->textDomain); ?>" required>
                        </div>
                    </div>
                    <div class="daftplugAdminField -pwaWebShareButtonDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Select position of your web share button on your website.', $this->textDomain); ?></p>
                        <label for="pwaWebShareButtonPosition" class="daftplugAdminField_label -flex4"><?php esc_html_e('Button Position', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputSelect -flexAuto">
                            <select name="pwaWebShareButtonPosition" id="pwaWebShareButtonPosition" class="daftplugAdminInputSelect_field" data-placeholder="<?php esc_html_e('Button Position', $this->textDomain); ?>" autocomplete="off" required>
                                <option value="bottom-left" <?php selected(daftplugInstantify::getSetting('pwaWebShareButtonPosition'), 'bottom-left') ?>><?php esc_html_e('Bottom Left', $this->textDomain); ?></option>
                                <option value="top-left" <?php selected(daftplugInstantify::getSetting('pwaWebShareButtonPosition'), 'top-left') ?>><?php esc_html_e('Top Left', $this->textDomain); ?></option>
                                <option value="bottom-right" <?php selected(daftplugInstantify::getSetting('pwaWebShareButtonPosition'), 'bottom-right') ?>><?php esc_html_e('Bottom Right', $this->textDomain); ?></option>
                                <option value="top-right" <?php selected(daftplugInstantify::getSetting('pwaWebShareButtonPosition'), 'top-right') ?>><?php esc_html_e('Top Right', $this->textDomain); ?></option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="daftplugAdminFieldset">
                	<h4 class="daftplugAdminFieldset_title"><?php esc_html_e('Pull Down Navigation', $this->textDomain); ?></h4>
                    <p class="daftplugAdminFieldset_description"><?php esc_html_e('Pull down navigation touchscreen gesture allows your users to drag the screen and then release it, as a signal to the application to refresh contents or navigate your web app.', $this->textDomain); ?></p>
                    <div class="daftplugAdminField">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Enable or disable pull down navigation touchscreen gesture.', $this->textDomain); ?></p>
                        <label for="pwaPullDownNavigation" class="daftplugAdminField_label -flex4"><?php esc_html_e('Pull Down Navigation', $this->textDomain); ?></label>
                        <label class="daftplugAdminInputCheckbox -flexAuto">
                            <input type="checkbox" name="pwaPullDownNavigation" id="pwaPullDownNavigation" class="daftplugAdminInputCheckbox_field" <?php checked(daftplugInstantify::getSetting('pwaPullDownNavigation'), 'on'); ?>>
                        </label>
                    </div>
                    <div class="daftplugAdminField -pwaPullDownNavigationDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Select the background color of pull down navigation touchscreen gesture.', $this->textDomain); ?></p>
                        <label for="pwaPullDownNavigationBgColor" class="daftplugAdminField_label -flex4"><?php esc_html_e('Background Color', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputColor -flexAuto">
                            <input type="text" name="pwaPullDownNavigationBgColor" id="pwaPullDownNavigationBgColor" class="daftplugAdminInputColor_field" value="<?php echo daftplugInstantify::getSetting('pwaPullDownNavigationBgColor'); ?>" data-placeholder="<?php esc_html_e('Background Color', $this->textDomain); ?>" required>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="daftplugAdminFieldset">
                	<h4 class="daftplugAdminFieldset_title"><?php esc_html_e('Swipe Navigation', $this->textDomain); ?></h4>
                    <p class="daftplugAdminFieldset_description"><?php esc_html_e('Swipe Navigation allows your users to execute web browser\'s "Back" and "Next" actions by simple swiping on the screen anywhere on the website. Swiping left will result in going back and swiping right will result in going next.', $this->textDomain); ?></p>
                    <div class="daftplugAdminField">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Enable or disable swipe navigation touchscreen gesture.', $this->textDomain); ?></p>
                        <label for="pwaSwipeNavigation" class="daftplugAdminField_label -flex4"><?php esc_html_e('Swipe Navigation', $this->textDomain); ?></label>
                        <label class="daftplugAdminInputCheckbox -flexAuto">
                            <input type="checkbox" name="pwaSwipeNavigation" id="pwaSwipeNavigation" class="daftplugAdminInputCheckbox_field" <?php checked(daftplugInstantify::getSetting('pwaSwipeNavigation'), 'on'); ?>>
                        </label>
                    </div>
                </fieldset>
                <fieldset class="daftplugAdminFieldset">
                	<h4 class="daftplugAdminFieldset_title"><?php esc_html_e('Shake To Refresh', $this->textDomain); ?></h4>
                    <p class="daftplugAdminFieldset_description"><?php esc_html_e('Shake to refresh gesture brings amazing UX experience to your users by simply shaking phone as a signal to your web application to refresh the contents of the screen.', $this->textDomain); ?></p>
                    <div class="daftplugAdminField">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Enable or disable shake to refresh gesture.', $this->textDomain); ?></p>
                        <label for="pwaShakeToRefresh" class="daftplugAdminField_label -flex4"><?php esc_html_e('Shake To Refresh', $this->textDomain); ?></label>
                        <label class="daftplugAdminInputCheckbox -flexAuto">
                            <input type="checkbox" name="pwaShakeToRefresh" id="pwaShakeToRefresh" class="daftplugAdminInputCheckbox_field" <?php checked(daftplugInstantify::getSetting('pwaShakeToRefresh'), 'on'); ?>>
                        </label>
                    </div>
                </fieldset>
                <fieldset class="daftplugAdminFieldset">
                	<h4 class="daftplugAdminFieldset_title"><?php esc_html_e('Preloader', $this->textDomain); ?></h4>
                    <p class="daftplugAdminFieldset_description"><?php esc_html_e('Preloader feature gives you ability to show a nice loader animation between page loadings. Loader appears at the start of page load and disappears after it is fully loaded.', $this->textDomain); ?></p>
                    <div class="daftplugAdminField">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Enable or disable preloader for your web app.', $this->textDomain); ?></p>
                        <label for="pwaPreloader" class="daftplugAdminField_label -flex4"><?php esc_html_e('Preloader', $this->textDomain); ?></label>
                        <label class="daftplugAdminInputCheckbox -flexAuto">
                            <input type="checkbox" name="pwaPreloader" id="pwaPreloader" class="daftplugAdminInputCheckbox_field" <?php checked(daftplugInstantify::getSetting('pwaPreloader'), 'on'); ?>>
                        </label>
                    </div>
                    <div class="daftplugAdminField -pwaPreloaderDependentDisableD">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Select the preloader style.', $this->textDomain); ?></p>
                        <label for="pwaPreloaderStyle" class="daftplugAdminField_label -flex4"><?php esc_html_e('Style', $this->textDomain); ?></label>
                        <div class="daftplugAdminInputSelect -flexAuto">
                            <select name="pwaPreloaderStyle" id="pwaPreloaderStyle" class="daftplugAdminInputSelect_field" data-placeholder="<?php esc_html_e('Style', $this->textDomain); ?>" autocomplete="off" required>
                                <option value="default" <?php selected(daftplugInstantify::getSetting('pwaPreloaderStyle'), 'default') ?>><?php esc_html_e('Default', $this->textDomain); ?></option>
                                <option value="skeleton" <?php selected(daftplugInstantify::getSetting('pwaPreloaderStyle'), 'skeleton') ?>><?php esc_html_e('Skeleton', $this->textDomain); ?></option>
                                <option value="spinner" <?php selected(daftplugInstantify::getSetting('pwaPreloaderStyle'), 'spinner') ?>><?php esc_html_e('Spinner', $this->textDomain); ?></option>
                                <option value="redirect" <?php selected(daftplugInstantify::getSetting('pwaPreloaderStyle'), 'redirect') ?>><?php esc_html_e('Redirect', $this->textDomain); ?></option>
                                <option value="percent" <?php selected(daftplugInstantify::getSetting('pwaPreloaderStyle'), 'percent') ?>><?php esc_html_e('Percent', $this->textDomain); ?></option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="daftplugAdminFieldset">
                	<h4 class="daftplugAdminFieldset_title"><?php esc_html_e('Toast Messages', $this->textDomain); ?></h4>
                    <p class="daftplugAdminFieldset_description"><?php esc_html_e('Toast Messages provide simple feedback about an operation in a small popup. It only fills the amount of space required for the message and the current activity remains visible and interactive. Toasts automatically disappear after a timeout.', $this->textDomain); ?></p>
                    <div class="daftplugAdminField">
                        <p class="daftplugAdminField_description"><?php esc_html_e('Enable or disable toast messages for your web app.', $this->textDomain); ?></p>
                        <label for="pwaToastMessages" class="daftplugAdminField_label -flex4"><?php esc_html_e('Toast Messages', $this->textDomain); ?></label>
                        <label class="daftplugAdminInputCheckbox -flexAuto">
                            <input type="checkbox" name="pwaToastMessages" id="pwaToastMessages" class="daftplugAdminInputCheckbox_field" <?php checked(daftplugInstantify::getSetting('pwaToastMessages'), 'on'); ?>>
                        </label>
                    </div>
                </fieldset>
                <div class="daftplugAdminSettings_submit">
                    <button type="submit" class="daftplugAdminButton -submit" data-submit="<?php esc_html_e('Save Settings', $this->textDomain); ?>" data-waiting="<?php esc_html_e('Waiting', $this->textDomain); ?>" data-submitted="<?php esc_html_e('Settings Saved', $this->textDomain); ?>" data-failed="<?php esc_html_e('Saving Failed', $this->textDomain); ?>"></button>
                </div>
            </form>
        </div>
    </div>
</div>
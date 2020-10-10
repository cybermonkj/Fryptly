<?php

if (!defined('ABSPATH')) exit;

$appIcon = (has_site_icon()) ? get_site_icon_url(150) : wp_get_attachment_image_src(daftplugInstantify::getSetting('pwaIcon'), array(150, 150))[0];
$message = daftplugInstantify::getSetting('pwaPushPromptMessage');
$dismiss = esc_html__('Dismiss', $this->textDomain);
$allow = esc_html__('Allow', $this->textDomain);

?>

<div class="daftplugPublicPushPrompt">
    <div class="daftplugPublicPushPrompt_content">
        <img class="daftplugPublicPushPrompt_icon" src="<?php echo $appIcon; ?>">
        <span class="daftplugPublicPushPrompt_msg"><?php echo $message; ?></span>
    </div>
    <div class="daftplugPublicPushPrompt_buttons">
        <div class="daftplugPublicPushPrompt_dismiss"><?php echo $dismiss; ?></div>
        <div class="daftplugPublicPushPrompt_allow"><?php echo $allow; ?></div>
    </div>
</div>
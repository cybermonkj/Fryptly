<?php

if (!defined('ABSPATH')) exit;

$bgColor = daftplugInstantify::getSetting('pwaNavigationTabBarBgColor');
$iconColor = daftplugInstantify::getSetting('pwaNavigationTabBarIconColor');
$iconActiveColor = daftplugInstantify::getSetting('pwaNavigationTabBarIconActiveColor');
$iconActiveBgColor = daftplugInstantify::getSetting('pwaNavigationTabBarIconActiveBgColor');
$iconStyle = daftplugInstantify::getSetting('pwaNavigationTabBarIconStyle');
$currentUrl = daftplugInstantify::getCurrentUrl();

?>

<nav class="daftplugPublicNavigationTabBar" style="background-color: <?php echo $bgColor; ?>;">
	<ul class="daftplugPublicNavigationTabBar_list">
	<?php
	for ($a = 1; $a <= 7; $a++) {
		$icon = daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sIcon', $a));
		$page = daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%sPage', $a));
		if (daftplugInstantify::getSetting(sprintf('pwaNavigationTabBarItem%s', $a)) == 'on') {
			if ($page == '*directSearch*') { ?>
                <li class="daftplugPublicNavigationTabBar_item -directSearch <?php echo '-'.$icon; if (is_search()) {echo ' -active';} ?>">
                    <div class="daftplugPublicNavigationTabBar_search">
                        <form role="search" method="get" action="<?php echo esc_url(home_url('/', 'https')); ?>" class="daftplugPublicNavigationTabBar_searchForm">
                            <input type="search" name="s" class="daftplugPublicNavigationTabBar_searchField" placeholder="<?php esc_html_e('Search for something...'); ?>" value="<?php echo get_search_query(); ?>" required>
                        </form>
                    </div>
                    <a class="daftplugPublicNavigationTabBar_link" href="javascript:void(0)" <?php if (is_search()) { echo 'style="background:'.$iconActiveBgColor.';"'; } ?>>
                        <img class="daftplugPublicNavigationTabBar_icon" src="<?php echo plugins_url('pwa/public/assets/img/icons-nav/'.$iconStyle.'/'.$icon.'.svg', $this->pluginFile)?>" alt="<?php echo $icon; ?>" style="fill: <?php echo $iconColor; ?>" onload="SVGInject(this)"/>
                    </a>
                </li>
            <?php } else { ?>
                <li class="daftplugPublicNavigationTabBar_item <?php echo '-'.$icon; if ($currentUrl == $page) {echo ' -active';} ?>">
                    <a class="daftplugPublicNavigationTabBar_link" href="<?php echo $page; ?>" <?php if ($currentUrl == $page) { echo 'style="background:'.$iconActiveBgColor.';"'; } ?>>
                        <?php if ($icon == 'cart') { echo '<span class="daftplugPublicNavigationTabBar_cartcount"></span>'; } ?>
                        <img class="daftplugPublicNavigationTabBar_icon" src="<?php echo plugins_url('pwa/public/assets/img/icons-nav/'.$iconStyle.'/'.$icon.'.svg', $this->pluginFile)?>" alt="<?php echo $icon; ?>" style="fill: <?php echo ($currentUrl == $page ? $iconActiveColor : $iconColor); ?>" onload="SVGInject(this)"/>
                    </a>
                </li>
			<?php }
		}
	}
	?>
	</ul>
</nav>
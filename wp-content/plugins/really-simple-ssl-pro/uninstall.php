<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

rsssl_delete_all_options(
  array(
		'rsssl_scan_type',
		'autoreplace_insecure_links_on_admin',
		'rsssl_pro_license_notice_dismissed',
		'rsssl_cert_expiration_warning',
		'rsssl_pro_license_expires',
		'rsssl_changed_files',
		'rsssl-pro-current-version',
		'rsssl_redirect_to_http_check',
		'rsssl_hsts_no_apache',
		'rsssl_csp_reporting_activation_time',
		'rsssl_feature_policy',
		'feature_policy_defaults_set',
		'rsssl_pro_csp_notice_next_steps_notice_dismissed',
		'rsssl_nginx_configuration',
		'rsssl_scan_active',
		'rsssl_show_ignore_urls',
		'rsssl_disable_bruteforce_dbsearch',
		'rsssl_iteration',
		'rsssl_progress',
		'rsssl_current_action',
		'rsssl_scan_completed_no_errors',
		'rsssl_last_scan_time',
		'rsssl_csp_report_token',
		'rsssl_csp_db_version',
    )
  );

function rsssl_delete_all_options($options) {
  foreach($options as $option_name) {
    delete_option( $option_name );
    // For site options in Multisite
    delete_site_option( $option_name );
  }
}

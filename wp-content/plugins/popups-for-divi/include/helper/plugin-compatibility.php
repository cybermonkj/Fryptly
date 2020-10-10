<?php
/**
 * Makes sure, that our plugin integrates nicely with other plugins.
 *
 * @package Popups_For_Divi
 */

defined( 'ABSPATH' ) || die();

// SG Optimizer.
add_filter(
	'sgo_javascript_combine_excluded_inline_content',
	'divi_popup_exclude_inline_content'
);

// WP Rocket.
add_filter(
	'rocket_excluded_inline_js_content',
	'divi_popup_exclude_inline_content'
);

/**
 * Instructs Caching plugins to NOT combine our loader script. Combined scripts are
 * moved to end of the document, which counteracts the entire purpose of the
 * loader...
 *
 * Used by SG Optimizer, WP Rocket
 *
 * @since 1.4.5
 * @param array $exclude_list Default exclude list.
 * @return array Extended exclude list.
 */
function divi_popup_exclude_inline_content( $exclude_list ) {
	$exclude_list[] = 'window.DiviPopupData=window.DiviAreaConfig=';

	return $exclude_list;
}

/**
 * Provides plugin compatibility with IE 11.
 *
 * @global $is_IE Boolean. True for all IE browsers.
 *
 * @since 2.0.1
 * @return void
 */
function divi_popup_ie_compat() {
	add_filter(
		'wp_enqueue_scripts',
		[ PFD_App::module( 'asset' ), 'enqueue_ie_scripts' ],
		1
	);
}

add_action( 'divi_popups_loaded', 'divi_popup_ie_compat' );

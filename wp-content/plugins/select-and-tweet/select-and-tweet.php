<?php
/*
Plugin Name: Select And Tweet
Plugin URI: http://www.danielpataki.com/
Description: This plugin allows users to select text and tweet it.
Version: 3.4.2
Author: Daniel Pataki
Author URI: http://www.danielpataki.com/
Text Domain: select-and-tweet
*/


function sat_enqueue_assets() {
    if ( is_single() ) {
	   wp_enqueue_style( 'select-and-tweet', plugins_url( '/select-and-tweet.css', __FILE__ ) );
        wp_enqueue_script( 'select-and-tweet', plugins_url( '/select-and-tweet.js', __FILE__ ), array( 'jquery' ), '1.0', true  );
    }
}

add_action( 'wp_enqueue_scripts', 'sat_enqueue_assets' );

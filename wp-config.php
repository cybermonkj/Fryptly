<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '1QDC7o4m1OeQpf' );
/** MySQL database username */
define( 'DB_USER', '1QDC7o4m1OeQpf' );
/** MySQL database password */
define( 'DB_PASSWORD', 'UARTcI4GotVnwM' );
/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'fZ)<ISba!}(H*{F,eCIT/BY?zsYbs&VF}*i.@,bG:DHre6<yF}o^JLbK!y<V#%on' );
define( 'SECURE_AUTH_KEY',   'tfJnbAR0U:8rV_J aO5E!su_ I>zjSN%3+.:5Xv8VIjh3W{$<AmCWG`8&/>6jrr$' );
define( 'LOGGED_IN_KEY',     '8+ch}&0`gN?v1-T}6T#{MnR{j$VIH4*Wt5*VSS(|fw|uj(}u@y3-i dp:?Oz>SC2' );
define( 'NONCE_KEY',         'OeYCo_zLiYADC;ZAv<%%{h]jP9ap*K+7y}6P,h#;;/X4(NBJDiVF>d^x<>E_=}^w' );
define( 'AUTH_SALT',         'XykEvPkcPa_<30HW:=n,(v2SmWY;WdNiVS(M4b)8n,G:G}ItG;1(R%zc?<~}0(+_' );
define( 'SECURE_AUTH_SALT',  'yNW-[gsdR!1u6]lPF59GuO[>I}`tAQ6|B[;rq3_V}45dx?IFT9:_/IvS)*E06]oY' );
define( 'LOGGED_IN_SALT',    'pz}wfJN/u.cmO*H:TIK~OTgP[jb)]kFAtr%>REBg,KHUH;`9sc?pu9lF.tCs.i2R' );
define( 'NONCE_SALT',        '=zm;#oZ+0I7T 9bVi3>!MK|+%IZvM?yfsl9=cGf)>WYT?#~N tsZ4t:]4f)=}Lr[' );
define( 'WP_CACHE_KEY_SALT', 'JMiKR?<BN/b{DW?cQRRm1U_fKa=h[YPEWWrt9#_}}8_Y&xXuQ7y%e]y*K~sD%H& ' );
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

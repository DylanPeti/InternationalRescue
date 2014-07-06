<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

/** $root = 'http://ir.site.gladeye.co'; */
$root = 'http://ir.fortylove.vleaf.co.nz';
define('WP_HOME', $root);
define('WP_SITEURL', $root);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'international_rescue');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'v;rla),LBN-CIN8x+(eX&Q_Dzs ~ ?$IDb-y@O70rEmBQ1@0%IPf2 {7`++!5ETR');
define('SECURE_AUTH_KEY',  'dP1r!Q>a$Y{._.JgO[a?=h`ggZo+CK|w1`|vo#_z+nNPB*--J!qRj|l=*N92=Ih9');
define('LOGGED_IN_KEY',    'Oo3 }f,|dRqbJnn-YKn0t76tXLbBYR}oK:s(:k]IEq>B)F)}@AuN_|H5@0}0L`)@');
define('NONCE_KEY',        '%2O?]Sn2DmKd`|V61}ZFwpGs%UG8ClHt=}yE[~fxtCM-Sj|feP^Jihb_WE$YM]!p');
define('AUTH_SALT',        '?I(I*w@+.=|O<mTlHHDa)25W37Fvo-JAriOm{.q53I9P=0;a,|%Fm4-6g_+^M^fb');
define('SECURE_AUTH_SALT', 'NyQlPLUt!QAcv3)LP IM%S6ik?fMEy8Ht89<r[MS6L4Kh8CSE[9}9uoEdy9YK+@F');
define('LOGGED_IN_SALT',   'Prm]lX{-D9MU%(^fcQTprtoBqFwLu{u_>Q6+Aar~IavETEFEPnKa><Z96}S{wJX/');
define('NONCE_SALT',       'xyz=6913iZFcM-6S-X+Y(WmqnAkwu&i5+6eH6-^3^2f#J80c7s*R%rOL4{QRW<HZ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'rael');

/** MySQL database username */
define('DB_USER', 'changeme');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '5e{x2_A^?u|KdA 0~=_e-)Z-G138ChSZ8*Hh+>Zpw=JC|%!:h=>0g|n:cboa{NEc');
define('SECURE_AUTH_KEY',  'PM8Dg893+d^g&Mlw|VhYiug~J5Z)q~nuidKg:}fR+ 8+aK-hM|{lGbO9Ev^j5/xn');
define('LOGGED_IN_KEY',    '1B2cT-P^@@]EM4fA1(*0<.MXn:WmBhM(ig(3s>o~_M2;+R+>{*XC1/GkZaevlzwb');
define('NONCE_KEY',        '2+*Fsgs~0g>4#n9X{ij&O#-HRlF(@oE+ -<&M*`(x3+39c$n4@^K+ 2sEn.qTd{P');
define('AUTH_SALT',        'w`U-B(7AHbGr:mGyqOo!P;IbH5eaaWVWT]pr#n;C+y_GqCqx><ue7W3k43t F9iu');
define('SECURE_AUTH_SALT', '6wwUz1Mf2/C9UXY<~55}IX.51h[ism~jGq7UPb u/QBMu:I5| %lO}l{XB]d(T.Z');
define('LOGGED_IN_SALT',   '5t.K4hr<Blwn-h>d6XV: >)[Hy|}AAtbD]}yKERwLFl:(@p=^$x<Zleb8>%(T,]+');
define('NONCE_SALT',       'Et].O!N?yQL]|R2v9vn.+qe5ZvS8s) xys,lfg3ZG[$L e=gw/l8xX@lT1>@/IhB');

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

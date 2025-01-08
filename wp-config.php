<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u244378464_tsHbw' );

/** Database username */
define( 'DB_USER', 'u244378464_42SXY' );

/** Database password */
define( 'DB_PASSWORD', 'GpnMIEHFYe' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '3P^&HA)!+) z$v*xXSV(;0oV3i<~RU|+-RnmJU~fWi$A~s`W3nZYeH?mHd9}Cz`P' );
define( 'SECURE_AUTH_KEY',   'X^;T&+/&1eEHZpc0y5YJhA1A#c$$d)zp9F*cbuXD92O}itYUBU`Gr#=FhDlUjm 5' );
define( 'LOGGED_IN_KEY',     'zCyo.iKl[*aR#KACZQBy3[0qYUOV|%k?fD4ZmHlV~`xoU]XBw93[-7d!^)J?k5d5' );
define( 'NONCE_KEY',         'rn_ccyNBcm&.5(7dyLupnaU=om]}k6O)i]KW)&X0n`NC2x;a~[$kq6{H=Cc3S{<Z' );
define( 'AUTH_SALT',         '[5Eg?Md(xCRcMsE(frJ%5bL8.wOEXftxkEg]lgIL74$RFA*jTrbLA}kJ: m?<b+*' );
define( 'SECURE_AUTH_SALT',  '4[2.Q[eoE(5d+6*a- EtAy.wp|VX#p:NE/sKh,[[1Y;; Y6A5|Qi3d<AU<](4LwN' );
define( 'LOGGED_IN_SALT',    'x&5NZ0FCA*Jk)m1r87On:=jti%UAe0aM!b|Rzu1UK&Ot5, HS:/=LA,0zsT$Ao/B' );
define( 'NONCE_SALT',        '{3@w(9aBb$[NZT-@i+)_N3}&c>JjE~Qh^puQV$~{zZ2SV/i$O9uln%UN0UvL.I=k' );
define( 'WP_CACHE_KEY_SALT', 'Aw.}`q4.vih]zD]ATAB`/8se?m{F__$_6?QqB]G>y^O0NUSXvd5+d-_WLeS.[0_#' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', 'ffbfaf6d56d5cbf03581bf346fdaa33e' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

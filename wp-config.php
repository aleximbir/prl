<?php
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
define('DB_NAME', 'aleximbi_test');

/** MySQL database username */
define('DB_USER', 'aleximbi_test');

/** MySQL database password */
define('DB_PASSWORD', 'mV0;f*5=_l3v');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '/O3=`_p<?LQT8a{01[BZIuA:a&5wnx9W9{3/n<MPsTWB[Yw&su(U@&Pa!Fd^pB-M');
define('SECURE_AUTH_KEY',  'TFJviQKYdDU>[aSb8M$HJiqMGS|Ca;K} HU()vL-><UTFJXN{;*Pz[DKNGT56`T?');
define('LOGGED_IN_KEY',    'rXG>d =5GK}KB0%82p]M[G5`ZUP}b|NJ$c=rBeX4R?*L>1#tUE%OOw u~ &kv<v<');
define('NONCE_KEY',        'H?gK}#=2{T-~*q Z%mPcH0dkwobB!u{2^P^11Y<`h&/HAZPyQN3&,U0:3lhZe:GF');
define('AUTH_SALT',        'L[FH<RBxd_!{YFCrF)5nH`joEMu+PX/4N{=sG{Fc1|%$wN.!(;^q#5yw[zi# #&K');
define('SECURE_AUTH_SALT', 'Vs6ZYEnRHev`A`Ba^F{-v2!x^asLYdy=R0vL:EgAZ9Sdu`Ka0+Os_0_k&!rS[D%{');
define('LOGGED_IN_SALT',   'B{w$=$Bh)Ak0+4yQ=dT;kX->ub5g#fI*_!n:o_Z(i:q/ E)uOA,50a_L[JRePc)3');
define('NONCE_SALT',       'iR/HWec`6Iv=}}A5Ll.iPN_/ilE.F/COOV:q%[]fOSSAtjcU~Ga~[w@BtbaQ+qF_');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tst_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

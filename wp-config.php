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
define('DB_NAME', 'aleximbi_prl');

/** MySQL database username */
define('DB_USER', 'aleximbi_prl');

/** MySQL database password */
define('DB_PASSWORD', ',!d~46L^C=b5');

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
define('AUTH_KEY',         'M[HWkc_Z-2[}W*bv2GS,XY{wgTf<W`hjR|36L}R2^2;/c1&oM(X&[Hw_e+[b]hEt');
define('SECURE_AUTH_KEY',  ' m>Vn.nT+cS_!0zR<Tm6,%&PM%aL-80nGF66%+?Ah5u>F}ydMFF`QeF+_[ *Kr]e');
define('LOGGED_IN_KEY',    '/khd$?Zx$KV-!4$M})J,7~eFtyMR~+T{:%6h@)@R+n*(e8f?oq=:_Y7X3lQRC7wT');
define('NONCE_KEY',        'K oqnd{ P+y}|P!H[NU:8umB*8UXH_pJ~D2fhuhDg6qet6e<Q9ha=kL!U=D!T%dV');
define('AUTH_SALT',        '!0]gl{l,w7vvxXq)#W|ao;{gqZ:/H[-;_gZNog~dy&@*d6&2@YwF2S-MTZ$4KQy3');
define('SECURE_AUTH_SALT', 'ocJ}*/43IvpF^s<|kjoNKPk:maMHWJUxfi_#GIknOTR&goIQkO^OP-d|aoG[*1@A');
define('LOGGED_IN_SALT',   '#vItmw;EG ]*j90o#4!hz5r_&j,olS/2Y7X&B]yviv^a$J2W[YZb.QC1)->cK&cC');
define('NONCE_SALT',       'US2/hi=|@rAO(Hpl:GlGjK9J|i4)X|a?/&L~FQy)[ianJ_Y56wH?_}2_rYh>G+[C');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'prl_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

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
define('DB_NAME', 'pymftsyw_fmvilas');

/** MySQL database username */
define('DB_USER', 'pymftsyw');

/** MySQL database password */
define('DB_PASSWORD', 'matemumo');

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
define('AUTH_KEY',         '~lj DCs%|SR8^+o{IEf~>sKXNUS>uuP?sO_QV=&[.eb6E1Zn5h5- .mo:o3^G}dV');
define('SECURE_AUTH_KEY',  'X~6f,Ez|F1LKplJI`!v*l@ E}6tkx![=#$zaJoq`t,DYcWB|aA5!*/6|%61/p=s|');
define('LOGGED_IN_KEY',    ' .+JuIu=f=SwO}}32cJ@S4?t{<i=,;c^*lzU6DG;K>qV=p{S|zySncxuq+]VdJq_');
define('NONCE_KEY',        '=Zbi|c4D@gx.df?*gscWgj=2_q0n#%/}dY!v$O;&{?Meb:<Nm7}UE~CjTdG8dP=[');
define('AUTH_SALT',        '2FBL}3a sAf+T?0M?4~BhE3tO=m5ud$L&Iwry`W13T]~XA0=cjAYIGqia9cG5K.3');
define('SECURE_AUTH_SALT', ')IHo~*1X-#Zlsm92dkUl`=4jv%PEbw/71~Hgq;O-K,m/:}p_@?UAFDQUuzdzJU:~');
define('LOGGED_IN_SALT',   'xiJ[|9fuV3g4-&i8=Ha{GaJ<e>U2]+$1Xbz[6C:y*z*.GpbGLW<}U,NFR)4HIJKJ');
define('NONCE_SALT',       '6p8iz%1!R{*sq<aj+A%~iaoN~~*A5a0cQA_i32>LXS3;l]xe7n,KZP+%81{aN[NT');

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

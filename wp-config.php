<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'epiz_29962004_contours606');

/** MySQL database username */
define('DB_USER', 'epiz_29962004');

/** MySQL database password */
define('DB_PASSWORD', 'xkfVKx1ZphGn');

/** MySQL hostname */
define('DB_HOST', 'sql110.epizy.com');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         ':&hKRZ1e%,k8Jb+b3xsTESf*9v&MOEeaV%4klZXS]*%H+DiY$~&67bQdp=08Swgp');
define('SECURE_AUTH_KEY',  '~DPz i0NbR $u|(9{OA.{z5.n{V[s]uwZlaxB{+j@_%=pjR%/DDC]E$<r_yJI1c)');
define('LOGGED_IN_KEY',    'eo%C<;DxTXDA|C4&lTupO#mAx|zb[gp+;x9ikgjAEJGSiBiSdT!useNo)Tc#j*}>');
define('NONCE_KEY',        'UMj+qRctS)Ylyu$ :i<JEj&jw%N9^k=qIn#68EVG(h?g`KEOVKq(=codsH+>WFx}');
define('AUTH_SALT',        's%ntV>-&?2r?2ZpVpF+P{,HPq$rt<F>7p#X=||bw&kCXU|D8L|lKPGw+8_^Ieh[E');
define('SECURE_AUTH_SALT', 'pbeU4F*iuyyYuiH JL~(9dmgS5v0ox={:+4LKS%A;30`]qM.JxTj$<~4](q#uEyZ');
define('LOGGED_IN_SALT',   '}J-QVpl0rHNhTfv8<RAU2pQ+MP+tI`?B|]uvYuJo_PKgh`4J3/oJfhXPQfg[{#0,');
define('NONCE_SALT',       'PcZ#LXY_Pq9Ei~[XC_?nw[byxj[uZ0^k8y5}H__:TCf`SQ9!qBu8T-?ZAN.vGwXG');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

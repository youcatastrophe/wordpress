<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_test');

/** MySQL database username */
define('DB_USER', 'user_wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'password');

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
define('AUTH_KEY',         'PK})a3z1(9y]h2K:<v*iLSsJ_Iib^uP`g-om34GV53c{H/]nmvRqQG@n RJ:}|`u');
define('SECURE_AUTH_KEY',  'R41.yLL6aUOz1R(G[3A&T60/-TQR,g^,K2pMPuFtC+9gz9)pnSw$#(.VL<X]hkZs');
define('LOGGED_IN_KEY',    'KUln!i&Z0!S<0R=$Kgn@7k%`V@oK*X)mNWvG;xm9t2~%c>PbAC4LPo7Cbb{2L%V4');
define('NONCE_KEY',        '.+2a3WR{7::Z:/_z`Z1I=|W#m_!%&.#M&Uf~b7Pm=m`3S2.@:b[=Pj#O-g_CccWu');
define('AUTH_SALT',        'M.seb?f#&j~Q`m;of-^-WB=Ev_m5-Vta$Y1}slw3&{8 ;y^A3WfZOxeOY:Dk#D:;');
define('SECURE_AUTH_SALT', 'BBd<romhoLN4PU]J3tFY<gx?Vo[&deK8,&^n{Q>3OX!@_dV;!;y]cs]lb Jk%5ZV');
define('LOGGED_IN_SALT',   ']H?2nk$I.wEf2c-L`j&s-V %25ou+<NlBLA$FX{{XEqW:-F*]G^eRyl/iv9PJBjY');
define('NONCE_SALT',       '?]1OB@p)%~v _#1mwV3Lj@2eH~jJQU=P<Jm7;Ia_5^$Xf<69P*3{4i`Q0;Ek`fxY');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

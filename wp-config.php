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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'navmenu' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'IY[&od5Q-2>0h`8lK;GDEeMCj#g=io~3k;3 R^_hPsd[AfKhU.rK_E}vlMF95ixj' );
define( 'SECURE_AUTH_KEY',  '8Ll4GJW&sIb^gV],`r4IJ~vJ9E:*=mxe7~r#]j~~@}hGKAGv4rOA~8Vx+~:hbuQC' );
define( 'LOGGED_IN_KEY',    'm_I?S>!W2&vmZqvMuL9-5.5@-K^P* uf{J ZvJr]7nr{g|uboehRD9kB]}Qi*dI1' );
define( 'NONCE_KEY',        ']Cq^k*HSYis.{p_?1PZLG}|/WVu1fG8x;oFZWE=9=2&~CjEDMjk/{R#4T]C+jAQ%' );
define( 'AUTH_SALT',        '8m &NS6uA%{=poQxjLTdet,$Jp?uC/j M]-~9C&H#BI?t`:Aow]$!Gk<640ZbA>9' );
define( 'SECURE_AUTH_SALT', 'Brl9l`0XLWfsM:6f5NLZfP=YL/<hkU,P}g[P.o=I{h+:-,drlLY1}rx4l*p,a&]#' );
define( 'LOGGED_IN_SALT',   ')c6,1vm<]52WGB/j#vA5p`014K!b3^u ?{[_N4^mNtFD-Y@S 5>vf |Nrc^;{Kr#' );
define( 'NONCE_SALT',       'cwP&v7_qZ&@$qc71|wL/|i&n1Ba-`F[qYV=tz73Na<?RYWEpP`$`)| &x{w-;~iw' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

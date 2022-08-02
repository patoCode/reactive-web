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
define( 'DB_NAME', 'wp03' );

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
define( 'AUTH_KEY',         '5zD8d)~0B+GY8$y$s8rhW:m%nw[]G_8V2KGIz=[`vkT* _q7w^aVJNuR{LdPfdc;' );
define( 'SECURE_AUTH_KEY',  'E<lDrMy4pF*lN-iTxsBIt_8@$-A^I>r*xVyU>/A}jQhQ}O/Yf/tdf;;A/-dZCM@d' );
define( 'LOGGED_IN_KEY',    'IsQq1daOSE=v)&o@yvN6m&nd&Tp9N,LnbfL%`E|j@wDmn8N|%/mu5}W~59(tF.p[' );
define( 'NONCE_KEY',        'KJ*Z^M%>j}@0r$Tww^$1[F_3~9bF`uY5I/ *{#wu@}_*i` /<?p_<^%`sxC.gM~(' );
define( 'AUTH_SALT',        '@;$2:E_`kqn,= KvYy`@4q=F]=KYoLmA5JMY)YvA)UxGMi6:s:#OrAf;ul,IqaED' );
define( 'SECURE_AUTH_SALT', '!dGPE93)XI_9,kjEuuY{!I<f$mce HIbz{WTEv=0Vl:`{.K.h0i_*FzWC_hJ`x`e' );
define( 'LOGGED_IN_SALT',   'AT2&v[CSIV9Y4S%#~Cz!Xd|I>|N{>9{`:FSo>[M{jQ,@k!H<o0il8^uSJRV2D:=_' );
define( 'NONCE_SALT',       '3HgwQMWS j`_F~ozNyISuCtoDE#$-b><Q2<8X<+E{y?0532@4jVn@A_OgF?>)4;&' );

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

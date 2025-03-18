<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_peach_db1' );

/** Database username */
define( 'DB_USER', 'wp_peach_1' );

/** Database password */
define( 'DB_PASSWORD', 'hJLre9xBs7pD4RmN' );

/** Database hostname */
define( 'DB_HOST', 'sql704.your-server.de' );

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
define( 'AUTH_KEY',         'RxE0M/JsVKy8PNNnwf3ypSnFWdaxxmXxsPv.xKnkkSg.QHF6HqnhPuFJG2WJl2tS' );
define( 'SECURE_AUTH_KEY',  'wg6mad4be5/HOqphP0p92.iR3ndMbzKtZaVMDx.bEWfYrHaqwcWj7QhAMeQHX4ET' );
define( 'LOGGED_IN_KEY',    'ZYtflMkjDeHNvikPsbw5WPyYexu.xEpoRtj6HcENyJ71r1Jbs1QPtB8wMI9WboaA' );
define( 'NONCE_KEY',        'VoWkedVf9kgzO7C5kJgMP0VBVLs3jLkLR0Yy46H/dvNlJIoUIAtYl17uIxTpDegj' );
define( 'AUTH_SALT',        'NffdIy.KbvSQNJQDEVimSaL0GyjXlO/kh1rLjF1wS2uN/3E30aEKsXJFmuXcLM2w' );
define( 'SECURE_AUTH_SALT', 'gm20.eNQGjC/knt6XhKkN3J.DBE1mLnfHo8oYNihVJh6MCEDVfrp1GSAvzzolPrz' );
define( 'LOGGED_IN_SALT',   'WTGr261twJCklOlFSF63TEjvcXrsiRfvMP1vJjTBlgpsU1wepUGDBKxMOt1/SKAZ' );
define( 'NONCE_SALT',       '1q.zOKs3jyMbdSJJEoX7Wpu39j/EjCr28ScIRr1GfiD4.OdeNeW86xXuCvomN9Fx' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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

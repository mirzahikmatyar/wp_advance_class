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
define( 'DB_NAME', 'u1593074_wp733' );

/** Database username */
define( 'DB_USER', 'u1593074_wp733' );

/** Database password */
define( 'DB_PASSWORD', '!Spl68F19.' );

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
define( 'AUTH_KEY',         'snztmxquwm5msy0vtzupwvq8asphotvymdnoeqls2v8cgrf2fkjylbwiaf2yxedz' );
define( 'SECURE_AUTH_KEY',  '9rc9tkim8gya4q9k3zidxxp1i6aufmemmuuvzpefypj5vayn9k9tqicj9ukcoafq' );
define( 'LOGGED_IN_KEY',    'y3hgmj9hk1f9v6dk1zwiwosxjnfvcf75hz0inm5m665axt4kjsdhfxvlslhouat1' );
define( 'NONCE_KEY',        '8xx89xclnaasw6usjzwirpwlicanhvtbcrzi2fyzsqhdqmbwefgsumyea9vpvye3' );
define( 'AUTH_SALT',        'r9bwvaykq5t5uduu7jsqfd2ick9tlj0hsczlvvomnxeeisu7le8e52o4dpgjajbs' );
define( 'SECURE_AUTH_SALT', '77ne4zhgsj2k1mxt45algdu2ixedjdlvvlxkzyxyretuotjlxw9vln06dakcde41' );
define( 'LOGGED_IN_SALT',   'ya8j7hgexup7eycg9tkg5wquugcbmsezlvqmzj0pn1bidciavtlkbuk7g4tfzmyp' );
define( 'NONCE_SALT',       'wrizy5k9dzhhvtebwvazfcg8jn9eqyzoswwqcykpmwfbvhvpubqsct2oululra7r' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wplm_';

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
define( 'WP_DEBUG', true );
define( 'WP_DISABLE_FATAL_ERROR_HANDLER', false );
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

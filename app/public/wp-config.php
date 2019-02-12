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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'R6c1WAZbalGGN/tHrF75htMSSTDDzqpk1Tp3nmMLnDXVj7yC36KN3jx6P3/zr0qbbex5n/B+8ta8Kv9wnEIV8A==');
define('SECURE_AUTH_KEY',  '4bG6zd2pV/PN/hAYGKjX0cBtpIZi0OweOvTx9qpEWwgri0w65L34qnZWqkPGvi1DOqB9lhXikobgfRoFbqOsvQ==');
define('LOGGED_IN_KEY',    'CvencXew212zbvG4ykRPOCXIdu1CugQrYdVNJSsn4IxBsxKDxSC68ASfiEzN2+tMUbYFuNzrVYNTomdyDeqXnA==');
define('NONCE_KEY',        'nljSwEvxhjVrv5eipC7FeQeU3oLsMuaU9K/FB840KElkzuwNjAmGqvm7a3259UYSUQeSpHOUwlDiFT9qgyQ6Kw==');
define('AUTH_SALT',        'NJeHKFDc5Za0p0Mm7zlYO/7oNmW0Q1BZtfgR1Mvf+cz6WdvbLeosvybTfaNW/k6axz9qUIPl4ylCMgcvHKjgtA==');
define('SECURE_AUTH_SALT', 'BoVUryPCTaWoRMc5B+jYXYuaELOSnInxZ8M9vNWMjsnMYhvEBD4+YVIjM/kC6r3YcCMa72AYN2WoU0+3TjDZmw==');
define('LOGGED_IN_SALT',   'gZ/yq2p7TpSAk6ya+5O2pHyXf0a2aHTtRPp2sb87V0yvknIE2i8J27la3m9ZaDJzGIf73AlEnTbPL0vatq7WrQ==');
define('NONCE_SALT',       'CVxD2/YRq4gVh4OQQBV1TsrXExuqQfuMN5IVbyeVNZWZO/UlFn/lInL6SWO5oY8peUvHtKut0lBBxEsDy+NSzg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

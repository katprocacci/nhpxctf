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
if(file_exists(dirname(__FILE__) . '/local.php')) {
	// local database settings
	define( 'DB_NAME', 'local' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', 'root' );
	define( 'DB_HOST', 'localhost' );
} else {
	// live database settings
	define( 'DB_NAME', 'kather94_teamdata' );
	define( 'DB_USER', 'kather94_wp235' );
	define( 'DB_PASSWORD', 'sally246' );
	define( 'DB_HOST', 'localhost' );
}

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
define('AUTH_KEY',         '_+Jm?sFedEn~&|LMj;ZYD2I ,bR7}r>T`Z:>NvFOE_o`+tS:n8@2]Pwi`qz;|A6l');
define('SECURE_AUTH_KEY',  '[Z9X)f7IYzxb{mqZ]{f:4@C(_]g@2j/Zd, #uE]~Q~%{aVI %d_?eRxU.$F<;&G ');
define('LOGGED_IN_KEY',    'YNkx]HK_qP}C?B)++r|AJ1&b6I8+=zp*u?6_+:-hS(1wFf) e>$iaP}bLoDL;5K}');
define('NONCE_KEY',        'Y@HU68!k<Jnb+ $/|~|5Vu-_LRyDS,(|i.rPK182H+w+.k)sIQ}~EM,mx%P jr{T');
define('AUTH_SALT',        'z#QLiF*e}g+ra*^c1R6s(THAxJyf++#L(x&WN<o=9_Go*GQWSv`W[h).p;Gn%dHP');
define('SECURE_AUTH_SALT', 'm~JKs@rS/3irX.9@2nrX9di?0|<Lrl|9M&SxX9BaJx>8=odT!!ITZY9o-_]<2a$a');
define('LOGGED_IN_SALT',   'B+q-S+>tYgA`XIl{s,.Q4La6BiM!>%!+IYxTj|(]-0G<bz=Qgak>>+pu*i7D!:W ');
define('NONCE_SALT',       '.@M~&Q<<$:YhM5nUysSfSr|G+cB!:@uuEKxJe).+h|/1#w;c]^Hu+~~0=?/)Txi]');

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

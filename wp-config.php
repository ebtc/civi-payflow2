<?php
/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
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
define('DB_NAME', 'civi_paul');

/** MySQL database username */
define('DB_USER', 'civi_paul');

/** MySQL database password */
define('DB_PASSWORD', 'MxHLyc5vcXb9m5uixAu8Cu6sFVqY5F');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'lIG!NcWWRhaoC!ltqBId2m$^4m3n$e&uDo0)c0#t2K47Aga&jkHtn@DUnO)yQowf');
define('SECURE_AUTH_KEY',  'lPvHu%1JSt8@gblVGSnMZ8rTh!XxK5sU6jtZ4yeEmvdecAG5Ogd%EFyT(p*$LqP^');
define('LOGGED_IN_KEY',    'kBdQ3A5lGPsyhtFCGMClP4IurDgsMmjB76R6hKdf07)4nKuS%fkV2vADzi5PMLc2');
define('NONCE_KEY',        'uu0TTRUnlbap5aZa2hBswYm%AaHXDoLpywM6^VcuC4gS@qddCapsVh^tISlmOhfQ');
define('AUTH_SALT',        'B#ErqmNGR!%nn9%^#J9@SC3)tf$NbTwD#Ij7jdpj(!9eg#ACCINS*CS&7t4b6*Jq');
define('SECURE_AUTH_SALT', '!WFb^XTebq&dS6f6*3S0qp4E3$g3rTGwnkU!s#5CbI4zk^rJ0iGuTS^)F&tA(Blg');
define('LOGGED_IN_SALT',   'pG$mpxR3olPz%q$7*e&a!*a%@w7xPqA9Dszai%sCS!2uFWxEBjl91wJH^!2Lo1V%');
define('NONCE_SALT',       'HHF@kfXKQyp!&e1AqVyCKXdTEIxs(4urNBY%S%QV3pBdRK*LoT)z4L1^w11Xc(Jb');
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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'en_US');

define ('FS_METHOD', 'direct');

define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

?>

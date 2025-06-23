<?php
// Minimal configuration for WordPress test suite.
define( 'DB_NAME', 'wordpress_tests' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

define( 'WP_TESTS_DOMAIN', 'example.org' );
define( 'WP_TESTS_EMAIL', 'admin@example.org' );
define( 'WP_TESTS_TITLE', 'WordPress Test' );
define( 'WP_PHP_BINARY', 'php' );

define( 'WP_DEBUG', true );

$table_prefix = 'wptests_';

// Define ABSPATH for test runs if not already defined.
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . '/wordpress/' );
}

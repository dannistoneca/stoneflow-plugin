<?php
/**
 * PHPUnit bootstrap for StoneFlow.
 */

$tests_dir = getenv( 'WP_TESTS_DIR' );              // set by CI

// Fallback to the vendor copy when running locally.
if ( ! $tests_dir ) {
    // path: <repo-root>/vendor/wp-phpunit/wp-phpunit/includes
    $tests_dir = dirname( __DIR__ ) . '/vendor/wp-phpunit/wp-phpunit/includes';
}

require_once $tests_dir . '/functions.php';

tests_add_filter(
    'muplugins_loaded',
    static function () {
        require dirname( __DIR__ ) . '/stoneflow.php';
    }
);

// Load the WordPress testing environment.
require $tests_dir . '/bootstrap.php';

<?php
/**
 * PHPUnit bootstrap for StoneFlow.
 */

$tests_dir = getenv( 'WP_TESTS_DIR' );              // set by CI workflow

// Fallback to the vendor copy if the env var isn’t set.
if ( ! $tests_dir ) {
    $tests_dir = __DIR__ . '/../vendor/wp-phpunit/wp-phpunit/includes';
}

require_once $tests_dir . '/functions.php';

tests_add_filter(
    'muplugins_loaded',
    function () {
        require dirname( __DIR__ ) . '/stoneflow.php';
    }
);

require $tests_dir . '/bootstrap.php';

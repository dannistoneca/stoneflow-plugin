<?php
$_tests_dir = getenv( 'WP_TESTS_DIR' ) ?: '/tmp/wordpress-tests-lib';
require_once $_tests_dir . '/includes/functions.php';

tests_add_filter(
	'muplugins_loaded',
	function () {
		require dirname( __DIR__ ) . '/stoneflow/stoneflow.php';
	}
);

require $_tests_dir . '/includes/bootstrap.php';

$tests_dir = getenv( 'WP_TESTS_DIR' );

// Fallback to vendor copy
if ( ! $tests_dir ) {
    $tests_dir = __DIR__ . '/../vendor/wp-phpunit/wp-phpunit/includes';
}
require_once $tests_dir . '/functions.php';

/* ... rest unchanged ... */


<?php
/**
 * PHPUnit bootstrap for StoneFlow.
 *
 * Loads the WordPress test library from WP_TESTS_DIR when it’s available
 * (GitHub Actions), otherwise from the vendor copy installed via
 * `composer require --dev wp-phpunit/wp-phpunit`.
 */

// ─────────────────────────────────────────────────────────────
// 1. Locate the WordPress test library
// ─────────────────────────────────────────────────────────────
$tests_dir = getenv( 'WP_TESTS_DIR' );          // set by CI

// Fallback to the vendor copy when running locally.
if ( ! $tests_dir ) {
	$tests_dir = dirname( __DIR__ ) . '/vendor/wp-phpunit/wp-phpunit/includes';
}

// Bail out early if the functions file is missing.
if ( ! file_exists( $tests_dir . '/functions.php' ) ) {
	fwrite(
		STDERR,
		"Error: WordPress test library not found at $tests_dir.\n" .
		"Run composer install or check the path in tests/bootstrap.php.\n"
	);
	exit( 1 );
}


// ─────────────────────────────────────────────────────────────
// 2. Bootstrap WordPress for testing
// ─────────────────────────────────────────────────────────────
require_once $tests_dir . '/functions.php';

tests_add_filter(
	'muplugins_loaded',
	static function () {
		require dirname( __DIR__ ) . '/stoneflow.php';
	}
);

require $tests_dir . '/bootstrap.php';

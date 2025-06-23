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
$tests_dir = getenv( 'WP_TESTS_DIR' );   // CI sets this

if ( ! $tests_dir ) {
	$tests_dir = dirname( __DIR__ ) . '/vendor/wp-phpunit/wp-phpunit/includes';
}

// Bail early if it’s still not there.
if ( ! file_exists( $tests_dir . '/functions.php' ) ) {
	fwrite(
		STDERR,
		"Error: WordPress test library not found.\n" .
		"• CI: action should set WP_TESTS_DIR\n" .
		"• Local: run  composer install --no-interaction --prefer-dist\n"
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

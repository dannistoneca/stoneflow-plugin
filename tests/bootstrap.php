<?php
/**
 * PHPUnit bootstrap for StoneFlow.
 */

$tests_dir = getenv( 'WP_TESTS_DIR' );            // set by CI

// Fallback to the vendor copy when running locally.
if ( ! $tests_dir ) {
	$tests_dir = dirname( __DIR__ ) . '/vendor/wp-phpunit/wp-phpunit/includes';
}

echo "DEBUG  testing path: {$tests_dir}/functions.php\n";
echo "DEBUG  file_exists(): " . ( file_exists( $tests_dir . '/functions.php' ) ? 'yes' : 'no' ) . "\n";

// Bail out if it still isn’t there.
if ( ! file_exists( $tests_dir . '/functions.php' ) ) {
	fwrite( STDERR,
		"Error: WordPress test library not found at $tests_dir.\n".
		"Run composer install or fix the path in tests/bootstrap.php.\n"
	);
	exit( 1 );
}

require_once $tests_dir . '/functions.php';

tests_add_filter(
	'muplugins_loaded',
	static function () {
		require dirname( __DIR__ ) . '/stoneflow.php';
	}
);

require $tests_dir . '/bootstrap.php';

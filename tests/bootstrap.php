<?php
/**
 * PHPUnit bootstrap for StoneFlow.
 */
echo "BOOTSTRAP   Loaded " . __FILE__ . PHP_EOL;

// Require Composer autoloader for dev dependencies (e.g., PHPUnit Polyfills).
$autoload = dirname(__DIR__) . '/vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
} else {
    fwrite(STDERR,
        "Error: Composer autoload not found at $autoload.\n".
        "Run composer install to install dependencies.\n"
    );
    exit(1);
}

$tests_dir = getenv('WP_TESTS_DIR'); // set by CI

// Fallback to the vendor copy when running locally.
if (!$tests_dir) {
    $tests_dir = dirname(__DIR__) . '/vendor/wp-phpunit/wp-phpunit/includes';
}

echo "DEBUG  testing path: {$tests_dir}/functions.php\n";
echo "DEBUG  file_exists(): " . (file_exists($tests_dir . '/functions.php') ? 'yes' : 'no') . "\n";

// Bail out if it still isn’t there.
if (!file_exists($tests_dir . '/functions.php')) {
    fwrite(STDERR,
        "Error: WordPress test library not found at $tests_dir.\n".
        "Run composer install or fix the path in tests/bootstrap.php.\n"
    );
    exit(1);
}

// Define required constants for the WordPress test suite before loading the
// WordPress testing library.
define( 'WP_TESTS_DOMAIN', 'example.org' );
define( 'WP_TESTS_EMAIL', 'admin@example.org' );
define( 'WP_TESTS_TITLE', 'Test Blog' );
define( 'WP_PHP_BINARY', PHP_BINARY );

require_once $tests_dir . '/functions.php';

tests_add_filter(
    'muplugins_loaded',
    static function () {
        require dirname(__DIR__) . '/stoneflow.php';
    }
);

require $tests_dir . '/bootstrap.php';

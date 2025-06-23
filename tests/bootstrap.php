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

// Base directory of the WordPress test library.
$tests_dir = getenv('WP_TESTS_DIR'); // Set by CI.

// Fallback to the vendor copy when running locally.
if (! $tests_dir) {
    $tests_dir = dirname(__DIR__) . '/vendor/wp-phpunit/wp-phpunit';
}

// WordPress test library lives in the `includes` directory.
$includes = $tests_dir . '/includes';

echo "DEBUG  testing path: {$includes}/functions.php\n";
echo "DEBUG  file_exists(): " . (file_exists($includes . '/functions.php') ? 'yes' : 'no') . "\n";

// Bail out if it still isn’t there.
if (! file_exists($includes . '/functions.php')) {
    fwrite(
        STDERR,
        "Error: WordPress test library not found at $includes.\n".
        "Run composer install or fix the path in tests/bootstrap.php.\n"
    );
    exit(1);
}

require_once $includes . '/functions.php';

tests_add_filter(
    'muplugins_loaded',
    static function () {
        require dirname(__DIR__) . '/stoneflow.php';
    }
);

require $includes . '/bootstrap.php';

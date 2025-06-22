<?php
$_tests_dir = getenv( 'WP_TESTS_DIR' ) ?: '/tmp/wordpress-tests-lib';

if ( file_exists( $_tests_dir . '/includes/functions.php' ) ) {
    require_once $_tests_dir . '/includes/functions.php';

    tests_add_filter(
        'muplugins_loaded',
        function () {
            require dirname( __DIR__ ) . '/stoneflow.php';
        }
    );

    require $_tests_dir . '/includes/bootstrap.php';
} else {
    // Allow running simple tests without the WordPress testing framework.
    require dirname( __DIR__ ) . '/stoneflow.php';
}

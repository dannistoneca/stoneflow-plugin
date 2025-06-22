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
    if ( ! defined( 'ABSPATH' ) ) {
        define( 'ABSPATH', dirname( __DIR__ ) . '/' );
    }

    // Basic stubs for required WordPress functions used during plugin load.
    if ( ! function_exists( 'plugin_dir_path' ) ) {
        function plugin_dir_path( $file ) {
            return dirname( $file ) . '/';
        }
    }

    if ( ! function_exists( 'plugin_dir_url' ) ) {
        function plugin_dir_url( $file ) {
            return 'http://example.com/' . basename( dirname( $file ) ) . '/';
        }
    }

    if ( ! function_exists( 'add_action' ) ) {
        function add_action( ...$args ) {
            return null;
        }
    }

    if ( ! function_exists( 'add_shortcode' ) ) {
        function add_shortcode( ...$args ) {
            return null;
        }
    }

    if ( ! function_exists( 'add_menu_page' ) ) {
        function add_menu_page( ...$args ) {
            return null;
        }
    }

    if ( ! function_exists( 'add_submenu_page' ) ) {
        function add_submenu_page( ...$args ) {
            return null;
        }
    }

    if ( ! function_exists( 'register_activation_hook' ) ) {
        function register_activation_hook( ...$args ) {
            return null;
        }
    }

    if ( ! function_exists( 'wp_enqueue_style' ) ) {
        function wp_enqueue_style( ...$args ) {
            return null;
        }
    }

    if ( ! function_exists( 'wp_enqueue_script' ) ) {
        function wp_enqueue_script( ...$args ) {
            return null;
        }
    }

    if ( ! function_exists( 'admin_url' ) ) {
        function admin_url( $path = '' ) {
            return '/wp-admin/' . ltrim( $path, '/' );
        }
    }

    if ( ! function_exists( 'is_user_logged_in' ) ) {
        function is_user_logged_in() {
            return false;
        }
    }

    if ( ! function_exists( 'wp_send_json_success' ) ) {
        function wp_send_json_success( $data = null ) {
            return [ 'success' => true, 'data' => $data ];
        }
    }

    if ( ! function_exists( 'wp_send_json_error' ) ) {
        function wp_send_json_error( $data = null ) {
            return [ 'success' => false, 'data' => $data ];
        }
    }

    if ( ! function_exists( 'sanitize_text_field' ) ) {
        function sanitize_text_field( $str ) {
            return trim( filter_var( $str, FILTER_SANITIZE_STRING ) );
        }
    }

    require dirname( __DIR__ ) . '/stoneflow.php';
}

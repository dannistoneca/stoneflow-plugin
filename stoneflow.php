<?php
/*
Plugin Name: StoneFlow + S.T.O.N.E.
Description: Modular client management and service delivery system with AI onboarding for WordPress.
Version: 1.2.5
Author: Danni Stone
Author URI: https://stonebusinesssolutions.com/
Text Domain: stoneflow
*/

if (!defined('ABSPATH')) exit;

define('STONEFLOW_VERSION', '1.2.5');
define('STONEFLOW_DIR', plugin_dir_path(__FILE__));
define('STONEFLOW_URL', plugin_dir_url(__FILE__));
define('STONEFLOW_BRAND_COLOR', '#26b79c'); // Teal

// Load includes
$module_files = [
    'class-client-manager.php',
    'class-service-queue.php',
    'class-stone-ai.php',
    'class-admin-notes.php',
    'class-service-purchase.php',
];

foreach ( $module_files as $file ) {
    $path = STONEFLOW_DIR . 'includes/' . $file;
    if ( file_exists( $path ) ) {
        require_once $path;
    }
}
// Fallback stub classes for unit testing when modules are absent.
if ( ! class_exists( 'StoneFlow_Client_Manager' ) ) {
    require_once STONEFLOW_DIR . 'includes/class-stubs.php';
}

register_activation_hook( __FILE__, function () {
    global $wpdb;
    StoneFlow\create_services_table( $wpdb );
} );


// Activation: Create custom tables
register_activation_hook(__FILE__, ['StoneFlow_Client_Manager', 'install']);
register_activation_hook(__FILE__, ['StoneFlow_Service_Queue', 'install']);

// Initialize plugin modules
add_action('plugins_loaded', function() {
    StoneFlow_Client_Manager::init();
    StoneFlow_Service_Queue::init();
    StoneFlow_Stone_AI::init();
    StoneFlow_Admin_Notes::init();
    StoneFlow_Service_Purchase::init();
});

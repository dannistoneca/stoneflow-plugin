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
require_once STONEFLOW_DIR . 'includes/class-client-manager.php';
require_once STONEFLOW_DIR . 'includes/class-service-queue.php';
require_once STONEFLOW_DIR . 'includes/class-stone-ai.php';
require_once STONEFLOW_DIR . 'includes/class-admin-notes.php';
require_once STONEFLOW_DIR . 'includes/class-service-purchase.php';
require_once STONEFLOW_DIR . 'includes/functions.php';

register_activation_hook( __FILE__, function () {
    global $wpdb;
    StoneFlow\create_services_table( $wpdb );
} );
register_activation_hook( __FILE__, 'stoneflow_create_clients_table' );


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

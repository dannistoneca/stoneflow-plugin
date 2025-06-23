<?php
/*
Plugin Name: StoneFlow + S.T.O.N.E.
Description: Modular client management and service delivery system with AI onboarding for WordPress.
Version: 1.2.5
Author: Danni Stone
Author URI: https://stonebusinesssolutions.com/
Text Domain: stoneflow
*/

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

define( 'STONEFLOW_VERSION', '1.2.5' );
define( 'STONEFLOW_DIR', plugin_dir_path( __FILE__ ) );
define( 'STONEFLOW_URL', plugin_dir_url( __FILE__ ) );
define( 'STONEFLOW_BRAND_COLOR', '#26b79c' ); // Teal

// Core includes.
require_once STONEFLOW_DIR . 'includes/admin-menu.php';
require_once STONEFLOW_DIR . 'includes/admin-dashboard.php';
require_once STONEFLOW_DIR . 'includes/functions.php';
require_once STONEFLOW_DIR . 'includes/install.php';
require_once STONEFLOW_DIR . 'includes/assets.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-security.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-notifications.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-messages.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-client-orders.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-admin-notes.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-service-status.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-client-services.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-order-details.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-suggestions.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-discovery.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-file-handler.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-client-dashboard.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-client-profile.php';
require_once STONEFLOW_DIR . 'includes/stoneflow-shortcodes.php';
require_once STONEFLOW_DIR . 'includes/admin-settings.php';

// Optional admin pages.
require_once STONEFLOW_DIR . 'includes/pages/stoneflow-service-queue.php';
require_once STONEFLOW_DIR . 'includes/pages/stoneflow-client-intake.php';
require_once STONEFLOW_DIR . 'includes/pages/stoneflow-add-client.php';
require_once STONEFLOW_DIR . 'includes/pages/stoneflow-view-client.php';
require_once STONEFLOW_DIR . 'includes/pages/stoneflow-update-service.php';

// Activation: create custom tables.
register_activation_hook( __FILE__, 'stoneflow_install_tables' );


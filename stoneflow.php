<?php
/**
 * Plugin Name: StoneFlow
 * Description: Full-featured client and service management system by Stone Business Solutions.
 * Version: 1.1.0
 * Author: Stone Business Solutions
 */

if (!defined('ABSPATH')) {
    exit;
}

// Core includes
require_once plugin_dir_path(__FILE__) . 'includes/admin-menu.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-dashboard.php';
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/install.php';
require_once plugin_dir_path(__FILE__) . 'includes/assets.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-security.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-notifications.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-messages.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-client-orders.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-admin-notes.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-service-status.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-client-services.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-order-details.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-suggestions.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-discovery.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-file-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-client-dashboard.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-client-profile.php';
require_once plugin_dir_path(__FILE__) . 'includes/helpers/stoneflow-client-profile-fields.php';
//require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-hooks.php';
require_once plugin_dir_path(__FILE__) . 'includes/stoneflow-shortcodes.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';

// Optional: add admin pages or command panels
require_once plugin_dir_path(__FILE__) . 'includes/pages/stoneflow-service-queue.php';
require_once plugin_dir_path(__FILE__) . 'includes/pages/stoneflow-client-intake.php';
require_once plugin_dir_path(__FILE__) . 'includes/pages/stoneflow-add-client.php';
require_once plugin_dir_path(__FILE__) . 'includes/pages/stoneflow-view-client.php';
require_once plugin_dir_path(__FILE__) . 'includes/pages/stoneflow-update-service.php';
<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * File upload and download handling for StoneFlow services.
 */

// Handle file upload
function stoneflow_handle_file_upload($file, $service_id) {
    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    $uploaded = wp_handle_upload($file, ['test_form' => false]);

    if (!isset($uploaded['file'])) {
        return false;
    }

    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_services';

    $wpdb->update(
        $table,
        ['file_url' => esc_url_raw($uploaded['url'])],
        ['id' => intval($service_id)]
    );

    return $uploaded['url'];
}

// Serve file download
function stoneflow_download_file($service_id) {
    $service = stoneflow_get_service_by_id($service_id);

    if (!$service || empty($service->file_url)) {
        wp_die('No file available for this service.');
    }

    $file_url = esc_url_raw($service->file_url);
    $file_path = str_replace(site_url('/'), ABSPATH, $file_url);

    if (file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        wp_die('The file could not be found.');
    }
}

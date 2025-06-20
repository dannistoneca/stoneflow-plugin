<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Manages admin-only notes for each client.
 */

// Save a new admin note for a client
function stoneflow_save_admin_note($client_id, $note_content) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_admin_notes';

    $wpdb->insert($table, [
        'client_id'   => intval($client_id),
        'note'        => sanitize_textarea_field($note_content),
        'created_at'  => current_time('mysql'),
    ]);
}

// Get all notes for a client
function stoneflow_get_admin_notes($client_id) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_admin_notes';

    return $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $table WHERE client_id = %d ORDER BY created_at DESC", $client_id)
    );
}

// Get the latest note for preview
function stoneflow_get_latest_admin_note_preview($client_id) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_admin_notes';

    return $wpdb->get_var(
        $wpdb->prepare("SELECT note FROM $table WHERE client_id = %d ORDER BY created_at DESC LIMIT 1", $client_id)
    );
}

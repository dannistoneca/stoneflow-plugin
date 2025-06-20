<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handles storing and retrieving suggestions made by S.T.O.N.E. for each client.
 */

// Store suggestion for a client
function stoneflow_save_suggestions($client_id, $suggestions = []) {
    if (empty($client_id) || !is_array($suggestions)) {
        return false;
    }

    $encoded = maybe_serialize($suggestions);
    update_user_meta($client_id, '_stoneflow_suggestions', $encoded);
    return true;
}

// Retrieve suggestions for a client
function stoneflow_get_suggestions($client_id) {
    $suggestions = get_user_meta($client_id, '_stoneflow_suggestions', true);
    return maybe_unserialize($suggestions);
}

// Display suggestion list in admin
function stoneflow_display_suggestions($client_id) {
    $suggestions = stoneflow_get_suggestions($client_id);

    if (empty($suggestions)) {
        echo '<p><em>No suggestions available.</em></p>';
        return;
    }

    echo '<ul>';
    foreach ($suggestions as $suggestion) {
        echo '<li>' . esc_html($suggestion) . '</li>';
    }
    echo '</ul>';
}

<?php
// Notes handler functions

if (!defined('ABSPATH')) exit;

function stoneflow_get_admin_notes($user_id) {
    return get_user_meta($user_id, 'stoneflow_admin_notes', true);
}

function stoneflow_save_admin_notes($user_id, $notes) {
    if (current_user_can('manage_options')) {
        update_user_meta($user_id, 'stoneflow_admin_notes', sanitize_textarea_field($notes));
    }
}

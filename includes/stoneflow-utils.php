<?php
// stoneflow-utils.php

if (!defined('ABSPATH')) exit;

// Helper to get plugin directory URL
function stoneflow_plugin_url($path = '') {
    return plugin_dir_url(__DIR__ . '/../stoneflow.php') . ltrim($path, '/');
}

// Get formatted date
function stoneflow_format_date($date) {
    return date_i18n(get_option('date_format'), strtotime($date));
}

// Sanitize posted form data
function stoneflow_sanitize_array($array) {
    if (!is_array($array)) return [];
    return array_map('sanitize_text_field', $array);
}

// Check user role
function stoneflow_user_is_admin($user_id = null) {
    $user = $user_id ? get_user_by('id', $user_id) : wp_get_current_user();
    return in_array('administrator', (array) $user->roles);
}

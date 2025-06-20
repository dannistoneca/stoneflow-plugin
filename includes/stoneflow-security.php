<?php
// stoneflow-security.php

if (!defined('ABSPATH')) exit;

// Verify nonce
function stoneflow_verify_nonce($nonce, $action = 'stoneflow_action') {
    return isset($nonce) && wp_verify_nonce($nonce, $action);
}

// Add security headers
function stoneflow_add_security_headers() {
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('X-Content-Type-Options: nosniff');
}
add_action('send_headers', 'stoneflow_add_security_headers');

// Sanitize post values
function stoneflow_sanitize_post($key) {
    return isset($_POST[$key]) ? sanitize_text_field($_POST[$key]) : '';
}

// Prevent direct access
function stoneflow_block_direct_access() {
    if (!current_user_can('manage_options') && is_admin() && !defined('DOING_AJAX')) {
        wp_die(__('You do not have permission to access this page.'));
    }
}

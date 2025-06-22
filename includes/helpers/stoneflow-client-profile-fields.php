<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Default client profile fields.
 */
function stoneflow_get_profile_defaults() {
    return [
        'first_name'          => '',
        'last_name'           => '',
        'billing_email'       => '',
        'contact_email'       => '',
        'phone'               => '',
        'business_name'       => '',
        'facebook'            => '',
        'website'             => '',
        'services_interested' => '',
        'needs_help_with'     => '',
        'address_street'      => '',
        'address_city'        => '',
        'address_state'       => '',
        'address_postal'      => '',
        'address_country'     => '',
        'time_zone'           => '',
    ];
}

/**
 * Retrieve full client profile data with defaults.
 */
function stoneflow_get_client_profile($user_id) {
    $data = get_user_meta($user_id, 'stoneflow_client_data', true);
    if (!is_array($data)) {
        $data = [];
    }
    return array_merge(stoneflow_get_profile_defaults(), $data);
}

/**
 * Update client profile fields.
 */
function stoneflow_update_client_profile($user_id, $data) {
    $defaults = stoneflow_get_profile_defaults();
    $clean = [];
    foreach ($defaults as $key => $val) {
        if (isset($data[$key])) {
            $clean[$key] = sanitize_text_field($data[$key]);
        }
    }
    $existing = stoneflow_get_client_profile($user_id);
    $new      = array_merge($existing, $clean);
    update_user_meta($user_id, 'stoneflow_client_data', $new);
}


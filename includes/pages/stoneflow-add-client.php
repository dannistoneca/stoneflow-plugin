<?php
// includes/pages/stoneflow-add-client.php

function stoneflow_render_add_client_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    global $wpdb;
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_email'])) {
        $email = sanitize_email($_POST['contact_email']);
        $first = sanitize_text_field($_POST['first_name']);
        $last  = sanitize_text_field($_POST['last_name']);

        if (!is_email($email)) {
            $message = 'Invalid email address.';
        } else {
            $user_id = email_exists($email);

            if (!$user_id) {
                $random_password = wp_generate_password();
                $user_id = wp_create_user($email, $random_password, $email);

                if (is_wp_error($user_id)) {
                    $message = 'Error creating user: ' . $user_id->get_error_message();
                } else {
                    wp_update_user([
                        'ID'          => $user_id,
                        'display_name'=> trim("$first $last")
                    ]);
                    $message = 'New client created successfully.';
                }
            } else {
                $message = 'User already exists. Linked existing user.';
            }

            $profile = [
                'first_name'    => $first,
                'last_name'     => $last,
                'contact_email' => $email,
                'billing_email' => sanitize_email($_POST['billing_email'] ?? $email),
                'phone'         => sanitize_text_field($_POST['phone'] ?? ''),
                'business_name' => sanitize_text_field($_POST['business_name'] ?? ''),
                'facebook'      => esc_url_raw($_POST['facebook'] ?? ''),
                'website'       => esc_url_raw($_POST['website'] ?? ''),
                'services_interested' => sanitize_text_field($_POST['services_interested'] ?? ''),
                'needs_help_with'     => sanitize_textarea_field($_POST['needs_help_with'] ?? ''),
                'address_street'  => sanitize_text_field($_POST['address_street'] ?? ''),
                'address_city'    => sanitize_text_field($_POST['address_city'] ?? ''),
                'address_state'   => sanitize_text_field($_POST['address_state'] ?? ''),
                'address_postal'  => sanitize_text_field($_POST['address_postal'] ?? ''),
                'address_country' => sanitize_text_field($_POST['address_country'] ?? ''),
                'time_zone'       => sanitize_text_field($_POST['time_zone'] ?? ''),
                'added'           => current_time('mysql'),
            ];

            stoneflow_update_client_profile($user_id, $profile);
        }
    }

    echo '<div class="wrap">';
    echo '<h1>Add New Client</h1>';

    if (!empty($message)) {
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html($message) . '</p></div>';
    }

    echo '<form method="post">';
    echo '<table class="form-table">';
    echo '<tr><th><label for="first_name">First Name</label></th>';
    echo '<td><input type="text" name="first_name" id="first_name" class="regular-text" required></td></tr>';
    echo '<tr><th><label for="last_name">Last Name</label></th>';
    echo '<td><input type="text" name="last_name" id="last_name" class="regular-text" required></td></tr>';
    echo '<tr><th><label for="contact_email">Contact Email</label></th>';
    echo '<td><input type="email" name="contact_email" id="contact_email" class="regular-text" required></td></tr>';
    echo '<tr><th><label for="billing_email">Billing Email</label></th>';
    echo '<td><input type="email" name="billing_email" id="billing_email" class="regular-text"></td></tr>';
    echo '<tr><th><label for="phone">Phone</label></th>';
    echo '<td><input type="text" name="phone" id="phone" class="regular-text"></td></tr>';
    echo '<tr><th><label for="business_name">Business Name</label></th>';
    echo '<td><input type="text" name="business_name" id="business_name" class="regular-text"></td></tr>';
    echo '<tr><th><label for="facebook">Facebook URL</label></th>';
    echo '<td><input type="url" name="facebook" id="facebook" class="regular-text"></td></tr>';
    echo '<tr><th><label for="website">Website URL</label></th>';
    echo '<td><input type="url" name="website" id="website" class="regular-text"></td></tr>';
    echo '<tr><th><label for="services_interested">Services Interested In</label></th>';
    echo '<td><input type="text" name="services_interested" id="services_interested" class="regular-text"></td></tr>';
    echo '<tr><th><label for="needs_help_with">What They Need Help With</label></th>';
    echo '<td><textarea name="needs_help_with" id="needs_help_with" rows="3" class="large-text"></textarea></td></tr>';
    echo '<tr><th><label for="address_street">Street</label></th>';
    echo '<td><input type="text" name="address_street" id="address_street" class="regular-text"></td></tr>';
    echo '<tr><th><label for="address_city">City</label></th>';
    echo '<td><input type="text" name="address_city" id="address_city" class="regular-text"></td></tr>';
    echo '<tr><th><label for="address_state">Province/State</label></th>';
    echo '<td><input type="text" name="address_state" id="address_state" class="regular-text"></td></tr>';
    echo '<tr><th><label for="address_postal">Postal Code</label></th>';
    echo '<td><input type="text" name="address_postal" id="address_postal" class="regular-text"></td></tr>';
    echo '<tr><th><label for="address_country">Country</label></th>';
    echo '<td><input type="text" name="address_country" id="address_country" class="regular-text"></td></tr>';
    echo '<tr><th><label for="time_zone">Time Zone</label></th>';
    echo '<td><input type="text" name="time_zone" id="time_zone" class="regular-text"></td></tr>';
    echo '</table>';
    echo '<p><input type="submit" class="button-primary" value="Add Client"></p>';
    echo '</form>';
    echo '</div>';
}

<?php
// admin/client-view.php

if (!defined('ABSPATH')) {
    exit;
}

function stoneflow_view_client_page() {
    global $wpdb;

    $client_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if (!$client_id) {
        echo '<div class="notice notice-error"><p>Invalid client ID.</p></div>';
        return;
    }

    $table = $wpdb->prefix . 'stoneflow_clients';
    $client = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $client_id));

    if (!$client) {
        echo '<div class="notice notice-error"><p>Client not found.</p></div>';
        return;
    }

    ?>
    <div class="wrap">
        <h1>👤 <?= esc_html($client->name); ?> – Profile</h1>
        <p><strong>Email:</strong> <?= esc_html($client->email); ?></p>
        <p><strong>Status:</strong> <?= esc_html($client->status); ?></p>
        <p><strong>Added:</strong> <?= esc_html($client->created_at); ?></p>

        <hr>
        <h2>📦 Services</h2>
        <p><?= $client->services ? nl2br(esc_html($client->services)) : 'No services found.'; ?></p>

        <hr>
        <h2>📝 Admin Notes</h2>
        <form method="post">
            <textarea name="admin_notes" rows="6" style="width: 100%;"><?= esc_textarea($client->admin_notes); ?></textarea>
            <br><br>
            <input type="submit" name="update_notes" class="button button-primary" value="Save Notes">
        </form>

        <?php
        if (isset($_POST['update_notes'])) {
            $new_notes = sanitize_textarea_field($_POST['admin_notes']);
            $wpdb->update(
                $table,
                ['admin_notes' => $new_notes],
                ['id' => $client_id]
            );
            echo '<div class="notice notice-success"><p>Notes updated successfully.</p></div>';
        }
        ?>

    </div>
    <?php
}

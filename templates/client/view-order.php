<?php
if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
$current_user = wp_get_current_user();
$client_id = $current_user->ID;

$order = $wpdb->get_row($wpdb->prepare("
    SELECT * FROM {$wpdb->prefix}stoneflow_services
    WHERE id = %d AND client_id = %d
", $order_id, $client_id));

if (!$order) {
    echo '<p>Order not found.</p>';
    return;
}
?>

<div class="stoneflow-order-details">
    <h2>Order Details</h2>
    <table class="widefat fixed striped">
        <tbody>
            <tr>
                <th>Service</th>
                <td><?php echo esc_html($order->service_name); ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo esc_html($order->status); ?></td>
            </tr>
            <tr>
                <th>Priority</th>
                <td><?php echo esc_html($order->priority); ?></td>
            </tr>
            <tr>
                <th>Created At</th>
                <td><?php echo esc_html($order->created_at); ?></td>
            </tr>
            <tr>
                <th>Download</th>
                <td>
                    <?php if (!empty($order->file_url)): ?>
                        <a href="<?php echo esc_url($order->file_url); ?>" target="_blank">Download File</a>
                    <?php else: ?>
                        No file uploaded yet.
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Notes</h3>
    <div class="stoneflow-order-notes">
        <?php
        $notes = $wpdb->get_results($wpdb->prepare("
            SELECT * FROM {$wpdb->prefix}stoneflow_notes
            WHERE order_id = %d
            ORDER BY created_at DESC
        ", $order->id));

        if ($notes):
            foreach ($notes as $note):
                $note_type = esc_html($note->type);
                $note_author = esc_html($note->author);
                $note_content = esc_html($note->note);
                $note_time = esc_html($note->created_at);
                ?>
                <div class="stoneflow-note">
                    <strong><?php echo $note_type === 'admin' ? 'Admin' : 'You'; ?></strong> @ <?php echo $note_time; ?>:
                    <p><?php echo $note_content; ?></p>
                </div>
            <?php endforeach;
        else: ?>
            <p>No notes yet.</p>
        <?php endif; ?>
    </div>

    <form method="post">
        <h4>Leave a Note</h4>
        <textarea name="client_note" rows="4" cols="50" placeholder="Write your message here..."></textarea><br>
        <input type="hidden" name="stoneflow_order_id" value="<?php echo esc_attr($order->id); ?>">
        <?php wp_nonce_field('stoneflow_add_client_note', 'stoneflow_client_note_nonce'); ?>
        <input type="submit" name="submit_client_note" value="Send Note" class="button button-primary">
    </form>
</div>

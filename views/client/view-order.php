<?php
defined('ABSPATH') || exit;

global $wpdb;
$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$client_id = get_current_user_id();

$order = $wpdb->get_row($wpdb->prepare(
    "SELECT * FROM wp_stoneflow_services WHERE id = %d AND client_id = %d",
    $order_id, $client_id
), ARRAY_A);

if (!$order) {
    echo '<p>Order not found or access denied.</p>';
    return;
}
?>

<div class="stoneflow-client-panel">
    <h2>Order Details: <?php echo esc_html($order['service_name']); ?></h2>
    
    <table class="stoneflow-details-table">
        <tr><th>Status:</th><td><?php echo esc_html($order['status']); ?></td></tr>
        <tr><th>Priority:</th><td><?php echo esc_html($order['priority']); ?></td></tr>
        <tr><th>Date Added:</th><td><?php echo esc_html($order['created_at']); ?></td></tr>
        <?php if (!empty($order['file_url'])) : ?>
            <tr><th>Download File:</th>
                <td><a href="<?php echo esc_url($order['file_url']); ?>" target="_blank" class="button">Download</a></td>
            </tr>
        <?php endif; ?>
    </table>

    <h3>Leave a Note:</h3>
    <form method="post">
        <textarea name="client_note" rows="5" style="width:100%" required></textarea>
        <input type="hidden" name="stoneflow_order_id" value="<?php echo esc_attr($order_id); ?>">
        <input type="submit" class="button button-primary" value="Send Note">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['client_note'])) {
        $note = sanitize_textarea_field($_POST['client_note']);
        $wpdb->insert('wp_stoneflow_notes', [
            'order_id' => $order_id,
            'note' => $note,
            'added_by' => 'client',
            'created_at' => current_time('mysql')
        ]);
        echo '<p class="updated">Note submitted.</p>';
    }

    $notes = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM wp_stoneflow_notes WHERE order_id = %d ORDER BY created_at DESC",
        $order_id
    ), ARRAY_A);
    ?>

    <?php if (!empty($notes)) : ?>
        <h3>Notes History</h3>
        <ul class="stoneflow-notes-list">
            <?php foreach ($notes as $note) : ?>
                <li><strong><?php echo ucfirst($note['added_by']); ?>:</strong> <?php echo esc_html($note['note']); ?> <em>(<?php echo esc_html($note['created_at']); ?>)</em></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

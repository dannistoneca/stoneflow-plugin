<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Renders the client dashboard showing all their assigned service orders.
 */

function stoneflow_render_client_dashboard() {
    if (!is_user_logged_in()) {
        return '<p>You must be logged in to view your dashboard.</p>';
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $table = $wpdb->prefix . 'stoneflow_services';

    $orders = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE client_id = %d ORDER BY created_at DESC", $user_id));

    ob_start();
    ?>
    <div class="stoneflow-client-dashboard">
        <h2>Your Service Orders</h2>

        <?php if (empty($orders)) : ?>
            <p>You currently have no service orders.</p>
        <?php else : ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Created</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?php echo esc_html($order->service_name); ?></td>
                            <td><?php echo esc_html(ucfirst($order->status)); ?></td>
                            <td><?php echo $order->priority ? 'Yes' : 'No'; ?></td>
                            <td><?php echo esc_html(date('M j, Y', strtotime($order->created_at))); ?></td>
                            <td>
                                <a href="<?php echo esc_url(add_query_arg('stoneflow_order', $order->id, get_permalink())); ?>" class="button">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}

function stoneflow_client_dashboard_shortcode() {
    return stoneflow_render_client_dashboard();
}
add_shortcode('stoneflow_client_dashboard', 'stoneflow_client_dashboard_shortcode');

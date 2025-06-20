<div class="wrap">
    <h1>📄 Order Details</h1>

    <table class="form-table">
        <tr>
            <th>Client</th>
            <td><?php echo esc_html($order->client_name); ?> (<?php echo esc_html($order->client_email); ?>)</td>
        </tr>
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
            <td><?php echo $order->priority ? '🔥 High' : '– Normal'; ?></td>
        </tr>
        <tr>
            <th>Created</th>
            <td><?php echo esc_html($order->created_at); ?></td>
        </tr>
        <tr>
            <th>File URL</th>
            <td>
                <?php if ($order->file_url): ?>
                    <a href="<?php echo esc_url($order->file_url); ?>" target="_blank">Download</a>
                <?php else: ?>
                    —
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <h2>🔧 Update Order</h2>
    <form method="post">
        <input type="hidden" name="order_id" value="<?php echo esc_attr($order->id); ?>">
        <p>
            <label>Status:</label><br>
            <select name="order_status">
                <option value="queued" <?php selected($order->status, 'queued'); ?>>Queued</option>
                <option value="in_process" <?php selected($order->status, 'in_process'); ?>>In Process</option>
                <option value="completed" <?php selected($order->status, 'completed'); ?>>Completed</option>
            </select>
        </p>
        <p>
            <label>File URL:</label><br>
            <input type="url" name="file_url" value="<?php echo esc_attr($order->file_url); ?>" style="width:100%;">
        </p>
        <p>
            <input type="submit" name="update_order" class="button button-primary" value="Save Changes">
        </p>
    </form>
</div>

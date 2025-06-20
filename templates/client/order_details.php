<div class="stoneflow-order-details">
    <h2>📄 Order Details</h2>

    <table class="widefat fixed striped">
        <thead>
            <tr>
                <th>Service</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Created At</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($order): ?>
                <tr>
                    <td><?php echo esc_html($order->service_name); ?></td>
                    <td><?php echo esc_html(ucfirst($order->status)); ?></td>
                    <td><?php echo esc_html($order->priority ? 'Yes' : 'No'); ?></td>
                    <td><?php echo esc_html($order->created_at); ?></td>
                    <td>
                        <?php if (!empty($order->file_url)): ?>
                            <a href="<?php echo esc_url($order->file_url); ?>" target="_blank">Download</a>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                </tr>
            <?php else: ?>
                <tr><td colspan="5">No order details found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

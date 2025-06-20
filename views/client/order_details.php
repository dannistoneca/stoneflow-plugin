<div class="wrap">
    <h1>📦 Order Details</h1>

    <?php if (!empty($order)) : ?>
        <table class="form-table">
            <tr>
                <th>Service</th>
                <td><?= esc_html($order['service_name']) ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= esc_html($order['status']) ?></td>
            </tr>
            <tr>
                <th>Priority</th>
                <td><?= esc_html($order['priority']) ?></td>
            </tr>
            <tr>
                <th>Created</th>
                <td><?= esc_html($order['created_at']) ?></td>
            </tr>
            <tr>
                <th>Download</th>
                <td>
                    <?php if (!empty($order['file_url'])) : ?>
                        <a href="<?= esc_url($order['file_url']) ?>" target="_blank">Download File</a>
                    <?php else : ?>
                        <em>File not available yet.</em>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Admin Notes</th>
                <td><?= esc_html($order['admin_notes']) ?></td>
            </tr>
        </table>
    <?php else : ?>
        <p><strong>Error:</strong> This order could not be found.</p>
    <?php endif; ?>
</div>

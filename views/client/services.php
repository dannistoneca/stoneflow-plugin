<div class="stoneflow-client-panel">
    <h2>📦 Your Services</h2>
    <?php if (!empty($services)) : ?>
        <table class="widefat fixed striped">
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
                <?php foreach ($services as $service) : ?>
                    <tr>
                        <td><?= esc_html($service['service_name']) ?></td>
                        <td><?= esc_html($service['status']) ?></td>
                        <td><?= esc_html($service['priority']) ?></td>
                        <td><?= esc_html(date('Y-m-d', strtotime($service['created_at']))) ?></td>
                        <td><a href="?stoneflow_action=view_order&id=<?= intval($service['id']) ?>" class="button button-small">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>You have no active services at this time.</p>
    <?php endif; ?>
</div>

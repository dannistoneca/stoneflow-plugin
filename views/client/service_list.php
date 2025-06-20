<div class="wrap">
    <h1>📦 My Services</h1>

    <?php if (empty($services)) : ?>
        <p>You have no services assigned yet.</p>
    <?php else : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Last Updated</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service) : ?>
                    <tr>
                        <td><?= esc_html($service->service_name) ?></td>
                        <td><?= esc_html($service->status) ?></td>
                        <td><?= $service->priority ? '✅ Yes' : 'No' ?></td>
                        <td><?= esc_html($service->updated_at) ?></td>
                        <td><a href="<?= admin_url('admin.php?page=stoneflow_service_view&id=' . $service->id) ?>">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<div class="stoneflow-client-panel">
    <h2>📦 Services</h2>

    <?php if (!empty($services)) : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Download</th>
                    <th>Notes</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service) : ?>
                    <tr>
                        <td><?= esc_html($service['service_name']) ?></td>
                        <td><?= esc_html(ucfirst($service['status'])) ?></td>
                        <td><?= $service['priority'] ? '⭐' : '' ?></td>
                        <td>
                            <?php if (!empty($service['file_url'])) : ?>
                                <a href="<?= esc_url($service['file_url']) ?>" target="_blank">Download</a>
                            <?php else : ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td><?= esc_html($service['notes']) ?></td>
                        <td><?= date('F j, Y g:i A', strtotime($service['updated_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No services found.</p>
    <?php endif; ?>
</div>

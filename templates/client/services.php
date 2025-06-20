<div class="stoneflow-client-services">
    <h2>📦 Your Services</h2>

    <?php if (!empty($services)) : ?>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Added</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service) : ?>
                    <tr>
                        <td><?php echo esc_html($service->service_name); ?></td>
                        <td><?php echo esc_html(ucfirst($service->status)); ?></td>
                        <td><?php echo $service->priority ? '⭐ Priority' : 'Normal'; ?></td>
                        <td><?php echo esc_html(date('Y-m-d', strtotime($service->created_at))); ?></td>
                        <td>
                            <?php if (!empty($service->file_url)) : ?>
                                <a href="<?php echo esc_url($service->file_url); ?>" target="_blank" class="button">Download</a>
                            <?php else : ?>
                                N/A
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No services found.</p>
    <?php endif; ?>
</div>

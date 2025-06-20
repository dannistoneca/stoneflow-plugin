<div class="wrap">
    <h1>👋 Welcome to Your Dashboard</h1>

    <p>Below you’ll find a list of all services you’ve ordered, along with their current status and any downloadable files available to you.</p>

    <?php if (empty($client_services)): ?>
        <p>No services found. Need help getting started? Reach out to our team anytime.</p>
    <?php else: ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>📝 Service</th>
                    <th>📅 Created</th>
                    <th>⚙️ Status</th>
                    <th>📁 File</th>
                    <th>🔍 View</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($client_services as $service): ?>
                    <tr>
                        <td><?php echo esc_html($service->service_name); ?></td>
                        <td><?php echo esc_html($service->created_at); ?></td>
                        <td>
                            <?php 
                                $status_map = [
                                    'queued' => '⏳ Queued',
                                    'in_process' => '🚧 In Process',
                                    'completed' => '✅ Completed'
                                ];
                                echo $status_map[$service->status] ?? esc_html($service->status);
                            ?>
                        </td>
                        <td>
                            <?php if (!empty($service->file_url)): ?>
                                <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="button" href="<?php echo esc_url(add_query_arg(['view_service' => $service->id])); ?>">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

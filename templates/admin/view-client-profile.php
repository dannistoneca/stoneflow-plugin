<div class="wrap">
    <h1>👤 <?php echo esc_html($client->display_name); ?> – Profile</h1>
    <p><strong>Email:</strong> <?php echo esc_html($client->user_email); ?></p>
    <p><strong>Status:</strong> <?php echo esc_html($client->stoneflow_status); ?></p>
    <p><strong>Added:</strong> <?php echo date('Y-m-d H:i:s', strtotime($client->user_registered)); ?></p>

    <hr>

    <h2>📦 Services</h2>
    <?php if (empty($services)): ?>
        <p>No services found.</p>
    <?php else: ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>File</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo esc_html($service->service_name); ?></td>
                        <td><?php echo esc_html($service->status); ?></td>
                        <td><?php echo $service->priority ? '🔥' : '–'; ?></td>
                        <td><?php echo $service->file_url ? '<a href="' . esc_url($service->file_url) . '" target="_blank">Download</a>' : '—'; ?></td>
                        <td><?php echo esc_html($service->created_at); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <hr>

    <h2>📝 Admin Notes</h2>
    <form method="post">
        <textarea name="admin_note" rows="6" style="width: 100%;"><?php echo esc_textarea($client->stoneflow_admin_note); ?></textarea>
        <p><input type="submit" name="save_admin_note" class="button button-primary" value="Save Admin Note"></p>
    </form>
</div>

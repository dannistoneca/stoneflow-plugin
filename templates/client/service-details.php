<div class="wrap">
    <h1>📄 Service Details</h1>

    <?php if (!$service): ?>
        <p>Sorry, we couldn't find the service you're looking for.</p>
        <a href="<?php echo esc_url(admin_url('admin.php?page=stoneflow_client_dashboard')); ?>" class="button">Back to Dashboard</a>
    <?php else: ?>
        <table class="form-table">
            <tr>
                <th scope="row">📝 Service Name</th>
                <td><?php echo esc_html($service->service_name); ?></td>
            </tr>
            <tr>
                <th scope="row">📅 Created</th>
                <td><?php echo esc_html($service->created_at); ?></td>
            </tr>
            <tr>
                <th scope="row">⚙️ Status</th>
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
            </tr>
            <tr>
                <th scope="row">📁 File</th>
                <td>
                    <?php if (!empty($service->file_url)): ?>
                        <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download File</a>
                    <?php else: ?>
                        <em>No file uploaded yet.</em>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <h2>💬 Notes</h2>
        <form method="post">
            <textarea name="new_note" rows="4" style="width: 100%;" placeholder="Write a new note..."></textarea>
            <input type="hidden" name="service_id" value="<?php echo esc_attr($service->id); ?>">
            <input type="submit" name="submit_note" class="button button-primary" value="Add Note">
        </form>

        <?php if (!empty($service_notes)): ?>
            <ul>
                <?php foreach ($service_notes as $note): ?>
                    <li><strong><?php echo esc_html($note->author_type); ?>:</strong> <?php echo esc_html($note->note); ?> <em>(<?php echo esc_html($note->created_at); ?>)</em></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No notes yet.</p>
        <?php endif; ?>

        <p><a href="<?php echo esc_url(admin_url('admin.php?page=stoneflow_client_dashboard')); ?>" class="button">⬅️ Back to Dashboard</a></p>
    <?php endif; ?>
</div>

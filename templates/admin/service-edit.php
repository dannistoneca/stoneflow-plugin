<div class="wrap">
    <h1>🛠️ Edit Service</h1>

    <?php if (!$service): ?>
        <p>Service not found.</p>
        <a href="<?php echo esc_url(admin_url('admin.php?page=stoneflow_service_queue')); ?>" class="button">Back to Queue</a>
    <?php else: ?>
        <form method="post">
            <input type="hidden" name="service_id" value="<?php echo esc_attr($service->id); ?>">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="service_name">Service Name</label></th>
                    <td><input type="text" name="service_name" id="service_name" value="<?php echo esc_attr($service->service_name); ?>" class="regular-text" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="status">Status</label></th>
                    <td>
                        <select name="status" id="status">
                            <option value="queued" <?php selected($service->status, 'queued'); ?>>⏳ Queued</option>
                            <option value="in_process" <?php selected($service->status, 'in_process'); ?>>🚧 In Process</option>
                            <option value="completed" <?php selected($service->status, 'completed'); ?>>✅ Completed</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="file_url">File URL</label></th>
                    <td><input type="url" name="file_url" id="file_url" value="<?php echo esc_url($service->file_url); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="priority">Priority</label></th>
                    <td><input type="checkbox" name="priority" id="priority" <?php checked($service->priority, 1); ?>> <label for="priority">Mark as Priority</label></td>
                </tr>
            </table>
            <p>
                <input type="submit" name="submit_edit_service" class="button button-primary" value="Update Service">
                <a href="<?php echo esc_url(admin_url('admin.php?page=stoneflow_service_queue')); ?>" class="button">Cancel</a>
            </p>
        </form>
    <?php endif; ?>
</div>

<?php
if (!defined('ABSPATH')) exit;

function stoneflow_render_service_row($service) {
    ?>
    <tr>
        <td><?php echo esc_html($service->client_name); ?></td>
        <td><?php echo esc_html($service->client_email); ?></td>
        <td><?php echo esc_html($service->service_name); ?></td>
        <td><?php echo esc_html(ucfirst($service->status)); ?></td>
        <td>
            <?php if (!empty($service->file_url)) : ?>
                <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a>
            <?php else : ?>
                —
            <?php endif; ?>
        </td>
        <td><?php echo date('Y-m-d', strtotime($service->created_at)); ?></td>
        <td>
            <form method="post" style="display:inline;">
                <input type="hidden" name="update_service_id" value="<?php echo esc_attr($service->id); ?>">
                <select name="new_status">
                    <option value="queued" <?php selected($service->status, 'queued'); ?>>Queued</option>
                    <option value="in process" <?php selected($service->status, 'in process'); ?>>In Process</option>
                    <option value="completed" <?php selected($service->status, 'completed'); ?>>Completed</option>
                </select>
                <button type="submit" class="button">Update</button>
            </form>
        </td>
    </tr>
    <?php
}

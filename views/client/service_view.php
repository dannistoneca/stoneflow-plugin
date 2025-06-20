<div class="wrap">
    <h1>📝 Service Details</h1>

    <?php if (!$service) : ?>
        <p>Service not found.</p>
    <?php else : ?>
        <table class="form-table">
            <tr>
                <th><label>Service</label></th>
                <td><?= esc_html($service->service_name) ?></td>
            </tr>
            <tr>
                <th><label>Status</label></th>
                <td><?= esc_html($service->status) ?></td>
            </tr>
            <tr>
                <th><label>Priority</label></th>
                <td><?= $service->priority ? '✅ Yes' : 'No' ?></td>
            </tr>
            <tr>
                <th><label>File</label></th>
                <td>
                    <?php if (!empty($service->file_url)) : ?>
                        <a href="<?= esc_url($service->file_url) ?>" target="_blank">Download</a>
                    <?php else : ?>
                        No file uploaded.
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th><label>Notes</label></th>
                <td><?= nl2br(esc_html($service->notes)) ?></td>
            </tr>
            <tr>
                <th><label>Last Updated</label></th>
                <td><?= esc_html($service->updated_at) ?></td>
            </tr>
        </table>
    <?php endif; ?>
</div>

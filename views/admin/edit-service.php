<?php if (!$service) : ?>
  <div class="notice notice-error"><p>Service not found.</p></div>
<?php else : ?>
  <div class="wrap">
    <h1>Edit Service for <?= esc_html($client->first_name . ' ' . $client->last_name); ?></h1>
    <form method="post" enctype="multipart/form-data">
      <?php wp_nonce_field('stoneflow_update_service', 'stoneflow_nonce'); ?>
      <input type="hidden" name="service_id" value="<?= esc_attr($service->id); ?>">

      <table class="form-table">
        <tr>
          <th><label for="service_name">Service Name</label></th>
          <td><input type="text" name="service_name" id="service_name" class="regular-text" value="<?= esc_attr($service->service_name); ?>" required></td>
        </tr>
        <tr>
          <th><label for="status">Status</label></th>
          <td>
            <select name="status" id="status">
              <option value="queued" <?= selected($service->status, 'queued'); ?>>Queued</option>
              <option value="in_progress" <?= selected($service->status, 'in_progress'); ?>>In Progress</option>
              <option value="completed" <?= selected($service->status, 'completed'); ?>>Completed</option>
            </select>
          </td>
        </tr>
        <tr>
          <th><label for="priority">Priority</label></th>
          <td><input type="checkbox" name="priority" id="priority" value="1" <?= checked($service->priority, 1); ?>> Mark as Priority</td>
        </tr>
        <tr>
          <th><label for="file_upload">Upload File</label></th>
          <td><input type="file" name="file_upload" id="file_upload"></td>
        </tr>
        <tr>
          <th><label for="notes">Notes</label></th>
          <td><textarea name="notes" id="notes" rows="5" class="large-text"><?= esc_textarea($service->notes); ?></textarea></td>
        </tr>
      </table>

      <?php submit_button('Update Service'); ?>
    </form>
  </div>
<?php endif; ?>

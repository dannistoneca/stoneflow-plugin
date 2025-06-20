<?php if (!empty($services)) : ?>
  <table class="widefat fixed striped">
    <thead>
      <tr>
        <th>Client</th>
        <th>Service</th>
        <th>Status</th>
        <th>Priority</th>
        <th>Created</th>
        <th>File</th>
        <th>Notes</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($services as $service) : ?>
        <tr>
          <td><?= esc_html($service->client_name); ?></td>
          <td><?= esc_html($service->service_name); ?></td>
          <td><?= esc_html(ucfirst($service->status)); ?></td>
          <td><?= $service->priority ? 'Yes' : 'No'; ?></td>
          <td><?= date('Y-m-d', strtotime($service->created_at)); ?></td>
          <td>
            <?php if ($service->file_url) : ?>
              <a href="<?= esc_url($service->file_url); ?>" target="_blank">Download</a>
            <?php else : ?>
              None
            <?php endif; ?>
          </td>
          <td><?= esc_html($service->notes); ?></td>
          <td>
            <a href="<?= admin_url('admin.php?page=stoneflow-edit-service&id=' . $service->id); ?>" class="button">Edit</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else : ?>
  <p>No services in the queue.</p>
<?php endif; ?>

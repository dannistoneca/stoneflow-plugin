<div class="wrap">
  <h1>Service Queue</h1>

  <table class="wp-list-table widefat fixed striped">
    <thead>
      <tr>
        <th>Client</th>
        <th>Service</th>
        <th>Status</th>
        <th>Priority</th>
        <th>Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($services)) : ?>
        <?php foreach ($services as $service) : ?>
          <tr>
            <td><?php echo esc_html($service->client_name); ?></td>
            <td><?php echo esc_html($service->service_name); ?></td>
            <td><?php echo esc_html(ucfirst($service->status)); ?></td>
            <td><?php echo $service->priority ? '🔺 High' : 'Normal'; ?></td>
            <td><?php echo esc_html(date('Y-m-d', strtotime($service->created_at))); ?></td>
            <td>
              <a href="<?php echo admin_url('admin.php?page=stoneflow_service_details&id=' . intval($service->id)); ?>" class="button">View</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr><td colspan="6">No active services found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

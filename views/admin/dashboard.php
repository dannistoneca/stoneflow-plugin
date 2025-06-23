<div class="wrap stoneflow-admin">
  <h1>StoneFlow Admin Dashboard</h1>
  
  <div class="sf-tabs">
    <button class="sf-tab active" data-tab="clients">Clients</button>
    <button class="sf-tab" data-tab="services">Services</button>
    <button class="sf-tab" data-tab="notes">Admin Notes</button>
  </div>

  <div id="clients" class="sf-tab-content">
    <h2>Client List</h2>
    <table class="widefat fixed striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Discovery Info</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($clients)) : ?>
          <?php foreach ($clients as $client) : ?>
            <tr>
              <td><?= esc_html($client->name); ?></td>
              <td><?= esc_html($client->email); ?></td>
              <td><?= $client->discovery_info ? 'Available' : 'No data'; ?></td>
              <td>
                <a href="<?= admin_url('admin.php?page=stoneflow-view-client&id=' . $client->id); ?>" class="button">View</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr><td colspan="4">No clients found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div id="services" class="sf-tab-content hidden">
    <h2>Service Queue</h2>
    <?php include plugin_dir_path(__FILE__) . 'services-table.php'; ?>
  </div>

  <div id="notes" class="sf-tab-content hidden">
    <h2>Admin Notes</h2>
    <?php include plugin_dir_path(__FILE__) . '../../admin/views/view-admin-notes.php'; ?>
  </div>
</div>

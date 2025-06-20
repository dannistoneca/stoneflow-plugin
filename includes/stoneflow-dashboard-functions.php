<?php
// Dashboard functionality for StoneFlow

if (!defined('ABSPATH')) exit;

function stoneflow_render_client_dashboard() {
    $user_id = get_current_user_id();
    $services = stoneflow_get_user_services($user_id);

    ob_start(); ?>
    <div class="stoneflow-dashboard">
        <h2>Your Dashboard</h2>
        <?php if ($services && count($services) > 0): ?>
            <table class="stoneflow-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Download</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?php echo esc_html($service['name']); ?></td>
                            <td><?php echo esc_html($service['status']); ?></td>
                            <td>
                                <?php if (!empty($service['file_url'])): ?>
                                    <a href="<?php echo esc_url($service['file_url']); ?>" download>Download</a>
                                <?php else: ?>
                                    <em>Pending</em>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo isset($service['client_note']) ? esc_html($service['client_note']) : '-'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No services found.</p>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}

<?php
// Admin Discovery Data View
if (!defined('ABSPATH')) exit;

global $wpdb;
$users = get_users();
?>

<div class="wrap">
    <h1>🔍 Discovery Session Data</h1>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Discovery Info</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): 
                $discovery = get_user_meta($user->ID, 'stoneflow_discovery_data', true);
                ?>
                <tr>
                    <td><a href="<?php echo admin_url('admin.php?page=stoneflow-client-profile&user_id=' . $user->ID); ?>"><?php echo esc_html($user->display_name); ?></a></td>
                    <td><?php echo esc_html($user->user_email); ?></td>
                    <td><?php echo !empty($discovery) ? '✅ Submitted' : 'No data'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

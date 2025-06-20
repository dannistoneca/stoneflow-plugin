<?php
if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$clients = get_users(['role__in' => ['subscriber', 'customer', 'client']]);

?>

<div class="wrap">
    <h1>StoneFlow Dashboard</h1>

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
                    <?php
                    $discovery_info = get_user_meta($client->ID, 'stone_discovery_info', true);
                    ?>
                    <tr>
                        <td><?php echo esc_html($client->display_name); ?></td>
                        <td><?php echo esc_html($client->user_email); ?></td>
                        <td>
                            <?php
                            echo !empty($discovery_info) ? '<span style="color:green;">✔ Collected</span>' : '<span style="color:red;">✘ Not Collected</span>';
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=stoneflow_client_view&id=' . $client->ID); ?>" class="button button-primary">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No clients found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

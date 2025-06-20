<?php
if (!defined('ABSPATH')) exit;
?>

<tr>
    <td><?php echo esc_html($client->name); ?></td>
    <td><?php echo esc_html($client->email); ?></td>
    <td>
        <?php
        if (!empty($client->discovery_data)) {
            echo '<span class="stoneflow-status-complete">Complete</span>';
        } else {
            echo '<span class="stoneflow-status-missing">No data</span>';
        }
        ?>
    </td>
    <td>
        <a href="<?php echo admin_url('admin.php?page=stoneflow_client_profile&client_id=' . $client->id); ?>" class="button">View</a>
    </td>
</tr>

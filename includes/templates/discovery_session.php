<?php
if (!defined('ABSPATH')) exit;

$client_id = intval($_GET['client_id'] ?? 0);
$discovery_data = StoneFlow_DB::get_discovery_info($client_id);
?>

<div class="wrap">
    <h2>Discovery Session Info</h2>
    <?php if ($discovery_data): ?>
        <table class="widefat fixed striped">
            <tbody>
                <?php foreach ($discovery_data as $key => $value): ?>
                    <tr>
                        <th><?php echo esc_html(ucwords(str_replace('_', ' ', $key))); ?></th>
                        <td><?php echo esc_html($value); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No discovery session data available for this client.</p>
    <?php endif; ?>
</div>

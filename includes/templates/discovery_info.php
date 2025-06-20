<?php
if (!defined('ABSPATH')) exit;

$client_id = intval($_GET['client_id'] ?? 0);
$discovery_info = StoneFlow_DB::get_discovery_info($client_id);

if (!$discovery_info) {
    echo '<p>No discovery session data available for this client.</p>';
    return;
}
?>

<div class="wrap">
    <h2>Discovery Session Info</h2>
    <table class="widefat striped">
        <thead>
            <tr>
                <th>Question</th>
                <th>Response</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($discovery_info as $item): ?>
                <tr>
                    <td><?php echo esc_html($item->question); ?></td>
                    <td><?php echo esc_html($item->response); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

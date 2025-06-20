<?php
if (!defined('ABSPATH')) exit;

$client_id = intval($_GET['client_id'] ?? 0);
$responses = StoneFlow_DB::get_discovery_responses($client_id);
?>

<div class="wrap">
    <h2>Discovery Session Responses</h2>
    <?php if (!empty($responses)): ?>
        <table class="widefat fixed striped">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Response</th>
                    <th>Answered On</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responses as $response): ?>
                    <tr>
                        <td><?php echo esc_html($response['question']); ?></td>
                        <td><?php echo esc_html($response['answer']); ?></td>
                        <td><?php echo esc_html(date('Y-m-d H:i', strtotime($response['created_at']))); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No discovery responses found for this client.</p>
    <?php endif; ?>
</div>

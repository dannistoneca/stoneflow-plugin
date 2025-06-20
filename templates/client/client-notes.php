<?php
if (!defined('ABSPATH')) {
    exit;
}

$current_user = wp_get_current_user();
$client_notes = get_user_meta($current_user->ID, 'stoneflow_client_notes', true);
?>

<div class="stoneflow-client-notes">
    <h2>Your Notes</h2>

    <?php if (!empty($client_notes)) : ?>
        <ul>
            <?php foreach ($client_notes as $note) : ?>
                <li>
                    <strong><?php echo esc_html($note['date']); ?>:</strong><br>
                    <?php echo nl2br(esc_html($note['content'])); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No notes available yet.</p>
    <?php endif; ?>
</div>

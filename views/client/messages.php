<?php
defined('ABSPATH') || exit;

?>
<div class="stoneflow-client-panel">
    <h2>Messages</h2>
    <p>Here you’ll find any important updates or notes from the Stone Business Solutions team.</p>

    <?php
    $client_id = get_current_user_id();
    $messages = stoneflow_get_client_messages($client_id);

    if ($messages && is_array($messages)) :
        foreach ($messages as $message) :
    ?>
            <div class="stoneflow-message">
                <p><strong>Date:</strong> <?php echo esc_html(date('Y-m-d H:i', strtotime($message['timestamp']))); ?></p>
                <p><strong>From:</strong> Admin</p>
                <div class="stoneflow-message-body">
                    <?php echo wpautop(esc_html($message['content'])); ?>
                </div>
            </div>
    <?php
        endforeach;
    else :
        echo '<p>No messages at this time.</p>';
    endif;
    ?>
</div>

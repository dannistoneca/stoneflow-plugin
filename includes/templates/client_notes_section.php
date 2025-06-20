<?php
if (!defined('ABSPATH')) exit;

function stoneflow_client_notes_section($client_id) {
    $notes = get_user_meta($client_id, 'stoneflow_admin_notes', true);
    ?>
    <div class="wrap">
        <h3>📝 Admin Notes</h3>
        <form method="post">
            <input type="hidden" name="stoneflow_notes_client_id" value="<?php echo esc_attr($client_id); ?>">
            <textarea name="stoneflow_admin_notes" rows="8" class="large-text"><?php echo esc_textarea($notes); ?></textarea>
            <?php submit_button('Save Notes'); ?>
        </form>
    </div>
    <?php
}

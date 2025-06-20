<?php
// Add Notes section to client profile
function stoneflow_display_admin_notes_section($client) {
    ?>
    <h2>📝 Admin Notes</h2>
    <form method="post">
        <textarea name="stoneflow_admin_notes" rows="6" style="width: 100%;"><?php echo esc_textarea(get_user_meta($client->ID, '_stoneflow_admin_notes', true)); ?></textarea>
        <input type="submit" class="button button-primary" value="Save Notes">
        <input type="hidden" name="stoneflow_save_notes_nonce" value="<?php echo wp_create_nonce('stoneflow_save_notes'); ?>">
    </form>
    <?php
}

function stoneflow_handle_admin_notes_save($user_id) {
    if (isset($_POST['stoneflow_save_notes_nonce']) && wp_verify_nonce($_POST['stoneflow_save_notes_nonce'], 'stoneflow_save_notes')) {
        update_user_meta($user_id, '_stoneflow_admin_notes', sanitize_textarea_field($_POST['stoneflow_admin_notes']));
    }
}
add_action('edit_user_profile_update', 'stoneflow_handle_admin_notes_save');
add_action('show_user_profile', 'stoneflow_display_admin_notes_section');
add_action('edit_user_profile', 'stoneflow_display_admin_notes_section');

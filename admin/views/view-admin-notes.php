<?php
// Admin Notes View
if (!defined('ABSPATH')) exit;

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($user_id > 0) {
    $notes = get_user_meta($user_id, 'stoneflow_admin_notes', true);
    $user_info = get_userdata($user_id);
    ?>
    <div class="wrap">
        <h1>📝 Admin Notes for <?php echo esc_html($user_info->display_name); ?></h1>
        <form method="post">
            <textarea name="stoneflow_admin_notes" rows="10" cols="100"><?php echo esc_textarea($notes); ?></textarea><br>
            <input type="hidden" name="stoneflow_user_id" value="<?php echo $user_id; ?>">
            <?php submit_button('Save Notes'); ?>
        </form>
    </div>
    <?php
} else {
    echo '<div class="notice notice-error"><p>User not found.</p></div>';
}

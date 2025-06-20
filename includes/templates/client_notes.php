<?php
if (!defined('ABSPATH')) exit;

$client_id = intval($_GET['client_id'] ?? 0);
$current_notes = StoneFlow_DB::get_admin_notes($client_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_notes'])) {
    check_admin_referer('stoneflow_save_notes');
    $new_notes = sanitize_textarea_field($_POST['admin_notes']);
    StoneFlow_DB::save_admin_notes($client_id, $new_notes);
    $current_notes = $new_notes;
    echo '<div class="updated"><p>Notes updated.</p></div>';
}
?>

<div class="wrap">
    <h2>Admin Notes</h2>
    <form method="post">
        <?php wp_nonce_field('stoneflow_save_notes'); ?>
        <textarea name="admin_notes" rows="10" style="width: 100%;"><?php echo esc_textarea($current_notes); ?></textarea>
        <br><br>
        <input type="submit" class="button-primary" value="Save Notes">
    </form>
</div>

<?php
// Admin File Upload View
if (!defined('ABSPATH')) exit;
?>

<div class="stoneflow-upload">
    <h2>Upload Deliverable File</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="stoneflow_file" required>
        <input type="hidden" name="stoneflow_upload_nonce" value="<?php echo wp_create_nonce('stoneflow_upload'); ?>">
        <button type="submit" name="stoneflow_upload_submit" class="button button-primary">Upload</button>
    </form>
</div>

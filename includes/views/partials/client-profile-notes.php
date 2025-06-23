<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<h3>📝 Admin Notes</h3>

<form method="post" action="">
	<textarea name="stoneflow_admin_notes" rows="6" style="width:100%;"><?php echo esc_textarea( $admin_notes ); ?></textarea>
	<?php wp_nonce_field( 'stoneflow_save_notes', 'stoneflow_notes_nonce' ); ?>
	<p><input type="submit" class="button button-primary" value="Save Notes"></p>
</form>

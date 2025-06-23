<?php
// Admin Notes View
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$user_id = isset( $_GET['user_id'] ) ? intval( $_GET['user_id'] ) : 0;
$user    = get_userdata( $user_id );

if ( $user ) {
	$notes = get_user_meta( $user_id, 'stoneflow_admin_notes', true );

	if ( $_SERVER['REQUEST_METHOD'] === 'POST' && current_user_can( 'manage_options' ) ) {
		$new_notes = sanitize_textarea_field( $_POST['admin_notes'] );
		update_user_meta( $user_id, 'stoneflow_admin_notes', $new_notes );
		$notes = $new_notes;
		echo '<div class="updated"><p>Notes updated successfully.</p></div>';
	}
	?>
	<div class="wrap">
		<h1>📝 Admin Notes – <?php echo esc_html( $user->display_name ); ?></h1>
		<form method="post">
			<textarea name="admin_notes" rows="10" style="width:100%;"><?php echo esc_textarea( $notes ); ?></textarea>
			<br><br>
			<input type="submit" class="button-primary" value="Save Notes">
		</form>
		<p><a href="<?php echo admin_url( 'admin.php?page=stoneflow-client-profile&user_id=' . $user_id ); ?>">← Back to Profile</a></p>
	</div>
	<?php
} else {
	echo '<div class="notice notice-error"><p>User not found.</p></div>';
}

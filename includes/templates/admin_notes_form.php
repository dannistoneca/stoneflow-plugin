<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! current_user_can( 'manage_options' ) ) {
	echo '<p>Access denied.</p>';
	return;
}

$service_id = intval( $_GET['service_id'] ?? 0 );
$service    = StoneFlow_DB::get_service_by_id( $service_id );

if ( ! $service ) {
	echo '<p>Invalid service ID.</p>';
	return;
}

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer( 'update_admin_notes' ) ) {
	$notes = sanitize_textarea_field( $_POST['admin_notes'] );
	StoneFlow_DB::update_admin_notes( $service_id, $notes );
	echo '<div class="updated"><p>Notes updated successfully.</p></div>';
	$service->admin_notes = $notes;
}
?>

<div class="wrap">
	<h2>Edit Admin Notes for <?php echo esc_html( $service->service_name ); ?></h2>
	<form method="post">
		<?php wp_nonce_field( 'update_admin_notes' ); ?>
		<table class="form-table">
			<tr>
				<th><label for="admin_notes">Notes</label></th>
				<td>
					<textarea name="admin_notes" id="admin_notes" rows="6" class="large-text"><?php echo esc_textarea( $service->admin_notes ); ?></textarea>
				</td>
			</tr>
		</table>
		<?php submit_button( 'Update Notes' ); ?>
	</form>
</div>

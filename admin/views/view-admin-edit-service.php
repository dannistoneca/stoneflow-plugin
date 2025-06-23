<?php
// Admin Edit Service View
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$service_id = isset( $_GET['service_id'] ) ? intval( $_GET['service_id'] ) : 0;
$service    = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}stoneflow_services WHERE id = %d", $service_id ) );

if ( ! $service ) {
	echo '<div class="notice notice-error"><p>Service not found.</p></div>';
	return;
}

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer( 'stoneflow_edit_service' ) ) {
	$status   = sanitize_text_field( $_POST['status'] );
	$priority = isset( $_POST['priority'] ) ? 1 : 0;
	$file_url = esc_url_raw( $_POST['file_url'] );
	$notes    = sanitize_textarea_field( $_POST['notes'] );

	$wpdb->update(
		"{$wpdb->prefix}stoneflow_services",
		array(
			'status'   => $status,
			'priority' => $priority,
			'file_url' => $file_url,
			'notes'    => $notes,
		),
		array( 'id' => $service_id )
	);

	echo '<div class="notice notice-success"><p>Service updated successfully.</p></div>';
	$service = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}stoneflow_services WHERE id = %d", $service_id ) );
}
?>

<h2>Edit Service</h2>
<form method="post">
	<?php wp_nonce_field( 'stoneflow_edit_service' ); ?>
	<table class="form-table">
		<tr>
			<th scope="row"><label for="status">Status</label></th>
			<td>
				<select name="status" id="status">
					<option value="queued" <?php selected( $service->status, 'queued' ); ?>>Queued</option>
					<option value="in_process" <?php selected( $service->status, 'in_process' ); ?>>In Process</option>
					<option value="completed" <?php selected( $service->status, 'completed' ); ?>>Completed</option>
				</select>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="priority">Priority</label></th>
			<td>
				<input type="checkbox" name="priority" id="priority" value="1" <?php checked( $service->priority, 1 ); ?>>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="file_url">File URL</label></th>
			<td><input type="text" name="file_url" id="file_url" value="<?php echo esc_attr( $service->file_url ); ?>" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="notes">Notes</label></th>
			<td><textarea name="notes" id="notes" class="large-text" rows="5"><?php echo esc_textarea( $service->notes ); ?></textarea></td>
		</tr>
	</table>
	<?php submit_button( 'Update Service' ); ?>
</form>

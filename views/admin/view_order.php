<div class="wrap">
	<h1>📄 Order Details</h1>

	<table class="form-table">
		<tr>
			<th scope="row">Service:</th>
			<td><?php echo esc_html( $order['service_name'] ); ?></td>
		</tr>
		<tr>
			<th scope="row">Client:</th>
			<td><?php echo esc_html( $client['name'] ); ?> (<?php echo esc_html( $client['email'] ); ?>)</td>
		</tr>
		<tr>
			<th scope="row">Status:</th>
			<td>
				<form method="post">
					<select name="status">
						<option value="Queued" <?php echo selected( $order['status'], 'Queued' ); ?>>Queued</option>
						<option value="In Progress" <?php echo selected( $order['status'], 'In Progress' ); ?>>In Progress</option>
						<option value="Completed" <?php echo selected( $order['status'], 'Completed' ); ?>>Completed</option>
					</select>
					<?php submit_button( 'Update Status', 'secondary' ); ?>
				</form>
			</td>
		</tr>
		<tr>
			<th scope="row">Priority:</th>
			<td><?php echo esc_html( $order['priority'] ); ?></td>
		</tr>
		<tr>
			<th scope="row">Created:</th>
			<td><?php echo esc_html( $order['created_at'] ); ?></td>
		</tr>
		<tr>
			<th scope="row">Files:</th>
			<td>
				<?php if ( ! empty( $order['file_url'] ) ) : ?>
					<a href="<?php echo esc_url( $order['file_url'] ); ?>" target="_blank">Download File</a>
				<?php else : ?>
					<em>No file uploaded yet.</em>
				<?php endif; ?>
			</td>
		</tr>
	</table>

	<h2>📎 Upload File</h2>
	<form method="post" enctype="multipart/form-data">
		<input type="file" name="order_file" required>
		<?php submit_button( 'Upload File' ); ?>
	</form>

	<h2>📝 Admin Notes</h2>
	<form method="post">
		<textarea name="admin_notes" rows="5" class="large-text"><?php echo esc_textarea( $order['admin_notes'] ); ?></textarea>
		<?php submit_button( 'Save Notes' ); ?>
	</form>
</div>

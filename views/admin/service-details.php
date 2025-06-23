<div class="wrap">
	<h1>Service Details</h1>

	<?php if ( $service ) : ?>
	<table class="form-table">
		<tr>
		<th scope="row">Client Name</th>
		<td><?php echo esc_html( $service->client_name ); ?></td>
		</tr>
		<tr>
		<th scope="row">Client Email</th>
		<td><?php echo esc_html( $service->client_email ); ?></td>
		</tr>
		<tr>
		<th scope="row">Service Name</th>
		<td><?php echo esc_html( $service->service_name ); ?></td>
		</tr>
		<tr>
		<th scope="row">Status</th>
		<td><?php echo esc_html( ucfirst( $service->status ) ); ?></td>
		</tr>
		<tr>
		<th scope="row">Priority</th>
		<td><?php echo $service->priority ? '🔺 High' : 'Normal'; ?></td>
		</tr>
		<tr>
		<th scope="row">Created At</th>
		<td><?php echo esc_html( $service->created_at ); ?></td>
		</tr>
		<tr>
		<th scope="row">File</th>
		<td>
			<?php if ( ! empty( $service->file_url ) ) : ?>
			<a href="<?php echo esc_url( $service->file_url ); ?>" target="_blank">Download File</a>
			<?php else : ?>
			No file uploaded.
			<?php endif; ?>
		</td>
		</tr>
		<tr>
		<th scope="row">Admin Notes</th>
		<td><?php echo ! empty( $service->admin_notes ) ? esc_html( $service->admin_notes ) : 'None'; ?></td>
		</tr>
	</table>

	<h2>Update Status</h2>
	<form method="post">
		<input type="hidden" name="service_id" value="<?php echo intval( $service->id ); ?>">
		<select name="new_status">
		<option value="queued" <?php selected( $service->status, 'queued' ); ?>>Queued</option>
		<option value="in_process" <?php selected( $service->status, 'in_process' ); ?>>In Process</option>
		<option value="completed" <?php selected( $service->status, 'completed' ); ?>>Completed</option>
		</select>
		<input type="submit" name="update_status" class="button button-primary" value="Update">
	</form>

	<?php else : ?>
	<p>Service not found.</p>
	<?php endif; ?>
</div>

<div class="wrap">
	<h1>📦 Service Order Details</h1>

	<?php if ( $service ) : ?>
		<table class="form-table">
			<tr>
				<th>Service</th>
				<td><?php echo esc_html( $service['service_name'] ); ?></td>
			</tr>
			<tr>
				<th>Status</th>
				<td><?php echo esc_html( $service['status'] ); ?></td>
			</tr>
			<tr>
				<th>Priority</th>
				<td><?php echo esc_html( $service['priority'] ); ?></td>
			</tr>
			<tr>
				<th>Started</th>
				<td><?php echo esc_html( $service['created_at'] ); ?></td>
			</tr>
			<tr>
				<th>File</th>
				<td>
					<?php if ( ! empty( $service['file_url'] ) ) : ?>
						<a href="<?php echo esc_url( $service['file_url'] ); ?>" target="_blank">Download File</a>
					<?php else : ?>
						No file uploaded yet.
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th>Admin Notes</th>
				<td><?php echo esc_html( $service['admin_notes'] ); ?></td>
			</tr>
			<tr>
				<th>Your Notes</th>
				<td><?php echo esc_html( $service['client_notes'] ); ?></td>
			</tr>
		</table>
	<?php else : ?>
		<p>Service not found.</p>
	<?php endif; ?>
</div>

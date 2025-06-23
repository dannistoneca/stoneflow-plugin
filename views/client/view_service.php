<div class="stoneflow-client-panel">
	<h2>Service Details</h2>

	<?php if ( ! empty( $service ) ) : ?>
		<table class="stoneflow-table">
			<tr>
				<th>Service</th>
				<td><strong><?php echo esc_html( $service['service_name'] ); ?></strong></td>
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
				<th>Files</th>
				<td>
					<?php if ( ! empty( $service['file_url'] ) ) : ?>
						<a href="<?php echo esc_url( $service['file_url'] ); ?>" target="_blank">Download</a>
					<?php else : ?>
						—
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th>Admin Notes</th>
				<td><?php echo ! empty( $service['admin_notes'] ) ? esc_html( $service['admin_notes'] ) : '—'; ?></td>
			</tr>
			<tr>
				<th>Your Notes</th>
				<td><?php echo ! empty( $service['client_notes'] ) ? esc_html( $service['client_notes'] ) : '—'; ?></td>
			</tr>
		</table>
	<?php else : ?>
		<p>Service details not found.</p>
	<?php endif; ?>
</div>

<?php if ( ! empty( $services ) ) : ?>
	<table class="widefat fixed striped">
	<thead>
		<tr>
		<th>Client</th>
		<th>Service</th>
		<th>Status</th>
		<th>Priority</th>
		<th>Created</th>
		<th>File</th>
		<th>Notes</th>
		<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $services as $service ) : ?>
		<tr>
			<td><?php echo esc_html( $service->client_name ); ?></td>
			<td><?php echo esc_html( $service->service_name ); ?></td>
			<td><?php echo esc_html( ucfirst( $service->status ) ); ?></td>
			<td><?php echo $service->priority ? 'Yes' : 'No'; ?></td>
			<td><?php echo date( 'Y-m-d', strtotime( $service->created_at ) ); ?></td>
			<td>
			<?php if ( $service->file_url ) : ?>
				<a href="<?php echo esc_url( $service->file_url ); ?>" target="_blank">Download</a>
			<?php else : ?>
				None
			<?php endif; ?>
			</td>
			<td><?php echo esc_html( $service->notes ); ?></td>
			<td>
			<a href="<?php echo admin_url( 'admin.php?page=stoneflow-edit-service&id=' . $service->id ); ?>" class="button">Edit</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
<?php else : ?>
	<p>No services in the queue.</p>
<?php endif; ?>

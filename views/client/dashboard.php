<div class="wrap">
	<h1>👋 Welcome to Your Client Dashboard</h1>

	<h2>Your Orders</h2>
	<?php if ( ! empty( $orders ) ) : ?>
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<th>Service</th>
					<th>Status</th>
					<th>Priority</th>
					<th>Created</th>
					<th>File</th>
					<th>Notes</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $orders as $order ) : ?>
					<tr>
						<td><?php echo esc_html( $order['service_name'] ); ?></td>
						<td><?php echo esc_html( $order['status'] ); ?></td>
						<td><?php echo esc_html( $order['priority'] ); ?></td>
						<td><?php echo esc_html( $order['created_at'] ); ?></td>
						<td>
							<?php if ( ! empty( $order['file_url'] ) ) : ?>
								<a href="<?php echo esc_url( $order['file_url'] ); ?>" target="_blank">Download</a>
							<?php else : ?>
								<em>Not ready yet</em>
							<?php endif; ?>
						</td>
						<td><?php echo esc_html( $order['admin_notes'] ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p>You don’t have any orders yet. If you recently purchased a service, please allow a moment for it to appear.</p>
	<?php endif; ?>
</div>

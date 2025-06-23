<div class="stoneflow-client-panel">
	<h2>📄 Order Details</h2>

	<?php if ( ! empty( $order ) ) : ?>
		<table class="form-table">
			<tr>
				<th scope="row">Service Name</th>
				<td><?php echo esc_html( $order['service_name'] ); ?></td>
			</tr>
			<tr>
				<th scope="row">Status</th>
				<td><?php echo esc_html( $order['status'] ); ?></td>
			</tr>
			<tr>
				<th scope="row">Priority</th>
				<td><?php echo esc_html( $order['priority'] ); ?></td>
			</tr>
			<tr>
				<th scope="row">Created</th>
				<td><?php echo esc_html( date( 'Y-m-d H:i', strtotime( $order['created_at'] ) ) ); ?></td>
			</tr>
			<?php if ( ! empty( $order['file_url'] ) ) : ?>
			<tr>
				<th scope="row">Download File</th>
				<td><a href="<?php echo esc_url( $order['file_url'] ); ?>" class="button">Download</a></td>
			</tr>
			<?php endif; ?>
			<?php if ( ! empty( $order['notes'] ) ) : ?>
			<tr>
				<th scope="row">Notes</th>
				<td><?php echo nl2br( esc_html( $order['notes'] ) ); ?></td>
			</tr>
			<?php endif; ?>
		</table>
	<?php else : ?>
		<p>Order not found or access denied.</p>
	<?php endif; ?>
</div>

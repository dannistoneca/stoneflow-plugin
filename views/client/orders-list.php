<div class="wrap">
	<h1>Your Orders</h1>

	<?php if ( ! empty( $orders ) ) : ?>
	<table class="widefat fixed striped">
		<thead>
		<tr>
			<th>Order ID</th>
			<th>Service</th>
			<th>Status</th>
			<th>Priority</th>
			<th>Files</th>
			<th>Notes</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ( $orders as $order ) : ?>
			<tr>
			<td><?php echo esc_html( $order->id ); ?></td>
			<td><?php echo esc_html( $order->service_name ); ?></td>
			<td><?php echo esc_html( ucfirst( $order->status ) ); ?></td>
			<td><?php echo $order->priority ? '<strong>High</strong>' : 'Normal'; ?></td>
			<td>
				<?php if ( ! empty( $order->file_url ) ) : ?>
				<a href="<?php echo esc_url( $order->file_url ); ?>" target="_blank">Download</a>
				<?php else : ?>
				—
				<?php endif; ?>
			</td>
			<td><?php echo esc_html( $order->notes ); ?></td>
			<td>
				<a href="<?php echo admin_url( 'admin.php?page=stoneflow_order_view&id=' . $order->id ); ?>" class="button">View</a>
			</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php else : ?>
	<p>You don’t have any orders yet.</p>
	<?php endif; ?>
</div>

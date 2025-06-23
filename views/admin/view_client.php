<div class="wrap">
	<h1>👤 <?php echo esc_html( $client['name'] ); ?> – Profile</h1>

	<table class="form-table">
		<tr>
			<th scope="row">Email:</th>
			<td><?php echo esc_html( $client['email'] ); ?></td>
		</tr>
		<tr>
			<th scope="row">Status:</th>
			<td><?php echo esc_html( $client['status'] ); ?></td>
		</tr>
		<tr>
			<th scope="row">Added:</th>
			<td><?php echo esc_html( date( 'Y-m-d H:i:s', strtotime( $client['created_at'] ) ) ); ?></td>
		</tr>
	</table>

	<h2>📦 Services</h2>
	<?php if ( ! empty( $orders ) ) : ?>
		<table class="widefat fixed striped">
			<thead>
				<tr>
					<th>Service</th>
					<th>Status</th>
					<th>Priority</th>
					<th>Created</th>
					<th>View</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $orders as $order ) : ?>
					<tr>
						<td><?php echo esc_html( $order['service_name'] ); ?></td>
						<td><?php echo esc_html( $order['status'] ); ?></td>
						<td><?php echo esc_html( $order['priority'] ); ?></td>
						<td><?php echo esc_html( $order['created_at'] ); ?></td>
						<td><a href="<?php echo admin_url( 'admin.php?page=stoneflow_view_order&id=' . $order['id'] ); ?>" class="button">View</a></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p>No services found.</p>
	<?php endif; ?>

	<h2>📝 Admin Notes</h2>
	<form method="post">
		<textarea name="admin_notes" rows="5" class="large-text"><?php echo esc_textarea( $client['admin_notes'] ); ?></textarea>
		<?php submit_button( 'Save Notes' ); ?>
	</form>
</div>

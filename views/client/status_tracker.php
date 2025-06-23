<div class="stoneflow-client-panel">
	<h2>📊 Service Status Tracker</h2>

	<?php if ( ! empty( $services ) ) : ?>
		<table class="stoneflow-table">
			<thead>
				<tr>
					<th>Service</th>
					<th>Status</th>
					<th>Priority</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $services as $service ) : ?>
					<tr>
						<td><?php echo esc_html( $service['name'] ); ?></td>
						<td>
							<span class="status-badge status-<?php echo strtolower( $service['status'] ); ?>">
								<?php echo esc_html( $service['status'] ); ?>
							</span>
						</td>
						<td><?php echo esc_html( $service['priority'] ? 'High' : 'Normal' ); ?></td>
						<td><?php echo esc_html( $service['updated_at'] ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p>You have no services in progress right now.</p>
	<?php endif; ?>
</div>

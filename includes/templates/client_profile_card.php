<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function stoneflow_render_client_profile( $client ) {
	?>
	<div class="stoneflow-client-card">
		<h2><?php echo esc_html( $client->name ); ?> – Profile</h2>
		<p><strong>Email:</strong> <?php echo esc_html( $client->email ); ?></p>
		<p><strong>Status:</strong> <?php echo esc_html( $client->status ); ?></p>
		<p><strong>Added:</strong> <?php echo date( 'Y-m-d H:i:s', strtotime( $client->created_at ) ); ?></p>

		<h3>📦 Services</h3>
		<?php if ( ! empty( $client->services ) ) : ?>
			<ul>
				<?php foreach ( $client->services as $service ) : ?>
					<li>
						<?php echo esc_html( $service->service_name ); ?> –
						<em><?php echo esc_html( ucfirst( $service->status ) ); ?></em>
						<?php if ( ! empty( $service->file_url ) ) : ?>
							– <a href="<?php echo esc_url( $service->file_url ); ?>" target="_blank">Download</a>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p>No services found.</p>
		<?php endif; ?>

		<h3>📝 Admin Notes</h3>
		<form method="post">
			<textarea name="admin_notes" rows="5" cols="50"><?php echo esc_textarea( $client->notes ?? '' ); ?></textarea>
			<input type="hidden" name="client_id" value="<?php echo esc_attr( $client->id ); ?>">
			<br>
			<button type="submit" name="save_notes" class="button button-primary">Save Notes</button>
		</form>
	</div>
	<?php
}

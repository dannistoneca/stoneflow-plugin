<?php
// Client profile view

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function stoneflow_render_client_profile( $user_id ) {
	$user = get_user_by( 'id', $user_id );
	if ( ! $user ) {
		return '<p>User not found.</p>';
	}

	$discovery_info = get_user_meta( $user_id, 'stoneflow_discovery_info', true );
	$services       = stoneflow_get_user_services( $user_id );
	$notes          = get_user_meta( $user_id, 'stoneflow_admin_notes', true );

	ob_start(); ?>
	<div class="stoneflow-client-profile">
		<h2>👤 <?php echo esc_html( $user->display_name ); ?> – Profile</h2>
		<p><strong>Email:</strong> <?php echo esc_html( $user->user_email ); ?></p>
		<p><strong>Status:</strong> <?php echo esc_html( get_user_meta( $user_id, 'stoneflow_account_status', true ) ?: 'active' ); ?></p>
		<p><strong>Added:</strong> <?php echo esc_html( get_user_meta( $user_id, 'stoneflow_registered_at', true ) ); ?></p>

		<h3>📦 Services</h3>
		<?php if ( $services && count( $services ) > 0 ) : ?>
			<ul>
				<?php foreach ( $services as $service ) : ?>
					<li><strong><?php echo esc_html( $service['name'] ); ?></strong> – <?php echo esc_html( $service['status'] ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p>No services found.</p>
		<?php endif; ?>

		<h3>📝 Admin Notes</h3>
		<div class="stoneflow-notes-box">
			<?php echo ! empty( $notes ) ? wp_kses_post( nl2br( $notes ) ) : '<em>No notes yet.</em>'; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

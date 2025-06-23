<?php
// Display client profile data for admin view
function stoneflow_render_client_profile_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have permission to access this page.' ) );
	}

	$client_id = isset( $_GET['client_id'] ) ? absint( $_GET['client_id'] ) : 0;
	$client    = get_user_by( 'id', $client_id );

	if ( ! $client || ! in_array( 'client', (array) $client->roles ) ) {
		echo '<div class="wrap"><h2>Client Not Found</h2></div>';
		return;
	}

	?>
	<div class="wrap">
		<h1>👤 <?php echo esc_html( $client->display_name ); ?> – Profile</h1>
		<p><strong>Email:</strong> <?php echo esc_html( $client->user_email ); ?></p>
		<p><strong>Status:</strong> <?php echo esc_html( get_user_meta( $client_id, '_stoneflow_status', true ) ?: 'active' ); ?></p>
		<p><strong>Added:</strong> <?php echo esc_html( $client->user_registered ); ?></p>

		<h2>📦 Services</h2>
		<?php do_action( 'stoneflow_display_client_services', $client_id ); ?>

		<?php do_action( 'stoneflow_display_admin_notes_section', $client ); ?>
	</div>
	<?php
}

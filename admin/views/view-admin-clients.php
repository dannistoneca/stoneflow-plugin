<?php
// Admin Clients View
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wpdb;
$users          = get_users();
$services_table = $wpdb->prefix . 'stoneflow_services';
?>

<div class="wrap">
	<h1>StoneFlow Clients</h1>
	<table class="wp-list-table widefat fixed striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Discovery Info</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $users as $user ) : ?>
				<?php
				$discovery = get_user_meta( $user->ID, 'stoneflow_discovery_data', true );
				?>
				<tr>
					<td><?php echo esc_html( $user->display_name ); ?></td>
					<td><?php echo esc_html( $user->user_email ); ?></td>
					<td><?php echo $discovery ? '✅ Collected' : 'No data'; ?></td>
					<td>
						<a href="<?php echo admin_url( 'admin.php?page=stoneflow-client-view&user_id=' . $user->ID ); ?>">View Profile</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

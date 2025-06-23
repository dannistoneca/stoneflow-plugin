<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers a shortcode for displaying the client dashboard.
 */
function stoneflow_client_dashboard_shortcode() {
	if ( ! is_user_logged_in() ) {
		return '<p>Please <a href="' . wp_login_url( get_permalink() ) . '">log in</a> to view your dashboard.</p>';
	}

	ob_start();
	?>
	<div class="stoneflow-client-dashboard">
		<h2>Welcome to Your Dashboard</h2>

		<?php
		$current_user = wp_get_current_user();
		echo '<p><strong>Name:</strong> ' . esc_html( $current_user->display_name ) . '</p>';
		echo '<p><strong>Email:</strong> ' . esc_html( $current_user->user_email ) . '</p>';
		?>

		<h3>Your Orders</h3>
		<table class="widefat striped">
			<thead>
				<tr>
					<th>Service</th>
					<th>Status</th>
					<th>Priority</th>
					<th>Date</th>
					<th>View</th>
				</tr>
			</thead>
			<tbody>
				<?php
				global $wpdb;
				$table   = $wpdb->prefix . 'stoneflow_services';
				$user_id = get_current_user_id();
				$orders  = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table WHERE client_id = %d", $user_id ) );

				if ( $orders ) {
					foreach ( $orders as $order ) {
						$view_link = add_query_arg(
							array(
								'stoneflow_order' => $order->id,
							),
							get_permalink()
						);

						echo '<tr>';
						echo '<td>' . esc_html( $order->service_name ) . '</td>';
						echo '<td>' . esc_html( ucfirst( $order->status ) ) . '</td>';
						echo '<td>' . ( $order->priority ? 'Yes' : 'No' ) . '</td>';
						echo '<td>' . esc_html( date( 'F j, Y', strtotime( $order->created_at ) ) ) . '</td>';
						echo '<td><a href="' . esc_url( $view_link ) . '">View</a></td>';
						echo '</tr>';
					}
				} else {
					echo '<tr><td colspan="5">No orders found.</td></tr>';
				}
				?>
			</tbody>
		</table>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'stoneflow_client_dashboard', 'stoneflow_client_dashboard_shortcode' );

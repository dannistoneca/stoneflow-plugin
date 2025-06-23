<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if user is logged in
if ( ! is_user_logged_in() ) {
	echo '<div class="wrap"><h2>Please log in to view your order details.</h2></div>';
	return;
}

$current_user = wp_get_current_user();
$order_id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

// Fetch order data
global $wpdb;
$table = $wpdb->prefix . 'stoneflow_services';
$order = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE id = %d AND client_id = %d", $order_id, $current_user->ID ) );

if ( ! $order ) {
	echo '<div class="wrap"><h2>Order not found.</h2></div>';
	return;
}

// Format order status
$status_label = ucfirst( str_replace( '_', ' ', $order->status ) );
?>

<div class="wrap">
	<h2>Order Details: #<?php echo esc_html( $order->id ); ?></h2>
	<table class="widefat fixed" style="max-width: 800px;">
		<tbody>
			<tr>
				<th>Service Name</th>
				<td><?php echo esc_html( $order->service_name ); ?></td>
			</tr>
			<tr>
				<th>Status</th>
				<td><?php echo esc_html( $status_label ); ?></td>
			</tr>
			<tr>
				<th>Priority</th>
				<td><?php echo esc_html( $order->priority ? 'Yes' : 'No' ); ?></td>
			</tr>
			<tr>
				<th>Date Created</th>
				<td><?php echo esc_html( $order->created_at ); ?></td>
			</tr>
			<tr>
				<th>Download</th>
				<td>
					<?php if ( ! empty( $order->file_url ) ) : ?>
						<a href="<?php echo esc_url( $order->file_url ); ?>" class="button button-primary" download>Download File</a>
					<?php else : ?>
						<em>No file available</em>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th>Notes</th>
				<td><?php echo nl2br( esc_html( $order->notes ) ); ?></td>
			</tr>
		</tbody>
	</table>
</div>

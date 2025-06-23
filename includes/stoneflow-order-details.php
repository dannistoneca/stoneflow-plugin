<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renders the details of a specific service order for a client.
 */
function stoneflow_render_order_details() {
	if ( ! is_user_logged_in() || ! isset( $_GET['stoneflow_order'] ) ) {
		return '<p>Invalid request or not logged in.</p>';
	}

	global $wpdb;
	$user_id  = get_current_user_id();
	$order_id = intval( $_GET['stoneflow_order'] );
	$table    = $wpdb->prefix . 'stoneflow_services';

	$order = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE id = %d AND client_id = %d", $order_id, $user_id ) );

	if ( ! $order ) {
		return '<p>Order not found or you do not have permission to view it.</p>';
	}

	ob_start();
	?>
	<div class="stoneflow-order-details">
		<h2>Order Details</h2>
		<p><strong>Service:</strong> <?php echo esc_html( $order->service_name ); ?></p>
		<p><strong>Status:</strong> <?php echo esc_html( ucfirst( $order->status ) ); ?></p>
		<p><strong>Priority:</strong> <?php echo $order->priority ? 'Yes' : 'No'; ?></p>
		<p><strong>Created:</strong> <?php echo esc_html( date( 'M j, Y', strtotime( $order->created_at ) ) ); ?></p>

		<?php if ( ! empty( $order->file_url ) ) : ?>
			<p><strong>Download File:</strong> <a href="<?php echo esc_url( $order->file_url ); ?>" target="_blank" download>Click here</a></p>
		<?php endif; ?>

		<?php if ( ! empty( $order->notes ) ) : ?>
			<p><strong>Admin Notes:</strong><br><?php echo nl2br( esc_html( $order->notes ) ); ?></p>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
}

function stoneflow_order_details_shortcode() {
	return stoneflow_render_order_details();
}
add_shortcode( 'stoneflow_order_details', 'stoneflow_order_details_shortcode' );

<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function stoneflow_service_delivery_form( $client_id, $service_id ) {
	?>
	<div class="wrap">
		<h2>Deliver Service</h2>
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="client_id" value="<?php echo esc_attr( $client_id ); ?>">
			<input type="hidden" name="service_id" value="<?php echo esc_attr( $service_id ); ?>">

			<table class="form-table">
				<tr>
					<th><label for="delivery_file">Upload File</label></th>
					<td><input type="file" name="delivery_file" id="delivery_file" required></td>
				</tr>
				<tr>
					<th><label for="delivery_notes">Notes</label></th>
					<td><textarea name="delivery_notes" id="delivery_notes" rows="5" class="large-text"></textarea></td>
				</tr>
			</table>

			<?php submit_button( 'Submit Delivery' ); ?>
		</form>
	</div>
	<?php
}

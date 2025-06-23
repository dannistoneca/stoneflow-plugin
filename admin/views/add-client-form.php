<?php
/**
 * Add Client Form
 *
 * Rendered inside the StoneFlow admin.
 *
 * @package StoneFlow
 */

?>
<div class="wrap">
	<h1><?php esc_html_e( 'Add New Client', 'stoneflow' ); ?></h1>

	<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="stoneflow_add_client" />

		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">
						<label for="client_name"><?php esc_html_e( 'Client Name', 'stoneflow' ); ?></label>
					</th>
					<td>
						<input
							name="client_name"
							type="text"
							id="client_name"
							class="regular-text"
							required
						/>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="client_email"><?php esc_html_e( 'Client Email', 'stoneflow' ); ?></label>
					</th>
					<td>
						<input
							name="client_email"
							type="email"
							id="client_email"
							class="regular-text"
							required
						/>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="client_phone"><?php esc_html_e( 'Phone Number', 'stoneflow' ); ?></label>
					</th>
					<td>
						<input
							name="client_phone"
							type="text"
							id="client_phone"
							class="regular-text"
						/>
					</td>
				</tr>
			</tbody>
		</table>

		<?php
		// 🔒 Nonce for security.
		wp_nonce_field( 'stoneflow_add_client', '_stone_nonce' );
		?>

		<?php submit_button( __( 'Add Client', 'stoneflow' ) ); ?>
	</form>
</div>

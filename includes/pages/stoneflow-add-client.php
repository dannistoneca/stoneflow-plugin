<?php
// includes/pages/stoneflow-add-client.php

function stoneflow_render_add_client_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	global $wpdb;
	$message = '';

	if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['client_email'] ) ) {
		$email = sanitize_email( $_POST['client_email'] );
		$name  = sanitize_text_field( $_POST['client_name'] );

		if ( ! is_email( $email ) ) {
			$message = 'Invalid email address.';
		} else {
			$user_id = email_exists( $email );

			if ( ! $user_id ) {
				$random_password = wp_generate_password();
				$user_id         = wp_create_user( $email, $random_password, $email );

				if ( is_wp_error( $user_id ) ) {
					$message = 'Error creating user: ' . $user_id->get_error_message();
				} else {
					wp_update_user(
						array(
							'ID'           => $user_id,
							'display_name' => $name,
						)
					);
					$message = 'New client created successfully.';
				}
			} else {
				$message = 'User already exists. Linked existing user.';
			}

			update_user_meta(
				$user_id,
				'stoneflow_client_data',
				array(
					'name'  => $name,
					'email' => $email,
					'added' => current_time( 'mysql' ),
				)
			);
		}
	}

	echo '<div class="wrap">';
	echo '<h1>Add New Client</h1>';

	if ( ! empty( $message ) ) {
		echo '<div class="notice notice-success is-dismissible"><p>' . esc_html( $message ) . '</p></div>';
	}

	echo '<form method="post">';
	echo '<table class="form-table">';
	echo '<tr><th><label for="client_name">Name</label></th>';
	echo '<td><input type="text" name="client_name" id="client_name" class="regular-text" required></td></tr>';
	echo '<tr><th><label for="client_email">Email</label></th>';
	echo '<td><input type="email" name="client_email" id="client_email" class="regular-text" required></td></tr>';
	echo '</table>';
	echo '<p><input type="submit" class="button-primary" value="Add Client"></p>';
	echo '</form>';
	echo '</div>';
}

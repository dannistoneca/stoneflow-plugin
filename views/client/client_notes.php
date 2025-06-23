<div class="stoneflow-client-panel">
	<h2>📝 Your Notes</h2>

	<form method="post">
		<?php wp_nonce_field( 'update_client_notes', 'client_notes_nonce' ); ?>
		<textarea name="client_notes" rows="6" style="width: 100%;"><?php echo esc_textarea( $notes ); ?></textarea>
		<p><input type="submit" name="submit_client_notes" class="button button-primary" value="Save Notes"></p>
	</form>
</div>

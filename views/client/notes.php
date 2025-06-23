<div class="stoneflow-client-panel">
	<h2>📝 Project Notes</h2>

	<form method="post">
		<textarea name="client_note" rows="5" class="widefat" placeholder="Add a note for the Stone team..."></textarea>
		<?php wp_nonce_field( 'stoneflow_client_note', 'stoneflow_client_note_nonce' ); ?>
		<p><button type="submit" class="button button-primary">Add Note</button></p>
	</form>

	<h3>Previous Notes</h3>
	<?php if ( ! empty( $notes ) ) : ?>
		<ul class="stoneflow-notes-list">
			<?php foreach ( $notes as $note ) : ?>
				<li>
					<strong><?php echo esc_html( $note['created_at'] ); ?></strong> — <?php echo esc_html( $note['note'] ); ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<p>No notes have been added yet.</p>
	<?php endif; ?>
</div>

<div class="stoneflow-client-panel">
	<h2>Messages</h2>

	<?php if ( ! empty( $messages ) ) : ?>
		<ul class="stoneflow-messages-list">
			<?php foreach ( $messages as $message ) : ?>
				<li>
					<strong><?php echo esc_html( $message['sender'] ); ?>:</strong>
					<?php echo esc_html( $message['message'] ); ?> <br>
					<em><?php echo date( 'F j, Y g:i A', strtotime( $message['created_at'] ) ); ?></em>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<p>No messages yet.</p>
	<?php endif; ?>

	<form method="post">
		<input type="hidden" name="stoneflow_action" value="send_client_message">
		<textarea name="message" rows="3" required placeholder="Type your message..."></textarea>
		<br>
		<button type="submit" class="button button-primary">Send Message</button>
	</form>
</div>

<div class="wrap">
	<h1>🧠 Discovery Info</h1>

	<?php if ( ! $discovery ) : ?>
		<p>No discovery session data available yet. If you’ve completed your session, it will appear here.</p>
	<?php else : ?>
		<table class="form-table">
			<tr>
				<th><label>Business Name</label></th>
				<td><?php echo esc_html( $discovery->business_name ); ?></td>
			</tr>
			<tr>
				<th><label>Goals</label></th>
				<td><?php echo nl2br( esc_html( $discovery->goals ) ); ?></td>
			</tr>
			<tr>
				<th><label>Challenges</label></th>
				<td><?php echo nl2br( esc_html( $discovery->challenges ) ); ?></td>
			</tr>
			<tr>
				<th><label>Budget</label></th>
				<td><?php echo esc_html( $discovery->budget ); ?></td>
			</tr>
			<tr>
				<th><label>Preferences</label></th>
				<td><?php echo nl2br( esc_html( $discovery->preferences ) ); ?></td>
			</tr>
		</table>
	<?php endif; ?>
</div>

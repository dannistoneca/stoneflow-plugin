<div class="wrap">
	<h1>StoneFlow Settings</h1>
	<form method="post" action="options.php">
	<?php
		settings_fields( 'stoneflow_settings_group' );
		do_settings_sections( 'stoneflow_settings' );
		submit_button();
	?>
	</form>
</div>

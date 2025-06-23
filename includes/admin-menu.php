<?php
// Register StoneFlow admin menu and submenus
add_action( 'admin_menu', 'stoneflow_register_admin_menu' );

function stoneflow_register_admin_menu() {
	// Main menu
	add_menu_page(
		'StoneFlow Dashboard',
		'StoneFlow',
		'manage_options',
		'stoneflow-dashboard',
		'stoneflow_admin_dashboard',
		'dashicons-admin-generic',
		2
	);

	// Submenu: Client Manager
	add_submenu_page(
		'stoneflow-dashboard',
		'Client Manager',
		'Client Manager',
		'manage_options',
		'stoneflow-client-manager',
		'stoneflow_client_manager_page'
	);

	// Submenu: Service Manager
	add_submenu_page(
		'stoneflow-dashboard',
		'Service Queue',
		'Service Queue',
		'manage_options',
		'stoneflow-service-queue',
		'stoneflow_service_queue_page'
	);

	// Submenu: S.T.O.N.E.
	add_submenu_page(
		'stoneflow-dashboard',
		'S.T.O.N.E. Assistant',
		'S.T.O.N.E.',
		'manage_options',
		'stoneflow-ai-assistant',
		'stoneflow_ai_assistant_page'
	);

	// Hidden profile page (accessible via link only)
	add_submenu_page(
		null,
		'Client Profile',
		'Client Profile',
		'manage_options',
		'stoneflow-client-profile',
		'stoneflow_render_client_profile_page'
	);
}

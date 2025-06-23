<?php
// admin/add-client-handler.php

// ──────────────────────────────────────────────────────────
// Security checks
// ──────────────────────────────────────────────────────────

// 1) Nonce.
if (
	! isset( $_POST['_stone_nonce'] ) ||
	! wp_verify_nonce( $_POST['_stone_nonce'], 'stoneflow_add_client' )
) {
	wp_die( esc_html__( 'Security check failed.', 'stoneflow' ) );
}

// 2) Capability – admins only.
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html__( 'You do not have permission to do that.', 'stoneflow' ) );
}

// … existing code that inserts the client, redirects, etc.

<?php
// includes/functions.php

// Enqueue admin styles
function stoneflow_enqueue_admin_styles() {
	wp_enqueue_style( 'stoneflow-admin-style', plugin_dir_url( __FILE__ ) . '../admin/style.css' );
}
add_action( 'admin_enqueue_scripts', 'stoneflow_enqueue_admin_styles' );

// Create database table on activation
function stoneflow_create_clients_table() {
	global $wpdb;

	$table_name      = $wpdb->prefix . 'stoneflow_clients';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        discovery_info text DEFAULT '',
        status varchar(50) DEFAULT 'active',
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
}
register_activation_hook( __FILE__, 'stoneflow_create_clients_table' );

<?php
// includes/install.php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function stoneflow_install_tables() {
	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();

	$table_name = $wpdb->prefix . 'stoneflow_clients';

	$sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name text NOT NULL,
        email text NOT NULL,
        status varchar(100) DEFAULT 'active' NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        services text DEFAULT NULL,
        admin_notes text DEFAULT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

        if ( defined( 'ABSPATH' ) ) {
                require_once ABSPATH . 'wp-admin/includes/upgrade.php';
                dbDelta( $sql );
        }
}

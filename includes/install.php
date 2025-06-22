<?php
// includes/install.php

if (!defined('ABSPATH')) {
    exit;
}

if ( ! function_exists( 'stoneflow_install_tables' ) ) {
    function stoneflow_install_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $clients_table  = $wpdb->prefix . 'stoneflow_clients';
        $services_table = $wpdb->prefix . 'stoneflow_services';

        $sql_clients = "CREATE TABLE $clients_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name text NOT NULL,
            email text NOT NULL,
            status varchar(100) DEFAULT 'active' NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            services text DEFAULT NULL,
            admin_notes text DEFAULT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        $sql_services = "CREATE TABLE $services_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            client_id mediumint(9) NOT NULL,
            service_name varchar(255) NOT NULL,
            status varchar(50) DEFAULT 'queued' NOT NULL,
            priority tinyint(1) DEFAULT 0 NOT NULL,
            file_url text DEFAULT NULL,
            admin_notes text DEFAULT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql_clients );
        dbDelta( $sql_services );
    }
}

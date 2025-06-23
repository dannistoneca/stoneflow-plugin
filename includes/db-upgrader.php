<?php
namespace StoneFlow;

use wpdb;

/**
 * Create or upgrade the wp_stoneflow_services table.
 */
function create_services_table( wpdb $wpdb ): void {
    $table   = "{$wpdb->prefix}stoneflow_services";
    $charset = $wpdb->get_charset_collate();

    $sql = "
        CREATE TABLE $table (
            id          BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            client_id   BIGINT(20) UNSIGNED NOT NULL,
            service     VARCHAR(255)        NOT NULL,
            status      VARCHAR(20)         NOT NULL DEFAULT 'queued',
            created_at  DATETIME            NOT NULL,
            PRIMARY KEY (id),
            KEY client_idx (client_id)
        ) $charset;
    ";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}

<?php
// class-stoneflow-commands.php

class StoneFlow_Commands {

    public static function handle_command($command, $args = []) {
        switch ($command) {
            case 'get_client_services':
                return self::get_client_services($args);
            case 'update_service_status':
                return self::update_service_status($args);
            case 'get_discovery_data':
                return self::get_discovery_data($args);
            default:
                return ['error' => 'Unknown command'];
        }
    }

    private static function get_client_services($args) {
        global $wpdb;
        $client_id = isset($args['client_id']) ? intval($args['client_id']) : 0;

        if (!$client_id) {
            return ['error' => 'Missing client ID'];
        }

        $services = $wpdb->get_results(
            $wpdb->prepare("SELECT * FROM wp_stoneflow_services WHERE client_id = %d", $client_id),
            ARRAY_A
        );

        return ['services' => $services];
    }

    private static function update_service_status($args) {
        global $wpdb;
        $id = isset($args['id']) ? intval($args['id']) : 0;
        $status = sanitize_text_field($args['status']);

        if (!$id || !$status) {
            return ['error' => 'Missing data'];
        }

        $wpdb->update(
            'wp_stoneflow_services',
            ['status' => $status],
            ['id' => $id]
        );

        return ['success' => true];
    }

    private static function get_discovery_data($args) {
        $client_id = isset($args['client_id']) ? intval($args['client_id']) : 0;
        if (!$client_id) return ['error' => 'Missing client ID'];

        $data = get_user_meta($client_id, 'stone_discovery_data', true);
        return ['discovery' => maybe_unserialize($data)];
    }
}
